
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">User Report</h4>
                </div>
                <div class="panel-body">
                    
                    <form action="<?php echo base_url();?>index.php/reports/generateUserReport" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="form-group col-md-2">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male" <?php echo (set_value('gender')=='Male')?" selected=' selected'":""?>>Male</option>
                                        <option value="Female" <?php echo (set_value('gender')=='Female')?" selected=' selected'":""?>>Female</option>
                                    </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Lifestyle</label>
                                <select class="form-control" name="lifestyle">
                                    <option value="">Select Lifestyle</option>
                                    <option value="Sedentary (No exrecise)" <?php echo (set_value('lifestyle')=='Sedentary (No exrecise)')?" selected=' selected'":""?>>Sedentary (No exrecise)</option>
                                    <option value="Lightly Active (Exercise 1-3 Days/week)" <?php echo (set_value('lifestyle')=='Lightly Active (Exercise 1-3 Days/week)')?" selected=' selected'":""?>>Lightly Active (Exercise 1-3 Days/week)</option>
                                    <option value="Moderately Active (Exercise 3-5 Days/week)" <?php echo (set_value('lifestyle')=='Moderately Active (Exercise 3-5 Days/week)')?" selected=' selected'":""?>>Moderately Active (Exercise 3-5 Days/week)</option>
                                    <option value="Active (Exercise 6-7 Days/week)" <?php echo (set_value('lifestyle')=='Active (Exercise 6-7 Days/week)')?" selected=' selected'":""?>>Active (Exercise 6-7 Days/week)</option>
                                    <option value="Very Active (Heavy exercise/phy.job)" <?php echo (set_value('lifestyle')=='Very Active (Heavy exercise/phy.job)')?" selected=' selected'":""?>>Very Active (Heavy exercise/phy.job)</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                    <label>Status</label>
                                    <select class="form-control" name="user_status">
                                        <option value="">Select Status</option>
                                        <option value="1" <?php echo (set_value('user_status')=='1')?" selected=' selected'":""?>>Active</option>
                                        <option value="2" <?php echo (set_value('user_status')=='2')?" selected=' selected'":""?>>Inactive</option>
                                    </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>City</label>
                                <select class="form-control js-states select_2_clear" id="clearable" name="city_id">
                                    <option value="">Select City</option>
                                    <?php foreach($cityData as $key => $value){ ?>
                                        <option value="<?=$value['id'];?>" <?php echo (set_value('city_id')==$value['id'])?" selected=' selected'":""?>><?=$value['name'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="form-group col-md-12" >
                                <center><button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Report</button></center>
                                <a href="<?php echo base_url();?>index.php/reports/userreportform" class="btn btn-sm btn-warning pull-left m-r-5" title="Refresh">Refresh</a>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
            <!-- end panel -->
        </div>
    </div>
<?php 
if(!empty($userreportData))
                                     {?>

    <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-pvr">
                    <div class="panel-heading">
                        
                        <h4 class="panel-title">User Report List</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-12" >
                     <form action="<?php echo base_url();?>reports/userReportPDF" method="POST" autocomplete="off">
                            <input type="hidden" name="gender" value="<?=$_POST['gender'];?>" />
                            <input type="hidden" name="lifestyle" value="<?=$_POST['lifestyle'];?>" />
                            <input type="hidden" name="user_status" value="<?=$_POST['user_status'];?>" />
                            <input type="hidden" name="city_id" value="<?=$_POST['city_id'];?>" />
                            <button type="submit" class="btn btn-sm btn-success pull-left m-r-5" title="Download PDF"><i class="material-icons">picture_as_pdf</i></button>
                            </form>
                            </div>
                            </div>
                        <div class="table-responsive">
                            <table class="userTbl table table-striped table-bordered data_table width-full">
                          
                                <thead>
                                <tr>
                                    <th class="text-center">Sr.No.
                                    </th>
                                    <th>User Details</th>
                                    <th>Relation</th>
                                    <th>Date Of Birth</th>
                                    <th>Gender</th>
                                    <th>Weight/Height</th>
                                    <th>City</th>
                                    <th>Lifestyle</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                     
                                        $count = 1;
                                        foreach ($userreportData as $key => $value) {
                                    ?>
                                <tr>
                                    <td class="text-center"><?=$count?></td>
                                    <td>
                                        <div class="">
                                            <span>
                                                <?=$value['username']; ?>
                                            </span>
                                            <br>
                                            <span class="f-s-12">
                                               <?=$value['email_id']; ?>
                                            </span>
                                            <span class="f-s-12">
                                                <?=$value['mobile_no']; ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <?=$value['relation']; ?>
                                    </td>
                                    <td>
                                        <?=date('d-M-Y',strtotime($value['birthdate'])); ?>
                                    </td>
                                    <td>
                                        <?=$value['gender']; ?>
                                    </td>
                                    <td>
                                        Weigth : <?=$value['weight']; ?><br>
                                        Height : <?=$value['height']; ?>
                                    </td>
                                    <td>
                                        <?=$value['city_name']; ?>
                                    </td>
                                    <td>
                                        <?=$value['lifestyle']; ?>
                                    </td>
                                    <td>
                                        <?php if($value['user_status'] == 0){ 
                                            echo 'Inactive';
                                           } ?>
                                            <?php if($value['user_status'] == 1){ 
                                            echo 'Active';
                                           } ?>

                                    </td>
                                </tr>
                                 <?php  
                                                  $count++;
                                                  }
                                            ?>
                                </tbody>
                            </table>
                        </div>
                <!-- end panel -->
                </div>
            </div>
            <!-- end col-12 -->
        </div>
        <?php }else{?>
        <?php if(!empty($_POST)){?>
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-pvr">
                   
                    <div class="panel-body">
                        <div class="row">
                            <center><strong>No Records Found</strong></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
        <?php }?>
        <!-- end row -->
    
</div>
    <!-- end #content -->