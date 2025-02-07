<!--add vendor start-->
<div class="modal fade" id="AddVendor" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form  class="Dashboard-form class" id="add_vendor_form">
			<div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Vendor</h5>
                    <button type="button" class="btn-close cust_close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
				<div class="modal-body">

                    <div class="sub_heading">
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn customer_detail_modal border_top">Vendor</a>
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn contact_detail_modal">Contact</a>
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn offical_document_modal">Documents</a>
                    </div>   
                        
                    <div class="card-seprate_divider"></div>

                    <div class="live-preview">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Vendor Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ven_name" class="form-control" required>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### --> 


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Account Head</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select account_head_select account_head_clz"  name="ven_account_head"  required></select>
                                                
                                            </div>

                                        </div> 
                                        
                                    </div>

                                    <!-- ### --> 


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Account ID</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ven_account_id" class="form-control account_id" readonly required>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Post Box No</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ven_post_box" id="postbox" class="form-control">
                                            </div>

                                        </div>
                                        
                                    </div>

                                    <!-- ### -->  


                                    <!-- Single Row Start -->

                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Telephone</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ven_telephone" id="telephone"  class="form-control"  required>
                                            </div>

                                        </div> 
                                    </div>

                                    <!-- ### --> 


                                    <!--Single Row Start-->
                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Fax</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="ven_fax" id="fax" class="form-control">
                                            </div>

                                        </div>
                                    </div> 

                                    <!-- ### -->  


                                    <!--Single Row Start-->
                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Email</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="email" name="ven_email" class="form-control" required>
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
                                            <div class="row align-items-center mb-2 margin_zero">

                                                <div class="col-col-md-3 col-lg-3">
                                                    <label for="basicInput" class="form-label">Credit Term</label>
                                                </div>

                                                <div class="col-col-md-9 col-lg-9">
                                                    <input type="text" name="ven_credit_term" class="form-control" required>
                                                </div>

                                            </div> 
                                        </div>

                                        <!-- ### --> 



                                        <!--Single Row Start-->
                                        <div class="col-lg-12">
                                            <div class="row align-items-center mb-2 margin_zero">

                                                <div class="col-col-md-3 col-lg-3">
                                                    <label for="basicInput" class="form-label">Credit Period (Days)</label>
                                                </div>

                                                <div class="col-col-md-9 col-lg-9">
                                                    <input type="number" name="ven_credit_period" class="form-control" required>
                                                </div>

                                            </div> 
                                        </div>

                                        <!-- ### --> 



                                        <!--Single Row Start-->
                                        <div class="col-lg-12">
                                            <div class="row align-items-center mb-2 margin_zero">

                                                <div class="col-col-md-3 col-lg-3">
                                                    <label for="basicInput" class="form-label">Credit Limit</label>
                                                </div>

                                                <div class="col-col-md-9 col-lg-9">
                                                    <input type="number" name="ven_credit_limit" class="form-control" required>
                                                </div>

                                            </div>
                                        </div> 

                                        <!-- ### -->

                                        <div class="modal-footer justify-content-center">
                                            <button  class="btn btn btn-success vendor_once_form_submit1">Save</button>
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
                         
    <div class="modal fade" id="AddContact" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-xl">
		    <form  class="Dashboard-form class" id="add_contact_form">
			    <div class="modal-content">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Contact Details</h5>
                        <button type="button" class="btn-close modal_close"  aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        

                            <div class="live-preview content_table" style="padding-top:0px">
                                <table  class="table table-bordered table-striped delTable add_table">
                                    <thead class="travelerinfo">
                                        <tr>
                                            <td >No</td>
                                            <td>Contact Person</td>
                                            <td>Designation</td>
                                            <td>Mobile</td>
                                            <td>Email</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="prod_row">
                                            <td class=" si_no" style="padding:10px 10px;">1</td>
                                            <td><input type="text" name="pro_con_person[0]" class="form-control text-center"></td>
                                            <td><input type="text" name="pro_con_designation[0]" class="form-control text-center"></td>
                                            <td><input type="text" name="pro_con_mobile[0]"  class="form-control contact_mobile_clz text-center"></td>
                                            <td> <input type="email" name="pro_con_email[0]" class="form-control text-center"></td>
                                            <td><div class="tecs"><span  class="add_person" class="add_icon"><i class="ri-add-circle-line"></i> </span></div></td>
                                        </tr>
                                    </tbody>

                                    <tbody class="person-more" class="travelerinfo"></tbody>
                                        
                                </table>
                                                
                                <input type="hidden" class="vendor_hidden_id" name="pro_con_vendor">
                                <div class="modal-footer justify-content-center">
                                    
                                    <button class="btn btn btn-success vendor_once_form_submit2">Save</button>
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
                <form  class="Dashboard-form class" id="add_office_form">
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
                                            <div class="row align-items-center mb-2 margin_zero">
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
                                            <div class="row align-items-center mb-2 margin_zero">
                                                <div class="col-lg-3">
                                                    <label for="basicInput" class="form-label">CR Attach</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="file" name="cc_attach_cr" class="form-control">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        

                                        <!--####-->


                                        <!--Single Row Start-->
                                        
                                        <div class="col-lg-12">
                                            <div class="row align-items-center mb-2 margin_zero">
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
                                            <div class="row align-items-center mb-2 margin_zero">
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
                                            <div class="row align-items-center mb-2 margin_zero">
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
                                            <div class="row align-items-center mb-2 margin_zero">
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
                                            <div class="row align-items-center mb-2 margin_zero">
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
                                            <div class="row align-items-center mb-2 margin_zero">
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
                                            <div class="row align-items-center mb-2 margin_zero">
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
                                            <div class="row align-items-center mb-2 margin_zero">
                                                <div class="col-lg-3">
                                                    <label for="basicInput" class="form-label">QID Expiry</label>
                                                </div>
                                                <div class="col-lg-9">
                                                    <input type="text" name="cc_qid_expiry" placeholder="dd-mm-yy" class="form-control datepicker">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        

                                        <!--####-->

                                        <input type="hidden" class="vendor_hidden_id" name="cc_id">

                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success vendor_once_form_submit3">Save</button>
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

   
    /*add section start*/

    $(function() {
        $('#add_vendor_form').validate({
            rules: {
                required: 'required',
                
            },
            messages: {
                required: 'This field is required',
                
            },
            errorPlacement: function(error, element) {} ,
            submitHandler: function(form) {
                $('.vendor_once_form_submit1').attr('disabled', true); // Disable this input.
                $.ajax({
                    url: "<?php echo base_url(); ?>Procurement/Vendor/Add",
                    method: "POST",
                    data: $(form).serialize(),
                    success: function(data) 
                    {
                       
                        var responseData = JSON.parse(data);
                        
                        $(".vendor_hidden_id").val(responseData.vendor_id);
                        
                        $('#AddVendor').modal('hide');

                        $('#AddContact').modal('show');
                    }
                       
                   
                });
                return false; // prevent the form from submitting
            }
        });
    });


    $(function() {
        $('#add_contact_form').validate({
            rules: {
                required: 'required',
                
            },
            messages: {
                required: 'This field is required',
                
            },
            errorPlacement: function(error, element) {} ,
            submitHandler: function(form) {
                $('.vendor_once_form_submit2').attr('disabled', true); // Disable this input.
                $.ajax({
                    url: "<?php echo base_url(); ?>Procurement/Vendor/AddTab2",
                    method: "POST",
                    data: $(form).serialize(),
                    success: function(data) 
                    {
                       
                        $('#AddContact').modal('hide');

                        $('#AddOfficalDocument').modal('show');
                    }
                       
                   
                });
                return false; // prevent the form from submitting
            }
        });
    });

    /*add oficial documents*/
    $(function() {
        var form = $('#add_office_form');
        
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
                $('.vendor_once_form_submit3').attr('disabled', true); // Disable this input.
                // Submit the form for the current tab
                $.ajax({
                    url: "<?php echo base_url(); ?>Procurement/Vendor/AddTab3",
                    method: "POST",
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Don't set content type
                    success: function(data) {
                        
                        $('#add_office_form')[0].reset();
                        $('#add_contact_form')[0].reset();
                        $('#add_vendor_form')[0].reset();
                        $('.account_head_clz').val('').trigger('change')
                        $('#AddOfficalDocument').modal('hide');
                        alertify.success('Data Added Successfully').delay(3).dismissOthers();
                        datatable.ajax.reload(null, false);

                    }
                });
            }
        });
    });
    /**/


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

      if(id!=null){

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
        
        }    
     
       
    });

    /*####*/

    /*validation section start*/

    $('#telephone').on('input', function() {
       
       $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
    });


    $('#fax').on('input', function() {
       
       $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
    });
    

    $('#postbox').on('input', function() {
       
       $(this).val($(this).val().replace(/[^0-9+\- ]/g, ''));
    });


 

    $("body").on('keyup', '.contact_mobile_clz', function(){
      
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
     
    $('.modal_close').on('click', function() {
      
        $('#AddVendor').modal('show');

        $('#AddContact').modal('hide');

        $('#AddOfficalDocument').modal('hide');
     
    });

  /*####*/

   /*add more contact details*/

    var max_fieldss      = 30;
    var y = 1;
    var i =0;
   
    $("body").on('click', '.add_person', function(){
       
        if(y < max_fieldss){ //max input box allowed
            y++;
            i++;

            
           // $(".person-more").append("<tr class='prod_row prod_row_remove'><td class='si_no' style='padding:10px 10px;'>"+y+"</td><td><input type='text' name='pro_con_person["+i+"]' class='form-control pro_con_per_clz' required></td><td><input type='text' name='pro_con_designation["+i+"]' class='form-control pro_con_des_clz' required></td><td><input type='text' name='pro_con_mobile["+i+"]' class='form-control contact_mobile_clz' required></td><td><input type='email' name='pro_con_email["+i+"]' class='form-control pro_con_email_clz' required></td><td class='remove-btnnp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i></div></td>");
            
           $(".person-more").append("<tr class='prod_row prod_row_remove'><td class='si_no' style='padding:10px 10px;'>"+y+"</td><td><input type='text' name='pro_con_person["+i+"]' class='form-control pro_con_per_clz text-center' required></td><td><input type='text' name='pro_con_designation["+i+"]' class='form-control pro_con_des_clz text-center' required></td><td><input type='text' name='pro_con_mobile["+i+"]' class='form-control contact_mobile_clz text-center' required></td><td><input type='email' name='pro_con_email["+i+"]' class='form-control pro_con_email_clz text-center' required></td><td class='remove-btnnp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i></div></td>");
            
            
            slno();

            removeSlno();
        }
    });


    $(document).on("click", ".remove-btnnp", function() {
 
        $(this).parent().remove();
        //y--;
        slno();

        removeSlno();

    });

    /*####*/

    /*serial no correction section start*/
      
    function slno(){
        
        var pp =1;
        
        $('body .prod_row').each(function() {

            $(this).find('.si_no').html('<td class="si_no" style="border:unset;">' + pp + '</td>');

            pp++;

        });
    }


    /*#####*/


    /*rearrange no section start*/

    function removeSlno(){

        var rp = 0;
            
        $('body .prod_row').each(function() {

            $(this).find('.pro_con_per_clz').attr("name", "pro_con_person["+rp+"]");

            $(this).find('.pro_con_des_clz').attr("name", "pro_con_designation["+rp+"]");

            $(this).find('.contact_mobile_clz').attr("name", "pro_con_mobile["+rp+"]");

            $(this).find('.pro_con_email_clz').attr("name", "pro_con_email["+rp+"]");

            rp++;
           

        });

    }


    /*rearrange no section end*/

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

   

});


/*document.addEventListener("DOMContentLoaded", function(event) {

    function isDataTableRequest(ajaxSettings) {
        // Check for DataTables-specific URL or any other pattern
        return ajaxSettings.url && ajaxSettings.url.includes('/FetchData');
    }

    function isSelect2Request(ajaxSettings) {
        // Check for specific data or parameters in Select2 requests
        return ajaxSettings.url && ajaxSettings.url.includes('term='); // Adjust based on actual request data
    }


    function isSelect2Search(ajaxSettings) {
        // Check for specific data or parameters in Select2 requests
        return ajaxSettings.url && ajaxSettings.url.includes('page='); // Adjust based on actual request data
    }


    $(document).ajaxSend(function(event, jqXHR, ajaxSettings) {
        if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings))) {
            $("#overlay").fadeIn(300);
        }
    });


    $(document).ajaxComplete(function(event, jqXHR, ajaxSettings) {
        if ((!isDataTableRequest(ajaxSettings)) && (!isSelect2Request(ajaxSettings)) && (!isSelect2Search(ajaxSettings))) {
            $("#overlay").fadeOut(300);
        }
    });



    $(document).ajaxError(function() {
        alertify.error('Something went wrong. Please try again later').delay(5).dismissOthers();
    });


});*/


</script>