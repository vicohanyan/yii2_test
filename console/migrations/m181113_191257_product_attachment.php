<?php

use yii\db\Migration;

/**
 * Class m181113_191257_product_attachment
 */
class m181113_191257_product_attachment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product_attachment}}', [
            'id'           => $this->primaryKey(),
            'product_id'   => $this->integer()->notNull(),
            'attachment'   => $this->string(255)->notNull(),
        ], $tableOptions);

        // creates index for column `author_id`
        $this->createIndex(
            'idx-product-product_id',
            'product_attachment',
            'product_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-product-product_id',
            'product_attachment',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-product-product_id',
            'product'
        );

        $this->dropIndex(
            'idx-product-product_id',
            'product'
        );
        $this->dropTable('{{%product_attachment}}');
    }
}
