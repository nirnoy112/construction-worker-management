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
                <h3 style="color: #ffffff;" class="box-title">ALL USERS</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('user/add'); ?>" class="btn btn-success btn-sm">Add User</a> 
                </div>
            </div>
            <div class="box-body">
                <br>
                <?php echo form_open('user/index'); ?>
                <div class="row">
                    <!-- <div class="col-sm-12"> -->
                        <div class="col-sm-6">UID:&nbsp;<input type="text" name="ufRules[uid]" size="8" value="<?php if($ufRules['uid'] != null && $ufRules['uid'] != ''){ echo $ufRules['uid']; } else { echo ''; } ?>" />&nbsp;&nbsp;&nbsp;&nbsp;Fullname:&nbsp;<input type="text" name="ufRules[fullName]" size="8" value="<?php if($ufRules['fullName'] != null && $ufRules['fullName'] != ''){ echo $ufRules['fullName']; } else { echo ''; } ?>" />&nbsp;&nbsp;&nbsp;&nbsp;Username:&nbsp;<input type="text" name="ufRules[username]" size="8" value="<?php if($ufRules['username'] != null && $ufRules['username'] != ''){ echo $ufRules['username']; } else { echo ''; } ?>" />
                        </div>
                        <div class="col-sm-3">
                            Type:&nbsp;&nbsp;<select style="width: 150px;" name="ufRules[roleId]">
                            <option value="0">ALL</option>
                            <?php 
                            foreach($all_roles as $role)
                            {
                                $selected = ($role['id'] == $ufRules['roleId']) ? ' selected="selected"' : "";

                                echo '<option value="'.$role['id'].'" '.$selected.'>'.$role['title'].'</option>';
                            } 
                            ?>
                        </select>
                    </div>
                        <div class="col-sm-3">
                            Status:&nbsp;&nbsp;<select style="width: 90px;" name="ufRules[statusId]">
                            <option value="0">ALL</option>
                            <?php 
                            foreach($all_user_statuses as $us)
                            {
                                $selected = ($us['id'] == $ufRules['statusId']) ? ' selected="selected"' : "";

                                echo '<option value="'.$us['id'].'" '.$selected.'>'.$us['title'].'</option>';
                            } 
                            ?>
                        </select>
                        &nbsp;&nbsp;&nbsp;<button type="submit" id="run_u_filter" name="run_u_filter" class="btn btn-primary btn-xs">FILTER</button>
                        </div>
                    <!-- </div> -->
                    <br>
                    <br>
                    <hr>
                </div>
                <?php echo form_close(); ?>
                <table class="table table-striped">
                    <tr>
						<th>Full Name</th>
						<th>User Type</th>
                        <th>Username</th>
                        <th>Status</th>
						<th>City</th>
						<th>State</th>
						<th>Zip Code</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($users as $u){ ?>
                    <tr>
						<td><?php echo $u['fullName']; ?></td>
						<td>
							<?php 
								foreach($all_roles as $role)
								{

									if($u['roleId'] == $role['id']) {

										echo $role['title'];

									}

								} 
								?>
						</td>
                        <td><?php echo $u['username']; ?></td>
                        <td>
                            <?php

                                foreach($all_user_statuses as $us) {
                                    
                                    if($u['statusId'] == $us['id']) {

                                        echo $us['title'];

                                    }

                                }

                            ?>
                        </td>
						<td><?php echo $u['city']; ?></td>
						<td><?php echo $u['state']; ?></td>
						<td><?php echo $u['zipCode']; ?></td>
						<td>
                            <a href="<?php echo site_url('user/edit/'.$u['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('user/remove/'.$u['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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
