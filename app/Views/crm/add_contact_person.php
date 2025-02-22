<style>
.extra_contact_add td{

    padding: 0px;
    text-align: center;
}
</style>

<!--second contact detail modal section start-->
                         
<div class="modal fade" id="ContactDeatils2" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="add_cus_form4">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
				<div class="modal-body">
                    <div class="card-seprate_divider"></div>
                        <div class="live-preview content_table" style="padding-top:0px">
                            <table  class="table table-bordered table-striped delTable extra_contact_add">
                                <thead class="travelerinfo">
                                    <tr>
                                       
                                        <td>Contact Person </td>
                                        <td>Designation</td>
                                        <td>Mobile</td>
                                        <td>Email</td>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                      
                                        <td><input type="text" name="contact_person" class="form-control " required></td>
                                        <td><input type="text" name="contact_designation" class="form-control " required></td>
                                        <td><input type="text" name="contact_mobile"  class="form-control contact_mobile_clz" required></td>
                                        <td> <input type="email" name="contact_email" class="form-control " required></td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" class="customer_creation_id2" name="contact_customer_creation">
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

    /*add second contact detail section start( with no add more)*/
    $(function() {
            var form = $('#add_cus_form4');
            
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
                        url: "<?php echo base_url(); ?>Crm/Enquiry/AddContactDetails",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);
                            
                            $("#contact_person_id").html(responseData.contact_person);
                            
                            $('#ContactDeatils2').modal('hide');
                            
                            $('#add_cus_form4')[0].reset();

                        }
                    });
                }
            });
        });

        /*###*/


        
});


</script>