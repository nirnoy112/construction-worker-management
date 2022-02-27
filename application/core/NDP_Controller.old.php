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

		}

		public function initialize() {

			$user_session_data = array(

				'is_authorized' => false,
				'id' => 0,
				'username' => 'anonym',
				'realName' => 'Anonymous User',
				'userType' => null,
				'roleId' => 0,
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

			$this->session->set_userdata('user_session', $data);

			$this->data = $this->session->userdata('user_session');

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
				'smtp_port' => '465',
				'smtp_user' => 'nfury112@gmail.com',
				'smtp_pass' => 'GHRUVNghruvn0112',
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
			}

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

			$curl = curl_init(API_ENDPOINT);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER,
			        array(
			        	'Content-Type: application/json',       
    					'Content-Length: ' . strlen(json_encode($data))
			        )
			);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

			$json_response = curl_exec($curl);

			//var_dump($json_response); die();

			$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			//echo $status . '<br>';
			curl_close($curl);

			$response = json_decode($json_response, true);

			return $response;
			

			//var_dump($response);

		}


	}

?>
