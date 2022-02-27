<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Worker extends NDP_Controller{
    function __construct()
    {
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

    /*
     * Listing of workers
     */
    function index()
    {
        
        $data['user_session'] = $this->data;
        $data['ctrl'] = $this;

        $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();

        if($data['user_session']['userType'] == 'CONSTRUCTION_COMPANY_USER') {

            $data['all_companies'] = $this->data['wf_rules']['companies'];

        } else {

            $data['all_companies'] = $this->Company_model->get_all_companies();

        }
        
        $data['all_ests'] = $this->EST_model->get_all_ests();

        $query_rules = $this->data['wf_rules'];
        $data['wfRules'] = $query_rules;

        if(isset($_POST['run_w_filter'])) {

            $wf_rules = $this->input->post('wfRules');
            $wf_rules['companyIds'] = $query_rules['companyIds'];
            $wf_rules['companies'] = $query_rules['companies'];

            $this->updateUserSession('wf_rules', $wf_rules);
            redirect('worker/index');

        }

        if(isset($_POST['view_certs'])) {

            $wId = $this->input->post('workerId');

            $data['certs'] = $this->Certification_model->get_worker_certifications($wId);
            $data['workerName'] = $this->input->post('workerName');

            $data['_modal'] = 'certification/certs-modal';


        }

        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('worker/index?');
        $config['total_rows'] = $this->Worker_model->get_filtered_workers_count($query_rules);
        $this->pagination->initialize($config);

        $data['workers'] = $this->Worker_model->get_filtered_workers($query_rules, $params);

        //var_dump($data['workers']); die();
        
        $data['_view'] = 'worker/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new worker
     */
    function add()
    {  
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

        /*if($this->input->post('companyNotInList') == 'YES') {
            $this->form_validation->set_rules('otherCompanyName','Other Company','required');
        } else {
            $this->form_validation->set_rules('companyId','Company','required');

        }*/

        /*if($this->input->post('siteNotInList') == 'YES') {
            $this->form_validation->set_rules('otherSiteName','Other Site','required');
        } else {
            $this->form_validation->set_rules('siteId','Site','required');

        }*/
        //$this->form_validation->set_rules('cid_str','Company','required');
        //$this->form_validation->set_rules('sid_str','Site','required');
        
        if($this->form_validation->run())     
        {

            $pictureFile = $_FILES['pictureFile'];

            /*$cids = $this->input->post('companyOpts');

            $companyIds = '';

            if($cids != null) {

                foreach ($cids as $id) {
                    $companyIds .= '/' . $id;
                }


            }

            $scids = $this->input->post('scOpts');

            $subcontractorIds = '';

            if($scids != null) {

                foreach ($scids as $id) {

                    $subcontractorIds .= '/' . $id;

                }

            }

            $sids = $this->input->post('siteOpts');

            $siteIds = '';

            if($sids != null) {

                foreach ($sids as $id) {
                    $siteIds .= '/' . $id;
                }

            }*/

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
            
            $data['_view'] = 'worker/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a worker
     */
    function edit($id)
    {   
        $data['user_session'] = $this->data;

        
        $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();
        $data['all_ests'] = $this->EST_model->get_all_ests();
        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        $data['all_scs'] = $this->Company_model->get_all_subcontructors();

        $data['errorMessage'] = $this->session->flashdata('errorMessage');

        // check if the worker exists before trying to edit it
        $data['worker'] = $this->Worker_model->get_worker($id);

        $data['staff'] = $this->User_model->get_all_staff();
        //$data['certs'] = $this->Certification_model->get_worker_certifications($id);
        $data['first_aids'] = $this->First_aid_model->get_all_first_aids();
        $data['vaccinations'] = $this->Vaccination_model->get_all_vaccinations();
        
       $non_dot_test_panels = $this->Non_dot_test_panel_model->get_all_non_dot_test_panels();

        $all_non_dot_test_panels = array();

        array_push($all_non_dot_test_panels, $non_dot_test_panels[0]);
        array_push($all_non_dot_test_panels, $non_dot_test_panels[3]);
        array_push($all_non_dot_test_panels, $non_dot_test_panels[1]);
        array_push($all_non_dot_test_panels, $non_dot_test_panels[2]);

        $data['all_non_dot_test_panels'] = $all_non_dot_test_panels;

        $w = $data['worker'];

        $wSite = null;

        if((int) $w['siteIdW'] > 0) {

            $wSite = $this->Site_model->get_site((int) $w['siteIdW']);

            //$wSiteName = $site['siteName'];

        } else {

            $wSite = array(

                'siteName' => $w['otherSiteName'],
                'der' => ''

            );

        }

        $data['worker']['site'] = $wSite;

        $wCompany = null;

        if((int) $w['companyId'] > 0) {

            $wCompany = $this->Company_model->get_company((int) $w['companyId']);

            //$wCompanyName = $company['companyName'];
            
        } else {

            $wCompany = array(

                'companyName' => $w['otherCompanyName']

            );
            
        }

        $data['worker']['company'] = $wCompany;

        $wid = (int) $id;
        $wuid = $data['worker']['uid'];
        $wdob = $data['worker']['dob'];
        $wfn = $data['worker']['lastName'] . ' ' . $data['worker']['firstName'] . ' ' . $data['worker']['middleName'];

        
        if(isset($_POST) && count($_POST) > 0)     
        {

            if(isset($_POST['upload_image'])) {

                $pictureFile = $_FILES['pictureFile'];

                $ppFileName = '';

                if($pictureFile) {

                    if($pictureFile['name']) {

                        $filename_array = explode('.',$pictureFile['name']);
                        $size = count($filename_array);
                        $extension = $filename_array[$size - 1];
                        $ppFileName = 'pp_' . $this->input->post('generatedUID') . '_' . time() . '.' . $extension;

                        //var_dump($newFileName1);

                        move_uploaded_file($pictureFile['tmp_name'], FCPATH . 'resources/workers/' . $ppFileName);

                        $params = array(

                            'pictureFile' => $ppFileName,
                            'imageURI' => site_url('resources/workers/') . $ppFileName
                        
                        );

                        $this->Worker_model->update_worker($wid, $params);

                        redirect('worker/edit/' . $wid);

                    }
                }

            }

            if(isset($_POST['worker_edit'])) {

                $this->load->library('form_validation');

                $this->form_validation->set_rules('firstName','First Name','required');
                $this->form_validation->set_rules('lastName','Last Name','required');
                $this->form_validation->set_rules('sex','Sex','required');
                $this->form_validation->set_rules('dob','DOB','required');
                $this->form_validation->set_rules('jobTitle','Trade','required');
                $this->form_validation->set_rules('identificationType','Identification Type','required');
                $this->form_validation->set_rules('identificationId','Identification ID','required');

                /*if($this->input->post('companyNotInList') == 'YES') {
                    $this->form_validation->set_rules('otherCompanyName','Other Company','required');
                } else {
                    $this->form_validation->set_rules('companyId','Company','required');

                }*/

                /*if($this->input->post('siteNotInList') == 'YES') {
                    $this->form_validation->set_rules('otherSiteName','Other Site','required');
                } else {
                    $this->form_validation->set_rules('siteId','Site','required');

                }*/
                //$this->form_validation->set_rules('cid_str','Company','required');
                //$this->form_validation->set_rules('sid_str','Site','required');
                
                if($this->form_validation->run())
                {

                    $pictureFile = $_FILES['pictureFile'];

                    /*$cids = $this->input->post('companyOpts');

                    $companyIds = '';

                    if($cids != null) {

                        foreach ($cids as $id) {
                            $companyIds .= '/' . $id;
                        }


                    }



                    $scids = $this->input->post('scOpts');

                    $subcontractorIds = '';

                    if($scids != null) {

                        foreach ($scids as $id) {

                            $subcontractorIds .= '/' . $id;

                        }

                    }

                    $sids = $this->input->post('siteOpts');

                    $siteIds = '';

                    if($sids != null) {

                        foreach ($sids as $id) {
                            $siteIds .= '/' . $id;
                        }

                    }*/

                    $age = 0;

                    $ppFileName = '';

                    if($pictureFile) {

                        if($pictureFile['name']) {

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
                        /*'pictureFile' => $ppFileName,*/
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
                        'siteIdW' => ($this->input->post('siteNotInList') == 'YES') ? 0 : $this->input->post('siteIdW'),
                        'siteNotInList' => $this->input->post('siteNotInList'),
                        'otherSiteName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteName') : '',
                        'otherSiteContactName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteContactName') : '',
                        'otherSitePhone' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSitePhone') : '',
                        'otherSiteEmail' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteEmail') : ''
                        /*'companies' => $companyIds,
                        'sites' => $siteIds,
                        'subcontractors' => $subcontractorIds*/
                    );


                    if($w['companyNotInList'] != 'YES' && $this->input->post('companyNotInList') == 'YES') {

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

                    if($w['siteNotInList'] != 'YES' && $this->input->post('siteNotInList') == 'YES') {

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


                    if($ppFileName != '') {

                        $params['pictureFile'] = $ppFileName;

                    }

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

                                'EventID' => '20180330-04',
                                'EventType' => 'Update_Worker',
                                'APIKey' => API_KEY,
                                'RecordCreated' => date('m/d/Y h:i:s A'),
                                'Worker' => array($wrkr)
                            );

                            $resData = $this->performSynergyEvent($reqData);

                            $df = DateTime::createFromFormat('m/d/Y h:i:s A', $reqData['RecordCreated']);

                            $slParams = array(

                                'entity' => 'Worker',
                                'uid' => $params['uid'],
                                'time' => strtotime($df->format('Y-m-d h:i:s A')),
                                'event' => $reqData['EventID'] . ' [Update Worker]',
                                'performedBy' => $data['user_session']['realName'] . ' (' . $data['user_session']['username'] .')',
                                'reqData' => json_encode($reqData),
                                'resData' => json_encode($resData),
                                'success' => $resData->ReturnCode,
                                'errMsg' => ($resData->ReturnCode == -1) ? $resData->ExtendedMessage : ''

                            );

                            $this->Synergy_log_model->add_synergy_log($slParams);

                            //var_dump($resData->ReturnCode<0);die();

                            /*if($resData->RerturnCode < 0) {
                                
                                $this->session->set_flashdata('errorMessage', $resData->Message . '. ' . $resData->ExtendedMessage . '.');

                                redirect($this->data['current_url']);

                            }*/

                            //echo json_encode($reqData);
                            //die();

                        }


                    }

                    //var_dump($params);die();

                    $this->Worker_model->update_worker($wid,$params);            
                    redirect('worker/index');
                }
            }

            if(isset($_POST['print_sticker'])) {

                //var_dump($wuid); die();

                $stickerPDF = $this->pSticker($wuid, $wdob, $wfn);

                $filenameWithPath = $stickerPDF;

                $downloadableFile = array(
                    'filename' => 'Barcode#' . $wid . '.pdf',
                    'mimetype' => 'application/pdf'
                );
                

                header('Content-disposition: attachment; filename='. $downloadableFile['filename']);
                header('Content-type: ' . $downloadableFile['mimetype']);
                header('Content-Length: ' . filesize($filenameWithPath));

                ob_clean();
                ob_start();

                readfile($filenameWithPath);

                ob_flush();
                flush();

                exit;


            }

            if(isset($_POST['print_card'])) {

                //var_dump($wuid); die();

                $cardPDF = $this->pCard($w);

                $filenameWithPath = $cardPDF;

                $downloadableFile = array(
                    'filename' => 'Card#' . $wid . '.pdf',
                    'mimetype' => 'application/pdf'
                );
                

                header('Content-disposition: attachment; filename='. $downloadableFile['filename']);
                header('Content-type: ' . $downloadableFile['mimetype']);
                header('Content-Length: ' . filesize($filenameWithPath));

                ob_clean();
                ob_start();

                readfile($filenameWithPath);

                ob_flush();
                flush();

                exit;


            }

             if(isset($_POST['print_qrcode'])) {

                //var_dump($wuid); die();

                $cardPDF = $this->pQRCode($w);

                $filenameWithPath = $cardPDF;

                $downloadableFile = array(
                    'filename' => 'QR_Code#' . $wid . '.pdf',
                    'mimetype' => 'application/pdf'
                );
                

                header('Content-disposition: attachment; filename='. $downloadableFile['filename']);
                header('Content-type: ' . $downloadableFile['mimetype']);
                header('Content-Length: ' . filesize($filenameWithPath));

                ob_clean();
                ob_start();

                readfile($filenameWithPath);

                ob_flush();
                flush();

                exit;


            }

            if(isset($_POST['cert_add'])) {

                $data['wid'] = $wid;

                $data['_modal'] = 'certification/cert-modal';


            }

            if(isset($_POST['rc_add'])) {

                $data['wid'] = $wid;

                $data['_modal'] = 'respirator_clearance/rc-exam-modal';


            }

            if(isset($_POST['ds_add'])) {

                $data['wid'] = $wid;
                $data['wfn'] = $wfn;
                $data['wuid'] = $wuid;

                $data['_modal'] = 'drug_screening/drug-screening-modal';


            }

            if(isset($_POST['drug_screening_submit'])) {

                $sigFileName = null;

                if($this->input->post('signature')) {

                    $encoded_image = explode(',', $this->input->post('signature'))[1];
                    $decoded_image = base64_decode($encoded_image);

                    $sigFileName = 'ws' . time() . '.png';

                    file_put_contents(FCPATH . 'resources/signatures/' . $sigFileName, $decoded_image);

                }

                $collSigFileName = null;

                if($this->input->post('collectorSignature')) {

                    $coll_encoded_image = explode(',', $this->input->post('collectorSignature'))[1];
                    $coll_decoded_image = base64_decode($coll_encoded_image);

                    $collSigFileName = 'cs' . time() . '.png';

                    file_put_contents(FCPATH . 'resources/signatures/' . $collSigFileName, $coll_decoded_image);

                }

                //$siteId = 0;

                //if($this->input->post('siteId') != 0) {

                    /*$siteArr = explode('/', $this->input->post('siteId'));

                    $siteId = $siteArr[0];*/
                //}
                $ct = '';
                if($this->input->post('collectionDate')) {
                    $dsDate = $this->input->post('collectionDate');
                    $df = DateTime::createFromFormat('m-d-Y', $dsDate);
                    $ct = strtotime($df->format('Y-m-d'));
                }

                $dsParams = array(
                    'signature' => $sigFileName,
                    'date' => $this->input->post('date'),
                    'workerName' => $this->input->post('workerName'),
                    'workerId' => $this->input->post('workerId'),
                    'siteId' => (int) $w['siteIdW'],
                    'dsSiteId' => $this->input->post('dsSiteId'),
                    'contractorId' => $this->input->post('contractorId'),
                    'subcontractorId' => $this->input->post('subcontractorId'),
                    'identificationId' => $this->input->post('identificationId'),
                    'donor' => $this->input->post('donor'),
                    /*'donorId' => $this->input->post('donorId'),
                    'identificationType' => $this->input->post('identificationType'),
                    'otherIdType' => ($this->input->post('identificationType') == 'OTHER') ? $this->input->post('otherIdType') : '',
                    'employerNotInList' => $this->input->post('employerNotInList'),
                    'otherEmployerName' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherEmployerName') : '',
                    'otherComContactName' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComContactName') : '',
                    'otherComPhone' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComPhone') : '',*/
                    /*'otherComEmail' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComEmail') : '',*/
                    /*'otherComBy' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComBy') : '',
                    'siteNotInList' => $this->input->post('siteNotInList'),
                    'otherSiteName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteName') : '',
                    'otherSiteContactName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteContactName') : '',
                    'otherSitePhone' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSitePhone') : '',
                    'otherSiteEmail' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteEmail') : '',
                    'otherSiteBy' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteBy') : '',*/
                    'der' => $this->input->post('der'),
                    'isPrevious' => $this->input->post('isPrevious'),
                    'cardNumber' => $this->input->post('cardNumber'),
                    'reason' => $this->input->post('reason'),
                    'isTT1' => $this->input->post('isTT1'),
                    'tt1Id' => $this->input->post('tt1Id'),
                    'tt1' => $this->input->post('tt1'),
                    'tt1ExpDate' => $this->input->post('tt1ExpDate'),
                    'isTT2' => $this->input->post('isTT2'),
                    'tt2' => $this->input->post('tt2'),
                    'tt2ExpDate' => $this->input->post('tt2ExpDate'),
                    'isTT3' => $this->input->post('isTT3'),
                    'tt3' => $this->input->post('tt3'),
                    'tt3ExpDate' => $this->input->post('tt3ExpDate'),
                    /*'refusalOfTest' => $this->input->post('refusalOfTest'),*/
                    'testResult' => $this->input->post('testResult'),
                    'specimenId' => ($this->input->post('testResult') != 'Negative' && $this->input->post('testResult') != 'Refused To Test') ? $this->input->post('specimenId')  : '',
                    'inconclusiveDetails' => ($this->input->post('testResult') != 'Negative' && $this->input->post('testResult') != 'Refused To Test') ? $this->input->post('inconclusiveDetails')  : '',
                    'comments' => $this->input->post('comments'),
                    'collectionDate' => $this->input->post('collectionDate'),
                    'collectionSite' => $this->input->post('collectionSite'),
                    'collector' => $this->input->post('collector'),
                    'collectorSignature' => $collSigFileName,
                    'creatingTime' => $ct
                );
                
                $ds_id = $this->Drug_screening_model->add_drug_screening($dsParams);

                /*if($this->input->post('employerNotInList') == 'YES') {

                    $message = 'An unregistered company has been added with the following information:';

                    $message .= PHP_EOL . PHP_EOL;

                    $message .= 'Name Of Company: ' . $this->input->post('otherEmployerName');

                    $message .= PHP_EOL;

                    $message .= 'Contact Name: ' . $this->input->post('otherComContactName');

                    $message .= PHP_EOL;

                    $message .= 'Phone: ' . $this->input->post('otherComPhone');

                    $message .= PHP_EOL;

                    $message .= 'Email: ' . $this->input->post('otherComEmail');

                    $message .= PHP_EOL;

                    $message .= 'Added By: ' . $this->input->post('otherComBy');

                    $subject = 'NEW UNLISTED COMPANY';

                    $admin_emails = explode('/', ADMIN_EMAIL);

                    foreach ($admin_emails as $email) {
                        $this->sendEmail($email, $subject, $message, null);
                    }

                }*/

                if($this->input->post('testResult') == 'Inconclusive; Sent for further testing') {

                    $site = $this->Site_model->get_site((int) $w['siteIdW']);

                    $companyName = '';

                    /*if($this->input->post('employerNotInList') == 'YES') {

                        $companyName = $this->input->post('otherEmployerName');

                    } else {*/

                        $company = $this->Company_model->get_company((int) $this->input->post('subcontractorId'));

                        $companyName = $company['companyName'];

                    /*}*/

                    $message = 'An inconclusive result has been reported for a drug screening with the following information:';

                    $message .= PHP_EOL . PHP_EOL;

                    $message .= 'Date Of Test: ' . $this->input->post('date');

                    $message .= PHP_EOL;

                    $message .= 'Name Of Worker: ' . $this->input->post('workerName');

                    $message .= PHP_EOL;

                    $message .= 'Site Name: ' . $site['siteName'];

                    $message .= PHP_EOL;

                    $message .= 'Company Name: ' . $companyName;

                    $message .= PHP_EOL;

                    $message .= 'Collection Date: ' . $this->input->post('collectionDate');

                    $message .= PHP_EOL;

                    $message .= 'Collector\'s Name: ' . $this->input->post('collector');

                    $message .= PHP_EOL;

                    $message .= 'Specimen ID: ' . $this->input->post('specimenId');

                    $message .= PHP_EOL;

                    $message .= 'Inconclusive Details: ' . $this->input->post('inconclusiveDetails');

                    $subject = 'NEW INCLUSIVE TEST';

                    $admin_emails = explode('/', ADMIN_EMAIL);

                    foreach ($admin_emails as $email) {
                        $this->sendEmail($email, $subject, $message, null);
                    }

                }

            }

            if(isset($_POST['view_ds'])) {

                $dsId = $this->input->post('dsId');

                $data['ds'] = $this->Drug_screening_model->get_drug_screening($dsId);

                $data['_modal'] = 'drug_screening/ds-view-modal';

            }

            if(isset($_POST['edit_ds'])) {

                $dsId = $this->input->post('dsId');

                $data['ds'] = $this->Drug_screening_model->get_drug_screening($dsId);

                $data['_modal'] = 'drug_screening/ds-edition-modal';

            }


            if(isset($_POST['print_ds'])) {

                $dsId = (int) $this->input->post('dsId');

                $data['ds'] = $this->Drug_screening_model->get_drug_screening($dsId);

                $dsFile = $this->pDS($data);

                $downloadableFile = array(
                    'filename' => 'DrugScreening#' . $dsId . '_' . time() . '.pdf',
                    'mimetype' => 'application/pdf'
                );
                

                header('Content-disposition: attachment; filename='. $downloadableFile['filename']);
                header('Content-type: ' . $downloadableFile['mimetype']);
                header('Content-Length: ' . filesize($dsFile));

                ob_clean();
                ob_start();

                readfile($dsFile);

                ob_flush();
                flush();

                exit;

            }

            if(isset($_POST['ds_edition_submit'])) {

                $adsId = $this->input->post('adsId');

                //$siteId = 0;

                //if($this->input->post('siteId') != 0) {

                    //$siteArr = explode('/', $this->input->post('siteId'));

                    //$siteId = $siteArr[0];
                //}
                $ct = '';
                if($this->input->post('collectionDate')) {
                    $dsDate = $this->input->post('collectionDate');
                    $df = DateTime::createFromFormat('m-d-Y', $dsDate);
                    $ct = strtotime($df->format('Y-m-d'));
                }

                $dsParams = array(
                    'date' => $this->input->post('date'),
                    'workerName' => $this->input->post('workerName'),
                    'workerId' => $this->input->post('workerId'),
                    /*'siteId' => (int) $w['siteIdW'],*/
                    /*'siteId' => $siteId,*/
                    'dsSiteId' => $this->input->post('dsSiteId'),
                    'contractorId' => $this->input->post('contractorId'),
                    'subcontractorId' => $this->input->post('subcontractorId'),
                    'identificationId' => $this->input->post('identificationId'),
                    'donor' => $this->input->post('donor'),
                    /*'donorId' => $this->input->post('donorId'),
                    'identificationType' => $this->input->post('identificationType'),
                    'otherIdType' => ($this->input->post('identificationType') == 'OTHER') ? $this->input->post('otherIdType') : '',
                    'employer' => $this->input->post('employer'),
                    'employerNotInList' => $this->input->post('employerNotInList'),
                    'otherEmployerName' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherEmployerName') : '',
                    'otherComContactName' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComContactName') : '',
                    'otherComPhone' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComPhone') : '',*/
                    /*'otherComEmail' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComEmail') : '',*/
                    /*'siteNotInList' => $this->input->post('siteNotInList'),
                    'otherSiteName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteName') : '',
                    'otherSiteContactName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteContactName') : '',
                    'otherSitePhone' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSitePhone') : '',
                    'otherSiteEmail' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteEmail') : '',*/
                    'der' => $this->input->post('der'),
                    'isPrevious' => $this->input->post('isPrevious'),
                    'cardNumber' => $this->input->post('cardNumber'),
                    'reason' => $this->input->post('reason'),
                    'isTT1' => $this->input->post('isTT1'),
                    'tt1Id' => $this->input->post('tt1Id'),
                    'tt1' => $this->input->post('tt1'),
                    'tt1ExpDate' => $this->input->post('tt1ExpDate'),
                    'isTT2' => $this->input->post('isTT2'),
                    'tt2' => $this->input->post('tt2'),
                    'tt2ExpDate' => $this->input->post('tt2ExpDate'),
                    'isTT3' => $this->input->post('isTT3'),
                    'tt3' => $this->input->post('tt3'),
                    'tt3ExpDate' => $this->input->post('tt3ExpDate'),
                    /*'refusalOfTest' => $this->input->post('refusalOfTest'),*/
                    'testResult' => $this->input->post('testResult'),
                    'specimenId' => ($this->input->post('testResult') != 'Negative' && $this->input->post('testResult') != 'Refused To Test') ? $this->input->post('specimenId')  : '',
                    'inconclusiveDetails' => ($this->input->post('testResult') != 'Negative' && $this->input->post('testResult') != 'Refused To Test') ? $this->input->post('inconclusiveDetails')  : '',
                    'comments' => $this->input->post('comments'),
                    'collectionDate' => $this->input->post('collectionDate'),
                    'collectionSite' => $this->input->post('collectionSite'),
                    'collector' => $this->input->post('collector'),
                    'creatingTime' => $ct
                );

                $data['ds'] = $this->Drug_screening_model->update_drug_screening($adsId, $dsParams);

                if($this->input->post('testResult') == 'Inconclusive; Sent for further testing') {

                    $site = $this->Site_model->get_site((int) $w['siteIdW']);

                    $companyName = '';

                    /*if($this->input->post('employerNotInList') == 'YES') {

                        $companyName = $this->input->post('otherEmployerName');

                    } else {*/

                        $company = $this->Company_model->get_company((int) $this->input->post('subcontractorId'));

                        $companyName = $company['companyName'];

                    /*}*/

                    $message = 'An inconclusive result has been reported for a drug screening with the following information:';

                    $message .= PHP_EOL . PHP_EOL;

                    $message .= 'Date Of Test: ' . $this->input->post('date');

                    $message .= PHP_EOL;

                    $message .= 'Name Of Worker: ' . $this->input->post('workerName');

                    $message .= PHP_EOL;

                    $message .= 'Site Name: ' . $site['siteName'];

                    $message .= PHP_EOL;

                    $message .= 'Company Name: ' . $companyName;

                    $message .= PHP_EOL;

                    $message .= 'Collection Date: ' . $this->input->post('collectionDate');

                    $message .= PHP_EOL;

                    $message .= 'Collector\'s Name: ' . $this->input->post('collector');

                    $message .= PHP_EOL;

                    $message .= 'Specimen ID: ' . $this->input->post('specimenId');

                    $message .= PHP_EOL;

                    $message .= 'Inconclusive Details: ' . $this->input->post('inconclusiveDetails');

                    $subject = 'NEW INCLUSIVE TEST';

                    $admin_emails = explode('/', ADMIN_EMAIL);

                    foreach ($admin_emails as $email) {
                        $this->sendEmail($email, $subject, $message, null);
                    }

                }

            }

            if(isset($_POST['at_add'])) {

                $data['wid'] = $wid;
                $data['wfn'] = $wfn;
                $data['wuid'] = $wuid;

                $data['_modal'] = 'alcohol_test/at-addition-modal';


            }

            if(isset($_POST['at_submit'])) {

                $sigFileName = null;

                if($this->input->post('signature')) {

                    $encoded_image = explode(',', $this->input->post('signature'))[1];
                    $decoded_image = base64_decode($encoded_image);

                    $sigFileName = 'ws' . time() . '.png';

                    file_put_contents(FCPATH . 'resources/signatures/' . $sigFileName, $decoded_image);

                }

                $collSigFileName = null;

                if($this->input->post('collectorSignature')) {

                    $coll_encoded_image = explode(',', $this->input->post('collectorSignature'))[1];
                    $coll_decoded_image = base64_decode($coll_encoded_image);

                    $collSigFileName = 'cs' . time() . '.png';

                    file_put_contents(FCPATH . 'resources/signatures/' . $collSigFileName, $coll_decoded_image);

                }

                //$siteId = 0;

                //if($this->input->post('siteId') != 0) {

                    /*$siteArr = explode('/', $this->input->post('siteId'));

                    $siteId = $siteArr[0];*/
                //}
                $ct = '';
                if($this->input->post('collectionDate')) {
                    $dsDate = $this->input->post('collectionDate');
                    $df = DateTime::createFromFormat('m-d-Y', $dsDate);
                    $ct = strtotime($df->format('Y-m-d'));
                }

                $atParams = array(
                    'signature' => $sigFileName,
                    'date' => $this->input->post('date'),
                    'workerName' => $this->input->post('workerName'),
                    'workerId' => $this->input->post('workerId'),
                    'siteId' => (int) $w['siteIdW'],
                    'contractorId' => $this->input->post('contractorId'),
                    'subcontractorId' => $this->input->post('subcontractorId'),
                    'identificationId' => $this->input->post('identificationId'),
                    'donor' => $this->input->post('donor'),
                    /*'donorId' => $this->input->post('donorId'),
                    'identificationType' => $this->input->post('identificationType'),
                    'otherIdType' => ($this->input->post('identificationType') == 'OTHER') ? $this->input->post('otherIdType') : '',
                    'employerNotInList' => $this->input->post('employerNotInList'),
                    'otherEmployerName' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherEmployerName') : '',
                    'otherComContactName' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComContactName') : '',
                    'otherComPhone' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComPhone') : '',*/
                    /*'otherComEmail' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComEmail') : '',*/
                    /*'otherComBy' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComBy') : '',
                    'siteNotInList' => $this->input->post('siteNotInList'),
                    'otherSiteName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteName') : '',
                    'otherSiteContactName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteContactName') : '',
                    'otherSitePhone' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSitePhone') : '',
                    'otherSiteEmail' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteEmail') : '',
                    'otherSiteBy' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteBy') : '',*/
                    'der' => $this->input->post('der'),
                    'isPrevious' => $this->input->post('isPrevious'),
                    'cardNumber' => $this->input->post('cardNumber'),
                    'reason' => $this->input->post('reason'),
                    'isTT1' => $this->input->post('isTT1'),
                    'tt1Id' => $this->input->post('tt1Id'),
                    'tt1' => $this->input->post('tt1'),
                    'tt1ExpDate' => $this->input->post('tt1ExpDate'),
                    'isTT2' => $this->input->post('isTT2'),
                    'tt2' => $this->input->post('tt2'),
                    'tt2ExpDate' => $this->input->post('tt2ExpDate'),
                    'isTT3' => $this->input->post('isTT3'),
                    'tt3' => $this->input->post('tt3'),
                    'tt3ExpDate' => $this->input->post('tt3ExpDate'),
                    'isTT4' => $this->input->post('isTT4'),
                    'tt4' => $this->input->post('tt4'),
                    'tt4ExpDate' => $this->input->post('tt4ExpDate'),
                    /*'refusalOfTest' => $this->input->post('refusalOfTest'),*/
                    'testResult' => $this->input->post('testResult'),
                    'specimenId' => ($this->input->post('testResult') != 'Negative' && $this->input->post('testResult') != 'Refused To Test') ? $this->input->post('specimenId')  : '',
                    'inconclusiveDetails' => ($this->input->post('testResult') != 'Negative' && $this->input->post('testResult') != 'Refused To Test') ? $this->input->post('inconclusiveDetails')  : '',
                    'comments' => $this->input->post('comments'),
                    'collectionDate' => $this->input->post('collectionDate'),
                    'collectionSite' => $this->input->post('collectionSite'),
                    'collector' => $this->input->post('collector'),
                    'collectorSignature' => $collSigFileName,
                    'creatingTime' => $ct
                );
                
                $at_id = $this->Alcohol_test_model->add_alcohol_test($atParams);

                /*if($this->input->post('employerNotInList') == 'YES') {

                    $message = 'An unregistered company has been added with the following information:';

                    $message .= PHP_EOL . PHP_EOL;

                    $message .= 'Name Of Company: ' . $this->input->post('otherEmployerName');

                    $message .= PHP_EOL;

                    $message .= 'Contact Name: ' . $this->input->post('otherComContactName');

                    $message .= PHP_EOL;

                    $message .= 'Phone: ' . $this->input->post('otherComPhone');

                    $message .= PHP_EOL;

                    $message .= 'Email: ' . $this->input->post('otherComEmail');

                    $message .= PHP_EOL;

                    $message .= 'Added By: ' . $this->input->post('otherComBy');

                    $subject = 'NEW UNLISTED COMPANY';

                    $admin_emails = explode('/', ADMIN_EMAIL);

                    foreach ($admin_emails as $email) {
                        $this->sendEmail($email, $subject, $message, null);
                    }

                }*/

                /*if($this->input->post('testResult') == 'Inconclusive; Sent for further testing') {

                    $site = $this->Site_model->get_site((int) $this->input->post('siteId'));

                    $companyName = '';

                    if($this->input->post('employerNotInList') == 'YES') {

                        $companyName = $this->input->post('otherEmployerName');

                    } else {

                        $company = $this->Company_model->get_company((int) $this->input->post('subcontractorId'));

                        $companyName = $company['companyName'];

                    }

                    $message = 'An inconclusive result has been reported for a drug screening with the following information:';

                    $message .= PHP_EOL . PHP_EOL;

                    $message .= 'Date Of Test: ' . $this->input->post('date');

                    $message .= PHP_EOL;

                    $message .= 'Name Of Worker: ' . $this->input->post('workerName');

                    $message .= PHP_EOL;

                    $message .= 'Site Name: ' . $site['siteName'];

                    $message .= PHP_EOL;

                    $message .= 'Company Name: ' . $companyName;

                    $message .= PHP_EOL;

                    $message .= 'Collection Date: ' . $this->input->post('collectionDate');

                    $message .= PHP_EOL;

                    $message .= 'Collector\'s Name: ' . $this->input->post('collector');

                    $message .= PHP_EOL;

                    $message .= 'Specimen ID: ' . $this->input->post('specimenId');

                    $message .= PHP_EOL;

                    $message .= 'Inconclusive Details: ' . $this->input->post('inconclusiveDetails');

                    $subject = 'NEW INCLUSIVE TEST';

                    $admin_emails = explode('/', ADMIN_EMAIL);

                    foreach ($admin_emails as $email) {
                        //$this->sendEmail($email, $subject, $message, null);
                    }

                }*/

            }

            if(isset($_POST['view_at'])) {

                $atId = $this->input->post('atId');

                $data['at'] = $this->Alcohol_test_model->get_alcohol_test($atId);

                $data['_modal'] = 'alcohol_test/at-view-modal';

            }

            if(isset($_POST['edit_at'])) {

                $atId = $this->input->post('atId');

                $data['at'] = $this->Alcohol_test_model->get_alcohol_test($atId);

                $data['_modal'] = 'alcohol_test/at-edition-modal';

            }


            if(isset($_POST['print_at'])) {

                $atId = (int) $this->input->post('atId');

                $data['at'] = $this->Alcohol_test_model->get_alcohol_test($atId);

                $atFile = $this->pAT($data);

                $downloadableFile = array(
                    'filename' => 'AlcoholTest#' . $atId . '_' . time() . '.pdf',
                    'mimetype' => 'application/pdf'
                );
                

                header('Content-disposition: attachment; filename='. $downloadableFile['filename']);
                header('Content-type: ' . $downloadableFile['mimetype']);
                header('Content-Length: ' . filesize($atFile));

                ob_clean();
                ob_start();

                readfile($atFile);

                ob_flush();
                flush();

                exit;

            }

            if(isset($_POST['at_edition_submit'])) {

                $aatId = $this->input->post('aatId');

                //$siteId = 0;

                //if($this->input->post('siteId') != 0) {

                    //$siteArr = explode('/', $this->input->post('siteId'));

                    //$siteId = $siteArr[0];
                //}
                $ct = '';
                if($this->input->post('collectionDate')) {
                    $dsDate = $this->input->post('collectionDate');
                    $df = DateTime::createFromFormat('m-d-Y', $dsDate);
                    $ct = strtotime($df->format('Y-m-d'));
                }

                $atParams = array(
                    'date' => $this->input->post('date'),
                    'workerName' => $this->input->post('workerName'),
                    'workerId' => $this->input->post('workerId'),
                    /*'siteId' => (int) $w['siteIdW'],*/
                    /*'siteId' => $siteId,*/
                    'contractorId' => $this->input->post('contractorId'),
                    'subcontractorId' => $this->input->post('subcontractorId'),
                    'identificationId' => $this->input->post('identificationId'),
                    'donor' => $this->input->post('donor'),
                    /*'donorId' => $this->input->post('donorId'),
                    'identificationType' => $this->input->post('identificationType'),
                    'otherIdType' => ($this->input->post('identificationType') == 'OTHER') ? $this->input->post('otherIdType') : '',
                    'employer' => $this->input->post('employer'),
                    'employerNotInList' => $this->input->post('employerNotInList'),
                    'otherEmployerName' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherEmployerName') : '',
                    'otherComContactName' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComContactName') : '',
                    'otherComPhone' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComPhone') : '',*/
                    /*'otherComEmail' => ($this->input->post('employerNotInList') == 'YES') ? $this->input->post('otherComEmail') : '',*/
                    /*'siteNotInList' => $this->input->post('siteNotInList'),
                    'otherSiteName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteName') : '',
                    'otherSiteContactName' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteContactName') : '',
                    'otherSitePhone' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSitePhone') : '',
                    'otherSiteEmail' => ($this->input->post('siteNotInList') == 'YES') ? $this->input->post('otherSiteEmail') : '',*/
                    'der' => $this->input->post('der'),
                    'isPrevious' => $this->input->post('isPrevious'),
                    'cardNumber' => $this->input->post('cardNumber'),
                    'reason' => $this->input->post('reason'),
                    'isTT1' => $this->input->post('isTT1'),
                    'tt1Id' => $this->input->post('tt1Id'),
                    'tt1' => $this->input->post('tt1'),
                    'tt1ExpDate' => $this->input->post('tt1ExpDate'),
                    'isTT2' => $this->input->post('isTT2'),
                    'tt2' => $this->input->post('tt2'),
                    'tt2ExpDate' => $this->input->post('tt2ExpDate'),
                    'isTT3' => $this->input->post('isTT3'),
                    'tt3' => $this->input->post('tt3'),
                    'tt3ExpDate' => $this->input->post('tt3ExpDate'),
                    'isTT4' => $this->input->post('isTT4'),
                    'tt4' => $this->input->post('tt4'),
                    'tt4ExpDate' => $this->input->post('tt4ExpDate'),
                    /*'refusalOfTest' => $this->input->post('refusalOfTest'),*/
                    'testResult' => $this->input->post('testResult'),
                    'specimenId' => ($this->input->post('testResult') != 'Negative' && $this->input->post('testResult') != 'Refused To Test') ? $this->input->post('specimenId')  : '',
                    'inconclusiveDetails' => ($this->input->post('testResult') != 'Negative' && $this->input->post('testResult') != 'Refused To Test') ? $this->input->post('inconclusiveDetails')  : '',
                    'comments' => $this->input->post('comments'),
                    'collectionDate' => $this->input->post('collectionDate'),
                    'collectionSite' => $this->input->post('collectionSite'),
                    'collector' => $this->input->post('collector'),
                    'creatingTime' => $ct
                );

                $data['at'] = $this->Alcohol_test_model->update_alcohol_test($aatId, $atParams);

            }

            if(isset($_POST['nods_add'])) {

                $data['wid'] = $wid;

                $data['_modal'] = 'non_ohs_ds/non-ohs-ds-modal';


            }

            if(isset($_POST['non_ohs_ds_submit'])) {

                $nodsParams = array(
                    'date' => $this->input->post('date'),
                    'workerId' => $this->input->post('workerId'),
                    'providingCompany' => $this->input->post('providingCompany'),
                    'notes' => $this->input->post('notes')
                );
                
                $nods_id = $this->Non_ohs_drug_screening_model->add_non_ohs_drug_screening($nodsParams);

            }

            if(isset($_POST['edit_nods'])) {

                $nodsId = $this->input->post('nodsId');

                $data['nods'] = $this->Non_ohs_drug_screening_model->get_non_ohs_drug_screening($nodsId);

                $data['_modal'] = 'non_ohs_ds/non-ohs-ds-edit-modal';


            }

            if(isset($_POST['non_ohs_ds_edit'])) {

                $anodsId = $this->input->post('anodsId');

                $nodsParams = array(
                    'date' => $this->input->post('date'),
                    'workerId' => $this->input->post('workerId'),
                    'providingCompany' => $this->input->post('providingCompany'),
                    'notes' => $this->input->post('notes')
                );
                
                $nods_id = $this->Non_ohs_drug_screening_model->update_non_ohs_drug_screening($anodsId, $nodsParams);

            }

            if(isset($_POST['print_ds'])) {

                $dsId = $this->input->post('dsId');


            }

            if(isset($_POST['cert_submit'])) {

                $front = null;
                $back = null;

                if($_FILES['backOfCert']) {

                    $backFile = $_FILES['backOfCert'];

                    if($backFile['name']) {

                        $filename_array = explode('.',$backFile['name']);
                        $size = count($filename_array);
                        $extension = $filename_array[$size - 1];
                        $fileName = 'cert_back_' . time() . '.' . $extension;

                        //var_dump($newFileName1);

                        move_uploaded_file($backFile['tmp_name'], FCPATH . 'resources/workers/' . $fileName);

                        $back = site_url('resources/certifications/') . $fileName;

                    }
                }

                if($this->input->post('certBackDataURI')) {

                    $back = $this->input->post('certBackDataURI');

                }

                if($_FILES['frontOfCert']) {

                    $frontFile = $_FILES['frontOfCert'];

                    if($frontFile['name']) {

                        $filename_array = explode('.',$frontFile['name']);
                        $size = count($filename_array);
                        $extension = $filename_array[$size - 1];
                        $fileName = 'cert_front_' . time() . '.' . $extension;

                        //var_dump($newFileName1);

                        move_uploaded_file($frontFile['tmp_name'], FCPATH . 'resources/workers/' . $fileName);

                        $front = site_url('resources/certifications/') . $fileName;

                    }
                }

                if($this->input->post('certFrontDataURI')) {

                    $front = $this->input->post('certFrontDataURI');
                    
                }

                $certParams = array(
                    'date' => $this->input->post('date'),
                    'estId' => $this->input->post('estId'),
                    'expirationDate' => $this->input->post('expirationDate'),
                    'workerId' => $this->input->post('workerId'),
                    'frontOfCertification' => $front,
                    'backOfCertification' => $back,
                    'administeredBy' => $this->input->post('administeredBy'),
                    'scaffold' => $this->input->post('scaffold')
                );
                
                $certification_id = $this->Certification_model->add_certification($certParams);

            }

            if(isset($_POST['remove_cert'])) {

                $certId = $this->input->post('certId');

                
                $this->Certification_model->delete_certification($certId);
                    
                
            }

            if(isset($_POST['rc_exam_submit'])) {

                $examParams = array(
                    'dateOfExam' => $this->input->post('dateOfExam'),
                    'worker_id' => $this->input->post('workerId'),
                    'cleared' => $this->input->post('cleared'),
                    'typeOfExamination' => ($this->input->post('typeOfExamination') == 'OTHER') ? $this->input->post('other-type') : $this->input->post('typeOfExamination'),
                    'physicalExamination' => ($this->input->post('physicalExamination') == 'Abnormal') ? $this->input->post('abnormalPhysical') : $this->input->post('physicalExamination'),
                    'chestXray' => ($this->input->post('chestXray') == 'Abnormal') ? $this->input->post('abnormalChestXray') : $this->input->post('chestXray'),
                    'breathingTest' => ($this->input->post('breathingTest') == 'Abnormal') ? $this->input->post('abnormalBreathing') : $this->input->post('breathingTest'),
                    'testForTuberculosis' => ($this->input->post('testForTuberculosis') == 'Abnormal') ? $this->input->post('abnormalTuberculosis') : $this->input->post('testForTuberculosis'),
                    'otherTestName' => $this->input->post('otherTestName'),
                    'otherTest' => ($this->input->post('otherTest') == 'Abnormal') ? $this->input->post('abnormalOther') : $this->input->post('otherTest'),
                    'risk' => $this->input->post('risk'),
                    'causeOfRisk' => $this->input->post('causeOfRisk')
                );

                //var_dump($examParams); die();
                
                $rc_exam_id = $this->Respirator_clearance_model->add_respirator_clearance($examParams);

                //echo $rc_exam_id; die();

            }

            if(isset($_POST['upload_emple_report'])) {

                $reportFile = $_FILES['fileToUpload_emple'];

                $reportFileName = '';
                $fileSize = 0;
                $mimeType = '';

                if($reportFile) {

                    if($reportFile['name']) {

                        $filename_array = explode('.',$reportFile['name']);
                        $mimeType = $reportFile['type'];
                        $fileSize = $reportFile['size'];
                        $size = count($filename_array);
                        $extension = $filename_array[$size - 1];
                        $rfn = $filename_array[$size - 2];
                        $reportFileName = $rfn . '_' . time() . '.' . $extension;

                        //var_dump($newFileName1);

                        move_uploaded_file($reportFile['tmp_name'], FCPATH . 'resources/reports/' . $reportFileName);

                    }

                    $reportParams = array(
                        'dateOfUpload' => date('m-d-Y'),
                        'workerId' => $this->input->post('workerId'),
                        'for' => 'Employee',
                        'filename' => $reportFileName,
                        'size' => $fileSize,
                        'mimetype' => $mimeType
                    );

                    $this->Report_model->add_report($reportParams);

                    //var_dump($reportParams); die();

                }

            }

            if(isset($_POST['upload_emplr_report'])) {

                $reportFile = $_FILES['fileToUpload_emplr'];

                $reportFileName = '';
                $fileSize = 0;
                $mimeType = '';

                if($reportFile) {

                    if($reportFile['name']) {

                        $filename_array = explode('.',$reportFile['name']);
                        $mimeType = $reportFile['type'];
                        $fileSize = $reportFile['size'];
                        $size = count($filename_array);
                        $extension = $filename_array[$size - 1];
                        $rfn = $filename_array[$size - 2];
                        $reportFileName = $rfn . '_' . time() . '.' . $extension;

                        //var_dump($newFileName1);

                        move_uploaded_file($reportFile['tmp_name'], FCPATH . 'resources/reports/' . $reportFileName);

                    }

                    $reportParams = array(
                        'dateOfUpload' => date('m-d-Y'),
                        'workerId' => $this->input->post('workerId'),
                        'for' => 'Employer',
                        'filename' => $reportFileName,
                        'size' => $fileSize,
                        'mimetype' => $mimeType
                    );

                    $this->Report_model->add_report($reportParams);

                    //var_dump($reportParams); die();

                }

            }

            if(isset($_POST['download_file'])) {

                $reportId = $this->input->post('reportId');

                $this->_download($reportId);

            }

            if(isset($_POST['remove_report'])) {

                $reportId = $this->input->post('reportId');

                
                $this->Report_model->delete_report($reportId);
                    
                
            }

            if(isset($_POST['incident_add'])) {

                $data['workerId'] = $wid;

                $msArray = $this->_getMedicalSupplies(0);

                $data['medical_supplies'] = $msArray;

                $incident = array(

                    'date' => date('m-d-Y'),
                    'type' => 'FIRST AID',
                    'service' => '',
                    'ohsStaffId' => 0,
                    'siteId' => 0,
                    'msLocation' => '',
                    'msDate' => date('m-d-Y'),
                    'msAddressLine1' => '',
                    'msAddressLine2' => '',
                    'msTotal' => 00.00
                
                );

                $data['incident'] = $incident;

                $data['_modal'] = 'incident/incident-add-modal';

                //var_dump($data);
                //die();


            }

            if(isset($_POST['save_incident'])) {

                $incident = $this->input->post('incident');

                $siteDetails = $incident['siteId'];

                $siteData = explode('|', $siteDetails);

                $incident['siteId'] = (int) $siteData[0];

                $medicalSupplies = $this->input->post('ms');

                $medS = array();

                $mt = 0.0;

                foreach ($medicalSupplies as $ms) {

                    $lt = (float) $ms['quantity'] * (float) $ms['unitPrice'];

                    $mt = $mt + $lt;

                    $m = array(

                        'description' => $ms['description'],
                        'quantity' => (float) $ms['quantity'],
                        'unitPrice' => (float) $ms['unitPrice'],
                        'lineTotal' => (float) $lt

                    );

                    array_push($medS, $m);

                }

                $incident['msTotal'] = $mt;

                $msJson = json_encode($medS);
                
                $incident['msJson'] = $msJson;

                $incidentId = $this->Incident_model->add_incident($incident);


            }

            if(isset($_POST['edit_incident'])) {

                $iId = (int) $this->input->post('incidentId');

                $inc = $this->Incident_model->get_incident($iId);

                $msJson = $inc['msJson'];

                $medical_supplies = json_decode($msJson);

                $data['iId'] = $iId;

                $data['incident'] = $inc;

                $data['medical_supplies'] = $medical_supplies;

                //var_dump($data); die();

                $data['_modal'] = 'incident/incident-edit-modal';


            }

            if(isset($_POST['update_incident'])) {

                $iId = (int) $this->input->post('iId');

                $incident = $this->input->post('incident');

                $siteDetails = $incident['siteId'];

                $siteData = explode('|', $siteDetails);

                $incident['siteId'] = (int) $siteData[0];

                $medicalSupplies = $this->input->post('ms');

                $medS = array();

                $mt = 0.0;

                foreach ($medicalSupplies as $ms) {

                    $lt = (float) $ms['quantity'] * (float) $ms['unitPrice'];

                    $mt = $mt + $lt;

                    $m = array(

                        'description' => $ms['description'],
                        'quantity' => (float) $ms['quantity'],
                        'unitPrice' => (float) $ms['unitPrice'],
                        'lineTotal' => (float) $lt

                    );

                    array_push($medS, $m);

                }

                $incident['msTotal'] = $mt;

                $msJson = json_encode($medS);
                
                $incident['msJson'] = $msJson;

                $this->Incident_model->update_incident($iId, $incident);


            }

            $data['certs'] = $this->Certification_model->get_worker_certifications($id);
            $data['rcs'] = $this->Respirator_clearance_model->get_worker_respirator_clearances($id);
            $data['all_reports_for_employer'] = $this->Report_model->get_worker_reports_for_employer($id);
            $data['all_reports_for_employee'] = $this->Report_model->get_worker_reports_for_employee($id);
            $data['dss'] = $this->Drug_screening_model->get_worker_drug_screenings($id);
            $data['nodss'] = $this->Non_ohs_drug_screening_model->get_worker_non_ohs_drug_screenings($id);
            $data['ats'] = $this->Alcohol_test_model->get_worker_alcohol_tests($id);

            /*$data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();
            $data['all_ests'] = $this->EST_model->get_all_ests();
            $data['all_companies'] = $this->Company_model->get_all_companies();
            $data['all_sites'] = $this->Site_model->get_all_sites();
            $data['all_scs'] = $this->Company_model->get_all_subcontructors();*/

            $data['incidents'] = $this->Incident_model->get_worker_incidents($id);

            $data['_view'] = 'worker/edit';
            $this->load->view('layouts/main',$data);


        }
        else
        {

            $data['certs'] = $this->Certification_model->get_worker_certifications($id);
            $data['rcs'] = $this->Respirator_clearance_model->get_worker_respirator_clearances($id);
            $data['all_reports_for_employer'] = $this->Report_model->get_worker_reports_for_employer($id);
            $data['all_reports_for_employee'] = $this->Report_model->get_worker_reports_for_employee($id);
            $data['dss'] = $this->Drug_screening_model->get_worker_drug_screenings($id);
            $data['nodss'] = $this->Non_ohs_drug_screening_model->get_worker_non_ohs_drug_screenings($id);
            $data['ats'] = $this->Alcohol_test_model->get_worker_alcohol_tests($id);

            /*$data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();
            $data['all_ests'] = $this->EST_model->get_all_ests();
            $data['all_companies'] = $this->Company_model->get_all_companies();
            $data['all_sites'] = $this->Site_model->get_all_sites();
            $data['all_scs'] = $this->Company_model->get_all_subcontructors();*/

            $data['incidents'] = $this->Incident_model->get_worker_incidents($id);

            $data['_view'] = 'worker/edit';
            $this->load->view('layouts/main',$data);
            

        }

    }

    private function pDS($data) {

        $dirPDF = FCPATH . 'resources/drugScreenings/';

        $pdfFile = $dirPDF . 'DrugScreening_' . $data['ds']['id'] . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        /*$data = array(
            'ds' => $data['ds']
        );*/

        $content = $this->load->view('print/drug_screening', $data, true);

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

    }

    private function pAT($data) {

        $dirPDF = FCPATH . 'resources/alcoholTests/';

        $pdfFile = $dirPDF . 'AlcoholTest_' . $data['at']['id'] . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        /*$data = array(
            'ds' => $data['ds']
        );*/

        $content = $this->load->view('print/alcohol_test', $data, true);

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

    }

    /*
     * Deleting worker
     */
    function remove($id)
    {
        $data['user_session'] = $this->data;
        $worker = $this->Worker_model->get_worker($id);

        // check if the worker exists before trying to delete it
        if(isset($worker['id']) && $data['user_session']['userType'] == 'ADMIN')
        {
            $this->Worker_model->delete_worker($id);
            redirect('worker/index');
        }
        else
            show_error('The worker you are trying to delete does not exist.');
    }

    public function getWorker() {

        $response = array();

        try {

            $id = $this->input->get('id');


            $worker = $this->Worker_model->get_worker($id);

            $status = $this->User_status_model->get_user_status((int)$worker['statusId']);

            $worker['status'] = $status['title'];

            if((int)$worker['companyId'] > 0) {

                $company = $this->Company_model->get_company((int)$worker['companyId']);

                $worker['companyName'] = $company['companyName'];

            } else {

                 $worker['companyName'] = $worker['otherCompanyName'];

            }

            if((int)$worker['siteIdW'] > 0) {

                $site = $this->Site_model->get_site((int)$worker['siteIdW']);

                $worker['siteName'] = $site['siteName'];

            } else {

                 $worker['siteName'] = $worker['otherSiteName'];
                 
            }

            /*$worker['cs'] = $this->_show_assigned_companies($worker['companies']);
            $worker['scs'] = $this->_show_assigned_subcontractors($worker['subcontractors']);
            $worker['ss'] = $this->_show_assigned_sties($worker['sites']);*/

            //var_dump($worker); die();


            $response['status'] = 200;

            if($worker) {

                $response['result'] = 1;
                $response['worker'] = $worker;


            } else {

                $response['result'] = 0;
                $response['worker'] = null;


            }

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

    public function checkIfExists() {
        
        //echo 'hii';
        //die();

        $response = array();

        /*$response['status'] = 200;
        $response['message'] = 'Okay';

        echo json_encode($response);*/

        try {

            $firstName = $this->input->post('firstName');
            $lastName = $this->input->post('lastName');
            $dob = $this->input->post('dob');


            $existingUser = $this->Worker_model->check_for_existing_worker($firstName, $lastName, $dob);


            $response['status'] = 200;

            if($existingUser) {

                $response['result'] = 1;
                $response['workerId'] = $existingUser['id'];
                $response['workerAnchor'] = site_url('worker/edit/' . $existingUser['id']);


            } else {

                $response['result'] = 0;
                $response['workerId'] = 0;
                $response['workerAnchor'] = null;


            }

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

    private function pSticker($uid, $dob, $name) {

        $dirPDF = FCPATH . 'resources/stickers/';

        $pdfFile = $dirPDF . 'S_' . $uid . '.pdf';

        $this->load->library('npdf');

        //$this->npdf->params = '"utf-8", array(86, 20)';
        //$this->npdf('utf-8', array(86, 54));


        $mPDF = $this->npdf->pdf;

        //$mPDF = $this->npdf->load('utf-8, A7');

        //$mPDF = new $this->npdf('utf-8', array(86, 54));
        //$mPDF = $this->npdf('utf-8', array(86, 54));

        $mPDF->debug = true;

        //$this->load->library('zend');
        //load in folder Zend
        //$this->zend->load('Zend/Barcode');
        //generate barcode

        /*$barcodeOptions = array('text' => $product_code, 'barHeight' => $height, 'drawText' => $drawText);
        $rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        $imageResource = Zend_Barcode::render($bcs, 'image', $barcodeOptions, $rendererOptions);*/

        //$rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        //$barcode = Zend_Barcode::render('code128', 'image', array('text'=>$uid), $rendererOptions);

        //die();

        //echo $barcode; die();

        //var_dump($barcode);

        $data = array(
            'name' => $name,
            'dob' => $dob,
            'uid' => $uid
        );

        $content = $this->load->view('print/sticker', $data, true);

        /*$stylesheet = file_get_contents(base_url() . '/assets/css/mpdfstyletables.css');
        $mPDF->WriteHTML($stylesheet, 1);*/

        //$mPDF->WriteHTML('<pagebreak sheet-size="1.125in 3.5in" />');

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

    }

    public function pS() {

        $dirPDF = FCPATH . 'resources/stickers/';

        //$pdfFile = $dirPDF . 'S_' . $uid . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode

        /*$barcodeOptions = array('text' => $product_code, 'barHeight' => $height, 'drawText' => $drawText);
        $rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        $imageResource = Zend_Barcode::render($bcs, 'image', $barcodeOptions, $rendererOptions);*/

        //$rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        //Zend_Barcode::render('code128', 'image', array('text'=>'f48u3q01t35'), $rendererOptions);die();

        $test = Zend_Barcode::render('ean8', 'image', array('text' => '1234565'), array());
        //var_dump($test);

        //var_dump(imagejpeg($test, 'barcode.jpg', 100));
        echo imagejpeg($test, 'barcode.jpg', 100);

        //echo $barcode; die();

        //var_dump($barcode);

        /*$data = array(
            'name' => $name,
            'dob' => $dob,
            'uid' => $uid,
            'barcode' => $barcode
        );

        $content = $this->load->view('print/sticker', $data, true);*/

        /*$stylesheet = file_get_contents(base_url() . '/assets/css/mpdfstyletables.css');
        $mPDF->WriteHTML($stylesheet, 1);*/

        /*$mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;*/

    }

    private function pQRCode($worker) {

        $dirPDF = FCPATH . 'resources/QR Code/';

        $pdfFile = $dirPDF . 'QR_' . $worker['uid'] . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        $data = array(
            'w' => $worker
        );

        $content = $this->load->view('print/qrcode', $data, true);

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

    }

    private function pCard($worker) {

        $dirPDF = FCPATH . 'resources/cards/';

        $pdfFile = $dirPDF . 'C_' . $worker['uid'] . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        $data = array(
            'w' => $worker
        );

        $content = $this->load->view('print/card', $data, true);

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

    }

    public function save_picture() {


        $response = array();

        try {

            $id = $this->input->get('id');

            $imageURI = $this->input->post('imgData');

            $params = array(
                'imageURI' => $imageURI
            );

            $this->Worker_model->update_worker($id, $params);

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

    public function delete_picture() {


        $response = array();

        try {

            $id = $this->input->get('id');

            $params = array(
                'imageURI' => ''
            );

            $this->Worker_model->update_worker($id, $params);

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

    public function upload_reports() {

        if(isset($_POST) && count($_POST) > 0) {

            $reportFile = $_FILES['fileToUpload_emplr'];

            $reportFileName = '';
            $fileSize = 0;
            $mimeType = '';

            if($reportFile) {

                if($reportFile['name']) {

                    $filename_array = explode('.',$reportFile['name']);
                    $mimeType = $reportFile['type'];
                    $fileSize = $reportFile['size'];
                    $size = count($filename_array);
                    $extension = $filename_array[$size - 1];
                    $rfn = $filename_array[$size - 2];
                    $reportFileName = $rfn . '_' . time() . '.' . $extension;

                    //var_dump($newFileName1);

                    move_uploaded_file($reportFile['tmp_name'], FCPATH . 'resources/reports/' . $reportFileName);

                }

                $reportParams = array(
                    'dateOfUpload' => date('m-d-Y'),
                    'workerId' => $this->input->post('workerId'),
                    'for' => 'Employer',
                    'filename' => $reportFileName,
                    'size' => $fileSize,
                    'mimetype' => $mimeType
                );

                var_dump($reportParams); die();

            }

        }    

    }

    private function _download($reportId) {

        $file = $this->Report_model->get_report($reportId);
        $filenameWithPath = FCPATH . 'resources/reports/' . $file['filename'];

        header('Content-disposition: attachment; filename='. $file['filename']);
        header('Content-type: ' . $file['mimetype']);
        header('Content-Length: ' . filesize($filenameWithPath));

        readfile($filenameWithPath);

    }

    public function sigPadTest() {

        $data['user_session'] = $this->data;
        
        
        $data['_view'] = 'drug_screening/test';
        $this->load->view('layouts/main',$data);

    }

    private function _getMedicalSupplies($incidentId) {

        $msArray = array();

        $index = 0;


        $mclSupplies = $this->Medical_supply_model->get_all_medical_supplies();


        if($incidentId > 0) {

            $incident = $this->Incident_model->get_incident($incidentId);

            $msJson = $incident['msJson'];

            $msArray = json_decode($msJson);

        } else {


            foreach ($mclSupplies as $ms) {

                $singleMs = array(

                    'quantity' => 0,
                    'description' => $ms['description'],
                    'unitPrice' => $ms['unitPrice'],
                    'lineTotal' => 00.00

                );

                $msArray[$index] = $singleMs;

                $index = $index + 1;
                
            }


        }


        return $msArray;

    }

    public function _show_assigned_companies($comIds) {


        if($comIds) {

            $cid_str = substr($comIds, 1);

            $cids = explode('/', $cid_str);

            $companies = '';

            foreach ($cids as $cid) {
                
                $c = $this->Company_model->get_company($cid);

                $companies = $companies . '=> ' . $c['companyName'] . '<br>';

            }

            return $companies;

        }

    }

    public function _show_assigned_subcontractors($scIds) {


        if($scIds) {

            $scid_str = substr($scIds, 1);

            $scids = explode('/', $scid_str);

            $scs = '';

            foreach ($scids as $scid) {
                
                $sc = $this->Company_model->get_company($scid);

                $scs = $scs . '=> ' . $sc['companyName'] . '<br>';

            }

            return $scs;

        }

    }

    public function _show_assigned_sties($sIds) {


        if($sIds) {

            $sid_str = substr($sIds, 1);

            $sids = explode('/', $sid_str);

            $sites = '';

            foreach ($sids as $sid) {
                
                $s = $this->Site_model->get_site($sid);

                $sites = $sites . '=> ' . $s['siteName'] . '<br>';

            }

            return $sites;

        }

    }
    
}