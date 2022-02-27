<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 style="color: #ffffff;" class="box-title">ENLISTED COMPANIES</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('company/add'); ?>" class="btn btn-success btn-sm">Add New Company</a> 
                </div>
            </div>
            <div class="box-body">
                <br>
                <?php echo form_open('company/index'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-sm-6">Company Name:&nbsp;&nbsp;<input type="text" name="cfRules[cName]" size="8" value="<?php if($cfRules['cName'] != null && $cfRules['cName'] != ''){ echo $cfRules['cName']; } else { echo ''; } ?>" /></div>
                        <div class="col-sm-6">Primary Contact:&nbsp;&nbsp;<input type="text" name="cfRules[pContact]" size="8" value="<?php if($cfRules['pContact'] != null && $cfRules['pContact'] != ''){ echo $cfRules['pContact']; } else { echo ''; } ?>" /></div>
                    </div>
                    <div class="col-sm-2">City:&nbsp;&nbsp;<input type="text" name="cfRules[city]" size="8" value="<?php if($cfRules['city'] != null && $cfRules['city'] != ''){ echo $cfRules['city']; } else { echo ''; } ?>" /></div>
                    <div class="col-sm-4">Assigned Site:&nbsp;&nbsp;<input type="text" name="cfRules[aSite]" size="8" value="<?php if($cfRules['aSite'] != null && $cfRules['aSite'] != ''){ echo $cfRules['aSite']; } else { echo ''; } ?>" disabled />&nbsp;&nbsp;&nbsp;<button type="submit" id="run_c_filter" name="run_c_filter" class="btn btn-primary btn-xs">RUN FILTER</button></div>
                    <br>
                    <br>
                    <hr>
                </div>
                <?php echo form_close(); ?>
                <table class="table table-striped">
                    <tr>
                        <th>UID</th>
						<th>Company Name</th>
						<th>Type</th>
						<th>Status</th>
                        <th>FEIN</th>
						<th>Assigned Sites</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($companies as $c){ ?>
                    <?php echo form_open(''); ?>
                    <input type="hidden" name="cid" value="<?= $c['id']?>">
                    <input type="hidden" name="sid" value="0">
                    <tr>
                        <td><?php echo $c['uid']; ?></td>
						<td><?php echo $c['companyName']; ?></td>

						<?php

                            foreach($all_company_types as $ct) {
                                
                                if($c['typeId'] == $ct['id']) {

                                    echo '<td>'.$ct['title'].'</td>';

                                }

                            }

                            foreach($all_company_statuses as $cs) {
                                
                                if($c['statusId'] == $cs['id']) {

                                    echo '<td>'.$cs['title'].'</td>';

                                }

                            }

                        ?>
                        <td><?php echo $c['fein']; ?></td>
						<td><?php echo $ctrl->_getSitesCount($c['id']); ?>&nbsp;&nbsp;<button type="submit" name="assign_site" value="assign_site" class="btn btn-xs btn-success">ADD SITE</button></td>
						<td>
                            <a href="<?php echo site_url('company/edit/'.$c['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('company/remove/'.$c['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php echo form_close(); ?>
                    <?php } ?>
                </table>
                <div style ="text-align: center;">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
            </div>
        </div>
    </div>
</div>
