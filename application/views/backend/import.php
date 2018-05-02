<!-- begin #content -->
<div id="content" class="content">
    <!-- begin row -->
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- begin panel -->
            <div class="panel panel-pvr">
                <div class="panel-heading">
                    <h4 class="panel-title">Add BSL Estimation</h4>
                </div>
                <div class="panel-body">
                    
                    <form action="<?php echo base_url();?>reports/importData" enctype="multipart/form-data" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Select File</label>
                                <input type="file" name="importfile"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-md-offset-3">
                                <button type="submit" class="btn btn-sm btn-success pull-left m-r-5">Save</button>
                                <a href="" class="btn btn-sm btn-warning pull-left m-r-5" title="Cancel">Cancel</a>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>