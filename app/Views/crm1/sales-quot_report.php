

<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        
                        <!--sales rout report modal start-->
                        <div class="modal fade" id="SalesQuotReport" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <!--<form  class="Dashboard-form class" id="sales_quot_report_form">-->
                                <form method="GET" action="<?php echo base_url();?>Crm/SalesQuotReport/GetData" target="_blank" class="Dashboard-form class" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Quotation Report</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
        
                                                        <div class="card-body">
                                                            <div class="live-preview">

                                                              <!--table section start-->
                                                               
                                                              <?php
                                                               if(!empty($_GET['form_date']))
                                                               {
                                                                    $from_date = $_GET['form_date'];
                                                               }
                                                               else
                                                               {
                                                                    $from_date = "";
                                                               }
                                                               if(!empty($_GET['to_date']))
                                                               {
                                                                   $to_date = $_GET['to_date'];
                                                               }
                                                               else
                                                               {
                                                                    $to_date ="";
                                                               }
                                                               if(!empty($_GET['customer']))
                                                               {
                                                                    $customer = $_GET['customer'];
                                                               }
                                                               else
                                                               {
                                                                    $customer = "";
                                                               }
                                                               if(!empty($_GET['sales_executive']))
                                                               {
                                                                    $sales_executive = $_GET['sales_executive'];
                                                               }
                                                               else
                                                               {
                                                                    $sales_executive ="";
                                                               }
                                                               if(!empty($_GET['product']))
                                                               {
                                                                    $product =  $_GET['product'];
                                                               }
                                                               else
                                                               {
                                                                    $product = "";
                                                               }
                                                               
                                                               ?>
                                                                

                                                                <div class="mt-4">
                                                                    <table class="table table-bordered table-striped delTable">
                                                                        <thead class="travelerinfo contact_tbody">
                                                                            <tr>
                                                                                <td>Date</td>
                                                                                <td class="text-center">From</td>
                                                                                <td><input type="date" name="form_date" id="from_date_id"  value="<?php echo $from_date; ?>" onclick="this.showPicker();" class="form-control" ></td>
                                                                                <td>To</td>
                                                                                <td><input type="date" name="to_date" id="to_date_id" value="<?php echo $to_date; ?>" onclick="this.showPicker();"  class="form-control"></td>
                                                                            
                                                                            </tr>
                                                                            
                                                                        
                                                                        </thead>

                                                                    
                                                                        <tbody  class="travelerinfo">
                                                                            
                                                                            <tr>
                                                                                <td>Customer</td>
                                                                                <td><select class="form-select droup_customer value='<?php echo $customer; ?>' customer_clz" name="customer"><option value="" selected disabled>Select Customer</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>Sales Executive</td>
                                                                                <td><select class="form-select executive_clz" value="<?php echo $sales_executive; ?>" name="sales_executive"><option value="" selected disabled>Select Executive</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>


                                                                            <tr>
                                                                                <td>Product</td>
                                                                                <td><select class="form-select value='<?php echo $product; ?>' product_clz"name="product"><option value="" selected disabled>Select Product</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                
                                                                            </tr>


                                                                        </tbody>
                                                                    
                                                                    
                                                                     </table>
                                                                </div>

                                                                <!--table section end-->

                                                                <!--<div style="float: right;">
                                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                                        <tr>
                                                                           
                                                                            <td><button type="submit">View</button></td>
                                                                        </tr>
                                                                        <tr>
                                                                            
                                                                        </tr>
                                                                    </table>
                                                                </div>--->
                                                                
                                                                
                                                                

                    
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button  class="btn btn btn-success submit_btn" data-bs-dismiss="modal"  type="submit">Search</button>
                                        </div>

                                        
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!--####-->


                      


                        <!--datatable section start-->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;font-weight: 600;color: black;">View Sales Quotation Reports <?php if(!empty($from_dates) && !empty($to_dates)){?>(<?php echo $from_dates;?> To <?php echo $to_dates;?>)<?php } ?></h4>
                                        <form method="POST"  target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button type="submit"  class="pdf_button report_button" >PDF</button>
                                        </form>
                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1">
                                            <button class="excel_button report_button" type="submit">Excel</button>
                                        </form>

                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1">
                                            <button class="print_button report_button" type="submit">Print</button>
                                        </form>

                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1">
                                            <button class="email_button report_button" type="submit">Email</button>
                                        </form>
                                        
                                        <button type="button" data-bs-toggle="modal" id="clear_data" data-bs-target="#SalesQuotReport" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Date</th>
                                                    <th>Quotation Ref</th>
                                                    <th>Customer Name</th>
                                                    <th>Sales Executive</th>
                                                    <th>Amount</th>
                                                    <th>Product</th>
                                                    <th>Quantity</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody_data">
                                                <?php
                                                if(!empty($quotation_data))
                                                {
                                                    $i=1;
                                                    $total = 0;
                                                    $total1 = 0;
                                                    foreach($quotation_data as $quot_data){?> 
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $quot_data->qd_date;?></td>
                                                        <td><a href="<?php echo base_url();?>Crm/SalesQuotation?view_so=<?php echo $quot_data->qd_id;?>" target="blank" class="" data-id ="<?php echo $quot_data->qd_id;?>"><?php echo $quot_data->qd_reffer_no;?></a></td>
                                                        <td><?php echo $quot_data->cc_customer_name;?></td>
                                                        <td><?php echo $quot_data->se_name;?></td>
                                                        <td><?php echo $quot_data->qd_sales_amount;?></td>
                                                        <td>
                                                            <?php foreach($quot_data->quotation_product as $quot_prod){?> 
                                                                <?php echo $quot_prod->product_details;?><br>   
                                                            <?php } ?>
                                                        </td> 
                                                       
                                                        <td>
                                                            <?php foreach($quot_data->quotation_product as $quot_prod){?> 
                                                                <?php echo $quot_prod->qpd_quantity;?><br>
                                                            <?php } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach($quot_data->quotation_product as $quot_prod){?> 
                                                                <?php echo format_currency($quot_prod->qpd_rate);?><br>
                                                            <?php } ?>
                                                        </td>

                                                        <td>
                                                            <?php foreach($quot_data->quotation_product as $quot_prod){?> 
                                                                <?php echo $quot_prod->qpd_discount;?><br>
                                                            <?php } ?>
                                                        </td>

                                                        <td style="white-space: nowrap" class="text-end">
                                                            <?php foreach($quot_data->quotation_product as $quot_prod){

                                                               $total1  = $quot_prod->qpd_amount + $total1;
                                                            ?>

                                                                <?php echo format_currency($quot_prod->qpd_amount);?><br>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>

                                                    
                                                    
                                                
                                                <?php $i++; }  ?>
                                            
                                                <tr>
                                                    <td>Total</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-end"><?php echo format_currency($total);?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-end"><?php echo format_currency($total1);?></td>
                                                </tr>

                                                <?php   } ?>

                                               

                                            </tbody>

                                        </table>
                
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>

                        <!---datatable section end-->

                    </div>
                    <!--###-->


                   

                    
                </div>
                    
                    
                    
            </div>
                    
        </div>
                    
                    
    </div>
                    
    
                        
</div>







<script>

    document.addEventListener("DOMContentLoaded", function(event) { 
        
        /*modal open start*/
        <?php if(empty($_GET)): ?>

        $(window).on('load', function() {
           
            $('#SalesQuotReport').modal('show');
        });

        <?php endif; ?>
      
        /*modal open end*/


        /* customer droup drown */
         $(".droup_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#SalesQuotReport'),

            ajax: {
                url: "<?= base_url(); ?>Crm/SalesQuotReport/FetchTypes",
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
                        results: $.map(data.result, function (item) { return {id: item.cc_id, text: item.cc_customer_name}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })
        /**/

        /*fetch  sales executive by  customer*/   

        $("body").on('change', '.customer_clz', function(){ 


            var id = $(this).val();


            $.ajax({

                url : "<?php echo base_url(); ?>Crm/SalesQuotReport/FetchData",

                method : "POST",

                data:{ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    //console.log(data.prod_details);
                    $('.executive_clz').html(data.quot_det);
                    
                    $('.product_clz').html(data.quot_prod);

                }


            });
        });
        
        /*####*/

        /*form submit start*/

        $(".submit_btn").on('click', function(){ 

           /* $('#SalesQuotReport').modal("hide");

            $('#add_form')[0].reset();

            $('.customer_clz option').remove();

            $('.executive_clz option').remove();

            $('.product_clz option').remove();*/

            
        });


        /*#####*/


     
       
        

        


    });





</script>


