<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Report\Model;

/**
 * Description of Month
 *
 * @author ctadeesom
 */
class Month {
    public static $month = array(
        "00"   => "This Month",
        "01"   => "January",
        "02"   => "February",
        "03"   => "March",
        "04"   => "April",
        "05"   => "May",
        "06"   => "June",
        "07"   => "July",
        "08"   => "August",
        "09"   => "September",
        "10"  => "October",
        "11"  => "November",
        "12"  => "December");
    
    public static $timezone = 'Asia/Bangkok';
            
    private static function setTimeZone()
    {
         date_default_timezone_set(Month::$timezone);
    }
    
    public static function getCurrentMonth(){
        Month::setTimeZone();
        return date('m');
    }
    
    public static function getCurrentYear(){
        Month::setTimeZone();
        return date('Y');
    }
    
    public static function getMonthName($month){
        return date("F",mktime(0,0,0,$month,1,Month::getCurrentYear()))." ".Month::getCurrentYear();
    }
   
}
