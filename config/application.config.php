<?php
return array(
    'applicationNamespace' => 'Application',
    'viewDir' => '/view',
    'routerOptions'  => array(
        'defaultModule' => 'index',
        'defaultController' => 'index',
        'defaultAction' => 'index',
    ),
    'db' => array(
        'default' => 'sqlite',
        'sqlite' => array(
            'class' => 'Core\DB\Sqlite',
            'path' => PROJECT_ROOT.'/data/db/dsf_game_wechat.s3db',
        )
    ),
);