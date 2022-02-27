<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_admin extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        $this->load->model('Company_admin_model');
    } 

    /*
     * Listing of company_admins
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
        $config['base_url'] = site_url('company_admin/index?');
        $config['total_rows'] = $this->Company_admin_model->get_all_company_admins_count();
        $this->pagination->initialize($config);

        $data['company_admins'] = $this->Company_admin_model->get_all_company_admins($params);
        
        $data['_view'] = 'company_admins/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new company_admin
     */
    function add()
    {   

        $data['user_session'] = $this->data;
        $this->load->library('form_validation');

		$this->form_validation->set_rules('user_id','User Id','required');
		$this->form_validation->set_rules('company_id','Company Id','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'user_id' => $this->input->post('user_id'),
				'company_id' => $this->input->post('company_id'),
            );
            
            $company_admin_id = $this->Company_admin_model->add_company_admin($params);
            redirect('company_admin/index');
        }
        else
        {
			$this->load->model('User_model');
			$data['all_users'] = $this->User_model->get_all_users();

			$this->load->model('Company_model');
			$data['all_companies'] = $this->Company_model->get_all_companies();
            
            $data['_view'] = 'company_admins/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a company_admin
     */
    function edit($id)
    { 

        $data['user_session'] = $this->data;  
        // check if the company_admin exists before trying to edit it
        $data['company_admin'] = $this->Company_admin_model->get_company_admin($id);
        
        if(isset($data['company_admin']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('user_id','User Id','required');
			$this->form_validation->set_rules('company_id','Company Id','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'user_id' => $this->input->post('user_id'),
					'company_id' => $this->input->post('company_id'),
                );

                $this->Company_admin_model->update_company_admin($id,$params);            
                redirect('company_admin/index');
            }
            else
            {
				$this->load->model('User_model');
				$data['all_users'] = $this->User_model->get_all_users();

				$this->load->model('Company_model');
				$data['all_companies'] = $this->Company_model->get_all_companies();

                $data['_view'] = 'company_admins/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The company_admin you are trying to edit does not exist.');
    } 

    /*
     * Deleting company_admin
     */
    function remove($id)
    {

        $data['user_session'] = $this->data;
        $company_admin = $this->Company_admin_model->get_company_admin($id);

        // check if the company_admin exists before trying to delete it
        if(isset($company_admin['id']))
        {
            $this->Company_admin_model->delete_company_admin($id);
            redirect('company_admin/index');
        }
        else
            show_error('The company_admin you are trying to delete does not exist.');
    }
    
}
