<?php

class Certification extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);
        $this->load->model('Certification_model');
    } 

    /*
     * Listing of certifications
     */
    function index()
    {
        $data['certifications'] = $this->Certification_model->get_all_certifications();
        
        $data['_view'] = 'certification/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new certification
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'date' => $this->input->post('date'),
				'expirationDate' => $this->input->post('expirationDate'),
				'workerId' => $this->input->post('workerId'),
				'frontOfCertification' => $this->input->post('frontOfCertification'),
				'backOfCertification' => $this->input->post('backOfCertification'),
				'administeredBy' => $this->input->post('administeredBy'),
            );
            
            $certification_id = $this->Certification_model->add_certification($params);
            redirect('certification/index');
        }
        else
        {            
            $data['_view'] = 'certification/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a certification
     */
    function edit($id)
    {   
        // check if the certification exists before trying to edit it
        $data['certification'] = $this->Certification_model->get_certification($id);
        
        if(isset($data['certification']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'date' => $this->input->post('date'),
					'expirationDate' => $this->input->post('expirationDate'),
					'workerId' => $this->input->post('workerId'),
					'frontOfCertification' => $this->input->post('frontOfCertification'),
					'backOfCertification' => $this->input->post('backOfCertification'),
					'administeredBy' => $this->input->post('administeredBy'),
                );

                $this->Certification_model->update_certification($id,$params);            
                redirect('certification/index');
            }
            else
            {
                $data['_view'] = 'certification/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The certification you are trying to edit does not exist.');
    } 

    /*
     * Deleting certification
     */
    function remove($id)
    {
        $certification = $this->Certification_model->get_certification($id);

        // check if the certification exists before trying to delete it
        if(isset($certification['id']))
        {
            $this->Certification_model->delete_certification($id);
            redirect('certification/index');
        }
        else
            show_error('The certification you are trying to delete does not exist.');
    }
    
}
