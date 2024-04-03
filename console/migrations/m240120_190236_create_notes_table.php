<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes}}`.
 */
class m240120_190236_create_notes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255),
            'text' => $this->text(),
            'order' => $this->integer()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'deleted_at' => $this->integer(11)
        ]);

        $this->createIndex('idx_notes_user_id', '{{%notes}}', 'user_id');

        $this->addForeignKey(
            'fk_notes_user_id',
            '{{%notes}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_notes_user_id', '{{%notes}}');
        $this->dropIndex('idx_notes_user_id', '{{%notes}}');

        $this->dropTable('{{%notes}}');
    }
}
