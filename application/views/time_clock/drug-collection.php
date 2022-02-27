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
                <h3 style="color: #ffffff;" class="box-title">DRUG COLLECTION</h3>
            	<div class="box-tools">
                </div>
            </div>
            <?php echo form_open('timeclock/drugcollection'); ?>
            <div class="box-body">
                <br>
                <div class="row">
                    <div class="col-sm-12" style="min-height: 20px;"></div>
                    <br>
                </div>              
            </div>
            <div class="box-footer">
                <button type="submit" name="tc-dc-submit" id="tc-dc-submit" class="btn btn-primary">SUBMIT</button>
            </div>
            <?php echo form_close(); ?> 
        </div>
    </div>
</div>