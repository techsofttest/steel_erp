<style>
.left_input .row
{
    justify-content: unset;
   
}
.row_align
{
    display: flex;
    align-items: center;
    justify-content: unset !important;
}



.tecs span {
    font-size: 14px;
}

.droup_color{

color: black !important;
margin-bottom: 0px;
width: 100% !important;
padding: 0px;
display: block;
border-radius: 4px;
background: #f5f5f5bd;
border: none !important;
height: 37px !important;
}
.content_table tr {
    text-align: unset !important;
    border: 1px solid black !important;
}

.droup_color{

color: black !important;
margin-bottom: 0px;
width: 100% !important;
padding: 0px;
display: block;
border-radius: 4px;
background: #f5f5f5bd;
border: none !important;
height: 37px !important;
}
.content_table table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid black;
}
.add_table {
    margin-bottom: 0px;
}
.total_table {
    width: 22% !important;
   
}
span.select2.customer_width, span.select2 {
   
    display: flex;
    align-items: center;

}
.view_prod td{

    padding:10px 10px;
}
.edit_prod td{

    padding:10px 10px;
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
                        
                        <!--add porforma invoice section start-->

                        <div class="modal fade" id="PerformaInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="add_form1">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pro-forma Invoice</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row row_padding">
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">

                                                             
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pf_reffer_no" id="uid" value="" class="form-control input_length " required readonly>
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
                                                                        <input type="text" name="pf_date" autocomplete="off" class="form-control datepicker_ap input_length " required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                    <label for="basicInput" class="form-label">Customer</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        

                                                                        <select class="form-select customer_sel customer_clz_id input_length " name="pf_customer" id="customer_id " required>
                                                               
                                                                        </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order Number</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <select class="form-select sales_order_add_clz input_length " name="pf_sales_order"  required>

                                                            
                                                            
                                                                        </select>
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                           
                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">LPO Reference</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pf_lpo_ref" class="form-control lpo_reff input_length " required>
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
                                                                        <label for="basicInput" class="form-label">Sales Executive</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select sales_excutive_clz input_length"  name="pf_sales_executive" required></select>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select contact_person_clz input_length " name="pf_contact_person" id="contact_person_id" required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                
                                                                        </select>
                                                                       
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pf_payment_terms" class="form-control payment_term_clz input_length " required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                       
                                                                        <input type="text" name="pf_delivery_terms" class="form-control delivery_term input_length " required>
                                                                        
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
                                                                        <input type="text" name="pf_project" class="form-control project_clz input_length ">
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                             



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4 content_table">
                                                    <table class="table table-bordered table-striped delTable add_table">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td style="width:4%">SI</td>
                                                                <td>Product Description</td>
                                                                <td style="width:6%">Unit</td>
                                                                <td style="width:6%">Qty</td>
                                                                <td style="width:6%">Rate</td>
                                                                <td style="width:7%">Discount</td>
                                                                <td style="width:9%">Amount</td>
                                                                <td style="width:4%"></td>
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo product-more2"></tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs" style="padding: 10px 10px;">
                                                                    <span class="add_icon add_product2"><i class="ri-add-circle-line"></i>Add Product</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                       
                                                    </table>
                                                    <table class="total_table">
                                                        <tbody>
                                                            <tr>
                                                               
                                                                
                                                                <td align="right" class="total_label">Total Order value</td>
                                                                <td><input type="text" name="pf_total_amount" class="amount_total form-control text-end" readonly></td>
                                                                <td></td>
                                                            
                                                            </tr>


                                                            <tr>
                                                               
                                                                
                                                                <td align="right" class="total_label">Current Claim %</td>
                                                                <td><input type="number" name="pf_current_cliam" onkeyup="currentClaim()" class="form-control current_cliam_clz text-end" required></td>
                                                                <td></td>
                                                            </tr>


                                                            <tr>
                                                                
                                                               
                                                                <input type="hidden" name="pf_total_amount_in_words" class="performa_amount_in_word_val">
                                                                <td align="right" class="total_label">Current Claim Value -QAR</td>
                                                                <td><input type="number" name="pf_current_claim_value" class="form-control claim_qar text-end" readonly></td>
                                                                <td></td>

                                                            </tr>
                                                            
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <!--<div class="row row_align mb-4">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name="pf_file"  class="form-control" >
                                                            </div>

                                                        </div>--->


                                                        
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    <!--<div class="col-lg-6">
                                                        <div style="float: right;">
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
                                                        </div>

                                                    </div>--->
                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>

                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success once_form_submit" type="submit">Save</button>
                                            <span><button class="btn btn btn-success once_form_submit" name="print_btn" type="submit" value="1">Print</button></span>
                                        </div>



                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>
                        
                        <!--add porforma invoice section end-->


                        <!--view proforma invoice section start-->
                         
                        <div class="modal fade" id="ViewProformaInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pro-forma Invoice</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row row_padding">
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">

                                                             
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text"  id=""  class="form-control view_reff"  readonly>
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
                                                                        <input type="text" class="form-control view_date" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                    <label for="basicInput" class="form-label">Customer</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text"  class="form-control view_customer" readonly>

                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order Number</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <input type="text"  class="form-control view_sales_order" readonly>
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                           
                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">LPO Reference</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text"  class="form-control view_lpo_reff" readonly>
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
                                                                        <label for="basicInput" class="form-label">Sales Executive</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text"  class="form-control view_sales_exec" readonly>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <input type="text"  class="form-control view_contact_person" readonly>
                                                                       
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" class="form-control view_payment_term" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                       
                                                                        <input type="text" class="form-control view_delivery_term" readonly>
                                                                        
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
                                                                        <input type="text" class="form-control view_project" readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                             



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4 content_table">
                                                    <table class="table table-bordered table-striped delTable add_table">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td class="text-center" style="width: 4%;">SI</td>
                                                                <td class="text-center">Product Description</td>
                                                                <td class="text-center" style="width: 6%;">Unit</td>
                                                                <td class="text-center" style="width: 6%;">Qty</td>
                                                                <td class="text-center" style="width: 6%;">Rate</td>
                                                                <td class="text-center" style="width: 7%;">Discount</td>
                                                                <td class="text-center" style="width: 9%;">Amount</td>
                                                              
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo view_prod"></tbody>
                                                       
                                                        
                                                    </table>
                                                    <table class="total_table">
                                                        <tbody>
                                                            <tr>
                                                                
                                                               
                                                                
                                                                <td align="right" class="total_label">Total Order value</td>
                                                                <td><input type="text" class="view_amount_total form-control text-end" readonly></td>
                                                            </tr>


                                                            <tr>
                                                               
                                                                
                                                                
                                                                <td align="right" class="total_label">Current Claim %</td>
                                                                <td><input type="number" class="form-control view_current_claim text-end" readonly></td>
                                                            </tr>


                                                            <tr>
                                                               
                                                               
                                                                <td align="right" class="total_label">Current Claim Value</td>
                                                                <td><input type="text" class="form-control view_current_claim_value text-end" readonly></td>
                                                            </tr>
                                                            
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="card-body image_table_clz" style="float: inline-start;"></div>


                                                        
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    <!---<div class="col-lg-6">
                                                        <div style="float: right;">
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
                                                        </div>

                                                    </div>---->
                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                      

                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>

                        <!--view proforma invoice section end-->


                        <!--edit performa invoice section start-->

                        <div class="modal fade" id="EditPerformaInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_performa_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pro-forma Invoice</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                <div class="row row_padding">
                                                 
                                                    <div class="col-lg-6">

                                                        <div class="row">

                                                             
                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basiInput" class="form-label">Referance</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pf_reffer_no" id=""  class="form-control edit_reff input_length" required readonly>
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
                                                                        <input type="text" name="pf_date" autocomplete="off" class="form-control edit_date datepicker input_length" required readonly>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                    <label for="basicInput" class="form-label">Customer</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        

                                                                        <select class="form-select edit_customer input_length" name="pf_customer" id="" required>
                                                               
                                                                        </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order Number</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <select class="form-select edit_sales_order input_length" name="pf_sales_order"  required>

                                                            
                                                            
                                                                        </select>
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                           
                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">LPO Reference</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pf_lpo_ref" class="form-control edit_lpo_ref input_length" required>
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
                                                                        <label for="basicInput" class="form-label">Sales Executive</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select edit_sales_exec input_length"  name="pf_sales_executive" required></select>
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Contact Person</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select edit_contact input_length" name="pf_contact_person" id="" required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                
                                                                        </select>
                                                                       
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pf_payment_terms" class="form-control edit_payment_term input_length" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2 margin_zero">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                       
                                                                        <input type="text" name="pf_delivery_terms" class="form-control edit_delivery datepicker input_length" required>
                                                                        
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
                                                                        <input type="text" name="pf_project" class="form-control edit_project input_length">
                                                                    </div>

                                                                </div> 

                                                            </div>
                                                            
                                                            <input type="hidden" name="pf_id" class="edit_performa_id" value="">

                                                            <!-- ### --> 


                                                             



                                                        </div>

                                                    </div>
                                                                                          

                                                </div>


                                                <!--table section start-->
                                                <div class="mt-4 content_table">
                                                    <table class="table table-bordered table-striped delTable add_table">
                                                        <thead class="travelerinfo contact_tbody">
                                                            <tr>
                                                                <td style="width: 4%;">SI</td>
                                                                <td>Product Description</td>
                                                                <td style="width: 6%;">Unit</td>
                                                                <td style="width: 6%;">Qty</td>
                                                                <td style="width: 6%;">Rate</td>
                                                                <td style="width: 7%;">Discount</td>
                                                                <td style="width: 9%;">Amount</td>
                                                                <td style="width: 14%;">Action</td>
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo edit_prod"></tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs" style="padding: 10px 10px;">
                                                                    <span class="add_icon edit_add_prod"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        
                                                    </table>
                                                    <table class="total_table">
                                                        <tbody>
                                                            <tr>
                                                                
                                                               
                                                                <td align="right" class="total_label">Total Order value</td>
                                                                <td><input type="text" name="" class="form-control edit_total_order text-end" readonly></td>
                                                                <td></td>
                                                            </tr>


                                                            <tr>
                                                                
                                                                
                                                                <td align="right" class="total_label">Current Claim %</td>
                                                                <td><input type="number" name="pf_current_cliam" class="form-control edit_current_claim text-end" required></td>
                                                                <td></td>
                                                            </tr>


                                                            <tr>
                                                                
                                                                
                                                                <input type="hidden" name="pf_total_amount_in_words" class="">
                                                                <td align="right" class="total_label">Current Claim Value -QAR</td>
                                                                <td><input type="text" name="" class="form-control edit_current_claim_value text-end" readonly></td>
                                                                <td></td>
                                                            </tr>
                                                            
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <!--<div class="card-body edit_image_table" style="float: inline-start;"></div>--->

                                                        
                                                    </div>
                                                    <div class="col-lg-6"></div>
                                                    <!--<div class="col-lg-6">
                                                        <div style="float: right;">
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
                                                        </div>

                                                    </div>--->
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

                        <!--edit add product section start-->

                        <div class="modal fade" id="EditAddProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_add_prod_form">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                                            <button type="button" class="btn-close edit_close_sub_modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                
                                                <!--table section start-->
                                                <div class="mt-4 content_table" style="padding-top:0px">
                                                    <table class="table table-bordered table-striped delTable add_table">
                                                        <thead class="travelerinfo">
                                                            
                                                            <tr>
                                                               
                                                                <td>Product Description</td>
                                                                <td style="width: 6%;">Unit</td>
                                                                <td style="width: 6%;">Qty</td>
                                                                <td style="width: 6%;">Rate</td>
                                                                <td style="width: 7%;">Discount</td>
                                                                <td style="width: 9%;">Amount</td>
                                                                
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <tr class="edit_add_prod_row">
                                                               
                                                                <td>
                                                                    <select class="form-select  edit_product_det" name="pp_product_det" required>
                                                                        
                                                                        <option value="" selected disabled>Select Product Description</option>
                                                                       
                                                                    </select>
                                                                </td>

                                                                <td><input type="text"   name="pp_unit" class="form-control text-center" required></td>
                                                                <td><input type="number" name="pp_quantity" class="form-control edit_add_qty text-center" required></td>
                                                                <td><input type="number" name="pp_rate" class="form-control edit_add_rate text-end" required></td>
                                                                <td><input type="number" name="pp_discount" min="0" max="100" onkeyup="MinMax(this)" class="form-control edit_add_discount text-center" required></td>
                                                                <td><input type="number" name="pp_amount" class="form-control edit_add_amount text-end" readonly></td>
                                                                
                                                                <input type="hidden" name="pp_proforma" class="edit_hidden_performa_id">

                                                            </tr>
                                                           
                                                        </tbody>
                                                       
                                                       
                                                    </table>
                                                </div>


                                                <div class="modal-footer justify-content-center">
                                                    
                                                    <button class="btn btn btn-success">Save</button>

                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                            
					                           
						                    
				                        </div>

                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--edit add product section end-->


                        <!--edit performa invoice start-->

                        <div class="modal fade" id="EditProduct" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                        <div class="modal-dialog modal-xl">
		                        <form  class="Dashboard-form class" id="edit_product">
			                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                                            <button type="button" class="btn-close edit_close_sub_modal" aria-label="Close"></button>
                                        </div>

				                        <div class="modal-body">

                                            <div class="live-preview">
                                                
                                                
                                                <!--table section start-->
                                                <div class="mt-4 content_table" style="padding-top: 0px;">
                                                    <table class="table table-bordered table-striped delTable add_table">
                                                        <thead class="travelerinfo">
                                                            <tr>
                                                                
                                                                <td>Product Description</td>
                                                                <td style="width: 6%;">Unit</td>
                                                                <td style="width: 6%;">Qty</td>
                                                                <td style="width: 6%;">Rate</td>
                                                                <td style="width: 7%;">Discount</td>
                                                                <td style="width: 9%;">Amount</td>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="edit_product_row">
                                                               
                                                                <td >
                                                                    <select class="form-select  edit_cost_product_det forma_edit_prod" name="pp_product_det" required>
                                                                        <option selected>Select Product Description</option>
                                                                       
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="pp_unit"  class="form-control forma_edit_unit text-center" required></td>
                                                                <td><input type="number" name="pp_quantity" class="form-control forma_edit_qty text-center" required></td>
                                                                <td><input type="number" name="pp_rate" class="form-control forma_edit_rate text-end" required></td>
                                                                <td><input type="number" name="pp_discount"  min="0" max="100"  onkeyup="MinMax(this)" class="form-control forma_edit_discount text-center" required></td>
                                                                
                                                                <td><input type="number" name="pp_amount" class="form-control forma_edit_amount text-end" readonly></td>
                                                               
                                                                <input type="hidden" name="pp_id" class="edit_hidden_prod_id">
                                                            </tr>
                                                           
                                                        </tbody>
                                                       
                                                       
                                                    </table>
                                                </div>


                                                <div class="modal-footer justify-content-center">
                                                    
                                                    <button class="btn btn btn-success">Save</button>

                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                                           
						                    
				                        </div>

			                        </div>
		                        </form>

	                        </div>
                        </div>


                        <!--edit performa invoice end-->

                        

                        <!--edit performa  invoice section end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Pro-Forma Invoice</h4>
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
                                                    <th>Sales Order No</th>
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
         

        /*add section start*/


        /*add section*/    
        $(function() {
            var form = $('#add_form1');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {
                    var formData = new FormData(currentForm);

                    $('.once_form_submit').attr('disabled', true); // Disable this input.
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/ProFormaInvoice/Add",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
                            
                            var data = JSON.parse(data);

                            $('#add_form1')[0].reset();

                            $('#PerformaInvoice').modal('hide');

                            $('.customer_clz_id').val('').trigger('change');

                            $('.sales_excutive_clz').val('').trigger('change');

                            $('.contact_person_clz').val('').trigger('change');

                            $('.sales_order_add_clz').val('').trigger('change');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                            
                           

                            if(data.print!="")
                            {
                                //window.open(data.print, '_blank');

                                id = data.print;
                                // Open the PDF generation script in a new window

                                var pdfWindow = window.open('<?= base_url()?>Crm/ProFormaInvoice/Pdf/'+id, '_blank');

                                // Automatically print when the PDF is loaded
                                pdfWindow.onload = function() {
                                    pdfWindow.print();
                                };

                            }
                            
                        }
                    });
                }
            });
        });


        


        /**/ 
        $("body").on('change', '.sales_order_add_clz', function(){ 

            $('.performa_remove').remove();

            var id = $(this).val();

            var cus_id = $('.customer_clz_id').val()

            if(id && cus_id!=null){
            
                $.ajax({

                    url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/SalesOrder",

                    method : "POST",

                    data: {
                            ID: id,
                            cusID: cus_id,
                        },

                    success:function(data)
                    {   
                        var data = JSON.parse(data);

                        //console.log(data.contact_person);

                        $(".delivery_term").val(data.so_delivery_term);

                        $(".project_clz").val(data.so_project);

                        $(".contact_person_clz").html(data.contact_person);

                        $(".sales_excutive_clz").html(data.sales_executive);

                        $(".lpo_reff").val(data.so_lpo);

                        $(".product-more2").append(data.sales_order_contact);

                        $(".delivery_term").removeClass("error");

                        $(".project_clz").removeClass("error");

                        $(".lpo_reff").removeClass("error");

                        $(".sales_excutive_clz").removeClass("error");

                        $(".contact_person_clz").removeClass("error");

                        slno();

                        reName();

                        TotalAmount();

                        InitProductSelectAdd2();

                    
                        
                    }


                });

            }
            
            
        });
        /*####*/



       /* Select 2 Remove Validation On Change */
       $("select[name=pf_customer]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
        });
        /*###*/


        /*data table start*/ 

        function initializeDataTable() {

            datatable = $('#DataTable').DataTable({
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': 
            {
                'url': "<?php echo base_url(); ?>Crm/ProFormaInvoice/FetchData",
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
                { data: 'pf_id' },
                { data: 'pf_reffer_no' },
                { data: 'pf_date'},
                { data: 'pf_customer'},
                { data: 'pf_sales_order'},
                { data: 'action'},
                
               ],

               "initComplete": function () {

                    var dataId = '<?php echo isset($_GET['view_so']) ? $_GET['view_so'] : ''; ?>';

                    $('#DataTable').dataTable().fnFilter(dataId);

                },

                "drawCallback": function() {
                
                

                $('.view_btn[data-id="<?php echo isset($_GET['view_so']) ? $_GET['view_so'] : ''; ?>"]').trigger('click');

                }
    
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/

       /* $("body").on('change', '#customer_id', function(){ 

            var id = $(this).val();
           

            if(id!=null){ 

                //Fetch Contact Person
                $.ajax({

                url : "<?php //echo base_url(); ?>Crm/ProFormaInvoice/FetchOrders",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                  
                    
                }

                });

            } 




        });*/


        /*customer droup drown search*/
        $(".customer_sel").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#PerformaInvoice'),
            ajax: {
                url: "<?= base_url(); ?>Crm/ProFormaInvoice/FetchCustomers",
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
                    //  NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                   
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


        /* add product select start*/

        /*function InitProductSelectAdd(){
            $(".add_prod:last").select2({
                placeholder: "Select Product",
                theme : "default form-control- droup_color select_width",
                dropdownParent: $($('.add_prod:last').closest('.prod_row')),
                ajax: {
                    url: "<?= base_url(); ?>Crm/SalesQuotation/FetchCostMetal",
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

        InitProductSelectAdd();*/

        function InitProductSelectAdd() {
                $('body .add_prod').each(function() {
                $(this).select2({
                    placeholder: "Select Product",
                    theme: "default form-control- droup_color select_width",
                    dropdownParent: $($(this).closest('.prod_row')),
                    ajax: {
                        url: "<?= base_url(); ?>Crm/SalesQuotation/FetchCostMetal",
                        dataType: 'json',
                        delay: 250,
                        cache: false,
                        minimumInputLength: 1,
                        allowClear: false,
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
                                        id: item.product_id ,
                                        text: item.	product_details
                                    }
                                }),
                                pagination: {
                                    more: (page * 10) <= data.total_count
                                }
                            };
                        },
                    }
                })

            });


        }

        InitProductSelectAdd()
        /*add product select end*/


        /**/

        function InitProductSelectAdd2() {
                $('body .add_prod2').each(function() {
                $(this).select2({
                    placeholder: "Select Product",
                    theme: "default form-control- droup_color select_width",
                    dropdownParent: $($(this).closest('.prod_row')),
                    ajax: {
                        url: "<?= base_url(); ?>Crm/SalesQuotation/FetchCostMetal",
                        dataType: 'json',
                        delay: 250,
                        cache: false,
                        minimumInputLength: 1,
                        allowClear: false,
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
                                        id: item.product_id ,
                                        text: item.	product_details
                                    }
                                }),
                                pagination: {
                                    more: (page * 10) <= data.total_count
                                }
                            };
                        },
                    }
                })

            });


        }

        /**/


        /**/

        function InitProductSelectEdit() {
                $('body .edit_cost_product_det').each(function() {
                $(this).select2({
                    placeholder: "Select Product",
                    theme: "default form-control- droup_color select_width",
                    dropdownParent: $($(this).closest('.prod_row')),
                    ajax: {
                        url: "<?= base_url(); ?>Crm/SalesQuotation/FetchCostMetal",
                        dataType: 'json',
                        delay: 250,
                        cache: false,
                        minimumInputLength: 1,
                        allowClear: false,
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
                                        id: item.product_id ,
                                        text: item.	product_details
                                    }
                                }),
                                pagination: {
                                    more: (page * 10) <= data.total_count
                                }
                            };
                        },
                    }
                })

            });


        }

        /**/

        



        /* Fetch Sales Orders */


        $('.customer_clz_id').change(function(){

            var id = $(this).val();
             
            if(id!=null){

                $.ajax({

                url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/FetchOrders",

                method : "POST",

                data : {id:id},

                success:function(data)
                {
                    var data = JSON.parse(data);

                    $('.sales_order_add_clz').html(data.orders);

                    $('.contact_person_clz').html(data.contact_person);

                    $('.payment_term_clz').val(data.payment_terms);

                    $('.payment_term_clz').removeClass("error"); 

                    $("#contact_person_id").html(data.customer_name);

                  

                }


                });

            }


        });



        /* ################## */



        /*enquiry droup drown search*/
        $(".ser_product_det").select2({
            placeholder: "Product Description",
            theme : "default form-control-",
            dropdownParent: $('#AddModal'),
            ajax: {
                url: "<?= base_url(); ?>Crm/Enquiry/FetchTypes1",
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
                    //  NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                    //console.log(data);
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
        /*###*/



        /*product detail calculation*/
        
        $("body").on('keyup', '.discount_clz_id , .qtn_clz_id , .rate_clz_id', function(){ 
           
            var $discountSelect = $(this);

            var discount = parseFloat($discountSelect.closest('.prod_row').find('.discount_clz_id').val())||0;
            
            var $discountSelectElement = $discountSelect.closest('.prod_row').find('.rate_clz_id');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.prod_row').find('.qtn_clz_id');

            var quantity = parseFloat($quantitySelectElement.val())||0;

            var parsedRate = parseFloat(rate);

            var parsedQuantity = quantity; 

            var multipliedTotal = parsedRate * parsedQuantity;

            var per_amount = (discount/100)*multipliedTotal;
           
            var orginalPrice = multipliedTotal - per_amount;

            var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            var $amountElement = $discountSelect.closest('.prod_row').find('.amount_clz_id');

            $amountElement.val(orginalPrice);

            TotalAmount();

        });

        
        /*total amount calculation start*/

        function TotalAmount()
        {

            var total= 0;

            $('body .amount_clz_id').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
               //total = Number(total).toFixed(2)
            });

           total = total.toFixed(2);

           $('.amount_total').val(total);

           //var resultSalesOrder= numberToWords.toWords(total);

           // $(".performa_amount_in_word").text(resultSalesOrder);

           // $(".performa_amount_in_word_val").val(resultSalesOrder);
                
            //currentClaim()

           
        }

        /*total amount calculation end*/




        /**/


    /*product section start*/

    var max_fieldspp      = 30;

    var pp = 1;

    $("body").on('click', '.add_product2', function(){
    
        var pp = $('.prod_row').length;

        var prl = $('.performa_row_lenght').length

        if(pp < max_fieldspp)
        { 
    
            pp++;
            
           // $(".product-more2").append("<tr class='prod_row performa_row_lenght'><td class='si_no'>"+pp+"</td><td><select class='form-select add_prod add_prod2' name='pp_product_det["+prl+"]' required><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo addslashes($prod->product_details);?></option><?php } ?></select></td><td><input type='text' name='pp_unit["+prl+"]' class='form-control unit_clz_id' required></td><td><input type='number' name='pp_quantity["+prl+"]' class='form-control qtn_clz_id' required></td><td><input type='number' name='pp_rate["+prl+"]' class='form-control rate_clz_id' required=''></td><td><input type='number' name='pp_discount["+prl+"]' min='0' max='100' onkeyup='MinMax(this)' class='form-control discount_clz_id' required></td><td><input type='number' name='pp_amount["+prl+"]' class='form-control amount_clz_id' readonly></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i></div></td></tr>");
           
           $(".product-more2").append("<tr class='prod_row performa_row_lenght text-center'><td class='si_no'>"+pp+"</td><td><select class='form-select add_prod add_prod2' name='pp_product_det["+prl+"]' required><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo addslashes($prod->product_details);?></option><?php } ?></select></td><td><input type='text' name='pp_unit["+prl+"]' class='form-control unit_clz_id text-center' required></td><td><input type='number' name='pp_quantity["+prl+"]' class='form-control qtn_clz_id text-center' required></td><td><input type='number' name='pp_rate["+prl+"]' class='form-control rate_clz_id text-end' required=''></td><td><input type='number' name='pp_discount["+prl+"]' min='0' max='100' onkeyup='MinMax(this)' class='form-control discount_clz_id text-center' required></td><td><input type='number' name='pp_amount["+prl+"]' class='form-control amount_clz_id text-end' readonly></td><td class='remove-btnpp text-center' colspan='6' style='padding: 10px 10px;'><div class='remainpass'><i class='ri-close-line'></i></div></td></tr>");

        }

        slno();

        InitProductSelectAdd();

    });

    $(document).on("click", ".remove-btnpp", function() 
    {

        $(this).parent().remove();
        slno();
        reName();
        TotalAmount();
    });

    /**/

    /*rename product start*/
         
    function reName(){
            
        var jj = 0;

        $('body .performa_row_lenght').each(function() {
            
            $(this).closest('.performa_row_lenght').find('.add_prod2').attr('name', 'pp_product_det['+jj+']');

            $(this).closest('.performa_row_lenght').find('.unit_clz_id').attr('name', 'pp_unit['+jj+']');

            $(this).closest('.performa_row_lenght').find('.qtn_clz_id').attr('name', 'pp_quantity['+jj+']');
                    
            $(this).closest('.performa_row_lenght').find('.rate_clz_id').attr('name', 'pp_rate['+jj+']');

            $(this).closest('.performa_row_lenght').find('.discount_clz_id').attr('name', 'pp_discount['+jj+']');

            $(this).closest('.performa_row_lenght').find('.amount_clz_id').attr('name', 'pp_amount['+jj+']');

            jj++;

        });
    }

    /*rename product end*/

    /*serial no correction section start*/

    function slno(){

        var pp =1;

        $('body .prod_row').each(function() {

            $(this).find('.si_no').html('<td class="si_no text-center" style="border: unset;padding:10px 10px;">' + pp + '</td>');

            pp++;
        });

    }

    /*###*/


    /* Product Init Select 2 */


    function InitProductSelect2(){
        $(".add_prod:last").select2({
            placeholder: "Select Product",
            theme : "default form-control-",
            dropdownParent: $($('.add_prod:last').closest('.prod_row')),
            ajax: {
                url: "<?= base_url(); ?>Crm/ProFormaInvoice/FetchProducts",
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

        InitProductSelect2();


    $('.add_model_btn').click(function(e){

        $('.once_form_submit').attr('disabled',false); // Disable this input.

        $('#add_form1')[0].reset();

        $('.sales_excutive_clz option').remove();

        $('.contact_person_clz option').remove();

        $('.customer_clz_id').val('').trigger('change');

        $('.customer_clz_id').val('').trigger('change');

        $('body').find('.performa_remove').remove();

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/AddAccess",

            method : "POST",

            success:function(data)
            {

                var data = JSON.parse(data);

                if(data.status === 0){
                
                    alertify.error(data.msg).delay(3).dismissOthers();

                }
                else{

                    $('#PerformaInvoice').modal('show');

                }
                

            }

        });


        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/FetchReference",

            method : "GET",

            success:function(data)
            {

                $('#uid').val(data);


            }

        });

        

    });


    /* ### */


    /*check discount section start*/

    $("body").on('keyup', '.discount_clz_id', function(){ 


        var dataSelect = $(this);

        var prod_id = $(this).data('id');

        var discountSelectElement = dataSelect.closest('.performa_remove').find('.discount_clz_id');

        var discount = parseFloat(discountSelectElement.val()) || 0; // Convert to number, default to 0 if NaN

        if(discount > 100)
        {   
            var discountNull = discountSelectElement.val("");

            var discountNullElement = dataSelect.closest('.performa_remove').find('.discount_clz_id');

            discountNullElement.val(discountNull);

            alertify.error('Discount Should Not Greater Than 100').delay(3).dismissOthers();
          
        }
      

    });


    /*check discount section end*/


    /*claim section start*/


    $("body").on('keyup', '.current_cliam_clz', function(){ 

        var current_claim = $('.current_cliam_clz').val();


        if(current_claim > 100)
        {   
            $('.current_cliam_clz').val("")

            alertify.error('Discount Should Not Greater Than 100').delay(3).dismissOthers();
          
        }

        var sales_order = $('.sales_order_add_clz').val();


        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/Claim",

            method : "POST",

            data: {salesOrder: sales_order},

            success:function(data)
            {
                var data = JSON.parse(data);

                var remain_claim = data.remaining_claim;


                if(remain_claim !=="" ){

                    if(remain_claim < current_claim )
                    {
                            $('.current_cliam_clz').val("")

                            alertify.error('Maximun Current Claim Is '+remain_claim+'').delay(3).dismissOthers();
                    }

                }

                
            }
        });

       
       

    });


    /*claim section end*/



    /*add section end*/


    /*view section start*/
    
    $("body").on('click', '.view_btn', function(){ 

        var id = $(this).data('id');

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/View",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {
                var responseData = JSON.parse(data);

                $(".view_reff").val(responseData.reff_no);

                $(".view_date").val(responseData.date);

                $(".view_customer").val(responseData.customer);

                $(".view_sales_order").val(responseData.sales_order);

                $(".view_lpo_reff").val(responseData.lpo_reff);

                $(".view_sales_exec").val(responseData.sales_executive);

                $(".view_contact_person").val(responseData.contact_person);

                $(".view_payment_term").val(responseData.payment_term);

                $(".view_delivery_term").val(responseData.delivery_term);

                $(".view_project").val(responseData.project);

                $(".view_amount_total").val(responseData.total_amount);

                $(".view_current_claim").val(responseData.current_claim);

                $(".view_current_claim_value").val(responseData.current_claim_value);

                $(".view_prod").html(responseData.prod_details);

                $(".image_table_clz").html(responseData.image_table);

                //console.log(responseData.image_table);

            }

        });

        $('#ViewProformaInvoice').modal('show');

    });

    /*view section end*/



    /*edit section start*/

    $("body").on('click', '.edit_btn', function(){ 

        var id = $(this).data('id');

      

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/Edit",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {   
                var responseData = JSON.parse(data);

                if(responseData.status === 0){

                    alertify.error(responseData.msg).delay(3).dismissOthers();

                }
                else
                {

                    

                    $(".edit_reff").val(responseData.reff_no);

                    $(".edit_date").val(responseData.date);

                    $(".edit_customer").html(responseData.customer);

                    $(".edit_sales_order").html(responseData.sales_order);

                    $(".edit_lpo_ref").val(responseData.lpo_reff);

                    $(".edit_sales_exec").html(responseData.sales_executive);

                    $(".edit_contact").html(responseData.contact_person);

                    $(".edit_payment_term").val(responseData.payment_term);

                    $(".edit_delivery").val(responseData.delivery_term);

                    $(".edit_project").val(responseData.project);

                    $(".edit_total_order").val(responseData.total_amount);

                    $(".edit_current_claim").val(responseData.current_claim);

                    $(".edit_current_claim_value").val(responseData.current_claim_value);

                    console.log(responseData.current_claim_value);

                    $(".edit_performa_id").val(responseData.performa_id);

                    $(".edit_prod").html(responseData.prod_details);

                    $(".edit_image_table").html(responseData.image_table);

                    $('#EditPerformaInvoice').modal('show');
                }
                
           

            }

        });

        

    });


    /* Select 2 Remove Validation On Change */
    $("select[name=pp_product_det]").on("change",function(e) {
            $(this).parent().find(".error").removeClass("error");         
    });
    /*###*/



    //fetch sales order by customer
    $("body").on('change', '.edit_customer', function(){ 

        var id = $(this).val();

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/FetchOrders ",

            method : "POST",

            data: {id: id},

            success:function(data)
            {
                var responseData = JSON.parse(data);

                $('.edit_sales_order').html(responseData.orders);

                $('.edit_contact').html(responseData.contact_person);

                $('.edit_payment_term').val(responseData.payment_terms);

            

            }

        });

        

    });


    //fetch data by sales order

    $("body").on('change', '.edit_sales_order', function(){ 

        
        var id = $(this).val();

        var cus_id = $('.edit_customer').val()
            
        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/SalesOrder",

            method : "POST",

            data: {
                    ID: id,
                    cusID: cus_id,
                },

            success:function(data)
            {   
                var data = JSON.parse(data);

                $(".edit_delivery").val(data.so_delivery_term);

                $(".edit_project").val(data.so_project);

                $(".edit_contact").html(data.contact_person);

                $(".edit_sales_exec").html(data.sales_executive);

                $(".edit_lpo_ref").val(data.so_lpo);

               
                
            }


        });

    });

    //add prod section start

    $("body").on('click', '.edit_add_prod', function(){ 
             
       
        $('#EditAddProduct').modal('show');

        $('#EditPerformaInvoice').modal('hide');

        var performa_id = $('.edit_performa_id').val();

        $('.edit_hidden_performa_id').val(performa_id);

    });

    //product select box

    function InitProductSelect2(){
        $(".edit_product_det:last").select2({
            placeholder: "Select Product",
            theme : "default form-control- droup_color select_width",
            dropdownParent: $($('.edit_product_det:last').closest('.edit_add_prod_row')),
            ajax: {
                url: "<?= base_url(); ?>Crm/ProFormaInvoice/FetchProducts",
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

    InitProductSelect2();


    //edit add calculation section start

    $("body").on('keyup', '.edit_add_discount , .edit_add_qty , .edit_add_rate', function(){ 
           
        var $discountSelect = $(this);

        var discount = parseFloat($discountSelect.closest('.edit_add_prod_row').find('.edit_add_discount').val())||0;
        
        var $discountSelectElement = $discountSelect.closest('.edit_add_prod_row').find('.edit_add_rate');

        var rate = $discountSelectElement.val();

        var $quantitySelectElement = $discountSelect.closest('.edit_add_prod_row').find('.edit_add_qty');

        var quantity = parseFloat($quantitySelectElement.val())||0;

        var parsedRate = parseFloat(rate);

        var parsedQuantity = quantity; 

        var multipliedTotal = parsedRate * parsedQuantity;

        var per_amount = (discount/100)*multipliedTotal;
        
        var orginalPrice = multipliedTotal - per_amount;

        var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

        var $amountElement = $discountSelect.closest('.edit_add_prod_row').find('.edit_add_amount');

        $amountElement.val(orginalPrice);

           //TotalAmount();

    });

    //inset edit add prod
    $(function() {
            var form = $('#edit_add_prod_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {
                    var formData = new FormData(currentForm);
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/ProFormaInvoice/EditAddProd",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
 
                            var responseData = JSON.parse(data);

                            var PerformaID= (responseData.proforma_id);
                            
                            $('.edit_btn[data-id="'+PerformaID+'"]').trigger('click');

                            $('#EditAddProduct').modal('hide');

                            $('#edit_add_prod_form')[0].reset();

                            $('.edit_product_det ').val('').trigger('change');


                            
                        }
                    });
                }
            });
        });


    //prod edit section start
    
    $("body").on('click', '.edit_prod_btn', function(){ 
             
        $('#EditProduct').modal('show');

        $('#EditPerformaInvoice').modal('hide');

        var prod_id = $(this).data('id');

        $('.edit_hidden_prod_id').val(prod_id);

        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/EditProduct",

            method : "POST",

            data: {ID: prod_id},

            success:function(data)
            {   
                var data = JSON.parse(data);

                $(".forma_edit_prod").html(data.product);

                $(".forma_edit_unit").val(data.unit);

                $(".forma_edit_qty").val(data.qty);

                $(".forma_edit_rate").val(data.rate);

                $(".forma_edit_discount").val(data.discount);

                $(".forma_edit_amount").val(data.amount);

                
                InitProductSelectEdit();

                

            }

        });
     
    });


    //edit calculation start
    $("body").on('keyup', '.forma_edit_discount, .forma_edit_qty, .forma_edit_rate', function(){ 
           
           var $discountSelect = $(this);
   
           var discount = parseFloat($discountSelect.closest('.edit_product_row').find('.forma_edit_discount').val())||0;
           
           var $discountSelectElement = $discountSelect.closest('.edit_product_row').find('.forma_edit_rate');
   
           var rate = $discountSelectElement.val();
   
           var $quantitySelectElement = $discountSelect.closest('.edit_product_row').find('.forma_edit_qty');
   
           var quantity = parseFloat($quantitySelectElement.val())||0;
   
           var parsedRate = parseFloat(rate);
   
           var parsedQuantity = quantity; 
   
           var multipliedTotal = parsedRate * parsedQuantity;
   
           var per_amount = (discount/100)*multipliedTotal;
           
           var orginalPrice = multipliedTotal - per_amount;
   
           var orginalPrice = orginalPrice.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present
   
           var $amountElement = $discountSelect.closest('.edit_product_row').find('.forma_edit_amount');
   
           $amountElement.val(orginalPrice);
   
           
   
       });
       
       
       //update product
       $(function() {
            var form = $('#edit_product');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {
                    var formData = new FormData(currentForm);
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/ProFormaInvoice/UpdateProduct",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
 
                            var responseData = JSON.parse(data);

                            var PerformaID= (responseData.proforma_id);
                            
                            $('.edit_btn[data-id="'+PerformaID+'"]').trigger('click');

                            $('#EditProduct').modal('hide');
                            
                        }
                    });
                }
            });
        });


        //update proforma
        $(function() {
            var form = $('#edit_performa_form');
            
            form.validate({
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(currentForm) {
                    var formData = new FormData(currentForm);
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/ProFormaInvoice/Update",
                        method: "POST",
                        data: formData,
                        processData: false, // Don't process the data
                        contentType: false, // Don't set content type
                        success: function(data) {
 
                          
                            $('#EditPerformaInvoice').modal('hide');

                            alertify.success('Data Update Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                            
                        }
                    });
                }
            });
        });

        $("body").on('keyup', '.edit_current_claim', function(){ 
            
            var current_claim = $('.edit_current_claim').val();

            //console.log(current_claim);

            var amountTotal = $('.edit_total_order').val();

            var discountAmount = (current_claim/100)*amountTotal

            var discountAmount = discountAmount.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            $('.edit_current_claim_value').val(discountAmount);
          
   
       });


       function EditTotalAmount()
       {

            var total= 0;
           
            $('body .edit_total_amount').each(function()
            {
                var sub_tot = parseFloat($(this).val());

                total += parseFloat(sub_tot.toFixed(2))||0;
            //total = Number(total).toFixed(2)
            });

        total = total.toFixed(2);


        $('.edit_total_order').val(total);

        editCurrentClaim();

       
       }

       
        $(".edit_close_sub_modal").on('click', function(){ 
            
          $('#EditProduct').modal('hide');

          $('#EditAddProduct').modal('hide');

          $('#EditPerformaInvoice').modal('show');
   
       });


        /*current claim check start*/

        $("body").on('keyup', '.edit_current_claim', function(){ 

        var current_claim = $('.edit_current_claim').val();
        
        var preforma_reffer = $('.edit_reff').val();

        if(current_claim > 100)
        {   
            $('.edit_current_claim').val("")

            alertify.error('Discount Should Not Greater Than 100').delay(3).dismissOthers();
          
        }

        var sales_order = $('.edit_sales_order').val();


        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/EditClaim",

            method : "POST",

            data: {salesOrder: sales_order,performaReff: preforma_reffer},

            success:function(data)
            {
                var data = JSON.parse(data);

                var remain_claim = data.remaining_claim;


                if(remain_claim !=="" ){

                    if(remain_claim < current_claim )
                    {
                            $('.edit_current_claim').val("")

                            alertify.error('Maximun Current Claim Is '+remain_claim+'').delay(3).dismissOthers();
                    }

                }

                
            }
        });

       
       

    });

        /*####*/

       


    /*edit section end*/



    /*delete section start*/
    
    $("body").on('click', '.delete_prod_btn', function()
    { 
        var prod_id = $(this).data('id');

        var rowToDelete = $(this).closest('tr');


        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/DeleteProduct",

            method : "POST",

            data: {ID: prod_id},

            success:function(data)
            {   
                rowToDelete.fadeOut(500, function() {
                    $(this).remove();
                    slnoDelete();
                    EditTotalAmount();
                    alertify.success('Data Delete Successfully').delay(3).dismissOthers();
                }); 
            }

        });
          
    });


    function slnoDelete(){

        var pp =1;

        $('body .performa_remove').each(function() {

            $(this).find('.si_no2').html('<td class="si_no2" style="border:unset;">' + pp + '</td>');

            pp++;

        });

    }


    $("body").on('click', '.delete_btn', function(e)
    {    
        if (!confirm('Are you absolutely sure you want to delete?')) return false;     
            
        var Proforma_id = $(this).data('id');

        var rowToDelete = $(this).closest('tr');


        $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/Delete",

            method : "POST",

            data: {ID: Proforma_id},

            success:function(data)
            {   
               
                var data = JSON.parse(data);

                if(data.status === 1){

                    rowToDelete.fadeOut(500, function() {
                    
                        $(this).remove();
                    
                        alertify.success(data.msg).delay(3).dismissOthers();

                        datatable.ajax.reload(null,false);
                    }); 

                }else{
                   
                   alertify.error(data.msg).delay(3).dismissOthers();

                }


            }

        });
          
    });

    
    $('body').on('click','.print_color',function(e){
    
        id = $(this).attr('data-id');
        // Open the PDF generation script in a new window

        var pdfWindow = window.open('<?= base_url()?>Crm/ProFormaInvoice/Pdf/'+id, '_blank');

        // Automatically print when the PDF is loaded
        pdfWindow.onload = function() {
            pdfWindow.print();
        };

    });

    

    /*delete section end*/


    /**/
    $('.datepicker_ap').change(function(){

        var date = $(this).val();

        $.ajax({

            url: "<?php echo base_url(); ?>Crm/ProFormaInvoice/FetchReference/r/"+date+"",

            method: "POST",

            success: function(data) {
                
                $('#uid').val(data);

            }
        });


    })
    /**/


    });


    /*current claim section start*/

    function currentClaim()
    {  

       var current_claim_lenght = $(".current_cliam_clz").length 
 
       var current_claim = $('.current_cliam_clz').val();

       var amountTotal = $('.amount_total').val();

        var discountAmount = (current_claim/100)*amountTotal

        var discountAmount = discountAmount.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

        //var qar = amountTotal - discountAmount;

        $('.claim_qar').val(discountAmount);

    } 

    /*current claim section end*/


     /*calculate current claim */

    function editCurrentClaim()
        {   
            
            var current_claim = $('.edit_current_claim').val();

            var amountTotal = $('.edit_total_order').val();

            var discountAmount = (current_claim/100)*amountTotal

            var discountAmount = discountAmount.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

            $('.edit_current_claim_value').val(discountAmount);
        } 


    
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