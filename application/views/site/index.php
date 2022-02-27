<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 style="color: #ffffff;" class="box-title">ENLISTED SITES</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('site/add'); ?>" class="btn btn-success btn-sm">ADD NEW SITE</a> 
                </div>
            </div>
            <div class="box-body">
                <br>
                <?php echo form_open('site/index'); ?>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="col-sm-4">Name:&nbsp;&nbsp;<input type="text" name="sfRules[sName]" size="9" value="<?php if($sfRules['sName'] != null && $sfRules['sName'] != ''){ echo $sfRules['sName']; } else { echo ''; } ?>" /></div>
                        <div class="col-sm-8">Primary Contact:&nbsp;&nbsp;<input type="text" name="sfRules[pContact]" size="8" value="<?php if($sfRules['pContact'] != null && $sfRules['pContact'] != ''){ echo $sfRules['pContact']; } else { echo ''; } ?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;City:&nbsp;&nbsp;<input type="text" name="sfRules[city]" size="6" value="<?php if($sfRules['city'] != null && $sfRules['city'] != ''){ echo $sfRules['city']; } else { echo ''; } ?>" /></div>
                    </div>
                    <div class="col-sm-5">
                        Assigned Company:&nbsp;&nbsp;<select name="sfRules[aCompanyId]" class="single-searchable-select">
                            <option value="0">ALL</option>
                            <?php 
                            foreach($all_companies as $company)
                            {
                                $selected = ($company['id'] == $sfRules['aCompanyId']) ? ' selected="selected"' : "";

                                echo '<option value="'.$company['id'].'" '.$selected.'>'.$company['companyName'].'</option>';
                            } 
                            ?>
                        </select>&nbsp;&nbsp;<button type="submit" id="run_s_filter" name="run_s_filter" class="btn btn-primary btn-xs">RUN FILTER</button>
                    </div>
                    <br>
                    <br>
                    <hr>
                </div>
                <?php echo form_close(); ?>
                <table class="table table-striped">
                    <tr>
						
						<th>Site Name</th>
						<th>Status</th>
						<th>Primary Contact</th>
                        <th>Synergy Site</th>
						<th>Assigning Company</th>
                        <th>Start Time</th>
                        <th>End Time</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($sites as $s){ ?>
                    <tr>
						<td><?php echo $s['siteName']; ?></td>
						<?php

                            foreach($all_site_statuses as $ss) {
                                
                                if($s['statusId'] == $ss['id']) {

                                    echo '<td>'.$ss['title'].'</td>';

                                }

                            }

                        ?>
						<td><?php echo $s['primaryContact']; ?></td>
                        <td><?php if($s['synergy'] == 'YES') { echo 'YES'; } else { echo 'NO'; } ?></td>
						<td><?php

                            foreach($all_companies as $c) {
                                
                                if($s['assignedCompanyId'] == $c['id']) {

                                    echo $c['companyName'];

                                }

                            }

                        ?></td>
                        <td><?php echo $s['startTime']; ?></td>
                        <td><?php echo $s['endTime']; ?></td>
						<td>
                            <a href="<?php echo site_url('site/edit/'.$s['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('site/remove/'.$s['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
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
