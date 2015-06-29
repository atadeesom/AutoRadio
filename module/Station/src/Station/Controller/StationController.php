<?php

namespace Station\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use \Station\Form\StationForm;
use \Station\Model\Station;

class StationController extends AbstractActionController
{

    protected $stationTable = null;

    public function getStationTable()
    {
        if (!$this->stationTable) {
            $sm = $this->getServiceLocator();
            $this->stationTable = $sm->get('Station\Model\StationTable');
        }
        return $this->stationTable;
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'stations' => $this->getStationTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
        $tableGateway = $this->getServiceLocator()->get('model-proviceselect');
        $form = new StationForm($tableGateway);
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();
        $remoteAddr = $request->getServer('REMOTE_ADDR');
//        $details = json_decode(file_get_contents("http://ipinfo.io/{$remoteAddr}/json"));
//        $details->city;
        $form->get('register_ip')->setValue($remoteAddr);
         if ($request->isPost()) {
             $station = new Station();
             //$form->setInputFilter($station->getInputFilter());
             $form->setData($request->getPost());
             
             if ($form->isValid()) {
                 $station->exchangeArray($form->getData());
                 $this->getStationTable()->saveStation($station);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('station');
             }
             
//             echo '<pre>';
//             var_dump($form->getMessages());
//             exit();
         }
        return array('form' => $form);
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('station', array(
                 'action' => 'add'
             ));
         }

         // Get the Album with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $station = $this->getStationTable()->getStation($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('station', array(
                 'action' => 'index'
             ));
         }
         
         $tableGateway = $this->getServiceLocator()->get('model-proviceselect');
         $form  = new StationForm($tableGateway);
         $form->bind($station);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         $remoteAddr = $request->getServer('REMOTE_ADDR');
         $form->get('register_ip')->setValue($remoteAddr);
         if ($request->isPost()) {
             $form->setInputFilter($station->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getStationTable()->saveStation($station);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('station');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
    }

    public function deleteAction()
    {
        return new ViewModel();
    }

    public function detailsAction()
    {
        return new ViewModel();
    }

    public function registerAction()
    {
        // Register by user no need auth.
        $tableGateway = $this->getServiceLocator()->get('model-proviceselect');
        $form = new StationForm($tableGateway);
        $form->get('submit')->setValue('Register');
        $request = $this->getRequest();
        $remoteAddr = $request->getServer('REMOTE_ADDR');
        $form->get('register_ip')->setValue($remoteAddr);
         if ($request->isPost()) {
             $station = new Station();
             $form->setInputFilter($station->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $station->exchangeArray($form->getData());
                 $this->getStationTable()->saveStation($station);
                 // Redirect to list of albums
                 return $this->redirect()->toRoute('station');
             }
         }
         $this->layout('layout/user');
        return array('form' => $form);
    }


}

