<?php

namespace Report\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Report\Model\Month;

class MonthController extends AbstractActionController
{

    protected $ipaddressTable = null;
    protected $stationTable = null;
    public function getIPAddressTable()
    {
        if (!$this->ipaddressTable) {
            $sm = $this->getServiceLocator();
            $this->ipaddressTable = $sm->get('Report\Model\IPAddressTable');
        }
        return $this->ipaddressTable;
    }
    
    public function getStationTable()
    {
        if(!$this->stationTable){
            $sm = $this->getServiceLocator();
            $this->stationTable = $sm->get('Report\Model\StationTable');
        }
        return $this->stationTable;
    }
   

    public function indexAction()
    {
        
        return new ViewModel(array(
            'ipaddresses' => $this->getIPAddressTable()->fetchAll(),
            'months' => Month::$month,
        ));
    }

    public function ipAction()
    {
        $ip = $this->getRequest()->getPost('ip',0);
        return new ViewModel(array(
            'ip' => $ip,
            'month' => $this->getIPAddressTable()->getMonth(),
            'ipaddresses' => $this->getIPAddressTable()->getReportbyIP($ip),
        ));
    }

    public function stationAction()
    {
        $sid = $this->getRequest()->getPost('sid',0);
        $month = $this->getRequest()->getPost('month',0);
        
        if($month == 0){
           $month =  Month::getCurrentMonth();
        }
        $monthName = Month::getMonthName($month);
        $month = Month::getCurrentYear()."-".$month;
        return new ViewModel(array(
                'station' => $this->getStationTable()->getStationbyCode($sid),
                'ipaddresses' => $this->getIPAddressTable()->getReportbyStation($sid,$month),
                'month' => $monthName,
                ));
    }


}

