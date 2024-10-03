<style>

.divcontainer {
  overflow-x: scroll;
  overflow-y: auto;
  transform: rotateX(180deg);
}

.divcontainer table {
  transform: rotateX(180deg);
}

.table-responsive {
  width: 100%;
  display: block overflow-x: scroll;
}

.responsive{
    transform: rotateX(180deg);
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
                        
                        
                        <!--sales rout report modal start-->
                        <div class="modal fade" id="DnToCreditInvoice" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form  class="Dashboard-form class" method="GET" target="_blank" action="<?php echo base_url();?>Crm/DnToCreditInvoice/GetData" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Dn To Credit Invoice Report</h5>
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
                                                                    $to_date = "";
                                                                }

                                                                if(!empty($_GET['customer']))
                                                                {
                                                                    $customer = $_GET['customer'];
                                                                }
                                                                else
                                                                {
                                                                    $customer = "";
                                                                }


                                                                if(!empty($_GET['sales_order']))
                                                                {
                                                                    $sales_order = $_GET['sales_order'];
                                                                }
                                                                else
                                                                {
                                                                    $sales_order = "";
                                                                }


                                                                if(!empty($_GET['delivery_note']))
                                                                {
                                                                    $delivery_note = $_GET['delivery_note'];
                                                                }
                                                                else
                                                                {
                                                                    $delivery_note = "";
                                                                }


                                                                if(!empty($_GET['product']))
                                                                {
                                                                    $product = $_GET['product'];
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
                                                                                <td><input type="date" name="form_date" id="" value="<?php echo $from_date; ?>" onclick="this.showPicker();"  class="form-control"></td>
                                                                                <td>To</td>
                                                                                <td><input type="date" name="to_date" id="" value="<?php echo $to_date; ?>" onclick="this.showPicker();" class="form-control"></td>
                                                                            
                                                                            </tr>
                                                                            
                                                                        
                                                                        </thead>

                                                                    
                                                                        <tbody  class="travelerinfo">
                                                                            
                                                                            <tr>
                                                                                <td>Customer</td>
                                                                                <td><select class="form-select droup_customer  customer_clz" value="<?php echo $customer;?>" name="customer"><option value="" selected disabled>Select Customer</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>


                                                                            <tr>
                                                                                <td>Sales Order Ref</td>
                                                                                <td><select class="form-select sales_order_ref sales_order" value="<?php echo $sales_order;?>" name="sales_order"><option value="" selected disabled>Select Order Ref</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>

                                                                            </tr>

                                                                            <tr>
                                                                                <td>Delivery Note Ref</td>
                                                                                <td><select class="form-select  deliver_note_ref" value="<?php echo $delivery_note;?>" name="delivery_note" ><option value="" selected disabled>Select Delivery Note Ref</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                
                                                                            </tr>
                                          

                                                                            <tr>
                                                                                <td>Product</td>
                                                                                <td><select class="form-select product_clz" value="<?php echo $product; ?>" name="product"><option value="" selected disabled>Select Product</option></select></td>
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
                                            <button class="btn btn btn-success submit_btn" data-bs-dismiss="modal" type="submit">Search</button>
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
                                        <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;font-weight: 600;color: black;">View Dn To Credit Invoice Reports <?php if(!empty($from_dates) && !empty($to_dates)){?>(<?php echo $from_dates;?> To <?php echo $to_dates;?>)<?php } ?></h4>
                                        
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
                                        
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#DnToCreditInvoice" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body table-responsive divcontainer" style="overflow-x:auto;">
                                        <table style="table-layout:fixed;" id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort" style="white-space: nowrap;width:100px">Sl no</th>
                                                    <th style="white-space: nowrap;width:100px">Date</th>
                                                    <th style="white-space: nowrap;width:200px">Delivery Note Number</th>
                                                    <th style="white-space: nowrap;width:500px">Customer</th>
                                                    <th style="white-space: nowrap;width:100px">Sales Order Ref</th>
                                                    <th style="white-space: nowrap;width:100px">LPO Ref</th>
                                                    <th style="white-space: nowrap;width:100px" class="text-end">Amount</th>
                                                    <th style="white-space: nowrap;width:500px">Product</th>
                                                    <th style="white-space: nowrap;width:100px" class="text-end">Quantity</th>
                                                    <th style="white-space: nowrap;width:100px" class="text-end">Rate</th>
                                                    <th style="white-space: nowrap;width:100px" class="text-end">Amount</th>
                                                    <th style="white-space: nowrap;width:100px" class="text-end">Invoice Ref</th>
                                                    <!--<th width="100px">Product</th>
                                                    <th width="100px">Quantity</th>
                                                    <th width="100px">Rate</th>
                                                    <th width="100px">Amount</th>--->
                                                    <th  style="white-space: nowrap;width:100px" class="text-end">Difference</th>
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody_data">
                                               
                                            <?php 
                                                $total_amount = 0 ;
                                                $total_amount1 = 0 ;
                                                if(!empty($delivery_data))
                                                {   
                                                   
                                                    $i =1;

                                                    foreach($delivery_data as $del_note){?> 
                                                    <tr>
                                                        <td class="height_class" style="white-space: nowrap;width:100px"><?php echo $i;?></td>
                                                        <td class="height_class" style="white-space: nowrap;width:100px"><?php echo date('d-M-Y',strtotime($del_note->dn_date));?></td>
                                                        <td class="height_class" style="white-space: nowrap;width:200px"><a href="<?php echo base_url();?>Crm/DeliverNote?view_so=<?php echo $del_note->dn_id;?>" target="_blank"><?php echo $del_note->dn_reffer_no;?></a></td>
                                                        <td class="height_class" style="white-space: nowrap;width:500px"><?php echo $del_note->cc_customer_name;?></td>
                                                        <td class="height_class" style="white-space: nowrap;width:100px"><?php echo $del_note->so_reffer_no;?></td>
                                                        <td class="height_class" style="white-space: nowrap;width:100px"><?php echo $del_note->dn_lpo_reference;?></td>
                                                        <?php $total_amount  = $del_note->dn_total_amount + $total_amount?>
                                                        <td class="height_class text-end" style="white-space: nowrap;width:100px"><?php echo format_currency($del_note->dn_total_amount);?></td>

                                                        

                                                        <td  colspan="4" align="left" class="p-0 ">
                                                            <table>
                                                                <?php foreach($del_note->delivery_products as $del_prod){?>
                                                                    <tr style="background: unset;border-bottom: hidden !important;" class="product-row">
                                                                        <td  width="500px" class="responsive"><?php echo $del_prod->product_details;?></td>
                                                                        <td  width="100px" class="responsive text-end"><?php echo $del_prod->dpd_current_qty;?></td>
                                                                        <td  width="100px" class="responsive text-end"><?php echo format_currency($del_prod->dpd_prod_rate);?></td>
                                                                        <?php $total_amount1 = $del_prod->dpd_total_amount + $total_amount1; ?>
                                                                        <td  width="100px" class="responsive text-end"><?php echo format_currency($del_prod->dpd_total_amount);?></td>
                                                                    </tr> 
                                                                <?php } ?>
                                                            </table>
                                                        </td>
                                                        
                                                        
                                                        <td colspan="3" align="left" class="p-0" style="height:100%">
                                                            <?php if(!empty($del_note->credit_invoices)){?>
                                                            
                                                            <table>

                                                                <?php foreach($del_note->credit_invoices as $credit_inv){
                                                                $j=1; foreach($credit_inv->invoices_product as $inv_prod){   
                                                                ?> 
                                                                    <tr style="background: unset;border-bottom: hidden !important;" class="invoice-row">
                                                                        <?php if($j==1){?> 
                                                                            <td width="100px" class="responsive text-end"><?php echo $credit_inv->cci_reffer_no;?></td>
                                                                        <?php } else{?> 
                                                                            <td width="100px"></td>
                                                                        <?php } ?>
                                                                        <!--<td width="100px"><?php //echo $inv_prod->product_details;?></td>
                                                                        <td width="100px"><?php //echo $inv_prod->ipd_quantity;?></td>
                                                                        <td width="100px"><?php //echo $inv_prod->ipd_rate;?></td>
                                                                        <td width="100px"><?php //echo $inv_prod->ipd_amount;?></td>-->

                                                                        <?php if(!empty($credit_inv->invoices_product)){  ?> 
                                                                                
                                                                            <td width="100px" class="text-end responsive">00.0</td>
                                                                        
                                                                        <?php  } ?> 

                                                                            

                                                                    </tr>
                                                                <?php  $j++; } } ?>

                                                                
                                                            </table>

                                                            <?php }  else{?>
                                                                <table>
                                                                <?php foreach($del_note->delivery_products as $del_prod){?>
                                                                    <tr class="invoice-row" style="background: unset;border-bottom: hidden !important;">
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td valign="" class="text-end responsive" width="100px"><?php echo format_currency($del_prod->dpd_total_amount);?></td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </table>    
                                                            <?php } ?>
                                                        </td>

                                                        


                                                      


                                                    </tr>
        
                                                    
                                                <?php  $i++; }  }  ?>

                                                <tr>
                                                    <td>Total</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-end"><?php echo format_currency($total_amount);?></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-end"><?php echo format_currency($total_amount1); ?></td>
                                                    <td></td>
                                                    <td></td>
                                                   
                                                    
                                                 
                                                </tr>


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

        var maxh = 0;

        $('.product-row').each(function(){

            if($(this).height()>maxh)
            {
            maxh = $(this).height();
            }
            
            //$(this).closest('.invoice-row').height(maxh);

            //$('.invoice-row').height(maxh);

        })

            $('.invoice-row').height(maxh);
            $('.product-row').height(maxh);

        



        /*modal open start*/

        <?php if(empty($_GET)): ?>

        $(window).on('load', function() {
            $('#DnToCreditInvoice').modal('show');
        });
        
        <?php endif; ?>

        /*modal open end*/


        /* customer droup drown */
         $(".droup_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#DnToCreditInvoice'),

            ajax: {
                url: "<?= base_url(); ?>Crm/DnToCreditInvoice/FetchTypes",
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

                url : "<?php echo base_url(); ?>Crm/DnToCreditInvoice/FetchData",

                method : "POST",

                data:{ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    //console.log(data.sales_reff);
                    //$('.executive_clz').html(data.quot_det);
                    
                    $('.product_clz').html(data.quot_prod);

                    $('.sales_order_ref').html(data.sales_reff);

                    $('.deliver_note_ref').html(data.delivier_note);

                }


            });
        });
        
        /*####*/


        /*form submit start*/

        /*$(".submit_btn").on('click', function(){ 

            $('#DnToCreditInvoice').modal("hide");

            $('#add_form')[0].reset();

            $('.customer_clz option').remove();

            $('.sales_order option').remove();

            $('.deliver_note_ref option').remove();

            $('.product_clz option').remove();

            

            
        });*/


    /*#####*/

       



    });





</script>


