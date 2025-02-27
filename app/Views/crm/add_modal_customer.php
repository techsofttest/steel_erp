<style>
    .sub_heading{
        margin-top: unset;
    }
    span.select2.customer_width, span.select2 {
   
        display: flex;
        align-items: center;
    }
</style>
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
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn customer_detail_modal border_top">Customer Details</a>
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn contact_detail_modal border_top">Contact Details</a>
                        <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn offical_document_modal border_top">Official Documents</a>
                    </div>   
                        
                                            
                    <div class="card-seprate_divider"></div>

                    <div class="live-preview">
                        <div class="row ">
                            <div class="col-lg-6">
                                <div class="row">

                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basiInput" class="form-label">Customer Name</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="text" name="cc_customer_name" class="form-control input_length" required>
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

                                            <div class="col-col-md-9 col-lg-9 select_parent">
                                                <select class="form-select account_head_select account_head_clz input_length" name="cc_account_head"  required>
                                                    
                                                </select>
                                                
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
                                                <input type="text" name="cc_account_id" class="form-control account_id input_length" readonly required>
                                            </div>

                                        </div> 

                                    </div>    

                                    <!-- ### -->


                                    <!-- Single Row Start -->
                                    <div class="col-lg-12">

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Post Box</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <input type="number" name="cc_post_box" class="form-control input_length" required>
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
                                                <input type="text" name="cc_telephone" id="cc_telephone"  class="form-control input_length"  required>
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
                                                <input type="text" name="cc_fax" id="cc_fax" class="form-control input_length">
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
                                                <input type="email" name="cc_email" class="form-control input_length" required>
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
                                                <input type="text" name="cc_credit_term" class="form-control input_length" required>
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
                                                <input type="number" name="cc_credit_period" class="form-control input_length" required>
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
                                                <input type="number" name="cc_credit_limit" class="form-control input_length" required>
                                            </div>

                                        </div>
                                    </div> 

                                    <!-- ### -->


                                    <!---->

                                    <div class="col-lg-12">
                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">
                                                <label for="basicInput" class="form-label">Country</label>
                                            </div>

                                            <div class="col-col-md-9 col-lg-9">
                                                <select class="form-select  input_length" name="cc_country"  required>
                                                    <option value="" selected disabled>Select Country</option>
                                                    <?php foreach($countryies as $country){?>
                                                        <option value="<?php echo $country->country_id;?>"><?php echo $country->country_name;?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                            </div>

                                        </div>
                                    </div> 

                                    <!---->

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

                   

                    <div class="live-preview content_table" style="padding:0px;">
                        <table  class="table table-bordered table-striped delTable add_table">
                            <thead class="travelerinfo">
                                <tr>
                                    <td >SI</td>
                                    <td>Contact Person</td>
                                    <td>Designation</td>
                                    <td>Mobile</td>
                                    <td>Email</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="per_row">
                                    <td class="si_no_contact" style="padding: 7px;text-align: center;">1</td>
                                    <td><input type="text" name="contact_person[0]" class="form-control " required></td>
                                    <td><input type="text" name="contact_designation[0]" class="form-control " required></td>
                                    <td><input type="text" name="contact_mobile[0]"  class="form-control contact_mobile_clz" required></td>
                                    <td> <input type="email" name="contact_email[0]" class="form-control " required></td>
                                    <td><div class="tecs" style="text-align: center;"><span  class="add_person" class="add_icon"><i class="ri-add-circle-line"></i> </span></div></td>
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

                    
                        
                    
                   

                    <div class="live-preview">
                        
                        <div class="row ">

                            <!--Single Row Start-->
                            <div class="col-lg-12">
                                <div class="row align-items-center mb-2 margin_zero">
                                    <div class="col-lg-3">
                                        <label for="basiInput" class="form-label">CR No</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="number" name="cc_cr_number" class="form-control input_length">
                                    </div>
                                </div>
                                
                                
                            </div>
                            <!--####-->

                            <!--Single Row Start-->
                            
                            <div class="col-lg-12">
                                <div class="row align-items-center mb-2 margin_zero">
                                    <div class="col-lg-3">
                                        <label for="basicInput" class="form-label">	CR Attach</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="file" name="cc_attach_cr" class="form-control input_length">
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
                                        <input type="text" name="cc_cr_expiry" autocomplete="off" placeholder="dd-mm-yy" class="form-control datepicker input_length">
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
                                        <input type="number" name="cc_est_id" class="form-control input_length">
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
                                        <input type="file" name="cc_est_id_attach" class="form-control input_length ">
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
                                        <input type="text" name="cc_est_id_expery" autocomplete="off" placeholder="dd-mm-yy" class="form-control datepicker input_length ">
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
                                        <input type="text" name="cc_signatory_name" class="form-control input_length ">
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
                                        <input type="number" name="cc_qid_number" class="form-control input_length input_length ">
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
                                        <input type="file" name="cc_qid_attach" class="form-control input_length ">
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
                                        <input type="text" name="cc_qid_expiry" autocomplete="off" placeholder="dd-mm-yy" class="form-control datepicker input_length ">
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
                            $('#add_cust_creation').find('select').val('');
                             
                            //$('.account_head_clz').val('').trigger('change');
                            //InitAccountsSelect('.account_head_select', '.select_parent');
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

                    if(data!='')

                    {

                        var data = JSON.parse(data);
                        
                        $(".account_id").val(data.account_id);
                    
                    }
                     
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
         
        $('.contact_detail_modal').on('click', function(){
          
           $('#AddCustomerCreation').modal('hide');

           $('#AddContactDeatils').modal('show');

           //$('.contact_detail_modal').addClass('border_top');
           
           
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
        var i =0;
       
        $("body").on('click', '.add_person', function(){
           
			if(y < max_fieldss){ //max input box allowed
				y++;
                i++;
	            $(".person-more").append("<tr class='per_row'><td class='si_no_contact' >"+y+"</td><td><input type='text' name='contact_person["+i+"]' class='form-control contact_per_clz' required></td><td><input type='text' name='contact_designation["+i+"]' class='form-control cont_desig_clz' required></td><td><input type='text' name='contact_mobile["+i+"]' class='form-control contact_mobile_clz' required></td><td><input type='email' name='contact_email["+i+"]' class='form-control contact_email_clz' required></td><td class='remove-btnnp' colspan='6' style='text-align: center;padding-top: 4px;'><div class='remainpass'><i class='ri-close-line'></i></div></td>");
                si_no_contact();
			}
	    });


        $(document).on("click", ".remove-btnnp", function() {
	 
	        $(this).parent().remove();
	        //y--;


            si_no_contact();



        });

        /*####*/



        /*serial no correction section start*/
          
        function si_no_contact(){
            
            var pp =1;

            
            var rp = 0;
            
            
            $('body .per_row').each(function() {

                //$(this).find('.si_no_contact').html('<td class="si_no_contact" style="border:unset;">' + pp + '</td>');

                $(this).find('.si_no_contact').replaceWith('<td class="si_no_contact" style="padding: 7px;text-align: center;">' + pp + '</td>');

                $(this).find('.contact_per_clz').attr("name", "contact_person["+rp+"]");

                $(this).find('.cont_desig_clz').attr("name", "contact_designation["+rp+"]");

                $(this).find('.contact_mobile_clz').attr("name", "contact_mobile["+rp+"]");

                $(this).find('.contact_email_clz').attr("name", "contact_email["+rp+"]");

                rp++;
                pp++;

            });
        }


        /*#####*/



        /* account head  search droup drown start*/
        
        /*$(".account_head_select").select2({
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
        })*/
        
        



    function InitAccountsSelect(classname, parent) {

        
        $('body ' + classname + ':last').select2({
                placeholder: "select Account Name",
                theme: "default form-control- customer_width",
                dropdownParent: $($('' + classname + ':last').closest('' + parent + '')),
                ajax: {
                    url: "<?= base_url(); ?>Crm/CustomerCreation/FetchTypes",
                    dataType: 'json',
                    delay: 250,
                    cache: false,
                    minimumInputLength: 1,
                    allowClear: true,
                    data: function(params) {
                        return {
                            term: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        var page = params.page || 1;
                        return {
                            results: $.map(data.result, function(item) {
                                return {
                                    id: item.ah_id,
                                    text: item.ah_account_name
                                }
                            }),
                            pagination: {
                                more: (page * 10) <= data.total_count
                            }
                        };
                    },
                }
            })
        }

        InitAccountsSelect('.account_head_select', '.select_parent');

        //InitAccountsSelect2('.credit_account_select2', '.invoice_row');

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

       
        /* Select 2 Remove Validation On Change */
        $("select[name=cc_account_head]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
        /*###*/


        /* Select 2 Remove Validation On Change */
        $("select[name=cc_account_head]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
        /*###*/

       
        /*add customer section end*/ 


       

    });
     
 </script>