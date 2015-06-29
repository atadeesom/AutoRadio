<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Api\Form;
use \Zend\Form\Form;
/**
 * Description of IPForm
 *
 * @author ctadeesom
 */
class IPForm extends Form{
    public function __construct($name = null) {
        parent::__construct('ipaddress');
        
        $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
        
        $this->add(array(
            'name' => 'ip_address',
            'type' => 'Hidden'
        ));
        
        $this->add(array(
            'name' => 'is_landed',
            'type' => 'Hidden'
        ));
        
        $this->add(array(
            'name' => 'created_when',
            'type' => 'Hidden'
        ));
        
        $this->add(array(
            'name' => 'created_by',
            'type' => 'Hidden'
        ));
    }
}
