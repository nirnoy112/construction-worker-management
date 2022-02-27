<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);

        $this->load->model('User_model');
        $this->load->model('User_status_model');
        $this->load->model('Company_model');
        $this->load->model('Site_model');
        $this->load->model('Company_user_model');
        $this->load->model('Site_user_model');
    } 

    /*
     * Listing of users
     */
    public function index()
    {

        $data['user_session'] = $this->data;

        if($data['user_session']['roleId'] != 2) {

            $query_rules = $this->data['uf_rules'];
            $data['ufRules'] = $query_rules;

            if(isset($_POST['run_u_filter'])) {

                $uf_rules = $this->input->post('ufRules');

                $this->updateUserSession('uf_rules', $uf_rules);
                redirect('user/index');

            }
            
            $this->load->model('Role_model');
            $data['all_roles'] = $this->Role_model->get_all_roles();
            $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();
            $params['limit'] = RECORDS_PER_PAGE; 
            $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            
            $config = $this->config->item('pagination');
            $config['base_url'] = site_url('user/index?');
            $config['total_rows'] = $this->User_model->get_filtered_users_count($query_rules);
            $this->pagination->initialize($config);

            $data['users'] = $this->User_model->get_filtered_users($query_rules, $params);
            
            $data['_view'] = 'users/index';
            $this->load->view('layouts/main',$data);

        }

        
    }

    /*
     * Adding a new user
     */
    public function add()
    {   

        $data['user_session'] = $this->data;

        if($data['user_session']['roleId'] != 2) {

            $this->load->model('Role_model');
            $data['all_roles'] = $this->Role_model->get_all_roles();
            $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();

            $data['all_companies'] = $this->Company_model->get_all_companies();
            $data['all_sites'] = $this->Site_model->get_all_sites();
            $data['all_scs'] = $this->Company_model->get_all_subcontructors();
            
            if(isset($_POST) && count($_POST) > 0)  
            {   
                $pictureFile = $_FILES['pictureFile'];

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

                if($iData != '' && $iData != '') {

                    $imageURI = $iData;

                } else {

                    if($ppFileName != '') {

                        $imageURI = site_url('resources/workers/') . $ppFileName;

                    }
                }

                $scids = $this->input->post('scOpts');

                $subcontractorIds = '';

                if($scids != null) {

                    foreach ($scids as $id) {

                        $subcontractorIds .= '/' . $id;

                    }

                }

                $params = array(
                    'password' => $this->input->post('password'),
                    'username' => $this->input->post('username'),
                    'fullName' => $this->input->post('fullName'),
                    'roleId' => $this->input->post('roleId'),
                    'statusId' => $this->input->post('statusId'),
                    'uid' => $this->input->post('generatedUID'),
                    'email' => $this->input->post('email'),
                    'address1' => $this->input->post('address1'),
                    'address2' => $this->input->post('address2'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'zipCode' => $this->input->post('zipCode'),
                    'Foreman' => ((int)$this->input->post('roleId') != 1) ? (int)$this->input->post('Foreman') : 0,
                    'drugTestCollector' => ((int)$this->input->post('roleId') == 2) ? (int)$this->input->post('drugTestCollector') : 0,
                    'subcontractors' => $subcontractorIds
                );

                //var_dump($params); die();
                
                if($imageURI != '') {

                    $params['imageURI'] = $imageURI;
                    
                }
                
                $user_id = $this->User_model->add_user($params);

                $cids = $this->input->post('companyOpts');
                $sids = $this->input->post('siteOpts');

                if($cids != null) {

                    $ids = '';

                    foreach ($cids as $id) {
                        $ids .= '/' . $id;
                    }

                    $CUparams = array(
                        'user_id' => $user_id,
                        'company_id' => $ids
                    );
                    
                    $company_user_id = $this->Company_user_model->add_company_user($CUparams);

                    //var_dump($ids);die();

                }

                if($sids != null) {

                    $ids = '';

                    foreach ($sids as $id) {
                        $ids .= '/' . $id;
                    }

                    $SUparams = array(
                        'user_id' => $user_id,
                        'site_id' => $ids
                    );
                    
                    $site_user_id = $this->Site_user_model->add_site_user($SUparams);

                    //var_dump($ids);die();

                }

                /*var_dump($params);var_dump($cids);var_dump($sids);
                die();*/
                redirect('user/index');
            }
            else
            {
                $this->load->model('Role_model');
                $data['all_roles'] = $this->Role_model->get_all_roles();
                
                $data['_view'] = 'users/add';
                $this->load->view('layouts/main',$data);
            }

        }

    }  

    /*
     * Editing a user
     */
    public function edit($id)
    {   

        $data['user_session'] = $this->data;
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($id);

        $this->load->model('Role_model');
        $data['all_roles'] = $this->Role_model->get_all_roles();
        $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();

        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        $data['all_scs'] = $this->Company_model->get_all_subcontructors();

        $data['user']['companies'] = $this->Company_user_model->get_cids_by_user($id);

        $coms = $this->Company_user_model->get_companies_by_user($id);
        //var_dump($coms); die();

        //$data['user']['companies'] = $coms['company_id'];

        $data['user']['sites'] = $this->Site_user_model->get_sids_by_user($id);

        $sites = $this->Site_user_model->get_sites_by_user($id);

        //var_dump($coms);

        $cuid = (int)$coms['id'];
        $suid = (int)$sites['id'];

        $uid = (int) $id;

        $u = $data['user'];

        //var_dump($data['cids']); die();
        
        
        if(isset($data['user']['id']) && $data['user_session']['roleId'] != 2)
        {
		
			if(isset($_POST) && count($_POST) > 0)   
            {

                if(isset($_POST['user_edit'])) {

                    $pictureFile = $_FILES['pictureFile'];

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

                    if($iData != '' && $iData != '') {

                        $imageURI = $iData;

                    } else {

                        if($ppFileName != '') {

                            $imageURI = site_url('resources/workers/') . $ppFileName;

                        }
                    }

                    $scids = $this->input->post('scOpts');

                    $subcontractorIds = '';

                    if($scids != null) {

                        foreach ($scids as $id) {

                            $subcontractorIds .= '/' . $id;

                        }

                    }

                    //var_dump($subcontractorIds);die();

                    $params = array(
                        'password' => $this->input->post('password'),
                        'username' => $this->input->post('username'),
                        'fullName' => $this->input->post('fullName'),
                        'roleId' => $this->input->post('roleId'),
                        'statusId' => $this->input->post('statusId'),
                        'uid' => $this->input->post('generatedUID'),
                        'email' => $this->input->post('email'),
                        'address1' => $this->input->post('address1'),
                        'address2' => $this->input->post('address2'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'zipCode' => $this->input->post('zipCode'),
                        'Foreman' => ((int)$this->input->post('roleId') != 1) ? (int)$this->input->post('Foreman') : 0,
                        'drugTestCollector' => ((int)$this->input->post('roleId') == 2) ? (int)$this->input->post('drugTestCollector') : 0,
                        'subcontractors' => $subcontractorIds
                    );

                    if($imageURI != '') {

                        $params['imageURI'] = $imageURI;
                        
                    }
                    
                    $this->User_model->update_user($uid,$params);  
                    //$user_id = $this->User_model->add_user($params);

                    $cids = $this->input->post('companyOpts');
                    $sids = $this->input->post('siteOpts');

                    if($cids != null) {

                        $ids = '';

                        foreach ($cids as $id) {
                            $ids .= '/' . $id;
                        }

                        $CUparams = array(
                            'user_id' => $uid,
                            'company_id' => $ids
                        );

                        $this->Company_user_model->update_company_user($cuid,$CUparams);
                        
                        //$company_user_id = $this->Company_user_model->add_company_user($CUparams);

                        //var_dump($ids);die();

                    }

                    if($sids != null) {

                        $ids = '';

                        foreach ($sids as $id) {
                            $ids .= '/' . $id;
                        }

                        $SUparams = array(
                            'user_id' => $uid,
                            'site_id' => $ids
                        );

                        $this->Site_user_model->update_site_user($suid,$SUparams);
                        
                        

                    }

                    redirect('user/index');


                }

                if(isset($_POST['print_badge'])) {

                    //var_dump($wuid); die();

                    $badgePDF = $this->print_badge($u);

                    $filenameWithPath = $badgePDF;

                    $downloadableFile = array(
                        'filename' => 'Badge#' . $uid . '.pdf',
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

            }
            else
            {
				$this->load->model('Role_model');
				$data['all_roles'] = $this->Role_model->get_all_roles();

                $data['_view'] = 'users/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The user you are trying to edit does not exist.');
    } 

    /*
     * Deleting user
     */
    public function remove($id)
    {

        $data['user_session'] = $this->data;
        $user = $this->User_model->get_user($id);

        // check if the user exists before trying to delete it
        if(isset($user['id']) && $data['user_session']['userType'] == 'ADMIN')
        {
            $this->User_model->delete_user($id);
            redirect('user/index');
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }


    public function staff() {

        $data['user_session'] = $this->data;

        if($data['user_session']['roleId'] != 2) {
            
            $this->load->model('Role_model');
            $data['all_roles'] = $this->Role_model->get_all_roles();
            $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();
            $params['limit'] = RECORDS_PER_PAGE; 
            $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
            
            $config = $this->config->item('pagination');
            $config['base_url'] = site_url('user/staff?');
            $config['total_rows'] = $this->User_model->get_all_staff_count();
            $this->pagination->initialize($config);

            $data['users'] = $this->User_model->get_all_staff($params);
            
            $data['_view'] = 'users/staff';
            $this->load->view('layouts/main',$data);

        }

    }

    /*
     * Editing a staff
     */
    public function edit_staff($id)
    {   

        $data['user_session'] = $this->data;
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($id);

        $this->load->model('Role_model');
        $data['all_roles'] = $this->Role_model->get_all_roles();
        $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();

        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        $data['all_scs'] = $this->Company_model->get_all_subcontructors();

        $data['user']['companies'] = $this->Company_user_model->get_cids_by_user($id);

        $coms = $this->Company_user_model->get_companies_by_user($id);

        $data['user']['sites'] = $this->Site_user_model->get_sids_by_user($id);

        $sites = $this->Site_user_model->get_sites_by_user($id);

        //var_dump($coms);

        $cuid = (int)$coms['id'];
        $suid = (int)$sites['id'];

        $uid = (int) $id;

        $u = $data['user'];

        //var_dump($data['cids']); die();
        
        
        if(isset($data['user']['id']) && $data['user_session']['roleId'] != 2)
        {
        
            if(isset($_POST) && count($_POST) > 0)   
            {   

                if(isset($_POST['user_edit'])) {

                    $pictureFile = $_FILES['pictureFile'];

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

                    if($iData != '' && $iData != '') {

                        $imageURI = $iData;

                    } else {

                        if($ppFileName != '') {

                            $imageURI = site_url('resources/workers/') . $ppFileName;

                        }
                    }

                    $scids = $this->input->post('scOpts');

                    $subcontractorIds = '';

                    if($scids != null) {

                        foreach ($scids as $id) {

                            $subcontractorIds .= '/' . $id;

                        }

                    }

                    $params = array(
                        'password' => $this->input->post('password'),
                        'username' => $this->input->post('username'),
                        'fullName' => $this->input->post('fullName'),
                        'roleId' => $this->input->post('roleId'),
                        'statusId' => $this->input->post('statusId'),
                        'uid' => $this->input->post('generatedUID'),
                        'email' => $this->input->post('email'),
                        'address1' => $this->input->post('address1'),
                        'address2' => $this->input->post('address2'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'zipCode' => $this->input->post('zipCode'),
                        'drugTestCollector' => ((int)$this->input->post('roleId') == 2) ? (int)$this->input->post('drugTestCollector') : 0,
                        'subcontractors' => $subcontractorIds
                    );

                    if($imageURI != '') {

                        $params['imageURI'] = $imageURI;
                        
                    }
                    
                    $this->User_model->update_user($id,$params);  
                    //$user_id = $this->User_model->add_user($params);

                    $cids = $this->input->post('companyOpts');
                    $sids = $this->input->post('siteOpts');

                    if($cids != null) {

                        $ids = '';

                        foreach ($cids as $id) {
                            $ids .= '/' . $id;
                        }

                        $CUparams = array(
                            'user_id' => $uid,
                            'company_id' => $ids
                        );

                        $this->Company_user_model->update_company_user($cuid,$CUparams);
                        
                        //$company_user_id = $this->Company_user_model->add_company_user($CUparams);

                        //var_dump($ids);die();

                    }

                    if($sids != null) {

                        $ids = '';

                        foreach ($sids as $id) {
                            $ids .= '/' . $id;
                        }

                        $SUparams = array(
                            'user_id' => $uid,
                            'site_id' => $ids
                        );

                        $this->Site_user_model->update_site_user($suid,$SUparams);
                        
                        //$company_user_id = $this->Company_user_model->add_company_user($CUparams);

                        //var_dump($ids);die();

                    }
                              
                    redirect('user/staff');

                }

                if(isset($_POST['print_badge'])) {

                    //var_dump($wuid); die();

                    $badgePDF = $this->print_badge($u);

                    $filenameWithPath = $badgePDF;

                    $downloadableFile = array(
                        'filename' => 'Badge#' . $uid . '.pdf',
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

            }
            else
            {
                $this->load->model('Role_model');
                $data['all_roles'] = $this->Role_model->get_all_roles();

                $data['_view'] = 'users/edit';
                $this->load->view('layouts/main',$data);
            }

        }
        else
            show_error('The user you are trying to edit does not exist.');
    }

    /*
     * Deleting staff
     */
    public function remove_staff($id)
    {

        $data['user_session'] = $this->data;
        $user = $this->User_model->get_user($id);

        // check if the user exists before trying to delete it
        if(isset($user['id']) && $data['user_session']['userType'] == 'ADMIN')
        {
            $this->User_model->delete_user($id);
            redirect('user/staff');
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }


    public function company_users() {

        $data['user_session'] = $this->data;

        $data['ctrl'] = $this;

        $this->load->model('Role_model');
        $data['all_roles'] = $this->Role_model->get_all_roles();
        $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();
        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('user/company_users?');
        $config['total_rows'] = $this->User_model->get_all_company_users_count();
        $this->pagination->initialize($config);

        $data['users'] = $this->User_model->get_all_company_users($params);
        
        $data['_view'] = 'users/company_users';
        $this->load->view('layouts/main',$data);

    }

    public function _show_assigned_companies($userId) {

        //return $userId;

        $comIds = $this->Company_user_model->get_cids_by_user($userId);

        if($comIds) {

            $cid_str = substr($comIds, 1);

            $cids = explode('/', $cid_str);

            $companies = '<i>[ <u>Assigned to <b>' . count($cids) . '</b> companies.</u> ]</i>';

            foreach ($cids as $cid) {
                
                $c = $this->Company_model->get_company($cid);

                $companies = $companies . '<br> * ' . $c['companyName'];

            }

            return $companies;

        } else {

            return '<i>[ <u>Assigned to <b>0</b> companies.</u> ]</i>';
        }

    }

    /*
     * Editing a staff
     */
    public function edit_company_user($id)
    {

        $data['user_session'] = $this->data;
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($id);

        $this->load->model('Role_model');
        $data['all_roles'] = $this->Role_model->get_all_roles();
        $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();

        $data['all_companies'] = $this->Company_model->get_all_companies();
        $data['all_sites'] = $this->Site_model->get_all_sites();
        $data['all_scs'] = $this->Company_model->get_all_subcontructors();

        $data['user']['companies'] = $this->Company_user_model->get_cids_by_user($id);

        $coms = $this->Company_user_model->get_companies_by_user($id);

        $data['user']['sites'] = $this->Site_user_model->get_sids_by_user($id);

        $sites = $this->Site_user_model->get_sites_by_user($id);

        //var_dump($coms);

        $cuid = (int)$coms['id'];
        $suid = (int)$sites['id'];

        $uid = (int) $id;

        $u = $data['user'];

        //var_dump($data['cids']); die();
        
        
        if(isset($data['user']['id']))
        {
        
            if(isset($_POST) && count($_POST) > 0)   
            {   

                if(isset($_POST['user_edit'])) {

                    $pictureFile = $_FILES['pictureFile'];

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

                    if($iData != '' && $iData != '') {

                        $imageURI = $iData;

                    } else {

                        if($ppFileName != '') {

                            $imageURI = site_url('resources/workers/') . $ppFileName;

                        }
                    }

                    $scids = $this->input->post('scOpts');

                    $subcontractorIds = '';

                    if($scids != null) {

                        foreach ($scids as $id) {

                            $subcontractorIds .= '/' . $id;

                        }

                    }

                    $params = array(
                        'password' => $this->input->post('password'),
                        'username' => $this->input->post('username'),
                        'fullName' => $this->input->post('fullName'),
                        'roleId' => $this->input->post('roleId'),
                        'statusId' => $this->input->post('statusId'),
                        'uid' => $this->input->post('generatedUID'),
                        'email' => $this->input->post('email'),
                        'address1' => $this->input->post('address1'),
                        'address2' => $this->input->post('address2'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'zipCode' => $this->input->post('zipCode'),
                        'subcontractors' => $subcontractorIds
                    );

                    if($imageURI != '') {

                        $params['imageURI'] = $imageURI;
                        
                    }
                    
                    $this->User_model->update_user($id,$params);  
                    //$user_id = $this->User_model->add_user($params);

                    $cids = $this->input->post('companyOpts');
                    $sids = $this->input->post('siteOpts');

                    if($cids != null) {

                        $ids = '';

                        foreach ($cids as $id) {
                            $ids .= '/' . $id;
                        }

                        $CUparams = array(
                            'user_id' => $uid,
                            'company_id' => $ids
                        );

                        $this->Company_user_model->update_company_user($cuid,$CUparams);
                        
                        //$company_user_id = $this->Company_user_model->add_company_user($CUparams);

                        //var_dump($ids);die();

                    }

                    if($sids != null) {

                        $ids = '';

                        foreach ($sids as $id) {
                            $ids .= '/' . $id;
                        }

                        $SUparams = array(
                            'user_id' => $uid,
                            'site_id' => $ids
                        );

                        $this->Site_user_model->update_site_user($suid,$SUparams);
                        
                        //$company_user_id = $this->Company_user_model->add_company_user($CUparams);

                        //var_dump($ids);die();

                    }
                              
                    redirect('user/company_users');
                    
                }

                if(isset($_POST['print_badge'])) {

                    //var_dump($wuid); die();

                    $badgePDF = $this->print_badge($u);

                    $filenameWithPath = $badgePDF;

                    $downloadableFile = array(
                        'filename' => 'Badge#' . $uid . '.pdf',
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


            }
            else
            {
                $this->load->model('Role_model');
                $data['all_roles'] = $this->Role_model->get_all_roles();

                $data['_view'] = 'users/edit';
                $this->load->view('layouts/main',$data);
            }

        }
        else
            show_error('The user you are trying to edit does not exist.');
    } 

    /*
     * Deleting staff
     */
    public function remove_company_user($id)
    {

        $data['user_session'] = $this->data;
        $user = $this->User_model->get_user($id);

        // check if the user exists before trying to delete it
        if(isset($user['id']) && $data['user_session']['userType'] == 'ADMIN')
        {
            $this->User_model->delete_user($id);
            redirect('user/company_users');
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }

    public function save_picture() {


        $response = array();

        try {

            $id = $this->input->get('id');

            $imageURI = $this->input->post('imgData');

            $params = array(
                'imageURI' => $imageURI
            );

            $this->User_model->update_user($id, $params);

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

            $this->User_model->update_user($id, $params);

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

    private function print_badge($user) {

        $dirPDF = FCPATH . 'resources/badges/';

        $pdfFile = $dirPDF . 'C_' . $user['uid'] . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        $data = array(
            'u' => $user
        );

        $content = $this->load->view('print/badge', $data, true);

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

    }

    
}
