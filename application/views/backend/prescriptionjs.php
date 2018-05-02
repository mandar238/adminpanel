<script type="text/javascript">
    $(document).ready(function(){
    	var checkd = '';
    	$(".drug_details").hide();
        $("#addDrug").click(function(){
            $(".drug_details").toggle(800);
        })

        $('input[type="checkbox"]').on('change', function(e){
           var takeon = $(this).attr('id');
           checkd = takeon;
		   if(e.target.checked){
		     $('#modal_form').modal({backdrop: 'static', keyboard: false});
		     $("#takenat").val(takeon);
		     $.ajax({  
			    type: 'POST',  
			    dataType: 'json',
			    url: '<?php echo base_url();?>index.php/prescription/getTime', 
			    data: {data:takeon},
			    success: function(response) {
			        $("#time").val(response);
			    }
			});
		   }else{
	   	 	 if(takeon == 'morning'){
					$(".lmdose").html('');
					$("#" + takeon).val('');
				}
				if(takeon == 'afternoon'){
					$(".ladose").html('');
					$("#" + takeon).val('');
				}
				if(takeon == 'evening'){
					$(".ledose").html('');
					$("#" + takeon).val('');
				}
				if(takeon == 'night'){
					$(".lndose").html('');
					$("#" + takeon).val('');
				}
		   }
		});
        $("#errtime").hide();
        $("#errdose").hide();
		$("#getdose").click(function(){
			var dose = $("#dose").val();
			var time = $("#time").val();
			var takenat = $("#takenat").val();
			if(dose == ''){
				$("#errdose").show();
				setTimeout(function() { $("#errdose").hide(); }, 3000);
				return false;
			}
			if(time == ''){
				$("#errtime").show();
				setTimeout(function() { $("#errtime").hide(); }, 3000);
				return false;
			}
			if(dose != '' && time != '' && takenat != ''){
				if(takenat == 'morning'){
					$("#" + takenat).val(takenat+'|'+dose+'|'+time);
					$(".lmdose").html(' ( '+dose+' @ '+time+ ' ) ');
				}
				if(takenat == 'afternoon'){
					$("#" + takenat).val(takenat+'|'+dose+'|'+time);
					$(".ladose").html(' ( '+dose+' @ '+time+ ' ) ');
				}
				if(takenat == 'evening'){
					$("#" + takenat).val(takenat+'|'+dose+'|'+time);
					$(".ledose").html(' ( '+dose+' @ '+time+ ' ) ');
				}
				if(takenat == 'night'){
					$("#" + takenat).val(takenat+'|'+dose+'|'+time);
					$(".lndose").html(' ( '+dose+' @ '+time+ ' ) ');
				}
			} 
		});

		var table = $('.drugdetailsTbl').DataTable();
		$('.prescriptionTbl').dataTable({
	        "iDisplayLength": 10
	    });
		var counter = 1;
		$('#getdrugdetails').on( 'click', function () {
			
		 	var drug_name = $("#drug_name").val();
		 	var nodays = $("#duration_days").val();
		 	var takeon = [];
		 	if($("#morning").val() != ''){
		 		takeon.push($("#morning").val());
		 	}
		 	if($("#afternoon").val() != ''){
		 		takeon.push($("#afternoon").val());
		 	}
		 	if($("#evening").val() != ''){
		 		takeon.push($("#evening").val());
		 	}
		 	if($("#night").val() != ''){
		 		takeon.push($("#night").val());
		 	}
	 	

		 if(drug_name == ''){
		 	alert('Please enter drug name');
		 	return false;
		 }

		 if(nodays == ''){
		 	alert('Please duration of days');
		 	return false;
		 }
		 if(takeon == ''){
		 	alert('Please enter dose details');
		 	return false;
		 }
		 
		 	table.row.add( [
            	counter,
            	drug_name,
            	nodays,
            	takeon
    	 	] ).draw( false );
 			
         counter++;
         $("#drug_name").val('');
         $("#duration_days").val('');
         $(".lmdose").html('');
         $(".ladose").html('');
         $(".ledose").html('');
         $(".lndose").html('');
         $("#morning").val();
         $("#afternoon").val();
         $("#evening").val();
         $("#night").val();
         $('input:checkbox').removeAttr('checked');
        } );

        $("#savePrescription").click(function(){
        	var user_id = $("#user_id").val();
			var doctor_id = $("#doctor_id").val();
			var ddate = $("#ddate").val();
        	if(user_id == ''){
			 	alert('Please patient name');
			 	return false;
			 }

			 if(doctor_id == ''){
			 	alert('Please select doctor name');
			 	return false;
			 }

			 if(ddate == ''){
			 	alert('Please select date');
			 	return false;
			 }
        	var heads = [];
			$("thead").find("th").each(function () {
			  heads.push($(this).text().trim());
			});
			var rows = [];
			$("tbody tr").each(function () {
			  cur = {};
			  $(this).find("td").each(function(i, v) {
			    cur[heads[i]] = $(this).text().trim();
			  });
			  rows.push(cur);
			  cur = {};
			});
			var user_id = $("#user_id").val();
			var doctor_id = $("#doctor_id").val();
			var ddate = $("#ddate").val();

			var pers = {
	            user_id: user_id,
	            doctor_id:doctor_id,
	            ddate:ddate,
	        }

			$.ajax({  
			    type: 'POST',  
			    dataType: 'json',
			    url: '<?php echo base_url();?>index.php/prescription/savePrescription', 
			    data: {data:pers, dosedetails:rows},
			    success: function(response) {
			        alert(response);
			    }
			});

        })

        $('#modal_form').on('hidden.bs.modal', function (e) {
        	if($("#dose").val() == '' || $("#time").val() == ''){
        		$("#"+checkd).prop('checked', false);
        	}
		  $("#dose").val('');
		});

		$("#printdata").click(function(){
	      setTimeout(function(){ $("#printdata").show(); }, 2000);
	      $("#printdata").hide();

	      window.print();
	    });
})
</script>

<style type="text/css">
	.modal-sm{
		width: 350px !important;
	}
</style>