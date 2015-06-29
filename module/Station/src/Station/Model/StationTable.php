<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Station\Model;

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
     
     public function getStation($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }
     
     public function saveStation(Station $station)
     {
         $data = array(
             'station_name' => $station->station_name,
             'station_address'  => $station->station_address,
             'station_province' => $station->station_province,
             'station_amphur' => $station->station_amphur,
             'contact_person' => $station->contact_person,
             'telephone' => $station->telephone,
             'register_ip' => $station->register_ip,
             'created_when' => $station->created_when,
             'created_by' => $station->created_by,
             'modify_when' => $station->modify_when,
             'modify_by' => $station->modify_by,
         );

         $id = (int) $station->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getStation($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Album id does not exist');
             }
         }
     }
     
     public function deleteStation($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
}
