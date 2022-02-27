<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

?>
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
                <h3 style="color: #ffffff;" class="box-title">Company Admins Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('company_admin/add'); ?>" class="btn btn-success btn-sm">Add Company Admin</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Username ( Full Name )</th>
						<th>Company Name ( # )</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($company_admins as $c){ ?>
                    <tr>
						<td><?php echo $c['id']; ?></td>
						<td>
                            <?php
                                foreach($all_users as $user) {

                                    if($c['user_id'] == $user['id']) {

                                        echo $user['username'].'( '.$user['fullName'].' )';

                                    }

                                }
                            ?>        
                        </td>
						<td>
                            <?php
                                foreach($all_companies as $company) {

                                    if($c['company_id'] == $company['id']) {

                                        echo $company['companyName'].'( ID # '.$c['company_id'].' )';

                                    }

                                }
                            ?>        
                        </td>
						<td>
                            <a href="<?php echo site_url('company_admin/edit/'.$c['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('company_admin/remove/'.$c['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
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
