<?php
$data = array(
    array(
        'name' => 'categories',
        'fields' => array()
    ),
    array(
        'name' => 'cities',
        'fields' => array(
            'lat' => 'float',
            'long' => 'float',
        )
    ),
    array(
        'name' => 'users',
        'fields' => array(
            'city_id' => array('rand' => array(1,1109)),
            'lat' => 'float',
            'long' => 'float',
        )
    ),
    array(
        'name' => 'profiles',
        'fields' => array(
            'user_id' => array('rand' => array(1,20)),
            'notification_message' => array('rand' => array(0,1)),
            'notification_task_action' => array('rand' => array(0,1)),
            'notification_reviews' => array('rand' => array(0,1)),
            'show_contacts_customer' => array('rand' => array(0,1)),
            'show_profile' => array('rand' => array(0,1)),
            'last_active_at' => array('date' => array('01.11.2019', '15.11.2019')),
        )
    ),
    array(
        'name' => 'notifications',
        'fields' => array()
    ),
    array(
        'name' => 'tasks',
        'fields' => array(
            'category_id' => 'int',
            'sum' => 'int',
            'lat' => 'float',
            'long' => 'float',
            'customer_id' => 'int',
            'executor_id' => 'int'
        )
    ),
    array(
        'name' => 'reviews',
        'fields' => array(
            'sender_id' => array('rand' => array(1,20)),
            'recipient_id' => array('rand' => array(1,20)),
            'task_id' => array('rand' => array(1,5)),
            'task_ready' => array('rand' => array(0,1)),
            'evaluation'=> 'int'
        )
    ),
    array(
        'name' => 'chat_messages',
        'fields' => array(
            'chat_id' => array('rand' => array(1,20)),
            'sender_id' => array('rand' => array(1,20)),
            'recipient_id' => array('rand' => array(1,20)),
        )
    ),
    array(
        'name' => 'responses',
        'fields' => array(
            'user_id' => array('rand' => array(1,20)),
            'task_id' => array('rand' => array(1,20)),
            'sum' => 'int',
        )
    ),
);


