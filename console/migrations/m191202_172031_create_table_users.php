<?php

use yii\db\Migration;

/**
 * Class m191202_172031_create_table_users
 */
class m191202_172031_create_table_users extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'district' => $this->char(200),
            'lat' => $this->double(),
            'long' => $this->double(),
            'email' => $this->char(155)->notNull(),
            'name' => $this->char(155)->notNull(),
            'password' => $this->string(155)->notNull(),
            'registered' => $this->dateTime()->notNull()
        ]);

        $this->addForeignKey(
            'fk-users-city_id',
            'users',
            'city_id',
            'cities',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-users-city_id',
            'users'
        );

        $this->dropTable('users');
    }
}
