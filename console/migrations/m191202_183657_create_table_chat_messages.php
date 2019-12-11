<?php

use yii\db\Migration;

/**
 * Class m191202_183657_create_table_chat_messages
 */
class m191202_183657_create_table_chat_messages extends Migration
{
    public function up()
    {
        $this->createTable('chat_messages', [
            'id' => $this->primaryKey(),
            'sender_id' => $this->integer()->notNull(),
            'recipient_id' => $this->integer()->notNull(),
            'chat_id' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'created' => $this->dateTime()->notNull(),

        ]);

        $this->addForeignKey(
            'fk-chat_messages-chat_id',
            'chat_messages',
            'chat_id',
            'chats',
            'id'
        );

        $this->addForeignKey(
            'fk-chat_messages-sender_id',
            'chat_messages',
            'sender_id',
            'users',
            'id'
        );

        $this->addForeignKey(
            'fk-chat_messages-recipient_id',
            'chat_messages',
            'recipient_id',
            'users',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-chat_messages-chat_id',
            'chat_messages'
        );

        $this->dropForeignKey(
            'fk-chat_messages-sender_id',
            'chat_messages'
        );

        $this->dropForeignKey(
            'fk-chat_messages-recipient_id',
            'chat_messages'
        );

        $this->dropTable('chat_messages');
    }
}
