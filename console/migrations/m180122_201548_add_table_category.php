<?php

use yii\db\Migration;

/**
 * Class m180122_201548_add_table_category
 */
class m180122_201548_add_table_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'name' => $this->string(191)->notNull()->unique(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-category-parent_id-category_id', '{{%category}}', 'parent_id', '{{%category}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-category-parent_id-category_id', '{{%category}}');
        $this->dropTable('{{%category}}');
    }
}
