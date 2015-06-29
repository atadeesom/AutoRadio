<?php
namespace Station\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Imported Library
 */
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

/**
 * Description of Station
 *
 * @author ctadeesom
 */
class Station implements InputFilterAwareInterface{
     public $id;
     public $station_code;
     public $station_name;
     public $station_address;
     public $station_province;
     public $station_amphur;
     public $contact_person;
     public $telephone;
     public $register_ip;
     public $created_when;
     public $created_by;
     public $modify_when;
     public $modify_by;
     
     protected $inputFilter;   
     
     public function exchangeArray($data)
     {  
         $this->id   = (!empty($data['id'])) ? $data['id'] : null;
         $this->station_code = (!empty($data['station_code'])) ? $data['station_code'] : null;
         $this->station_name = (!empty($data['station_name'])) ? $data['station_name'] : null;
         $this->station_address  = (!empty($data['station_address'])) ? $data['station_address'] : null;
         $this->station_province = (!empty($data['station_province'])) ? $data['station_province'] : 0;
         $this->station_amphur = (!empty($data['station_amphur'])) ? $data['station_amphur'] : 0;
         $this->contact_person = (!empty($data['contact_person'])) ? $data['contact_person'] : null;
         $this->telephone = (!empty($data['telephone'])) ? $data['telephone'] : null;
         $this->register_ip = (!empty($data['register_ip'])) ? $data['register_ip'] : null;
         $this->created_when = (!empty($data['created_when'])) ? $data['created_when'] : null;
         $this->created_by = (!empty($data['created_by'])) ? $data['created_by'] : 0;
         $this->modify_when = (!empty($data['modify_when'])) ? $data['modify_when'] : null;
         $this->modify_by = (!empty($data['modify_by'])) ? $data['modify_by'] : null;
     }
     
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

//             $inputFilter->add(array(
//                 'name'     => 'id',
//                 'required' => true,
//                 'filters'  => array(
//                     array('name' => 'Int'),
//                 ),
//             ));

             $inputFilter->add(array(
                 'name'     => 'station_name',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

//             $inputFilter->add(array(
//                 'name'     => 'contact_person',
//                 'required' => true,
//                 'filters'  => array(
//                     array('name' => 'StripTags'),
//                     array('name' => 'StringTrim'),
//                 ),
//                 'validators' => array(
//                     array(
//                         'name'    => 'StringLength',
//                         'options' => array(
//                             'encoding' => 'UTF-8',
//                             'min'      => 1,
//                             'max'      => 100,
//                         ),
//                     ),
//                 ),
//             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
     
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
}
