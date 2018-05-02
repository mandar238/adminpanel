<script type="text/javascript">
$(".btn_delete").click(function(){
        var id = $(this).attr('data-attr');
        var url = 'useractivity/deleteUseractivity' 
        swal({
        title: "Are you sure?",
        text: "You will not be able to recover this record",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.ajax({
                  url : url,
                  type : 'POST',           
                  data :  {
                     id : id,
                    },
                  success: function(data) {
                       location.reload();
                      },
                  error: function() {
                      location.reload();
                  }

             });
          
        } else {
          
        }
      });

    });

     $('.activityTbl').dataTable({
        "iDisplayLength": 10
    });

     $('#activity_id').change(function(){
      var activity_id = $(this).val();
      $("#duration").val('');
      $("#calories_spent").val('');
      $.ajax({
        type:"POST",
        url: "<?php echo base_url();?>index.php/useractivity/getActivity",
        data: {
          activity_id:activity_id
        },
        success: function(result) { 
           console.log(result);
          result =  JSON.parse(result);
          $('#calpermin').val(result.calories_spent);
        }
      });
    });

    $("#duration").keyup(function(){
      var calpermin = $('#calpermin').val();
      var duration = $(this).val();
      if(duration >= 0){
      var calories_spent = calpermin * duration;
        $("#calories_spent").val(calories_spent);
      }else{
        $("#calories_spent").val('');
      }
    });
</script>