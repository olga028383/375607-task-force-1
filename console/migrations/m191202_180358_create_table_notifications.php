<?php

use yii\db\Migration;

/**
 * Class m191202_180358_create_table_notifications
 */
class m191202_180358_create_table_notifications extends Migration
{
    public function up()
    {
        $this->createTable('notifications', [
            'id' => $this->primaryKey(),
            'name' => 'ENUM("respond_new", "message_new", "task_start", "task_complete", "task_failed_executor")'
        ]);
    }

    public function down()
    {
        $this->dropTable('notifications');
    }

}
