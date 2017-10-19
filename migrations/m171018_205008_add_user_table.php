<?php

use yii\db\Migration;

class m171018_205008_add_user_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;

    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
    }

    $this->createTable('user', [
      'id' => $this->primaryKey(),
      'username' => $this->string()->notNull()->unique(),
      'auth_key' => $this->string(32)->notNull(),
      'password_hash' => $this->string()->notNull(),
      'created_at' => $this->integer()->notNull(),
      'updated_at' => $this->integer()->notNull(),
      'balans'=>$this->money()->defaultValue(0)
      ], $tableOptions);
  }

    public function safeDown()
    {
      $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171018_205008_add_user_table cannot be reverted.\n";

        return false;
    }
    */
}
