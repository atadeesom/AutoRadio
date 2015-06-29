<?php
namespace Station;

use Station\Model\Station;
use Station\Model\StationTable;
use Api\Model\IPAddress;
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
                 'Station\Model\StationTable' =>  function($sm) {
                     $tableGateway = $sm->get('StationTableGateway');
                     $table = new StationTable($tableGateway);
                     return $table;
                 },
                 'StationTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Station());
                     return new TableGateway('station', $dbAdapter, null, $resultSetPrototype);
                 },
                 'model-proviceselect' => function($sm) {
                     $tableGateway = $sm->get('ProviceTableGateway');
                     $table = new Model\ProvinceTable($tableGateway);
                     return $table;
                 },
                 'ProviceTableGateway' => function ($sm){
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Model\Province());
                     return new TableGateway('province', $dbAdapter, null, $resultSetPrototype);
                 },
                    
             ),
         );
     }
}