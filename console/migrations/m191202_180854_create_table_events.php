<?php

use yii\db\Migration;

/**
 * Class m191202_180854_create_table_events
 */
class m191202_180854_create_table_events extends Migration
{
    public function up()
    {
        $this->createTable('events', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer()->notNull(),
            'notification_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'event_new' => $this->tinyInteger(1),
            'sent_on' => $this->dateTime()->notNull()
        ]);

        $this->addForeignKey(
            'fk-events-city_id',
            'events',
            'city_id',
            'cities',
            'id'
        );

        $this->addForeignKey(
            'fk-events-notification_id',
            'events',
            'notification_id',
            'notifications',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-events-city_id',
            'events'
        );

        $this->dropForeignKey(
            'fk-events-notification_id',
            'events'
        );

        $this->dropTable('events');

    }
}
