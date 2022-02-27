<div id="clockOutModalOnLO" class="modal">
    <div class="modal-dialog" style="width: 65%; display: block; padding: 20px;">
        <div class="modal-content">
            <?php echo form_open('logout/clocked_in'); ?>
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">CLOCK OUT</h4>
            </div>
            <div class="row modal-body" style="padding: 20px 30px 20px 30px;">
                <div style="min-height: 260px;" class="box-body">
                        <h5 style="color: seagreen;"><b>You are currently CLOCKED IN and recommended to CLOCK OUT before logging out. Check your clock in details below and if you are sure to CLOCK OUT press "CONFIRM".</b></h5>
                        <br>
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            <label>SITE:</label>
                        </div>
                        <div class="col-sm-3">
                            <?= $user_session['tc_site'] ?>
                        </div>
                        <div class="col-sm-4">
                            <small>Ending Time:</small> <code style="color: teal;" id="co-due-time"><?= ($dueTime > 0) ? date('h:i:s A', $dueTime) : 'Unset'; ?></code>
                        </div>
                        <div class="col-sm-3">
                            <small>Now:</small> <code style="color: teal;" id="co-current-time"><?= date('h:i:s A', $currentTime); ?></code>
                        </div>
                    </div>

                    <input type="hidden" id="ohs-tc-url" value="<?= site_url('time_clock/registerEvent'); ?>">
                    <input type="hidden" id="target-url" value="<?= site_url('time_clock/index'); ?>">
                    <input type="hidden" id="userId" name="userId" value="<?= $user_session['id']; ?>">
                    <input type="hidden" id="time" name="time" value="<?= $currentTime; ?>">
                    <input type="hidden" id="dueTime" name="dueTime" value="<?= $dueTime; ?>">
                    <input type="hidden" id="earlyInTime" name="earlyInTime" value="<?= $early; ?>">
                    <input type="hidden" id="lateInTime" name="lateInTime" value="<?= $late; ?>">
                    <input type="hidden" id="siteId" name="siteId" value="0">
                    <input type="hidden" id="companyId" name="companyId" value="0">
                    
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="height: 8px;"></div>
                        <?php
                        if($early > 0) {
                        ?>
                        <code><?= 'You are ' . $early . ' minutes ahead the time to stop working! In this case, you are recommended to put a valid note below for your early clock out.'; ?></code>
                        <?php
                        }
                        ?>
                        <?php
                        if($late > 0) {
                        ?>
                        <code><?= 'You are ' . $late . ' minutes late behind the time to stop working! In this case, you are recommended to put a valid note below for your early clock out.'; ?></code>
                        <?php
                        }
                        ?>
                        <div class="col-sm-12" style="height: 8px;"></div>
                    </div>
                    <?php
                    if($early > 0 || $late > 0) {
                    ?>
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <label>SHOW CAUSE NOTE</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea rows="3" name="note" class="form-control" id="note"><?php echo ($this->input->post('note') ? $this->input->post('note') : ''); ?></textarea>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" id="close_clock_out_on_lo" name="close_clock_out_on_lo" value="close_clock_out_on_lo" class="btn btn-success">STAY CLOCKED IN & LOG OUT</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="clock_out_submit_on_lo" id="clock_out_submit_on_lo" value="clock_out_submit_on_lo" class="btn btn-primary">CLOCK OUT & LOG OUT</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>