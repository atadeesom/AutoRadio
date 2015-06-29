<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;
use \Api\Model\IPAddress;
use \Api\Form\IPForm;
use Zend\Http\Headers;

class IpcounterController extends AbstractActionController
{
    protected $ipaddressTable = null;
    
    public function getIPAddressTable()
    {
        if (!$this->ipaddressTable) {
            $sm = $this->getServiceLocator();
            $this->ipaddressTable = $sm->get('Api\Model\IPAddressTable');
        }
        return $this->ipaddressTable;
    }
    public function indexAction()
    {
        return new ViewModel();
    }

    public function saveIPAction()
    {
        $request = $this->getRequest();
        $response = $this->getResponse();
            $response->getHeaders()->addHeaderLine('Access-Control-Allow-Origin', '*');
            $response->getHeaders()->addHeaderLine('Access-Control-Allow-Credentials', 'true');
            $response->getHeaders()->addHeaderLine('Access-Control-Allow-Methods', 'POST GET');

        if($request->isPost())
        {
         /**
          * TODO: get element from POST then save to db.
          */   
            $ipaddress = $this->setIPAddress($request);
            $this->getIPAddressTable()->saveIPAddress($ipaddress);
            
            $response->setStatusCode(200);
            $response->setContent('Save Completed');
        }else{
            $response->setStatusCode(500);
            $response->setContent('Abnormal caller');
        }
        return $response;
    }
    
    private function setIPAddress($request)
    {
        $ipaddress = new IPAddress();
        $ipaddress->station_code = $request->getPost('id', null);
        $ipaddress->ip_city = $request->getPost('ip_city', null);
        $ipaddress->ip_address = $request->getPost('ip', null);
        $ipaddress->is_landed = $request->getPost('is_landed', null);
        $ipaddress->created_by = 4; // API
        $ipaddress->created_when = null; 
        
        return $ipaddress;
    }

}

