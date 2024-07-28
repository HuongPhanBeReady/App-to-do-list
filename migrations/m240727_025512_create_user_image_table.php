<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_image}}`.
 */
class m240727_025512_create_user_image_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user_image}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name_file' => $this->string()->notNull(),
            'path' => $this->string()->notNull(),
            'deleted_at' => $this->dateTime()->null(),
        ]);

        // Thêm khóa ngoại cho cột `user_id`
        $this->addForeignKey(
            'fk-user_image-user_id',
            'user_image',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Xóa khóa ngoại cho cột `user_id`
        $this->dropForeignKey(
            'fk-user_image-user_id',
            'user_image'
        );

        $this->dropTable('{{%user_image}}');
    }
}