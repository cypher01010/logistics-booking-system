<?php
namespace app\modules\user\forms;

class RegisterForm extends \yii\base\Model
{
	public $companyName;
	public $companyPhone;
	public $postalCode;
	public $street;
	public $buildingName;
	public $unitNumber;
	public $contactPerson;
	public $contactNumber;
	public $email;
	public $password;

	public $userObject;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			['companyName', 'required', 'message' => 'Required'],
			['companyPhone', 'required', 'message' => 'Required'],
			['postalCode', 'required', 'message' => 'Required'],
			['street', 'required', 'message' => 'Required'],
			['buildingName', 'required', 'message' => 'Required'],
			['unitNumber', 'required', 'message' => 'Required'],
			['contactPerson', 'required', 'message' => 'Required'],
			['contactNumber', 'required', 'message' => 'Required'],
			['email', 'required', 'message' => 'Required'],
			['password', 'required', 'message' => 'Required'],

			[['contactPerson', 'email'], 'string', 'max' => 64],
			[['password'], 'string', 'max' => 128],
			['email', 'email'],
			['email', 'validateEmail'],
		];
	}

	public function validateEmail($args)
	{
		$user = $this->userObject->getRecordByEmailArray($this->email);
		if(is_array($user) && !empty($user)) {
			$this->addError('email', 'Please select different email address');
		}
	}
}