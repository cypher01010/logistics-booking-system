<?php
namespace app\modules\user\forms;

class UpdateUserForm extends \yii\base\Model
{
	public $name;
	public $email;
	public $username;
	public $password;
	public $status;

	public $userObject;
	public $id;
	public $type;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			['name', 'required', 'message' => 'Required'],
			['email', 'required', 'message' => 'Required'],
			['username', 'required', 'message' => 'Required'],
			//['password', 'required', 'message' => 'Required'],

			[['username'], 'string', 'max' => 32],
			[['password'], 'string', 'max' => 128],
			['email', 'email'],
			['email', 'validateEmail'],
			['username', 'validateUsername'],
		];
	}

	public function attributeLabels()
	{
		return [
			'name' => 'Name',
		];
	}

	public function validateEmail($args)
	{
		$user = $this->userObject->getRecordByEmailArray($this->email);
		if(is_array($user) && !empty($user) && $this->id != $user['id']) {
			$this->addError('email', 'Please select different email address');
		}
	}

	public function validateUsername($args)
	{
		$user = $this->userObject->getRecordByUsernameArray($this->username);
		if(is_array($user) && !empty($user) && $this->id != $user['id']) {
			$this->addError('email', 'Please select different email address');
		}
	}
}