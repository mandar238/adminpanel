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
                            <a href="<?php echo base_url();?>user/userPDF"  class="btn btn-sm btn-warning pull-left m-r-5" title="Download PDF"><i class="material-icons">picture_as_pdf</i></a>
                        </div>
                        <h4 class="panel-title">User List</h4>
                    </div>
                    <div class="panel-body">
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
                                    <th>Weight</th>
                                    <th>Height</th>
                                    <th>Lifestyle</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                     if(!empty($userData))
                                     {
                                        $count = 1;
                                        foreach ($userData as $key => $value) {
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
                                        <?=$value['weight']; ?>
                                    </td>
                                    <td>
                                        <?=$value['height']; ?>
                                    </td>
                                    <td>
                                        <?=$value['lifestyle']; ?>
                                    </td>
                                    <td>
                                    <a href="<?php echo base_url();?>index.php/user/editUser/<?php echo $value['id'];?>" title="Edit"><i class="material-icons">edit</i></a>
                                    <!-- <a href="javascript:void(0)" class="btn_delete" data-attr="<?php echo $value['id'];?>" class="text-danger" title="Delete"><i class="material-icons">delete</i></a> -->
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
                <!-- end panel -->
                </div>
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->
</div>
<!-- end page container -->


