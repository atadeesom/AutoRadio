<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Api\Controller\Ipcounter' => 'Api\Controller\IpcounterController',
         ),
     ),
     'router' => array(
         'routes' => array(
             'api' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/api[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Api\Controller\Ipcounter',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     
 );