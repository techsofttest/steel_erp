<!--add vendor start-->
<div class="modal fade" id="EditVendor" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form  class="Dashboard-form class" id="edit_vendor_form">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Vendor</h5>
                    <button type="button" class="btn-close cust_close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
				<div class="modal-body">

                    <div class="sub_heading">
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn customer_detail_modal border_top">Vendor</a>
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn edit_contact_detail_modal">Contact</a>
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn edit_offical_document_modal">Documents</a>
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
                                                <label for="basiInput" class="form-label">Vendor Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ven_name" class="form-control edit_vendor_name" required>
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
                                                <!--<select class="form-select account_head_select account_head_clz edit_account_head"  name="ven_account_head"  required></select>-->

                                                <input type="text" name="ven_account_head" class="form-control edit_account_head" readonly>
                                                
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
                                                <input type="text" name="ven_account_id" class="form-control edit_account_id" readonly required>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Post Box No</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ven_post_box" class="form-control edit_post_box" required>
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
                                                <input type="text" name="ven_telephone" id="edit_telephone_id"  class="form-control edit_telephone"  required>
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
                                                <input type="text" name="ven_fax" id="edit_fax_id" class="form-control edit_fax" required>
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
                                                <input type="email" name="ven_email" class="form-control edit_email" required>
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
                                                    <input type="text" name="ven_credit_term" class="form-control edit_credit_term" required>
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
                                                    <input type="number" name="ven_credit_period" class="form-control edit_credit_period" required>
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
                                                    <input type="number" name="ven_credit_limit" class="form-control edit_credit_limit" required>
                                                </div>

                                            </div>
                                        </div> 

                                        <!-- ### -->

                                        <input type="hidden" name="ven_id" class="edit_vendor_id">

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

    <!--add vendor end-->

    <!--contact detail modal section start-->
                         
    <div class="modal fade" id="EditContact" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-xl">
		    <form  class="Dashboard-form class" id="">
			    <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Contact Details</h5>
                        <button type="button" class="btn-close edit_modal_close"  aria-label="Close"></button>
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
                                        
                                    </tbody>

                                    <tbody class="person-more edit_contact" class="travelerinfo"></tbody>
                                    
                                    <tbody>
                                        <tr>
                                            <td colspan="8" align="center" class="tecs">
                                                <span class="add_icon edit_add_con"><i class="ri-add-circle-line"></i>Add </span>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                                                
                                <input type="hidden" class="vendor_hidden_id" name="pro_con_vendor">
                                <!--<div class="modal-footer justify-content-center">
                                    
                                    <button class="btn btn btn-success">Save</button>
                                </div>--->
                            </div>   
                                                                    
                        </div>
                                        
			        </div>

		        </form>

	        </div>

        </div>

        <!--contact detail modal section end-->


        <!--official document modal section start-->

        <div class="modal fade" id="EditOfficalDocument" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form  class="Dashboard-form class" id="edit_office_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Official Documents</h5>
                            <button type="button" class="btn-close edit_modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                    <input type="number" name="ven_cr_no" class="form-control edit_ven_cr_no">
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
                                                    <input type="text" name="ven_cr_expiry" placeholder="dd-mm-yy" class="form-control datepicker edit_ven_cr_expiry">
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
                                                    <input type="number" name="ven_est_id" class="form-control edit_ven_est_id">
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
                                                    <input type="text" name="ven_est_expiry" placeholder="dd-mm-yy" class="form-control datepicker edit_ven_est_expiry">
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
                                                    <input type="text" name="ven_signature_name" class="form-control edit_ven_signature_name">
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
                                                    <input type="number" name="ven_qid_no" class="form-control edit_ven_qid_no">
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
                                                    <input type="text" name="ven_qid_expiry" placeholder="dd-mm-yy" class="form-control datepicker edit_ven_qid_expiry">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        

                                        <!--####-->

                                        <!--image section start-->

                                        <div class="card-body">
                                            <table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;">
                                                <thead>
                                                                
                                                    <tr>
                                                        
                                                        <th class="cust_img_rgt_border cust_img_text_stl" style="width:50%">Name</th>
                                                        <th class="cust_img_rgt_border cust_img_text_stl" style="width:40%">View</th>
                                                        <th class="cust_img_text_stl">Edit</th>
                                                        
                                                    </tr>

                                                </thead>
                                                    
                                                <tbody>

                                                    <tr>
                                                        <td class="cust_img_rgt_border cust_img_text_stl" >CR Attach</td>
                                                        <td class="cust_img_rgt_border edit_cr_attach"></td>
                                                        <td class=""><input type="file" name="ven_cr_attach"></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="cust_img_rgt_border  cust_img_text_stl" >Est.ID Attach</td>
                                                        <td class="cust_img_rgt_border edit_est_id_attach"></td>
                                                        <td class=""><input type="file" name="ven_est_attach"></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="cust_img_rgt_border  cust_img_text_stl" >QID Attach</td>
                                                        <td class="cust_img_rgt_border edit_qid_attach"></td>
                                                        <td class=""><input type="file" name="ven_qid_attach"></td>
                                                    </tr>


                                                </tbody>

                                            </table>
                        
                                        </div>

                                        <!--image section end-->

                                        <input type="hidden" class="vendor_hidden_id" name="ven_id">

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


            <!--contact detail modal section start-->
                         
            <div class="modal fade" id="SingleEditVendor" aria-labelledby="exampleModalLabel" aria-hidden="true">
	            <div class="modal-dialog modal-xl">
		            <form  class="Dashboard-form class" id="edit_contact_form">
			            <div class="modal-content">
                    
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Contact Details</h5>
                                <button type="button" class="btn-close edit_modal_close"  aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="card-seprate_divider"></div>

                                <div class="live-preview">
                                    <table  class="table table-bordered table-striped delTable">
                                        <tbody class="travelerinfo">
                                            <tr>
                                                
                                                <td>Contact Person</td>
                                                <td>Designation</td>
                                                <td>Mobile</td>
                                                <td>Email</td>
                                                
                                            </tr>
                                            
                                        </tbody>

                                        <tbody class="person-more edit_single_contact_person" class="travelerinfo"></tbody>
                                            
                                    </table>
                                                
                                    <input type="hidden" class="vendor_hidden_id" name="pro_con_vendor">
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



            <!--Edit add contact start-->
                         
            <div class="modal fade" id="EditAddContact" aria-labelledby="exampleModalLabel" aria-hidden="true">
	            <div class="modal-dialog modal-xl">
		            <form  class="Dashboard-form class" id="edit_add_con_form">
			            <div class="modal-content">
                    
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create Contact Details</h5>
                                <button type="button" class="btn-close edit_modal_close"  aria-label="Close"></button>
                            </div>

                            <div class="modal-body">

                                <div class="card-seprate_divider"></div>

                                <div class="live-preview">
                                    <table  class="table table-bordered table-striped delTable">
                                        <tbody class="travelerinfo">
                                            <tr>
                                                
                                                <td>Contact Person</td>
                                                <td>Designation</td>
                                                <td>Mobile</td>
                                                <td>Email</td>
                                                
                                            </tr>
                                            
                                        </tbody>

                                        <tbody class="" class="travelerinfo">
                                            
                                            <tr>
           
                                                <td><input type="text" name="pro_con_person"  value="" class="form-control" required></td>
                                                <td><input type="text" name="pro_con_designation"  value="" class="form-control" required></td>
                                                <td><input type="text" name="pro_con_mobile"  value="" class="form-control pro_con_mobile_clz" required></td>
                                                <td> <input type="email" name="pro_con_email" value="" class="form-control" required></td>
                                                
                                            </tr>

                                        </tbody>
                                            
                                    </table>
                                                
                                    <input type="hidden" class="edit_contact_hidden_id" name="pro_con_vendor">
                                    <div class="modal-footer justify-content-center">
                                    
                                        <button class="btn btn btn-success">Save</button>

                                    </div>
                                </div>   
                                                                    
                            </div>
                                        
			            </div>

		            </form>

	            </div>

            </div>

            <!--Edit add contact end-->






<script>

document.addEventListener("DOMContentLoaded", function(event) { 

   
    /*add section start*/

    $(function() {
        $('#edit_vendor_form').validate({
            rules: {
                required: 'required',
                
            },
            messages: {
                required: 'This field is required',
                
            },
            errorPlacement: function(error, element) {} ,
            submitHandler: function(form) {
                $.ajax({
                    url: "<?php echo base_url(); ?>Procurement/Vendor/Update",
                    method: "POST",
                    data: $(form).serialize(),
                    success: function(data) 
                    {
                        $('#EditVendor').modal('hide');

                        alertify.success('Data updated Successfully').delay(3).dismissOthers();

                        datatable.ajax.reload(null, false);
                    }
                       
                   
                });
                return false; // prevent the form from submitting
            }
        });
    });


    $(function() {
        $('#edit_contact_form').validate({
            rules: {
                required: 'required',
                
            },
            messages: {
                required: 'This field is required',
                
            },
            errorPlacement: function(error, element) {} ,
            submitHandler: function(form) {
                $.ajax({
                    url: "<?php echo base_url(); ?>Procurement/Vendor/UpdateContact",
                    method: "POST",
                    data: $(form).serialize(),
                    success: function(data) 
                    {
                       $('#SingleEditVendor').modal('hide');

                       alertify.success('Data updated Successfully').delay(3).dismissOthers();

                        datatable.ajax.reload(null, false);

                    }
                       
                   
                });
                return false; // prevent the form from submitting
            }
        });
    });

    /*add oficial documents*/
    $(function() {
        var form = $('#edit_office_form');
        
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
                    url: "<?php echo base_url(); ?>Procurement/Vendor/EditTab3",
                    method: "POST",
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Don't set content type
                    success: function(data) {
                        
                       
                        $('#EditOfficalDocument').modal('hide');
                        alertify.success('Data Added Successfully').delay(3).dismissOthers();
                        datatable.ajax.reload(null, false);


                    }
                });
            }
        });
    });
    /**/


    /*edit add contact start*/

    $(function() {
        $('#edit_add_con_form').validate({
            rules: {
                required: 'required',
                
            },
            messages: {
                required: 'This field is required',
                
            },
            errorPlacement: function(error, element) {} ,
            submitHandler: function(form) {
                $.ajax({
                    url: "<?php echo base_url(); ?>Procurement/Vendor/EditAddContact",
                    method: "POST",
                    data: $(form).serialize(),
                    success: function(data) 
                    {
                        $('#EditAddContact').modal('hide');

                        alertify.success('Data updated Successfully').delay(3).dismissOthers();

                        datatable.ajax.reload(null, false);

                    }
                       
                   
                });
                return false; // prevent the form from submitting
            }
        });
    });

    /*edit add contact end*/


    /*search box for account head*/
    $(".account_head_select").select2({
        placeholder: "Select Account Name",
        theme : "default form-control-",
        dropdownParent: $('#AddVendor'),
        ajax: {
            url: "<?= base_url(); ?>Procurement/Vendor/FetchTypes",
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
    /**/
    
    /*create account id by account head*/ 
     
    $('.account_head_clz').on('change', function() {
      

      var id = $(this).val();

       $.ajax({

           url : "<?php echo base_url(); ?>Procurement/Vendor/Code",

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

    /*validation section start*/

    $('.edit_post_box').on('input', function() {
       
       $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
    });


    $('#edit_telephone_id').on('input', function() {
       
       $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
    });


    $('#edit_fax_id').on('input', function() {
       
       $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
    });


    $('.pro_con_mobile_clz').on('input', function() {
       
       $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
    });


    $("body").on('keyup', '.edit_contact', function(){
      
       $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
       
    });



    /*####*/

    /*show contact detail modal*/ 
     
    $('.contact_detail_modal').on('click', function() {
      
      $('#AddVendor').modal('hide');

      $('#AddContact').modal('show');

     
   });

   /*####*/

    /*close contact details modal*/ 
     
    $('.edit_modal_close').on('click', function() {
      
      $('#EditVendor').modal('show');

      $('#EditContact').modal('hide');

      $('#EditAddContact').modal('hide');

      $('#SingleEditVendor').modal('hide');

      //$('#AddOfficalDocument').modal('hide');
     
    });

  /*####*/

   /*add more contact details*/

    /*var max_fieldss      = 30;
    var y = 1;
    var i =0;
   
    $("body").on('click', '.add_person', function(){
       
        if(y < max_fieldss){ //max input box allowed
            y++;
            i++;
            $(".person-more").append("<tr class='prod_row'><td class='si_no'>"+y+"</td><td><input type='text' name='pro_con_person["+i+"]' class='form-control ' required></td><td><input type='text' name='pro_con_designation["+i+"]' class='form-control ' required></td><td><input type='text' name='pro_con_mobile["+i+"]' class='form-control contact_mobile_clz' required></td><td><input type='email' name='pro_con_email["+i+"]' class='form-control ' required></td><td class='remove-btnnp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td>");
            slno();
        }
    });


    $(document).on("click", ".remove-btnnp", function() {
 
        $(this).parent().remove();
        //y--;
        slno();
    });*/

    /*####*/


    /*Delete Contact Section Start*/

    $("body").on('click','.delete_contact', function(){  
          
          var id = $(this).data('id');

          var rowToDelete = $(this).closest('tr');

         $.ajax({

             url : "<?php echo base_url(); ?>Procurement/Vendor/DeleteContact",

             method : "POST",

             data: {ID: id},

             success:function(data)
              {   
                  rowToDelete.fadeOut(500, function(){
                      
                      $(this).remove();

                      EditSlno();
                     
                      alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                      
                  }); 

              }


          });
     
       
      });



      /*Delete Contact Section End*/  



    /*serial no correction section start*/
      
    function EditSlno(){
        
        var pp =1;
        
        $('body .prod_row_edit').each(function() {

            $(this).find('.si_no_edit').html('<td class="si_no_edit">' + pp + '</td>');

            pp++;

        });
    }


    /*#####*/

    /*show official documnet modal*/ 
     
    $('.offical_document_modal').on('click', function() {
      
      $('#AddVendor').modal('hide');

      $('#AddContact').modal('hide');

      $('#AddOfficalDocument').modal('show');
    
    });

   /*####*/

    /* Select 2 Remove Validation On Change */
	
    $("select[name=ven_account_head]").on("change",function(e) {

        $(this).parent().find(".error").removeClass("error"); 

    });

    /*####*/



    /*edit section start*/

    $("body").on('click', '.edit_btn', function(){ 

        var id = $(this).data('id'); 

        $.ajax({

            url : "<?php echo base_url(); ?>Procurement/Vendor/Edit",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {

                var data = JSON.parse(data);

                $('.edit_vendor_name').val(data.vendor_name);

                $('.edit_account_head').val(data.account_name);

                $('.edit_account_id').val(data.account_id);

                $('.edit_post_box').val(data.post_box);

                $('.edit_telephone').val(data.telephone);

                $('.edit_fax').val(data.fax);

                $('.edit_email').val(data.email);

                $('.edit_credit_term').val(data.credit_term);

                $('.edit_credit_period').val(data.credit_period);
                
                $('.edit_credit_limit').val(data.credit_limit);

                $('.edit_vendor_id').val(data.vendor_id);

                //contact
                
                $('.edit_contact').html(data.contact);


                //office document

                $('.edit_ven_cr_no').val(data.cr_no);

                $('.edit_ven_cr_expiry').val(data.cr_expiry);

                $('.edit_ven_est_id').val(data.est_id);

                $('.edit_ven_est_expiry').val(data.est_id_expiry);

                $('.edit_ven_signature_name').val(data.signature_name);

                $('.edit_ven_qid_no').val(data.qid_no);

                $('.edit_ven_qid_expiry').val(data.qid_expiry);

                $('.vendor_hidden_id').val(data.vendor_id);

                //image section

                $('.edit_cr_attach').html(data.ven_cr_attach);

                $('.edit_est_id_attach').html(data.ven_est_attach);

                $('.edit_qid_attach').html(data.ven_qid_attach);

                $('#EditVendor').modal('show');


            }

        });
	        
           

    });


    $("body").on('click', '.edit_contact_detail_modal', function(){ 

        $('#EditVendor').modal('hide');

        $('#EditContact').modal('show');

    });



    $("body").on('click', '.edit_offical_document_modal', function(){ 

        $('#EditVendor').modal('hide');

        $('#EditOfficalDocument').modal('show');

    });


    $("body").on('click', '.row_edit', function(){ 

        var id = $(this).data('id');

        $.ajax({

            url : "<?php echo base_url(); ?>Procurement/Vendor/ContactEdit",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {
                var data = JSON.parse(data);

                $('.edit_single_contact_person').html(data.contact);

                
            }

        });

        $('#SingleEditVendor').modal('show');

        $('#EditContact').modal('hide');
        

    });


    $("body").on('click', '.edit_add_con', function(){ 

        var id = $('.edit_con_ven_id').val()

        $('.edit_contact_hidden_id').val(id);

        $('#EditAddContact').modal('show');

        $('#EditContact').modal('hide');

        $('#edit_add_con_form')[0].reset();
    
    });


    /*edit section end*/



});


</script>