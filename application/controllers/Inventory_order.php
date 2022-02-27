<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_order extends NDP_Controller {

    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);

        $this->load->model('Site_model');
        
        $this->load->model('Order_status_model');
        
        $this->load->model('Inventory_order_model');
        
        $this->load->model('Official_supply_model');
        
        $this->load->model('Medical_supply_model');

    } 

    /*
     * Listing of inventory orders
     */
    function index()
    {
        $data['user_session'] = $this->data;

        $data['all_sites'] = $this->Site_model->get_all_sites();

        if($data['user_session']['roleId'] == 2) {

            $query_rules = $this->data['iof_rules'];

            //var_dump($query_rules); die();
            $data['iofRules'] = $query_rules;

            if(isset($_POST['run_io_filter'])) {

                $siteOpts = $this->input->post('siteOpts');

                $siteIds = array();

                $sids = '';

                if($siteOpts != null) {

                    foreach ($siteOpts as $id) {
                        
                        array_push($siteIds, $id);
                        $sids .=  '/' . $id;

                    }

                }

                $iof_rules = $this->input->post('iofRules');

                $iof_rules['siteIds'] = $siteIds;

                $iof_rules['sids'] = $sids;

                //var_dump($iof_rules); die();
                $this->updateUserSession('iof_rules', $iof_rules);

                redirect('inventory_order/index');

            }

            if(isset($_POST['view_inventory_order'])) {

                $sioId = (int) $this->input->post('invOrdrId');

                $order = $this->Inventory_order_model->get_inventory_order($sioId);

                $osJson = $order['osJson'];

                $official_supplies = json_decode($osJson);

                $msJson = $order['msJson'];

                $medical_supplies = json_decode($msJson);

                $data['order'] = $order;

                $data['official_supplies'] = $official_supplies;

                $data['medical_supplies'] = $medical_supplies;

                $data['_modal'] = 'inventory/inventory-order-view';

            }

            if(isset($_POST['print_inventory_order'])) {

                $sioId = (int) $this->input->post('invOrdrId');

                $order = $this->Inventory_order_model->get_inventory_order($sioId);

                $osJson = $order['osJson'];

                $official_supplies = json_decode($osJson);

                $msJson = $order['msJson'];

                $medical_supplies = json_decode($msJson);

                $order['official_supplies'] = $official_supplies;

                $order['medical_supplies'] = $medical_supplies;

                $option = $order['sendingOption'];

                $orderFile = $this->pOrder($order, $option);

                $downloadableFile = array(
                    'filename' => 'InventoryOrder#' . $sioId . '_' . time() . '.pdf',
                    'mimetype' => 'application/pdf'
                );
                

                header('Content-disposition: attachment; filename='. $downloadableFile['filename']);
                header('Content-type: ' . $downloadableFile['mimetype']);
                header('Content-Length: ' . filesize($orderFile));

                ob_clean();
                ob_start();

                readfile($orderFile);

                ob_flush();
                flush();

                exit;

            }

            if(isset($_POST['ios_download'])) {

                $options = $this->input->post('downloadOptions');



                $sids = $this->input->post('siteOpts');

                $siteOpts = $this->input->post('siteOpts');

                $siteIds = array();

                if($siteOpts != null) {

                    foreach ($siteOpts as $id) {
                        
                        array_push($siteIds, $id);

                    }

                }

                $options['siteIds'] = $siteIds;

                if($options['dateFrom'] && $options['dateTo']) {

                    $dfs = $options['dateFrom'] . ' 00:00:00';
                    $dts = $options['dateTo'] . ' 23:59:59';

                    $df = DateTime::createFromFormat('m-d-Y H:i:s', $dfs);
                    $dt = DateTime::createFromFormat('m-d-Y H:i:s', $dts);

                    $options['dateFrom'] = strtotime($df->format('Y-m-d H:i:s'));
                    $options['dateTo'] = strtotime($dt->format('Y-m-d H:i:s'));

                }

                $options['CreatingUserId'] = $data['user_session']['id'];

                $params['limit'] = 1000; 
                $params['offset'] = 0;

                $inventory_orders = $this->Inventory_order_model->get_filtered_orders($options, $params);

                $ordersFile = $this->pOrders($inventory_orders);

                $downloadableFile = array(
                    'filename' => 'InventoryOrders.pdf',
                    'mimetype' => 'application/pdf'
                );
                

                header('Content-disposition: attachment; filename='. $downloadableFile['filename']);
                header('Content-type: ' . $downloadableFile['mimetype']);
                header('Content-Length: ' . filesize($ordersFile));

                ob_clean();
                ob_start();

                readfile($ordersFile);

                ob_flush();
                flush();

                exit;

            }

            if(isset($_POST['add_inventory_order'])) {

                $sid = $this->input->post('siteId');
                
                $data['sid'] = $sid;

                $data['site'] = $this->Site_model->get_site((int) $sid);

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

            if($query_rules['dateFrom'] && $query_rules['dateTo']) {

                $dfs = $query_rules['dateFrom'] . ' 00:00:00';
                $dts = $query_rules['dateTo'] . ' 23:59:59';

                $df = DateTime::createFromFormat('m-d-Y H:i:s', $dfs);
                $dt = DateTime::createFromFormat('m-d-Y H:i:s', $dts);

                $query_rules['dateFrom'] = strtotime($df->format('Y-m-d H:i:s'));
                $query_rules['dateTo'] = strtotime($dt->format('Y-m-d H:i:s'));

            }

            $query_rules['CreatingUserId'] = $data['user_session']['id'];

            $data['all_order_statuses'] = $this->Order_status_model->get_all_order_statuses();

            $data['all_sites'] = $this->Site_model->get_all_sites();


            $params['limit'] = RECORDS_PER_PAGE; 
            $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            
            $config = $this->config->item('pagination');
            $config['base_url'] = site_url('inventory_order/index?');
            $config['total_rows'] = $this->Inventory_order_model->get_filtered_orders_count($query_rules);
            $this->pagination->initialize($config);

            $data['all_inventory_orders'] = $this->Inventory_order_model->get_filtered_orders($query_rules, $params);
            
            $data['_view'] = 'inventory_order/index';
            $this->load->view('layouts/main',$data);

        }

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

    private function pOrders($inventory_orders) {

        $dirPDF = FCPATH . 'resources/inventoryOrders/';

        $pdfFile = $dirPDF . 'InventoryOrders.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        $data = array(
            'orders' => $inventory_orders
        );

        $content = $this->load->view('print/inventory-orders', $data, true);

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

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
    
}
