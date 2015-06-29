<?php
namespace Api;

use Api\Model\IPAddress;
use Api\Model\IPAddressTable;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
     {
         return array(
             'factories' => array( 
                 'Api\Model\IPAddressTable' =>  function($sm) {
                     $tableGateway = $sm->get('IPAddressTableGateway');
                     $table = new IPAddressTable($tableGateway);
                     return $table;
                 },
                'IPAddressTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new IPAddress());
                     return new TableGateway('ip_statistic', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
}
