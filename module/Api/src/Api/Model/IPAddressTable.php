<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Api\Model;

use Zend\Db\TableGateway\TableGateway;
/**
 * Description of IPAddressTable
 *
 * @author ctadeesom
 */
class IPAddressTable {
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
     
     public function saveIPAddress(IPAddress $ipaddress)
     {
         $data = array(
             'ip_address' => $ipaddress->ip_address,
             'station_code' => $ipaddress->station_code,
             'is_landed'  => $ipaddress->is_landed,
             'created_when' => $ipaddress->created_when,
             'end_when' => $ipaddress->end_when,
             'created_by' => $ipaddress->created_by,
         );

         $id = (int) $ipaddress->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         }
     }
}
