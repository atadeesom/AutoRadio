<?php
 return array(
     'controllers' => array(
         'invokables' => array(
             'Report\Controller\Month' => 'Report\Controller\MonthController',
         ),
     ),
     'router' => array(
         'routes' => array(
             'report' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/report[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Report\Controller\Month',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'report' => __DIR__ . '/../view',
         ),
     ),
 );