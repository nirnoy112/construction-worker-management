<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_management extends NDP_Controller {

    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);

        $this->load->model('Site_model');
        
        $this->load->model('Order_status_model');
        
        $this->load->model('Inventory_order_model');

    } 

    /*
     * Listing of inventory orders
     */
    function index()
    {
        $data['user_session'] = $this->data;

        if($data['user_session']['roleId'] == 1) {

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

                redirect('inventory_management/index');

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

            if(isset($_POST['accept_inventory_order'])) {

                $ioId = $this->input->post('invOrdrId');
                
                $ioParams = array(
                    'statusId' => 3
                );

                $this->Inventory_order_model->update_inventory_order($ioId, $ioParams);

            }

            if($query_rules['dateFrom'] && $query_rules['dateTo']) {

                $dfs = $query_rules['dateFrom'] . ' 00:00:00';
                $dts = $query_rules['dateTo'] . ' 23:59:59';

                $df = DateTime::createFromFormat('m-d-Y H:i:s', $dfs);
                $dt = DateTime::createFromFormat('m-d-Y H:i:s', $dts);

                $query_rules['dateFrom'] = strtotime($df->format('Y-m-d H:i:s'));
                $query_rules['dateTo'] = strtotime($dt->format('Y-m-d H:i:s'));

            }

            $query_rules['CreatingUserId'] = 0;

            $data['all_order_statuses'] = $this->Order_status_model->get_all_order_statuses();

            $data['all_sites'] = $this->Site_model->get_all_sites();


            $params['limit'] = RECORDS_PER_PAGE; 
            $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            
            $config = $this->config->item('pagination');
            $config['base_url'] = site_url('inventory_management/index?');
            $config['total_rows'] = $this->Inventory_order_model->get_filtered_orders_count($query_rules);
            $this->pagination->initialize($config);

            $data['all_inventory_orders'] = $this->Inventory_order_model->get_filtered_orders($query_rules, $params);
            
            $data['_view'] = 'inventory/inventory-management';
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
    
}
