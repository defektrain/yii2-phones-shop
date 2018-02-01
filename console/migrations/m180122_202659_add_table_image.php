<?php

use yii\db\Migration;

/**
 * Class m180122_202659_add_table_image
 */
class m180122_202659_add_table_image extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-image-product_id-product_id', '{{%image}}', 'product_id', 'product', 'id', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-image-product_id-product_id', '{{%image}}');
        $this->dropTable('{{%image}}');
    }
}
