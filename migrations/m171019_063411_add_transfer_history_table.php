<?php

use yii\db\Migration;

class m171019_063411_add_transfer_history_table extends Migration
{
    public function safeUp()
    {
      $tableOptions = null;

    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
    }

    $this->createTable('transfer_history', [
      'id' => $this->primaryKey(),
      'user_id_from' => $this->integer()->notNull(),
      'user_id_to' => $this->integer()->notNull(),
      'amount' => $this->money()->notNull(),
      'date_create' => $this->dateTime()->notNull(),
      
      ], $tableOptions);
  }

    public function safeDown()
    {
      $this->dropTable('transfer_history');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171019_063411_add_transfer_history_table cannot be reverted.\n";

        return false;
    }
    */
}
