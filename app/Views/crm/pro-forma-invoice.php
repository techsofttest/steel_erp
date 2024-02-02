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

</style>

<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        <!--porforma invoice section start-->

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
                                                                        <input type="text" name="pf_reffer_no" id="" value="<?php echo $performa_invoice_id;?>" class="form-control" required readonly>
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
                                                                        <input type="date" name="pf_date" class="form-control" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->

                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                    <label for="basicInput" class="form-label">Customer</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        

                                                                        <select class="form-select customer_sel customer_clz_id" name="pf_customer" id="customer_id" required>
                                                               
                                                                        </select>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 

                                                            

                                                            <!-- Single Row Start -->
                                                            
                                                            
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Sales Order Number</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                      
                                                                        <select class="form-select sales_order_add_clz" name="pf_sales_order"  required>

                                                            
                                                            
                                                                        </select>
                                                                        
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                           
                                                            <!-- ### --> 

                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">LPO Reference</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pf_lpo_ref" class="form-control lpo_reff" required>
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
                                                                        <label for="basicInput" class="form-label">Sales Executive</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                        <select class="form-select sales_excutive_clz"  name="pf_sales_executive" required>

                                                               
                                                                
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
                                                                        
                                                                        <select class="form-select contact_person_clz" name="pf_contact_person" id="contact_person_id" required>
                                                                            <option value="" selected disabled>Contact Person</option>
                                                                
                                                                        </select>
                                                                       
                                                                       
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### -->

                                                            


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Payment Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        <input type="text" name="pf_payment_terms" class="form-control payment_term_clz" required>
                                                                    </div>

                                                                </div> 

                                                            </div>    

                                                            <!-- ### --> 


                                                            <!-- Single Row Start -->
                                                            <div class="col-lg-12">

                                                                <div class="row align-items-center mb-2">

                                                                    <div class="col-col-md-3 col-lg-3">
                                                                        <label for="basicInput" class="form-label">Delivery Terms</label>
                                                                    </div>

                                                                    <div class="col-col-md-9 col-lg-9">
                                                                        
                                                                       
                                                                        <input type="text" name="pf_delivery_terms" class="form-control delivery_term" required>
                                                                        
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
                                                                        <input type="text" name="pf_project" class="form-control project_clz" required>
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
                                                                <td>Serial No.</td>
                                                                <td>Product Description</td>
                                                                <td>Unit</td>
                                                                <td>Qty</td>
                                                                <td>Rate</td>
                                                                <td>Discount</td>
                                                                <td>Amount</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            
                                                           
                                                        </thead>
                                                        
                                                        <tbody  class="travelerinfo product-more2"></tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="8" align="center" class="tecs">
                                                                    <span class="add_icon add_product2"><i class="ri-add-circle-line"></i>Add </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3"></td>
                                                                
                                                                <td>Total Order value</td>
                                                                <td><input type="text" name="pf_total_amount" class="amount_total form-control" readonly></td>
                                                            </tr>


                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td colspan="3"></td>
                                                                
                                                                <td>Current Claim %</td>
                                                                <td><input type="number" name="pf_total_amount" onkeyup="currentClaim()" class="form-control current_cliam_clz"></td>
                                                            </tr>


                                                            <tr>
                                                                <td colspan="2">Amount in words</td>
                                                                <td colspan="3" class="performa_amount_in_word_val"></td>
                                                                <input type="hidden" name="pf_total_amount_in_words" class="performa_amount_in_word_val">
                                                                <td>Current Claim Value -QAR</td>
                                                                <td><input type="number" name="" class="form-control claim_qar" readonly></td>
                                                            </tr>
                                                            
                                                          
                                                        </tbody>
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

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        
                                                        <div class="row row_align mb-4">
                                                            <div class="col-lg-3">
                                                                <label for="basicInput" class="form-label">Attach</label>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <input type="file" name=""  class="form-control" required>
                                                            </div>

                                                        </div>


                                                        
                                                    </div>
                                                    <div class="col-lg-6">
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

                                                    </div>
                                                </div>

                                                <!--table section end-->


                                            </div>  
                                            
                                            
                                             


					                           
						                    
				                        </div>


                                        
			                        </div>
		                        </form>

	                        </div>
                        </div>
                        
                        <!--porforma invoice section end-->



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Pro-Forma Invoice</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#PerformaInvoice" class="btn btn-primary py-1">Add</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Pro-forma Invoice Number</th>
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
                    // Submit the form for the current tab
                    $.ajax({
                        url: "<?php echo base_url(); ?>Crm/ProFormaInvoice/Add",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
 
                            $('#add_form1')[0].reset();
                           
                            $('#PerformaInvoice').modal('hide');

                            alertify.success('Data Added Successfully').delay(3).dismissOthers();

                            datatable.ajax.reload(null, false);
                            
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

                    console.log(data.contact_person);

                    $(".payment_term_clz").val(data.payment_term);

                    $(".delivery_term").val(data.so_delivery_term);

                    $(".project_clz").val(data.so_project);

                    $(".contact_person_clz").html(data.contact_person);

                    $(".sales_excutive_clz").html(data.sales_executive);

                    $(".lpo_reff").val(data.so_lpo);

                    $(".product-more2").append(data.sales_order_contact);

                    slno();

                    TotalAmount();

                 
                    
                }


            });
            
            
        });
        /*####*/





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
                
               ]
    
            });
        }

        $(document).ready(function () {
            initializeDataTable();
        });
        /*###*/

        $("body").on('change', '#customer_id', function(){ 

            var id = $(this).val();
           
            //Fetch Contact Person
           /* $.ajax({

                url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/ContactPerson",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);
                
                    $("#contact_person_id").html(data.customer_name);
                    
                }


            });*/


            /*###*/

            


            //Fetch Contact Person
            $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/FetchOrders",

            method : "POST",

            data: {ID: id},

            success:function(data)
            {   
                var data = JSON.parse(data);

                $("#contact_person_id").html(data.customer_name);
                
            }

            });




        });







        /*customer droup drown search*/
        $(".customer_sel").select2({
            placeholder: "Select Customer",
            theme : "default form-control-",
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



        /* Fetch Sales Orders */


       



        $('.customer_clz_id').change(function(){

            var id = $(this).val();

            $.ajax({

            url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/FetchOrders",

            method : "POST",

            data : {id:id},

            success:function(data)
            {
                var data = JSON.parse(data);

                $('.sales_order_add_clz').html(data.orders);

                $('.contact_person_clz').html(data.contact_person);

            }


            });


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
        /*###*/



        /*product detail calculation*/
        
        $("body").on('keyup', '.discount_clz_id , .qtn_clz_id , .rate_clz_id', function(){ 
           
            var $discountSelect = $(this);

            var discount = parseInt($discountSelect.closest('.prod_row').find('.discount_clz_id').val())||0;
            
            var $discountSelectElement = $discountSelect.closest('.prod_row').find('.rate_clz_id');

            var rate = $discountSelectElement.val();

            var $quantitySelectElement = $discountSelect.closest('.prod_row').find('.qtn_clz_id');

            var quantity = parseInt($quantitySelectElement.val())||0;

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

           var resultSalesOrder= numberToWords.toWords(total);

            $(".performa_amount_in_word").text(resultSalesOrder);

            $(".performa_amount_in_word_val").val(resultSalesOrder);
            

        }

        /*total amount calculation end*/


       





        /*delete*/

        $("body").on('click', '.delete_btn', function(){ 
            
            if (!confirm('Are you absolutely sure you want to delete?')) return false;
            var id = $(this).data('id');
            $.ajax({

                url : "<?php echo base_url(); ?>Crm/ProFormaInvoice/Delete",

                method : "POST",

                data: {ID: id},

                success:function(data)
                {
                    alertify.success('Data Deleted Successfully').delay(2).dismissOthers();

                    datatable.ajax.reload(null,false);
                }


            });

        });

        /**/


    /*product section start*/

    var max_fieldspp      = 30;

    var pp = 1;

    $("body").on('click', '.add_product2', function(){
    
        var pp = $('.prod_row').length

        if(pp < max_fieldspp)
        { 
    
            pp++;
            
            $(".product-more2").append("<tr class='prod_row'><td class='si_no'>"+pp+"</td><td style='width:20%'><select class='form-select add_prod' name='pp_product_det[]' required=''><option value='' selected disabled>Select Product Description</option><?php foreach($products as $prod){?><option value='<?php echo $prod->product_id;?>'><?php echo $prod->product_details;?></option><?php } ?></select></td><td><input type='text' name='pp_unit[]' class='form-control ' required=''></td><td><input type='number' name='pp_quantity[]' class='form-control qtn_clz_id' required=''></td><td><input type='number' name='pp_rate[]' class='form-control rate_clz_id' required=''></td><td><input type='number' name='pp_discount[]' class='form-control discount_clz_id' required=''></td><td><input type='number' name='pp_amount[]' class='form-control amount_clz_id' readonly></td><td class='remove-btnpp' colspan='6'><div class='remainpass'><i class='ri-close-line'></i>Remove</div></td></tr>");

        }

        slno();

        InitProductSelect2();

    });

    $(document).on("click", ".remove-btnpp", function() 
    {

        $(this).parent().remove();
        slno();
    });

    /**/

    /*serial no correction section start*/

    function slno(){

        var pp =1;

        $('body .prod_row').each(function() {

            $(this).find('.si_no').html('<td class="si_no">' + pp + '</td>');

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


        /* ### */




     

    });


    /*current claim section start*/

    function currentClaim()
    {  
        var current_claim = $('.current_cliam_clz').val();

        var amountTotal = $('.amount_total').val();

        var discountAmount = (current_claim/100)*amountTotal

        var discountAmount = discountAmount.toFixed(2); //For showing 1000.00 instead of 1000 if no decimal present

        var qar = amountTotal - discountAmount;

        $('.claim_qar').val(qar);

        console.log(qar);
    } 

    /*current claim section end*/


</script>