
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">

        <div class="col-md-4 col-md-offset-4">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">Doctor Profile</h4>
                </div>
                <div class="panel-body">
                    
                    <form action="<?php echo base_url();?>index.php/doctor/saveDoctor" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Select Patient</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    <option value="">Select Patient</option>
                                    <?php foreach($userData as $key => $value){ ?>
                                        <option value="<?=$value['id'];?>" <?php echo ($this->session->userdata['selectedUser']==$value['id'])?" selected=' selected'":""?> ><?=$value['username'];?></option>
                                    <?php } ?>
                                </select>
                                <span class="errorMsg"><?php echo form_error('user_id'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                         
                                <div class="col-md-12 form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter First Name" name="fname" value="<?php echo set_value('fname'); ?>" maxlength="25" />
                                    <span class="errorMsg"><?php echo form_error('fname'); ?></span>
                                </div>
                        </div>
                        <div class="row">    
                    
                                <div class="col-md-12 form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="lname" value="<?php echo set_value('lname'); ?>" maxlength="25"/>
                                    <span class="errorMsg"><?php echo form_error('lname'); ?></span>
                                </div>
                            
                        </div>

                        <div class="row">
                           
                                <div class="col-md-12 form-group">
                                    <label>Email Id</label>
                                    <input type="text" class="form-control" name="email_id" placeholder="Enter Email Id" maxlength="50" value="<?php echo set_value('email_id'); ?>"/>
                                    <span class="errorMsg"><?php echo form_error('email_id'); ?></span>
                                </div>
                        </div>
                        <div class="row"> 
                            
                                <div class="col-md-12 form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="contact_no" onkeypress="return isNumber(event)" placeholder="Enter Mobile Number" maxlength="10" value="<?php echo set_value('contact_no'); ?>"/>
                                    <span class="errorMsg"><?php echo form_error('contact_no'); ?></span>
                                </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-md-offset-3 form-group">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                                <a href="<?php echo base_url();?>index.php/doctor" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
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