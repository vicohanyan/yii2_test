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
            'product_code' => $this->integer()->defaultValue(0),
            'name'         => $this->string(),
            'description'  => $this->text(),
            'count'        => $this->tinyInteger(),
            'brand'        => $this->string(),
            'size'         => $this->integer(),
            'product_id'   => $this->integer(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%product}}');
    }
}
