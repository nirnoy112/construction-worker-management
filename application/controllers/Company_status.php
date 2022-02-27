<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_status extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        
        $this->load->model('Company_status_model');
    } 

    /*
     * Listing of company_statuses
     */
    function index()
    {
        $data['user_session'] = $this->data;
        $data['company_statuses'] = $this->Company_status_model->get_all_company_statuses();
        
        $data['_view'] = 'company_status/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new company_status
     */
    function add()
    {   
        $data['user_session'] = $this->data;
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'title' => $this->input->post('title'),
            );
            
            $company_status_id = $this->Company_status_model->add_company_status($params);
            redirect('company_status/index');
        }
        else
        {            
            $data['_view'] = 'company_status/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a company_status
     */
    function edit($id)
    {   
        $data['user_session'] = $this->data;
        // check if the company_status exists before trying to edit it
        $data['company_status'] = $this->Company_status_model->get_company_status($id);
        
        if(isset($data['company_status']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'title' => $this->input->post('title'),
                );

                $this->Company_status_model->update_company_status($id,$params);            
                redirect('company_status/index');
            }
            else
            {
                $data['_view'] = 'company_status/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The company_status you are trying to edit does not exist.');
    } 

    /*
     * Deleting company_status
     */
    function remove($id)
    {
        $data['user_session'] = $this->data;
        $company_status = $this->Company_status_model->get_company_status($id);

        // check if the company_status exists before trying to delete it
        if(isset($company_status['id']))
        {
            $this->Company_status_model->delete_company_status($id);
            redirect('company_status/index');
        }
        else
            show_error('The company_status you are trying to delete does not exist.');
    }
    
}
