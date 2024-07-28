<?php

use yii\db\Migration;

/**
 * Class m240719_191908_add_status_to_user_table
 */
class m240719_191908_add_status_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'status', $this->integer()->notNull()->defaultValue(9));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'status');
    }
}                                                                                                                                                                                                                                                                                                                                        