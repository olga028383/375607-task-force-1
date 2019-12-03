<?php

use yii\db\Migration;

/**
 * Class m191202_175640_create_table_user_specialization_category
 */
class m191202_175640_create_table_user_specialization_category extends Migration
{
    public function up()
    {
        $this->createTable('user_specialization_category', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'categories_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-user_specialization_category-user_id',
            'user_specialization_category',
            'user_id',
            'users',
            'id'
        );

        $this->addForeignKey(
            'fk-user_specialization_category-categories_id',
            'user_specialization_category',
            'categories_id',
            'categories',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-user_specialization_category-city_id',
            'user_specialization_category'
        );

        $this->dropForeignKey(
            'fk-user_specialization_category-categories_id',
            'user_specialization_category'
        );

        $this->dropTable('user_specialization_category');

    }
}
