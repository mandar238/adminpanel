
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">Update Exercise</h4>
                </div>
                <div class="panel-body">
                    
                    <form action="<?php echo base_url();?>index.php/exercise/saveexercise" method="POST" autocomplete="off">
                        <input type="hidden" name="id" value="<?php echo set_value('id', $getexerciseData['id']); ?>">
                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Exercise Name</label>
                                <input type="text" class="form-control" id="exercise_name" name="exercise_name" placeholder="Enter exercise Name" value="<?php echo $getexerciseData['exercise_name']; ?>"/>
                                <span class="errorMsg"><?php echo form_error('exercise_name'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Calories Spent</label>
                                <input type="text" class="form-control" id="calories_spent" name="calories_spent" placeholder="Enter Calories Spent" onkeypress="return isNumber(event)" maxlength="5" value="<?php echo $getexerciseData['calories_spent']; ?>"/>
                                <span class="errorMsg"><?php echo form_error('calories_spent'); ?></span>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-md-12 col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                                <a href="<?php echo base_url();?>index.php/exercise" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
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