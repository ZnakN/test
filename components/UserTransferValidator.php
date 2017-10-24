<?php
namespace app\components;

use Yii;
use yii\validators\Validator;
use app\models\User;


class UserTransferValidator extends Validator {
  
  
  public function init() {
    parent::init();
    $this->message = 'You can\'t make transfer sam self.';
  }
  
   public function validateAttribute($model, $attribute) {
    $value = $model->$attribute;
    $user = User::findIdentity(Yii::$app->user->id);
    if ($user->username == $value) {
      $model->addError($attribute, $this->message);
    }
  }
  
  public function clientValidateAttribute($model, $attribute, $view) {
    $user = User::findIdentity(Yii::$app->user->id);
    $username = $user->username;
    $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    return <<<JS
if (value == '$username') {
    messages.push($message);
}
JS;
  }
}