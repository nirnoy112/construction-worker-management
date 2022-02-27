<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);

        $this->load->model('Company_model');
        $this->load->model('Site_model');
        
        $this->load->model('Synergy_log_model');
        
    } 

    /*
     * Listing of companies
     */
    function index()
    {
        $data['ctrl'] = $this;
        $data['user_session'] = $this->data;

        if($data['user_session']['roleId'] != 2) {

            $query_rules = $this->data['cf_rules'];
            $data['cfRules'] = $query_rules;

            if(isset($_POST['run_c_filter'])) {

                $cf_rules = $this->input->post('cfRules');

                $cf_rules['aSite'] = '';

                //var_dump($cf_rules);die();

                $this->updateUserSession('cf_rules', $cf_rules);
                redirect('company/index');

            }

            if(isset($_POST['assign_site'])) {

                $acid = (int)$this->input->post('cid');

                $this->load->model('Site_status_model');
                $data['all_site_statuses'] = $this->Site_status_model->get_all_site_statuses();

                $data['acid'] = $acid;
                $data['asid'] = 0;

                $data['_modal'] = 'site/site-modal';


            }

            if(isset($_POST['site_submit'])) {

                $params = array(
                    'statusId' => $this->input->post('statusId'),
                    'assignedCompanyId' => $this->input->post('acid'),
                    'siteName' => $this->input->post('siteName'),
                    'primaryContact' => $this->input->post('primaryContact'),
                    'emailAddress' => $this->input->post('emailAddress'),
                    'phoneNumber' => $this->input->post('phoneNumber'),
                    'faxNumber' => $this->input->post('faxNumber'),
                    'address1' => $this->input->post('address1'),
                    'address2' => $this->input->post('address2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipCode' => $this->input->post('zipCode'),
                    'der' => $this->input->post('der'),
                    'synergy' => ($this->input->post('synergy') == 'YES') ? 'YES' : 'NO',
                    'startTime' => $this->input->post('startTime'),
                    'endTime' => $this->input->post('endTime')
                );
                
                $site_id = $this->Site_model->add_site($params);

            }

            $this->load->model('Company_type_model');
            $data['all_company_types'] = $this->Company_type_model->get_all_company_types();

            $this->load->model('Company_status_model');
            $data['all_company_statuses'] = $this->Company_status_model->get_all_company_statuses();

            $data['all_companies'] = $this->Company_model->get_all_companies();


            $params['limit'] = RECORDS_PER_PAGE; 
            $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            
            $config = $this->config->item('pagination');
            $config['base_url'] = site_url('company/index?');
            $config['total_rows'] = $this->Company_model->get_all_companies_count($query_rules);
            $this->pagination->initialize($config);

            $data['companies'] = $this->Company_model->get_filtered_companies($query_rules, $params);
            
            $data['_view'] = 'company/index';
            $this->load->view('layouts/main',$data);

        }
    }

    /*
     * Adding a new company
     */
    function add()
    {   
        $data['user_session'] = $this->data;

        if($data['user_session']['roleId'] != 2) {
            
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                    'uid' => $this->input->post('generatedUID'),
                    'fein' => $this->input->post('fein'),
                    'typeId' => $this->input->post('typeId'),
                    'statusId' => $this->input->post('statusId'),
                    'parentCompanyId' => $this->input->post('parentCompanyId'),
                    'companyName' => $this->input->post('companyName'),
                    'primaryContact' => $this->input->post('primaryContact'),
                    'emailAddress' => $this->input->post('emailAddress'),
                    'secondaryContact' => $this->input->post('secondaryContact'),
                    'phoneNumber' => $this->input->post('phoneNumber'),
                    'faxNumber' => $this->input->post('faxNumber'),
                    'address1' => $this->input->post('address1'),
                    'address2' => $this->input->post('address2'),
                    'comm_pref' => $this->input->post('comm_pref'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipCode' => $this->input->post('zipCode'),
                    'billToSub' => $this->input->post('billToSub') ? $this->input->post('billToSub') : 0
                );

                //var_dump($params);

                if((int) $this->input->post('typeId') == 1) {

                    $scData = array(

                        'ContractorID' => $params['uid'],
                        'Sub_Name' => $params['companyName'],
                        'Sub_Contact' => $params['primaryContact'],
                        'Sub_Address' => $params['address1'],
                        'Sub_city' => $params['city'],
                        'Sub_State' => $params['state'],
                        'Sub_Zip' => $params['zipCode'],
                        'Sub_Phone' => $params['phoneNumber'],
                        'FEIN' => $params['fein']

                    );

                    $obj = (object) $scData;

                    $sc = $this->formatData($obj);

                    $reqData = array(

                        'EventID' => '20180330-01',
                        'EventType' => 'New_SubContractor',
                        'APIKey' => API_KEY,
                        'RecordCreated' => date('m/d/Y h:i:s A'),
                        'SubContractor' => array($sc)
                    );

                    $resData = $this->performSynergyEvent($reqData);

                    $df = DateTime::createFromFormat('m/d/Y h:i:s A', $reqData['RecordCreated']);

                    $slParams = array(

                        'entity' => 'SubContractor',
                        'uid' => $params['uid'],
                        'time' => strtotime($df->format('Y-m-d h:i:s A')),
                        'event' => $reqData['EventID'] . '-Add SubContractor',
                        'performedBy' => $data['user_session']['realName'] . ' (' . $data['user_session']['username'] .')',
                        'reqData' => json_encode($reqData),
                        'resData' => json_encode($resData),
                        'success' => $resData->ReturnCode,
                        'errMsg' => ($resData->ReturnCode == -1) ? $resData->ExtendedMessage : ''

                    );

                    $this->Synergy_log_model->add_synergy_log($slParams);

                    //echo json_encode($reqData) . '<br>';

                    //var_dump($resData);
                    //die();

                    //$rdo = (object) $reqData;

                    //echo json_encode($rdo) . '<br><br><br>' . json_encode($reqData);
                    //die();

                    //var_dump($resData);

                    //echo $resData;

                    //echo json_encode($reqData) . '<br>' . $resData;
                    //die();

                }
                
                $company_id = $this->Company_model->add_company($params);

                redirect('company/index');
                
            }
            else
            {
                $this->load->model('Company_type_model');
                $data['all_company_types'] = $this->Company_type_model->get_all_company_types();

                $this->load->model('Company_status_model');
                $data['all_company_statuses'] = $this->Company_status_model->get_all_company_statuses();
                $data['all_companies'] = $this->Company_model->get_all_companies();
                $data['all_sc_companies'] = $this->Company_model->get_all_subcontructors();
                
                $data['_view'] = 'company/add';
                $this->load->view('layouts/main',$data);
            }

        }
        
    }  

    /*
     * Editing a company
     */
    function edit($id)
    {   
        $data['user_session'] = $this->data;
        
        // check if the company exists before trying to edit it
        $data['company'] = $this->Company_model->get_company((int)$id);

        //var_dump($data['company']); die();
        
        if(isset($data['company']['id']) && $data['user_session']['roleId'] != 2)
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                    'uid' => $this->input->post('generatedUID'),
                    'fein' => $this->input->post('fein'),
					'typeId' => $this->input->post('typeId'),
					'statusId' => $this->input->post('statusId'),
					'parentCompanyId' => $this->input->post('parentCompanyId'),
					'companyName' => $this->input->post('companyName'),
					'primaryContact' => $this->input->post('primaryContact'),
					'emailAddress' => $this->input->post('emailAddress'),
					'secondaryContact' => $this->input->post('secondaryContact'),
					'phoneNumber' => $this->input->post('phoneNumber'),
					'faxNumber' => $this->input->post('faxNumber'),
					'address1' => $this->input->post('address1'),
					'address2' => $this->input->post('address2'),
                    'comm_pref' => $this->input->post('comm_pref'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'zipCode' => $this->input->post('zipCode'),
                    'billToSub' => $this->input->post('billToSub') ? $this->input->post('billToSub') : 0
                );

                if((int) $this->input->post('typeId') == 1) {

                    $scData = array(

                        'ContractorID' => $params['uid'],
                        'Sub_Name' => $params['companyName'],
                        'Sub_Contact' => $params['primaryContact'],
                        'Sub_Address' => $params['address1'],
                        'Sub_city' => $params['city'],
                        'Sub_State' => $params['state'],
                        'Sub_Zip' => $params['zipCode'],
                        'Sub_Phone' => $params['phoneNumber'],
                        'FEIN' => $params['fein']

                    );

                    $obj = (object) $scData;

                    $sc = $this->formatData($obj);

                    $reqData = array(

                        'EventID' => '20180330-03',
                        'EventType' => 'Update_SubContractor',
                        'APIKey' => API_KEY,
                        'RecordCreated' => date('m/d/Y h:i:s A'),
                        'SubContractor' => array($sc)
                    );

                    $resData = $this->performSynergyEvent($reqData);

                    $df = DateTime::createFromFormat('m/d/Y h:i:s A', $reqData['RecordCreated']);

                    $slParams = array(

                        'entity' => 'SubContractor',
                        'uid' => $params['uid'],
                        'time' => strtotime($df->format('Y-m-d h:i:s A')),
                        'event' => $reqData['EventID'] . '-Edit SubContractor',
                        'performedBy' => $data['user_session']['realName'] . ' (' . $data['user_session']['username'] .')',
                        'reqData' => json_encode($reqData),
                        'resData' => json_encode($resData),
                        'success' => $resData->ReturnCode,
                        'errMsg' => ($resData->ReturnCode == -1) ? $resData->ExtendedMessage : ''

                    );

                    $this->Synergy_log_model->add_synergy_log($slParams);

                    /*var_dump($resData);
                    die();*/

                }

                $this->Company_model->update_company($id,$params);            
                redirect('company/index');
            }
            else
            {
				$this->load->model('Company_type_model');
				$data['all_company_types'] = $this->Company_type_model->get_all_company_types();

				$this->load->model('Company_status_model');
				$data['all_company_statuses'] = $this->Company_status_model->get_all_company_statuses();
				$data['all_companies'] = $this->Company_model->get_all_companies();
                $data['all_sc_companies'] = $this->Company_model->get_all_subcontructors();

                $data['_view'] = 'company/edit';
                //var_dump($data); die();
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The company you are trying to edit does not exist.');
    } 

    /*
     * Deleting company
     */
    function remove($id)
    {
        $data['user_session'] = $this->data;
        
        $company = $this->Company_model->get_company($id);

        // check if the company exists before trying to delete it
        if(isset($company['id']) && $data['user_session']['roleId'] != 2)
        {
            $this->Company_model->delete_company($id);
            redirect('company/index');
        }
        else
            show_error('The company you are trying to delete does not exist.');
    }


    function _getSitesCount($cId) {

        $query_rules = array(
            'sName' => '',
            'pContact' => '',
            'city' => '',
            'aCompanyId' => (int)$cId

        );

        $sitesCount = $this->Site_model->get_all_sites_count($query_rules);

        return $sitesCount;


    }

    public function search() {


        $response = array();

        try {

            $name = $this->input->get('key');

            $companies = $this->Company_model->get_companies_by_name($name);

            $response['status'] = 200;
            $response['companies'] = $companies;
            $response['count'] = ($companies != null) ? count($companies) : 0;

            $responseJSON = json_encode($response);

            echo $responseJSON;


        } catch(Exception $ex) {

            $response['status'] = 500;
            $response['companies'] = null;
            $response['count'] = 0;
            $response['message'] = $ex->getMessage();

            $responseJSON = json_encode($response);

            echo $responseJSON;

        }

    }

    public function scSearch() {


        $response = array();

        try {

            $name = $this->input->get('key');

            $scs = $this->Company_model->get_subcontractors_by_name($name);
            //var_dump($sites);die();

            $response['status'] = 200;
            $response['subcontractors'] = $scs;
            $response['count'] = ($scs != null) ? count($scs) : 0;

            $responseJSON = json_encode($response);

            echo $responseJSON;


        } catch(Exception $ex) {

            $response['status'] = 500;
            $response['subcontractors'] = null;
            $response['count'] = 0;
            $response['message'] = $ex->getMessage();

            $responseJSON = json_encode($response);

            echo $responseJSON;

        }

    }

    
}
