<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Station\Form;

/*
 * Import Relavant Library
 */

use Zend\Form\Form;
use Station\Model\ProvinceTable;


/**
 * Description of StationForm
 * Template for using station form for adding
 * @author ctadeesom
 */
class StationForm extends Form{

    protected $selectTable;
    public function __construct(ProvinceTable $selectTable)
     {
         $this->setProvinceTable($selectTable);
         // we want to ignore the name passed
         parent::__construct('station');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'station_name',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Station Name',
             ),
         ));
         
         $this->add(array(
             'name' => 'station_address',
             'type' => 'Textarea',
             'options' => array(
                 'label' => 'Station Address',
             ),
         ));
         
         $this->add(array(
             'name' => 'station_province',
             'type' => 'Zend\Form\Element\Select',
             'options' => array(
                 'label' => 'Station Provice',
                 'empty_option' => '--- Choose Province ---',
                 'value_options' => $this->getProvinceOptions(),
             )
         ));
//         $this->add(array(
//             'name' => 'stationProvince',
//             'type' => 'Text',
//             'options' => array(
//                 'label' => 'Station Provice',
//             )
//         ));
//         
         $this->add(array(
             'name' => 'station_amphur',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Station Amphur',
             ),
         ));
         
         $this->add(array(
             'name' => 'contact_person',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Contact Person',
             ),
         ));
         
         $this->add(array(
             'name' => 'telephone',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Telephone',
             ),
         ));
         
         $this->add(array(
             'name' => 'register_ip',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Register IP',
             ),
             'attributes' => array(
                'placeholder' => 'xxx.xxx.xxx.xxx',
                
            )
         ));
         $this->add(array(
             'name' => 'created_when',
             'type' => 'Hidden',
             
         ));
         
         $this->add(array(
             'name' => 'created_by',
             'type' => 'Hidden',
             'value' => '3' // Add by websites,
         ));
         
         $this->add(array(
             'name' => 'modify_by',
             'type' => 'Hidden',
         ));
         
         $this->add(array(
             'name' => 'modify_when',
             'type' => 'Hidden',
         ));
         
         
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Save',
                 'id' => 'submitbutton',
             ),
         ));
     }
    
    public function getProvinceTable(){
        return $this->selectTable;
    }
    
    public function setProvinceTable($selectTable){
        $this->selectTable = $selectTable;
    }
     
    public function getProvinceOptions()
    {
        $table = $this->getProvinceTable();
        $data  = $table->fetchAll();
 
        $selectData = array();
 
        foreach ($data as $selectOption) {
            $selectData[$selectOption->id] = $selectOption->provice;
        }
 
        return $selectData;
    }
    
    
}
