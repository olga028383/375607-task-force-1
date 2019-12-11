<?php

use yii\db\Migration;

/**
 * Class m191202_182529_create_table_reviews
 */
class m191202_182529_create_table_reviews extends Migration
{
    public function up()
    {
        $this->createTable('reviews', [
            'id' => $this->primaryKey(),
            'sender_id' => $this->integer()->notNull(),
            'recipient_id' => $this->integer()->notNull(),
            'task_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'created' => $this->dateTime()->notNull(),
            'evaluation' => $this->integer(),
            'task_ready' => $this->tinyInteger(1)

        ]);

        $this->addForeignKey(
            'fk-reviews-task_id',
            'reviews',
            'task_id',
            'tasks',
            'id'
        );

        $this->addForeignKey(
            'fk-reviews-sender_id',
            'reviews',
            'sender_id',
            'users',
            'id'
        );

        $this->addForeignKey(
            'fk-reviews-recipient_id',
            'reviews',
            'recipient_id',
            'users',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-reviews-task_id',
            'reviews'
        );

        $this->dropForeignKey(
            'fk-reviews-sender_id',
            'reviews'
        );

        $this->dropForeignKey(
            'fk-reviews-recipient_id',
            'reviews'
        );

        $this->dropTable('reviews');

    }
}
