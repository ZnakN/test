<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transfer_history".
 *
 * @property integer $id
 * @property integer $user_id_from
 * @property integer $user_id_to
 * @property string $amount
 * @property string $date_create
 */
class TransferHistory extends \yii\db\ActiveRecord {

  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'transfer_history';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['user_id_from', 'user_id_to', 'amount', 'date_create'], 'required'],
      [['user_id_from', 'user_id_to'], 'integer'],
      [['amount'], 'number'],
      [['date_create'], 'safe'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'user_id_from' => 'User Id From',
      'user_id_to' => 'User Id To',
      'amount' => 'Amount',
      'date_create' => 'Date Create',
    ];
  }

  public function getUser_from() {
    return $this->hasOne(User::className(), ['id' => 'user_id_from']);
  }

  public function getUser_to() {
    return $this->hasOne(User::className(), ['id' => 'user_id_to']);
  }
}