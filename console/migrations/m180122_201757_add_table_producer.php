<?php

use yii\db\Migration;

/**
 * Class m180122_201757_add_table_producer
 */
class m180122_201757_add_table_producer extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%producer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(191)->notNull()->unique(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%producer}}');
    }
}
