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
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Company User Edit</h3>
            </div>
			<?php echo form_open('company_user/edit/'.$company_user['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="user_id" class="control-label">Username ( Full Name )</label>
						<div class="form-group">
							<select name="user_id" class="form-control">
								<option value="">select user</option>
								<?php 
								foreach($all_users as $user)
								{
									$selected = ($user['id'] == $company_user['user_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$user['id'].'" '.$selected.'>'.$user['username'].'( '.$user['fullName'].' )'.'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="company_id" class="control-label">Company Name ( # )</label>
						<div class="form-group">
							<select name="company_id" class="form-control">
								<option value="">select company</option>
								<?php 
								foreach($all_companies as $company)
								{
									$selected = ($company['id'] == $company_user['company_id']) ? ' selected="selected"' : "";

									echo '<option value="'.$company['id'].'" '.$selected.'>'.$company['companyName'].'(ID # '.$company['id'].' )'.'</option>';
								} 
								?>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>