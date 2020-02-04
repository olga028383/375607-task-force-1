<?php

use HtmlAcademy\Models\Readers\PhpReader;
use yii\db\Migration;
use HtmlAcademy\Models\Converters;
use HtmlAcademy\Models\Readers\CsvFileReader;
use HtmlAcademy\Models\Writes\SqlWriter;

/**
 * Class m191211_172907_generate_sql_files
 */
class m191211_172907_generate_sql_files extends Migration
{
    /**
     * @var array
     */
    private $data = array();


    private function setData()
    {
        $this->data = array(
            array(
                'reader' => 'csv',
                'name' => 'categories',
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'name' => 'string',
                    'icon' => 'string'
                ),
                'fieldsRandom' => array(),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'csv',
                'name' => 'cities',
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'city' => 'string',
                    'lat' => 'float',
                    'long' => 'float',
                ),
                'fieldsRandom' => array(),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'csv',
                'name' => 'users',
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'email' => 'string',
                    'city_id' => 'number',
                    'lat' => 'float',
                    'long' => 'float',
                    'name' => 'string',
                    'password' => 'string',
                    'registered' => 'string',
                    'district' => 'string',
                ),
                'fieldsRandom' => array(
                    'city_id' => array('number' => array(1, 1109))
                ),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'csv',
                'name' => 'profiles',
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'birthday' => 'string',
                    'biography' => 'string',
                    'phone' => 'string',
                    'skype' => 'string',
                    'user_id' => 'number',
                    'notification_message' => 'number',
                    'notification_task_action' => 'number',
                    'notification_reviews' => 'number',
                    'show_contacts_customer' => 'number',
                    'show_profile' => 'number',
                    'last_active_at' => 'string',

                ),
                'fieldsRandom' => array(
                    'notification_message' => array('number' => array(0, 1)),
                    'notification_task_action' => array('number' => array(0, 1)),
                    'notification_reviews' => array('number' => array(0, 1)),
                    'show_contacts_customer' => array('number' => array(0, 1)),
                    'show_profile' => array('number' => array(0, 1)),
                    'last_active_at' => array('date' => array('01.11.2019', '15.11.2019')),
                ),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'csv',
                'name' => 'notifications',
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'name' => 'string'
                ),
                'fieldsRandom' => array(),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'csv',
                'name' => 'tasks',
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'category_id' => 'number',
                    'sum' => 'number',
                    'lat' => 'float',
                    'long' => 'float',
                    'customer_id' => 'number',
                    'executor_id' => 'number',
                    'created' => 'string',
                    'description' => 'string',
                    'deadline' => 'string',
                    'name' => 'string',
                    'district' => 'string',
                    'status' => 'string',

                ),
                'fieldsRandom' => array(),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'csv',
                'name' => 'reviews',
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'evaluation' => 'number',
                    'created' => 'string',
                    'message' => 'string',
                    'sender_id' => 'number',
                    'recipient_id' => 'number',
                    'task_id' => 'number',
                    'task_ready' => 'number',

                ),
                'fieldsRandom' => array(
                    'sender_id' => array('number' => array(1, 20)),
                    'recipient_id' => array('number' => array(1, 20)),
                    'task_id' => array('number' => array(1, 5)),
                    'task_ready' => array('number' => array(0, 1)),
                ),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'csv',
                'name' => 'chat_messages',
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'chat_id' => 'number',
                    'sender_id' => 'number',
                    'recipient_id' => 'number',
                    'created' => 'string',
                    'message' => 'string',
                ),
                'fieldsRandom' => array(
                    'chat_id' => array('number' => array(1, 20)),
                    'sender_id' => array('number' => array(1, 20)),
                    'recipient_id' => array('number' => array(1, 20)),
                ),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'csv',
                'name' => 'responses',
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'sum' => 'number',
                    'user_id' => 'number',
                    'task_id' => 'number',
                    'created' => 'string',
                    'message' => 'string',
                ),
                'fieldsRandom' => array(
                    'user_id' => array('number' => array(1, 20)),
                    'task_id' => array('number' => array(1, 20)),
                ),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'php',
                'name' => 'user_specialization_category',
                'rows' => array_fill(0, 20, array_fill(0, 2, ' ')),
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'user_id' => 'number',
                    'categories_id' => 'number'
                ),
                'fieldsRandom' => array(
                    'user_id' => array('number' => array(1, 20)),
                    'categories_id' => array('number' => array(1, 8))
                ),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'php',
                'name' => 'favourite_users',
                'rows' => array_fill(0, 20, array_fill(0, 2, ' ')),
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'user_current' => 'number',
                    'user_added' => 'number'
                ),
                'fieldsRandom' => array(
                    'user_added' => array('number' => array(1, 20)),
                    'user_current' => array('number' => array(1, 20))
                ),
                'fieldIncrement' => 'id'
            ),
            array(
                'reader' => 'php',
                'name' => 'chats',
                'rows' => array_fill(0, 20, array_fill(0, 3, ' ')),
                'fieldsForConvert' => array(
                    'id' => 'number',
                    'task_id' => 'number',
                    'executor_id' => 'number',
                    'is_closed' => 'number'
                ),
                'fieldsRandom' => array(
                    'task_id' => array('number' => array(1, 5)),
                    'executor_id' => array('number' => array(1, 20)),
                    'is_closed' => array('number' => array(0, 1)),
                ),
                'fieldIncrement' => 'id'
            ),

        );
    }

    public function up()
    {
        $this->setData();

        foreach ($this->data as $key => $value) {

            $reader = '';

            switch ($value['reader']) {
                case 'php':
                    $reader = new PhpReader(array_keys($value['fieldsForConvert']), $value['rows']);
                    break;
                case 'csv':
                    $reader = new CsvFileReader('./htmlacademy/data/' . $value['name'] . '.csv');
                    break;

            }

            $writer = new SqlWriter('./htmlacademy/sql/sql_data/', $value['name'], $value['name']);
            $converter = new Converters\ConverterParticular($reader, $writer, $value['fieldsForConvert'], $value['fieldsRandom'], $value['fieldIncrement']);
            $converter->import();
        }

    }

    public function down()
    {

    }

}
