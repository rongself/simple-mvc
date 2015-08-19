<?php
return array(
    'applicationNamespace' => 'Application',
    'viewDir' => '/view',
    'routerOptions'  => array(
        'defaultModule' => 'game',
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
    'wechat' => array(
        'appId'         => 'wx8db058757c34fb87',
        'token'        => '0f4720c960dsa7sd87fgf87g5df889cbd59',
        'secret'      => '0f4720c960b90c702c3875df889cbd59',
        'encodingAESKey' => 'a4OaHdCLiwp6zzoKFHRZZSc9884DWtxUNOWWUSeUWgZ',
    ),
);