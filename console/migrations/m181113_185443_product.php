<?php

use yii\db\Migration;

/**
 * Class m181113_185443_product
 */
class m181113_185443_product extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id'           => $this->primaryKey(),
            'product_code' => $this->integer(150)->defaultValue(0),
            'name'         => $this->string(255),
            'description'  => $this->text(),
            'count'        => $this->integer(150),
            'brand'        => $this->string(250),
            'size'         => $this->integer(150),
            'product_id'   => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%product}}');
    }
}
