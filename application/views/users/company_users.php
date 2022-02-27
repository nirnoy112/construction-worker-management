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
                <h3 style="color: #ffffff;" class="box-title">COMPANY USERS</h3>
            	<div class="box-tools">
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
                        <th>UID</th>
						<th>Full Name</th>
                        <th>Status</th>
                        <th>Company Permission</th>
                        <th>Address</th>
						<th>City</th>
						<th>State</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach($users as $u){ ?>
                    <tr>
                        <td><?php echo $u['uid']; ?></td>
						<td><?php echo $u['fullName']; ?></td>
                        <td>
                            <?php

                                foreach($all_user_statuses as $us) {
                                    
                                    if($u['statusId'] == $us['id']) {

                                        echo $us['title'];

                                    }

                                }

                            ?>
                        </td>
                        <td>

                        <?php

                            echo $ctrl->_show_assigned_companies($u['id']);

                        ?>
                            
                        </td>
                        <td><?php echo $u['address1']; ?></td>
						<td><?php echo $u['city']; ?></td>
						<td><?php echo $u['state']; ?></td>
                        <td>
                            <a href="<?php echo site_url('user/edit_company_user/'.$u['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <?php

                                if($user_session['userType'] == 'ADMIN') {

                            ?>
                                <a href="<?php echo site_url('company_user/remove/'.$u['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                            <?php

                                }

                            ?>
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
