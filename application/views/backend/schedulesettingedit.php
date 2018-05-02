
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">Update Schedule Setting</h4>
                </div>
                <div class="panel-body">
                    
                    <form action="<?php echo base_url();?>index.php/schedulesetting/saveSchedulesetting" method="POST" autocomplete="off">
                        <input type="hidden" name="id" value="<?php echo set_value('id', $getschedulesettingdata['id']); ?>">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                    <label>Part Day</label>
                                    <select class="form-control" name="part_day">
                                        <option value="">Select</option>
                                        <option value="morning" <?php echo ($getschedulesettingdata['part_day']=='morning')?" selected=' selected'":""?>>Morning</option>
                                        <option value="afternoon" <?php echo ($getschedulesettingdata['part_day']=='afternoon')?" selected=' selected'":""?>>Afternoon</option>
                                        <option value="evening" <?php echo ($getschedulesettingdata['part_day']=='evening')?" selected=' selected'":""?>>Evening</option>
                                        <option value="night" <?php echo ($getschedulesettingdata['part_day']=='night')?" selected=' selected'":""?>>Night</option>
                                    </select>
                                    <span class="errorMsg"><?php echo form_error('part_day'); ?></span>
                                </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Time</label>
                                <!-- <input type="text" class="form-control time_picker" name="time" placeholder="Select Time" > -->
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input type="text" class="timepicker1 form-control input-small" name="time" value="<?php echo $getschedulesettingdata['time']; ?>">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                </div>
                                <span class="errorMsg"><?php echo form_error('time'); ?></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-12 col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                                <a href="<?php echo base_url();?>index.php/schedulesetting" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
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