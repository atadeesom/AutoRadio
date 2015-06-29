<?php

namespace Report\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class StationController extends AbstractActionController
{
    protected $ipaddressTable = null;

    public function getIPAddressTable()
    {
        if (!$this->ipaddressTable) {
            $sm = $this->getServiceLocator();
            $this->ipaddressTable = $sm->get('Report\Model\IPAddressTable');
        }
        return $this->ipaddressTable;
    }
    
    public function indexAction()
    {
        return new ViewModel(array(
            'ipaddresses' => $this->getIPAddressTable()->fetchAll(),
        ));
    }


}

