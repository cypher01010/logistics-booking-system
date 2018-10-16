<?php

namespace app\modules\user\forms;

use Yii;
use yii\base\Model;
use app\components\UserIdentity;

/**
 * LoginForm is the model behind the login form.
 */
class AdminLoginForm extends Model
{
	public $username;
	public $password;
	public $rememberMe = false;

	private $_user = false;

	public $user = NULL;
	public $securityKey = NULL;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// username and password are both required
			[['username', 'password'], 'required'],
			// rememberMe must be a boolean value
			['rememberMe', 'boolean'],
			// password is validated by validatePassword()
			['password', 'validatePassword'],
			['username', 'validateUserType'],
			['username', 'validateStatus'],
		];
	}

	/**
	 * @return array customized attribute labels
	 */
	public function attributeLabels()
	{
		return [
			'username' => 'Username',
			'password' => 'Password',
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();

			if (!$user || !$this->user->validatePassword(trim($this->password), $user->hash, $this->securityKey)) {
				$this->addError('username', '');
				$this->addError('password', 'Incorrect username or password.');
			}
		}
	}

	public function validateUserType($attribute, $params)
	{
		if (!$this->hasErrors()) {
			if($this->user->type != \app\models\User::USERTYPE_ADMIN && $this->user->type != \app\models\User::USERTYPE_SUPER_ADMIN) {
				$this->addError('username', '');
				$this->addError('password', 'Incorrect username or password.');
			}
		}
	}

	public function validateStatus($attribute, $params)
	{
		if (!$this->hasErrors()) {
			if($this->user->status != 'active') {
				$this->addError('username', '');
				$this->addError('password', 'Incorrect username or password.');
			}
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 * @return boolean whether the user is logged in successfully
	 */
	public function login()
	{
		if ($this->validate()) {
			$user = $this->getUser();

			//set the users session
			$this->setUserSession($user);

			return Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
		} else {
			return false;
		}
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUser()
	{
		if ($this->_user === false) {
			$this->user = $this->user->getRecordByUsername(trim($this->username));
			if($this->user !== NULL || !empty($this->user)) {
				$this->_user = UserIdentity::setUser($this->user);
			}
		}
		
		return $this->_user;
	}

	public function autoLogin()
	{
		$userRecord = $this->user->getRecordByUsername(trim($this->username));
		$user = UserIdentity::setUser($userRecord);

		//set the users session
		$this->setUserSession($user);
	}

	private function setUserSession($user)
	{
		Yii::$app->session->set('id', $user->id);
		Yii::$app->session->set('email', $user->email);
		Yii::$app->session->set('name', $user->name);
		Yii::$app->session->set('username', $user->username);
		Yii::$app->session->set('type', $user->type);
		Yii::$app->session->set('profilePicture', $user->profilePicture);
		Yii::$app->session->set('online', $user->online);
		Yii::$app->session->set('onlineStatus', $user->onlineStatus);
		Yii::$app->session->set('emailValidated', $user->emailValidated);
	}
}