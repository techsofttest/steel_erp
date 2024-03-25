<!--Customer Creation modal content start-->
<div class="modal fade" id="AddCustomerCreation" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="add_cust_creation">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    <button type="button" class="btn-close cust_close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
				<div class="modal-body">

                    <div class="sub_heading">
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn customer_detail_modal">Customer Details</a>
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn contact_detail_modal">Contact Details</a>
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn offical_document_modal">Official Documents</a>
                    </div>   
                        
                                            
                    <div class="card-seprate_divider"></div>

                    <div class="live-preview">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Customer Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="cc_customer_name" class="form-control" required>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Account Head</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select account_head_select account_head_clz" name="cc_account_head"  required></select>
                                                
                                            </div>

                                        </div> 
                                        
                                    </div>

                                    <!-- ### --> 


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Account ID</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="cc_account_id" class="form-control account_id" readonly required>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Post Box</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="number" name="cc_post_box" class="form-control" required>
                                            </div>

                                        </div>
                                         
                                    </div>

                                    <!-- ### -->  


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Telephone</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="cc_telephone" id="cc_telephone"  class="form-control"  required>
                                            </div>

                                        </div> 
                                    </div>

                                    <!-- ### --> 


                                        <!--Single Row Start-->
                                        <div class="col-lg-12">
                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Fax</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="cc_fax" id="cc_fax" class="form-control" required>
                                            </div>

                                        </div>
                                    </div> 

                                    <!-- ### -->  


                                    <!--Single Row Start-->
                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Email</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="email" name="cc_email" class="form-control" required>
                                            </div>

                                        </div> 
                                    </div>

                                    <!-- ### --> 

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <!--Single Row Start-->
                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Credit Term</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="cc_credit_term" class="form-control" required>
                                            </div>

                                        </div> 
                                    </div>

                                    <!-- ### --> 



                                    <!--Single Row Start-->
                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Credit Period (Days)</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="number" name="cc_credit_period" class="form-control" required>
                                            </div>

                                        </div> 
                                    </div>

                                    <!-- ### --> 



                                    <!--Single Row Start-->
                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Credit Limit</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="number" name="cc_credit_limit" class="form-control" required>
                                            </div>

                                        </div>
                                    </div> 

                                    <!-- ### -->

                                    <div class="modal-footer justify-content-center">
                                        <button  class="btn btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>   
                        
				</div>
                                        
			</div>
		</form>

	</div>

</div>


 <!--Customer Creation content end-->


 <!--contact detail modal section start-->
                         
 <div class="modal fade" id="AddContactDeatils" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="add_cond_detail">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                    <button type="button" class="btn-close modal_close"  aria-label="Close"></button>
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
                                <tr class="prod_row">
                                    <td class=" si_no">1</td>
                                    <td><input type="text" name="contact_person[]" class="form-control " required></td>
                                    <td><input type="text" name="contact_designation[]" class="form-control " required></td>
                                    <td><input type="text" name="contact_mobile[]"  class="form-control contact_mobile_clz" required></td>
                                    <td> <input type="email" name="contact_email[]" class="form-control " required></td>
                                    <td><div class="tecs"><span  class="add_person" class="add_icon"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                </tr>
                            </tbody>
                            <tbody class="person-more" class="travelerinfo"></tbody>
                
                        </table>
                        
                        <input type="hidden" class="customer_creation_id" name="contact_customer_creation">
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


<!--official document modal section start-->

<div class="modal fade" id="AddOfficalDocument" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form  class="Dashboard-form class" id="add_office_doc">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Official Documents</h5>
                    <button type="button" class="btn-close modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    
                        
                    
                    <div class="card-seprate_divider"></div>

                    <div class="live-preview">
                        
                        <div class="row">

                            <!--Single Row Start-->
                            <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basiInput" class="form-label">CR No</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" name="cc_cr_number" class="form-control">
                                    </div>
                                </div>
                                
                                
                            </div>
                            <!--####-->

                            <!--Single Row Start-->
                            
                            <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">	CR Attach</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="file" name="cc_attach_cr" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            

                            <!--####-->


                            <!--Single Row Start-->
                            
                                <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">	CR Expiry</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="cc_cr_expiry" placeholder="dd-mm-yy" class="form-control datepicker">
                                    </div>
                                </div>
                                
                            </div>
                            

                            <!--####-->


                            <!--Single Row Start-->
                            
                            <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">Est.ID</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" name="cc_est_id" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            

                            <!--####-->


                            <!--Single Row Start-->
                            
                            <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">Est.ID Attach</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="file" name="cc_est_id_attach" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            

                            <!--####-->


                            <!--Single Row Start-->
                            
                            <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">Est.ID Expery</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="cc_est_id_expery" placeholder="dd-mm-yy" class="form-control datepicker">
                                    </div>
                                </div>
                                
                            </div>
                            

                            <!--####-->


                            <!--Single Row Start-->
                            
                            <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">Signatory Name</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="cc_signatory_name" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            

                            <!--####-->


                            <!--Single Row Start-->
                            
                                <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">QID Number</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" name="cc_qid_number" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            

                            <!--####-->


                            <!--Single Row Start-->
                            
                                <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">QID Attach</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="file" name="cc_qid_attach" class="form-control">
                                    </div>
                                </div>
                                
                            </div>
                            

                            <!--####-->



                            <!--Single Row Start-->
                            
                            <div class="col-lg-12">
                                <div class="row align-items-center mb-2">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">QID Expiry</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" name="cc_qid_expiry" placeholder="dd-mm-yy" class="form-control datepicker">
                                    </div>
                                </div>
                                
                            </div>
                            

                            <!--####-->

                            <input type="hidden" class="customer_creation_id" name="cc_id">

                            <div class="modal-footer justify-content-center">
                                <button class="btn btn btn-success">Save</button>
                            </div>


                        </div>
                            
                    </div>   
                        
                        

                    
                </div>
                
            </div>

        </form>

    </div>
</div>

<!--offical document modal section end-->



 <script>
     
    document.addEventListener("DOMContentLoaded", function(event) { 

        /*add customer section start*/


        /*add customer creation*/    
        $(function() {
            var form = $('#add_cust_creation');
            
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);
                            
                            $(".customer_creation_id").val(responseData.customer_creation_id);
                            
                            $('#AddCustomerCreation').modal('hide');

                            $('#AddContactDeatils').modal('show');

                        }
                    });
                }
            });
        });
        /*####*/


        /*add contact details*/
        $(function() {
            var form = $('#add_cond_detail');
           
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
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/AddTab2",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                           
                           $('#AddContactDeatils').modal('hide');

                           $('#AddOfficalDocument').modal('show');
                            
                           
                        }
                    });
                }
            });
        });
        /**/


        /*add oficial documents*/
        $(function() {
            var form = $('#add_office_doc');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {
                    // Create FormData object to handle file uploads
                    var formData = new FormData(currentForm);

                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/CustomerCreation/AddTab3",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                            $('#add_cust_creation')[0].reset();
                            $('#add_cond_detail')[0].reset();
                            $('#add_office_doc')[0].reset();
                            $('#AddOfficalDocument').modal('hide');
                            $('.account_head_clz').val('').trigger('change');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload(null, false);
                        }
                    });
                }
            });
        });
        /**/





        /* Select 2 Remove Validation On Change */
        $("select[name=cc_account_id]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });

        $("select[name=cc_account_type]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });




        /*create account id by account head*/ 
         
        $('.account_head_clz').on('change', function() {
          

            var id = $(this).val();
 
             $.ajax({
 
                 url : "<?php echo base_url(); ?>Crm/CustomerCreation/Code",
 
                 method : "POST",
 
                 data: {ID: id},
 
                 success:function(data)
                 {   
                     var data = JSON.parse(data);
                    
                    $(".account_id").val(data.account_id);
                    
                     
                 }
 
 
             });
           
             
        });

        /*####*/


        /*close contact details modal*/ 
         
        $('.modal_close').on('click', function() {
          

            $('#AddCustomerCreation').modal('show');

            $('#AddContactDeatils').modal('hide');

            $('#AddOfficalDocument').modal('hide');
           
        });

        /*####*/


        /*show contact detail modal*/ 
         
        $('.contact_detail_modal').on('click', function() {
          
           $('#AddCustomerCreation').modal('hide');

           $('#AddContactDeatils').modal('show');
           
           
        });

        /*####*/


        /*show official documnet modal*/ 
         
        $('.offical_document_modal').on('click', function() {
          
          $('#AddContactDeatils').modal('hide');

          $('#AddCustomerCreation').modal('hide');

          $('#AddOfficalDocument').modal('show');
          
          
       });

       /*####*/


        /*add more contact details*/

        var max_fieldss      = 30;
        var y = 1;

       
        $("body").on('click', '.add_person', function(){
           
			if(y < max_fieldss){ //max input box allowed
				y++;
	            $(".person-more").append("<tr class='prod_row'><td class='si_no'>"+y+"</td><td><input type='text' name='contact_person[]' class='form-control ' required></td><td><input type='text' name='contact_designation[]' class='form-control ' required></td><td><input type='text' name='contact_mobile[]' class='form-control contact_mobile_clz' required></td><td><input type='email' name='contact_email[]' class='form-control ' required></td><td class='remove-btnnp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>");
                slno();
			}
	    });


        $(document).on("click", ".remove-btnnp", function() {
	 
	        $(this).parent().remove();
	        //y--;
            slno();
        });

        /*####*/



        /*serial no correction section start*/
          
        function slno(){
            
            var pp =1;
            
            $('body .prod_row').each(function() {

                $(this).find('.si_no').html('<td class="si_no">' + pp + '</td>');

                pp++;

            });
        }


        /*#####*/



       
        /*data table start*/ 

        /*function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Crm/CustomerCreation/FetchData",
                'data': function (data) {
                  
                    var csrfName = $('.txt_csrfname').attr('name'); 
                    var csrfHash = $('.txt_csrfname').val(); 
                    return {
                        data: data,
                        [csrfName]: csrfHash, 
                    };
                },
                dataSrc: function (data) {
                   
                    $('.txt_csrfname').val(data.token);
                    
                    return data.aaData;
                }
            },
            'columns': [
                { data: 'cc_id' },
                { data: 'cc_customer_name' },
                { data: 'cc_post_box'},
                { data: 'cc_telephone'},
                { data: 'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });*/

        /*###*/



        /* account head  search droup drown start*/
        
        $(".account_head_select").select2({
            placeholder: "Select Account Name",
            theme : "default form-control-",
            dropdownParent: $('#AddCustomerCreation'),
            ajax: {
                url: "<?= base_url(); ?>Crm/CustomerCreation/FetchTypes",
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function (params) {
                    return {
                        term: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function(data, params) {
                   
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.ah_id, text: item.ah_account_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })

        /*###*/


        $('#cc_telephone').on('input', function() {
           
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
        });


        $('#cc_fax').on('input', function() {
            
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
        });


      

        $("body").on('keyup', '.contact_mobile_clz', function(){
           
            $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
            
       });



       
        /*add customer section end*/ 

    });
     
 </script>