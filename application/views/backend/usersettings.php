<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">User Settings</h4>
                </div>
                <div class="panel-body">
                    <form action="<?php echo base_url();?>index.php/user/changeSettings" method="POST" autocomplete="off">
                    <input type="hidden" name="id" value="<?php echo set_value('id', $this->session->userdata['USER_ID']); ?>">
                        <div class="row">
                            
                                <div class="col-md-6 form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="Enter Username" name="username" value="<?php echo $this->session->userdata['USER_NAME'] ?>" maxlength="15" readonly/>
                                </div>
                        
                                <div class="col-md-6 form-group">
                                    <label>Old Password</label>
                                    <input type="password" class="form-control" placeholder="Enter Old Password" name="oldPassword" value="<?php echo set_value('oldPassword') ?>" maxlength="15"/>
                                    <span class="errorMsg"><?php echo form_error('oldPassword'); ?></span>
                                </div>
                        </div>    
                        <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" placeholder="Enter New Password" name="newPassword" value="<?php echo set_value('newPassword') ?>" maxlength="15"/>
                                    <span class="errorMsg"><?php echo form_error('newPassword'); ?></span>
                                </div>
                        
                                <div class="col-md-6 form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Enter Confirm Password" name="confirmPassword" value="<?php echo set_value('confirmPassword') ?>" maxlength="15"/>
                                    <span class="errorMsg"><?php echo form_error('confirmPassword'); ?></span>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Change Password</button>
                                <a href="<?php echo base_url();?>index.php/dashboard" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
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