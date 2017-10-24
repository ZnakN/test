<?php

use yii\db\Migration;

class m171019_063411_add_transfer_history_table extends Migration {
  public $tab_name = 'transfer_history';

  public function safeUp() {
    $tableOptions = null;


    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
    }

    $this->createTable($this->tab_name, [
      'id' => $this->primaryKey(),
      'user_id_from' => $this->integer()->notNull(),
      'user_id_to' => $this->integer()->notNull(),
      'amount' => $this->money()->notNull(),
      'date_create' => $this->dateTime()->notNull(),
      ], $tableOptions);

    // add index for user_id_from
    $this->createIndex(
      'FK-th-user_id_from', $this->tab_name, 'user_id_from'
    );

    // add foreign key for table `transfer_history`
    $this->addForeignKey(
      'FK-th-user_id_from', $this->tab_name, 'user_id_from', 'user', 'id'
    );

    // add index for user_id_to
    $this->createIndex(
      'FK-th-user_id_to', $this->tab_name, 'user_id_to'
    );

    // add foreign key for table `transfer_history`
    $this->addForeignKey(
      'FK-th-user_id_to', $this->tab_name, 'user_id_to', 'user', 'id'
    );
  }

  public function safeDown() {

    // drops foreign key for table `transfer_history`
    $this->dropForeignKey(
      'FK-th-user_id_from', $this->tab_name
    );

    $this->dropIndex('FK-th-user_id_from', $this->tab_name);

    // drops foreign key for table `transfer_history`
    $this->dropForeignKey(
      'FK-th-user_id_to', $this->tab_name
    );

    $this->dropIndex('FK-th-user_id_to', $this->tab_name);


    $this->dropTable($this->tab_name);
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