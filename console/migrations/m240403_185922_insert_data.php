<?php

use yii\db\Migration;

/**
 * Class m240403_185922_insert_data
 */
class m240403_185922_insert_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("INSERT INTO `notes` (`id`, `user_id`, `title`, `text`, `order`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 2, 'Note 1', 'wadwd', 0, 10, 1712166309, 1712166312, NULL),
(3, 1, 'Note 2', 'safe wefewf', 0, 10, 1712166366, 1712167893, NULL),
(4, 3, 'Note 3', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type speci', 0, 10, 1712167992, 1712167992, NULL),
(5, 1, 'Note 5', 'wadawd awd', 0, 10, 1712169406, 1712169406, NULL),
(6, 1, 'Note 6', 'asfwe fwefwe', 0, 10, 1712169416, 1712169416, NULL),
(7, 3, 'Note 7', 'afd qwefwef', 0, 10, 1712169517, 1712169517, NULL),
(8, 1, 'Note 8', 'awdawdaw', 0, 10, 1712169537, 1712169537, NULL);");

        $this->execute("INSERT INTO `tags` (`id`, `title`, `order`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tag 1', 0, 10, 1712167140, 1712167140, NULL),
(2, 'Tag 2', 0, 10, 1712167149, 1712167149, NULL),
(3, 'Tag 3', 0, 10, 1712167177, 1712167177, NULL),
(4, 'Tag 5', 0, 10, 1712167313, 1712167316, 1712167316);");
        $this->execute("INSERT INTO `notes_has_tags` (`id`, `note_id`, `tag_id`) VALUES
(7, 3, 1),
(8, 3, 2),
(9, 4, 3),
(10, 5, 2),
(11, 6, 3),
(12, 7, 3),
(13, 8, 2);
");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240403_185922_insert_data cannot be reverted.\n";

        return false;
    }
}
