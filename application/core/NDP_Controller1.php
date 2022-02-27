<?php

	/*****
	*
	* @Author: Nasid Kamal.
	* @Project Keyword: OHS.
	*
	*****/

	defined('BASEPATH') OR exit('No direct script access allowed');

	class NDP_Controller extends CI_Controller {

		public function __construct() {

			parent::__construct();
			
        	$this->load->model('User_model');

		}

		public function initialize() {

			$user_session_data = array(

				'is_authorized' => false,
				'id' => 0,
				'username' => 'anonym',
				'realName' => 'Anonymous User',
				'userType' => null,
				'roleId' => 0,
				'dst_collector' => 0,
				'clocked_in' => -1,
				'tc_time' => 0,
				'tc_site' => '',
				'tc_company' => '',
				'tc_site_id' => 0,
				'tc_company_id' => 0,
				'breaked_in' => 0,
				'current_url' => null,
				'previous_url' => null,
				'query_rules' => null

			);

			$this->session->set_userdata('user_session', $user_session_data);

		}

		public function loadAppData($is_authorization_required) {

			if($this->session->userdata('user_session') == null) {

				$this->initialize();

			}
			
			$data = $this->session->userdata('user_session');

			$last_url = $data['current_url'];

			$data['current_url'] = current_url();
			$data['previous_url'] = $last_url;

			if($is_authorization_required == true) {

				$user = $this->User_model->get_user($data['id']);

				$data['clocked_in'] = $user['clocked_in'];
				$data['breaked_in'] = $user['breaked_in'];
				$data['tc_site_id'] = $user['tc_site_id'];
				$data['tc_company_id'] = $user['tc_company_id'];
				$data['tc_site'] = $user['tc_site'];
				$data['tc_company'] = $user['tc_company'];

			}

			$this->session->set_userdata('user_session', $data);

			$this->data = $this->session->userdata('user_session');

			//var_dump($this->data); die();

			if($is_authorization_required == true && $this->data['is_authorized'] == false) {
				
				redirect('login');

			}

		}

		public function updateUserSession($key, $value) {

			$data = $this->session->userdata('user_session');

			$data[$key] = $value;

			$this->session->set_userdata('user_session', $data);

			$this->data = $this->session->userdata('user_session');

		}

		public function sendEmail($toEmail, $subject, $message, $attachedFile) {

			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => '587',
				'smtp_user' => 'portal4sbp@gmail.com',
				'smtp_pass' => 'pass4portalsbp',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => false
			);

			$this->load->library('email', $config);
			$this->email->from('SBP', 'no_reply@sbp.com');
			$this->email->to($toEmail);
			$this->email->subject($subject);
			$this->email->message($message);
			if($attachedFile != null) {

				$this->email->attach($attachedFile);
				
			}
			$this->email->set_newline("\r\n");
			
			if($this->email->send()) {

			} else {

				show_error($this->email->print_debugger());
				
			}

			/*$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => '465',
				'smtp_user' => 'portal4sbp@gmail.com',
				'smtp_pass' => 'pass4portalsbp',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => true
			);

			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			//$this->email->initialize($config);
			$this->email->from('noreply@portal.ohstrainconsult.com', 'Admin, OHS Training & Consulting.');
			$this->email->to($toEmail);
			$this->email->subject($subject);
			$this->email->message($message);
			
			if($attachedFile != null) {

				$this->email->attach($attachedFile);
				
			}

			//$this->email->set_newline("\r\n");
			
			if($this->email->send()) {
				//echo 'An Email Has Been Sent Successfully...!';
			} else {
				show_error($this->email->print_debugger());
			}*/

		}


		public function formatwhitespaces($text, $length) {
			
			return str_pad ($text, $length," ");

		}


		public function formatData($object) {
			
			foreach ($object as $key => $value) {
				
				$object->$key = str_replace(' ', '_', $value);

			}

			return $object;

		}


		public function performSynergyEventDraft($requestData) {
			
			$ch = curl_init('http://localhost/ohs/worker/checkIfExists');
			//$ch = curl_init(API_ENDPOINT);
			curl_setopt_array($ch, array(
			    CURLOPT_POST => TRUE,
			    CURLOPT_RETURNTRANSFER => TRUE,
			    CURLOPT_HTTPHEADER => array(
			        'Content-Type: application/json',       
    				'Content-Length: ' . strlen(json_encode($requestData))
			    ),
			    CURLOPT_POSTFIELDS => json_encode($requestData)
			));

			// Send the request
			$response = curl_exec($ch);

			//var_dump(json_decode($response)); die();

			// Create the context for the request
/*$context = stream_context_create(array(
    'http' => array(
        // http://www.php.net/manual/en/context.http.php
        'method' => 'POST',
        'header' => "Content-Type: application/json",
        'content' => http_build_query($requestData)
    )
));

// Send the request
$response = file_get_contents('http://localhost/ohs/worker/checkIfExists', FALSE, $context);*/


			curl_close($ch);
			// Check for errors
			if($response == FALSE){

				return 'something wrong!!!';

			    //die(curl_error($ch));

			}

			// Decode the response
			$responseData = json_decode($response, TRUE);

			// Print the date from the response
			return $responseData;


		}


		public function performSynergyEvent($data) {

			//$ch = curl_init('https://turnerdata.trackdown.com/api/data');
 
			$jsonDataEncoded = json_encode($data);

			// Start session (also wipes existing/previous sessions)
			$this->curl->create('https://turnerdata.trackdown.com/api/data');

			// Option           
			$this->curl->option(CURLOPT_HTTPHEADER, array('Content-type: application/json; Charset=UTF-8'));
			$this->curl->option(CURLOPT_CAINFO, FCPATH . 'cacert.pem');
			$this->curl->option(CURLOPT_SSL_VERIFYPEER, true);

			// Post - If you do not use post, it will just run a GET request            
			$this->curl->post($jsonDataEncoded);
			        
			// Execute - returns responce 
			$response = $this->curl->execute();

			$result = json_decode($response);

	        return $result;

		}


	}

?>
