<?php

    /*****
    *
    * @Author: Nasid Kamal.
    * @Project Keyword: OHS.
    *
    *****/

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Scan extends NDP_Controller {

        public function __construct() {

            parent::__construct();

            $this->loadAppData(true);

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
            $this->load->model('Alcohol_test_model');
            $this->load->model('Non_ohs_drug_screening_model');
            
            $this->load->model('Medical_supply_model');
            
            $this->load->model('Synergy_log_model');
            
            $this->load->model('First_aid_model');
            
            $this->load->model('Vaccination_model');
            
            $this->load->model('Incident_model');

            $this->load->model('Non_dot_test_panel_model');

        }

        public function index() {

            $data['user_session'] = $this->data;

            $data['errorMessage'] = $this->session->flashdata('errorMessage');

            $this->load->library('form_validation');

            $this->form_validation->set_rules('firstName','First Name','required');
            $this->form_validation->set_rules('lastName','Last Name','required');
            $this->form_validation->set_rules('sex','Sex','required');
            $this->form_validation->set_rules('dob','DOB','required');
            $this->form_validation->set_rules('jobTitle','Trade','required');
            $this->form_validation->set_rules('identificationType','Identification Type','required');
            $this->form_validation->set_rules('identificationId','Identification ID','required');
            
            if($this->form_validation->run())     
            {

                $pictureFile = $_FILES['pictureFile'];

                $age = 0;

                $ppFileName = '';

                if($pictureFile) {

                    if($pictureFile['name'] != '') {

                        $filename_array = explode('.',$pictureFile['name']);
                        $size = count($filename_array);
                        $extension = $filename_array[$size - 1];
                        $ppFileName = 'pp_' . $this->input->post('generatedUID') . '_' . time() . '.' . $extension;

                        //var_dump($newFileName1);

                        move_uploaded_file($pictureFile['tmp_name'], FCPATH . 'resources/workers/' . $ppFileName);

                    }
                }

                $imageURI = '';

                $iData = $this->input->post('pictureDataURI');

                if($iData != null && $iData != '') {

                    $imageURI = $iData;

                } else {

                    if($ppFileName != '') {

                        $imageURI = site_url('resources/workers/') . $ppFileName;

                    }
                }

                $params = array(
                    'statusId' => $this->input->post('statusId'),
                    'uid' => $this->input->post('generatedUID'),
                    'firstName' => $this->input->post('firstName'),
                    'lastName' => $this->input->post('lastName'),
                    'middleName' => $this->input->post('middleName'),
                    'suffix' => $this->input->post('suffix'),
                    'dob' => $this->input->post('dob'),
                    'sex' => $this->input->post('sex'),
                    'age' => $age,
                    'primaryPhone' => $this->input->post('primaryPhone'),
                    'secondaryPhone' => $this->input->post('secondaryPhone'),
                    'email' => $this->input->post('email'),
                    'address1' => $this->input->post('address1'),
                    'address2' => $this->input->post('address2'),
                    'comm_pref' => $this->input->post('comm_pref'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipCode' => $this->input->post('zipCode'),
                    'jobTitle' => $this->input->post('jobTitle'),
                    'otherTrade' => ($this->input->post('jobTitle') == 'OTHER') ? $this->input->post('otherTrade') : '',
                    'pictureFile' => $ppFileName,
                    /*'cardFile' => $this->input->post('cardFile'),*/
                    'identificationId' => $this->input->post('identificationId'),
                    'identificationType' => $this->input->post('identificationType'),
                    'otherIdType' => ($this->input->post('identificationType') == 'OTHER') ? $this->input->post('otherIdType') : '',
                    'minority' => ($this->input->post('sex') == 'Female') ? 1 : $this->input->post('minority'),
                    'minorityType' => ($this->input->post('sex') == 'Female') ? 'FEMALE' : (($this->input->post('minority') == 'NO') ? 'NONE' : $this->input->post('minorityType')),
                    'jobRole' => $this->input->post('jobRole'),
                    'otherJobRole' => ($this->input->post('jobRole') == 'OTHER') ? $this->input->post('otherJobRole') : '',
                    'jobs' => $this->input->post('jobs'),
                    'ecType' => $this->input->post('ecType'),
                    'ecName' => $this->input->post('ecName'),
                    'ecRelationship' => $this->input->post('ecRelationship'),
                    'ecPhone' => $this->input->post('ecPhone'),
                    'ecAltPhone' => $this->input->post('ecAltPhone'),
                    'companyId' => ($this->input->post('companyNotInList') == 'YES') ? 0 : $this->input->post('companyId'),
                    'companyNotInList' => $this->input->post('companyNotInList'),
                    'otherCompanyName' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherCompanyName') : '',
                    'otherComContactName' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherComContactName') : '',
                    'otherComPhone' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherComPhone') : '',
                    /*'otherComEmail' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherComEmail') : '',*/
                    'otherComBy' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherComBy') : '',
                    'siteIdW' => ($this->input->post('siteNotInList') == 'YES') ? 0 : $this->input->post('siteIdW'),
                    'siteNotInList' => $this->input->post('siteNotInList'),
                    'otherSiteName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteName') : '',
                    'otherSiteContactName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteContactName') : '',
                    'otherSitePhone' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSitePhone') : '',
                    'otherSiteEmail' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteEmail') : '',
                    'otherSiteBy' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteBy') : '',
                    /*'companies' => $companyIds,
                    'sites' => $siteIds,
                    'subcontractors' => $subcontractorIds*/
                );

                if($imageURI != '') {

                    $params['imageURI'] = $imageURI;
                    
                }

                if((int)$params['siteIdW'] > 0) {

                    $site = $this->Site_model->get_site((int)$params['siteIdW']);

                    $subcon = '';

                    if($params['companyId'] != null && (int)$params['companyId'] > 0) {

                        $com = $this->Company_model->get_company((int)$params['companyId']);

                        $subcon = $com['uid'];

                    }

                    if($site['synergy'] == 'YES') {

                        $workerData = array(

                            'BarCode' => $params['uid'],
                            'WorkerFirst' => $params['firstName'],
                            'WorkerLast' => $params['lastName'],
                            'Gender' => $params['sex'],
                            'Minority' => $params['minority'],
                            'Minority_Type' => $params['minorityType'],
                            'SubContractor' => $subcon,
                            'Worker_Address' => $params['address1'],
                            'Worker_City' => $params['city'],
                            'Worker_State' => $params['state'],
                            'Worker_Zip' => $params['zipCode'],
                            'Job_Role' => $params['jobRole'],
                            'Trade' => $params['jobTitle'],
                            'Worker_Phone' => $params['primaryPhone'],
                            'Worker_Email' => $params['email'],
                            'Emergency_Contact' => $params['ecName'],
                            'Emergency_Contact_Phone' => $params['ecPhone'],
                            'Emergency_Contact_Type' => $params['ecType']

                        );

                        $obj = (object) $workerData;

                        $wrkr = $this->formatData($obj);

                        $reqData = array(

                            'EventID' => '20180330-02',
                            'EventType' => 'Registered Worker',
                            'APIKey' => API_KEY,
                            'RecordCreated' => date('m/d/Y h:i:s A'),
                            'Worker' => array($wrkr)
                        );

                        //echo json_encode($reqData) . '<br>';

                        $resData = $this->performSynergyEvent($reqData);

                        $df = DateTime::createFromFormat('m/d/Y h:i:s A', $reqData['RecordCreated']);

                        $slParams = array(

                            'entity' => 'Worker',
                            'uid' => $params['uid'],
                            'time' => strtotime($df->format('Y-m-d h:i:s A')),
                            'event' => $reqData['EventID'] . ' [Register Worker]',
                            'performedBy' => $data['user_session']['realName'] . ' (' . $data['user_session']['username'] .')',
                            'reqData' => json_encode($reqData),
                            'resData' => json_encode($resData),
                            'success' => $resData->ReturnCode,
                            'errMsg' => ($resData->ReturnCode == -1) ? $resData->ExtendedMessage : ''

                        );

                        $this->Synergy_log_model->add_synergy_log($slParams);

                        /*if((int)$resData->RerturnCode != 0) {
                            
                            $this->session->set_flashdata('errorMessage', $resData->Message . '. ' . $resData->ExtendedMessage . '.');

                            redirect('worker/add');

                        }*/

                    }


                }

                if($this->input->post('companyNotInList') == 'YES') {

                    $message = 'An unregistered company has been added with the following information:';

                    $message .= PHP_EOL . PHP_EOL;

                    $message .= 'Name Of Company: ' . $this->input->post('otherCompanyName');

                    $message .= PHP_EOL;

                    $message .= 'Contact Name: ' . $this->input->post('otherComContactName');

                    $message .= PHP_EOL;

                    $message .= 'Phone: ' . $this->input->post('otherComPhone');

                    $message .= PHP_EOL;

                    /*$message .= 'Email: ' . $this->input->post('otherComEmail');

                    $message .= PHP_EOL;*/

                    $message .= 'Added By: ' . $this->input->post('otherComBy');

                    $subject = 'NEW UNLISTED COMPANY';

                    $admin_emails = explode('/', ADMIN_EMAIL);

                    foreach ($admin_emails as $email) {
                        $this->sendEmail($email, $subject, $message, null);
                    }

                }

                if($this->input->post('siteNotInList') == 'YES') {

                    $message = 'An unregistered site has been added with the following information:';

                    $message .= PHP_EOL . PHP_EOL;

                    $message .= 'Name Of Site: ' . $this->input->post('otherSiteName');

                    $message .= PHP_EOL;

                    $message .= 'Contact Name: ' . $this->input->post('otherSiteContactName');

                    $message .= PHP_EOL;

                    $message .= 'Phone: ' . $this->input->post('otherSitePhone');

                    $message .= PHP_EOL;

                    $message .= 'Email: ' . $this->input->post('otherSiteEmail');

                    $message .= PHP_EOL;

                    $message .= 'Added By: ' . $this->input->post('otherSiteBy');

                    $subject = 'NEW UNLISTED SITE';

                    $admin_emails = explode('/', ADMIN_EMAIL);

                    foreach ($admin_emails as $email) {
                        $this->sendEmail($email, $subject, $message, null);
                    }

                }
                
                $worker_id = $this->Worker_model->add_worker($params);

                redirect('worker/index');
            }
            else
            {

                $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();

                $data['all_ests'] = $this->EST_model->get_all_ests();
                $data['all_companies'] = $this->Company_model->get_all_companies();
                $data['all_sites'] = $this->Site_model->get_all_sites();
                $data['all_scs'] = $this->Company_model->get_all_subcontructors();
                
                $data['_view'] = 'scanner/index';
                $this->load->view('layouts/main',$data);
                //$this->load->view('scanner/index');
            }

        }

        public function new() {

            $data['user_session'] = $this->data;

            $data['errorMessage'] = $this->session->flashdata('errorMessage');

            $this->load->library('form_validation');

            $this->form_validation->set_rules('firstName','First Name','required');
            $this->form_validation->set_rules('lastName','Last Name','required');
            $this->form_validation->set_rules('sex','Sex','required');
            $this->form_validation->set_rules('dob','DOB','required');
            $this->form_validation->set_rules('jobTitle','Trade','required');
            $this->form_validation->set_rules('identificationType','Identification Type','required');
            $this->form_validation->set_rules('identificationId','Identification ID','required');
            
            if($this->form_validation->run())     
            {

                $pictureFile = $_FILES['pictureFile'];

                $age = 0;

                $ppFileName = '';

                if($pictureFile) {

                    if($pictureFile['name'] != '') {

                        $filename_array = explode('.',$pictureFile['name']);
                        $size = count($filename_array);
                        $extension = $filename_array[$size - 1];
                        $ppFileName = 'pp_' . $this->input->post('generatedUID') . '_' . time() . '.' . $extension;

                        //var_dump($newFileName1);

                        move_uploaded_file($pictureFile['tmp_name'], FCPATH . 'resources/workers/' . $ppFileName);

                    }
                }

                $imageURI = '';

                $iData = $this->input->post('pictureDataURI');

                if($iData != null && $iData != '') {

                    $imageURI = $iData;

                } else {

                    if($ppFileName != '') {

                        $imageURI = site_url('resources/workers/') . $ppFileName;

                    }
                }

                $params = array(
                    'statusId' => $this->input->post('statusId'),
                    'uid' => $this->input->post('generatedUID'),
                    'firstName' => $this->input->post('firstName'),
                    'lastName' => $this->input->post('lastName'),
                    'middleName' => $this->input->post('middleName'),
                    'suffix' => $this->input->post('suffix'),
                    'dob' => $this->input->post('dob'),
                    'sex' => $this->input->post('sex'),
                    'age' => $age,
                    'primaryPhone' => $this->input->post('primaryPhone'),
                    'secondaryPhone' => $this->input->post('secondaryPhone'),
                    'email' => $this->input->post('email'),
                    'address1' => $this->input->post('address1'),
                    'address2' => $this->input->post('address2'),
                    'comm_pref' => $this->input->post('comm_pref'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipCode' => $this->input->post('zipCode'),
                    'jobTitle' => $this->input->post('jobTitle'),
                    'otherTrade' => ($this->input->post('jobTitle') == 'OTHER') ? $this->input->post('otherTrade') : '',
                    'pictureFile' => $ppFileName,
                    /*'cardFile' => $this->input->post('cardFile'),*/
                    'identificationId' => $this->input->post('identificationId'),
                    'identificationType' => $this->input->post('identificationType'),
                    'otherIdType' => ($this->input->post('identificationType') == 'OTHER') ? $this->input->post('otherIdType') : '',
                    'minority' => ($this->input->post('sex') == 'Female') ? 1 : $this->input->post('minority'),
                    'minorityType' => ($this->input->post('sex') == 'Female') ? 'FEMALE' : (($this->input->post('minority') == 'NO') ? 'NONE' : $this->input->post('minorityType')),
                    'jobRole' => $this->input->post('jobRole'),
                    'otherJobRole' => ($this->input->post('jobRole') == 'OTHER') ? $this->input->post('otherJobRole') : '',
                    'jobs' => $this->input->post('jobs'),
                    'ecType' => $this->input->post('ecType'),
                    'ecName' => $this->input->post('ecName'),
                    'ecRelationship' => $this->input->post('ecRelationship'),
                    'ecPhone' => $this->input->post('ecPhone'),
                    'ecAltPhone' => $this->input->post('ecAltPhone'),
                    'companyId' => ($this->input->post('companyNotInList') == 'YES') ? 0 : $this->input->post('companyId'),
                    'companyNotInList' => $this->input->post('companyNotInList'),
                    'otherCompanyName' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherCompanyName') : '',
                    'otherComContactName' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherComContactName') : '',
                    'otherComPhone' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherComPhone') : '',
                    /*'otherComEmail' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherComEmail') : '',*/
                    'otherComBy' => ($this->input->post('companyNotInList') == 'YES') ? $this->input->post('otherComBy') : '',
                    'siteIdW' => ($this->input->post('siteNotInList') == 'YES') ? 0 : $this->input->post('siteIdW'),
                    'siteNotInList' => $this->input->post('siteNotInList'),
                    'otherSiteName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteName') : '',
                    'otherSiteContactName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteContactName') : '',
                    'otherSitePhone' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSitePhone') : '',
                    'otherSiteEmail' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteEmail') : '',
                    'otherSiteBy' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteBy') : '',
                    /*'companies' => $companyIds,
                    'sites' => $siteIds,
                    'subcontractors' => $subcontractorIds*/
                );

                if($imageURI != '') {

                    $params['imageURI'] = $imageURI;
                    
                }

                if((int)$params['siteIdW'] > 0) {

                    $site = $this->Site_model->get_site((int)$params['siteIdW']);

                    $subcon = '';

                    if($params['companyId'] != null && (int)$params['companyId'] > 0) {

                        $com = $this->Company_model->get_company((int)$params['companyId']);

                        $subcon = $com['uid'];

                    }

                    if($site['synergy'] == 'YES') {

                        $workerData = array(

                            'BarCode' => $params['uid'],
                            'WorkerFirst' => $params['firstName'],
                            'WorkerLast' => $params['lastName'],
                            'Gender' => $params['sex'],
                            'Minority' => $params['minority'],
                            'Minority_Type' => $params['minorityType'],
                            'SubContractor' => $subcon,
                            'Worker_Address' => $params['address1'],
                            'Worker_City' => $params['city'],
                            'Worker_State' => $params['state'],
                            'Worker_Zip' => $params['zipCode'],
                            'Job_Role' => $params['jobRole'],
                            'Trade' => $params['jobTitle'],
                            'Worker_Phone' => $params['primaryPhone'],
                            'Worker_Email' => $params['email'],
                            'Emergency_Contact' => $params['ecName'],
                            'Emergency_Contact_Phone' => $params['ecPhone'],
                            'Emergency_Contact_Type' => $params['ecType']

                        );

                        $obj = (object) $workerData;

                        $wrkr = $this->formatData($obj);

                        $reqData = array(

                            'EventID' => '20180330-02',
                            'EventType' => 'Registered Worker',
                            'APIKey' => API_KEY,
                            'RecordCreated' => date('m/d/Y h:i:s A'),
                            'Worker' => array($wrkr)
                        );

                        //echo json_encode($reqData) . '<br>';

                        $resData = $this->performSynergyEvent($reqData);

                        $df = DateTime::createFromFormat('m/d/Y h:i:s A', $reqData['RecordCreated']);

                        $slParams = array(

                            'entity' => 'Worker',
                            'uid' => $params['uid'],
                            'time' => strtotime($df->format('Y-m-d h:i:s A')),
                            'event' => $reqData['EventID'] . ' [Register Worker]',
                            'performedBy' => $data['user_session']['realName'] . ' (' . $data['user_session']['username'] .')',
                            'reqData' => json_encode($reqData),
                            'resData' => json_encode($resData),
                            'success' => $resData->ReturnCode,
                            'errMsg' => ($resData->ReturnCode == -1) ? $resData->ExtendedMessage : ''

                        );

                        $this->Synergy_log_model->add_synergy_log($slParams);

                        /*if((int)$resData->RerturnCode != 0) {
                            
                            $this->session->set_flashdata('errorMessage', $resData->Message . '. ' . $resData->ExtendedMessage . '.');

                            redirect('worker/add');

                        }*/

                    }


                }

                if($this->input->post('companyNotInList') == 'YES') {

                    $message = 'An unregistered company has been added with the following information:';

                    $message .= PHP_EOL . PHP_EOL;

                    $message .= 'Name Of Company: ' . $this->input->post('otherCompanyName');

                    $message .= PHP_EOL;

                    $message .= 'Contact Name: ' . $this->input->post('otherComContactName');

                    $message .= PHP_EOL;

                    $message .= 'Phone: ' . $this->input->post('otherComPhone');

                    $message .= PHP_EOL;

                    /*$message .= 'Email: ' . $this->input->post('otherComEmail');

                    $message .= PHP_EOL;*/

                    $message .= 'Added By: ' . $this->input->post('otherComBy');

                    $subject = 'NEW UNLISTED COMPANY';

                    $admin_emails = explode('/', ADMIN_EMAIL);

                    foreach ($admin_emails as $email) {
                        $this->sendEmail($email, $subject, $message, null);
                    }

                }

                if($this->input->post('siteNotInList') == 'YES') {

                    $message = 'An unregistered site has been added with the following information:';

                    $message .= PHP_EOL . PHP_EOL;

                    $message .= 'Name Of Site: ' . $this->input->post('otherSiteName');

                    $message .= PHP_EOL;

                    $message .= 'Contact Name: ' . $this->input->post('otherSiteContactName');

                    $message .= PHP_EOL;

                    $message .= 'Phone: ' . $this->input->post('otherSitePhone');

                    $message .= PHP_EOL;

                    $message .= 'Email: ' . $this->input->post('otherSiteEmail');

                    $message .= PHP_EOL;

                    $message .= 'Added By: ' . $this->input->post('otherSiteBy');

                    $subject = 'NEW UNLISTED SITE';

                    $admin_emails = explode('/', ADMIN_EMAIL);

                    foreach ($admin_emails as $email) {
                        $this->sendEmail($email, $subject, $message, null);
                    }

                }
                
                $worker_id = $this->Worker_model->add_worker($params);

                redirect('worker/index');
            }
            else
            {

                $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();

                $data['all_ests'] = $this->EST_model->get_all_ests();
                $data['all_companies'] = $this->Company_model->get_all_companies();
                $data['all_sites'] = $this->Site_model->get_all_sites();
                $data['all_scs'] = $this->Company_model->get_all_subcontructors();
                
                $data['_view'] = 'scanner/new';
                $this->load->view('layouts/main',$data);
                //$this->load->view('scanner/index');
            }

        }
    }