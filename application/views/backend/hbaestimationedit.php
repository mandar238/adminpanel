
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">Update HBA1c Estimation</h4>
                </div>
                <div class="panel-body">
                    
                    <form action="<?php echo base_url();?>index.php/hbaestimation/saveHbaestimation" method="POST" autocomplete="off">
                        <input type="hidden" name="id" value="<?php echo set_value('id', $gethbaestimationdata['id']); ?>">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Select Patient</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    <option value="">Select Patient</option>
                                    <?php foreach($userData as $key => $value){ ?>
                                        <option value="<?=$value['id'];?>" <?php echo ($gethbaestimationdata['user_id']==$value['id'])?" selected=' selected'":""?>><?=$value['username'];?></option>
                                    <?php } ?>
                                </select>
                                <span class="errorMsg"><?php echo form_error('user_id'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Date</label>
                                <div class="input-group date date_picker">
                                    <input type="text" class="form-control" name="date" value="<?php echo date('d-M-Y',strtotime($gethbaestimationdata['date'])); ?>" placeholder="Select Date"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <span class="errorMsg"><?php echo form_error('date'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Time</label>
                                <!-- <input type="text" class="form-control time_picker" name="time" placeholder="Select Time" > -->
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" class="timepicker1 form-control input-small" name="time" value="<?php echo $gethbaestimationdata['time']; ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                </div>
                                <span class="errorMsg"><?php echo form_error('time'); ?></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>HBA1c value (%)</label>
                                <input type="text" class="form-control" name="hba_value" onkeypress="return isNumber(event)" placeholder="Enter HBA Value" maxlength="5" value="<?php echo $gethbaestimationdata['hba_value']; ?>"/>
                                <span class="errorMsg"><?php echo form_error('hba_value'); ?></span>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-md-12 col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                                <a href="<?php echo base_url();?>index.php/hbaestimation" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end panel -->
            
        </div>
    </div>
    <!-- end row -->
</div>
    <!-- end #content -->