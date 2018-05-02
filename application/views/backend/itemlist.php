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
                        <h4 class="panel-title">Item List</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="itemTbl table table-striped table-bordered data_table width-full">
                          
                        <thead>
                        <tr>
                            <th class="text-center">Sr.No.
                            </th>
                            <th>Category</th>
                            <th>Item</th>
                            <th>Quantity Label</th>
                            <th>Calories</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                             if(!empty($itemData))
                             {
                                $count = 1;
                                foreach ($itemData as $key => $value) {
                            ?>
                        <tr>
                            <td class="text-center"><?=$count?></td>
                            
                            <td>
                                <?=$value['category_name']; ?>
                            </td>
                            <td>
                                <?=$value['item_name']; ?>
                            </td>
                            <td>
                                <?=$value['quantity_label']; ?>
                            </td>
                            <td>
                                <?=$value['calories']; ?>
                            </td>
                            <td>
                            <a href="<?php echo base_url();?>index.php/item/edititem/<?php echo $value['id'];?>" title="Edit"><i class="material-icons">edit</i></a>
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


