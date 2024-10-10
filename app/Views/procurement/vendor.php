<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--add vendor modal start-->
                        
                        <?= $this->include('procurement/add_vendor') ?>

                        <!--add vendor modal end-->

                        
                        <!--view product in data table section start-->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Vendor</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddVendor" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Vendor Name</th>
                                                    <th>Post Box</th>
                                                    <th>Telephone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                            
                                            </tbody>

                                        </table>
                
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>

                        <!--view product in data table section end--->





                        <!--edit vendor modal start-->
                        
                         <?= $this->include('procurement/edit_vendor') ?>

                        <!--edit vendor modal end-->


                         
                        <!--view vendor modal start-->

                        <!--view vendor start-->

                        <div class="modal fade" id="ViewVendor" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <form  class="Dashboard-form class" id="">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Create Vendor</h5>
                                            <button type="button" class="btn-close cust_close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="sub_heading">
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn view_customer_detail_modal border_top">Vendor</a>
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn view_contact_detail_modal">Contact</a>
                                                <a href="javascript:void(0)" class="sub_heading_text sub_heading_btn view_offical_document_modal">Documents</a>
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
                                                                        <input type="text" name="ven_name" class="form-control view_vendor_name" readonly>
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

                                                                        <input type="text" name="" class="form-control view_account_head" readonly>
                                                                        
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
                                                                        <input type="text" name="ven_account_id" class="form-control view_account_id" readonly >
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
                                                                        <input type="text" name="ven_post_box" class="form-control view_post_box" readonly>
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
                                                                        <input type="text" name="ven_telephone" id="telephone"  class="form-control view_telephone"  readonly>
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
                                                                        <input type="text" name="ven_fax" id="fax" class="form-control view_fax" readonly>
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
                                                                        <input type="email" name="ven_email" class="form-control view_email" readonly>
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
                                                                        <input type="text" name="ven_credit_term" class="form-control view_credit_term" readonly>
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
                                                                        <input type="number" name="ven_credit_period" class="form-control view_credit_period" readonly>
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
                                                                        <input type="number" name="ven_credit_limit" class="form-control view_credit_limit" readonly>
                                                                    </div>

                                                                </div>
                                                            </div> 

                                                            <!-- ### -->

                                                           

                                                        </div>

                                                    </div>
                                                    
                                                </div>

                                            </div>   
                                                
                                        </div>
                                                                
                                    </div>
		                        </form>

	                        </div>


                        </div>


                        <!--view vendor end-->




                        <!--view contact section start-->
                        
                        <div class="modal fade" id="ViewContactDeatils" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_cond_detail">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Customer Creation</h5>
                                            <button type="button" class="btn-close view_modal_close"  aria-label="Close"></button>
                                        </div>
				                        <div class="modal-body">

                                          
                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            <td>No</td>
                                                            <td>Contact Person</td>
                                                            <td>Designation</td>
                                                            <td>Mobile</td>
                                                            <td>Email</td>
                                                            
                                                        </tr>
                                                        
                                                    </tbody>

                                                    <tbody class="view_contact" class="travelerinfo"></tbody>
                
                                                </table>
                                                
                                            </div>   
					                       
					                        
				                        </div>
                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--view contact section end-->




                       
                        <!--view office document start-->
           
                        <div class="modal fade" id="ViewOfficalDocument" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog">
		                        <form  class="Dashboard-form class">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Official Documents</h5>
                                            <button type="button" class="btn-close view_modal_close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                <input type="number"   class="form-control view_cr_no" readonly>
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
                                                                <input type="text"  class="form-control view_cr_expiry" readonly>
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
                                                                <input type="number" class="form-control view_est_id" readonly>
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
                                                                <input type="text" class="form-control ven_est_expiry" readonly>
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
                                                                <input type="text"  class="form-control view_signature_name" readonly>
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
                                                                <input type="number" class="form-control ven_qid_no" readonly>
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
                                                                <input type="text" class="form-control ven_qid_expiry" readonly>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                    

                                                    <!--####-->


                                                </div>
                                                    
                                            </div> 
                                            
                                            
                                            <!--image section start-->

                                            <div class="card-body">
                                                <table id="" class="table table-bordered table-striped delTable display dataTable" style="border: 1px solid #9E9E9E;">
                                                    <thead>
                                                        <tr>
                                                            
                                                            <th class="cust_img_rgt_border">CR  Attach</th>
                                                            <th class="cust_img_rgt_border">Est.ID Attach</th>
                                                            <th>QID Attach</th>
                                                            
                                                        </tr>
                                                    </thead>
                                            
                                                    <tbody>
                                                        <tr>
                                                            <td class="cust_img_rgt_border view_cr_att" ></td>
                                                            <td class="cust_img_rgt_border view_est_id_att"></td>
                                                            <td class="view_qid_att"></td>
                                                        </tr>
                                                    </tbody>

                                                </table>
                
                                            </div>

                                            <!--image section end-->
					                           
						                       
					
					                        
				                        </div>
                                        
			                        </div>

		                        </form>

	                        </div>
                        </div>

                        <!--view office document end-->
                         
                        <!--view vendor modal end-->


                    </div>
                    <!--###-->

                </div>
                    
                  
            </div>
                    
        </div>
                    
                    
    </div>
                    
    
                        
</div>





<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Procurement/Vendor/FetchData",
                'data': function (data) {
                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                    return {
                        data: data,
                        [csrfName]: csrfHash, // CSRF Token
                    };
                },
                dataSrc: function (data) {
                    // Update token hash
                    $('.txt_csrfname').val(data.token);
                    // Datatable data
                    return data.aaData;
                }
            },
            'columns': [
                { data: 'ven_id' },
                { data: 'ven_name' },
                { data :'ven_post_box'},
                { data :'ven_telephone'},
                { data :'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/



        /*view section start*/

        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id'); 

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/Vendor/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {

                    var data = JSON.parse(data);

                    $('.view_vendor_name').val(data.vendor_name);

                    $('.view_account_head').val(data.account_name);

                    $('.view_account_id').val(data.account_id);

                    $('.view_post_box').val(data.post_box);

                    $('.view_telephone').val(data.telephone);

                    $('.view_fax').val(data.fax);

                    $('.view_email').val(data.email);

                    $('.view_credit_term').val(data.credit_term);

                    $('.view_credit_period').val(data.credit_period);
                    
                    $('.view_credit_limit').val(data.credit_limit);

                    //contact
                    
                    $('.view_contact').html(data.contact);

                    //office document

                    
                    
                    $('.view_cr_no').val(data.cr_no);

                    $('.view_cr_expiry').val(data.cr_expiry);

                    $('.view_est_id').val(data.est_id);

                    $('.ven_est_expiry').val(data.est_id_expiry);

                    $('.view_signature_name').val(data.signature_name);

                    $('.ven_qid_no').val(data.qid_no);

                    $('.ven_qid_expiry').val(data.qid_expiry);

                    $('.view_cr_att').html(data.ven_cr_attach);

                    $('.view_est_id_att').html(data.ven_est_attach);

                    $('.view_qid_att').html(data.ven_qid_attach);

                    $('#ViewVendor').modal('show');

                }

            });

            

        });



        $("body").on('click', '.view_contact_detail_modal', function(){ 

           $('#ViewVendor').modal('hide');

           $('#ViewContactDeatils').modal('show');

        });


        $("body").on('click', '.view_offical_document_modal', function(){ 

            $('#ViewVendor').modal('hide');

            $('#ViewOfficalDocument').modal('show');

        });



        $("body").on('click', '.view_modal_close', function(){ 

            $('#ViewVendor').modal('show');

            $('#ViewContactDeatils').modal('hide');

        });


        /*reset reffer no*/ 
        $('.add_model_btn').click(function(){

            $('#add_vendor_form')[0].reset();

            $('.prod_row_remove').remove();

            $('.vendor_once_form_submit1').attr('disabled', false); // Disable this input.

            $('.vendor_once_form_submit2').attr('disabled', false); // Disable this input.

            $('.vendor_once_form_submit3').attr('disabled', false); // Disable this input.

           
        });

        /*####*/




        /*view section end*/


        


        /*delete vendor section start*/


        $('body').on('click','.delete_btn',function(){
            
            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            if (!confirm('Are you absolutely sure you want to delete?')) return false;

            $.ajax({

            url : "<?php echo base_url(); ?>Procurement/Vendor/Delete",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {   
                var data = JSON.parse(data);

                /*if(data.status=='true'){

                    alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                    datatable.ajax.reload(null, false);
                }*/
                /*else{

                    alertify.error("Customer In Use Cant't Delete").delay(3).dismissOthers();
                }*/

                
                if(data.status == "false")
                {
                    alertify.error("Data in Use Can't Be Delete").delay(3).dismissOthers();
                }
                else
                {
                    rowToDelete.fadeOut(500, function() {
                        $(this).remove();
                        alertify.error('Data Delete Successfully').delay(3).dismissOthers();
                        datatable.ajax.reload(null,false);
                    }); 
                }
            }


            });


        });


        /*delete vendor section end*/


    });


</script>