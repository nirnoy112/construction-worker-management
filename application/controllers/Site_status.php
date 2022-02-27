<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_status extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        
        $this->load->model('Site_status_model');
    } 

    /*
     * Listing of site_statuses
     */
    function index()
    {
        $data['user_session'] = $this->data;
        $data['site_statuses'] = $this->Site_status_model->get_all_site_statuses();
        
        $data['_view'] = 'site_status/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new site_status
     */
    function add()
    {   
        $data['user_session'] = $this->data;
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'title' => $this->input->post('title'),
            );
            
            $site_status_id = $this->Site_status_model->add_site_status($params);
            redirect('site_status/index');
        }
        else
        {            
            $data['_view'] = 'site_status/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a site_status
     */
    function edit($id)
    {   
        $data['user_session'] = $this->data;
        // check if the site_status exists before trying to edit it
        $data['site_status'] = $this->Site_status_model->get_site_status($id);
        
        if(isset($data['site_status']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'title' => $this->input->post('title'),
                );

                $this->Site_status_model->update_site_status($id,$params);            
                redirect('site_status/index');
            }
            else
            {
                $data['_view'] = 'site_status/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The site_status you are trying to edit does not exist.');
    } 

    /*
     * Deleting site_status
     */
    function remove($id)
    {
        $data['user_session'] = $this->data;
        $site_status = $this->Site_status_model->get_site_status($id);

        // check if the site_status exists before trying to delete it
        if(isset($site_status['id']))
        {
            $this->Site_status_model->delete_site_status($id);
            redirect('site_status/index');
        }
        else
            show_error('The site_status you are trying to delete does not exist.');
    }
    
}
