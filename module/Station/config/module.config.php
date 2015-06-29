<?php
 return array(
     'controllers' => array(
         'invokables' => array(
             'Station\Controller\Station' => 'Station\Controller\StationController',
         ),
     ),
     'router' => array(
         'routes' => array(
             'station' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/station[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Station\Controller\Station',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'station' => __DIR__ . '/../view',
         ),
     ),
 );