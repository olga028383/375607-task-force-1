<?php

use yii\db\Migration;

/**
 * Class m191202_183944_create_table_responses
 */
class m191202_183944_create_table_responses extends Migration
{
    public function up()
    {
        $this->createTable('responses', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'sum' => $this->integer(),
            'created' => $this->dateTime()->notNull(),

        ]);

        $this->addForeignKey(
            'fk-responses-task_id',
            'responses',
            'task_id',
            'tasks',
            'id'
        );

        $this->addForeignKey(
            'fk-responses-user_id',
            'responses',
            'user_id',
            'users',
            'id'
        );

    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-responses-task_id',
            'responses'
        );

        $this->dropForeignKey(
            'fk-responses-user_id',
            'responses'
        );

        $this->dropTable('responses');
    }
}
