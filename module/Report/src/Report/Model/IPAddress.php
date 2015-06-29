<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Report\Model;

/**
 * Description of IPAddress
 *
 * @author ctadeesom
 */
class IPAddress {
    public $id;
    public $ip_address;
    public $station_code;
    public $ip_city;
    public $ip_country;
    public $ip_coordinates;
    public $is_landed;
    public $created_when;
    public $end_when;
    public $created_by;
    
    public function exchangeArray($data){
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->ip_address = (!empty($data['ip_address'])) ? $data['ip_address'] : null;
        $this->station_code = (!empty($data['station_code'])) ? $data['station_code'] : null;
        $this->ip_city = (!empty($data['ip_city'])) ? $data['ip_city'] : null;
        $this->ip_country = (!empty($data['ip_country'])) ? $data['ip_country'] : null;
        $this->ip_coordinates = (!empty($data['ip_coordinates'])) ? $data['ip_coordinates'] : null;
        $this->is_landed = (!empty($data['is_landed'])) ? $data['is_landed'] : null;
        $this->created_when = (!empty($data['created_when'])) ? $data['created_when'] : null;
        $this->end_when = (!empty($data['end_when'])) ? $data['end_when'] : null;
        $this->created_by = (!empty($data['created_by'])) ? $data['created_by'] : null;
    }
}
