<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

class Worker extends NDP_Controller{
    function __construct()
    {
        parent::__construct();

        $this->loadAppData(true);

        $this->load->model('Worker_model');
        $this->load->model('User_status_model');
        $this->load->model('Company_model');
        $this->load->model('Site_model');
        $this->load->model('EST_model');
        $this->load->model('Certification_model');
    } 

    /*
     * Listing of workers
     */
    function index()
    {
        $data['user_session'] = $this->data;
        $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();
        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('worker/index?');
        $config['total_rows'] = $this->Worker_model->get_all_workers_count();
        $this->pagination->initialize($config);

        $data['workers'] = $this->Worker_model->get_all_workers($params);
        
        $data['_view'] = 'worker/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new worker
     */
    function add()
    {  
        $data['user_session'] = $this->data;

        if(isset($_POST) && count($_POST) > 0)     
        {

            $pictureFile = $_FILES['pictureFile'];

            //var_dump($pictureFile);die();

            $cids = $this->input->post('companyOpts');

            //var_dump($cids); die();

            $companyIds = '';

            if($cids != null) {

                foreach ($cids as $id) {
                    $companyIds .= '/' . $id;
                }

                //var_dump($ids);die();

            }

            //var_dump($companyIds); die();


            $sids = $this->input->post('siteOpts');

            $siteIds = '';

            if($sids != null) {

                foreach ($sids as $id) {
                    $siteIds .= '/' . $id;
                }

            }

            $age = 0;

            $ppFileName = '';

            if($pictureFile) {

                if($pictureFile['name'] != '') {

                    $filename_array = explode('.',$pictureFile['name']);
                    $size = count($filename_array);
                    $extension = $filename_array[$size - 1];
                    $ppFileName = 'pp_' . $this->input->post('generatedUID') . '_' . time() . '.' . $extension;

                    //var_dump($newFileName1);

                    move_uploaded_file($pictureFile['tmp_name'], FCPATH . 'resources/workers/' . $ppFileName);

                }
            }

            $params = array(
                'statusId' => $this->input->post('statusId'),
                'uid' => $this->input->post('generatedUID'),
                'firstName' => $this->input->post('firstName'),
                'lastName' => $this->input->post('lastName'),
                'middleName' => $this->input->post('middleName'),
                'suffix' => $this->input->post('suffix'),
                'dob' => $this->input->post('dob'),
                'sex' => $this->input->post('sex'),
                'age' => $age,
                'primaryPhone' => $this->input->post('primaryPhone'),
                'secondaryPhone' => $this->input->post('secondaryPhone'),
                'email' => $this->input->post('email'),
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zipCode' => $this->input->post('zipCode'),
                'jobTitle' => $this->input->post('jobTitle'),
                'pictureFile' => $ppFileName,
                /*'cardFile' => $this->input->post('cardFile'),*/
                'jobs' => $this->input->post('jobs'),
                'companies' => $companyIds,
                'sites' => $siteIds
            );
            
            $worker_id = $this->Worker_model->add_worker($params);

            redirect('worker/index');
        }
        else
        {
            $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();

            $data['all_ests'] = $this->EST_model->get_all_ests();
            $data['all_companies'] = $this->Company_model->get_all_companies();
            $data['all_sites'] = $this->Site_model->get_all_sites();
            
            $data['_view'] = 'worker/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a worker
     */
    function edit($id)
    {   
        $data['user_session'] = $this->data;
        // check if the worker exists before trying to edit it
        $data['worker'] = $this->Worker_model->get_worker($id);
        //$data['certs'] = $this->Certification_model->get_worker_certifications($id);

        $w = $data['worker'];

        $wid = (int) $id;
        $wuid = $data['worker']['uid'];
        $wdob = $data['worker']['dob'];
        $wfn = $data['worker']['lastName'] . ' ' . $data['worker']['firstName'] . ' ' . $data['worker']['middleName'];

        //$wpf = $data['worker']['pictureFile'];

        //if(isset($_POST) && count($_POST) > 0) {

            if(isset($data['worker']['id']))
            {

                if(isset($_POST['worker_edit']))     
                {

                    $pictureFile = $_FILES['pictureFile'];

                    $cids = $this->input->post('companyOpts');

                    $companyIds = '';

                    if($cids != null) {

                        foreach ($cids as $id) {
                            $companyIds .= '/' . $id;
                        }

                        //var_dump($ids);die();

                    }

                    $sids = $this->input->post('siteOpts');

                    $siteIds = '';

                    if($sids != null) {

                        foreach ($sids as $id) {
                            $siteIds .= '/' . $id;
                        }

                    }

                    $age = 0;

                    $ppFileName = '';

                    if($pictureFile) {

                        if($pictureFile['name']) {

                            $filename_array = explode('.',$pictureFile['name']);
                            $size = count($filename_array);
                            $extension = $filename_array[$size - 1];
                            $ppFileName = 'pp_' . $this->input->post('generatedUID') . '_' . time() . '.' . $extension;

                            //var_dump($newFileName1);

                            move_uploaded_file($pictureFile['tmp_name'], FCPATH . 'resources/workers/' . $ppFileName);

                        }
                    }

                    $params = array(
                        'statusId' => $this->input->post('statusId'),
                        'uid' => $this->input->post('generatedUID'),
                        'firstName' => $this->input->post('firstName'),
                        'lastName' => $this->input->post('lastName'),
                        'middleName' => $this->input->post('middleName'),
                        'suffix' => $this->input->post('suffix'),
                        'dob' => $this->input->post('dob'),
                        'sex' => $this->input->post('sex'),
                        'age' => $age,
                        'primaryPhone' => $this->input->post('primaryPhone'),
                        'secondaryPhone' => $this->input->post('secondaryPhone'),
                        'email' => $this->input->post('email'),
                        'address1' => $this->input->post('address1'),
                        'address2' => $this->input->post('address2'),
                        'city' => $this->input->post('city'),
                        'state' => $this->input->post('state'),
                        'zipCode' => $this->input->post('zipCode'),
                        'jobTitle' => $this->input->post('jobTitle'),
                        /*'pictureFile' => $ppFileName,*/
                        /*'cardFile' => $this->input->post('cardFile'),*/
                        'jobs' => $this->input->post('jobs'),
                        'companies' => $companyIds,
                        'sites' => $siteIds
                    );


                    if($ppFileName != '') {
                        $params['pictureFile'] = $ppFileName;
                    }

                    //var_dump($params);die();

                    $this->Worker_model->update_worker($wid,$params);            
                    redirect('worker/index');
                }
                else
                {

                    if(isset($_POST['print_sticker'])) {

                        //var_dump($wuid); die();

                        $stickerPDF = $this->pSticker($wuid, $wdob, $wfn);

                        $filenameWithPath = $stickerPDF;

                        $downloadableFile = array(
                            'filename' => 'Sticker#' . $wid . '.pdf',
                            'mimetype' => 'application/pdf'
                        );
                        

                        header('Content-disposition: attachment; filename='. $downloadableFile['filename']);
                        header('Content-type: ' . $downloadableFile['mimetype']);
                        header('Content-Length: ' . filesize($filenameWithPath));

                        ob_clean();
                        ob_start();

                        readfile($filenameWithPath);

                        ob_flush();
                        flush();

                        exit;


                    }

                    if(isset($_POST['print_card'])) {

                        //var_dump($wuid); die();

                        $cardPDF = $this->pCard($w);

                        $filenameWithPath = $cardPDF;

                        $downloadableFile = array(
                            'filename' => 'Card#' . $wid . '.pdf',
                            'mimetype' => 'application/pdf'
                        );
                        

                        header('Content-disposition: attachment; filename='. $downloadableFile['filename']);
                        header('Content-type: ' . $downloadableFile['mimetype']);
                        header('Content-Length: ' . filesize($filenameWithPath));

                        ob_clean();
                        ob_start();

                        readfile($filenameWithPath);

                        ob_flush();
                        flush();

                        exit;


                    }

                    if(isset($_POST['cert_add'])) {

                        $data['wid'] = $wid;

                        $data['_modal'] = 'certification/cert-modal';


                    }

                    if(isset($_POST['cert_submit'])) {

                        $certParams = array(
                            'date' => $this->input->post('date'),
                            'estId' => $this->input->post('estId'),
                            'expirationDate' => $this->input->post('expirationDate'),
                            'workerId' => $this->input->post('workerId'),
                            'frontOfCertification' => $this->input->post('frontOfCertification'),
                            'backOfCertification' => $this->input->post('backOfCertification'),
                            'administeredBy' => $this->input->post('administeredBy'),
                        );
                        
                        $certification_id = $this->Certification_model->add_certification($certParams);

                    }
                    $data['certs'] = $this->Certification_model->get_worker_certifications($id);

                    $data['all_user_statuses'] = $this->User_status_model->get_all_user_statuses();
                    $data['all_ests'] = $this->EST_model->get_all_ests();
                    $data['all_companies'] = $this->Company_model->get_all_companies();
                    $data['all_sites'] = $this->Site_model->get_all_sites();

                    $data['_view'] = 'worker/edit';
                    $this->load->view('layouts/main',$data);

                }

            }
        else
            show_error('The worker you are trying to edit does not exist.');
    }

    /*
     * Deleting worker
     */
    function remove($id)
    {
        $data['user_session'] = $this->data;
        $worker = $this->Worker_model->get_worker($id);

        // check if the worker exists before trying to delete it
        if(isset($worker['id']))
        {
            $this->Worker_model->delete_worker($id);
            redirect('worker/index');
        }
        else
            show_error('The worker you are trying to delete does not exist.');
    }

    private function pSticker($uid, $dob, $name) {

        $dirPDF = FCPATH . 'resources/stickers/';

        $pdfFile = $dirPDF . 'S_' . $uid . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        //$this->load->library('zend');
        //load in folder Zend
        //$this->zend->load('Zend/Barcode');
        //generate barcode

        /*$barcodeOptions = array('text' => $product_code, 'barHeight' => $height, 'drawText' => $drawText);
        $rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        $imageResource = Zend_Barcode::render($bcs, 'image', $barcodeOptions, $rendererOptions);*/

        //$rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        //$barcode = Zend_Barcode::render('code128', 'image', array('text'=>$uid), $rendererOptions);

        //die();

        //echo $barcode; die();

        //var_dump($barcode);

        $data = array(
            'name' => $name,
            'dob' => $dob,
            'uid' => $uid
        );

        $content = $this->load->view('print/sticker', $data, true);

        /*$stylesheet = file_get_contents(base_url() . '/assets/css/mpdfstyletables.css');
        $mPDF->WriteHTML($stylesheet, 1);*/

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

    }

    public function pS() {

        $dirPDF = FCPATH . 'resources/stickers/';

        //$pdfFile = $dirPDF . 'S_' . $uid . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode

        /*$barcodeOptions = array('text' => $product_code, 'barHeight' => $height, 'drawText' => $drawText);
        $rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        $imageResource = Zend_Barcode::render($bcs, 'image', $barcodeOptions, $rendererOptions);*/

        //$rendererOptions = array('imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle');
        //Zend_Barcode::render('code128', 'image', array('text'=>'f48u3q01t35'), $rendererOptions);die();

        $test = Zend_Barcode::render('ean8', 'image', array('text' => '1234565'), array());
        //var_dump($test);

        //var_dump(imagejpeg($test, 'barcode.jpg', 100));
        echo imagejpeg($test, 'barcode.jpg', 100);

        //echo $barcode; die();

        //var_dump($barcode);

        /*$data = array(
            'name' => $name,
            'dob' => $dob,
            'uid' => $uid,
            'barcode' => $barcode
        );

        $content = $this->load->view('print/sticker', $data, true);*/

        /*$stylesheet = file_get_contents(base_url() . '/assets/css/mpdfstyletables.css');
        $mPDF->WriteHTML($stylesheet, 1);*/

        /*$mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;*/

    }

    private function pCard($worker) {

        $dirPDF = FCPATH . 'resources/cards/';

        $pdfFile = $dirPDF . 'C_' . $worker['uid'] . '.pdf';

        $this->load->library('npdf');

        $mPDF = $this->npdf->pdf;

        $mPDF->debug = true;

        $data = array(
            'w' => $worker
        );

        $content = $this->load->view('print/card', $data, true);

        $mPDF->WriteHTML($content);

        $mPDF->Output($pdfFile, 'F');

        return $pdfFile;

    }
    
}
