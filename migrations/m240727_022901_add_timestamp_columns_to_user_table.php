<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m240727_022901_add_timestamp_columns_to_user_table extends Migration
{
    public function safeUp()
    {
        // Thêm cột 'created_at' với kiểu timestamp và giá trị mặc định là CURRENT_TIMESTAMP
        $this->addColumn('{{%user}}', 'created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));

        // Thêm cột 'updated_at' với kiểu timestamp và giá trị mặc định là CURRENT_TIMESTAMP và cập nhật tự động
        $this->addColumn('{{%user}}', 'updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'));
    }

    public function safeDown()
    {
        // Xóa cột 'created_at'
        $this->dropColumn('{{%user}}', 'created_at');

        // Xóa cột 'updated_at'
        $this->dropColumn('{{%user}}', 'updated_at');
    }
}