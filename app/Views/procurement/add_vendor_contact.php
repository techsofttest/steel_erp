<!--contact detail modal section start-->
                         
    <div class="modal fade" id="AddNewContact" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-xl">
		    <form  class="Dashboard-form class" id="new_form_cont">
			    <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Contact Details</h5>
                        <button type="button" class="btn-close  vendor_con_close"  aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="card-seprate_divider"></div>

                            <div class="live-preview">
                                <table  class="table table-bordered table-striped delTable">
                                    <tbody class="travelerinfo">
                                        <tr>
                                            <td >No</td>
                                            <td>Contact Person</td>
                                            <td>Designation</td>
                                            <td>Mobile</td>
                                            <td>Email</td>
                                            <td>Action</td>
                                        </tr>
                                        <tr class="contact_more_row">
                                            <td class="cont_si_no">1</td>
                                            <td><input type="text" name="pro_con_person[0]" class="form-control" required></td>
                                            <td><input type="text" name="pro_con_designation[0]" class="form-control" required></td>
                                            <td><input type="text" name="pro_con_mobile[0]"  class="form-control contact_mobile_clz" required></td>
                                            <td> <input type="email" name="pro_con_email[0]" class="form-control" required></td>
                                            <td><div class="tecs"><span  class="add_contact_data" class="add_icon"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                        </tr>
                                    </tbody>

                                    <tbody class="contact-more_data" class="travelerinfo"></tbody>
                                        
                                </table>
                                                
                                <input type="hidden" class="new_pro_con_vendor" name="new_vendor_hidden_id">
                                
                                <div class="modal-footer justify-content-center">
                                    
                                    <button class="btn btn btn-success">Save</button>
                                </div>
                            </div>   
                                                                    
                        </div>
                                        
			        </div>

		        </form>

	        </div>

        </div>
<!--contact detail modal section end-->

<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
        
        /*add more contact details*/

		var contact_max_fieldss      = 30;
		var co = 1;
		var i =0;
	   
		$("body").on('click', '.add_contact_data', function(){
		   
			if(co < contact_max_fieldss){ //max input box allowed
				co++;
				i++;
				$(".contact-more_data").append("<tr class='contact_more_row add_prod'><td class='cont_si_no'>"+co+"</td><td><input type='text' name='pro_con_person["+i+"]' class='form-control ' required></td><td><input type='text' name='pro_con_designation["+i+"]' class='form-control ' required></td><td><input type='text' name='pro_con_mobile["+i+"]' class='form-control contact_mobile_clz' required></td><td><input type='email' name='pro_con_email["+i+"]' class='form-control ' required></td><td class='remove-contact-btn' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>");
				contactSlno();
			}
		});


		$(document).on("click", ".remove-contact-btn", function() {
	 
			$(this).parent().remove();
            reName();
			//y--;
			contactSlno();
		});

		/*####*/



        /*rename section start*/

        function reName(){

            alert("sucess");
            
            var jj = 0;

            $('body .contact_more_row').each(function() {
                
                $(this).closest('.contact_more_row').find('.add_prod').attr('name', 'pro_con_person['+jj+']');

                $(this).closest('.contact_more_row').find('.add_prod').attr('name', 'pro_con_designation['+jj+']');

                $(this).closest('.contact_more_row').find('.add_prod').attr('name', 'pro_con_mobile[1]['+jj+']');

                $(this).closest('.contact_more_row').find('.add_prod').attr('name', 'pro_con_email[1]['+jj+']');
  
                jj++;
  
            });
        }

        /*rename section end*/


        /*serial no correction section start*/
		  
		function contactSlno(){
			
			var pp =1;
			
			$('body .contact_more_row').each(function() {

				$(this).find('.cont_si_no').html('<td class="cont_si_no">' + pp + '</td>');

				pp++;

			});
		}


		/*#####*/


        /*add second contact detail section start( with no add more)*/
        $(function() {
            var form = $('#new_form_cont');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseOrder/AddContactDetails",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            
                            $('#AddNewContact').modal('hide');
                            
                            $('#new_form_cont')[0].reset();

                        }
                    });
                }
            });
        });

        /*###*/
        
    });

</script>