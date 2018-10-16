<?php
namespace app\modules\settings\forms;

use Yii;
use yii\base\Model;

/**
 * ResetForm is the model behind the login form.
 */
class CronForm extends Model
{
	public $time;
	public $receiver;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			['time', 'required', 'message' => 'Required'],
			['receiver', 'required', 'message' => 'Required'],
		];
	}
}