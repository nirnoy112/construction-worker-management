<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 style="color: #ffffff;" class="box-title">AGEING REPORTS</h3>
            	<div class="box-tools">
                </div>
            </div>
            <?php echo form_open('ageing_report/index'); ?>
            <div class="box-body">
                <br>
                <div class="row">
                    <div class="col-sm-12" style="min-height: 20px;"></div>
                        <div class="col-sm-offset-1 col-sm-10">
                            <div class="col-sm-4">
                                <label>CHOOSE WORKERS OPTION</label>
                            </div>
                            <div class="col-sm-4">
                                <input class="control-label" type="radio" name="selectionOption" value="ALL"<?php if($this->input->post('selectionOption') == '' || $this->input->post('selectionOption') == 'ALL') { echo ' checked'; } ?> />&nbsp;FULL<small> (For workers from all sites)</small> 
                            </div>
                            <div class="col-sm-4">
                                <input class="control-label" type="radio" name="selectionOption" value="PARTIAL"<?php if($this->input->post('selectionOption') == 'PARTIAL') { echo ' checked'; } ?> />&nbsp;PARTIAL<small> (For workers from selected sites)</small>
                            </div>
                        </div>
                        <div class="col-sm-12" style="height: 20px;">
                        
                        </div>
                        <div class="col-sm-offset-1 col-sm-10">
                            <div class="col-sm-4"><label class="control-label">SELECT SITES</label></div>
                            <div class="col-sm-4">
                                <h5>SELECTED SITES</h5>
                                <input type="hidden" name="sid_str" id="sid_str" value="">
                                 <input type="hidden" name="selected-count" id="selected-count" value="0">
                                <div id="selectedSList" style="font-size: 120%; height: 250px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="search_api_url" id="search_api_url" value="<?= site_url('site/search?key='); ?>">
                                <input style="border-radius: 15px;" type="text" class="form-control" name="site-key" id="site-key" placeholder="SEARCH SITES">
                                <div id="fullSList" style="font-size: 120%; height: 250px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                </div>
                            </div>
                            
                        </div>
                    <br>
                </div>              
            </div>
            <div class="box-footer">
                <button type="submit" name="create_ageing_report" id="create_ageing_report" class="btn btn-success">CREATE REPORT</button>
            </div>
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>