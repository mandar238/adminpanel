 <!-- begin #content -->
    <div id="content" class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-pvr">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Patient Name :</label> &nbsp; <span><?=ucfirst($userData['username']);?></span>
                            </div>
                            <div class="col-md-4">
                                <label>Contact No :</label> &nbsp; <span><?=$userData['mobile_no']?></span>
                            </div>
                            <div class="col-md-4">
                                <label>Date :</label> &nbsp; From : <span><?=$_POST['fromDate']?></span> &nbsp;to &nbsp;<span><?=$_POST['toDate']?></span>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <!-- begin row -->
        <div class="row">
            

            <!-- begin col-12 -->
            <div class="col-md-12">
                <!-- begin panel -->
                <div class="panel panel-pvr">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <form action="<?php echo base_url();?>index.php/reports/prescriptionPDF" method="POST" autocomplete="off">
                            <a href="javascript:void(0)" id="printdata" class="btn btn-sm btn-warning pull-left m-r-5" title="Print"><i class="material-icons">print</i></a>
                            <input type="hidden" name="fromDate" value="<?=$_POST['fromDate'];?>" />
                            <input type="hidden" name="toDate" value="<?=$_POST['toDate'];?>" />
                            <input type="hidden" name="user_id" value="<?=$_POST['user_id'];?>" />
                            <button type="submit" class="btn btn-sm btn-success pull-left m-r-5" id="pdf" title="Download PDF"><i class="material-icons">picture_as_pdf</i></button>
                            </form>
                        </div>
                        <h4 class="panel-title">Prescription Report</h4>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="prescriptionTbl table table-striped table-bordered data_table width-full">
                                <thead>
                                <tr>
                                    <th width="20%">Doctor Name</th>
                                    <th width="20%">Date</th>
                                    <th width="20%">Drug Name</th>
                                    <th width="10%">Duration</th>
                                    <th width="25%">Dose Details</th>
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
                                        <?php
                                          $dose_details = explode(',', $value['dose_details']);
                                          for($i=0;$i<count($dose_details);$i++){
                                            echo $dose_details[$i],'<br>';
                                          }
                                        ?>
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

<script type="text/javascript">
   $(document).ready(function(){
    $("#printdata").click(function(){
      setTimeout(function(){ $("#printdata").show(); $("#pdf").show(); }, 2000);
      $("#printdata").hide();
      $("#pdf").hide();
      window.print();
    })
});
</script>