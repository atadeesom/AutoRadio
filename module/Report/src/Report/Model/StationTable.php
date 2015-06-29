<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Report\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Description of StationTable
 *
 * @author ctadeesom
 */
class StationTable {
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }
     
     public function getStationbyCode($code)
     {
         $rowset = $this->tableGateway->select(array('station_code' => $code));
         $row = $rowset->current();
         if(!$row){
             throw new Exception("Could not find station code $code");
         }
         return $row;
     }
}
