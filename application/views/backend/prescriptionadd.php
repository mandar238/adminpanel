
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-10">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">Prescription Details</h4>
                </div>
                <div class="panel-body">
                   
                    <form action="" method="POST" autocomplete="off">
                        
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Select Patient</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    <option value="">Select Patient</option>
                                    <?php foreach($userData as $key => $value){ ?>
                                        <option value="<?=$value['id'];?>" <?php echo ($this->session->userdata['selectedUser']==$value['id'])?" selected=' selected'":""?>><?=$value['username'];?></option>
                                    <?php } ?>
                                </select>
                                <span class="errorMsg"><?php echo form_error('user_id'); ?></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Select Doctor</label>
                                <select class="form-control" id="doctor_id" name="doctor_id">
                                    <option value="">Select Doctor</option>
                                    <?php foreach($doctorData as $key => $value){ ?>
                                        <option value="<?=$value['id'];?>"><?='Dr.'.$value['fname'].' '.$value['lname'];?></option>
                                    <?php } ?>
                                </select>
                                <span class="errorMsg"><?php echo form_error('doctor_id'); ?></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Select Date</label>
                                <div class="input-group date date_picker">
                                    <input type="text" class="form-control" id="ddate" name="date" value="<?php echo set_value('date'); ?>" placeholder="Select Date"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <span class="errorMsg"><?php echo form_error('date'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <button type="button" id="addDrug" class="btn btn-sm btn-success pull-left m-r-5">Add Drug Entry</button>
                            </div>
                        </div>
                        <div class="row drug_details">
                            <div class="form-group col-md-4">
                                <label>Drug</label>
                                <input type="text" class="form-control" placeholder="Enter Drug" id="drug_name" name="drug_name" value="<?php echo set_value('drug_name'); ?>" maxlength="25" />
                                <span class="errorMsg"><?php echo form_error('drug_name'); ?></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Duration in Days</label>
                                <input type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Duration in Days" id="duration_days" name="duration_days" value="<?php echo set_value('duration_days'); ?>" maxlength="2"/>
                                <span class="errorMsg"><?php echo form_error('duration_days'); ?></span>
                            </div>
                        </div>
                        <div class="row drug_details">
                            <div class="form-group col-md-4">
                                <div class="form-check-label">
                                    <div class="checkbox checkbox-inline checkbox-primary">
                                        <input id="morning" class="styled form-check-input" name="takeon[]" value="" type="checkbox">
                                        <label for="morning">
                                            Morning <span class="lmdose"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check-label">
                                    <div class="checkbox checkbox-inline checkbox-primary">
                                        <input id="afternoon" class="styled form-check-input" name="takeon[]" value="" type="checkbox">
                                        <label for="afternoon">
                                            Afternoon <span class="ladose"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="form-check-label">
                                    <div class="checkbox checkbox-inline checkbox-primary">
                                        <input id="evening" class="styled form-check-input" name="takeon[]" value="" type="checkbox">
                                        <label for="evening">
                                            Evening <span class="ledose"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check-label">
                                    <div class="checkbox checkbox-inline checkbox-primary">
                                        <input id="night" class="styled form-check-input" name="takeon[]" value="" type="checkbox">
                                        <label for="night">
                                            Night <span class="lndose"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4 col-md-offset-4">
                                <button type="button" id="getdrugdetails" class="btn btn-sm btn-success pull-left m-r-5">Add Drug</button>
                            </div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
            <!-- end panel -->
            
        </div>
    </div>
    <!-- end row -->

     <!-- begin row -->
        <div class="row">
            

            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-pvr">
                    <div class="panel-heading">
                        <h4 class="panel-title">Drug Details</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="drugdetailsTbl table table-striped table-bordered data_table width-full">
                                <thead>
                                <tr>
                                    <th width="5%">Sr.No</th>
                                    <th>DrugName</th>
                                    <th>Days</th>
                                    <th>Takeat</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                </div>
                    </div>
                </div>
                <!-- end panel -->
                 <div class="form-group col-md-4 col-md-offset-4">
                    <button type="button" id="savePrescription" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                    <a href="<?php echo base_url();?>index.php/prescription" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
                </div>
            </div>
            <!-- end col-12 -->
           
        </div>
        <!-- end row -->
</div>
    <!-- end #content -->
<div class="modal fade" id="modal_form">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                </button>
                <h4 class="modal-title">Dose Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <fieldset>
                        <div class="col-md-6 form-group">
                            <label for="dose">Dose</label>
                            <input type="text" class="form-control" id="dose" placeholder="Enter Dose">
                            <input type="hidden" id="takenat" name="takenat">
                            <span class="errorMsg" id="errdose">Please enter dose</span>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="exampleInputPassword1">Time</label>
                            <div class="input-group bootstrap-timepicker timepicker">
                                <input  type="text" id="time" name="time" class="timepicker1 form-control input-small">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                            <span class="errorMsg" id="errtime">Please select time</span>
                        </div>    
                    </fieldset>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn-sm btn-white"
                   data-dismiss="modal">Cancel</a>
                <a href="javascript:void(0)" id="getdose" data-dismiss="modal" class="btn btn-sm btn-success">Ok</a>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .lmdose, .ladose, .ledose, .lndose{
        color: #4e54c8;
    }
</style>