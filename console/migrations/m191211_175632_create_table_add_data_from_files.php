<?php

use yii\db\Migration;

/**
 * Class m191211_175632_create_table_add_data_from_files
 */
class m191211_175632_create_table_add_data_from_files extends Migration
{
    /**
     * @var array
     */
    private $tables = array(
        'categories',
        'cities',
        'users',
        'profiles',
        'user_specialization_category',
        'favourite_users',
        'notifications',
        'tasks',
        'reviews',
        'chats',
        'chat_messages',
        'responses'
    );

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191201_182935_add_data_from_files cannot be reverted.\n";

        return false;
    }

    /**
     * Добавляю
     */
    public function up()
    {
        $path = './htmlacademy/sql/sql_data/';
        foreach ($this->tables as $table) {
            $sql = file_get_contents($path . $table . '.sql');
            $this->execute($sql);
        }
    }

    /**
     *
     */
    public function down()
    {
        $reversTable = array_reverse($this->tables);
        foreach ($reversTable as $table) {
            $this->delete($table);
        }
    }
}
