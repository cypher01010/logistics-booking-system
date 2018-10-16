<?php
namespace app\modules\User\forms;

use Yii;
use yii\base\Model;

class RecoverForm extends Model
{
	public $email;
	public $userObject;
	public $userInfo;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			// email required
			['email', 'required'],
			// email must be valid email address
			['email', 'email'],
			// check email address
			['email', 'validateEmail'],
			['email', 'validateStatus'],
		];
	}

	/**
	 * @return array customized attribute labels
	*/
	public function attributeLabels()
	{
		return [
			'email' => 'Email',
		];
	}

	public function validateEmail($attribute, $params)
	{
		$this->userInfo = $this->userObject->getRecordByEmail($this->email);
		if(empty($this->userInfo) || $this->userInfo == NULL) {
			$this->addError('email', 'Sorry email address not found in our system');
		}
	}

	public function validateStatus($attribute, $params)
	{
		if($this->userInfo['status'] != 'active') {
			$this->addError('email', 'Sorry email address not found in our system');
		}
	}
}