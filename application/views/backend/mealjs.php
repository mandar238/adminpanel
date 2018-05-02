<script type="text/javascript">
$(".btn_delete").click(function(){
        var id = $(this).attr('data-attr');
        var url = 'meal/deleteMeal' 
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

    $('.mealTbl').dataTable({
        "iDisplayLength": 10
    });
   
      var category_id = $("#category_id").val();

      if(category_id != ''){
      $.ajax({
        type:"POST",
        url: "<?php echo base_url();?>index.php/meal/getItems",
        data: {
          category_id:category_id
        },
        success: function(result) { 
          var html_code = '';
          result =  JSON.parse(result);
          html_code = '<option value="">Select Item</option>';
           $.each(result, function(key, value){
              if(value.id == $('#selectedItem').val()){
                $("#calperunit").val(value.calories);
                $('#qtylabel').html(value.quantity_label);
                html_code += '<option value="'+value.id+'" selected="selected">'+value.item_name+'</option>';
              }else{
                html_code += '<option value="'+value.id+'">'+value.item_name+'</option>';
              }
             });
          $('#item_id').html(html_code);
        }
      });
    }

    $('#category_id').change(function(){
      var category_id = $(this).val();

      $.ajax({
        type:"POST",
        url: "<?php echo base_url();?>index.php/meal/getItems",
        data: {
          category_id:category_id
        },
        success: function(result) { 
          var html_code = '';
          result =  JSON.parse(result);
          html_code = '<option value="">Select Item</option>';
           $.each(result, function(key, value){
              html_code += '<option value="'+value.id+'">'+value.item_name+'</option>';
             });
          $('#item_id').html(html_code);
        }
      });
    })

    $('#item_id').change(function(){
      var item_id = $(this).val();
      $("#quantity").val('');
      $("#calories_taken").val('');
      $.ajax({
        type:"POST",
        url: "<?php echo base_url();?>index.php/meal/getItemslabel",
        data: {
          item_id:item_id
        },
        success: function(result) { 
          console.log(result);
          result =  JSON.parse(result);
          $('#qtylabel').html(result.quantity_label);
          $('#calperunit').val(result.calories);
        }
      });
    });

    $("#quantity").keyup(function(){
      var calperunit = $('#calperunit').val();
      var quantity = $(this).val();
      if(quantity >= 0){
      var calories_taken = calperunit * quantity;
        $("#calories_taken").val(calories_taken);
      }else{
        $("#calories_taken").val('');
      }
    });

   function isNumber(evt) {

        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        var s = $("#loan_amt").val();
        s = s.replace(/^0+/, '');
        $("#loan_amt").val(s);
        return true;
    }
</script>