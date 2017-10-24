<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Description of SignForm
 *
 * @author зс
 */
class SignForm extends Model {
  //put your code here
  public $username;

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      ['username', 'trim'],
      ['username', 'required'],
      ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
      ['username', 'string', 'min' => 2, 'max' => 255],
    ];
  }

  /**
   * Signs user up.
   *
   * @return User|null the saved model or null if saving fails
   */
  public function signup() {

    if (!$this->validate()) {
      return null;
    }


    $user = new User();
    $user->username = $this->username;
    $user->setPassword($this->username);
    $user->generateAuthKey();
    $user->balans = 0;

    return $user->save() ? $user : null;
  }
}