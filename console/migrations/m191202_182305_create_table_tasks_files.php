<?php

use yii\db\Migration;

/**
 * Class m191202_182305_create_table_tasks_files
 */
class m191202_182305_create_table_tasks_files extends Migration
{
    public function up()
    {
        $this->createTable('task_files', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'link' => $this->char(150)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-task_files-task_id',
            'task_files',
            'task_id',
            'tasks',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-task_files-task_id',
            'task_files'
        );

        $this->dropTable('task_files');
    }
}
