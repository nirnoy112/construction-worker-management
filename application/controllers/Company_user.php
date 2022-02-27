<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_user extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        $this->load->model('Company_user_model');
    } 

    /*
     * Listing of company_users
     */
    function index()
    {

        $data['user_session'] = $this->data;

        $this->load->model('User_model');
        $data['all_users'] = $this->User_model->get_all_users();

        $this->load->model('Company_model');
        $data['all_companies'] = $this->Company_model->get_all_companies();
            
        
        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('company_user/index?');
        $config['total_rows'] = $this->Company_user_model->get_all_company_users_count();
        $this->pagination->initialize($config);

        $data['company_users'] = $this->Company_user_model->get_all_company_users($params);
        
        $data['_view'] = 'company_users/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new company_user
     */
    function add()
    {

        $data['user_session'] = $this->data;   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'user_id' => $this->input->post('user_id'),
				'company_id' => $this->input->post('company_id'),
            );
            
            $company_user_id = $this->Company_user_model->add_company_user($params);
            redirect('company_user/index');
        }
        else
        {
			$this->load->model('User_model');
			$data['all_users'] = $this->User_model->get_all_users();

			$this->load->model('Company_model');
			$data['all_companies'] = $this->Company_model->get_all_companies();
            
            $data['_view'] = 'company_users/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a company_user
     */
    function edit($id)
    {

        $data['user_session'] = $this->data;   
        // check if the company_user exists before trying to edit it
        $data['company_user'] = $this->Company_user_model->get_company_user($id);
        
        if(isset($data['company_user']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'user_id' => $this->input->post('user_id'),
					'company_id' => $this->input->post('company_id'),
                );

                $this->Company_user_model->update_company_user($id,$params);            
                redirect('company_user/index');
            }
            else
            {
				$this->load->model('User_model');
				$data['all_users'] = $this->User_model->get_all_users();

				$this->load->model('Company_model');
				$data['all_companies'] = $this->Company_model->get_all_companies();

                $data['_view'] = 'company_users/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The company_user you are trying to edit does not exist.');
    } 

    /*
     * Deleting company_user
     */
    function remove($id)
    {

        $data['user_session'] = $this->data;
        $company_user = $this->Company_user_model->get_company_user($id);

        // check if the company_user exists before trying to delete it
        if(isset($company_user['id']))
        {
            $this->Company_user_model->delete_company_user($id);
            redirect('company_user/index');
        }
        else
            show_error('The company_user you are trying to delete does not exist.');
    }
    
}
