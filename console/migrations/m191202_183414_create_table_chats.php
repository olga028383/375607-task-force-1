<?php

use yii\db\Migration;

/**
 * Class m191202_183414_create_table_chats
 */
class m191202_183414_create_table_chats extends Migration
{
    public function up()
    {
        $this->createTable('chats', [
            'id' => $this->primaryKey(),
            'executor_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'is_closed' => $this->tinyInteger(1)
        ]);

        $this->addForeignKey(
            'fk-chats-task_id',
            'chats',
            'task_id',
            'tasks',
            'id'
        );

        $this->addForeignKey(
            'fk-chats-executor_id',
            'chats',
            'executor_id',
            'users',
            'id'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-chats-task_id',
            'chats'
        );

        $this->dropForeignKey(
            'fk-chats-executor_id',
            'chats'
        );

        $this->dropTable('chats');
    }
}
