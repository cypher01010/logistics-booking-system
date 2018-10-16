<?php
namespace app\modules\user\forms;

/**
 * LoginForm is the model behind the login form.
 */
class PersonalIinfoForm extends \yii\base\Model
{
	public $id;
	public $name;
	public $email;
	public $username;

	public $userObject;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['name', 'email', 'username'], 'required'],
			['username', 'validateUsername'],
		];
	}

	/**
	 * @return array customized attribute labels
	 */
	public function attributeLabels()
	{
		return [
			'name' => 'Name',
			'email' => 'Email',
		];
	}

	public function validateUsername($attribute, $params)
	{
		$user = $this->userObject->getRecordByUsername($this->username);

		if(!empty($user) && $this->id != $user->id) {
			$this->addError('username', 'Username already taken');
		}
	}
}