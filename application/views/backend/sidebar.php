<!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <div class="image">
                        <a href="javascript:void(0)">
                            <img src="http://via.placeholder.com/128x128" alt=""/>
                        </a>
                    </div>
                    <div class="info">
                        <?php echo ucfirst($this->session->userdata['USER_NAME']);?>
                        <small class="m-b-15"></small>
                        
                        <!-- <a href="javascript:void(0)" class="user_icons" data-toggle="tooltip" title="Notification">
                            <i class="material-icons">notifications_active</i>
                        </a>
                        <a href="javascript:void(0)" class="user_icons" data-toggle="tooltip" title="Email">
                            <i class="material-icons">email</i>
                        </a> -->
                        <a href="<?php echo base_url();?>index.php/login/logout" class="user_icons" data-toggle="tooltip" title="Logout">
                            <i class="material-icons">power_settings_new</i>
                        </a>
                    </div>
                </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
                <?php if($this->session->userdata['USER_TYPE'] == 2){?>
                <li class="<?php if($this->router->fetch_class() == 'dashboard'):echo 'active';endif;?>">
                    <a href="<?php echo base_url(); ?>index.php/dashboard">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="has-sub <?php if($this->router->fetch_class() == 'user'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">person</i>
                        <span>User</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addUser'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/user/addUser">New User</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/user">User List</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if(isset($this->session->userdata['selectedUser'])){?>
                <li class="has-sub <?php if($this->router->fetch_class() == 'doctor'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">library_add</i>
                        <span>Doctor</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addDoctor'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/doctor/addDoctor">New Doctor</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/doctor">Doctor List</a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'useractivity'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">accessibility</i>
                        <span>User Activity</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addUseractivity'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/useractivity/addUseractivity">Add Activity</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/useractivity">User Activity List</a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'userexercise'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">accessibility</i>
                        <span>User Exercise</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addUserexercise'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/userexercise/addUserexercise">Add Exercise</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/userexercise">User Exercise List</a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'meal'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">movie_filter</i>
                        <span>Meal</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addMeal'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/meal/addMeal">Add Meal</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/meal">Meal List</a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'bslestimation'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">format_bold</i>
                        <span>BSL Estimation</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addBslestimation'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/bslestimation/addBslestimation">Add Bsl Estimation</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/bslestimation">BSL Estimation List</a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'hbaestimation'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">local_activity</i>
                        <span>HBA1c Estimation</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addHbaestimation'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/hbaestimation/addHbaestimation">Add HBA Estimation</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/hbaestimation">HBA Estimation List</a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'prescription'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">assignment</i>
                        <span>Prescription</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addPrescription'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/prescription/addPrescription">Add Prescription</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/prescription">Prescription List</a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'reports'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">trending_up</i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'bslreportform'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/reports/bslreportform">BSL Report</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'hbareportform'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/reports/hbareportform">HBA1c Report</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'caloriesreportform'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/reports/caloriesreportform">Calories Report</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'prescriptionReport'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/reports/prescriptionReport">Prescription Report</a></li>
                    </ul>
                </li>
                <?php }?>
                <?php if($this->session->userdata['USER_TYPE'] == 1){?>
                <li class="<?php if($this->router->fetch_class() == 'dashboard'):echo 'active';endif;?>">
                    <a href="<?php echo base_url(); ?>index.php/dashboard/admin">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?php if($this->router->fetch_class() == 'user'):echo 'active';endif;?>">
                    <a href="<?php echo base_url(); ?>index.php/user/userlist">
                         <i class="material-icons">person</i>
                        <span>Users List</span>
                    </a>
                </li>
                <li class="<?php if($this->router->fetch_class() == 'schedulesetting'):echo 'active';endif;?>">
                    <a href="<?php echo base_url(); ?>index.php/schedulesetting">
                        <i class="material-icons">schedule</i>
                        <span>Schedule Setting</span>
                    </a>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'activity'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">accessibility</i>
                        <span>Activity</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addactivity'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/activity/addactivity">Add Activity</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/activity"> Activity List</a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'exercise'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">accessibility</i>
                        <span>Exercise</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'addexercise'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/exercise/addexercise">Add Exercise</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/exercise"> Exercise List</a></li>
                    </ul>
                </li>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'item'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">group_work</i>
                        <span>Food Item</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'additem'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/item/additem">Add Item</a></li>
                        <li class="<?php if($this->router->fetch_method() == 'index'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/item"> Items List</a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if($this->router->fetch_class() == 'reports'):echo 'active';endif;?>">
                    <a href="javascript:void(0)">
                        <b class="caret pull-right"></b>
                        <i class="material-icons">list</i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if($this->router->fetch_method() == 'userreportform'):echo 'active';endif;?>"><a href="<?php echo base_url();?>index.php/reports/userreportform">User Report</a></li>
                    </ul>
                </li>
                <?php }?>
            </ul>
            <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->
