<?php

use yii\db\Migration;

/**
 * Class m180122_202800_add_table_attribute_2_product
 */
class m180122_202800_add_table_attribute_2_product extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%attribute2product}}', [
          'attribute_id' => $this->integer()->notNull(),
          'product_id' => $this->integer()->notNull(),
          'value' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-attribute2product-product_id-product_id', '{{%attribute2product}}', 'product_id', '{{%product}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-attribute2product-attribute_id-attribute_id', '{{%attribute2product}}', 'attribute_id', '{{%attribute}}', 'id', 'CASCADE');

        $this->addPrimaryKey('pk-attribute_id-product_id', '{{%attribute2product}}', ['attribute_id', 'product_id']);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-attribute2product-attribute_id-attribute_id', '{{%attribute2product}}');
        $this->dropForeignKey('fk-attribute2product-product_id-product_id', '{{%attribute2product}}');
        $this->dropTable('{{%attribute2product}}');
    }
}
