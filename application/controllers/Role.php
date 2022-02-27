<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        $this->load->model('Role_model');
    } 

    /*
     * Listing of roles
     */
    function index()
    {

        $data['user_session'] = $this->data;
        $data['roles'] = $this->Role_model->get_all_roles();
        
        $data['_view'] = 'role/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new role
     */
    function add()
    { 

        $data['user_session'] = $this->data;  
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'title' => $this->input->post('title'),
            );
            
            $role_id = $this->Role_model->add_role($params);
            redirect('role/index');
        }
        else
        {            
            $data['_view'] = 'role/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a role
     */
    function edit($id)
    { 

        $data['user_session'] = $this->data;  
        // check if the role exists before trying to edit it
        $data['role'] = $this->Role_model->get_role($id);
        
        if(isset($data['role']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'title' => $this->input->post('title'),
                );

                $this->Role_model->update_role($id,$params);            
                redirect('role/index');
            }
            else
            {
                $data['_view'] = 'role/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The role you are trying to edit does not exist.');
    } 

    /*
     * Deleting role
     */
    function remove($id)
    {

        $data['user_session'] = $this->data;
        $role = $this->Role_model->get_role($id);

        // check if the role exists before trying to delete it
        if(isset($role['id']))
        {
            $this->Role_model->delete_role($id);
            redirect('role/index');
        }
        else
            show_error('The role you are trying to delete does not exist.');
    }
    
}
