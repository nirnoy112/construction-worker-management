<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class EST extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        $this->load->model('EST_model');
    } 

    /*
     * Listing of ests
     */
    function index()
    {

        $data['user_session'] = $this->data;
        $data['ests'] = $this->EST_model->get_all_ests();
        
        $data['_view'] = 'est/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new est
     */
    function add()
    { 

        $data['user_session'] = $this->data;  
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'title' => $this->input->post('title'),
                'description' => $this->input->post('description')
            );
            
            $est_id = $this->EST_model->add_est($params);
            redirect('est/index');
        }
        else
        {            
            $data['_view'] = 'est/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a est
     */
    function edit($id)
    { 

        $data['user_session'] = $this->data;  
        // check if the est exists before trying to edit it
        $data['est'] = $this->EST_model->get_est($id);
        
        if(isset($data['est']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'title' => $this->input->post('title'),
                    'description' => $this->input->post('description')
                );

                $this->EST_model->update_est($id,$params);            
                redirect('est/index');
            }
            else
            {
                $data['_view'] = 'est/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The est you are trying to edit does not exist.');
    } 

    /*
     * Deleting est
     */
    function remove($id)
    {

        $data['user_session'] = $this->data;
        $est = $this->EST_model->get_est($id);

        // check if the est exists before trying to delete it
        if(isset($est['id']))
        {
            $this->EST_model->delete_est($id);
            redirect('est/index');
        }
        else
            show_error('The est you are trying to delete does not exist.');
    }
    
}
