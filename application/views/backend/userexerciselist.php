    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin row -->
        <div class="row">
         <div class="col-md-12">
            <!-- begin panel -->
                <div class="panel panel-pvr">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <i class="material-icons" data-click="panel-reload">refresh</i>
                            <i class="material-icons" data-click="panel-collapse">import_export</i>
                        </div>
                        <h4 class="panel-title">User Exercise List</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="exerciseTbl table table-striped table-bordered data_table width-full">
                          
                            <thead>
                            <tr>
                                <th class="text-center">Sr.No.
                                </th>
                                <th>Patient Name</th>
                                <th>Date</th>
                                <th>Exercise Name</th>
                                <th>Duration(Min)</th>
                                <th>Calories Spent</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                 if(!empty($userexerciseData))
                                 {
                                    $count = 1;
                                    foreach ($userexerciseData as $key => $value) {
                                ?>
                            <tr>
                                <td class="text-center"><?=$count?></td>
                                <td>
                                    <?=$value['username']; ?>
                                </td>
                                <td>
                                    <?=date('d-M-Y',strtotime($value['date'])); ?>
                                </td>
                                <td>
                                   <?=$value['exercise_name']; ?>
                                </td>
                                
                                <td>
                                    <?=$value['duration']; ?>
                                </td>
                                <td>
                                    <?=$value['calories_spent']; ?>
                                </td>
                                <td>
                                <a href="<?php echo base_url();?>index.php/userexercise/editUserexercise/<?php echo $value['id'];?>" title="Edit"><i class="material-icons">edit</i></a>
                                <a href="javascript:void(0)" class="btn_delete" data-attr="<?php echo $value['id'];?>" class="text-danger" title="Delete"><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                             <?php  
                                              $count++;
                                              }
                                           }
                                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
<!-- end page container -->



