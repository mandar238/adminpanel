<!-- begin search -->
    <!-- <div class="search">
        <i id="btn-search-close" class="material-icons btn--search-close">close</i>
        <form class="search__form" action="#">
            <input class="search__input" name="search" type="search" placeholder="Search.." autocomplete="off"
                    autocapitalize="off" spellcheck="false"/>
            <span class="search__info">Hit enter to search or ESC to close</span>
        </form>
        <div class="search__related">
            <div class="search__suggestion">
                <h3>May We Suggest?</h3>
                <p>#drone #funny #catgif #broken #lost #hilarious #good #red #blue #nono #why #yes #yesyes #aliens
                    #green</p>
            </div>
            <div class="search__suggestion">
                <h3>Is It This?</h3>
                <p>#good #red #hilarious #blue #nono #why #yes #yesyes #aliens #green #drone #funny #catgif #broken
                    #lost</p>
            </div>
            <div class="search__suggestion">
                <h3>Needle, Where Art Thou?</h3>
                <p>#broken #lost #good #red #funny #hilarious #catgif #blue #nono #why #yes #yesyes #aliens #green
                    #drone</p>
            </div>
        </div>
    </div> -->
    <!-- end #search -->

    <!-- begin bark_button -->
    <!-- <div class="pvr-floated-chat-btn" id="make_theme_dark">
        <i class="material-icons">radio_button_checked</i>
        <span>Dark Version</span>
    </div> -->
    <!-- end #bark_button -->

    <!-- begin scroll to top btn -->
    <a href="javascript:void(0)" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
       data-click="scroll-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery-migrate-1.4.1.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/classie/classie.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- 
<script src="assets/plugins/classie/classie.js"></script>
 --><link href="<?php echo base_url();?>assets/plugins/switchery/switchery.min.css" rel="stylesheet"/>
<script src="<?php echo base_url();?>assets/plugins/switchery/switchery.min.js"></script>

<!--[if lt IE 9]>
<script src="assets/crossbrowserjs/html5shiv.js"></script>
<script src="assets/crossbrowserjs/respond.min.js"></script>
<script src="assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo base_url();?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-cookie/js.cookie.js"></script>
<script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/typeit/typeit.js"></script>
<script src="<?php echo base_url();?>assets/plugins/countup/countUp.min.js"></script>
<script src="<?php echo base_url();?>assets/js/app.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo base_url();?>assets/plugins/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo base_url();?>assets/plugins/amcharts/amcharts.js"></script>
<script src="<?php echo base_url();?>assets/plugins/amcharts/serial.js"></script>
<script src="<?php echo base_url();?>assets/plugins/amcharts/none.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
<script src="<?php echo base_url();?>assets/plugins/amcharts/ammap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/amcharts/worldLow.js"></script>
<script src="<?php echo base_url();?>assets/plugins/amcharts/export.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/amcharts/none.js"></script>
<script src="<?php echo base_url();?>assets/js/index.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-timepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/select2/dist/js/select2.min.js"></script>

<script src="<?php echo base_url();?>assets/plugins/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/plugins/highcharts/heatmap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/highcharts/tilemap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/highcharts/exporting.js"></script>
<script src="<?php echo base_url();?>assets/plugins/highcharts/highcharts-more.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
</body>

<script type="text/javascript">
var date = new Date();
var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
var fdate = new Date(date.getFullYear(), date.getMonth()-1, date.getDate());
    $('.date_picker').datepicker({
      
          format: 'dd-mm-yyyy',
          todayHighlight: true,
          orientation: 'bottom right',
          autoclose: true,

    });
    $( '.date_picker' ).datepicker( 'setDate', today );
    $('.date_picker1').datepicker({
          format: 'dd-mm-yyyy',
          todayHighlight: true,
          orientation: 'bottom right',
          autoclose: true,

    });
    $( '.date_picker1' ).datepicker( 'setDate', fdate );
</script>
<script type="text/javascript">
            $('.timepicker1').timepicker();
        </script>
<script type="text/javascript">var base_url = "<?php print base_url(); ?>";</script>
<script type="text/javascript">
toastr.options = {
      "closeButton": false,
      "positionClass": "toast-top-center",
      "timeOut": 2000
  }

<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php } ?>
function isNumber(evt) {

        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

  <script type="text/javascript">
    $(document).ready(function(){

        $('input:radio[name="selected_user_id"]').change(
            function(){
                if (this.checked) {
                    $.ajax({  
                        type: 'POST',  
                        dataType: 'json',
                        url: '<?php echo base_url();?>index.php/dashboard/selectedUser', 
                        data: {user_id:this.value},
                        success: function(response) {
                                if(response.success){
                                    window.location.reload();
                                }
                        }
                    });
            }
    })
    })
    </script>
</html>