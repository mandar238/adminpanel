

    

    <!-- begin #content -->
    <div id="content" class="content dashboard_v1">
        <!-- begin row -->
        <div class="row">
            <div class="col-md-4">
                <h4 class="panel-title">Users</h4>
            </div>
        </div>
        <br>
        <div class="row">
        
        <?php
                    
          if(!empty($userData)){
            foreach ($userData as $key => $value) {
            ?>
            
            <div class="col-md-3 col-sm-6">
                <div class="card card-shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="radio">

                                <input type="radio" value="<?=$value['id'];?>" name="selected_user_id" <?php if(isset($this->session->userdata['selectedUser'])){if($this->session->userdata['selectedUser'] == $value['id']) { ?> checked="checked" <?php }} ?>/>
                                <label for="radio1">
                                </label>
                            </div>
                            
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <span class="bg-pink text-center pvr-icon-box">
                                    <i class="icon-people text-light f-s-24"></i>
                                </span>
                            </div>
                            <div class="col-md-7 col-sm-7 col-xs-7">
                                <h5 class="mt-1 mb-0" data-typeit="true" ><?=$value['username'];?></h5>
                                <p class="mb-0"><?=$value['mobile_no']; ?></p>
                                <p class="mb-0"><?=$value['email_id']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
            }   
         } ?>
        </div>
        <!-- end row -->

     
    </div>
    <!-- end #content -->

  

    