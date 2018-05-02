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
                        <h4 class="panel-title">Prescription List</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="prescriptionTbl table table-striped table-bordered data_table width-full">
                                <thead>
                                <tr>
                                    <th class="text-center">Sr.No.
                                    </th>
                                    <th>Patient Name</th>
                                    <th>Doctor Name</th>
                                    <th>Date</th>
                                    <th>Drug Name</th>
                                    <th>Duration (Days)</th>
                                    <th>Dose Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                     if(!empty($prescriptionData))
                                     {
                                        $count = 1;
                                        foreach ($prescriptionData as $key => $value) {
                                    ?>
                                <tr>
                                    <td class="text-center"><?=$count?></td>
                                    <td>
                                        <?=$value['pname']; ?>
                                    </td>
                                    <td>
                                        <?='Dr.'.$value['fname'].' '.$value['lname']; ?>
                                    </td>
                                    <td>
                                        <?=date('d-M-Y',strtotime($value['date'])); ?>
                                    </td>
                                    <td>
                                        <?=$value['drug_name']; ?>
                                    </td>
                                    <td>
                                        <?=$value['duration_days']; ?>
                                    </td>
                                    <td>
                                        <?=$value['dose_details']; ?>
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



