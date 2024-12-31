<style>
    
    .select2.select2-container 
    {
        /*width: 95% !important;*/
    }
    .cust_more_modal
    {
        /*position: absolute;
        left: 471px;
        padding: 0px 23px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;*/

        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;

    }
    span.select2.select_width
    {
        width: 70% !important;
    }
    .prod_add_more
    {
        position: absolute;
        left: 340px;
        padding: 4px 27px;
        z-index: 999;
        border: 1px solid black;
        border: 1px solid #0000003b;
    }
    .row_align
    {
        display: flex;
        align-items: center;
        justify-content: unset !important;
    }
  
    .input_length {
        width: 95% !important;
    }
    .add_contact{
        position: absolute;
        right: 32px;
        top: -16px;
        font-size: 25px;
        color: #ff0000b5;
    }
    .input_length2
    {
        width: 93%;
    }
    .input_length4
    {
        width: 18%;
    }
    .tecs span 
    {
        color: green;
        cursor: pointer;
    }
    .droup_color{

        color: black !important;
    }
    .add_new {
        font-size: 25px;
        color: #ff0000b5;
        position: absolute;
        right: 34px;
        top: -16px;
    }
    .add_more_icon {
        cursor: pointer;
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
                        
                        <!--add purchse voucher modal start-->
                        <div class="modal fade" id="AddPurchaseVoucher" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="purchase_form" data_fill="false">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Voucher</h5>
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
                                                                        <input type="text" name="purchase_reffer_no" id="pv_id" class="form-control input_length voucher_reff" value="" required readonly>
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
                                                                        <input type="text" name="purchase_date" class="form-control mr_date datepicker_ap input_length voucher_date" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        
                                                                        <select class="form-select select_vendor add_vendor vendor_data" name="purchase_vendor_name" id=""  required>
                                                                            
                                                                            <option value="" selected disabled>Select Customer</option>
                                                                           
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-col-md-1 col-lg-1">
                                                                        
                                                                        <span class="add_more_icon add_new vendor_new_modal  ri-add-box-fill"></span>
                                                                    
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
        
                                                                        <label for="basicInput" class="form-label">Purchase Order</label>
        
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        
                                                                        <select class="form-select select_purchase purchase_order" name="purchase_order" id="">
                                                                            
                                                                            <option value="" selected="" disabled="">Select Purchase Order</option>

                                                                        </select>

                                                                        <!--<input type="text" name="purchase_order" class="form-control select_purchase input_length" required>-->

                                                                    </div>

                                                                    <div class="col-col-md-1 col-lg-1">

                                                                        <span class="add_more_icon cust_more_modal ri-add-box-fill" id="blink"></span>

                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 



                                                            



                                                            <!-- Single Row Start -->

                                                            <!--<div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">MRN</label>
                                                                    
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select input_length material_received_note" name="pruchase_mrn" id="" required>

                                                                        <option value='' selected disabled>Select Material Received Note</option>

                                                                        <?php //foreach($material_received as $mat_rec){?>
                                                                            
                                                                            <option value="<?php //echo $mat_rec->mrn_id;?>"><?php //echo $mat_rec->mrn_reffer; ?></option>

                                                                        <?php //} ?>

                                                                        </select>

                                                                    </div>

                                                                   

                                                                </div> 

                                                            </div>--->    

                                                            <!-- ### -->
                                                            
                                                            




                                                        </div>

                                                    </div>


                                                    <div class="col-lg-6">

                                                        <div class="row">


                                                           <!-- Single Row Start -->

                                                           <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    
                                                                    </div>

                                                                    <div class="col-col-md-8 col-lg-8">
                                                                        
                                                                        <select class="form-select add_contact_person input_length" name="purchase_contact_person" id="" style="width: 100% !important;"></select>
                                                                        
                                                                        <!--<input type="text" name="purchase_contact_person" class="form-control add_contact_person input_length" required>-->

                                                                    </div>

                                                                    <div class="col-col-md-1 col-lg-1">
                                                                        <span class="add_more_icon add_new contact_new_modal ri-add-box-fill"></span>
                                                                    </div>


   

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->


                                                           

                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        
                                                                        <label for="basicInput" class="form-label">Vendor Inv Ref</label>
                                                                        
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text" name="purchase_vendor" class="form-control input_length2 vendor_inv_ref" value="" required>   

                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-item-scenter mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Note</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="purchase_delivery_note" class="form-control input_length2 delivery_note_clz" value="">
                                                                    </div>

                                                                </div> 

                                                            </div>    
                                                            <!-- ### --> 

                                                            
                                                            
                                                            
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text " name="purchase_payment_term" class="form-control add_payment_term input_length2" value="" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            


                                                            <input type="hidden" class="hidden_purchase_voucher_id" name="purchase_voucher_id">



                                                        </div>

                                                    </div>
                                                   


                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4">
                                                    <table class="table table-bordered table-striped delTable ">
                                                        <tbody class="travelerinfo">
                                                            
                                                            <tr>
                                                                
                                                                <td>Sales Order Ref</td>
                                                                <td>Product Description</td>
                                                                <td>Debit A/C</td>
                                                                <td>Qty</td>
                                                                <td>Unit</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>

                                                            </tr>
                                                            
                                                        </tbody>

                                                        <tbody  class="travelerinfo product-more2"></tbody>

                                                        <tbody>

                                                            <tr>
                                                                <td colspan="6" class=""></td>
                                                                <td>Total</td>
                                                                <td><input type="text" name="total_vou_amount" class="total_prod_amount form-control" readonly=""></td>
                                                             </tr>
                                                        
                                                        </tbody>
	
                                                        
                                                    </table>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="row row_align mb-4">
                                                            
                                                            <div class="col-lg-2">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name="po_file" Class="image_file"  class="form-control">
                                                            </div>

                                                        </div>

                                                        
                                                    </div>
                                                    
                                                    <div class="col-lg-6 tecs">

                                                        <span class="add_icon add_product2"><i class="ri-add-circle-line"></i>Add </span>
                                                               
                                                            
                                                    </div>
                                                    
                                                </div>


                                                

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


                        <!--####-->



                        <!--view modal section start--->
                        <div class="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <form class="Dashboard-form class" id="">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Voucher</h5>
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
                                                                        <input type="text" name="" id="" class="form-control view_ref" readonly>
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
                                                                        <input type="text" name="" class="form-control view_date" readonly>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="" class="form-control view_vendor_name" readonly>

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

                                                                        <input type="text" name="" class="form-control view_contact_person" readonly>

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
                                                                        <label for="basicInput" class="form-label">Purchase Order</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="" class="form-control view_purchase_order" readonly>

                                                                    </div>

                                                                </div>

                                                            </div>


                                                            <!-- ### -->


                                                             <!-- Single Row Start -->
                                                             <div class="col-lg-12">
                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Inv Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="" class="form-control view_vendor_inv_ref" readonly>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- ### -->


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Note</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="" class="form-control view_delivery_note" readonly>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->



                                                           


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="" class="form-control view_payment_term" readonly>
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
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td class="text-center">Serial No</td>
                                                                <td class="text-center">Sales Order</td>
                                                                <td class="text-center">Product Description</td>
                                                                <td class="text-center">Debit A/C</td>
                                                                <td class="text-center">Qty</td>
                                                                <td class="text-center">Unit</td>
                                                                <td class="text-center">Rate</td>
                                                                <td class="text-center">Discount</td>
                                                                <td class="text-center">Amount</td>



                                                            </tr>


                                                        </thead>

                                                        <tbody class="travelerinfo view_prod_data"></tbody>

                                                        <tbody>

                                                            <tr>
                                                                <td colspan="7" class=""></td>
                                                                <td>Total</td>
                                                                <td><input type="text" name="" class=" form-control view_total_amount text-end" readonly=""></td>
                                                             </tr>
                                                        
                                                        </tbody>




                                                    </table>
                                                </div>



                                                <div class="row">
                                                    <div class="col-lg-6">

                                                        <div class="card-body view_image_table" style="float: inline-start;"></div>


                                                    </div>
                                                    <div class="col-lg-6"></div>

                                                </div>

                                                <!--table section end-->

                                            </div>

                                        </div>

                                    </div>
                                </form>

                            </div>
                        </div>

                        


                        <!--view modal section end-->



                        <!--Edit modal section start--->
                        <div class="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <form class="Dashboard-form class" id="edit_purchase_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Voucher</h5>
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
                                                                        <input type="text" name="pv_reffer_id" id="" class="form-control edit_ref" readonly>
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
                                                                        <input type="text" name="pv_date" class="form-control edit_date mr_date datepicker_ap" >
                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Name</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="pv_vendor_name" class="form-control edit_vendor_name" readonly>

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

                                                                        <input type="text" name="pv_contact_person" class="form-control edit_contact_person" readonly>

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
                                                                        <label for="basicInput" class="form-label">Purchase Order</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="pv_purchase_order" class="form-control edit_purchase_order" readonly>

                                                                    </div>

                                                                </div>

                                                            </div>


                                                            <!-- ### -->


                                                             <!-- Single Row Start -->
                                                             <div class="col-lg-12">
                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Vendor Inv Ref</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="pv_vendor_inv" class="form-control edit_vendor_inv_ref">

                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- ### -->


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Note</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">

                                                                        <input type="text" name="pv_delivery_note" class="form-control edit_delivery_note">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- ### -->



                                                           


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Term</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pv_payment_term" class="form-control edit_payment_term">
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
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                
                                                                <td>Sales Order Ref</td>
                                                                <td>Product Description</td>
                                                                <td>Debit A/C</td>
                                                                <td>Qty</td>
                                                                <td>Unit</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                                



                                                            </tr>


                                                        </thead>

                                                        <tbody class="travelerinfo edit_prod_data"></tbody>

                                                        <tbody>

                                                            <tr>
                                                                <td colspan="6" class=""></td>
                                                                <td>Total</td>
                                                                <td><input type="text" name="total_vou_amount" class=" form-control edit_total_amount" readonly="" ></td>
                                                             </tr>
                                                        
                                                        </tbody>




                                                    </table>
                                                </div>



                                                <div class="row">
                                                    <div class="col-lg-6">

                                                        <div class="card-body view_image_table" style="float: inline-start;"></div>


                                                    </div>
                                                    <div class="col-lg-6"></div>

                                                </div>

                                                <!--table section end-->

                                            </div>

                                        </div>

                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success" type="submit">Save</button>
                                        </div>

                                         <input type="hidden" name="pv_id" value="" class="edit_purchase_id">


                                    </div>
                                </form>

                            </div>
                        </div>

                        <!--Edit modal section end-->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Purchase Voucher</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#AddPurchaseVoucher" class="btn btn-primary py-1 add_model_btn">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Reference</th>
                                                    <th>Purchase Order</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody></tbody>

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

<!--select modal section start-->

<div class="modal fade" id="SelectProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="selected_prod_form">
			<div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

				<div class="modal-body">

                    <div class="live-preview">
                                                
                        <div class="mt-4">
                            
                            <table class="table table-bordered table-striped delTable">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td>Serial No.</td>
                                        <td>Product Description</td>
                                        <td>Vendor DN Ref</td>
                                        <td>Tick</td>
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo select_prod_add"></tbody>


                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                    <input type="hidden" id="select_prod_id" name="select_prod_id" value="">                                
                    <span class="btn btn btn-success prod_modal_submit">Save</span>

                </div>




                                        
			</div>
		</form>

	</div>

</div>



<!--select  modal section end-->



<!--payment modal start-->


<div class="modal fade" id="paymentModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="pv_advance_add_form">
			<div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#AddPurchaseVoucher" aria-label="Close"></button>
                </div>

				<div class="modal-body">

                    <div class="live-preview">
                                                
                        <div class="mt-4">
                            
                            <table class="table table-bordered table-striped delTable">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td>Serial No.</td>
                                        <td>Date</td>
                                        <td>Payment Ref</td>
                                        <td>Amount</td>
                                        <!--<td>Adjust</td>-->
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo" id="pv_advance_row">
                                    
                                </tbody>


                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                    <!--<button type="submit" class="btn btn btn-success">Save</button>-->

                </div>




                                        
			</div>
		</form>

	</div>

</div>



<!--payment modal end-->



<!--edit product single modal start--->

<div class="modal fade" id="EditProdModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<form  class="Dashboard-form class" id="update_single_prod">
			<div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close close_single_prod" data-bs-dismiss="modal"  aria-label="Close"></button>
                </div>

				<div class="modal-body">

                    <div class="live-preview">
                                                
                        <div class="mt-4">
                            
                            <table class="table table-bordered table-striped delTable">
                                
                                <thead class="travelerinfo contact_tbody">
                                    
                                    <tr>
                                        <td>Sales Order Ref</td>
                                        <td>Product Description</td>
                                        <td>Debit A/C</td>
                                        <td>Unit</td>
                                        <td>Qty</td>
                                        <td>Rate</td>
                                        <td>Discount</td>
                                        <td>Amount</th>
                                       
                                    </tr>
                                                            
                                                           
                                </thead>
                                                        
                                <tbody  class="travelerinfo edit_single_prod"></tbody>


                            </table>
                            
                        </div>




                    </div>  
                                            
                                            
                </div>

                <div class="modal-footer justify-content-center">
                    
                                                  
                    <button class="btn btn btn-success" type="submit" name="single_prod_sub" >Save</button>

                </div>




                                        
			</div>
		</form>

	</div>

</div>


<!--edit product single modal end--->




<!--vendor modal start-->

<?= $this->include('procurement/add_vendor') ?>

<!--vendor modal end-->


<!--contact modal start-->

<?= $this->include('procurement/add_vendor_contact') ?>

<!--contact modal end-->


<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
    
        /*add section start*/  
 
        /*add form*/
        $(function() {
            var form = $('#purchase_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    //if($('#purchase_form').attr('data_fill')=="true"){   

                        // Submit the form for the current tab
                        $.ajax({
                            url: "<?php echo base_url(); ?>Procurement/PurchaseVoucher/Add",
                            method: "POST",
                            data: $(currentForm).serialize(),
                            success: function(data) {

                                var data = JSON.parse(data);
                                
                                $('#AddPurchaseVoucher').modal('hide');

                                if(data.po_advance_status==true)
                                {

                                $('#paymentModal').modal('show');

                                $('#pv_advance_row').html(data.po_advance_row);
                            
                                }

                                alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            
                                datatable.ajax.reload(null, false);
                            
                                
                            }
                        });

                    //}
                    /*else
                    {
                        alertify.error('Please Select Products').delay(3).dismissOthers();

                        
                        $('#blink').each(function() {
                            var elem = $(this);
                            refreshIntervalId = setInterval(function() {
                                if (elem.css('visibility') == 'hidden') {
                                    elem.css('visibility', 'visible');
                                } else {
                                    elem.css('visibility', 'hidden');
                                }    
                            }, 200);
                        });

                        setTimeout(function(){
                            clearInterval(refreshIntervalId);
                            
                        }, 1000)
                    }*/
                   
                }
            });
        });


        /*#####*/




        // ADD ADVANCE TO TABLE



        $('#pv_advance_add_form').submit(function(e) {

            e.preventDefault();

            $.ajax({

                url: "<?php echo base_url(); ?>Procurement/PurchaseVoucher/AddAdvance",

                method: "POST",

                data : $(this).serialize(),

                success: function(data) {

                    alertify.success('Data Updated Successfully').delay(8).dismissOthers();

                    datatable.ajax.reload(null, false);
                }


            });
            });






        /* ########## */

        

       





       /*Product Drop Down*/
       function InitSelect2(){
          $(".ser_product_det:last").select2({
            placeholder: "Select Product",
            theme : "default form-control- select_width",
            dropdownParent: $('#AddPurchaseOrder'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialRequisition/FetchProdDes",
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
        }

        InitSelect2();

        /*###*/



        /*Time Frame section start*/

         
         $("body").on('change', '.mr_date', function(){ 
	        
            var date = $(this).val();
 
            
 
            $.ajax({
 
                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/Date",
 
                method : "POST",
 
                data: {Date: date},
 
                success:function(data)
                {   
                    var data = JSON.parse(data);
                 
                    $('.time_frame_date').val(data.increment_date_date)
                 
                     
                }
 
 
            });
 
 
        });
 
      
 
        /*Time Frame section end*/


        /*select purchase order by vendor section start*/

        $("body").on('change', '.add_vendor', function(){ 
	        
            var vendorid = $(this).val();
 
            $.ajax({
 
                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/PurchaseOrder",
 
                method : "POST",
 
                data: {ID: vendorid},
 
                success:function(data)
                {   
                    var data = JSON.parse(data);
                 
                    $('.purchase_order').html(data.pur_reff)

                    $('.add_contact_person').find('option:not(:first)').remove();
 
                }
 
 
            });
 
 
        });


        /**/



        


      


        /*reset reff no*/

        /*$('.add_mr_form').click(function(){
           
            $('#add_enquiry_form')[0].reset();
            $('.ser_product_det').val('').trigger('change');
            $('.add_assigned_to').val('').trigger('change');
            $('.add_sales_order').val('').trigger('change');
            $('.mr_remove').remove();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/MaterialRequisition/FetchReference",

                method : "GET",

                success:function(data)
                {  
                    $('#mr_id').val(data);
                
                }

            });

        });*/

        /*####*/


        /*serial no correction section start*/

        function slno(){

            var pp =1;

            $('body .prod_row').each(function() {

                $(this).find('.si_no').html(pp);
                
                
                
                pp++;

            });
        }

        /*###*/


        /*add section end*/




        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchData",
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
                { data: 'pv_id'},
                { data: 'pv_reffer_id'},
                { data: 'pv_purchase_order'},
                { data: 'pv_date'},
                { data: 'action'},
                
               ],
               "initComplete": function () {

                    var dataId = '<?php echo isset($_GET['view_po']) ? $_GET['view_po'] : ''; ?>';

                    $('#DataTable').dataTable().fnFilter(dataId);

                },

                "drawCallback": function() {

                $('.view_btn[data-id="<?php echo isset($_GET['view_po']) ? $_GET['view_po'] : ''; ?>"]').trigger('click');

                }
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });


        /*###*/


        /*reset reffer no*/ 
        $('.add_model_btn').click(function(){

            $('#purchase_form')[0].reset();
            $('.add_vendor').val('').trigger('change');
            $('#AddPurchaseOrder').modal('hide');
            $('.add_prod_remove').remove();
            $('.hidden_recived_id').val("");
            $('.add_product2').show();
            $('.hidden_purchase_voucher_id').val("");
           
            $(".purchase_order").val("").trigger( "change" );
            $('.add_prod_row').remove();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchReference",

                method : "GET",

                success:function(data)
                {
                   

                    $('#pv_id').val(data);

                    //$('.select_purchase').html(data.pur_reff);

                }
            });

        });

        /*####*/


        /*customer droup drown search*/
        $(".select_vendor").select2({
            placeholder: "Select Vendor Name",
            theme : "default form-control- customer_width input_length4",
            dropdownParent: $('#AddPurchaseVoucher'),
            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialReceivedNote/FetchTypes",
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
                        results: $.map(data.result, function (item) { return {id: item.ven_id, text: item.ven_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
         
        })
        /*###*/



         /*sales order droup drown search*/
         function InitSalesSelectAdd(){
            $(".add_sales_order:last").select2({
                placeholder: "Select Product",
                theme : "default form-control- droup_color",
                dropdownParent: $($('.add_sales_order:last').closest('.add_prod_row')),
                ajax: {
                    url: "<?= base_url(); ?>Procurement/PurchaseVoucher/FetchSalesOrder",
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
                            results: $.map(data.result, function (item) { return {id: item.so_reffer_no, text: item.so_reffer_no}}),
                            pagination: {
                            // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                                more: (page * 10) <= data.total_count
                            }
                        };
                    },              
                }
            })
        }

        InitSalesSelectAdd();
        /*###*/



        /*sales order droup drown search*/
        function InitProductSelectAdd(){
            $(".add_products:last").select2({
                placeholder: "Select Product",
                theme : "default form-control- droup_color",
                dropdownParent: $($('.add_products:last').closest('.add_prod_row')),
                ajax: {
                    url: "<?= base_url(); ?>Procurement/PurchaseVoucher/FetchProducts",
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
                            results: $.map(data.result, function (item) { return {id: item.product_details, text: item.product_details}}),
                            pagination: {
                            // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                                more: (page * 10) <= data.total_count
                            }
                        };
                    },              
                }
            })
        }

        InitProductSelectAdd();
        /*###*/




        /*debit droup down start*/

        function InitDebitSelectAdd(){
            $(".debit_account:last").select2({
                placeholder: "Select Product",
                theme : "default form-control- droup_color",
                dropdownParent: $($('.debit_account:last').closest('.add_prod_row')),
                ajax: {
                    url: "<?= base_url(); ?>Procurement/PurchaseVoucher/FetchDebit",
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
                            results: $.map(data.result, function (item) { return {id: item.ca_id, text: item.ca_name}}),
                            pagination: {
                            // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                                more: (page * 10) <= data.total_count
                            }
                        };
                    },              
                }
            })
        }

        InitDebitSelectAdd();


        /*debit froup down end*/




       




        /*add selected product*/


        $("body").on('click', '.cust_more_modal', function()
        { 
            if(!$("#purchase_form").valid())
            {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
            }

            if($('#purchase_form').attr('data-submit')=='false')
            {

             $('#purchase_form').submit();

                if(!$("#purchase_form").valid())
                {
                alertify.error('Fill required fields!').delay(3).dismissOthers();
                return false;
                }

            }

            var formData = new FormData($('#purchase_form')[0]);
            var image = $('.image_file').prop('files')[0]; // Get the file from input field
            formData.append('image', image); // Append the file to FormData object

            $.ajax({
                        url: "<?php echo base_url(); ?>Procurement/PurchaseVoucher/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {

                            var data = JSON.parse(data);

                            var purchase_voucher_id = data.purchase_voucher_id;

                            $('.hidden_purchase_voucher_id').val(purchase_voucher_id);

                            console.log(purchase_voucher_id);

                            var purchase_id = data.purchase_order;

                            console.log(purchase_id);

                            $('#AddPurchaseVoucher').modal('hide');

                            $('#SelectProduct').modal('show');

                           
                            $.ajax({

                                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchProduct",

                                method : "POST",

                                data: {ID: purchase_id},
                                
                                success:function(data)
                                {   
                                    var data = JSON.parse(data);

                                    $(".select_prod_add").html(data.product_detail);
                         
                                }  

                            });
 
                            
                        }

                    });

        });


        /*#######*/


        /*prod modal submit start*/

        $("body").on('click', '.prod_modal_submit', function(){ 

            var selectId = $('#select_prod_id').val();

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/SelectedProduct",

                method : "POST",

                data: {ID: selectId},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.total_prod_amount').val(data.final_amount);

                    $('.product-more2').html(data.product_detail);

                    $('#SelectProduct').modal("hide");

                    $('#AddPurchaseVoucher').modal("show");

                    $('.selected_table').show();
                        
                    checkedIds.length = 0; 

                    $('#purchase_form').attr('data_fill','true');

                    $('.add_product2').hide();


                }

            });
        });


        /*prod modal submit end*/

        /*calculation section start*/

	    /*$("body").on('keyup', '.add_discount','.add_prod_rate','.add_prod_qty', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.add_prod_row').find('.add_discount').val())||0;

            var $discountSelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.add_prod_row').find('.add_prod_amount');

            $amountElement.val(orginalPrice);

        });*/

        /*####*/


               /**delete section start**/

       $("body").on('click', '.product_delete', function(){ 

            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            /*$.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesOrder/DeleteProdDet",

                method : "POST",

                data:{ID: id},

                success:function(data)
                { */  
                    
                    rowToDelete.fadeOut(500, function() {
                        $(this).remove();
                        TotalAmount();
                        deleteSlno();
                        
                        //EditProdTotal();
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                    }); 

                
            // }


            // });

        });



/**delete section end**/



        /*calculation section start*/

        $("body").on('keyup', '.add_discount, .add_prod_qty, .add_prod_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.add_prod_row').find('.add_discount').val())||0;

            var $discountSelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.add_prod_row').find('.add_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.add_prod_row').find('.add_prod_amount');

            $amountElement.val(orginalPrice);

            TotalAmount();

        });


        function TotalAmount()
        {
            
            var total= 0;

            $('body .add_prod_amount').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
               
            });

           total = total.toFixed(2);

           $('.total_prod_amount').val(total);

          
            

        }
		



        /*calculation section end*/



        /*add current delivery start*/

        $("body").on('keyup', '.add_current_qty', function(){ 


            var dataSelect = $(this);

            var deliverySelectElement = dataSelect.closest('.add_prod_row').find('.add_delivery_qty');

            var delivery = parseFloat(deliverySelectElement.val()) || 0; // Convert to number, default to 0 if NaN

            var currentSelectElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');

            var current = parseFloat(currentSelectElement.val()) || 0; // Convert to number, default to 0 if NaN
            
            var total = delivery + current;

            var orderSelectElement = dataSelect.closest('.add_prod_row').find('.add_order_qty');

            var order = orderSelectElement.val();

            //var order = parseFloat(orderSelectElement.val()) || 0;

            


            if(total > order)
            {   
   
                /*var currencyNull = currentSelectElement.val("");

                console.log(currencyNull);

                var $currencyNullElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');

                $currencyNullElement.val(currencyNull);*/

                /**/

                currentSelectElement.val(""); // Set the value to an empty string
                var currencyNull = currentSelectElement.val(); // Get the current (now empty) value
                
                var $currencyNullElement = dataSelect.closest('.add_prod_row').find('.add_current_qty');
                $currencyNullElement.val(currencyNull); // Set the value of $currencyNullElement to the empty string


                /**/


                alertify.error('Delivery Qty + Current Delivery Should Not Exceed The Order Qty').delay(3).dismissOthers();
                
            }

        });


        /*add current delivery end*/


        /*vendor new modal start*/
        
        $("body").on('click', '.vendor_new_modal', function(){ 
            
            $('#AddPurchaseVoucher').modal('hide');

            $('#AddVendor').modal('show');

           
        });

        /*vendor new modal end*/


        //trigger when form is submitted

        $("#add_office_form").submit(function(e){

            $('#AddPurchaseVoucher').modal('show');

            return false;

        });

        /*#####*/


        /*contact new modal start*/

        $("body").on('click', '.contact_new_modal', function(){
           
            var vendor = $('.add_vendor').val();

            if(vendor === null)
            {
                alertify.error('Please Select Vendor Name').delay(2).dismissOthers();
            }
            else
            {
                $('#AddNewContact').modal('show');

                $('#AddPurchaseVoucher').modal('hide');

                $('.new_pro_con_vendor').val(vendor);
            }
            
          
        });


        /*contact new modal end*/

        
       /*fetch purchase order by vendor name*/

       $("body").on('change', '.vendor_data', function(){ 

            var Id = $('.vendor_data').val();

            if(Id!=null ){

                $.ajax({

                    url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/ContactPerson",

                    method : "POST",

                    data: {ID: Id},

                    success:function(data)
                    {
                    
                        var data = JSON.parse(data);

                       // $('.add_contact_person').html(data.condact_data);

                        $('.add_payment_term').val(data.payment_term);
                    }

                });

            }
        });


        $("body").on('change', '.purchase_order', function(){ 

            var Id = $('.purchase_order').val();

            if(Id!=null ){

                $.ajax({

                    url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/ContactPersons",

                    method : "POST",

                    data: {ID: Id},

                    success:function(data)
                    {
                    
                        var data = JSON.parse(data);

                       $('.add_contact_person').html(data.condact_data);

                       $(".add_contact_person").prop('required',true);

                       $('.delivery_note_clz').prop('required',true);

                       
                    }

                });

            }
        });
       
       /*###*/



        /*fetch purchase voucher start*/


        $("body").on('change', '.material_received_note', function(){ 

            var Id = $('.material_received_note').val();
 
            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchPurchase",

                method : "POST",

                data: {ID: Id},

                success:function(data)
                {
                
                    var data = JSON.parse(data);

                    $('.select_purchase').val(data.purchase_order);

                    $('.delivery_note_clz').val(data.delivery_note);

                    $('.add_payment_term').val(data.payment_term);
                   
                    
                }

            });

        });


       /*########*/


       /*fetch data by purchase order*/

       $("body").on('change', '.select_purchase', function(){ 

            var Id = $('.select_purchase').val();

            if(Id!=null ){

                $.ajax({

                    url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/FetchPayment",

                    method : "POST",

                    data: {ID: Id},

                    success:function(data)
                    {
                    
                        var data = JSON.parse(data);

                    

                        //$('.delivery_note_clz').val(data.delivery_date);

                        

                        $('.mr_ref').val(data.mr_reff);

                        
                    }

                });

            }
        });


       /*####*/



        /*add more section start*/

        var max_fieldspp  = 30;

        $("body").on('click', '.add_product2', function(){

            var pp = $('.prod_row').length

            var qj  = $('.quot_row_leng').length

            if(pp < max_fieldspp){ 
 
            
            pp++;
            
            //$(".product-more2").append("<tr class='prod_row quot_row_leng'><td class='si_no'>"+pp+"</td><td><select class='form-select add_prod' name='qpd_product_description["+qj+"]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='qpd_unit["+qj+"]' class='form-control unit_clz_id' required=''></td><td><input type='number' name='qpd_quantity["+qj+"]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='qpd_rate["+qj+"]' class='form-control rate_clz_id' required=''></td><td><input type='number' min='0' max='100' onkeyup=MinMax(this) name='qpd_discount["+qj+"]' class='form-control discount_clz_id' required=''></td><td><input type='number' name='qpd_amount["+qj+"]' class='form-control amount_clz_id' readonly></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");
            
            $(".product-more2").append("<tr class='prod_row quot_row_leng add_prod_row'><td><select class='form-select add_sales_order' name='pvp_sales_order["+qj+"]'><option value='' selected disabled>Select Sales Order</option><?php foreach($sales_orders as $sales_order){?><option value='<?php echo $sales_order->so_reffer_no;?>'><?php echo $sales_order->so_reffer_no;?></option><?php } ?></select></td><td><select class='form-select add_products' name='pvp_product_desc["+qj+"]' required=''><option value='' selected Products>Select Product Description</option><?php foreach($products as $product){?><option value='<?php echo $product->product_details;?>'><?php echo $product->product_details;?></option><?php } ?></select></td><td><select class='form-select debit_account' name='debit_account["+qj+"]' required=''><option value='' selected Debits>Select Sales Order</option><?php foreach($debit_accounts as $debit_acc){?><option value='<?php echo $debit_acc->ca_id;?>'><?php echo $debit_acc->ca_name;?></option><?php } ?></select></td><td><input type='number' name='pvp_qty["+qj+"]' class='form-control add_prod_qty' required=''></td><td><input type='text' name='pvp_unit["+qj+"]' class='form-control ' required=''></td><td><input type='number' name='pvp_rate["+qj+"]' class='form-control add_prod_rate' required=''></td><td><input type='number' name='pvp_discount["+qj+"]' class='form-control add_discount' required=''></td><td><input type='text' name='pvp_amount["+qj+"]' class='form-control add_prod_amount' required=''></td><td class='remove-btnpp product_delete' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");
                

            }

          
            InitSalesSelectAdd();

            InitProductSelectAdd();

            InitDebitSelectAdd();

        });


       /******/





       /*edit product delete section start*/
       
       $("body").on('click', '.product_delete_data', function(){ 

            var id = $(this).data('id');

            var rowToDelete = $(this).closest('tr');

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/DeleteProdDet",

                method : "POST",

                data:{ID: id},

                success:function(data)
                { 
                    var data = JSON.parse(data);

                    rowToDelete.fadeOut(500, function() {
                        $(this).remove();
                        //deleteSlno();
                        //EditProdTotal()
                        alertify.success('Data Delete Successfully').delay(3).dismissOthers();

                        if(data.status === "true")
                        {
                            $('#EditModal').modal('hide');
                        }

                        datatable.ajax.reload(null,false);


                    }); 

                
                }


            });

        });


       /*edit product delete section end*/


       /*edit single prod section start*/

        $("body").on('keyup', '.edit_prod_dis, .edit_prod_qty, .edit_prod_rate', function(){ 

            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.edit_single_prod_row').find('.edit_prod_dis').val())||0;

            var $discountSelectElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_prod_rate');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_prod_qty');

            var quantity = parseInt($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;

            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.edit_single_prod_row').find('.edit_prod_amount');

            $amountElement.val(orginalPrice);

           

        });


       /*edit single prod section end*/


       
        $('.close_single_prod').click(function(){

            $('#EditProdModal').modal('hide');
            
            $('#EditModal').modal('show');


        });
         

        $('.vendor_con_close').click(function(){

            $('#AddNewContact').modal('hide');

            $('#AddPurchaseVoucher').modal('show');


        });


        $('.cust_close_modal').click(function(){

            $('#AddVendor').modal('hide');

            $('#AddPurchaseVoucher').modal('show');


        });


        


        

       



        /*add section end*/


        
        /*view section start*/

       
        $("body").on('click', '.view_btn', function(){ 

            var id = $(this).data('id');
           
            /*$('#purchase_form')[0].reset();
            $('.add_vendor').val('').trigger('change');
            $('#AddPurchaseOrder').modal('hide');
            $('.add_prod_remove').remove();
            $('.hidden_recived_id').val("");*/
            
           
            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/View",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {

                    var data = JSON.parse(data);

                    console.log(data.reffer_id);

                    $('.view_ref').val(data.reffer_id);

                    $('.view_date').val(data.date);

                    $('.view_vendor_name').val(data.vendor_name);

                    $('.view_contact_person').val(data.contact_person);

                    $('.view_purchase_order').val(data.purchase_order);

                    $('.view_vendor_inv_ref').val(data.vendor_inv);

                    $('.view_delivery_note').val(data.delivery_note);

                    $('.view_payment_term').val(data.payment_term);

                    $('.view_prod_data').html(data.prod_desc);

                    $('.view_total_amount').val(data.total_amount);

                    

                }
            });

            $('#ViewModal').modal('show');

        });
 

        /*view section end*/




        /*edit section start*/


        $("body").on('click', '.edit_btn', function(){ 

            var id = $(this).data('id');

           

            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/Edit",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {

                    var data = JSON.parse(data);

                    console.log(data.reffer_id);

                    $('.edit_ref').val(data.reffer_id);

                    $('.edit_date').val(data.date);

                    $('.edit_vendor_name').val(data.vendor_name);

                    $('.edit_contact_person').val(data.contact_person);

                    $('.edit_purchase_order').val(data.purchase_order);

                    $('.edit_vendor_inv_ref').val(data.vendor_inv);

                    $('.edit_delivery_note').val(data.delivery_note);

                    $('.edit_payment_term').val(data.payment_term);

                    $('.edit_prod_data').html(data.prod_desc);

                    $('.edit_purchase_id').val(data.purchase_id);

                    $('.edit_total_amount').val(data.total_amount);


                }
            });

            $('#EditModal').modal('show');

        });



        /*edit single prod start*/


        $("body").on('click', '.edit_prod_btn', function(){ 

            var id = $(this).data('id');



            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/EditSingleProd",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {

                    var data = JSON.parse(data);

                    $('.edit_single_prod').html(data.prod_desc);

                    

                }
            });

            $('#EditProdModal').modal('show');

            $('#EditModal').modal('hide');



        });


        /*edit single prod end*/



        $(function() {
            var form = $('#edit_purchase_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    //if($('#purchase_form').attr('data_fill')=="true"){   

                        // Submit the form for the current tab
                        $.ajax({
                            url: "<?php echo base_url(); ?>Procurement/PurchaseVoucher/Update",
                            method: "POST",
                            data: $(currentForm).serialize(),
                            success: function(data) {
                                
                                $('#EditModal').modal('hide');
                            
                                alertify.success('Data Updated Successfully').delay(3).dismissOthers();
                            
                                datatable.ajax.reload(null, false);
                             
                            }
                        });

                }
            });
        });



        /*edit section end*/


        /*edit single prod start*/


        $(function() {
            var form = $('#update_single_prod');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} , // To Hide Validation Messages
                submitHandler: function(currentForm) {
                    //if($('#purchase_form').attr('data_fill')=="true"){   

                        // Submit the form for the current tab
                        $.ajax({
                            url: "<?php echo base_url(); ?>Procurement/PurchaseVoucher/UpdateSingleProd",
                            method: "POST",
                            data: $(currentForm).serialize(),
                            success: function(data) {
                                
                                $('#EditProdModal').modal('hide');
                            
                                alertify.success('Data Updated Successfully').delay(3).dismissOthers();
                            
                                datatable.ajax.reload(null, false);
                             
                            }
                        });

                }
            });
        });


        /*edit single prod end*/



        




        /*delete section start*/

        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            
            $.ajax({

                url : "<?php echo base_url(); ?>Procurement/PurchaseVoucher/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                   // var data = JSON.parse(data);
                    
                    /*if(data.status == "true")
                    {
                        alertify.success('Data Deleted Successfully').delay(2).dismissOthers();

                        datatable.ajax.reload(null,false);
                    }
                    else
                    {
                        alertify.error("Sales Quotation In Use Cant't Delete").delay(2).dismissOthers();
                    }*/

                    alertify.success('Data Deleted Successfully').delay(2).dismissOthers();

                    datatable.ajax.reload(null,false);
                   
                }

            });

        });


        /*delete section end*/




    });



    /*checkbox section start*/

     var checkedIds = [];

    //checkedIds.splice(0)

    checkedIds.length = 0;

    
    // Check All function

    function checkAll(checkbox) 
    {
        var checkboxes = document.getElementsByClassName('prod_checkmark');

        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = checkbox.checked;
            handleCheckboxChange(checkboxes[i]); // Update the array and modal form
        }
    }

    // Handle individual checkbox change
    function handleCheckboxChange(checkbox) 
    {   
        //checkedIds.length = 0;

        if (checkbox.checked) {
            // Add the ID to the array if checked
            checkedIds.push(checkbox.id);
        } else {
            // Remove the ID from the array if unchecked
            checkedIds = checkedIds.filter(id => id !== checkbox.id);
        }

        // Log the current state of checked IDs
        //console.log('Checked IDs: ', checkedIds);
        document.getElementById('select_prod_id').value = checkedIds.join(',');
    }


/*checkbox section end*/


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