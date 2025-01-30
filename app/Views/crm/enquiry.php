<style>
    span.select2.customer_width {
        /*width: 80% !important;*/

        border: 1px solid #434343 !important;
        margin-bottom: 0px;
        width: 97% !important;
        height: 40px !important;
        background: whitesmoke;
        padding: 0px;
        display: block;
    } 
    .contact_more_modal
    {
        position: absolute;
        right: 4px;
        top: -8px;
        font-size: 24px;
        color: #ff0000b5;
        
    }
    .cust_more_modal
    {
        position: absolute;
        right: 4px;
        top: -8px;
        font-size: 24px;
        color: #ff0000b5;
    }
    span.select2.select_width
    {
        width: 94% !important;
        background: #f5f5f5;
        border: none;
        height: 37px !important;
    }
    .prod_add_more
    {
        /*position: absolute;
        left: 532px;
        font-size: 25px;
        color: #ff0000b5;*/
        color: #ff0000b5;
        font-size: 20px;
    }
    .zero_padding
    {
        padding: 0px 0px;
    }
    .input_length
    {
        width: 97%;
    }
    .droup_color{

        color: black;
    }

    .Dashboard-form .form-control {
        
        border: 1px solid #434343;
        margin-bottom: 0px;
        background: whitesmoke;
        height: 40px;
    }
    .margin_zero{

        margin-bottom: 0px !important;
    }
    .Dashboard-form .form-select {
        border: 1px solid #434343 !important;
        margin-bottom: 0px;
        background: whitesmoke;
        height: 40px;
        width: 97%;
       
    }
    .table{

        border: 1px solid #0000003b !important;  
    }
    .content_table thead{

        background: #BDD7EE;
        color: black;
        font-size: 14px;
        text-align: center;
        font-weight: 500;
    }

    .content_table{

        padding: 0px 25px;
        padding-top: 40px;
    }

    .content_table td{
      
        border: 1px solid black;
    }

    .content_table .form-control {
       
        border: unset !important;

    }

    .justify-content-center {
        justify-content: flex-end !important;
        margin-right: 26px;
    }

    .once_form_submit{

        background: #00AF50;
        padding: 10px 32px;
    }


</style>

<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--add enquiry modal start-->
                        <div class="modal fade" id="AddEnquiry" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_enquiry_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Enquiry</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row" style="padding: 0px 25px;">

                                                   
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_reff" id="enqid" class="form-control input_length" value="<?php echo $enquiry_id; ?>" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_date" autocomplete="off" class="form-control enquiry_date datepicker_ap input_length" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer Name <span class="add_more_icon cust_more_modal  ri-add-line"></span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9 ">
                                                                        <select class="form-select ser_customer" name="enquiry_customer" id="customer_id" required>
                                                                            <option value="" selected disabled>Select Customer</option>
                                                               
                                                                        </select>
                                                                    </div>


                                                                    <!--<div class="col-col-md-1 col-lg-1 zero_padding">

                                                                        <span class="add_more_icon cust_more_modal ri-add-box-fill"></span>

                                                                    </div>-->

                                                                </div> 

                                                            </div>   

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3 ">
                                                                        <label for="basicInput" class="form-label">Contact Person<span class="add_more_icon contact_more_modal ri-add-line"></span></label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9 ">
                                                                        <select class="form-select "  name="enquiry_contact_person" id="contact_person_id"  required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                
                                                                        </select>

                                                                        
                                                                        
                                                                    </div>


                                                                   

                                                                    

                                                                </div> 

                                                            </div>   

                                                            <!-- ### --> 

                                                        </div>

                                                    </div>


                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Assigned To</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                    <select class="form-select " name="enquiry_assign_to" required>
                                                                        <option value="" selected disabled>Assigned To</option>
                                                                        <?php foreach($sales_executive as $executive){?> 
                                                                            <option class="droup_color" value="<?php echo $executive->se_id;?>"><?php echo $executive->se_name;?></option>
                                                                        <?php } ?>
                                                                
                                                                     </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Source</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_source" class="form-control input_length"   required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Time Frame</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_time_frame" autocomplete="off" class="form-control time_frame_date input_length" value=""   required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_project" class="form-control input_length"   required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 



                                                        </div>

                                                    </div>
                                                   



                                                   

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4 content_table" >
                                                    <table class="table table-bordered table-striped delTable">
                                                        <thead>
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description<span class="add_more_icon prod_add_more ri-add-line"></span></td>
                                                                <td>Unit</td>
                                                                <td>Quantity</td>
                                                                <td>Action</td>
                                                            </tr>
                                                        </thead>    
                                                        <tbody class="travelerinfo">
                                                            <tr class="prod_row">
                                                                <td style="width: 10%;"class="si_no">1</td>
                                                                <td style="width:40%">
                                                                <!--<span class="add_more_icon prod_add_more">New</span>--->
                                                                    <select class="form-select ser_product_det" name="pd_product_detail[0]" required>
                                                                        <option value=""  selected disabled>Select Product Description</option>
                                                                        
                                                                    </select>
                                                                </td>
                                                               
                                                                <td><input type="text" name="pd_unit[0]" class="form-control" required></td>
                                                                <td><input type="number" name="pd_quantity[0]" class="form-control" required></td>
                                                                <td><div class="tecs"><span id="add_product" class="add_icon"><i class="ri-add-circle-line"></i>Add </span></div></td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody id="product-more" class="travelerinfo"></tbody>
                                                    </table>
                                                </div>


                                                <!--<div style="float: right;">
                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                        <tr>
                                                            <td><button>Print</button></td>
                                                            <td><button>Email</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td><button type="submit">Save</button></td>
                                                            <td><button>PDF</button></td>
                                                        </tr>
                                                    </table>
                                                </div>--->

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success once_form_submit" type="submit">Save</button>
                                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--####-->


                       <!---customer creation modal start-->


                       <?= $this->include('crm/add_modal_customer') ?>
                       

                       <!--########-->



                       <!---add contact modal start-->
                        
                       <?= $this->include('crm/add_contact_person') ?>

                       <!--#######-->



                       <!--add product modal start-->
                       
                       <?= $this->include('crm/add_product_modal') ?>

                       <!--#######-->


                       <!--view enquiry section start-->

                        <div class="modal fade" id="ViewEnquiry" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Enquiry</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row">
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" class="form-control view_reff" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" class="form-control view_date" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" class="form-control  view_customer" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>   

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <input type="text" class="form-control  view_contact_person" readonly>
                                                                        
                                                                    </div>

                                                                    

                                                                </div> 

                                                            </div>   

                                                            <!-- ### --> 

                                                        </div>

                                                    </div>


                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Assigned To</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" class="form-control  view_assigned_to" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Source</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" class="form-control view_enquiry_source" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Time Frame</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" class="form-control view_time_frame"  readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text"  class="form-control view_project" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 



                                                        </div>

                                                    </div>
                                                   



                                                   

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable">
                                                        <thead class="travelerinfo">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Quantity</td>
                                                               
                                                            </tr>
                                                           
                                                        </thead>
                                                        <tbody class="view_contact_details" class="travelerinfo"></tbody>
                                                    </table>
                                                </div>


                                               

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--view enquiry section end-->



                        <!--edit enquiry section start-->
                         

                        <div class="modal fade" id="EditEnquiry" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="update_enquiry_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Enquiry</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row">
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_reff" class="form-control edit_reff"  required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Date</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_date" autocomplete="off" class="form-control edit_date datepicker_ap" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Customer Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select ser_customer_edit edit_customer" name="enquiry_customer"  required>
                                                                           
                                                               
                                                                        </select>
                                                                    </div>

                                                                </div> 

                                                            </div>   

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <select class="form-select edit_contact_person" name="enquiry_contact_person" required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                
                                                                        </select>
                                                                        
                                                                    </div>

                                                                    

                                                                </div> 

                                                            </div>   

                                                            <!-- ### --> 

                                                        </div>

                                                    </div>


                                                    <div class="col-lg-6">

                                                        <div class="row">
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Assigned To</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                    <select class="form-select edit_assign_to" name="enquiry_assign_to" required>
                                                                        
                                                                
                                                                     </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Source</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_source" class="form-control edit_source" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Time Frame</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_time_frame" autocomplete="off" class="form-control edit_time_frame" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Project</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="enquiry_project" class="form-control edit_project" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <input type="hidden" name="enquiry_id" value="" class="edit_enquiry_id">

                                                        </div>

                                                    </div>
                                                   



                                                   

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable">
                                                        <thead class="travelerinfo">
                                                            <tr>
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Quantity</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            
                                                        </thead>
                                                        <tbody class="edit_contact_detail" class="travelerinfo"></tbody>
                                                          <!--<tbody>-->
                                                          <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon add_single_product"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        <!--</tbody>--->
                                                    </table>
                                                </div>


                                                <!---<div style="float: right;">
                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                        <tr>
                                                            <td><button>Print</button></td>
                                                            <td><button>Email</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td><button type="submit">Save</button></td>
                                                            <td><button>PDF</button></td>
                                                        </tr>
                                                    </table>
                                                </div>--->

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success" type="submit">Save</button>
                                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--edit single product detail start-->

                        <div class="modal fade" id="EditSingleProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_single_product">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Contact Details</h5>
                                            <button type="button" class="btn-close sub_modal_close" ></button>
                                        </div>
				                        <div class="modal-body">

                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            <td >No</td>
                                                            <td>Product Description</td>
                                                            <td>Unit</td>
                                                            <td>Quantity</td>
                                                           
                                                            
                                                            
                                                        </tr>
                                                       
                                                    </tbody>
                                                    
                                                    <tbody class="single_contact_edit" class="travelerinfo">
                                                        
                                                    </tbody>

                                                   
                
                                                </table>
                                               
                                                <div class="modal-footer justify-content-center">
                                                    
                                                    <button class="btn btn btn-success">Save</button>
                                                </div>
                                            </div>   
					                        
				                        </div>
                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--edit single product detail end-->


                        <!--edit add single prod start-->

                        <div class="modal fade" id="EditAddProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_add_product">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                                            <button type="button" class="btn-close  sub_modal_close"></button>
                                        </div>
				                        <div class="modal-body">

                                            <div class="card-seprate_divider"></div>

                                            <div class="live-preview">
                                                <table  class="table table-bordered table-striped delTable">
                                                    <tbody class="travelerinfo">
                                                        <tr>
                                                            <td >No</td>
                                                            <td>Product Description</td>
                                                            <td>Unit</td>
                                                            <td>Quantity</td>
                                                           
                                                        </tr>
                                                       
                                                    </tbody>
                                                    
                                                    <tbody class="" class="travelerinfo">

                                                        <tr>
                                                            <td>1</td>
                                                            <td style="width:40%">
                                                                <select class="edit_add_prod" name="pd_product_detail" required>
                                                                    <option value="" selected disabled>select</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="pd_unit" class="form-control" required></td>
                                                            <td><input type="number" name="pd_quantity" class="form-control" required></td>
                                                            <input type="hidden" name="pd_enquiry_id" class="edit_add_prod_id">
                                                        </tr>
                                                        
                                                    </tbody>

                                                   
                
                                                </table>
                                                
                                                <div class="modal-footer justify-content-center">
                                                    
                                                    <button class="btn btn btn-success">Save</button>
                                                </div>
                                            </div>   
					                        
				                        </div>
                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--edit add single prod end-->





                        <!--edit enquiry section end-->




                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Enquiry</h4>
                                        <button type="button"  class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Reference</th>
                                                    <th>Date</th>
                                                    <th>Customer</th>
                                                    <th>Actions</th>
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
                    </div>
                    <!--###-->


                   

                    
                </div>
                    
                    
                    
            </div>
                    
        </div>
                    
                    
    </div>
                    
    
                        
</div>







<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*add enquiry section start*/  



        /*add section*/
        $(function() {
            var form = $('#add_enquiry_form');

            
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                    $('.once_form_submit').attr('disabled', true); // Disable this input.
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/Enquiry/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            $('#add_enquiry_form')[0].reset();
                            $('#customer_id').val('').trigger('change');
                            $('.ser_product_det').val('').trigger('change');
                            $('#AddEnquiry').modal('hide');
                            $('.enquiry_remove').remove();
                           
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                           
                            datatable.ajax.reload(null, false);

                           
                            
                        }
                    });
                   
                }
            });
        });


        /*#####*/

        /*customer droup drown search*/
        $(".ser_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#AddEnquiry'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchCustomer",
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
                    //console.log(data);
                    //NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                    console.log(data);
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.cc_id, text: item.cc_customer_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
         
        })
        /*###*/



        /* Select 2 Remove Validation On Change */
        $("select[name=enquiry_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });

        
        $("body").on('change', '.ser_product_det', function(e){ 
            $(this).parent().find(".error").removeClass("error");         
        });


        /*###*/





        /*fetch data with customer*/

        $("body").on('change', '#customer_id', function(){ 
            var id = $(this).val();
           
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/ContactPerson",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                
                    $("#contact_person_id").html(data.customer_name);

                  
                    
                }


            });
        });

        /*####*/


        /*add more product section start*/


        var max_fieldspp  = 30;
        var pp = 1;
        var j =0
        $("#add_product").click(function(){

			if(pp < max_fieldspp){ 
			    pp++;
                j++;
	           
                $("#product-more").append("<tr class='prod_row enquiry_remove'><td class='si_no'><input type='number' value='"+pp+"' name='pd_serial_no["+j+"]' class='form-control' required='' readonly></td><td style='width: 28%;'><select class='form-select ser_product_det' style='width:97%' name='pd_product_detail["+j+"]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo addslashes($prod->product_details);?></option><?php } ?></select></td><td><input type='text' name='pd_unit["+j+"]' class='form-control unit_clz' required=''></td><td><input type='number' name='pd_quantity["+j+"]' class='form-control qty_clz' required=''></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

                slno_add();
                /*customer droup drown search*/
                 InitSelect2();
			}
	    });

        $(document).on("click", ".remove-btnpp", function() 
        {
	        $(this).parent().remove();

	        slno_add();
        });



        /*#####*/


        /*Add New Product start*/

         $("body").on('click', '.prod_add_more', function(){ 
	        
            $('#AddEnquiry').modal('hide');

            $('#AddProdModal').modal('show');

        });


       /*Add New Product end*/


       /*Product Drop Down*/
       /*function InitSelect2(){
          $(".ser_product_det:last").select2({
            placeholder: "Select Product",
            theme : "default form-control- select_width",
            dropdownParent: $('#AddEnquiry'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchProdDes",
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
                        results: $.map(data.result, function (item) { return {id: item.product_id, text: item.product_details}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })
        }*/

        function InitSelect2() {
            $(".ser_product_det:last").select2({
            placeholder: "Select Product",
            theme: "default form-control- select_width",
            dropdownParent: $('#AddEnquiry'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchProdDes",
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
                processResults: function (data, params) {
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) {
                            // Truncate product_details to 50 characters for display
                            let truncatedDetails = item.product_details.length > 50 
                                ? item.product_details.substring(0, 50) + "..." 
                                : item.product_details;

                            // Return id, text, and set the title attribute for full details
                            return {
                                id: item.product_id,
                                text: truncatedDetails,
                                title: item.product_details // Full text for tooltip
                            };
                        }),
                        pagination: {
                            more: (page * 10) <= data.total_count // Assuming 10 records per page
                        }
                    };
                },
            }
        }).on('select2:open', function () {
            // Add the title attribute to each option dynamically after opening the dropdown
            $(".select2-results__option").each(function () {
                var $this = $(this);
                $this.attr('title', $this.text()); // Set title to full text
            });
        });
}



        InitSelect2();

        /*###*/


      

        //trigger when form is submitted

        $("#add_office_doc").submit(function(e){

            $('#AddEnquiry').modal('show');

            return false;

        });

        /*#####*/




        /*close product modal (open enquiry modal)*/

        $('#AddProdModal').on('hidden.bs.modal', function () {

        $('#AddEnquiry').modal('show')
        })

        /*#####*/



        /*close product modal (open enquiry modal)*/

        $('#ContactDeatils2').on('hidden.bs.modal', function () {

        $('#AddEnquiry').modal('show')
        })

        /*#####*/


        

        /*Time Frame section start*/

         
         $("body").on('change', '.enquiry_date', function(){ 
           
            //var  $this = $('.time_frame_date').val();

            var date = $(this).val();
 
 
            $.ajax({
 
                 url : "<?php echo base_url(); ?>Crm/Enquiry/EnquiryDate",
 
                 method : "POST",
 
                 data: {Date: date},
 
                 success:function(data)
                 {   
                    var data = JSON.parse(data);
                 
                    $('.time_frame_date').val(data.increment_date_date)

                    $('.time_frame_date').removeClass("error"); 
                     
                 }
 
 
             });
 
 
         });
 
      
 
        /*Time Frame section end*/


        /*reset reff no*/

        $('.add_model_btn').click(function(){
           
            $('#add_enquiry_form')[0].reset();

            $('.ser_customer').val('').trigger('change');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/AddAccess",

                method : "POST",

                success:function(data)
                {

                    var data = JSON.parse(data);

                    if(data.status === 0){
                    
                        alertify.error(data.msg).delay(3).dismissOthers();

                    }
                    else{

                        $('#AddEnquiry').modal('show');

                    }
                    

                }

            });


            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/FetchReference",

                method : "GET",

                success:function(data)
                {  
                    $('#enqid').val(data);
                    $('.once_form_submit').attr('disabled', false); // Disable this input.
                
                }

            });

        });

        /*####*/


        /* Select 2 Remove Validation On Change */
        $("select[name=enquiry_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
        /*###*/


        /*add enquiry section end*/




        /*view section start*/


        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id');

            
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                    
                    $('.view_reff').val(data.enquiry_reff);

                    $('.view_date').val(data.enquiry_date);

                    $('.view_customer').val(data.cc_customer_name);

                    $('.view_contact_person').val(data.contact_person);

                    $('.view_assigned_to').val(data.enquiry_assign_to);

                    $('.view_enquiry_source').val(data.enquiry_source);

                    $('.view_time_frame').val(data.enquiry_time_frame);

                    $('.view_project').val(data.enquiry_project);

                    $('.view_contact_details').html(data.prod_details);


                    $('#ViewEnquiry').modal('show');
                
                }


            });

        })


        /*view section end*/



        /*edit section start*/

        $("body").on('click', '.edit_btn', function(){ 

            var id = $(this).data('id');

            
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    if(data.status === 0){

                        alertify.error(data.msg).delay(3).dismissOthers();



                    }
                    else{

                        $('.edit_reff').val(data.enquiry_reff);

                        $('.edit_date').val(data.enquiry_date);

                        $('.edit_customer').html(data.customer_creation);

                        $('.edit_contact_person').html(data.contact_person);

                        $('.edit_assign_to').html(data.assigned_to);

                        $('.edit_source').val(data.enquiry_source);

                        $('.edit_time_frame').val(data.enquiry_time_frame);

                        $('.edit_project').val(data.enquiry_project);

                        $('.edit_enquiry_id').val(data.enquiry_id);

                        $('.edit_contact_detail').html(data.prod_details);

                        $('#EditEnquiry').modal('show');
                    }

                    
                   
                
                }


            });

        })

        /*customer droup drown search*/
         /*$(".ser_customer_edit").select2({
            placeholder: "Select Customer",
            theme : "default form-control- ",
            dropdownParent: $('#EditEnquiry'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchCustomer",
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
                    
                    console.log(data);
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.cc_id, text: item.cc_customer_name}}),
                        pagination: {
                          
                        more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
         
        })*/
        /*###*/


        /*edit single product detail start*/

            

        /*edit single product detail end*/


        $("body").on('click', '.edit_prod_btn', function(){ 

            var id = $(this).data('id');

            $('#EditSingleProduct').modal('show');

            $('#EditEnquiry').modal('hide');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/FetchSingleProd",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $('.single_contact_edit').html(data.prod_details);
                    
                   
                
                }


            });

        })


        /*close  edit sub modal*/

        $("body").on('click', '.sub_modal_close', function(){ 
            
            $('#EditAddProduct').modal('hide');
          
            $('#EditSingleProduct').modal('hide');

            $('#EditEnquiry').modal('show');

        

        })



        /*######*/



        /* update single enquiry start*/

        $(function() {
            var form = $('#edit_single_product');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/Enquiry/UpdateSingleEnquiry",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);

                            var prodID = responseData.enquiry_id;

                            $('#EditSingleProduct').modal('hide');

	                        $('.edit_btn[data-id="'+prodID+'"]').trigger('click');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                            
                        }
                    });
                }
            });
        });


        /*#######*/


        /*delete single enquiry start*/

        $("body").on('click', '.delete_prod_btn', function(){ 

            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/DeleteProduct",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    
                    rowToDelete.fadeOut(500, function() {
                        $(this).remove();
                        slno();
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                    }); 

                   

                   

                }


            });

          
        })


        /*delete single enquiry end*/
        
        
        /*edit add single product start*/
         
        $("body").on('click', '.add_single_product', function(){ 

            $('#EditEnquiry').modal('hide');

            $('#EditAddProduct').modal('show');

            var enquiry_id = $('.edit_enquiry_id').val();

            $('.edit_add_prod_id').val(enquiry_id);



        })


        $(function() {
            var form = $('#edit_add_product');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/Enquiry/AddSingleProduct",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                           
                            var responseData = JSON.parse(data);

                            var enquiryID = responseData.enquiry_id;



                            $('#EditAddProduct').modal('hide');

                            $('.edit_btn[data-id="'+enquiryID+'"]').trigger('click');

                            $('#edit_add_product')[0].reset();

                            $('.edit_add_prod').val('').trigger('change');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                            
                        }
                    });
                }
            });
        });



        /*edit add single product end*/


        /*update enquiry section start*/

        $(function() {
            var form = $('#update_enquiry_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/Enquiry/UpdateTab",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {

                            var responseData = JSON.parse(data);

                            var enqID = responseData.enquiry_id;

                            $('#EditEnquiry').modal('hide');

	                        //$('.view_btn[data-id="'+enqID+'"]').trigger('click');

                            alertify.success('Data Updated Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                            
                        }
                    });
                }
            });
        });


        /*update enquiry section end*/





        /* edit add product detail (option)*/
            
            $(".edit_add_prod").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#EditAddProduct'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchProdDes",
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
                    //console.log(data);
                    //NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                    console.log(data);
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.product_id, text: item.product_details}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
         
        })
       


        /*####*/




        /*fetch contact detail by customer name*/

        $("body").on('change', '.edit_customer', function(){ 

            var cust_id = $(this).val();

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/FetchContact",

                method : "POST",

                data: {custID: cust_id},

                success:function(data)
                {   
                    
                    var responseData = JSON.parse(data);

                    console.log(responseData.contact_person);

                    $('.edit_contact_person').html(responseData.contact_person);

                }

            });

           

        })

        /*#######*/



        /*Time Frame section start*/

         
         $("body").on('change', '.edit_date', function(){ 
	        
            var date = $(this).val();
 
            
 
            $.ajax({
 
                 url : "<?php echo base_url(); ?>Crm/Enquiry/EnquiryDate",
 
                 method : "POST",
 
                 data: {Date: date},
 
                 success:function(data)
                 {   
                     var data = JSON.parse(data);
                 
                       $('.edit_time_frame').val(data.increment_date_date)
                 
                     
                 }
 
 
             });
 
 
        });
 
      
 
        /*Time Frame section end*/


        /*edit section end*/





        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Crm/Enquiry/FetchData",
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
                { data: 'enquiry_id' },
                { data: 'enquiry_reff' },
                { data: 'enquiry_date'},
                { data: 'enquiry_customer'},
                { data: 'action'},
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/

        

      


        /*add customer section start*/
         
        $("body").on('click', '.cust_more_modal', function(){ 
	        
           
            $('#AddEnquiry').modal('hide');

            $('#AddCustomerCreation').modal('show');

        });

     
        /*####*/

        
        
          /*add customer contact person section start*/
         
        $("body").on('click', '.contact_more_modal', function(){ 

            
	        
            var customer_id = $('#customer_id').val();

            if(customer_id === null)
            {
             
                alertify.success('Please Select Customer').delay(2).dismissOthers();
            
            }
            else
            {

                $('#ContactDeatils2').modal('show');

                $('#AddEnquiry').modal('hide');

                $('.customer_creation_id2').val(customer_id);

            }

        });

     
        /*####*/


       



        /*serial no correction section start*/

        function slno_add(){

          
            var pp =1;

            var rp =0;
            $('body .prod_row').each(function() {
                  
                $(this).find('.si_no').html(pp);

               $(this).find('.ser_product_det').attr("name", "pd_product_detail["+rp+"]");

               $(this).find('.unit_clz').attr("name", "pd_unit["+rp+"]");

               $(this).find('.qty_clz').attr("name", "pd_quantity["+rp+"]");
                  
                
                rp++;
                pp++;

               

            });


        }

        function slno(){


            var pp =1;

            $('body .prod_row1').each(function() {

                $(this).find('.si_no1').html(pp);
                
                
                pp++;

            });

        }

        /*###*/



        

          


        /**/

        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;

            var id = $(this).data('id');

            $.ajax({

                url : "<?php echo base_url(); ?>Crm/Enquiry/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    var data = JSON.parse(data);
                     
                    if(data.status === 1)
                    {

                        alertify.success(data.msg).delay(2).dismissOthers();

                        datatable.ajax.reload(null,false);
                    }
                    else
                    {
                        alertify.error(data.msg).delay(3).dismissOthers();
   
                    }
                }


            });

        });

        /**/




    });


    document.addEventListener("DOMContentLoaded", function(event) {

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
    if(!isSelect2Request)
    {   
        alertify.error('Something went wrong. Please try again later').delay(3).dismissOthers();
    }
});


});





</script>