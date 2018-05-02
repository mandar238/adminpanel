 <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin row -->
        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-pvr">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Patient Name</label> &nbsp; <span><?=ucfirst($userData['username']);?></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Contact No</label> &nbsp; <span><?=$userData['mobile_no']?></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Date</label> &nbsp; From : <span><?=$_POST['fromDate']?></span> &nbsp;to &nbsp;<span><?=$_POST['toDate']?></span>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-pvr">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                           <form action="<?php echo base_url();?>index.php/reports/hbaPDF" method="POST" autocomplete="off">
                            <a href="javascript:void(0)" id="printdata" class="btn btn-sm btn-warning pull-left m-r-5" title="Print"><i class="material-icons">print</i></a>
                            <input type="hidden" name="fromDate" value="<?=$_POST['fromDate'];?>" />
                            <input type="hidden" name="toDate" value="<?=$_POST['toDate'];?>" />
                            <input type="hidden" name="user_id" value="<?=$_POST['user_id'];?>" />
                            <button type="submit" class="btn btn-sm btn-success pull-left m-r-5" title="Download PDF"><i class="material-icons">picture_as_pdf</i></button>
                            </form>
                        </div>
                        <h4 class="panel-title">HBA1c Report</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="bslTbl table table-striped table-bordered data_table width-full">
                                <thead>
                                <tr>
                                    <th class="text-center">Sr.No.
                                    </th>
                                    <th>Date</th>
                                    <th>HBA1c (%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                     if(!empty($hbareportData))
                                     {
                                        $count = 1;
                                        foreach ($hbareportData as $key => $value) {
                                    ?>
                                <tr>
                                    <td class="text-center"><?=$count?></td>
                                    <td>
                                        <?=date('d-M-Y',strtotime($value['date'])); ?>
                                    </td>
                                    
                                    <td>
                                        <?=$value['hba_value']; ?>
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