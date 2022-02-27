<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Time_clock extends NDP_Controller {

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

        date_default_timezone_set('America/New_York');

        $data['user_session'] = $this->data;
        $data['staff'] = $this->User_model->get_all_staff();
        
        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        
        $query_rules = $this->data['tc_rules'];
        $data['tcRules'] = $query_rules;

        $urtId = (int) $data['user_session']['roleId'];
        $clockedIn = (int) $data['user_session']['clocked_in'];
        //var_dump($urtId);var_dump($clockedIn);die();

        if(isset($_POST['run_tc_filter'])) {

            $tc_rules = $this->input->post('tcRules');

            $this->updateUserSession('tc_rules', $tc_rules);
            redirect('time_clock/index');

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
        $config['base_url'] = site_url('time_clock/index?');
        //$config['total_rows'] = $this->Time_clock_model->count_all_time_clock();
        $config['total_rows'] = $this->Time_clock_model->get_tc_count($query_rules);

        $this->pagination->initialize($config);


        $data['tc_records'] = $this->Time_clock_model->get_tc_records($query_rules, $params);
        
       //var_dump($config['total_rows']);die();

        //var_dump($query_rules);var_dump($data['tc_records']);die();

        if($urtId == 2 && $clockedIn == -1) {

            $data['_modal'] = 'time_clock/clock-in-modal';

        }
        //var_dump($data);die();


        //var_dump($query_rules);var_dump($params);die();
        
        $data['_view'] = 'time_clock/index';

        $this->load->view('layouts/main', $data);

        if(isset($_POST['export_tc_records'])) {

            $tcrs = $this->Time_clock_model->get_tc_records($query_rules, array());

            //var_dump($tcrs);die();

            $this->load->library("excel");

            $object = new PHPExcel();

            $object->setActiveSheetIndex(0);

            $table_columns = array("Date", "Time", "Site", "Staff", "Event", "Early/Late", "Due Time", "Additional Note");

            $column = 0;

            foreach($table_columns as $field) {

                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;

            }

            $excel_tcr = 2;

            foreach($tcrs as $tcr)
            {

                $dueTime = '';

                if($tcr['activity'] == 'Clock In') {

                    $dueTime = $tcr['startTime'];

                } else if($tcr['activity'] == 'Clock Out') {

                    $dueTime = $tcr['endTime'];

                }

                $timeDiff = '';

                if($tcr['lateInTime'] > 0) {

                    $timeDiff = (int)($tcr['lateInTime'] / 60) . ' Hr ' . ($tcr['lateInTime'] % 60) . ' Min ' . ' AFTER';

                }

                if($tcr['earlyInTime'] > 0) {

                    $timeDiff = (int)($tcr['earlyInTime'] / 60) . ' Hr ' . ($tcr['earlyInTime'] % 60) . ' Min ' . ' BEFORE';

                }


                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_tcr, date('m-d-Y', $tcr['time']));
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_tcr, date('h:i A', $tcr['time']));
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_tcr, $tcr['siteName']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_tcr, $tcr['fullName'] . (($tcr['drugTestCollector'] == 1) ? '(Drug Test Collector)' : ''));
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_tcr, $tcr['activity']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_tcr, $timeDiff);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_tcr, $dueTime);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_tcr, $tcr['note']);

                $excel_tcr++;
            }

            $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="TimeClockRecords.xls"');
            $object_writer->save('php://output');


        }

    }

    /*
     * Register Event - Time-Clock
     */
    public function registerEvent() {

        $data['user_session'] = $this->data;

        $response = array();

        try {

            if($this->input->post('activity') == 'Clock In') {

                $params = array(
                    'userId' => $this->input->post('userId'),
                    'time' => (int) ($this->input->post('time') / 1000),
                    'dueTime' => (int) ($this->input->post('dueTime') / 1000),
                    'earlyInTime' => $this->input->post('earlyInTime'),
                    'lateInTime' => $this->input->post('lateInTime'),
                    'siteId' => $this->input->post('siteId'),
                    'companyId' => $this->input->post('companyId'),
                    'activity' => $this->input->post('activity'),
                    'note' => $this->input->post('note')
                );

                $tcId = $this->Time_clock_model->add_time_clock($params);

                $site = $this->Site_model->get_site((int) $params['siteId']);

                $company = $this->Company_model->get_company((int) $params['companyId']);

                $uParams = array(
                    'clocked_in' => 1,
                    'tc_site_id' => $this->input->post('siteId'),
                    'tc_company_id' => $this->input->post('companyId'),
                    'tc_site' => $site['siteName'],
                    'tc_company' => $company['companyName']
                );

                $this->User_model->update_user($data['user_session']['id'], $uParams);

                $this->updateUserSession('clocked_in', 1);

                $this->updateUserSession('tc_site_id', $site['id']);
                $this->updateUserSession('tc_company_id', $company['id']);

                $this->updateUserSession('tc_site', $site['siteName']);
                $this->updateUserSession('tc_company', $company['companyName']);

                //$this->updateUserSession('tc_time', date('h:i:s a', $params['time']));

            }

            if($this->input->post('activity') == 'Clock Out') {

                $params = array(
                    'userId' => $data['user_session']['id'],
                    'time' => (int) ($this->input->post('time') / 1000),
                    'dueTime' => (int) ($this->input->post('dueTime') / 1000),
                    'earlyInTime' => $this->input->post('earlyInTime'),
                    'lateInTime' => $this->input->post('lateInTime'),
                    'siteId' => $data['user_session']['tc_site_id'],
                    'companyId' => $data['user_session']['tc_company_id'],
                    'activity' => $this->input->post('activity'),
                    'note' => $this->input->post('note')
                );

                $tcId = $this->Time_clock_model->add_time_clock($params);

                $uParams = array(
                    'clocked_in' => -1,
                    'tc_site_id' => 0,
                    'tc_company_id' => 0,
                    'tc_site' => '',
                    'tc_company' => ''
                );

                $this->User_model->update_user($data['user_session']['id'], $uParams);

                $this->updateUserSession('clocked_in', -1);

                $this->updateUserSession('tc_site_id', 0);
                $this->updateUserSession('tc_company_id', 0);

                $this->updateUserSession('tc_site', '');
                $this->updateUserSession('tc_company', '');

                //$this->updateUserSession('tc_time', '');
                
            }

            if($this->input->post('activity') == 'Break In') {

                $params = array(
                    'userId' => $data['user_session']['id'],
                    'time' => (int) ($this->input->post('time') / 1000),
                    'dueTime' => '',
                    'earlyInTime' => 0,
                    'lateInTime' => 0,
                    'siteId' => $data['user_session']['tc_site_id'],
                    'companyId' => $data['user_session']['tc_company_id'],
                    'activity' => $this->input->post('activity'),
                    'note' => ''
                );

                $tcId = $this->Time_clock_model->add_time_clock($params);

                $uParams = array(
                    'breaked_in' => 1
                );

                $this->User_model->update_user($data['user_session']['id'], $uParams);

                $this->updateUserSession('breaked_in', 1);

            }

            if($this->input->post('activity') == 'Break Out') {

                $params = array(
                    'userId' => $data['user_session']['id'],
                    'time' => (int) ($this->input->post('time') / 1000),
                    'dueTime' => '',
                    'earlyInTime' => 0,
                    'lateInTime' => 0,
                    'siteId' => $data['user_session']['tc_site_id'],
                    'companyId' => $data['user_session']['tc_company_id'],
                    'activity' => $this->input->post('activity'),
                    'note' => ''
                );

                $tcId = $this->Time_clock_model->add_time_clock($params);

                $uParams = array(
                    'breaked_in' => 0
                );

                $this->User_model->update_user($data['user_session']['id'], $uParams);

                $this->updateUserSession('breaked_in', 0);
                
            }

            $response['status'] = 200;
            $response['result'] = 1;

            $responseJSON = json_encode($response);

            echo $responseJSON;


        } catch(Exception $ex) {

            $response['status'] = 500;
            $response['result'] = -1;
            $response['message'] = $ex->getMessage();

            $responseJSON = json_encode($response);

            echo $responseJSON;

        }

    }

    /*
     * Onsite Work - Time-Clock
     */
    public function onsiteWork() {

    	$data['user_session'] = $this->data;

        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        $data['all_scs'] = $this->Company_model->get_all_subcontructors();

    	$data['_view'] = 'time_clock/onsite-work';
        $this->load->view('layouts/main',$data);

    }

    /*
     * Drug Collection - Time-Clock
     */
    public function drugCollection() {

    	$data['user_session'] = $this->data;

        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        $data['all_scs'] = $this->Company_model->get_all_subcontructors();

    	$data['_view'] = 'time_clock/drug-collection';
        $this->load->view('layouts/main',$data);

    }

    /*
     * Other - Time-Clock
     */
    public function other() {

    	$data['user_session'] = $this->data;

        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        $data['all_scs'] = $this->Company_model->get_all_subcontructors();

    	$data['_view'] = 'time_clock/other';
        $this->load->view('layouts/main',$data);

    }

    /*
     * Get Site
     */
    public function _getSite($id) {

        $site = $this->Site_model->get_site((int) $id);

        return $site;

    }
    
}
