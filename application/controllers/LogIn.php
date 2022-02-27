<?php

	/*****
	*
	* @Author: Nasid Kamal.
	* @Project Keyword: OHS.
	*
	*****/

	defined('BASEPATH') OR exit('No direct script access allowed');

	class LogIn extends NDP_Controller {

		public function __construct() {

			parent::__construct();

			$this->loadAppData(false);

			$this->load->model('User_model');

			$this->load->model('Role_model');

        	$this->load->model('Company_model');

			$this->load->model('Company_user_model');

		}

		public function index() {

        	$data['user_session'] = $this->data;

			if($this->data['is_authorized'] == false) {

				$data['errorMessage'] = $this->session->flashdata('errorMessage');

				$this->load->view('authentication/login',$data);
				

			} else {

				redirect('dashboard');

			}

		}

		public function authenticate() {

        	$data['user_session'] = $this->data;

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$data['user'] = $this->User_model->authenticate_user($username, $password);

			if(isset($data['user']['id'])) {

				if($data['user']['statusId'] == 2) {

					$this->session->set_flashdata('errorMessage', 'Your access has been DISABLED! Contact OHS Support.');
					redirect('login');

				} else if($data['user']['statusId'] == 3) {

					$this->session->set_flashdata('errorMessage', 'Your account has been SUSPENDED! Contact OHS Support.');
					redirect('login');

				} else {

					$role = $this->Role_model->get_role($data['user']['roleId']);

					$this->updateUserSession('is_authorized', true);
					$this->updateUserSession('id', $data['user']['id']);
					$this->updateUserSession('username', $data['user']['username']);
					$this->updateUserSession('realName', $data['user']['fullName']);
					$this->updateUserSession('roleId', $data['user']['roleId']);
					$this->updateUserSession('dst_collector', (int)$data['user']['drugTestCollector']);
					$this->updateUserSession('userType', $role['title']);

					$this->updateUserSession('clocked_in', $data['user']['clocked_in']);
					$this->updateUserSession('tc_site_id', $data['user']['tc_site_id']);
					$this->updateUserSession('tc_company_id', $data['user']['tc_company_id']);
					$this->updateUserSession('tc_site', $data['user']['tc_site']);
					$this->updateUserSession('tc_company', $data['user']['tc_company']);

					$cids = array();
					$companies = array();

					if($role['title'] == 'CONSTRUCTION_COMPANY_USER') {

						$comIds = $this->Company_user_model->get_cids_by_user($data['user']['id']);

				        if($comIds) {

				            $cid_str = substr($comIds, 1);

				            $cids = explode('/', $cid_str);

				            foreach ($cids as $cid) {
		                
				                $c = $this->Company_model->get_company($cid);

				                array_push($companies, $c);

				            }
				        }

					}

					$slRules = array(

		                'dateFrom' => date('m-d-Y'),
		                'dateTo' => date('m-d-Y'),
		                'workerRegister' => 1,
		                'workerUpdate' => 1,
		                'subcontractorRegister' => 1,
		                'subcontractorUpdate' => 1,
		                'success' => 1

		            );

		            $this->updateUserSession('sl_rules', $slRules);

					$tcRules = array(
		                'sortBy' => 'time',
		                'sortingOrder' => 'desc',
		                'user_id' => ($data['user']['roleId'] == 2) ? $data['user']['id'] : 0,
		                'activity' => 'ALL',
		                'dateFrom' => date('m-d-Y'),
		                'dateTo' => date('m-d-Y')

		            );

		            $this->updateUserSession('tc_rules', $tcRules);

					$dsRules = array(
		                'testResult' => 'ALL',
		                'dateFrom' => date('m-d-Y'),
		                'dateTo' => date('m-d-Y')

		            );

		            $this->updateUserSession('ds_rules', $dsRules);

		            $dtcRules = array(
		                'sortBy' => 'date',
		                'sortingOrder' => 'desc',
		                'collectorId' => ($data['user']['roleId'] == 2 && $data['user']['drugTestCollector'] == 1) ? $data['user']['id'] : 0,
		                'siteId' => 0,
		                'companyId' => 0,
		                'dateFrom' => date('m-d-Y'),
		                'dateTo' => date('m-d-Y')

		            );

		            $this->updateUserSession('dtc_rules', $dtcRules);

					$cfRules = array(
		                'cName' => '',
		                'pContact' => '',
		                'city' => '',
		                'aSite' => ''
		            );

		            $this->updateUserSession('cf_rules', $cfRules);

		            $sfRules = array(
		                'sName' => '',
		                'pContact' => '',
		                'city' => '',
		                'aCompanyId' => 0

		            );

		            $this->updateUserSession('sf_rules', $sfRules);

		            $wfRules = array(
		                'uid' => '',
		                'lName' => '',
		                'fName' => '',
		                'jobTitle' => 'ALL',
		                'city' => '',
		                'dob' => '',
		                'comId' => 0,
		                'siteIds' => array(),
		                'companyIds' => $cids,
		                'companies' => $companies

		            );

		            $this->updateUserSession('wf_rules', $wfRules);

		            $ufRules = array(
		                'uid' => '',
		                'fullName' => '',
		                'username' => '',
		                'roleId' => 0,
		                'statusId' => 0

		            );
		            
		            $this->updateUserSession('uf_rules', $ufRules);

		            $iofRules = array(
		                'dateFrom' => '',
		                'dateTo' => '',
		                'siteIds' => null,
		                'statusId' => 0,
		                'sids' => '/'

		            );
		            
		            $this->updateUserSession('iof_rules', $iofRules);



	        		$trades = array('ARCHITECT', 'AUDIO / VISUAL', 'BOILERMAKER', 'BRICKLAYER', 'CARPENTER', 'CLEANING', 'COMMUNICATIONS', 'CONCRETE', 'CONSULT', 'DEMOLITION', 'DRIVER', 'DRYWALL', 'ELECTRICIAN', 'ELEVATOR', 'ENGINEER', 'FIRE PROTECTION', 'GENERAL CONTRACTOR', 'GLAZIER', 'HVAC', 'INFORMATION TECHNOLOGY', 'INSPECTOR', 'INSULATOR', 'IRON WORKER', 'LABORER', 'LONGSHOREMAN', 'MASON', 'MECHANICAL', 'OPERATING ENGINEER', 'PAINTER / FINISHER', 'PIPE FITTER', 'PLUMBER', 'PROJECT SUPPORT', 'RIGGER', 'ROOFER', 'SAFETY', 'SHEETMETAL', 'SPRINKLER FITTER', 'SURVEYOR', 'TAPER', 'TEAMSTER', 'TILE MARBLE TERRAZZO');
		            
		            $this->updateUserSession('trades', $trades);

		            $job_roles = array('APPRENTICE', 'FOREMAN', 'JOURNEYMAN', 'OPERATOR', 'PROJECT ASSISTANT', 'PROJECT ENGINEER', 'PROJECT EXECUTIVE', 'PROJECT MANAGER', 'SAFETY MANAGER', 'SUPERINTENDENT');
		            
		            $this->updateUserSession('job_roles', $job_roles);

		            $minority_types = array('AMERICAN INDIAN', 'ASIAN', 'BLACK', 'HISPANIC', 'WHITE');
		            
		            $this->updateUserSession('minority_types', $minority_types);

		            $ec_types = array('CHILD', 'FRIEND', 'PARENT', 'SIBLING', 'SPOUSE');
		            
		            $this->updateUserSession('ec_types', $ec_types);
					
					redirect('dashboard');

				}
				

			} else {

				$this->session->set_flashdata('errorMessage', 'Your given credentials are WRONG! Contact OHS Support.');
				redirect('login');

			}

			
		}

	}

?>
