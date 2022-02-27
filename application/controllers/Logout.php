<?php

	/*****
	*
	* @Author: Nasid Kamal.
	* @Project Keyword: OHS.
	*
	*****/

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Logout extends NDP_Controller {

		public function __construct() {

			parent::__construct();

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
			
			$this->loadAppData(true);

		}

		public function index() {

	        $clockedIn = (int) $data['user_session']['clocked_in'];

			$this->session->sess_destroy();

			redirect('login');

		}

		public function clocked_in() {

			$data['user_session'] = $this->data;

	        $data['all_sites'] = $this->Site_model->get_all_sites();

	        if(isset($_POST['clock_out_submit_on_lo'])) {

	        	$params = array(
                    'userId' => $data['user_session']['id'],
                    'time' => $this->input->post('time'),
                    'dueTime' => $this->input->post('dueTime'),
                    'earlyInTime' => $this->input->post('earlyInTime'),
                    'lateInTime' => $this->input->post('lateInTime'),
                    'siteId' => $data['user_session']['tc_site_id'],
                    'companyId' => $data['user_session']['tc_company_id'],
                    'activity' => 'Clock Out',
                    'note' => $this->input->post('note')
                );

                $tcId = $this->Time_clock_model->add_time_clock($params);

                $this->updateUserSession('clocked_in', -1);

                $this->updateUserSession('tc_site_id', 0);
                $this->updateUserSession('tc_company_id', 0);

                $this->updateUserSession('tc_site', '');
                $this->updateUserSession('tc_company', '');

                $this->updateUserSession('tc_time', '');

                $uParams = array(
                    'clocked_in' => -1,
                    'tc_site_id' => 0,
                    'tc_company_id' => 0,
                    'tc_site' => '',
                    'tc_company' => ''
                );

                $this->User_model->update_user($data['user_session']['id'], $uParams);

                redirect('logout/index');

	        }

	        if(isset($_POST['close_clock_out_on_lo'])) {

                redirect('logout/index');

	        }

        	$data['ciSite'] = $this->Site_model->get_site((int) $data['user_session']['tc_site_id']);
        	date_default_timezone_set('America/New_York');
        	//$currDate = date('m-d-Y h:i:s A');

        	//$cf = DateTime::createFromFormat('m-d-Y h:i A', $currDate);

                //$data['dueTime'] = strtotime($df->format('Y-m-d H:i:s'));
        	//$data['currentTime'] = strtotime($cf->format('Y-m-d H:i:s'));

        	$data['dueTime'] = 0;
        	$data['currentTime'] = now();

        	if($data['ciSite']['endTime'] != '' && $data['ciSite']['endTime'] != null) {

        		$dueTime = date('m-d-Y') . ' ' . $data['ciSite']['endTime'];

        		$df = DateTime::createFromFormat('m-d-Y h:i A', $dueTime);

                $data['dueTime'] = strtotime($df->format('Y-m-d H:i:s'));
        	}

        	$data['early'] = 0;
        	$data['late'] = 0;

        	if($data['dueTime'] != 0) {
        		$diff = (int) ($data['dueTime']/60 - $data['currentTime']/60);

        		if($diff > 7) {
        			$data['early'] = $diff;
        		}

        		if($diff < -7) {
        			$data['late'] = $diff;
        		}
        	}

        	$data['_modal'] = 'time_clock/clock-out-modal';

        	//var_dump($data);die();

			$this->load->view('layouts/main',$data);
	        
		}

	}

?>