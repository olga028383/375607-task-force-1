<?php

use yii\db\Migration;

/**
 * Class m191202_174207_create_table_profiles
 */
class m191202_174207_create_table_profiles extends Migration
{
    public function up()
    {
        $this->createTable('profiles', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'avatar' => $this->char(100),
            'birthday' => $this->date()->notNull(),
            'biography' => $this->text(),
            'rating' => $this->integer(),
            'view_count' => $this->integer(),
            'order_count' => $this->integer(),
            'phone' => $this->char(100),
            'skype' => $this->char(100),
            'other_connect' => $this->char(200),
            'notification_message' => $this->tinyInteger(1),
            'notification_task_action' => $this->tinyInteger(1),
            'notification_reviews' => $this->tinyInteger(1),
            'show_contacts_customer' => $this->tinyInteger(1),
            'show_profile' => $this->tinyInteger(1),
            'last_active_at' => $this->dateTime()->notNull()
        ]);

        $this->addForeignKey(
            'fk-profiles-user_id',
            'profiles',
            'user_id',
            'users',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-profiles-user_id',
            'profiles'
        );

        $this->dropTable('profiles');
    }
}
