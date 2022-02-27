
    <style type="text/css" >
      body {
        margin: 0;
        padding: 0;
        font-size: 20px;
      }
      .microblink-ui-component-wrapper {
        max-width: 901px;
        height: 545px;
        position: relative;
        margin: 0;
        box-sizing: border-box;
        overflow: hidden;
      }

      microblink-ui-web {
        --mb-widget-border-width: 4px;

        /* Defaults */
        --mb-hem: 1rem;
        --mb-widget-font-family: Helvetica, Tahoma, Verdana, Arial, sans-serif;
        --mb-widget-border-color: black;
        --mb-widget-background-color: white;
        --mb-default-font-color: black;
        --mb-alt-font-color: #575757;
        --mb-btn-font-color: white;
        --mb-btn-background-color: #48b2e8;
        --mb-btn-background-color-hover: #26a4e4;
        --mb-btn-flip-color: white;
        --mb-btn-alt-font-color: black;
        --mb-btn-alt-background-color: white;
        --mb-btn-border-radius: 0;
        --mb-btn-intro-stroke-color: black;
        --mb-btn-intro-stroke-color-hover: white;
        --mb-btn-intro-circle-color: #f2f2f2;
        --mb-btn-intro-circle-color-hover: #48b2e8;
        --mb-btn-container-border-color: lightgrey;
        --mb-spinner-border-width: 6px;
        --mb-tabs-background-color: black;
        --mb-tabs-font-color: white;
        --mb-tabs-border-width: 4px;
        --mb-btn-icon-cancel-color: white;
        --mb-dropzone-hover-color: rgba(72, 178, 232, 0.2);
        --mb-dropzone-circle-color: #48b2e8;
        --mb-dropzone-icon-color: black;
        --mb-loader-font-color: black;
        --mb-loader-background-color: #48b2e8;
        --mb-card-layout-border-color: black;
        --mb-tabs-hover-color: #26a4e4;
        --mb-tabs-active-color: #48b2e8;
        --mb-json-color-key: black;
        --mb-json-color-string: #48b2e8;
        --mb-json-color-boolean: #26a4e4;
        --mb-json-color-number: black;
        --mb-json-color-null: #26a4e4;
        --mb-results-border-color: #dee2e6;
        --mb-results-image-border-radius: 6px;
        --mb-results-image-background-color: #f2f2f2;
        --mb-dialog-title-color: black;
        --mb-dialog-message-color: #575757;
        --mb-photo-icon-primary: white;
        --mb-photo-icon-accent: #48b2e8;
      }

      .close {
        font-size: 40px;
      }
    </style>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3  style="color: #ffffff;" class="box-title">REGISTER NEW WORKER</h3>
            </div>
            <?php echo form_open('worker/add', array(
                "id"=>"rwForm", "name"=>"rw-form", "method"=>"post", "enctype"=>"multipart/form-data")); ?>
            <input type="hidden" name="wv_url" id="wv_url" value="<?= site_url('worker/checkIfExists') ?>">
            <div class="box-body">
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            <label for="pictureFile">Worker's Picture</label>
                        </div>
                        <div class="col-sm-10"></div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-5">
                            <h4 style="text-align: center;">UPLOAD PICTURE USING WEBCAM</h4>
                        </div>
                        <div class="col-sm-5">
                            <h4 style="text-align: center;">UPLOAD PICTURE FROM COMPUTER</h4>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <img src="<?php echo site_url('resources/img/user_default.png');?>" style="height: 120px; width: 100px;" alt="Worker Image">
                            <div style="min-height: 10px;"></div>
                            <div id="results" ></div>
                            <input type="hidden" id="pictureDataURI" name="pictureDataURI" value="">
                        </div>
                        <div class="col-sm-4">

                            <div id="ohs_webcam" style="height: 240px; width: 200px; align-content: center; border: 0.5px solid skyblue;">
                                <div style="padding-top: 90px; text-align: center;">
                                    <a name="capture_picture" id="capture_picture" class="btn btn-info" href="">
                                        <i class="fa fa-camera-retro"></i> CAPTURE PICTURE
                                    </a>
                                </div>
                            </div>

                            <br>

                            <div style=" padding-left: 40px; text-align: center;"><input type="button" id="take_snapshot" value="Take Snapshot"></div>

                            <br>
                            <br>
                        </div>
                        <div style="padding-top: 20px; height: 240px; border-left: 1px solid #333333;" class="col-sm-5">
                            <div class="col-sm-4"><label>Image File</label></div>
                            <div class="col-sm-8"><input type="file" id="pictureFile" name="pictureFile"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4 class="page-info">BASIC INFORMATION</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="microblink-ui-component-wrapper">
                                <microblink-ui-web>
                                    <img slot="loader-image" src="https://microblink.com/bundles/microblinkmicroblink/images/loading-animation-on-blue.gif" />
                                </microblink-ui-web>
                            </div>
                        </div>
                        <div class="col-sm-6" style="border: 4px solid; height: 545px;">
                            <h4 id="scannerTitle" class="modal-heading">SCAN RESULT</h4>
                            <div id="scannerBody" class="modal-body" style="padding: 0px 60px 0px 60px;"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="statusId" class="control-label">Status</label>
                            <div class="form-group">
                                <select name="statusId" class="form-control">
                                    <?php 
                                    foreach($all_user_statuses as $user_status)
                                    {
                                        $selected = ($user_status['id'] == $this->input->post('statusId')) ? ' selected="selected"' : "";

                                        echo '<option value="'.$user_status['id'].'" '.$selected.'>'.$user_status['title'].'</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>


                        <?php
                        
                            $currentTime = time();
                            $hexTime = dechex($currentTime);

                            $cryptoStrong = true; // can be false
                            $length = 8; // Any length you want
                            $bytes = openssl_random_pseudo_bytes($length, $cryptoStrong);
                            $randomString = bin2hex($bytes);

                        ?>
                        <input type="hidden" name="generatedUID" value="<?php echo $randomString; ?>"  />
                        <div class="col-md-4">
                            <label for="uid" class="control-label">UID (Autogenerated)</label>
                            <div class="form-group">
                                <input type="text" name="uid" value="<?php echo $randomString; ?>" class="form-control" id="uid" disabled="disabled" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="firstName" class="control-label">First Name<span class="text-danger"> (required)</span></label>
                            <div class="form-group">
                                <input type="text" name="firstName" value="<?php echo $this->input->post('firstName'); ?>" class="form-control" id="firstName" />
                                <span class="text-danger"><?php echo form_error('firstName');?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="lastName" class="control-label">Last Name<span class="text-danger"> (required)</span></label>
                            <div class="form-group">
                                <input type="text" name="lastName" value="<?php echo $this->input->post('lastName'); ?>" class="form-control" id="lastName" />
                                <span class="text-danger"><?php echo form_error('lastName');?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="middleName" class="control-label">Middle Name</label>
                            <div class="form-group">
                                <input type="text" name="middleName" value="<?php echo $this->input->post('middleName'); ?>" class="form-control" id="middleName" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="suffix" class="control-label">Suffix</label>
                            <div class="form-group">
                                <input type="text" name="suffix" value="<?php echo $this->input->post('suffix'); ?>" class="form-control" id="suffix" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="suffix" class="control-label">Sex<span class="text-danger"> (required)</span></label>
                            <div class="form-group">
                                <input type="radio" name="sex" value="Male" <?php if($this->input->post('sex') == 'Male') { echo 'checked'; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;<label for="male">MALE<span></span></label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="Female" <?php if($this->input->post('sex') == 'Female') { echo 'checked'; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;<label for="female">FEMALE</label>
                                <span class="text-danger"><?php echo form_error('sex');?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="dob" class="control-label">Date Of Birth<span class="text-danger"> (required)</span></label>
                            <div class="form-group">
                                <div class="input-group date">
                                    <input class="form-control" id="dob" type="text" name="dob" value="<?php echo $this->input->post('dob'); ?>" />
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <span class="text-danger"><?php echo form_error('dob');?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="primaryPhone" class="control-label">Primary Phone Number</label>
                            <div class="form-group">
                                <input type="text" name="primaryPhone" value="<?php echo $this->input->post('primaryPhone'); ?>" class="form-control" id="primaryPhone" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="secondaryPhone" class="control-label">Secondary Phone Number</label>
                            <div class="form-group">
                                <input type="text" name="secondaryPhone" value="<?php echo $this->input->post('secondaryPhone'); ?>" class="form-control" id="secondaryPhone" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="control-label">Email</label>
                            <div class="form-group">
                                <input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control" id="email" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="address1" class="control-label">Address #1</label>
                            <div class="form-group">
                                <input type="text" name="address1" value="<?php echo $this->input->post('address1'); ?>" class="form-control" id="address1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="address2" class="control-label">Address #2</label>
                            <div class="form-group">
                                <input type="text" name="address2" value="<?php echo $this->input->post('address2'); ?>" class="form-control" id="address2" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="comm_pref" class="control-label">Communication Preference</label>
                            <div class="form-group">
                                <select id="comm_pref" name="comm_pref" class="form-control">
                                    <option value="NONE"<?php if($this->input->post('comm_pref') == null || $this->input->post('comm_pref') == 'NONE') { echo ' selected="selected"'; } ?>>NONE</option>
                                    <option value="SMS"<?php if($this->input->post('comm_pref') == 'SMS') { echo ' selected="selected"'; } ?>>SMS</option>
                                    <option value="EMAIL"<?php if($this->input->post('comm_pref') == 'EMAIL') { echo ' selected="selected"'; } ?>>EMAIL</option>
                                    <option value="SNAIL MAIL"<?php if($this->input->post('comm_pref') == 'SNAIL MAIL') { echo ' selected="selected"'; } ?>>SNAIL MAIL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="city" class="control-label">City</label>
                            <div class="form-group">
                                <input type="text" name="city" value="<?php echo $this->input->post('city'); ?>" class="form-control" id="city" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="state" class="control-label">State</label>
                            <div class="form-group">
                                <input type="text" name="state" value="<?php echo $this->input->post('state'); ?>" class="form-control" id="state" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="zipCode" class="control-label">Zip Code</label>
                            <div class="form-group">
                                <input type="text" name="zipCode" value="<?php echo $this->input->post('zipCode'); ?>" class="form-control" id="zipCode" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="jobTitle" class="control-label">Trade<span class="text-danger"> (required)</span></label>
                            <div class="form-group">
                                <select id="worker-trade" name="jobTitle" class="single-searchable-select form-control">
                                    <option value=""<?php if($this->input->post('jobTitle') == null || $this->input->post('jobTitle') == '') { echo ' selected="selected"'; } ?>>NONE</option>
                                <?php 
                                    foreach($user_session['trades'] as $trade)
                                    {
                                        $selected = ($trade == $this->input->post('jobTitle')) ? ' selected="selected"' : "";

                                        echo '<option value="'.$trade.'" '.$selected.'>'.$trade.'</option>';
                                    } 
                                ?>
                                    <option value="OTHER" <?php if($this->input->post('jobTitle') == 'OTHER') { echo ' selected="selected"'; } ?>>OTHER</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('jobTitle');?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="otherTrade" class="control-label">Other Trade</label>
                            <div class="form-group">
                                <input type="text" name="otherTrade" value="<?php echo $this->input->post('otherTrade'); ?>" class="form-control" id="otherTrade" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="identificationType" class="control-label">Identification Type<span class="text-danger"> (required)</span></label>
                            <div class="form-group">
                                <select id="w-id-type" name="identificationType" class="form-control">
                                    <option value="DRIVER LICENSE" <?php if($this->input->post('identificationType') == 'DRIVER LICENSE') { echo ' selected="selected"'; } ?>>DRIVER LICENSE</option>
                                    <option value="STATE IDENTIFICATION" <?php if($this->input->post('identificationType') == 'STATE IDENTIFICATION') { echo ' selected="selected"'; } ?>>STATE IDENTIFICATION</option>
                                    <option value="PASSPORT" <?php if($this->input->post('identificationType') == 'PASSPORT') { echo ' selected="selected"'; } ?>>PASSPORT</option>
                                    <option value="UNION CARD" <?php if($this->input->post('identificationType') == 'UNION CARD') { echo ' selected="selected"'; } ?>>UNION CARD</option>
                                    <option value="OHS BADGE" <?php if($this->input->post('identificationType') == 'OHS BADGE') { echo ' selected="selected"'; } ?>>OHS BADGE</option>
                                    <option value="OTHER" <?php if($this->input->post('identificationType') == 'OTHER') { echo ' selected="selected"'; } ?>>OTHER</option>
                                </select>
                                <span class="text-danger"><?php echo form_error('identificationType');?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="otherIdType" class="control-label">Other Identification Type</label>
                            <div class="form-group">
                                <input type="text" name="otherIdType" value="<?php echo $this->input->post('otherIdType'); ?>" class="form-control" id="w-otherIdType" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="identificationId" class="control-label">Identification ID<span class="text-danger"> (required)</span></label>
                            <div class="form-group">
                                <input type="text" name="identificationId" value="<?php echo $this->input->post('identificationId'); ?>" class="form-control" id="identificationId" />
                                <span class="text-danger"><?php echo form_error('identificationId');?></span>
                            </div>
                        </div>
                        <div id="worker-minority" class="col-md-4">
                            <label for="minority" class="control-label">Minority</label>
                            <div class="form-group">
                                <select name="minority" class="form-control">
                                    <option value="0" <?php if($this->input->post('minority') == null || $this->input->post('minority') == 0) { echo ' selected="selected"'; } ?>>NO</option>
                                    <option value="1" <?php if($this->input->post('minority') == 1) { echo ' selected="selected"'; } ?>>YES</option>
                                </select>
                            </div>
                        </div>
                        <div id="worker-minority-female" class="col-md-4">
                            <label for="minority" class="control-label">Minority</label>
                            <div class="form-group">
                                <select name="minority" class="form-control">
                                    <option value="1" <?php if($this->input->post('minority') == 1) { echo ' selected="selected"'; } ?>>YES</option>
                                </select>
                            </div>
                        </div>
                        <div id="worker-minority-type" class="col-md-4">
                            <label for="minorityType" class="control-label">Minority Type</label>
                            <div class="form-group">
                                <select name="minorityType" class="form-control">
                                    <option value="NONE" <?php if($this->input->post('minorityType') == null || $this->input->post('minorityType') == 'NONE') { echo ' selected="selected"'; } ?>>NONE</option>
                                <?php 
                                    foreach($user_session['minority_types'] as $mt)
                                    {
                                        $selected = ($mt == $this->input->post('minorityType')) ? ' selected="selected"' : "";

                                        echo '<option value="'.$mt.'" '.$selected.'>'.$mt.'</option>';
                                    } 
                                ?>
                                </select>
                            </div>
                        </div>
                        <div id="worker-minority-type-female" class="col-md-4">
                            <label for="minorityType" class="control-label">Minority Type</label>
                            <div class="form-group">
                                <select name="minorityType" class="form-control">
                                    <option value="FEMALE" selected="selected">FEMALE</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="jobRole" class="control-label">Job Role</label>
                            <div class="form-group">
                                <select id="worker-job-role" name="jobRole" class="form-control">
                                    <option value="NONE" <?php if($this->input->post('jobRole') == null || $this->input->post('jobRole') == 'NONE') { echo ' selected="selected"'; } ?>>NONE</option>
                                <?php 
                                    foreach($user_session['job_roles'] as $jr)
                                    {
                                        $selected = ($jr == $this->input->post('jobRole')) ? ' selected="selected"' : "";

                                        echo '<option value="'.$jr.'" '.$selected.'>'.$jr.'</option>';
                                    } 
                                ?>
                                    <option value="OTHER" <?php if($this->input->post('jobRole') == 'OTHER') { echo ' selected="selected"'; } ?>>OTHER</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="otherJobRole" class="control-label">Other Job Role</label>
                            <div class="form-group">
                                <input type="text" name="otherJobRole" value="<?php echo $this->input->post('otherJobRole'); ?>" class="form-control" id="otherJobRole" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="jobs" class="control-label">Jobs</label>
                            <div class="form-group">
                                <textarea name="jobs" class="form-control" id="jobs"><?php echo $this->input->post('jobs'); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="companyId" class="control-label">Company<span class="text-danger"> (required)</span></label>
                            <div class="form-group">
                                <select name="companyId" class="single-searchable-select form-control">
                                    <option value="0">Other</option>
                                    <?php 
                                    foreach($all_companies as $c)
                                    {
                                        $selected = ($c['id'] == $this->input->post('companyId')) ? ' selected="selected"' : "";

                                        echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['companyName'].'</option>';
                                    } 
                                    ?>
                                </select>
                                <span class="text-danger" id="rw-companyId"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <input type="checkbox" id="companyNotInList" name="companyNotInList" value="YES" <?php if($this->input->post('companyNotInList') == 'YES') { echo ' checked="checked"'; } ?> /><span></span>&nbsp;&nbsp;<i>Check for Different Company; If <b>"Company"</b> is other than the enlisted options.</i>
                        </div>
                    </div>
                    <div id="other-com" class="col-sm-12">
                        <input type="hidden" name="otherComBy" value="<?= $user_session['username'] . ' (Username: ' . $user_session['realName'] . ')'; ?>">
                        <div class="col-md-4">
                            Company Name<span class="text-danger"> (required)</span>
                            <div class="form-group">
                                <input type="text" name="otherCompanyName" value="<?php echo ($this->input->post('otherCompanyName')) ? $this->input->post('otherCompanyName') : ''; ?>" class="form-control" id="otherCompanyName" />
                            <span class="text-danger" id="rw-otherCompanyName"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            Contact Name
                            <div class="form-group">
                                <input type="text" name="otherComContactName" value="<?php echo ($this->input->post('otherComContactName')) ? $this->input->post('otherComContactName') : ''; ?>" class="form-control" id="otherComContactName" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            Phone Number
                            <div class="form-group">
                                <input type="text" name="otherComPhone" value="<?php echo ($this->input->post('otherComPhone')) ? $this->input->post('otherComPhone') : ''; ?>" class="form-control" id="otherComPhone" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="siteIdW" class="control-label">Site<span class="text-danger"> (required)</span></label>
                            <div class="form-group">
                                <select name="siteIdW" class="single-searchable-select form-control">
                                    <option value="0">Other</option>
                                    <?php 
                                    foreach($all_sites as $s)
                                    {
                                        $selected = ($s['id'] == $this->input->post('siteIdW')) ? ' selected="selected"' : "";

                                        echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['siteName'].'</option>';
                                    } 
                                    ?>
                                </select>
                                <span class="text-danger" id="rw-siteIdW"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <br>
                            <input type="checkbox" id="siteNotInList" name="siteNotInList" value="YES" <?php if($this->input->post('siteNotInList') == 'YES') { echo ' checked="checked"'; } ?> /><span></span>&nbsp;&nbsp;<i>Check for Different Site; If <b>"Site"</b> is other than the enlisted options.</i>
                        </div>
                    </div>
                    <div id="other-site" class="col-sm-12">
                        <input type="hidden" name="otherSiteBy" value="<?= $user_session['username'] . ' (Username: ' . $user_session['realName'] . ')'; ?>">
                        <div class="col-md-4">
                            Site Name<span class="text-danger"> (required)</span>
                            <div class="form-group">
                                <input type="text" name="otherSiteName" value="<?php echo ($this->input->post('otherSiteName')) ? $this->input->post('otherSiteName') : ''; ?>" class="form-control" id="otherSiteName" />
                            <span class="text-danger" id="rw-otherSiteName"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            Contact Name
                            <div class="form-group">
                                <input type="text" name="otherSiteContactName" value="<?php echo ($this->input->post('otherSiteContactName')) ? $this->input->post('otherSiteContactName') : ''; ?>" class="form-control" id="otherSiteContactName" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            Phone Number
                            <div class="form-group">
                                <input type="text" name="otherSitePhone" value="<?php echo ($this->input->post('otherSitePhone')) ? $this->input->post('otherSitePhone') : ''; ?>" class="form-control" id="otherSitePhone" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            Email
                            <div class="form-group">
                                <input type="text" name="otherSiteEmail" value="<?php echo ($this->input->post('otherSiteEmail')) ? $this->input->post('otherSiteEmail') : ''; ?>" class="form-control" id="otherSiteEmail" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4 class="page-info">EMERGENCY CONTACT</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="ecType" class="control-label">Contact Type</label>
                            <div class="form-group">
                                <select id="worker-ec-type" name="ecType" class="form-control">
                                    <option value="NONE" <?php if($this->input->post('ecType') == null || $this->input->post('ecType') == 'NONE') { echo ' selected="selected"'; } ?>>NONE</option>
                                <?php 
                                    foreach($user_session['ec_types'] as $et)
                                    {
                                        $selected = ($et == $this->input->post('ecType')) ? ' selected="selected"' : "";

                                        echo '<option value="'.$et.'" '.$selected.'>'.$et.'</option>';
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="ecName" class="control-label">Contact's Name</label>
                            <div class="form-group">
                                <input type="text" name="ecName" value="<?php echo $this->input->post('ecName'); ?>" class="form-control" id="ecName" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="ecRelationship" class="control-label">Relationship To Worker</label>
                            <div class="form-group">
                                <input type="text" name="ecRelationship" value="<?php echo $this->input->post('ecRelationship'); ?>" class="form-control" id="ecRelationship" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-4">
                            <label for="ecPhone" class="control-label">Phone Number</label>
                            <div class="form-group">
                                <input type="text" name="ecPhone" value="<?php echo $this->input->post('ecPhone'); ?>" class="form-control" id="ecPhone" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="ecAltPhone" class="control-label">Alternative Phone Number</label>
                            <div class="form-group">
                                <input type="text" name="ecAltPhone" value="<?php echo $this->input->post('ecAltPhone'); ?>" class="form-control" id="ecAltPhone" />
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12">
                        <h4 class="page-info">WORKER AUTHORITY</h4>
                        <div class="col-md-2">
                            <h5>COMPANIES<span class="text-danger"> (required)</span></h5>
                            <input type="hidden" name="cid_str" id="cid_str" value="">
                            <input type="hidden" name="c-selected-count" id="c-selected-count" value="0">
                            <div id="selectedCList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                            </div>
                            <span class="text-danger"><?php //echo form_error('cid_str');?></span>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="c_search_api_url" id="c_search_api_url" value="<?php //echo site_url('company/search?key='); ?>">
                            <input style="border-radius: 15px;" type="text" class="form-control" name="company-key" id="company-key" placeholder="SEARCH COMPANIES">
                            <div id="fullCList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <h5>SUBCONTRACTORS</h5>
                            <input type="hidden" name="scid_str" id="scid_str" value="">
                            <input type="hidden" name="sc-selected-count" id="sc-selected-count" value="0">
                            <div id="selectedScList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="sc_search_api_url" id="sc_search_api_url" value="<?php //echo site_url('company/scsearch?key='); ?>">
                            <input style="border-radius: 15px;" type="text" class="form-control" name="subcontractor-key" id="subcontractor-key" placeholder="SEARCH SUBCONTRACTORS">
                            <div id="fullScList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <h5>SITES<span class="text-danger"> (required)</span></h5>
                            <input type="hidden" name="sid_str" id="sid_str" value="">
                            <input type="hidden" name="selected-count" id="selected-count" value="0">
                            <div id="selectedSList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                            </div>
                            <span class="text-danger"><?php //echo form_error('sid_str');?></span>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="search_api_url" id="search_api_url" value="<?php //echo site_url('site/search?key='); ?>">
                            <input style="border-radius: 15px;" type="text" class="form-control" name="site-key" id="site-key" placeholder="SEARCH FOR SITES">
                            <div id="fullSList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="register_worker" id="register_worker" class="btn btn-success">
                        <i class="fa fa-check"></i> REGISTER
                    </button>
            </div>
                <?php echo form_close(); ?>
        </div>
    </div>
</div>


<div id="alertModal" class="modal">
    <div class="modal-dialog" style="width: 40%; display: block;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">ALERT!!!</h4>
            </div>
            <div class="row modal-body" style="padding: 0px 60px 0px 60px;">
                <div class="box-body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <h5>The worker you want to register already exists.</h5>
                            <br>
                            <div id="existing-worker-link"></div>
                        </div>
                        <div class="col-md-12" style="min-height: 10px;"></div>
                    </div>
                </div>
                <div class="box-footer"><button type="submit" name="cancel_alert" value="cancel_alert" class="btn btn-warning">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div id="scannerModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 id="scannerTitle" class="modal-heading"></h4>
      </div>
      <div id="scannerBody" class="modal-body" style="padding: 0px 60px 0px 60px;"></div>
    </div>
  </div>
</div> -->

<script src="https://unpkg.com/microblink/dist/microblink.min.js" ></script>

<script>
    //Microblink.SDK.SetRecognizers(['BLINK_ID', 'ID_BARCODE', 'BLINK_ID_COMBINED', 'FACE', 'MRTD', 'PASSPORT', 'VISA', 'USDL', 'PDF417', 'CODE128', 'CODE39', 'EAN13', 'EAN8', 'ITF', 'QR', 'UPCA', 'UPCE', 'UAE_ID_FRONT', 'UAE_ID_BACK', 'UAE_DL_FRONT', 'VIN', 'SIM', 'CYP_ID_FRONT', 'CYP_ID_BACK', 'CRO_ID_FRONT', 'CRO_ID_BACK', 'KWT_ID_FRONT', 'KWT_ID_BACK', 'ESP_DL_FRONT', 'UK_DL_FRONT', 'MYKAD_FRONT', 'MYKAD_BACK', 'MYTENTERA_FRONT', 'MYPR_FRONT', 'MYKAS_FRONT', 'MYS_DL_FRONT', 'IKAD_FRONT', 'INDONESIA_ID_FRONT', 'SGP_ID_FRONT', 'SGP_ID_BACK', 'SGP_DL_FRONT', 'IRL_DL_FRONT', 'HKG_ID_FRONT', 'AUT_DL_FRONT', 'BRN_ID_FRONT', 'BRN_ID_BACK', 'BRN_RES_PERMIT_FRONT', 'BRN_RES_PERMIT_BACK', 'BRN_TEMP_RES_PERMIT_FRONT', 'BRN_TEMP_RES_PERMIT_BACK', 'BRN_MILITARY_ID_FRONT', 'BRN_MILITARY_ID_BACK', 'COL_DL_FRONT', 'DEU_DL_FRONT', 'ITA_DL_FRONT', 'MEX_VOTER_ID_FRONT', 'NZL_DL_FRONT', 'NIGERIA_VOTER_ID_BACK', 'BEL_ID_FRONT', 'BEL_ID_BACK', 'DOC_FACE']);
    //Microblink.SDK.SetRecognizers(['USDL', 'BLINK_ID', 'ID_BARCODE']);
    //Microblink.SDK.SetRecognizers(['BLINK_ID', 'ID_BARCODE', 'MRTD']);
    //Microblink.SDK.SetAuthorization('Bearer ODg0MmI3MzNlZWVlNDYxM2FhZTdhOGUxOTVmMGVhZTI6MDZkN2EwNTUtOTE0ZS00ZGRlLWE5MjktMDliZjBhYzc2MDI1');
    //Microblink.SDK.SetAuthorization('Bearer YjdjY2Q5NTk3YTc1NGRmYjk5NjIyOGQ5MTAwYjRjZWY6MjA2Mzc5MzUtMjA5OC00YzVmLWIzMjItYmZlN2Q3NTA4MDcz');
    /*Microblink.SDK.RegisterListener({
        onScanSuccess: (data) => {
          console.log('Data from Microblink API is', data);
          alert('Data has been populated');
        },
        onScanError: (error) => {
          console.error('Error from Microblink API is', error);

          // Display generic alert
          if (error.summary) {
            alert(error.summary);
          }
        }
    });*/

    Microblink.SDK.SetRecognizers(['BLINK_ID', 'ID_BARCODE', 'MRTD', 'PASSPORT', 'VISA', 'USDL', 'PDF417', 'CODE128', 'CODE39', 'EAN13', 'EAN8', 'ITF', 'QR', 'UPCA', 'UPCE', 'UAE_ID_FRONT', 'UAE_ID_BACK', 'UAE_DL_FRONT', 'VIN', 'SIM', 'CYP_ID_FRONT', 'CYP_ID_BACK', 'CRO_ID_FRONT', 'CRO_ID_BACK', 'KWT_ID_FRONT', 'KWT_ID_BACK', 'ESP_DL_FRONT', 'UK_DL_FRONT', 'MYKAD_FRONT', 'MYKAD_BACK', 'MYTENTERA_FRONT', 'MYPR_FRONT', 'MYKAS_FRONT', 'MYS_DL_FRONT', 'IKAD_FRONT', 'INDONESIA_ID_FRONT', 'SGP_ID_FRONT', 'SGP_ID_BACK', 'SGP_DL_FRONT', 'IRL_DL_FRONT', 'HKG_ID_FRONT', 'AUT_DL_FRONT', 'BRN_ID_FRONT', 'BRN_ID_BACK', 'BRN_RES_PERMIT_FRONT', 'BRN_RES_PERMIT_BACK', 'BRN_TEMP_RES_PERMIT_FRONT', 'BRN_TEMP_RES_PERMIT_BACK', 'BRN_MILITARY_ID_FRONT', 'BRN_MILITARY_ID_BACK', 'COL_DL_FRONT', 'DEU_DL_FRONT', 'ITA_DL_FRONT', 'MEX_VOTER_ID_FRONT', 'NZL_DL_FRONT', 'NIGERIA_VOTER_ID_BACK', 'BEL_ID_FRONT', 'BEL_ID_BACK', 'DOC_FACE']);
    Microblink.SDK.SetAuthorization('Bearer YjU2YjgxNDMyMTJmNDhhODhjNzY1NzMxMjQ5NTFmZmY6ZjIxZDM1YWEtZWVkMC00MzZhLWI2MTEtNGIyYzkzYzIzYTll');

    Microblink.SDK.RegisterListener({
      onScanSuccess: (data) => {

        console.log('Data From Microblink API: ');
        console.log(data);


        // console.log('Length Of Regognizers Data: ');
       //  console.log(data.result.data.length);
        
        //console.log('Data For All Recognizers: ');
        //console.log(data.result.data);

        //console.log('Resulf For BLINK_ID Recognizer: ');
        //console.log(data.result.data[0].result);
        //console.log(data.result.data[1].result);

        recognizersLength = data.result.data.length;

        var i = 0;

        for(i = 0; i < recognizersLength; i++) {

            if(data.result.data[i].result) {

                console.log(data.result.data[i].recognizer);
                console.log(data.result.data[i].result);

            }

        }

        let blinkIdResults = data.result.data[0].result;
        let idBarcodeResults = data.result.data[1].result;
        //let mrtdResults = data.result.data[2].result;

        //console.log(blinkIdResults);
        //console.log(idBarcodeResults);
        //console.log(mrtdResults);

        if (blinkIdResults == null && idBarcodeResults == null) {
          $('#scannerBody').html('<p>Scanning is finished, but we could not extract the datafrom Microblink API.</p><p>Please check if you uploaded the right document type.</p>');
        } else {

            var identificationId = '';
            var firstName = '';
            var lastName = '';
            var middleName = '';
            var sex = '';
            var dob = '';
            var address1 = '';
            var city = '';
            var zipCode = '';
            var state = '';

            if(blinkIdResults) {


                identificationId = blinkIdResults.documentNumber; 
                firstName = blinkIdResults.firstName; 
                lastName = blinkIdResults.lastName;
                dob = blinkIdResults.dateOfBirth.originalString.substring(2, 4) + '-' + blinkIdResults.dateOfBirth.originalString.substring(4, 6) + '-' +blinkIdResults.dateOfBirth.year;
                sex = blinkIdResults.sex;

            }

            if(idBarcodeResults) {
                //console.log(idBarcodeResults.fullName);
                var names = idBarcodeResults.fullName.split(",");

                identificationId = idBarcodeResults.documentNumber; 

                firstName = names[1]; 
                lastName = names[0];

                if(names.length > 2) {

                    middleName = names[2];

                }

                var addresses = (idBarcodeResults.address).split(",");

                address1 = addresses[0];
                city = addresses[1];
                zipCode = addresses[3];
                state = addresses[2];


            }


            $('#w-id-type').val('DRIVER LICENSE');
            $('#identificationId').val(identificationId);
            $('#firstName').val(firstName);
            $('#lastName').val(lastName);
            $('#middleName').val(middleName);
            if(sex == 'M') {
                $('input[type=radio][name=sex][value=Male]').prop('checked', true);
            }
            if(sex == 'F') {
                $('input[type=radio][name=sex][value=Female]').prop('checked', true);
            }
            $('#dob').val(dob);
            $('#address1').val(address1);
            $('#city').val(city);
            $('#zipCode').val(zipCode);
            $('#state').val(state);

          $('#scannerBody').html(
            //'<p>Data found from Microblink API. Required fields has been successfully auto populated as following.</p>' + 
            'Identification Type: ' + 'DRIVER LICENSE' + 
            '<br>Identification ID:   ' + identificationId + 
            '<br>First Name:          ' + firstName + 
            '<br>Last Name:           ' + lastName + 
            '<br>Middle Name:         ' + middleName + 
            '<br>Sex :                ' + ((sex == 'M') ? 'Male' : 'Female') +
            '<br>Date Of Birth :      ' + dob + 
            '<br>Address :            ' + address1 + 
            '<br>City:                ' + city + 
            '<br>Zip Code:            ' + zipCode + 
            '<br>State:               ' + state
            );
        }
        $('#scannerTitle').text("SCAN SUCCESSFUL");
        //$('#scannerModal').modal('show');
      },
      onScanError: (error) => {
        $('#scannerTitle').text("ERROR OCCURED");
        $('#scannerBody').html(error.summary);
        //$('#scannerModal').modal('show');
      }
    });

    setTimeout(function () {
      document.querySelectorAll('.hide-until-component-is-loaded').forEach(function(element) {
        element.classList.remove('hide-until-component-is-loaded');
      })
    }, 1000);

</script>