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
                        <h4 class="panel-title">HBA1c Estimation List</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="hbaTbl table table-striped table-bordered data_table width-full">
                          
                        <thead>
                        <tr>
                            <th class="text-center">Sr.No.
                            </th>
                            <th>Date</th>
                            <th>Patient Name</th>
                            <th>Time</th>
                            <th>HBA (%)</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                             if(!empty($hbaestimationdata))
                             {
                                $count = 1;
                                foreach ($hbaestimationdata as $key => $value) {
                            ?>
                        <tr>
                            <td class="text-center"><?=$count?></td>
                            <td>
                                <?=date('d-M-Y',strtotime($value['date'])); ?>
                            </td>
                            <td>
                                <?=$value['username']; ?>
                            </td>
                            <td>
                                <?=$value['time']; ?>
                            </td>
                            <td>
                                <?=$value['hba_value']; ?>
                            </td>
                            <td>
                            <a href="<?php echo base_url();?>index.php/hbaestimation/editHbaestimation/<?php echo $value['id'];?>" title="Edit"><i class="material-icons">edit</i></a>
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



