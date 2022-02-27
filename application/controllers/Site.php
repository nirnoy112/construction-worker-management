<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        
        $this->load->model('Site_model');
        
        $this->load->model('User_model');
        
        $this->load->model('Order_status_model');
        
        $this->load->model('Official_supply_model');
        
        $this->load->model('Medical_supply_model');
        
        $this->load->model('Inventory_order_model');
        
        $this->load->model('First_aid_model');
        
        $this->load->model('Vaccination_model');
        
        $this->load->model('Incident_model');

        $this->load->model('Non_dot_test_panel_model');
    }

    /*
     * Listing of sites
     */
    function index()
    {
        $data['user_session'] = $this->data;

        if($data['user_session']['roleId'] == 1 || $data['user_session']['roleId'] == 2) {

            $query_rules = $this->data['sf_rules'];
            $data['sfRules'] = $query_rules;

            if(isset($_POST['run_s_filter'])) {

                $sf_rules = $this->input->post('sfRules');
                $this->updateUserSession('sf_rules', $sf_rules);
                redirect('site/index');

            }

            $this->load->model('Company_model');
            $data['all_companies'] = $this->Company_model->get_all_companies();

            $this->load->model('Site_status_model');
            $data['all_site_statuses'] = $this->Site_status_model->get_all_site_statuses();
        
            $data['all_non_dot_test_panels'] = $this->Non_dot_test_panel_model->get_all_non_dot_test_panels();

            $data['main_sites'] = $this->Site_model->get_main_sites();

            $params['limit'] = RECORDS_PER_PAGE; 
            $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            
            $config = $this->config->item('pagination');
            $config['base_url'] = site_url('site/index?');
            $config['total_rows'] = $this->Site_model->get_all_sites_count($query_rules);
            $this->pagination->initialize($config);

            $data['sites'] = $this->Site_model->get_filtered_sites($query_rules, $params);
            
            $data['_view'] = 'site/index';
            $this->load->view('layouts/main',$data);

        }

    }

    /*
     * Adding a new site
     */
    function add()
    {   
        $data['user_session'] = $this->data;

        if($data['user_session']['roleId'] == 1 || $data['user_session']['roleId'] == 2) {

            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                    'statusId' => $this->input->post('statusId'),
                    'assignedCompanyId' => $this->input->post('assignedCompanyId'),
                    'isSubsite' => ($this->input->post('isSubsite') == 'YES') ? 'YES' : 'NO',
                    'parentSiteId' => ($this->input->post('isSubsite') == 'YES') ? $this->input->post('parentSiteId') : 0,
                    'siteName' => $this->input->post('siteName'),
                    'primaryContact' => $this->input->post('primaryContact'),
                    'emailAddress' => $this->input->post('emailAddress'),
                    'phoneNumber' => $this->input->post('phoneNumber'),
                    'faxNumber' => $this->input->post('faxNumber'),
                    'address1' => $this->input->post('address1'),
                    'address2' => $this->input->post('address2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipCode' => $this->input->post('zipCode'),
                    'der' => $this->input->post('der'),
                    'synergy' => ($this->input->post('synergy') == 'YES') ? 'YES' : 'NO',
                    'startTime' => $this->input->post('startTime'),
                    'endTime' => $this->input->post('endTime'),
                    'ndttPanelId' => $this->input->post('ndttPanelId'),
                    'ndttLotId' => $this->input->post('ndttLotId'),
                    'ndttExpDate' => $this->input->post('ndttExpDate')
                );
                
                $site_id = $this->Site_model->add_site($params);
                redirect('site/index');
            }
            else
            {
                $this->load->model('Site_status_model');
                $data['all_site_statuses'] = $this->Site_status_model->get_all_site_statuses();

                $data['main_sites'] = $this->Site_model->get_main_sites();

                $this->load->model('Company_model');
                $data['all_companies'] = $this->Company_model->get_all_companies();
        
                $non_dot_test_panels = $this->Non_dot_test_panel_model->get_all_non_dot_test_panels();

                $all_non_dot_test_panels = array();

                array_push($all_non_dot_test_panels, $non_dot_test_panels[0]);
                array_push($all_non_dot_test_panels, $non_dot_test_panels[3]);
                array_push($all_non_dot_test_panels, $non_dot_test_panels[1]);
                array_push($all_non_dot_test_panels, $non_dot_test_panels[2]);

                $data['all_non_dot_test_panels'] = $all_non_dot_test_panels;
                
                $data['_view'] = 'site/add';
                $this->load->view('layouts/main',$data);
            }

        }

    }  

    /*
     * Editing a site
     */
    function edit($id)
    {   
        $data['user_session'] = $this->data;

        $data['site'] = $this->Site_model->get_site($id);

        $data['staff'] = $this->User_model->get_all_staff();
        
        $data['first_aids'] = $this->First_aid_model->get_all_first_aids();
        $data['vaccinations'] = $this->Vaccination_model->get_all_vaccinations();
        
        $non_dot_test_panels = $this->Non_dot_test_panel_model->get_all_non_dot_test_panels();

        $all_non_dot_test_panels = array();

        array_push($all_non_dot_test_panels, $non_dot_test_panels[0]);
        array_push($all_non_dot_test_panels, $non_dot_test_panels[3]);
        array_push($all_non_dot_test_panels, $non_dot_test_panels[1]);
        array_push($all_non_dot_test_panels, $non_dot_test_panels[2]);

        $data['all_non_dot_test_panels'] = $all_non_dot_test_panels;

        $sid = $data['site']['id'];
        
        if(isset($data['site']['id']) && ($data['user_session']['roleId'] == 1 || $data['user_session']['roleId'] == 2))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                if(isset($_POST['site_edit'])) {

                    $params = array(
                        'statusId' => $this->input->post('statusId'),
                        'assignedCompanyId' => $this->input->post('assignedCompanyId'),
                        'isSubsite' => ($this->input->post('isSubsite') == 'YES') ? 'YES' : 'NO',
                        'parentSiteId' => ($this->input->post('isSubsite') == 'YES') ? $this->input->post('parentSiteId') : 0,
                        'siteName' => $this->input->post('siteName'),
                        'primaryContact' => $this->input->post('primaryContact'),
                        'emailAddress' => $this->input->post('emailAddress'),
                        'phoneNumber' => $this->input->post('phoneNumber'),
                        'faxNumber' => $this->input->post('faxNumber'),
                        'address1' => $this->input->post('address1'),
                        'address2' => $this->input->post('address2'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'zipCode' => $this->input->post('zipCode'),
                        'der' => $this->input->post('der'),
                        'synergy' => ($this->input->post('synergy') == 'YES') ? 'YES' : 'NO',
                        'startTime' => $this->input->post('startTime'),
                        'endTime' => $this->input->post('endTime'),
                        'ndttPanelId' => $this->input->post('ndttPanelId'),
                        'ndttLotId' => $this->input->post('ndttLotId'),
                        'ndttExpDate' => $this->input->post('ndttExpDate')
                    );

                    $this->Site_model->update_site($id,$params);            
                    redirect('site/index');

                }

                if(isset($_POST['inventory_order_add'])) {

                    $data['sid'] = $sid;

                    $osArray = $this->_getOfficialSupplies(0);

                    $data['official_supplies'] = $osArray;

                    $msArray = $this->_getMedicalSupplies(0);

                    $data['medical_supplies'] = $msArray;

                    $order = array(

                        'osLocation' => '',
                        'osDate' => date('m-d-Y'),
                        'osAddressLine1' => '',
                        'osAddressLine2' => '',
                        'osSubTotal' => 00.00,
                        'osTotal' => 00.00,
                        'msLocation' => '',
                        'msDate' => date('m-d-Y'),
                        'msAddressLine1' => '',
                        'msAddressLine2' => '',
                        'msSubTotal' => 00.00,
                        'msTotal' => 00.00
                    
                    );

                    $data['order'] = $order;

                    $data['_modal'] = 'inventory/inventory-order-modal';

                    //var_dump($data);
                    //die();


                }

                if(isset($_POST['receive_inventory_order'])) {

                    $ioId = $this->input->post('invOrdrId');
                    
                    $ioParams = array(
                        'statusId' => 4
                    );

                    $this->Inventory_order_model->update_inventory_order($ioId, $ioParams);

                }

                if(isset($_POST['edit_inventory_order'])) {

                    $data['sid'] = $sid;

                    $ioId = (int) $this->input->post('invOrdrId');

                    //$osArray = $this->_getOfficialSupplies($data['ioId']);

                    $order = $this->Inventory_order_model->get_inventory_order($ioId);

                    $osJson = $order['osJson'];

                    $official_supplies = json_decode($osJson);

                    $msJson = $order['msJson'];

                    $medical_supplies = json_decode($msJson);

                    

                    //var_dump($official_supplies);
                    //die();

                    $data['ioId'] = $ioId;

                    $data['order'] = $order;

                    $data['official_supplies'] = $official_supplies;

                    $data['medical_supplies'] = $medical_supplies;

                    $data['_modal'] = 'inventory/edit-inventory-order-modal';


                }

                if(isset($_POST['io_edit'])) {

                    $ioId = (int) $this->input->post('ioId');

                    $inventoryOrder = $this->input->post('order');

                    $officialSupplies = $this->input->post('os');

                    $emailedTo = $this->input->post('emailedTo');

                    $sendingOption = $this->input->post('sendingOption');

                    $ofcS = array();

                    $ot = 0.0;

                    foreach ($officialSupplies as $os) {

                        $lt = (float) $os['quantity'] * (float) $os['unitPrice'];

                        $ot = $ot + $lt;

                        $o = array(

                            'description' => $os['description'],
                            'quantity' => (float) $os['quantity'],
                            'unitPrice' => (float) $os['unitPrice'],
                            'lineTotal' => (float) $lt

                        );

                        array_push($ofcS, $o);

                    }

                    $inventoryOrder['osSubTotal'] = $ot;

                    $inventoryOrder['osTotal'] = $ot;

                    $medicalSupplies = $this->input->post('ms');

                    $medS = array();

                    $mt = 0.0;

                    foreach ($medicalSupplies as $ms) {

                        $lt = (float) $ms['quantity'] * (float) $ms['unitPrice'];

                        $mt = $mt + $lt;

                        $m = array(

                            'description' => $ms['description'],
                            'quantity' => (float) $ms['quantity'],
                            'unitPrice' => (float) $ms['unitPrice'],
                            'lineTotal' => (float) $lt

                        );

                        array_push($medS, $m);

                    }

                    $inventoryOrder['msSubTotal'] = $mt;

                    $inventoryOrder['msTotal'] = $ot + $mt;

                    $osJson = json_encode($ofcS);

                    $inventoryOrder['osJson'] = $osJson;

                    $msJson = json_encode($medS);

                    $inventoryOrder['msJson'] = $msJson;

                    $inventoryOrder['sendingOption'] = $sendingOption;

                    //var_dump($inventoryOrder);
                    //die();

                    $this->Inventory_order_model->update_inventory_order($ioId, $inventoryOrder);

                    if($emailedTo && $sendingOption) {

                        $this->sendOrder($ioId, $emailedTo, $sendingOption);

                    }

                }


                if(isset($_POST['save_inventory_order'])) {

                    $inventoryOrder = $this->input->post('order');

                    $officialSupplies = $this->input->post('os');

                    $sendingOption = $this->input->post('sendingOption');

                    $emailedTo = $this->input->post('emailedTo');

                    $ofcS = array();

                    $ot = 0.0;

                    foreach ($officialSupplies as $os) {

                        $lt = (float) $os['quantity'] * (float) $os['unitPrice'];

                        $ot = $ot + $lt;

                        $o = array(

                            'description' => $os['description'],
                            'quantity' => (float) $os['quantity'],
                            'unitPrice' => (float) $os['unitPrice'],
                            'lineTotal' => (float) $lt

                        );

                        array_push($ofcS, $o);

                    }

                    $inventoryOrder['osSubTotal'] = $ot;

                    $inventoryOrder['osTotal'] = $ot;

                    $medicalSupplies = $this->input->post('ms');

                    $medS = array();

                    $mt = 0.0;

                    foreach ($medicalSupplies as $ms) {

                        $lt = (float) $ms['quantity'] * (float) $ms['unitPrice'];

                        $mt = $mt + $lt;

                        $m = array(

                            'description' => $ms['description'],
                            'quantity' => (float) $ms['quantity'],
                            'unitPrice' => (float) $ms['unitPrice'],
                            'lineTotal' => (float) $lt

                        );

                        array_push($medS, $m);

                    }

                    $inventoryOrder['msSubTotal'] = $mt;

                    $inventoryOrder['msTotal'] = $ot + $mt;

                    $osJson = json_encode($ofcS);

                    $inventoryOrder['osJson'] = $osJson;

                    $msJson = json_encode($medS);

                    $inventoryOrder['msJson'] = $msJson;

                    $inventoryOrder['creatingTime'] = time();

                    $inventoryOrder['statusId'] = 2;

                    $inventoryOrder['sendingOption'] = $sendingOption;

                    //var_dump($inventoryOrder);
                    //die();

                    $addedOrderId = $this->Inventory_order_model->add_inventory_order($inventoryOrder);

                    if($emailedTo && $sendingOption) {

                        $this->sendOrder($addedOrderId, $emailedTo, $sendingOption);

                    }


                }

                if(isset($_POST['send_io_email'])) {

                    $sioId = (int) $this->input->post('sioId');

                    $option = $this->input->post('emailOption');

                    $order = $this->Inventory_order_model->get_inventory_order($sioId);

                    $osJson = $order['osJson'];

                    $official_supplies = json_decode($osJson);

                    $msJson = $order['msJson'];

                    $medical_supplies = json_decode($msJson);

                    $order['official_supplies'] = $official_supplies;

                    $order['medical_supplies'] = $medical_supplies;

                    //var_dump($order); die();

                    $orderFile = $this->pOrder($order, $option);

                    $toEmail = $this->input->post('emailTo');

                    $message = 'You just have been sent an Inventory Order from OHS Training & Consulting, Inc. Check the attached PDF to view the Inventory Order.';

                    $subject = 'Inventory Order Received.';
                    
                    $this->sendEmail($toEmail, $subject, $message, $orderFile);

                }

                if(isset($_POST['edit_incident'])) {

                    $iId = (int) $this->input->post('incidentId');

                    $inc = $this->Incident_model->get_incident($iId);

                    $msJson = $inc['msJson'];

                    $medical_supplies = json_decode($msJson);

                    $data['iId'] = $iId;

                    $data['incident'] = $inc;

                    $data['medical_supplies'] = $medical_supplies;

                    //var_dump($data); die();

                    $data['_modal'] = 'incident/incident-edit-modal';


                }

                if(isset($_POST['update_incident'])) {

                    $iId = (int) $this->input->post('iId');

                    $incident = $this->input->post('incident');

                    $siteDetails = $incident['siteId'];

                    $siteData = explode('|', $siteDetails);

                    $incident['siteId'] = (int) $siteData[0];

                    $medicalSupplies = $this->input->post('ms');

                    $medS = array();

                    $mt = 0.0;

                    foreach ($medicalSupplies as $ms) {

                        $lt = (float) $ms['quantity'] * (float) $ms['unitPrice'];

                        $mt = $mt + $lt;

                        $m = array(

                            'description' => $ms['description'],
                            'quantity' => (float) $ms['quantity'],
                            'unitPrice' => (float) $ms['unitPrice'],
                            'lineTotal' => (float) $lt

                        );

                        array_push($medS, $m);

                    }

                    $incident['msTotal'] = $mt;

                    $msJson = json_encode($medS);
                    
                    $incident['msJson'] = $msJson;

                    $this->Incident_model->update_incident($iId, $incident);


                }

                $this->load->model('Site_status_model');
                $data['all_site_statuses'] = $this->Site_status_model->get_all_site_statuses();

                $data['all_order_statuses'] = $this->Order_status_model->get_all_order_statuses();

                $this->load->model('Company_model');
                $data['all_companies'] = $this->Company_model->get_all_companies();

                $data['all_sites'] = $this->Site_model->get_all_sites();

                $data['main_sites'] = $this->Site_model->get_main_sites();

                $data['incidents'] = $this->Incident_model->get_site_incidents($id);

                $data['all_inventory_orders'] = $this->Inventory_order_model->get_site_inventory_orders($sid);

                $data['_view'] = 'site/edit';
                $this->load->view('layouts/main',$data);
                
            }
            else
            {
				$this->load->model('Site_status_model');
				$data['all_site_statuses'] = $this->Site_status_model->get_all_site_statuses();

                $data['all_order_statuses'] = $this->Order_status_model->get_all_order_statuses();

				$this->load->model('Company_model');
				$data['all_companies'] = $this->Company_model->get_all_companies();

                $data['all_sites'] = $this->Site_model->get_all_sites();

                $data['main_sites'] = $this->Site_model->get_main_sites();

                $data['incidents'] = $this->Incident_model->get_site_incidents($id);


                $data['all_inventory_orders'] = $this->Inventory_order_model->get_site_inventory_orders($sid);

                $data['_view'] = 'site/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The site you are trying to edit does not exist.');
    } 

    /*
     * Deleting site
     */
    function remove($id)
    {
        $data['user_session'] = $this->data;
        $site = $this->Site_model->get_site($id);

        // check if the site exists before trying to delete it
        if(isset($site['id']) && ($data['user_session']['roleId'] == 1 || $data['user_session']['roleId'] == 2))
        {
            $this->Site_model->delete_site($id);
            redirect('site/index');
        }
        else
            show_error('The site you are trying to delete does not exist.');
    }

    private function _getMedicalSupplies($orderId) {

        $msArray = array();

        $index = 0;


        $mclSupplies = $this->Medical_supply_model->get_all_medical_supplies();


        if($orderId > 0) {

            $order = $this->Inventory_order_model->get_inventory_order($orderId);

            $msJson = $order['msJson'];

            $msArray = json_decode($msJson);

        } else {


            foreach ($mclSupplies as $ms) {

                $singleMs = array(

                    'quantity' => 0,
                    'description' => $ms['description'],
                    'unitPrice' => $ms['unitPrice'],
                    'lineTotal' => 00.00

                );

                $msArray[$index] = $singleMs;

                $index = $index + 1;
                
            }


        }


        return $msArray;

    }

    private function _getOfficialSupplies($orderId) {

        $osArray = array();

        $index = 0;


        $ofcSupplies = $this->Official_supply_model->get_all_official_supplies();


        if($orderId > 0) {

            $order = $this->Inventory_order_model->get_inventory_order($orderId);

            $osJson = $order['osJson'];

            $osArray = json_decode($osJson);

        } else {


            foreach ($ofcSupplies as $os) {

                $singleOs = array(

                    'quantity' => 0,
                    'description' => $os['description'],
                    'unitPrice' => $os['unitPrice'],
                    'lineTotal' => 00.00

                );

                $osArray[$index] = $singleOs;

                $index = $index + 1;
                
            }


        }


        return $osArray;

    }

    private function pOrder($order, $option) {

        $dirPDF = FCPATH . 'resources/inventoryOrders/';

        $pdfFile = $dirPDF . 'InventoryOrder_' . $order['id'] . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        $data = array(
            'order' => $order,
            'official_supplies' => $order['official_supplies'],
            'medical_supplies' => $order['medical_supplies'],
            'official' => ($option == 'official' || $option == 'both') ? 1 : 0,
            'medical' => ($option == 'medical' || $option == 'both') ? 1 : 0,
        );

        $content = $this->load->view('print/inventory-order', $data, true);

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

    }

    private function sendOrder($id, $email, $option) {

        $order = $this->Inventory_order_model->get_inventory_order($id);

        $osJson = $order['osJson'];

        $official_supplies = json_decode($osJson);

        $msJson = $order['msJson'];

        $medical_supplies = json_decode($msJson);

        $order['official_supplies'] = $official_supplies;

        $order['medical_supplies'] = $medical_supplies;

        //var_dump($order); die();

        $orderFile = $this->pOrder($order, $option);

        $message = 'You just have been sent an Inventory Order from OHS Training & Consulting, Inc. Check the attached PDF to view the Inventory Order.';

        $subject = 'Inventory Order Received.';
        
        $this->sendEmail($email, $subject, $message, $orderFile);

    }

    public function search() {


        $response = array();

        try {

            $name = $this->input->get('key');

            $sites = $this->Site_model->get_sites_by_name($name);
            //var_dump($sites);die();

            $response['status'] = 200;
            $response['sites'] = $sites;
            $response['count'] = ($sites != null) ? count($sites) : 0;

            $responseJSON = json_encode($response);

            echo $responseJSON;


        } catch(Exception $ex) {

            $response['status'] = 500;
            $response['sites'] = null;
            $response['count'] = 0;
            $response['message'] = $ex->getMessage();

            $responseJSON = json_encode($response);

            echo $responseJSON;

        }

    }
    
}
