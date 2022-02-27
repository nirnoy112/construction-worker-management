<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="nonOhsDrugScreeningModal" class="modal">
    <div class="modal-dialog" style="width: 30%; display: block;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">EDIT NON-OHS DRUG SCREENING</h4>
            </div>
            <div class="row modal-body" style="padding: 0px 25px 0px 25px;">
                <?php echo form_open(''); ?>
                <input type="hidden" name="workerId" value="<?php echo $nods['workerId']; ?>" id="workerId" />
                <input type="hidden" name="anodsId" value="<?php echo $nods['id']; ?>" id="anodsId" />
              <div class="box-body">
                <div class="row clearfix">
                  <div class="col-md-12">
                    <label for="date" class="control-label">Date</label>
                    <div class="form-group">
                      <div class="input-group date">
                        <input class="form-control" id="date" type="text" name="date" value="<?php echo $nods['date']; ?>" />
                        <div class="input-group-addon">
                              <span class="glyphicon glyphicon-th"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="providingCompany" class="control-label">Providing Company</label>
                    <div class="form-group">
                      <input type="text" name="providingCompany" value="<?php echo $nods['providingCompany']; ?>" class="form-control" id="providingCompany" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <label for="notes" class="control-label">Notes</label>
                    <div class="form-group">
                      <textarea name="notes" class="form-control" id="notes"><?php echo $nods['notes']; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" name="non_ohs_ds_edit" id="non_ohs_ds_edit" value="non_ohs_ds_edit" class="btn btn-success">SAVE</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="cancel_non_ohs_ds" value="cancel_non_ohs_ds" class="btn btn-warning">CANCEL</button>
              </div>
              <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>