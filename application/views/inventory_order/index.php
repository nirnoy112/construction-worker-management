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
                <h3 style="color: #ffffff;" class="box-title">INVENTORY ORDERS</h3>
            	<div class="box-tools">
                    <a href="" name="download_orders" id="download_orders" class="btn btn-success btn-s-lg">PRINT ORDERS</a>
                </div>
            </div>
            <div class="box-body">
                <br>
                <?php echo form_open('inventory_order/index'); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="modal-info">ADD NEW ORDER</h5>
                        <br>
                        <div class="col-sm-4">SELECT A SITE</div>
                        <div class="col-sm-4">
                            <select id="siteId" name="siteId" class="form-control">
                                <?php 
                                foreach($all_sites as $s)
                                {
                                    $selected = ($s['id'] == $this->input->post('siteId')) ? ' selected="selected"' : "";

                                    echo '<option value="'. $s['id'] . '/' . $s['assignedCompanyId'] . '"' . $selected . '>' . $s['siteName']  .'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2"><button type="submit" id="add_inventory_order" name="add_inventory_order" class="btn btn-success btn-s-lg">ADD ORDER</button></div>
                    </div>
                    <div class="col-sm-12" style="min-height: 10px;">
                        <br>
                        <hr>
                        <br>
                    </div>
                    <div class="col-sm-12"><h5 class="modal-info">FILTER ORDERS</h5></div>
                    <div class="col-sm-10">
                        <div class="col-sm-2"><label class="control-label">STATUS</label></div>
                        <div class="col-sm-3">
                            <select class="form-control" name="iofRules[statusId]">
                                <option value="0">ALL</option>
                                <?php 
                                foreach($all_order_statuses as $os)
                                {
                                    if($os['id'] > 1) {

                                        $selected = ($os['id'] == $iofRules['statusId']) ? ' selected="selected"' : "";

                                        echo '<option value="'.$os['id'].'" '.$selected.'>'.$os['title'].'</option>';

                                    }
                                } 
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2"><label class="control-label">DATE RANGE</label></div>
                        <div class="col-sm-5">
                            <div class="input-group input-daterange" id="datepicker">
                                <input type="text" class="form-control" name="iofRules[dateFrom]" value="<?php if($iofRules['dateFrom'] != null){ echo $iofRules['dateFrom']; } else { echo ''; } ?>" />
                                <div class="input-group-addon"><b>TO</b></div>
                                <input type="text" class="form-control" name="iofRules[dateTo]" value="<?php if($iofRules['dateTo'] != null){ echo $iofRules['dateTo']; } else { echo ''; } ?>" />
                            </div>
                        </div>
                        <div class="col-sm-12" style="min-height: 20px;"></div>
                        <div class="col-sm-12" style="min-height: 20px;"></div>
                        <div class="col-sm-12">
                            <div class="col-sm-4"><label class="control-label">SELECT SITES</label></div>
                            <div class="col-sm-4">
                                <h5>SELECTED SITES</h5>
                                <input type="hidden" name="sid_str" id="sid_str" value="<?= substr($iofRules['sids'], 1); ?>">
                                 <input type="hidden" name="selected-count" id="selected-count" value="<?= count($iofRules['siteIds']); ?>">
                                <div id="selectedSList" style="font-size: 120%; height: 250px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                    <?php
                                        $counter = 0;
                                        foreach($all_sites as $site)
                                        {

                                            if($iofRules['siteIds']) {

                                                $found = false;

                                                foreach ($iofRules['siteIds'] as $sid) {

                                                    if($sid == $site['id']) {
                                                            $found = true;
                                                            break;
                                                    }

                                                }

                                                if($found) {

                                                    echo '<div class="col-sm-12" style="padding: 3px;" class="form-group"><input class="control-label" type="checkbox" name="siteOpts[' . $counter . ']" value="' . $site['id'] . '" checked="checked" />&nbsp;&nbsp;&nbsp;' . $site['siteName'] . '&nbsp;</div>';

                                                } else {

                                                    
                                                }

                                            } else {

                                                

                                            }

                                            $counter = $counter + 1;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="search_api_url" id="search_api_url" value="<?= site_url('site/search?key='); ?>">
                                <input style="border-radius: 15px;" type="text" class="form-control" name="site-key" id="site-key" placeholder="SEARCH SITES">
                                <div id="fullSList" style="font-size: 120%; height: 250px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                    <?php
                                        /*$counter = 0;
                                        foreach($all_sites as $site)
                                        {

                                            if($dsr['siteIds']) {

                                                $found = false;

                                                foreach ($dsr['siteIds'] as $sid) {

                                                    if($sid == $site['id']) {
                                                            $found = true;
                                                            break;
                                                    }

                                                }

                                                if($found) {

                                                    echo '<div class="col-sm-3" style="padding: 3px;" class="form-group"><input class="control-label" type="checkbox" name="siteOpts[' . $counter . ']" value="' . $site['id'] . '" checked="checked" />&nbsp;&nbsp;&nbsp;' . $site['siteName'] . '&nbsp;</div>';

                                                } else {

                                                    echo '<div class="col-sm-3" style="padding: 3px;" class="form-group"><input class="control-label" type="checkbox" name="siteOpts[' . $counter . ']" value="' . $site['id'] . '" />&nbsp;&nbsp;&nbsp;' . $site['siteName'] . '&nbsp;</div>';
                                                }

                                            } else {

                                                echo '<div class="col-sm-3" style="padding: 3px;" class="form-group"><input class="control-label" type="checkbox" name="siteOpts[' . $counter . ']" value="' . $site['id'] . '" checked="checked" />&nbsp;&nbsp;&nbsp;' . $site['siteName'] . '&nbsp;</div>';

                                            }

                                            $counter = $counter + 1;
                                        }*/
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center; padding-top: 230px;" class="col-sm-2 control-label">
                        <button type="submit" id="run_io_filter" name="run_io_filter" class="btn btn-primary btn-s-lg">RUN FILTER</button>
                    </div>
                    <br>
                    <br>
                    <hr>
                </div>
                <?php echo form_close(); ?>
                <br>
                <table class="table table-striped">
                    <tr>
                        <th>Ordering Site</th>
                        <th>Created By</th>
                        <th>Date</th>
                        <th>Status / Action</th>
                        <th>Options</th>
                    </tr>
                    <?php foreach($all_inventory_orders as $io){ ?>
                    <tr>
                        <td>
                        <?php

                            foreach($all_sites as $site) {
                                
                                if($io['siteId'] == $site['id']) {

                                    echo $site['siteName'];

                                }

                            }

                        ?>
                        </td>
                        <td><?php echo $io['createdBy']; ?></td>
                        <td><?php echo date('m-d-Y', $io['creatingTime']); ?></td>
                        <?php echo form_open('', array("method"=>"post")); ?>
                        <input type="hidden" name="invOrdrId" value="<?php echo $io['id']; ?>">
                        <td>
                        <?php

                            foreach($all_order_statuses as $os) {
                                
                                if($io['statusId'] == $os['id']) {

                                    echo $os['title'];

                                }

                            }

                        ?>
                        </td>
                        <td>
                            
                            <button type="submit" id="view_inventory_order" name="view_inventory_order" value="view_inventory_order" class="btn btn-default btn-xs">VIEW</button>&nbsp;&nbsp;&nbsp;<button type="submit" id="print_inventory_order" name="print_inventory_order" value="print_inventory_order" class="btn btn-success btn-xs">DOWNLOAD</button>
                            
                        </td>
                        <?php echo form_close(); ?>
                    </tr>
                    <?php } ?>
                </table>
                <div style ="text-align: center;">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
            </div>
        </div>
    </div>
</div>

<div id="downloadingOrdersModal" class="modal">
    <div class="modal-dialog" style="width: 60%; display: block;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">DOWNLOAD ORDERS</h4>
            </div>
            <div class="row modal-body" style="padding: 10px 25px 10px 25px;">
                <h5 class="modal-info">AVAILABLE OPTIONS</h5>
                <?php echo form_open('', array("class"=>"form-horizontal", "method"=>"post")); ?>
                <input type="hidden" id="sioId" name="sioId">
                <div class="col-sm-12" style="min-height: 30px;"></div>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                        <label class="control-label">STATUS</label>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" name="downloadOptions[statusId]">
                            <option value="0">ALL</option>
                            <?php 
                            foreach($all_order_statuses as $os)
                            {
                                if($os['id'] > 1) {

                                    $selected = ($os['id'] == 2) ? ' selected="selected"' : "";

                                    echo '<option value="'.$os['id'].'" '.$selected.'>'.$os['title'].'</option>';

                                }
                            } 
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label">FOR DATE RANGE</label>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group input-daterange" id="datepicker">
                            <input type="text" class="form-control" name="downloadOptions[dateFrom]" />
                            <div class="input-group-addon"><b>TO</b></div>
                            <input type="text" class="form-control" name="downloadOptions[dateTo]" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-12" style="min-height: 20px;"></div>
                <div class="col-sm-12" style="text-align: center;"><label class="control-label">SELECT SITES</label></div>
                <div class="col-sm-12" style="min-height: 20px;"></div>
                <div style="height: 180px; overflow: auto; border: 0.5px solid gray;" class="col-sm-12">
                    <div id="sitesList">
                        <?php
                            $counter = 0;
                            foreach($all_sites as $site)
                            {

                                echo '<div class="col-sm-3" style="padding: 3px;" class="form-group"><input class="control-label" type="checkbox" name="siteOpts[' . $counter . ']" value="' . $site['id'] . '" />&nbsp;&nbsp;&nbsp;' . $site['siteName'] . '&nbsp;</div>';

                                $counter = $counter + 1;
                            }
                        ?>
                    </div>
                </div>
                <div class="col-sm-12" style="min-height: 20px;"></div>
                <div class="col-sm-offset-5 col-sm-12">
                    <button type="submit" name="ios_download" id="ios_download" value="ios_download" class="btn btn-success">PRINT</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="close_download" name="close_download" value="close_download" class="btn btn-warning">CLOSE</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <!-- footer section -->
            </div>
        </div>
    </div>
</div>
