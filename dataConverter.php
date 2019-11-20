<?php
$data = array(
    array(
        'reader' => 'csv',
        'name' => 'categories',
        'fieldsForConvert' => array(
            'name' => 'string',
            'icon' => 'string'
        ),
        'fieldsRandom' => array()
    ),
    array(
        'reader' => 'csv',
        'name' => 'cities',
        'fieldsForConvert' => array(
            'city' => 'string',
            'lat' => 'float',
            'long' => 'float',
        ),
        'fieldsRandom' => array()
    ),
    array(
        'reader' => 'csv',
        'name' => 'users',
        'fieldsForConvert' => array(
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
            'city_id' => array('number' => array(1,1109))
        )
    ),
    array(
        'reader' => 'csv',
        'name' => 'profiles',
        'fieldsForConvert' => array(
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
            'user_id' => array('number' => array(1,20)),
            'notification_message' => array('number' => array(0,1)),
            'notification_task_action' => array('number' => array(0,1)),
            'notification_reviews' => array('number' => array(0,1)),
            'show_contacts_customer' => array('number' => array(0,1)),
            'show_profile' => array('number' => array(0,1)),
            'last_active_at' => array('date' => array('01.11.2019', '15.11.2019')),
        )
    ),
    array(
        'reader' => 'csv',
        'name' => 'notifications',
        'fieldsForConvert' => array(
            'name' => 'string'
        ),
        'fieldsRandom' => array()
    ),
    array(
        'reader' => 'csv',
        'name' => 'tasks',
        'fieldsForConvert' => array(
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
        'fieldsRandom' => array()
    ),
    array(
        'reader' => 'csv',
        'name' => 'reviews',
        'fieldsForConvert' => array(
            'evaluation'=> 'number',
            'created'=> 'string',
            'message'=> 'string',
            'sender_id' => 'number',
            'recipient_id' => 'number',
            'task_id' => 'number',
            'task_ready' => 'number',

        ),
        'fieldsRandom' => array(
            'sender_id' => array('number' => array(1,20)),
            'recipient_id' => array('number' => array(1,20)),
            'task_id' => array('number' => array(1,5)),
            'task_ready' => array('number' => array(0,1)),
        )
    ),
    array(
        'reader' => 'csv',
        'name' => 'chat_messages',
        'fieldsForConvert' => array(
            'chat_id' => 'number',
            'sender_id' => 'number',
            'recipient_id' => 'number',
            'created' => 'string',
            'message' => 'string',
        ),
        'fieldsRandom' => array(
            'chat_id' => array('number' => array(1,20)),
            'sender_id' => array('number' => array(1,20)),
            'recipient_id' => array('number' => array(1,20)),
        )
    ),
    array(
        'reader' => 'csv',
        'name' => 'responses',
        'fieldsForConvert' => array(
            'sum' => 'number',
            'user_id' => 'number',
            'task_id' => 'number',
            'created' => 'string',
            'message' => 'string',
        ),
        'fieldsRandom' => array(
            'user_id' => array('number' => array(1,20)),
            'task_id' => array('number' => array(1,20)),
        )
    ),
    array(
        'reader' => 'php',
        'name' => 'user_specialization_category',
        'rows' => array_fill(0, 20, array_fill(0, 2, ' ')),
        'fieldsForConvert' => array(
            'user_id' => 'number',
            'categories_id' => 'number'
        ),
        'fieldsRandom' => array(
            'user_id' =>  array('number' => array(1,20)),
            'categories_id' => array('number' => array(1,8))
        )
    ),
    array(
        'reader' => 'php',
        'name' => 'favourite_users',
        'rows' => array_fill(0, 20, array_fill(0, 2, ' ')),
        'fieldsForConvert' => array(
            'user_current' => 'number',
            'user_added' => 'number'
        ),
        'fieldsRandom' => array(
            'user_added' =>  array('number' => array(1,20)),
            'user_current' => array('number' => array(1,20))
        )
    ),
    array(
        'reader' => 'php',
        'name' => 'user_specialization_category',
        'rows' => array_fill(0, 20, array_fill(0, 3, ' ')),
        'fieldsForConvert' => array(
            'task_id' => 'number',
            'executor_id' => 'number',
            'is_closed' => 'number'
        ),
        'fieldsRandom' => array(
            'task_id' =>array('number' => array(1,5)),
            'executor_id' => array('number' => array(1,20)),
            'is_closed' => array('number' => array(0,1)),
        )
    ),

);

