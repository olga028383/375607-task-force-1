<?php

use yii\db\Migration;

/**
 * Class m191202_175429_create_table_photos
 */
class m191202_175429_create_table_photos extends Migration
{
    public function up()
    {
        $this->createTable('photos', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'link' => $this->char(150),
        ]);

        $this->addForeignKey(
            'fk-photos-user_id',
            'photos',
            'user_id',
            'users',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey(
            'fk-photos-user_id',
            'photos'
        );

        $this->dropTable('photos');
    }
}
