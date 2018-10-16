<?php
namespace app\modules\user\forms;

class CreateUserForm extends \yii\base\Model
{
	public $name;
	public $email;
	public $username;
	public $password;
	public $type;

	public $userObject;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['name', 'email', 'username', 'password', 'type'], 'required'],
			[['username'], 'string', 'max' => 32],
			[['name', 'email'], 'string', 'max' => 64],
			[['password'], 'string', 'max' => 128],
			['email', 'email'],
			['email', 'validateEmail'],
			['username', 'validateUsername'],
		];
	}

	public function validateEmail($args)
	{
		$user = $this->userObject->getRecordByEmailArray($this->email);
		if(is_array($user) && !empty($user)) {
			$this->addError('email', 'Please select different email address');
		}
	}

	public function validateUsername($args)
	{
		$user = $this->userObject->getRecordByUsernameArray($this->username);
		if(is_array($user) && !empty($user)) {
			$this->addError('username', 'Please select different username');
		}
	}
}