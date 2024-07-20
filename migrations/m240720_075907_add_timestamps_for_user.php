<?php

use yii\db\Migration;

/**
 * Class m240720_075907_add_timestamps_for_user
 */
class m240720_075907_add_timestamps_for_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Thêm cột 'created_at' với kiểu timestamp và giá trị mặc định là CURRENT_TIMESTAMP
        $this->addColumn('{{%user}}', 'created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull());

        // Thêm cột 'updated_at' với kiểu timestamp và giá trị mặc định là CURRENT_TIMESTAMP và cập nhật tự động
        $this->addColumn('{{%user}}', 'updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP')->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Xóa cột 'created_at'
        $this->dropColumn('{{%user}}', 'created_at');

        // Xóa cột 'updated_at'
        $this->dropColumn('{{%user}}', 'updated_at');
    }
}