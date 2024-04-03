<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $order
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 *
 * @property NotesHasTags[] $notesHasTags
 */
class Tags extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const STATUS_LIST = [
        self::STATUS_DELETED => 'Not active',
        self::STATUS_ACTIVE => 'Active'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    ActiveRecord::EVENT_BEFORE_DELETE => ['deleted_at'],
                ],
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public static function find()
    {
        return parent::find()->andWhere(['deleted_at' => null]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'order' => 'Order',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * Gets query for [[NotesHasTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotesHasTags()
    {
        return $this->hasMany(NotesHasTags::class, ['tag_id' => 'id']);
    }

    public static function getList(){
        return ArrayHelper::map(self::find()->where(['status' => self::STATUS_ACTIVE])->andWhere(['deleted_at' => null])->all(), 'id', 'title');
    }
}
