<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Site_model');

		$this->loadAppData(true);
        
    }

    function index()
    {
    	$data['user_session'] = $this->data;
        
        $data['_view'] = 'dashboard';
        //var_dump($data);die();
        $this->load->view('layouts/main',$data);
    }
}
