<?php
namespace Station\Model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Province
 *
 * @author ctadeesom
 */
class Province {
    public $id;
    public $provice;
    
    public function exchangeArray($data){
        $this->id   = (!empty($data['Province_ID'])) ? $data['Province_ID'] : null;
        $this->provice = (!empty($data['Province_Name'])) ? $data['Province_Name'] : null;
    }
}
