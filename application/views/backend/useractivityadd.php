
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">Add User Activity</h4>
                </div>
                <div class="panel-body">
                    
                    <form action="<?php echo base_url();?>index.php/useractivity/saveUseractivity" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Select Patient</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    <option value="">Select Patient</option>
                                    <?php foreach($userData as $key => $value){ ?>
                                        <option value="<?=$value['id'];?>" <?php echo ($this->session->userdata['selectedUser']==$value['id'])?" selected=' selected'":""?>><?=$value['username'];?></option>
                                    <?php } ?>
                                </select>
                                <span class="errorMsg"><?php echo form_error('user_id'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Activity</label>
                                <select class="form-control" id="activity_id" name="activity_id">
                                    <option value="">Select Activity</option>
                                    <?php foreach($activityData as $key => $value){ ?>
                                        <option value="<?=$value['id'];?>" <?php echo (set_value('activity_id')==$value['id'])?" selected=' selected'":""?>><?=$value['activity_name'];?></option>
                                    <?php } ?>
                                </select>
                                <?php if(!empty($_POST['activity_id'])){?>
                                <input type="hidden" id="selectedActivity" value="<?=$_POST['activity_id']?>">
                                <?php } ?>
                                <span class="errorMsg"><?php echo form_error('activity_id'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Date</label>
                                <div class="input-group date date_picker">
                                    <input type="text" class="form-control" name="date" value="<?php echo set_value('date'); ?>" placeholder="Select Date"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <span class="errorMsg"><?php echo form_error('date'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Duration</label>
                                <input type="hidden" id="calpermin" />
                                <input type="text" class="form-control" id="duration" name="duration" onkeypress="return isNumber(event)" placeholder="Enter duration" maxlength="3" value="<?php echo set_value('duration'); ?>"/>
                                <span class="errorMsg"><?php echo form_error('duration'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Calories Spent</label>
                                <input type="text" class="form-control" id="calories_spent" name="calories_spent" placeholder="Enter Calories Spent" maxlength="5" value="<?php echo set_value('calories_spent'); ?>" readonly/>
                                <span class="errorMsg"><?php echo form_error('calories_spent'); ?></span>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                                <a href="<?php echo base_url();?>index.php/useractivity" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
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