<?php

use yii\db\Migration;

/**
 * Class m191202_170137_create_table_categories
 */
class m191202_170137_create_table_categories extends Migration
{


    public function up()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->char(255)->notNull(),
            'icon' => $this->char(100)
        ]);
    }

    public function down()
    {
        $this->dropTable('categories');
    }

}
