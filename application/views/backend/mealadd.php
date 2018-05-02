
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">Meal Details</h4>
                </div>
                <div class="panel-body">
                   
                    <form action="<?php echo base_url();?>index.php/meal/saveMeal" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Date</label>
                                <div class="input-group date date_picker">
                                    <input type="text" class="form-control" name="sdate" placeholder="Select Date" value="<?php echo set_value('sdate') ?>"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <span class="errorMsg"><?php echo form_error('sdate'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Select Patient</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    <option value="">Select Patient</option>
                                    <?php foreach($userData as $key => $value){ ?>
                                        <option value="<?=$value['id'];?>" <?php echo ($this->session->userdata['selectedUser']==$value['id'])?" selected=' selected'":""?>><?=$value['username'];?></option>
                                    <?php } ?>
                                </select>
                                <span class="errorMsg"><?php echo form_error('user_id'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Select Food Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    <?php foreach($categoryData as $key => $value){ ?>
                                        <option value="<?=$value['id'];?>" <?php echo (set_value('category_id')==$value['id'])?" selected=' selected'":""?>><?=$value['category_name'];?></option>
                                    <?php } ?>
                                </select>
                                <span class="errorMsg"><?php echo form_error('category_id'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Select Food Item</label>
                                <select class="form-control js-states form-control select_2_search_starts" id="item_id" name="item_id">
                                    <option value="">Select Item</option>
                                </select>
                                <?php if(!empty($_POST['item_id'])){?>
                                <input type="hidden" id="selectedItem" value="<?=$_POST['item_id']?>">
                                <?php } ?>
                                <span class="errorMsg"><?php echo form_error('item_id'); ?></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label id="qtylabel">Quantity</label>
                                <input type="hidden" id="calperunit" />
                                <input type="text" class="form-control" id="quantity" onkeypress="return isNumber(event)" name="quantity" placeholder="Enter Quantity" maxlength="3" value="<?php echo set_value('quantity') ?>" onkeypress="return isNumber(event)"/>
                                <span class="errorMsg"><?php echo form_error('quantity'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                            <label id="qtylabel">Calories Taken</label>
                            <input type="text" class="form-control" id="calories_taken" name="calories_taken" placeholder="Calories Taken" value="<?php echo set_value('calories_taken') ?>" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                                <a href="<?php echo base_url();?>index.php/meal" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
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