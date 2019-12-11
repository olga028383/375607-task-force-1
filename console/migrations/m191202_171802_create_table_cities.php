<?php

use yii\db\Migration;

/**
 * Class m191202_171802_create_table_cities
 */
class m191202_171802_create_table_cities extends Migration
{

    public function up()
    {
        $this->createTable('cities', [
            'id' => $this->primaryKey(),
            'city' => $this->char(255)->notNull(),
            'lat' => $this->double(),
            'long' => $this->double(),
        ]);
    }

    public function down()
    {
        $this->dropTable('cities');
    }

}
