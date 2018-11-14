<?php

use yii\db\Migration;

/**
 * Class m181113_195815_category
 */
class m181113_195815_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id'           => $this->primaryKey(),
            'parent_id'    => $this->integer(),
            'name'         => $this->string()->notNull(),
        ], $tableOptions);

        // creates index for column `author_id`

    }

    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
