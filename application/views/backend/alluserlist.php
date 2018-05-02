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
                                    <th>Weight/Height</th>
                                    <th>Location</th>
                                    <th>Lifestyle</th>
                                    <th>Status</th>
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
                                        Weight : <?=$value['weight']; ?> <br>
                                        Height : <?=$value['height']; ?>
                                    </td>
                                    <td>
                                        <?=$value['city_name']; ?>
                                    </td>
                                    <td>
                                        <?=$value['lifestyle']; ?>
                                    </td>
                                    <td width="200px"><label class="switch1">
                                        <input type="checkbox" class="btn_status" data-attr="<?php echo $value['id'];?>" value="<?=$value['user_status'];?>"<?=$value['user_status'] == '1' ? ' checked="checked"' : '';?>>
                                        <span class="slider round"></span>
                                        </label>
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


