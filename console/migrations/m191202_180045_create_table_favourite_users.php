<?php

use yii\db\Migration;

/**
 * Class m191202_180045_create_table_favourite_users
 */
class m191202_180045_create_table_favourite_users extends Migration
{
    public function up()
    {
        $this->createTable('favourite_users', [
            'id' => $this->primaryKey(),
            'user_current' => $this->integer(),
            'user_added' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-favourite_users-user_current',
            'favourite_users',
            'user_current',
            'users',
            'id'
        );

        $this->addForeignKey(
            'fk-favourite_users-user_added',
            'favourite_users',
            'user_added',
            'users',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-favourite_users-user_id',
            'favourite_users'
        );

        $this->dropForeignKey(
            'fk-favourite_users-user_added',
            'favourite_users'
        );

        $this->dropTable('favourite_users');

    }
}
