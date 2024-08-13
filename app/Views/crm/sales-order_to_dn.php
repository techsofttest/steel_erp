
<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        
                        <!--sales rout report modal start-->
                        <div class="modal fade" id="SalesOrderToDn" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form  method="GET" action="<?php echo base_url();?>Crm/SalesOrderToDn/GetData" target="_blank" id="add_form" class="Dashboard-form class">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Order To Dn</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
        
                                                        <div class="card-body">
                                                            <div class="live-preview">

                                                              <!--table section start-->


                                                                <div class="mt-4">
                                                                    <table class="table table-bordered table-striped delTable">
                                                                        <thead class="travelerinfo contact_tbody">
                                                                            <tr>
                                                                                <td>Date</td>
                                                                                <td class="text-center">From</td>
                                                                                <td><input type="date" name="form_date" id="from_date_id" onclick="this.showPicker();" class="form-control" ></td>
                                                                                <td>To</td>
                                                                                <td><input type="date" name="to_date" id="to_date_id" onclick="this.showPicker();"  class="form-control"></td>
                                                                            
                                                                            </tr>
                                                                            
                                                                        
                                                                        </thead>

                                                                    
                                                                        <tbody  class="travelerinfo">
                                                                            
                                                                            <tr>
                                                                                <td>Customer</td>
                                                                                <td><select class="form-select droup_customer  customer_clz" name="customer"><option value="" selected disabled>Select Customer</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>


                                                                            <tr>
                                                                                <td>Sales Order Ref</td>
                                                                                <td><select class="form-select sales_order_ref sales_order" name="sales_order_ref"><option value="" selected disabled>Select Order Ref</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>


                                                                            <tr>
                                                                                <td>Sales Executive</td>
                                                                                <td><select class="form-select executive_clz" name="sales_executive"><option value="" selected disabled>Select Executive</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>


                                                                            <tr>
                                                                                <td>Product</td>
                                                                                <td><select class="form-select product_clz"name="product"><option value="" selected disabled>Select Product</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                
                                                                            </tr>


                                                                        </tbody>
                                                                    
                                                                    
                                                                     </table>
                                                                </div>

                                                                <!--table section end-->

                                                               
                                                                
                                                                
                                                                

                    
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
                                        </div>


                                        <div class="modal-footer justify-content-center">
                                            <button class="btn btn btn-success submit_btn" type="submit">Search</button>
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
                                        <h4 class="card-title mb-0 flex-grow-1">View Sales Order To Dn <?php if(!empty($from_dates) && !empty($to_dates)){?>(<?php echo $from_dates;?> To <?php echo $to_dates;?>)<?php } ?></h4>
                                        
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
                                        
                                        <button type="button" data-bs-toggle="modal" id="clear_data" data-bs-target="#SalesOrderToDn" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Date</th>
                                                    <th>Sales Order Ref</th>
                                                    <th>Customer Name</th>
                                                    <th>LPO Ref</th>
                                                    <th>Sales Executive</th>
                                                    <th>Amount</th>
                                                    <th width="100px">Product</th>
                                                    <th width="100px">Quantity</th>
                                                    <th width="100px">Rate</th>
                                                    <th width="100px">Amount</th>
                                                    <th width="100px">Delivery Note/ Cash Invoice</th>
                                                    <th width="100px">Product</th>
                                                    <th width="100px">Quantity</th>
                                                    <th width="100px">Rate</th>
                                                    <th width="100px">Amount</th>
                                                    <th width="100px">Difference</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody_data">
                                            <?php
                                                
                                                if(!empty($sales_orders))
                                                {
                                                    $i=1;
                                                    foreach($sales_orders as $sales_order){
                                                         
                                                    ?> 
                                                   
                                                    <tr>

                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo date('d-M-Y',strtotime($sales_order->so_date));?></td>
                                                        <td><?php echo $sales_order->so_reffer_no;?></td>
                                                        <td><?php echo $sales_order->cc_customer_name;?></td>
                                                        <td><?php echo $sales_order->so_lpo;?></td>
                                                        <td><?php echo $sales_order->se_name;?></td>
                                                        <td><?php echo $sales_order->so_amount_total;?></td>
                                                        
                                                        <td colspan="4" align="left" class="p-0">
                                                            <table>
                                                                <?php foreach($sales_order->sales_products as $sales_prod){?>
                                                                    <tr style="background: unset;border-bottom: hidden !important;">
                                                                        <td  width="100px"><?php echo $sales_prod->product_details;?></td>
                                                                        <td  width="100px"><?php echo $sales_prod->spd_quantity;?></td>
                                                                        <td  width="100px"><?php echo $sales_prod->spd_rate;?></td>
                                                                        <td  width="100px"><?php echo $sales_prod->spd_amount;?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </td>

                                                        
                                                        
                                                        <td colspan="5" align="left" class="p-0">

                                                            <!--***delivery note section start**-->

                                                            <?php if(!empty($sales_order->sales_deliverys)){?>
                                                                <table>
                                                                    <?php  foreach($sales_order->sales_deliverys as $sales_del){
                                                                        $j=1;  foreach($sales_del->sales_delivery_prod as $del_prod){
                                                                    ?> 
                                                                        <tr style="background: unset;border-bottom: hidden !important;">
                                                                            <?php if($j==1){?> 
                                                                                <td width="100px"><?php echo $sales_del->dn_reffer_no;?></td>
                                                                            <?php } else{?>
                                                                                <td width="100px"></td>  
                                                                            <?php } ?>
                                                                            <td width="100px"><?php echo $del_prod->product_details;?></td>
                                                                            <td width="100px"><?php echo $del_prod->dpd_current_qty;?></td>
                                                                            <td width="100px"><?php echo $del_prod->dpd_prod_rate;?></td>
                                                                            <td width="100px"><?php echo $del_prod->dpd_total_amount;?></td>
                                                                        </tr>
                                                                    <?php $j++; }  }?>
                                                                </table>
                                                            <?php } ?> 

                                                            <!--*****-->
                                                            

                                                            <!--**cash invoice start**-->

                                                            <?php if(!empty($sales_order->sales_cash_invoice)){?>
                                                                <table>
			                                                        <?php foreach($sales_order->sales_cash_invoice as $sales_cash){
				                                                        $k=1; foreach($sales_cash->cash_product as $cash_prod){    
			                                                        ?>
                                                                    <tr style="background: unset;border-bottom: hidden !important;">
                                                                        <?php if($k==1){?> 
                                                                            <td width="100px"><?php echo $sales_cash->ci_reffer_no;?></td>
                                                                        <?php } else{?> 
                                                                            <td width="100px"></td>
                                                                        <?php } ?> 
                                                                        <td width="100px"><?php echo $cash_prod->product_details;?></td>
                                                                        <td width="100px"><?php echo $cash_prod->cipd_qtn;?></td>
                                                                        <td width="100px"><?php echo $cash_prod->cipd_rate;?></td>
                                                                        <td width="100px"><?php echo $cash_prod->cipd_amount;?></td>
                                                                    </tr>
			                                                         <?php  $k++; }  } ?>
		                                                        </table>
                                                            <?php } ?> 

                                                            <!--****-->

                                                            

                                                        </td>


                                                        <td>
                                                            <?php if(empty($sales_order->sales_deliverys) && empty($sales_order->sales_cash_invoice)){?> 
                                                                <table>
                                                                    <?php foreach($sales_order->sales_products as $sales_prod){?>
                                                                        <tr style="background: unset;border-bottom: hidden !important;">
                                                                            
                                                                        <td  width="100px"><?php echo $sales_prod->spd_amount;?></td>
                                                                            
                                                                        </tr>
                                                                    <?php } ?>
                                                                </table>
                                                            <?php } else{?> 
                                                                <table>
                                                                    <tr style="background: unset;border-bottom: hidden !important;">
                                                                        <td>----</td>
                                                                    </tr>
                                                                </table>
                                                            <?php } ?>
                                                        </td>



                                                        
                                                    </tr>
                                                        
                                                    <?php  $i++; }?> 

                                                    
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
            $('#SalesOrderToDn').modal('show');
        });
        
        <?php endif; ?>
        /*modal open end*/


        /* customer droup drown */
         $(".droup_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#SalesOrderToDn'),

            ajax: {
                url: "<?= base_url(); ?>Crm/SalesOrderToDn/FetchTypes",
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

                url : "<?php echo base_url(); ?>Crm/SalesOrderToDn/FetchData",

                method : "POST",

                data:{ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    $('.executive_clz').html(data.quot_det);
                    
                    $('.product_clz').html(data.quot_prod);

                    $('.sales_order_ref').html(data.sales_reff);

                }


            });
        });
        
        /*####*/


        /*form submit start*/

        /*$(".submit_btn").on('click', function(){ 

            $('#SalesOrderToDn').modal("hide");

            $('#add_form')[0].reset();

            $('.customer_clz option').remove();

            $('.sales_order option').remove();

            $('.executive_clz option').remove();

            $('.product_clz option').remove();

        });*/

        /*#####*/
      

    });





</script>


