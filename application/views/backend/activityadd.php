
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Activity</h4>
                </div>
                <div class="panel-body">
                    
                    <form action="<?php echo base_url();?>index.php/activity/saveactivity" method="POST" autocomplete="off">
                        
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Activity Name</label>
                                <input type="text" class="form-control" id="activity_name" name="activity_name" placeholder="Enter Activity Name" value="<?php echo set_value('activity_name'); ?>"/>
                                <span class="errorMsg"><?php echo form_error('activity_name'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Calories Spent per min</label>
                                <input type="text" class="form-control" id="calories_spent" name="calories_spent" onkeypress="return isNumber(event)" placeholder="Enter Calories Spent" maxlength="5" value="<?php echo set_value('calories_spent'); ?>"/>
                                <span class="errorMsg"><?php echo form_error('calories_spent'); ?></span>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                                <a href="<?php echo base_url();?>index.php/activity" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
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