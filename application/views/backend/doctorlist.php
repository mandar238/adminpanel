    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin row -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-pvr">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <i class="material-icons" data-click="panel-reload">refresh</i>
                            <i class="material-icons" data-click="panel-collapse">import_export</i>
                        </div>
                        <h4 class="panel-title">Doctor List</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="doctorTbl table table-striped table-bordered data_table width-full">
                                
                        <thead>
                        <tr>
                            <th class="text-center">Sr.No.
                            </th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Email Id</th>
                            <th>Contact Number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                             if(!empty($doctorData))
                             {
                                $count = 1;
                                foreach ($doctorData as $key => $value) {
                            ?>
                        <tr>
                            <td class="text-center"><?=$count?></td>
                             <td>
                                <?=$value['username']; ?>
                            </td>
                            <td>
                                <div class="user_box">
                                    <div class="user_email">
                                        <span>
                                            Dr. <?=$value['fname'].' '.$value['lname']; ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?=$value['email_id']; ?>
                            </td>
                            <td>
                                <?=$value['contact_no']; ?>
                            </td>
                            <td>
                            <a href="<?php echo base_url();?>index.php/doctor/editDoctor/<?php echo $value['id'];?>" title="Edit"><i class="material-icons">edit</i></a>
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
</div>
<!-- end page container -->


