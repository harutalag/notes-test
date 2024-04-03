<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notes_has_tags".
 *
 * @property int $id
 * @property int|null $note_id
 * @property int|null $tag_id
 *
 * @property Notes $note
 * @property Tags $tag
 */
class NotesHasTags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes_has_tags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note_id', 'tag_id'], 'integer'],
            [['note_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notes::class, 'targetAttribute' => ['note_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::class, 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'note_id' => 'Note ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * Gets query for [[Note]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNote()
    {
        return $this->hasOne(Notes::class, ['id' => 'note_id']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::class, ['id' => 'tag_id']);
    }
}
