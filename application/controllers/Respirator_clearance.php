<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Respirator_clearance extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        $this->load->model('Respirator_clearance_model');
    } 

    /*
     * Listing of respirator_clearances
     */
    function index()
    {

        $data['user_session'] = $this->data;
        $data['respirator_clearances'] = $this->Respirator_clearance_model->get_all_respirator_clearances();
        
        $data['_view'] = 'respirator_clearance/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new respirator_clearance
     */
    function add()
    { 

        $data['user_session'] = $this->data;  
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'title' => $this->input->post('title'),
            );
            
            $respirator_clearance_id = $this->Respirator_clearance_model->add_respirator_clearance($params);
            redirect('respirator_clearance/index');
        }
        else
        {            
            $data['_view'] = 'respirator_clearance/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a respirator_clearance
     */
    function edit($id)
    { 

        $data['user_session'] = $this->data;  
        // check if the respirator_clearance exists before trying to edit it
        $data['respirator_clearance'] = $this->Respirator_clearance_model->get_respirator_clearance($id);
        
        if(isset($data['respirator_clearance']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'title' => $this->input->post('title'),
                );

                $this->Respirator_clearance_model->update_respirator_clearance($id,$params);            
                redirect('respirator_clearance/index');
            }
            else
            {
                $data['_view'] = 'respirator_clearance/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The respirator_clearance you are trying to edit does not exist.');
    } 

    /*
     * Deleting respirator_clearance
     */
    function remove($id)
    {

        $data['user_session'] = $this->data;
        $respirator_clearance = $this->Respirator_clearance_model->get_respirator_clearance($id);

        // check if the respirator_clearance exists before trying to delete it
        if(isset($respirator_clearance['id']))
        {
            $this->Respirator_clearance_model->delete_respirator_clearance($id);
            redirect('respirator_clearance/index');
        }
        else
            show_error('The respirator_clearance you are trying to delete does not exist.');
    }
    
}
