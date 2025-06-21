<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m250620_130148_create_orders_table extends Migration
{
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(), // integer
            'name' => $this->string()->notNull(), // string
            'date' => $this->date()->notNull(), // date
            'status' => $this->string()->notNull(), // string
            'items' => $this->text(), // JSON или текстовое поле для хранения элементов заказа
            'total_price' => $this->integer()->notNull(), // integer
        ]);
    }
    public function down()
    {
        $this->dropTable('order');
    }
}
