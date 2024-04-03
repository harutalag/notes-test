<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes_has_tags}}`.
 */
class m240120_214218_create_notes_has_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes_has_tags}}', [
            'id' => $this->primaryKey(),
            'note_id' => $this->integer(11),
            'tag_id' => $this->integer(11),
        ]);


        $this->createIndex('idx_notes_has_tags_note_id', '{{%notes_has_tags}}', 'note_id');
        $this->createIndex('idx_notes_has_tags_tag_id', '{{%notes_has_tags}}', 'tag_id');

        $this->addForeignKey(
            'fk_notes_has_tags_note_id',
            '{{%notes_has_tags}}',
            'note_id',
            '{{%notes}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_notes_has_tags_tag_id',
            '{{%notes_has_tags}}',
            'tag_id',
            '{{%tags}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_notes_has_tags_note_id', '{{%notes_has_tags}}');
        $this->dropForeignKey('fk_notes_has_tags_tag_id', '{{%notes_has_tags}}');
        $this->dropIndex('idx_notes_has_tags_note_id', '{{%notes_has_tags}}');
        $this->dropIndex('idx_notes_has_tags_tag_id', '{{%notes_has_tags}}');

        $this->dropTable('{{%notes_has_tags}}');
    }
}
