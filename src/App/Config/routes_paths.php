<?php
/**
 * Created by PhpStorm.
 * User: MiniTarlouf
 * Date: 19/07/2017
 * Time: 18:57
 */


return [
    'home' => [
        'method' => 'GET',
        'args_num' => 1,
        'args' => [],
        'action_route' => 'WaveNinja\\Action\\HomeAction',
        'responder_route'=> 'WaveNinja\\Responder\\HomeResponder'
    ],
    'error' => [
        'method' => 'GET',
        'args_num' => 2,
        'args'=>[],
        'action_route' => 'WaveNinja\\Action\\ErrorAction',
        'responder_route'=> 'WaveNinja\\Responder\\ErrorResponder'
        ]
];

