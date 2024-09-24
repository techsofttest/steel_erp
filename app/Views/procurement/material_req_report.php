

<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        
                        <!--sales rout report modal start-->
                        <div class="modal fade" id="MaterialRequesitionReport" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <!--<form  class="Dashboard-form class" id="sales_quot_report_form">-->
                                <form method="GET" action="<?php echo base_url();?>Procurement/MaterialReqReport/GetData" target="_blank" class="Dashboard-form class" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Material Requesition Report</h5>
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
                                                               if(!empty($_GET['sales_order']))
                                                               {
                                                                    $customer = $_GET['sales_order'];
                                                               }
                                                               else
                                                               {
                                                                    $customer = "";
                                                               }
                                                            //    if(!empty($_GET['sales_executive']))
                                                            //    {
                                                            //         $sales_executive = $_GET['sales_executive'];
                                                            //    }
                                                            //    else
                                                            //    {
                                                            //         $sales_executive ="";
                                                            //    }
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
                                                                                <td>Sales Order</td>
                                                                                <td>
                                                                                    <select class="form-select value='' customer_clz" name="sales_order">
                                                                                        <option value="" selected disabled>Select Sales Order</option>
                                                                                        <?php foreach($sales_orders as $sales_order){?> 
                                                                                            <option value="<?php echo $sales_order->so_id?>"><?php echo $sales_order->so_reffer_no;?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td>Product</td>
                                                                                <td>
                                                                                    <select class="form-select" value="" name="product">
                                                                                        <option value="" selected disabled>Select Porduct</option>
                                                                                        <?php foreach($products as $product){?> 
                                                                                            <option value="<?php echo $product->product_id;?>"><?php echo $product->product_details;?></option>    
                                                                                        <?php } ?>
                                                                                    </select></td>
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
                                            <button  class="btn btn btn-success submit_btn"  type="submit">Search</button>
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
                                        <h4 class="card-title mb-0 flex-grow-1">View Material Requesition Reports</h4>
                                        
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
                                                    <th>Sales Order</th>
                                                    <th>Product</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody_data">
                                                <?php
                                                if(!empty($material_requesition))
                                                {
                                                    $i=1;
                                                    foreach($material_requesition as $material_req){?> 
                                                    <tr>
                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo $material_req->mr_date;?></td>
                                                        <td><?php echo $material_req->so_reffer_no;?></td>
                                                        <td><?php echo $material_req->product_details;?></td>
                                                       
                                                       

                                                    </tr>
                                                
                                                <?php $i++; }  } ?>

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
           
            $('#MaterialRequesitionReport').modal('show');
        });

        <?php endif; ?>
      
        /*modal open end*/


        /* customer droup drown */
         $(".droup_sales").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#MaterialRequesitionReport'),

            ajax: {
                url: "<?= base_url(); ?>Procurement/MaterialReqReport/FetchTypes",
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
                        results: $.map(data.result, function (item) { return {id: item.so_id, text: item.so_reffer_no}}),
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

                url : "<?php echo base_url(); ?>Procurement/MaterialReqReport/FetchData",

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


