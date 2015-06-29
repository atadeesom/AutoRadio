<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Report\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Where;
use \Zend\Db\Sql\Predicate\Like;
/**
 * Description of IPAddressTable
 *
 * @author ctadeesom
 */
class IPAddressTable {
    protected $tableGateway;
    
    protected $month;
    
    protected $monthName;
    
    public function __construct(TableGateway $tableGateway)
     {
        date_default_timezone_set('Asia/Bangkok');
         $this->tableGateway = $tableGateway;
         $this->getMonth();
     }
     
     public function getMonth(){
         
         $this->month = date('Y-m');
         $this->monthName = date('F Y');
         return $this->monthName;
     }

     public function fetchAll(){
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }
     
     public function getReportbyIP($ip){
         $where = new Where();
         $where->like('created_when', $this->month.'%');
         $where->like('ip_address', $ip);
         $resultSet = $this->tableGateway->select($where);
         return $resultSet;
     }
     
     public function getReportbyStation($sid,$month){
         $where = new Where();
         $where->like('station_code', $sid);
         $where->like('created_when', $month.'%');
         $resultSet = $this->tableGateway->select($where);
         return $resultSet;
     }
}
