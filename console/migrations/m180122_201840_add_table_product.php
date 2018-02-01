<?php

use yii\db\Migration;

/**
 * Class m180122_201840_add_table_product
 */
class m180122_201840_add_table_product extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'producer_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'price' => $this->float()->notNull()->defaultValue('0.0'),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-product-category_id-category_id', '{{%product}}', 'category_id', '{{%category}}', 'id', 'RESTRICT');
        $this->addForeignKey('fk-product-producer_id-producer_id', '{{%product}}', 'producer_id', '{{%producer}}', 'id', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-product-producer_id-producer_id', '{{%product}}');
        $this->dropForeignKey('fk-product-category_id-category_id', '{{%product}}');
        $this->dropTable('{{%product}}');
    }
}
