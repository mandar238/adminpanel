<!-- begin #content -->

<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">User Profile</h4>
                </div>
                <div class="panel-body">
                    <form action="<?php echo base_url();?>index.php/user/saveUser" method="POST" autocomplete="off">
                    <input type="hidden" name="id" value="<?php echo set_value('id', $getUserData['id']); ?>">
                        <div class="row">
                            
                                <div class="col-md-4 form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize;" placeholder="Enter Username" name="username" value="<?php echo $getUserData['username'] ?>" maxlength="15" readonly/>
                                    <span class="errorMsg"><?php echo form_error('username'); ?></span>
                                </div>
                            
                                <div class="col-md-4 form-group">
                                    <label>Relation</label>
                                    <input type="text" class="form-control" placeholder="Relation" name="relation" value="<?php echo $getUserData['relation'] ?>" maxlength="25"/>
                                    <span class="errorMsg"><?php echo form_error('relation'); ?></span>
                                </div>
                            
                                <div class="col-md-4 form-group">
                                    <label>Date OF Birth</label>
                                    <div class="input-group date date_picker">
                                    <input type="text" class="form-control" name="birthdate" placeholder="Select Date" value="<?php echo date('d-m-Y',strtotime($getUserData['birthdate'])) ?>"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                 <span class="errorMsg"><?php echo form_error('birthdate'); ?></span>
                                </div>
                        </div>

                        <div class="row">
                            
                                <div class="col-md-4 form-group">
                                    <div class="radio">
                                        <input type="radio" name="gender" id="radio1" value="Male" <?php if($getUserData['gender'] == "Male") { ?> checked="checked" <?php } ?>>
                                        <label for="radio1">
                                            Male
                                        </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="gender" id="radio2" value="Female" <?php if($getUserData['gender'] == "Female") { ?> checked="checked" <?php } ?>>
                                        <label for="radio2">
                                            Female
                                        </label>
                                    </div>
                                    
                                </div>

                            
                                <div class="col-md-4 form-group">
                                    <label>Email Id</label>
                                    <input type="text" class="form-control" name="email_id" placeholder="Enter Email Id" value="<?php echo $getUserData['email_id'] ?>" maxlength="50"/>
                                    <span class="errorMsg"><?php echo form_error('email_id'); ?></span>
                                </div>

                            
                                <div class="col-md-4 form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile Number" onkeypress="return isNumber(event)" value="<?php echo $getUserData['mobile_no'] ?>" maxlength="10"/>
                                    <span class="errorMsg"><?php echo form_error('mobile_no'); ?></span>
                                </div>
                        </div>
                        <div class="row">
                                <div class="form-group col-md-4">
                                    <label>City</label>
                                    <select class="form-control js-states form-control select_2_clear" id="clearable" name="city_id">
                                        <option value="">Select City</option>
                                        <?php foreach($cityData as $key => $value){ ?>
                                            <option value="<?=$value['id'];?>" <?php echo ($getUserData['city_id']==$value['id'])?" selected=' selected'":""?>><?=$value['name'];?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if(!empty($_POST['city_id'])){?>
                                    <input type="hidden" id="selectedItem" value="<?=$_POST['city_id']?>">
                                    <?php } ?>
                                    <span class="errorMsg"><?php echo form_error('city_id'); ?></span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Pincode</label>
                                    <input type="text" class="form-control" id="pincode"  name="pincode" placeholder="Enter Pincode" onkeypress="return isNumber(event)" maxlength="6" value="<?php echo $getUserData['pincode'] ?>"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label>Weight</label>
                                    <input type="text" class="form-control" name="weight" placeholder="Enter Weight" onkeypress="return isNumber(event)" value="<?php echo $getUserData['weight'] ?>" maxlength="3"/>
                                    <span class="errorMsg"><?php echo form_error('weight'); ?></span>
                                </div>
                            
                                
                        </div>
                        <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Height (cm)</label>
                                    <input type="text" class="form-control" name="height" placeholder="Enter Height" onkeypress="return isNumber(event)" value="<?php echo $getUserData['height'] ?>" maxlength="3"/>
                                    <span class="errorMsg"><?php echo form_error('height'); ?></span>
                                </div>
                            
                                <div class="col-md-4 form-group">
                                    <label>Lifestyle</label>
                                    <select class="form-control" name="lifestyle">
                                        <option value="">Select Lifestyle</option>
                                        <option value="Sedentary (No exrecise)" <?php echo ($getUserData['lifestyle']=='Sedentary (No exrecise)')?" selected=' selected'":""?>>Sedentary (No exrecise)</option>
                                        <option value="Lightly Active (Exercise 1-3 Days/week)" <?php echo ($getUserData['lifestyle']=='Lightly Active (Exercise 1-3 Days/week)')?" selected=' selected'":""?>>Lightly Active (Exercise 1-3 Days/week)</option>
                                        <option value="Moderately Active (Exercise 3-5 Days/week)" <?php echo ($getUserData['lifestyle']=='Moderately Active (Exercise 3-5 Days/week)')?" selected=' selected'":""?>>Moderately Active (Exercise 3-5 Days/week)</option>
                                        <option value="Active (Exercise 6-7 Days/week)"> <?php echo ($getUserData['lifestyle']=='Active (Exercise 6-7 Days/week)')?" selected=' selected'":""?>Active (Exercise 6-7 Days/week)</option>
                                        <option value="Very Active (Heavy exercise/phy.job)" <?php echo ($getUserData['lifestyle']=='Very Active (Heavy exercise/phy.job)')?" selected=' selected'":""?>>Very Active (Heavy exercise/phy.job)</option>
                                    </select>
                                    <span class="errorMsg"><?php echo form_error('lifestyle'); ?></span>
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="form-check-label">
                                        <div class="checkbox checkbox-primary m-0">
                                            <input id="form-check-input1" class="styled form-check-input" name="user_status" type="checkbox" <?php if($getUserData['user_status'] == 1) { ?> checked="checked" <?php } ?> <?php if($this->session->userdata['USER_ID'] == 1) { ?> disabled="disabled" <?php } ?>>
                                            <label for="form-check-input1">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                                <a href="<?php echo base_url();?>index.php/user" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
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