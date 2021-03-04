jQuery(document).ready(function($) {
	
	$("body").on("click", "#varify_key", function(event){
	$(".cmgt_ajax-img").show();
	$(".page-inner").css("opacity","0.5");
	event.preventDefault(); // disable normal link function so that it doesn't refresh the page
	var res_json;
	var licence_key = $('#licence_key').val();
	var enter_email = $('#enter_email').val();
	var curr_data = {
		action: 'cmgt_verify_pkey',
		licence_key : licence_key,
		enter_email : enter_email,
		dataType: 'json'
	};	
									
	$.post(smgt.ajax, curr_data, function(response) { 						
		console.log(response);
							res_json = JSON.parse(response);
							
							$('#message').html(res_json.message);
							$("#message").css("display","block");
							$(".cmgt_ajax-img").hide();
							$(".page-inner").css("opacity","1");

							if(res_json.cmgt_verify == '0')
							{
								window.location.href = res_json.location_url;
							}
							return true; 					
	 					});	
	
  });
	$("#class_section").change(function(){
		
		$('#subject_list').html('');			
		var selection = $("#class_list").val();	
		//alert(selection);
        var selection_id = $("#class_section").val();
		/* alert(selection_id);
		return false; */
		var optionval = $(this);
			var curr_data = {
				action: 'smgt_load_subject_class_id_and_section_id',
				class_list: $("#class_list").val(),
                class_section:$("#class_section").val(),				
				dataType: 'json'
			};
		 $.post(smgt.ajax, curr_data, function(response) {
			    $('#subject_list').append(response);				
			});
	});
	
	
  $("body").on("click", "#pdf", function(){
 var student_id = $("#student_id").val();
  var curr_data = {
					action: 'smgt_result_pdf',
					student_id: student_id,			
					dataType: 'json'
					};
					$.post(smgt.ajax, curr_data, function(response) 
					{
						return true;
					});	
		});

  $("body").on("click", ".view-notice", function(event){	  
	  var notice_id = $(this).attr('id');
	  //alert(notice_id);
	  event.preventDefault(); // disable normal link function so that it doesn't refresh the page
	  var docHeight = $(document).height(); //grab the height of the page
	  var scrollTop = $(window).scrollTop();
	 
	   var curr_data = {
	 					action: 'smgt_view_notice',
	 					notice_id: notice_id,			
	 					dataType: 'json'
	 					};
	 					//alert('hello');
	 					$.post(smgt.ajax, curr_data, function(response) {
	 						
	 						//alert('hello');
	 						$('.popup-bg').show().css({'height' : docHeight});
							$('.notice_content').html(response);	
	 						return true;
	 						
	 					
	 					
	 					});	
	 		});

	
	//alert('hello');
  /* $('.popup').click(function() {
     var NWin = window.open($(this).prop('href'), '', 'scrollbars=1,height=400,width=400');
     if (window.focus)
     {
       NWin.focus();
     }
     return false;
    });*/
	
	//POP-UP 
	
	
	//notice_for_ajax
	
	$("body").on("change", ".notice_for_ajax", function(event){	
		var selection = $(this).val();
		if(selection == 'parent' || selection=='supportstaff')
		{
			$('#smgt_select_class').hide();
			$('#smgt_select_section').hide();
		}
		else if(selection=='teacher' || selection == 'all')
		{
			$('#smgt_select_section').hide();
		}
		else
		{
			$('#smgt_select_class').show();
			$('#smgt_select_section').show();
		}	
		
	});
	$(".notice_for_ajax").trigger("change");
	
	
	$("body").on("click", ".show-popup", function(event){	
		var student_id = $(this).attr('idtest') ;		
		event.preventDefault(); // disable normal link function so that it doesn't refresh the page
		var docHeight = $(document).height(); //grab the height of the page
		var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
			
		var curr_data = {
			action: 'smgt_result',
			student_id: student_id,			
			dataType: 'json'
		};
		
		$.post(smgt.ajax, curr_data, function(response) {
			$('.popup-bg').show().css({'height' : docHeight});
			$('.result').html(response);	
		});	
	});
	$("body").on("click", ".active-user", function(event){	
		var student_id = $(this).attr('idtest') ;			
		event.preventDefault(); // disable normal link function so that it doesn't refresh the page
		var docHeight = $(document).height(); //grab the height of the page
		var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
		
		
		var curr_data = {
			action: 'smgt_active_student',
			student_id: student_id,			
			dataType: 'json'
		};
				
		$.post(smgt.ajax, curr_data, function(response) {
			$('.popup-bg').show().css({'height' : docHeight});
			$('.result').html(response);	
						
		});	
	});	
		
		$("body").on("click", ".close-btn", function(){		
			$( ".result" ).empty();
			$( ".view-parent" ).empty();
			$('.popup-bg').hide(); // hide the overlay
		});
		
	$("#class_list").change(function(){
		$('#subject_list').html('');			
		var selection = $("#class_list").val();		
		var optionval = $(this);
			var curr_data = {
				action: 'smgt_load_subject',
				class_list: $("#class_list").val(),			
				dataType: 'json'
			};
			
			$.post(smgt.ajax, curr_data, function(response) {
				$('#subject_list').append(response);
			});
	});
	/* Notification Module*/
$("#notification_class_list_id,#notification_class_section_id").change(function(){		
	var class_list = $("#notification_class_list_id").val();	
	var class_section = $("#notification_class_section_id").val();
	var clicked_id = $(this).attr('id');
	
	var curr_data = {
		action: 'smgt_notification_user_list',			
		class_list: class_list,					
		class_section: class_section,					
		dataType: 'json'
	};
	
$.post(smgt.ajax, curr_data, function(response) {

 var json_obj = $.parseJSON(response);//parse JSON			 
	
	if(clicked_id!='notification_class_section_id')
	{
		$('#notification_class_section_id').html('');
		$('#notification_class_section_id').append(json_obj['section']);
	}	
	$('.notification_user_display_block').html('');
	$('.notification_user_display_block').append(json_obj['users']);
	// $('#notification_selected_users').multiselect({ 
	// nonSelectedText :'Select Users',
	// includeSelectAllOption: true
// });
return false;
		
	});
});
	
	/*-----------------LOAD SECTION WISE STUDENT------------------------------------*/
	$("body").on("change", "#class_section", function(event){	 
		var section_id = $("#class_section").val();
		var class_list = $("#class_list").val();
		
		var curr_data = {
			action: 'smgt_load_section_student',
			section_id : section_id,			
			class_list : class_list,			
			dataType: 'json'
		};	
		$.post(smgt.ajax, curr_data, function(response) {
			$('#demo').append(response);
		});
		
		
	});
	
	  // START select student class wise
	  $("body").on("change", "#class_list", function(event){	
	 
		$('#student_list').html('');		
		var selection = $(this).val();				
		var optionval = $(this);
		var curr_data = {
			action: 'smgt_load_user',
			class_list: selection,
			dataType:'json'
		};
			
		$.post(smgt.ajax, curr_data, function(response) {			
			$('#student_list').append(response);	
		});					
					
	});
	// START select student class wise
	  $("#class_section").change(function(){
		$('#student_list').html('');
		//alert(curr_data);
		 var selection = $(this).val();
		// alert(selection);
		var optionval = $(this);
			var curr_data = {
				action: 'smgt_load_section_user',
				section_id: selection,			
				dataType: 'json'
			};
					
			$.post(smgt.ajax, curr_data, function(response) {
			//alert(response);
				$('#student_list').append(response);	
			});
						
					
	});
	// START select student class wise
	 $("body").on("change", "#class_list", function(){	
		//alert('hello');
		$('#class_section').html('');
		$('#class_section').append('<option value="remove">Loading..</option>');
		//alert(curr_data);
		 var selection = $("#class_list").val();
		 var optionval = $(this);
		var curr_data = {
			action: 'smgt_load_class_section',
			class_id: selection,			
			dataType: 'json'
		};
		$.post(smgt.ajax, curr_data, function(response) {
			$("#class_section option[value='remove']").remove();
			$('#class_section').append(response);	
		});					
					
	});
	 // START select book category wise
	
	$("#bookcat_list").change(function(){				
		$('#book_list1').html('');
		var selection = $("#bookcat_list").val();		
		var optionval = $(this);
			var curr_data = {
				action: 'smgt_load_books',
				bookcat_id: $("#bookcat_list").val(),			
				dataType: 'json'
			};
					
			$.post(smgt.ajax, curr_data, function(response) {
				// $('#book_list').multiselect();
				$('#book_list1').append(response);	
				jQuery('#book_list1').multiselect('rebuild');
			});					
	});
	
	
	 $("body").on("change", ".load_fees", function(){	
	
		$('#fees_data').html('');
		//alert(curr_data);
		 var selection = $("#class_list").val();
		
		var optionval = $(this);
			var curr_data = {
					action: 'smgt_load_class_fee_type',
					class_list: selection,			
					dataType: 'json'
					};
					
					
					$.post(smgt.ajax, curr_data, function(response) {
						//alert(response);
						
					
					$('#fees_data').append(response);	
					});
						
					
	});
	/*---------------FEE TYPE LOAD SECTION WISE--------------------------*/
	/*$("body").on("change", "#class_section", function(event){	
	
		$('#fees_data').html('');	
		//alert(curr_data);
		 var selection = $("#class_section").val();
		
		var optionval = $(this);
			var curr_data = {
					action: 'smgt_load_section_fee_type',
					section_id: selection,			
					dataType: 'json'
					};
					//alert(curr_data);
					$.post(smgt.ajax, curr_data, function(response) {
						
						$('#fees_data').append(response);
					});
	});*/
	$("#fees_data").change(function(){
		
		 var selection = $("#fees_data").val();
		
		var optionval = $(this);
			var curr_data = {
					action: 'smgt_load_fee_type_amount',
					fees_id: $("#fees_data").val(),			
					dataType: 'json'
					};
					
					
					$.post(smgt.ajax, curr_data, function(response) {
						//alert(response);
						$("#fees_amount").val(response);
					
					
					});
						
					
	});
	  //END USER LOAD FUNCTION
// select all checkboxes by select one .............	  
	  $('#selectall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
	  
	  
	  // START POPUP FOR SEE STUDENT PARENT
	  $("body").on("click", ".show-parent", function(event){	
    	
			var student_id = $(this).attr('idtest') ;
			
			//alert('hello');
		event.preventDefault(); // disable normal link function so that it doesn't refresh the page
		var docHeight = $(document).height(); //grab the height of the page
		var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
		//var id = $(this).data('idtest') ;
		//$('.popup-bg').show().css({'height' : docHeight}); //display your popup and set height to the page height
		//$('.overlay-content'+id).css({'top': scrollTop+20+'px'}); //set the content 20px from the window top
		
		var curr_data = {
					action: 'smgt_view_parent',
					student_id: student_id,			
					dataType: 'json'
					};
					
					$.post(smgt.ajax, curr_data, function(response) {
						
						$('.popup-bg').show().css({'height' : docHeight});
						
						$('.view-parent').html(response);	
						
					
					
					});	
		});
		
		// hide popup when user clicks on close button
		$('.close-btn').click(function(){
		//var id1 = $(this).data('idtest') ;
		$( ".view-parent" ).empty();
		$('.popup-bg').hide(); // hide the overlay
		});
		
		// hides the popup if user clicks anywhere outside the container
	// END POPUP
	
	
	
	 // START POPUP FOR EDIT OPTION OF PERIOD
    	/*$('.period_box').click(function(event){
			var period_id = $(this).attr('id') ;
			
			
		event.preventDefault(); // disable normal link function so that it doesn't refresh the page
		var docHeight = $(document).height(); //grab the height of the page
		var scrollTop = $(window).scrollTop(); //grab the px value from the top of the page to where you're scrolling
		
		
		
					
					
						
						$('.popup-bg').show().css({'height' : docHeight});
						
						$('.edit_perent').html(period_id);	
						
					
					
				
		}); */
		
		// hide popup when user clicks on close button
		$('.close-btn').click(function(){
		//var id1 = $(this).data('idtest') ;
		$( ".edit_perent" ).empty();
		$('.popup-bg').hide(); // hide the overlay
		});
		
		//SMS Message
		 $("input[name=select_serveice]:radio").change(function(){
			
			 var curr_data = {
						action: 'smgt_sms_service_setting',
						select_serveice: $(this).val(),			
						dataType: 'json'
						};					
						
						$.post(smgt.ajax, curr_data, function(response) {	
							
							
						$('#sms_setting_block').html(response);
						});
		 });
		
		 $("#chk_sms_sent").change(function(){
			
			 if($(this).is(":checked"))
			{
				 //alert("chekked");
				 $('#hmsg_message_sent').addClass('hms_message_block');
				 
			}
			 else
			{
				 $('#hmsg_message_sent').addClass('hmsg_message_none');
				 $('#hmsg_message_sent').removeClass('hms_message_block');
			}
		 });
		  $("body").on("click", ".close-btn-cat", function(){		
				
				$( ".category_list" ).empty();
				
				$('.popup-bg').hide(); // hide the overlay
				}); 
		 $("body").on("click", ".show-invoice-popup", function(event){
				

			  event.preventDefault(); // disable normal link function so that it doesn't refresh the page
			  var docHeight = $(document).height(); //grab the height of the page
			  var scrollTop = $(window).scrollTop();
			  var idtest  = $(this).attr('idtest');
			  var invoice_type  = $(this).attr('invoice_type');
			  
				//alert(idtest);
				//return false;
			   var curr_data = {
			 					action: 'smgt_student_invoice_view',
			 					idtest: idtest,
			 					invoice_type: invoice_type,
			 					dataType: 'json'
			 					};	 	
									//alert('hello');					
			 					$.post(smgt.ajax, curr_data, function(response) { 	
			 						//alert(response);	 
			 					$('.popup-bg').show().css({'height' : docHeight});							
								$('.invoice_data').html(response);	
								return true; 					
			 					});	
			
		  });
		 $("body").on("click", ".show-payment-popup", function(event){
				

			  event.preventDefault(); // disable normal link function so that it doesn't refresh the page
			  var docHeight = $(document).height(); //grab the height of the page
			  var scrollTop = $(window).scrollTop();
			  var idtest  = $(this).attr('idtest');
			  var view_type  = $(this).attr('view_type');
			  var due_amount  = $(this).attr('due_amount');
			  
				
			   var curr_data = {
			 					action: 'smgt_student_add_payment',
			 					idtest: idtest,
			 					view_type: view_type,
			 					due_amount: due_amount,
			 					dataType: 'json'
			 					};	 	
									//alert('hello');					
			 					$.post(smgt.ajax, curr_data, function(response) { 	
			 						//alert(response);	 
			 					$('.popup-bg').show().css({'height' : docHeight});							
								$('.invoice_data').html(response);	
								return true; 					
			 					});	
			
		  });
		  $("body").on("click", ".show-view-payment-popup", function(event){
				

			  event.preventDefault(); // disable normal link function so that it doesn't refresh the page
			  var docHeight = $(document).height(); //grab the height of the page
			  var scrollTop = $(window).scrollTop();
			  var idtest  = $(this).attr('idtest');
			  var view_type  = $(this).attr('view_type');			  
				//alert(idtest);
			   var curr_data = {
			 					action: 'smgt_student_view_paymenthistory',
			 					idtest: idtest,
			 					view_type1: view_type,
			 					dataType: 'json'
			 					};	 	
													
			 					$.post(smgt.ajax, curr_data, function(response) { 	
			 						//alert(response);	 
									
			 					$('.popup-bg').show().css({'height' : docHeight});							
								$('.invoice_data').html(response);	
								return true; 					
			 					});	
			
		  });

$("body").on("click", "#addremove", function(event){	
	
	event.preventDefault(); // disable normal link function so that it doesn't refresh the page
	var docHeight 	= 	$(document).height(); //grab the height of the page
	var scrollTop 	= 	$(window).scrollTop();
	var class_id	=	0;
	var model  	= 	$(this).attr('model') ;
	if(model=='class_sec')
	{
		class_id 	 = 	$(this).attr('class_id') ;
	}
	
	var curr_data 	= {
		action: 'smgt_add_remove_feetype',
		model : model,
		class_id : class_id,
		dataType: 'json'
	};	 				
	$.post(smgt.ajax, curr_data, function(response) { 						
		$('.popup-bg').show().css({'height' : docHeight});
		$('.modal-content').html(response);	
		return true; 					
	});	
});

  
$("body").on("click", "#btn-add-cat", function(){		
		var fee_type  = $('#txtfee_type').val() ;
		var model  = $(this).attr('model');	
		var class_id=0;
		if(model=='class_sec')
		{
			 class_id  = $(this).attr('class_id') ;
		}
		
		var valid = jQuery('#fee_form').validationEngine('validate');
		
		if (valid == true) 
		{
		/* if(fee_type != "")
		{ */
			var curr_data = {
				action: 'smgt_add_fee_type',
				model : model,
				class_id : class_id,
				fee_type: fee_type,			
				dataType: 'json'
			};
					
			$.post(smgt.ajax, curr_data, function(response) {
				var json_obj = $.parseJSON(response);//parse JSON						
				$('.table').append(json_obj[0]);
				$('#txtfee_type').val("");	
				if(model == 'rack_type')
				{
					$("#rack_category_data").append(json_obj[1]);
				}
				else								
					$("#category_data").append(json_obj[1]);				
					return false;					
			});	
		
		}
		/* else
		{
			alert("Please enter Category Name.");
		} */
	});
	 $("body").on("click", ".btn-delete-cat", function(){		
		var cat_id  = $(this).attr('id') ;	
		 var model  = $(this).attr('model') ;
		
		if(confirm("Are you sure want to delete this record?"))
		{
			var curr_data = {
					action: 'smgt_remove_feetype',
					model : model,
					cat_id:cat_id,			
					dataType: 'json'
					};
					
					$.post(smgt.ajax, curr_data, function(response) {						
						$('#cat-'+cat_id).hide();
						
						if(model == 'rack_type')
						{
							$("#rack_category_data").find('option[value='+cat_id+']').remove();
						}
						else
							$("#category_data").find('option[value='+cat_id+']').remove();
						return true;				
					});			
		}
	});
$("body").on("click", ".btn-edit-cat", function(){		
		var cat_id  = $(this).attr('id') ;	
		var model  = $(this).attr('model') ;
			
			var curr_data = {
					action: 'smgt_edit_section',
					model : model,
					cat_id:cat_id,			
					dataType: 'json'
					};
					
					$.post(smgt.ajax, curr_data, function(response) {					
						$(".table tr#cat-"+cat_id).html(response);
						return true;				
					});			
		
});
$("body").on("click", ".btn-cat-update", function(){		
		var cat_id  = $(this).attr('id') ;	
		var model  = $(this).attr('model') ;
		var section_name = $("#section_name").val();
		if(confirm("Are you sure want to edit this record?"))
		{
	var curr_data = {
					action: 'smgt_update_section',
					model : model,
					cat_id:cat_id,			
					section_name:section_name,			
					dataType: 'json'
					};
					
					$.post(smgt.ajax, curr_data, function(response) {						
						
						$(".table tr#cat-"+cat_id).html(response);
						return true;				
	});			
		}
});

$("body").on("click", ".btn-cat-update-cancel", function(){		
		var cat_id  = $(this).attr('id') ;	
		var model  = $(this).attr('model') ;
		var section_name = $("#section_name").val();
	var curr_data = {
					action: 'smgt_update_cancel_section',
					model : model,
					cat_id:cat_id,			
					section_name:section_name,			
					dataType: 'json'
					};
					
					$.post(smgt.ajax, curr_data, function(response) {						
						
						$(".table tr#cat-"+cat_id).html(response);
						return true;				
	});			
		
});
	$("body").on("click", "#view_member_bookissue_popup", function(event){
				

			  event.preventDefault(); // disable normal link function so that it doesn't refresh the page
			  var docHeight = $(document).height(); //grab the height of the page
			  var scrollTop = $(window).scrollTop();
			  var idtest  = $(this).attr('idtest');
			   
				//alert(idtest);
			   var curr_data = {
			 					action: 'smgt_student_view_librarryhistory',
			 					student_id: idtest,
			 					dataType: 'json'
			 					};	 	
													
			 					$.post(smgt.ajax, curr_data, function(response) { 	
			 						//alert(response);	 
									
			 					$('.popup-bg').show().css({'height' : docHeight});							
								$('.invoice_data').html(response);	
								return true; 					
			 					});	
			
		  });
		  
    //---------Book return popup----------
	
		$("body").on("click", "#accept_returns_book_popup", function(event){
			event.preventDefault(); // disable normal link function so that it doesn't refresh the page
			var docHeight = $(document).height(); //grab the height of the page
			var scrollTop = $(window).scrollTop();
			var idtest  = $(this).attr('idtest');			   
				//alert(idtest);
				var curr_data = {
			 		action: 'smgt_accept_return_book',
			 		student_id: idtest,
			 		dataType: 'json'
			 	};	 	
													
				$.post(smgt.ajax, curr_data, function(response) { 	
					$('.popup-bg').show().css({'height' : docHeight});							
					$('.invoice_data').html(response);	
					return true; 					
			 	});	
			
		  });
	
	
    //---------END Book return popup----------
		  
		  
		  
		  
		  // get auto book return date
	$(".issue_period,#issue_date").change(function(){
		var selection = $(".issue_period").val();
		if(selection=='')
		{
			return false;
		}
		var optionval = $(this);
		var curr_data = {
			action: 'smgt_get_book_return_date',
			issue_period: $(".issue_period").val(),			
			issue_date: $("#issue_date").val()			
		};
		$.post(smgt.ajax, curr_data, function(response) {
			$('#return_date').val(response);
		});
		
	});
		  
	$("#subject_teacher").change(function(){
		 
		$('#subject_class').html('');
		//alert(curr_data);
		 var teacher_id = $("#subject_teacher").val();
		// alert(selection);
		var optionval = $(this);
			var curr_data = {
					action: 'smgt_class_by_teacher',
					teacher_id: teacher_id,			
					dataType: 'json'
					};
					
					
					$.post(smgt.ajax, curr_data, function(response) {
						
						
					
					$('#subject_class').append(response);	
					});					
	});
	
	$("#teacher_by_class").change(function(){
		 
		$('#class_teacher').html('');
		//alert(curr_data);
		 var class_id = $("#teacher_by_class").val();
		// alert(selection);
		var optionval = $(this);
			var curr_data = {
					action: 'smgt_teacher_by_class',
					class_id: class_id,			
					dataType: 'json'
					};
					
					
					$.post(smgt.ajax, curr_data, function(response) {
						$('#class_teacher').append(response);	
					});					
	});
	



// Get All class wise student
	
 $("#class_list").change(function(){
	$('#subject_list').html('');		
	var selection = $("#class_list").val();	
	var optionval = $(this);
	var curr_data = {
		action: 'smgt_load_class_student',
		class_list: $("#class_list").val(),			
		dataType: 'json'
	};
	
	$.post(smgt.ajax, curr_data, function(response) {
		$('#class_student_list').append(response);
	});
});
	
/* Message Module*/
$("#message_form #class_list_id,#message_form #send_to,#message_form #class_section_id").change(function(){
	var current_action = $(this).attr('id');	
	var send_to = $("#send_to").val();		
	var class_list = $("#class_list_id").val();	
	var class_section = $("#class_section_id").val();	
	
	if(current_action == 'send_to'){	
		class_section = '';		
		$("#class_section_id").html('');	
	}
	
	if(current_action == 'class_list_id')
	{
		
		class_section = '';
		$("#class_section_id").html('');	
	}
	
	var curr_data = {
		action: 'smgt_sender_user_list',
		send_to: send_to,			
		class_list: class_list,			
		class_section: class_section,			
		dataType: 'json'
	};
	
	if(send_to == 'supportstaff')
	{
		$(".class_section_id").hide();
		$('.class_list_id').hide();
	}
	
	if(send_to == 'teacher')
	{
		$(".class_list_id").show();
		$('.class_section_id').hide();
	}
	if(send_to == 'student' || send_to == 'parent')
	{
		$(".class_list_id").show();
		$('.class_section_id').show();
	}
$.post(smgt.ajax, curr_data, function(response) {

 var json_obj = $.parseJSON(response);//parse JSON			 
 if((send_to == 'student' || send_to == 'parent') && (current_action == 'send_to' || current_action == 'class_list_id'))
{
	$('#class_section_id').html('');
	$('#class_section_id').append(json_obj['section']);
}			
	$('.user_display_block').html('');
	$('.user_display_block').append(json_obj['users']);
	jQuery('#selected_users').multiselect({ 
	nonSelectedText :'Select Users',
	includeSelectAllOption: true
});
return false;
		
	});
});
$("body").on("click","#profile_change",function() {
			
			//event.preventDefault(); // disable normal link function so that it doesn't refresh the page
			 var docHeight = $(document).height(); //grab the height of the page
			var scrollTop = $(window).scrollTop();
		   //alert(evnet_id);
			 var curr_data = {
						action: 'smgt_change_profile_photo',
						dataType: 'json'
						};					
						
						$.post(smgt.ajax, curr_data, function(response) {	
						$('.popup-bg').show().css({'height' : docHeight});
							$('.profile_picture').html(response);	
						});
		});



/* ===================  Frant Message Module  =====================  */
/*
$("#message_form #class_list_id,#message_form #send_to,#message_form #class_section_id").change(function(){
	var current_action = $(this).attr('id');	
	var send_to = $("#send_to").val();	
	var class_list = $("#class_list_id").val();	
	var class_section = $("#class_section_id").val();	

	if(current_action == 'send_to')
	{
		
		class_section = '';
		
		$("#class_section_id").html('');	
	}
	if(current_action == 'class_list_id')
	{
		
		class_section = '';
		$("#class_section_id").html('');	
	}
	var curr_data = {
		action: 'smgt_sender_user_list',
		send_to: send_to,			
		class_list: class_list,			
		class_section: class_section,			
		dataType: 'json'
	};
	if(send_to == 'supportstaff')
	{
		$(".class_section_id").hide();
		$('.class_list_id').hide();
	}
	if(send_to == 'teacher')
	{
		$(".class_list_id").show();
		$('.class_section_id').hide();
	}
	if(send_to == 'student' || send_to == 'parent')
	{
		$(".class_list_id").show();
		$('.class_section_id').show();
	}
	$.post(smgt.ajax, curr_data, function(response) {
		
		//$('#class_student_list').html('');
		//$('#class_student_list').append(response);
	//	return false;
			 var json_obj = $.parseJSON(response);//parse JSON	
			// alert(json_obj);
			
			 if((send_to == 'student' || send_to == 'parent') && (current_action == 'send_to' || current_action == 'class_list_id'))
	{
	$('#class_section_id').html('');
						$('#class_section_id').append(json_obj['section']);
	}
				
						$('.user_display_block').html('');
						$('.user_display_block').append(json_obj['users']);
									 $('#selected_users').multiselect({ 
									 nonSelectedText :'Select Users',
									 includeSelectAllOption: true});
			return false;
		
	});
});
	*/
	$(".class_in_student").change(function()
	{
		
		var class_id = $(".class_in_student").val();
		
			 var curr_data = {
						action: 'smgt_count_student_in_class',
						class_id: class_id,
						dataType: 'json'
						};					
						$.post(smgt.ajax, curr_data, function(response) 
						{
						var json_obj = $.parseJSON(response);//parse JSON	
						if(json_obj[0] == 'class_full')
						{
							alert('Class Limit Is Full.');
							window.location.reload(true);
						}
						return false;
						});
	});
	
});
  

