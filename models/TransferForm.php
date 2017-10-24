<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\TransferHistory;
use app\models\User;
use app\components\UserTransferValidator;

/**
 * Description of SignForm
 *
 * @author зс
 */
class TransferForm extends Model {
  //put your code here
  public $username;
  public $amount;
  public $error_message = '';

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      // ['username', 'trim'],
      [['username', 'amount'], 'required'],
      // ['username', 'string', 'min' => 2, 'max' => 255],
      ['username', UserTransferValidator::className()],
      [['amount'], 'number', 'min' => 0],
      ['error_message', 'safe'],
    ];
  }

  public function scenarios() {
    $scenarios = [
      'some_scenario' => ['username'],
    ];

    return array_merge(parent::scenarios(), $scenarios);
  }

  /**
   * Signs user up.
   *
   * @return User|null the saved model or null if saving fails
   */
  public function transfer() {

    $res = false;
    if (!$this->validate()) {
      $this->error_message = $this->getErrors();
      return $res;
    }

    $user_from = User::findIdentity(Yii::$app->user->id);

    if ($user_from->username == $this->username) {
      $this->error_message = "You can't make transer sam self.";
      return $res;
    }



    if (!$user_from) {
      $this->error_message = 'User from not found';
      return $res;
    }

    $user_to = User::findByUsername($this->username);

    $transaction = Yii::$app->db->beginTransaction();


    if (!$user_to) {
      $user_to = new User();
      $user_to->username = $this->username;
      $user_to->setPassword($this->username);
      $user_to->generateAuthKey();
      $user_to->balans = 0;
      $user_to->save();
    }
    // Update balans user from 
    $user_from->balans = $user_from->balans - $this->amount;
    if (!$user_from->save()) {
      $transaction->rollBack();
      $this->error_message = "Can't save user from";
      return $res;
    }
    // Update balans user to
    $user_to->balans = $user_to->balans + $this->amount;
    if (!$user_to->save()) {
      $transaction->rollBack();
      $this->error_message = "Can't save user to";
      return $res;
    }

    // Create notes in history
    $th = new TransferHistory();
    $th->user_id_from = $user_from->id;
    $th->user_id_to = $user_to->id;
    $th->amount = $this->amount;
    $th->date_create = date('Y-m-d H:i:s');

    if (!$th->save()) {
      $transaction->rollBack();
      $this->error_message = "Can't save transfer history";
      return $res;
    }

    $transaction->commit();
    $res = true;

    return $res;
  }
}