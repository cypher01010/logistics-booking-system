<?php
namespace app\modules\user\forms;

class PasswordForm extends \yii\base\Model
{
	public $username;
	public $securityKey;
	public $old;
	public $new;
	public $confirm;
	public $hash;
	public $email;
	public $type;

	public $userObject;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['old', 'new', 'confirm'], 'required'],
			['old', 'validateOldPassword'],
			['new', 'validateNewPassword'],
		];
	}

	/**
	 * @return array customized attribute labels
	 */
	public function attributeLabels()
	{
		return [
			'old' => 'Old Password',
			'new' => 'New Password',
			'confirm' => 'Confirm New Password',
		];
	}

	public function validateOldPassword($attribute, $params)
	{
		$user = NULL;
		if($this->type == \app\models\User::USERTYPE_CUSTOMER) {
			$user = $this->userObject->getRecordByEmailObject($this->email);
		} else {
			$user = $this->userObject->getRecordByUsername($this->username);
		}

		$encryptedPassword = $this->userObject->encryptPassword($this->old, $user->hash, $this->securityKey);
		$this->hash = $user->hash;
		if($encryptedPassword != $user->password) {
			$this->addError('old', 'Invalid Password');
		}
	}

	public function validateNewPassword($attribute, $params)
	{
		if($this->new != $this->confirm) {
			$this->addError('new', '');
			$this->addError('confirm', 'New password mismatch');
		}
	}
}