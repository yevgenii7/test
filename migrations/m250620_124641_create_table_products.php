<?php

use yii\db\Migration;

class m250620_124641_create_table_products extends Migration
{
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(), // integer
            'name' => $this->string()->notNull(), // string
            'price' => $this->float()->notNull(), // float
            'description' => $this->string(), // string
        ]);
    }
    public function down()
    {
        $this->dropTable('product');
    }
}
