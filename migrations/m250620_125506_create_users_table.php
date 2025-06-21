<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m250620_125506_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(), // integer
            'username' => $this->string()->notNull()->unique(), // string
            'password' => $this->string()->notNull(), // string
            'token' => $this->string(), // string
            'role' => $this->string()->notNull(), // string
        ]);
    }
    public function down()
    {
        $this->dropTable('user');
    }
}
