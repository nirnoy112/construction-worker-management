<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Drug_test_log extends NDP_Controller {

    function __construct() {

        parent::__construct();

        $this->loadAppData(true);

        $this->load->model('Drug_test_log_model');
        $this->load->model('Worker_model');
        $this->load->model('User_status_model');
        $this->load->model('Company_model');
        $this->load->model('Certification_model');
        $this->load->model('Site_model');
        $this->load->model('User_model');
        $this->load->model('EST_model');
        $this->load->model('Certification_model');
        $this->load->model('Respirator_clearance_model');
        $this->load->model('Report_model');
        $this->load->model('Drug_screening_model');
        $this->load->model('Non_ohs_drug_screening_model');
        
        $this->load->model('Medical_supply_model');
        
        $this->load->model('First_aid_model');
        
        $this->load->model('Vaccination_model');
        
        $this->load->model('Incident_model');

    }

    /*
     * Index for Time-Clock
     */
    public function index()
    {

        $data['user_session'] = $this->data;
        $data['drug_test_collectors'] = $this->User_model->get_all_drug_test_collectors();

        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        
        $query_rules = $this->data['dtc_rules'];
        $data['dtcRules'] = $query_rules;

        if(isset($_POST['run_dtc_filter'])) {

            $dtc_rules = $this->input->post('dtcRules');

            $this->updateUserSession('dtc_rules', $dtc_rules);
            redirect('drug_test_log/index');

        }

        if($query_rules['dateFrom'] && $query_rules['dateTo']) {

            $dfs = $query_rules['dateFrom'] . ' 00:00:00';
            $dts = $query_rules['dateTo'] . ' 23:59:59';

            $df = DateTime::createFromFormat('m-d-Y H:i:s', $dfs);
            $dt = DateTime::createFromFormat('m-d-Y H:i:s', $dts);

            $query_rules['dateFrom'] = strtotime($df->format('Y-m-d H:i:s'));
            $query_rules['dateTo'] = strtotime($dt->format('Y-m-d H:i:s'));

        }

        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('drug_test_log/index?');
        //$config['total_rows'] = $this->Time_clock_model->count_all_time_clock();
        $config['total_rows'] = $this->Drug_test_log_model->get_dtc_count($query_rules);
        $this->pagination->initialize($config);

        //$data['tc_records'] = $this->Time_clock_model->get_all_time_clock();
        $data['dtc_records'] = $this->Drug_test_log_model->get_dtc_records($query_rules, $params);
        //var_dump($query_rules);var_dump($params);die();
        
        $data['_view'] = 'drug_test_log/index';
        $this->load->view('layouts/main', $data);

    }

    /*
     * Add Collection Record
     */
    public function addCollection() {

        $data['user_session'] = $this->data;

        if(isset($_POST) && count($_POST) > 0) {

            $site = $this->input->post('siteId');

            $arr = explode('/', $site);

            $date = $this->input->post('date') . ' 00:00:00';
            $st = DateTime::createFromFormat('m-d-Y H:i:s', $date);

            $params = array(
                'collectorId' => (int) $this->input->post('collectorId'),
                'siteId' => (int) $arr[0],
                'companyId' => (int) $arr[1],
                'date' => strtotime($st->format('Y-m-d H:i:s')),
                'testCount' => $this->input->post('testCount')
            );

            $dtcId = $this->Drug_test_log_model->add_drug_test_log($params);

            redirect('drug_test_log/index');

        }
    }
    
}