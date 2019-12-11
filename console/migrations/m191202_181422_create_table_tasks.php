<?php

use yii\db\Migration;

/**
 * Class m191202_181422_create_table_tasks
 */
class m191202_181422_create_table_tasks extends Migration
{
    public function up()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'executor_id' => $this->integer(),
            'city_id' => $this->integer(),
            'district' => $this->char(200),
            'lat' => $this->double(),
            'long' => $this->double(),
            'name' => $this->char(255)->notNull(),
            'description' => $this->text()->notNull(),
            'sum' => $this->integer(),
            'status' => 'ENUM("new","on execution", "completed", "canceled", "failed")',
            'deadline' => $this->dateTime(),
            'created' => $this->dateTime()->notNull(),
            'closed' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'fk-tasks-category_id',
            'tasks',
            'category_id',
            'categories',
            'id'
        );

        $this->addForeignKey(
            'fk-tasks-customer_id',
            'tasks',
            'customer_id',
            'users',
            'id'
        );

        $this->addForeignKey(
            'fk-tasks-executor_id',
            'tasks',
            'executor_id',
            'users',
            'id'
        );

        $this->addForeignKey(
            'fk-tasks-city_id',
            'tasks',
            'city_id',
            'cities',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-tasks-category_id',
            'tasks'
        );

        $this->dropForeignKey(
            'fk-tasks-customer_id',
            'tasks'
        );

        $this->dropForeignKey(
            'fk-tasks-executor_id',
            'tasks'
        );

        $this->dropForeignKey(
            'fk-tasks-city_id',
            'tasks'
        );

        $this->dropTable('tasks');

    }
}
