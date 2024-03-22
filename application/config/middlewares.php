<?php

/**
 *  Middleware mapping url to a permission
 */
$config['middlewares'] = [
    'admin/incidents/*' => 'incident_all',
    'admin/safety-tips/*' => 'safety_tip_all',
    'admin/clients/*' => 'client_all',
    'admin/pages/*' => 'pages_all',
    'admin/chats/*' => 'chats_all',
    'admin/settings/*' => 'settings_all',
];