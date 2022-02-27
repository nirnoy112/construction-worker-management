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
                <h3 style="color: #ffffff;" class="box-title">ONSITE WORK</h3>
                <div class="box-tools">
                </div>
            </div>
            <?php echo form_open('timeclock/onsitework'); ?>
            <div class="box-body">
                <br>
                <div class="row">
                    <div class="col-sm-12" style="min-height: 20px;"></div>
                    <div class="col-sm-12">
                        <div class="col-md-3">
                            <label for="siteId" class="control-label">Construction Site</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="siteId" class="form-control">
                                    <option value="0">NONE</option>
                                    <?php 
                                    foreach($all_sites as $s)
                                    {
                                        $selected = ($s['id'] == $this->input->post('siteId')) ? ' selected="selected"' : "";

                                        echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['siteName'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>              
            </div>
            <div class="box-footer">
                <button type="submit" name="tc-ow-submit" id="tc-ow-submit" class="btn btn-primary">SUBMIT</button>
            </div>
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>