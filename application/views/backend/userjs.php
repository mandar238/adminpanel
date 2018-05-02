<script type="text/javascript">
$(".btn_status").click(function(){
        var id = $(this).attr('data-attr');
        var url = 'deleteUser';
        var status = this.value;
        if(status == 1){
          status = 0;
        }else{
          status = 1;
        }
          $.ajax({
                  url : url,
                  type : 'POST',           
                  data :  {
                     id : id, status: status
                    },
                  success: function(data) {
                     //  location.reload();
                      },
                  error: function() {
                    //  location.reload();
                  }

             });
    });
    
    $('.userTbl').dataTable({
        "iDisplayLength": 10
    });
</script>