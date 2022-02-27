<div id="clockInModal" class="modal">
    <div class="modal-dialog" style="width: 65%; display: block; padding: 20px;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">CLOCK IN</h4>
            </div>
            <div class="row modal-body" style="padding: 20px 30px 20px 30px;">
                <div style="min-height: 260px;" class="box-body">
                        <h5 style="color: seagreen;"><b>You are currently CLOCKED OUT and recommended to CLOCK IN. To CLOCK IN select a site below and Press "CONFIRM".</b></h5>
                        <br>
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            <label>SITE NAME</label>
                        </div>
                        <div class="col-sm-4">
                            <select id="siteInfo" name="siteInfo" class="form-control">
                                <option value="0/0/-1">SELECT ONE</option>
                                <?php 
                                foreach($all_sites as $s)
                                {
                                    $selected = ($s['id'] . '/' . $s['assignedCompanyId'] . '/' . date('m-d-Y') . ' ' . $s['startTime'] == $this->input->post('siteInfo')) ? ' selected="selected"' : '';

                                    $startTime = 0;

                                    if($s['startTime'] != '' && $s['startTime'] != null) {

                                        $startTime = date('m-d-Y') . ' ' . $s['startTime'];

                                    }

                                    echo '<option value="'. $s['id'] . '/' . $s['assignedCompanyId'] . '/' . $startTime . '"' . $selected . '>' . $s['siteName']  .'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <small>Due Time:</small> <code style="color: teal;" id="ci-due-time"></code>
                        </div>
                        <div class="col-sm-3">
                            <small>Now:</small> <code style="color: teal;" id="ci-current-time"></code>
                        </div>
                    </div>

                    <input type="hidden" id="ohs-tc-url" value="<?= site_url('time_clock/registerEvent'); ?>">
                    <input type="hidden" id="target-url" value="<?= site_url('time_clock/index'); ?>">
                    <input type="hidden" id="userId" name="userId" value="<?= $user_session['id']; ?>">
                    <input type="hidden" id="time" name="time" value="0">
                    <input type="hidden" id="dueTime" name="dueTime" value="0">
                    <input type="hidden" id="earlyInTime" name="earlyInTime" value="0">
                    <input type="hidden" id="lateInTime" name="lateInTime" value="0">
                    <input type="hidden" id="siteId" name="siteId" value="0">
                    <input type="hidden" id="companyId" name="companyId" value="0">
                    
                    <div class="col-sm-12" id="intime-section">
                        <div class="col-sm-12" style="height: 8px;"></div>
                        <code id="intime-information"></code>
                        <div class="col-sm-12" style="height: 8px;"></div>
                    </div>
                    <div class="col-sm-12" id="note-section">
                        <div class="col-sm-3">
                            <label>SHOW CAUSE NOTE</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea rows="3" name="note" class="form-control" id="note"><?php echo ($this->input->post('note') ? $this->input->post('note') : ''); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="clock_in_submit" id="clock_in_submit" value="clock_in_submit" class="btn btn-success">CONFIRM</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="close_clock_in" name="close_clock_in" value="close_clock_in" class="btn btn-warning">CANCEL</button>
            </div>
        </div>
    </div>
</div>