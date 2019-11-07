<?php
$data = array(
    array(
        'pathCsv' => '/data/categories.csv',
        'tableName' => 'categories',
        'fields' => array()
    ),
    array(
        'pathCsv' => '/data/cities.csv',
        'tableName' => 'cities',
        'fields' => array(
            'lat' => 'float',
            'long' => 'float',
        )
    ),
    array(
        'pathCsv' => '/data/users.csv',
        'tableName' => 'users',
        'fields' => array(
            'city_id' => array('rand' => array(1,1109))
        )
    ),
    array(
        'pathCsv' => '/data/profiles.csv',
        'tableName' => 'profiles',
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
        'pathCsv' => '/data/notifications.csv',
        'tableName' => 'notifications',
        'fields' => array()
    ),
);


