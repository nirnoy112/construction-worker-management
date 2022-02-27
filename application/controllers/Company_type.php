<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_type extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        
        $this->load->model('Company_type_model');
    } 

    /*
     * Listing of company_types
     */
    function index()
    {
        $data['user_session'] = $this->data;
        $data['company_types'] = $this->Company_type_model->get_all_company_types();
        
        $data['_view'] = 'company_type/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new company_type
     */
    function add()
    {   
        $data['user_session'] = $this->data;
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'title' => $this->input->post('title'),
            );
            
            $company_type_id = $this->Company_type_model->add_company_type($params);
            redirect('company_type/index');
        }
        else
        {            
            $data['_view'] = 'company_type/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a company_type
     */
    function edit($id)
    {   
        $data['user_session'] = $this->data;
        // check if the company_type exists before trying to edit it
        $data['company_type'] = $this->Company_type_model->get_company_type($id);
        
        if(isset($data['company_type']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'title' => $this->input->post('title'),
                );

                $this->Company_type_model->update_company_type($id,$params);            
                redirect('company_type/index');
            }
            else
            {
                $data['_view'] = 'company_type/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The company_type you are trying to edit does not exist.');
    } 

    /*
     * Deleting company_type
     */
    function remove($id)
    {
        $data['user_session'] = $this->data;
        $company_type = $this->Company_type_model->get_company_type($id);

        // check if the company_type exists before trying to delete it
        if(isset($company_type['id']))
        {
            $this->Company_type_model->delete_company_type($id);
            redirect('company_type/index');
        }
        else
            show_error('The company_type you are trying to delete does not exist.');
    }
    
}
