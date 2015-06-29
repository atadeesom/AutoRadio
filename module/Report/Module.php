<?php
namespace Report;

use Report\Model\IPAddress;
use Report\Model\IPAddressTable;
use Report\Model\Station;
use Report\Model\StationTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
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
                 'Report\Model\IPAddressTable' =>  function($sm) {
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
                'Report\Model\StationTable' => function($sm){
                     $tableGateway = $sm->get('StationTableGateway');
                     $table = new StationTable($tableGateway);
                     return $table;
                },
                'StationTableGateway' => function($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Station());
                    return new TableGateway('station', $dbAdapter, null, $resultSetPrototype);
                },
             ),
         );
     }
}
