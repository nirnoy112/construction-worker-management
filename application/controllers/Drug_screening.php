<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Drug_Screening extends NDP_Controller {

    function __construct() {

        parent::__construct();

        $this->loadAppData(true);

        $this->load->model('Time_clock_model');
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
        //var_dump($data['user_session']);die();
        $data['staff'] = $this->User_model->get_all_staff();
        
        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        
        $query_rules = $this->data['ds_rules'];
        $data['dsRules'] = $query_rules;

        if(isset($_POST['run_ds_filter'])) {

            $ds_rules = $this->input->post('dsRules');

            $this->updateUserSession('ds_rules', $ds_rules);
            redirect('drug_screening/index');

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
        $config['base_url'] = site_url('drug_screening/index?');
        $config['total_rows'] = $this->Drug_screening_model->drug_screenings_count($query_rules);
        $this->pagination->initialize($config);


        $data['drug_screenings'] = $this->Drug_screening_model->drug_screenings($query_rules, $params);


        //var_dump($query_rules);var_dump($params);die();
        
        $data['_view'] = 'drug_screening/index';

        $this->load->view('layouts/main', $data);

    }

    public function markAsCleared($id) {

        $data['user_session'] = $this->data;
        //var_dump($data['user_session']);die();

        $params = array(
            'testResult' => 'Inconclusive; Cleared',
            'inconclusiveDetails' => 'Cleared in LAB on ' . date('m-d-Y') . ' by ' . $data['user_session']['realName'] . ' (' . $data['user_session']['username'] .  ').'
        );

        $this->Drug_screening_model->update_drug_screening((int) $id, $params);

        redirect('drug_screening/index');

    }

    public function markAsFar($id) {

        $data['user_session'] = $this->data;
        //var_dump($data['user_session']);die();

        $params = array(
            'testResult' => 'FAR',
            'inconclusiveDetails' => 'Contact OHSTC For Further Information.'
        );

        $this->Drug_screening_model->update_drug_screening((int) $id, $params);

        redirect('drug_screening/index');

    }

    
}