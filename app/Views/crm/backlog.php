
<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        
                        <!--sales rout report modal start-->
                        <div class="modal fade" id="backLog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form  class="Dashboard-form class" action="<?php echo base_url();?>Crm/BackLog/GetData" target="_blank" method="GET" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">BackLog</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card">
        
                                                        <div class="card-body">
                                                            <div class="live-preview">

                                                                <?php
                                                              
                                                                    if(!empty($_GET['form_date']))
                                                                    {
                                                                        $from_date =  $_GET['form_date'];
                                                                    }
                                                                    else
                                                                    {
                                                                        $from_date ="";
                                                                    }

                                                                    if(!empty($_GET['to_date']))
                                                                    {
                                                                        $to_date =  $_GET['to_date'];
                                                                    }
                                                                    else
                                                                    {
                                                                        $to_date =  "";
                                                                    }

                                                                    if(!empty($_GET['customer']))
                                                                    {
                                                                        $customer =  $_GET['customer'];
                                                                    }
                                                                    else
                                                                    {
                                                                        $customer =  "";
                                                                    }

                                                                    if(!empty($_GET['sales_executive']))
                                                                    {
                                                                        $sales_executives =  $_GET['sales_executive'];
                                                                    }
                                                                    else
                                                                    {
                                                                        $sales_executives ="";
                                                                    }
                                                                ?>

                                                              <!--table section start-->


                                                                <div class="mt-4">
                                                                    <table class="table table-bordered table-striped delTable">
                                                                        <thead class="travelerinfo contact_tbody">
                                                                            <tr>
                                                                                
                                                                                <td>Date</td>
                                                                                <td class="text-center">From</td>
                                                                                <td><input type="date" name="form_date" id="" onclick="this.showPicker();" value="<?php echo $from_date;?>"  class="form-control"></td>
                                                                                <td>To</td>
                                                                                <td><input type="date" name="to_date" id="" onclick="this.showPicker();" value="<?php echo $to_date;?>" class="form-control"></td>
                                                                            
                                                                            </tr>
                                                                            
                                                                        
                                                                        </thead>

                                                                    
                                                                        <tbody  class="travelerinfo">
                                                                            
                                                                            <tr>
                                                                                <td>Customer</td>
                                                                                <td><select class="form-select droup_customer  customer_clz" value="<?php echo $customer;?>" name="customer" ><option value="" selected disabled>Select Customer</option></select></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>


                                                                            <tr>
                                                                                <td>Sales Executive</td>
                                                                                <td>
                                                                                    <select class="form-select sales_order_ref sales_order" value="<?php echo $sales_executives; ?>" name="sales_executive">
                                                                                        <option value="" selected disabled>Select Sales Executive</option>
                                                                                        <?php 
                                                                                           foreach($sales_executive as $sales_exec)
                                                                                           { ?>
                                                                                             <option value="<?php echo $sales_exec->se_id; ?>"><?php echo  $sales_exec->se_name;?></option>
                                                                                         <?php  }
                                                                                        ?>
                                                                                    </select>
                                                                                </td>
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
                                        <h4 class="card-title mb-0 flex-grow-1">View BackLog <?php if(!empty($from_dates) && !empty($to_dates)){?>(<?php echo $from_dates;?> To <?php echo $to_dates;?>)<?php } ?></h4>
                                        <form method="POST"  target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button type="submit"  class="pdf_button report_button" >PDF</button>
                                        </form>
                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1">
                                            <button class="excel_button report_button" type="submit">Excel</button>
                                        </form>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#InvoiceReport" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Date</th>
                                                    <th>Sales Order Ref</th>
                                                    <th>Customer</th>
                                                    <th>Lpo Ref</th>
                                                    <th>Sales Executive</th>
                                                    <th>Amount</th>   
                                                    <th>Delivered</th>
                                                    <th>Invoiced</th>
                                                    <th>Balance</th>

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
                                                        
                                                        <?php
                                                        
                                                            $delivery_amount = 0;

                                                            foreach($sales_order->sales_delivery as $del)
                                                            {
                                                                $delivery_amount =  $del->dn_total_amount + $delivery_amount;

                                                                
                                                            }

                                                            if(!empty($sales_order->sales_delivery)){
                                                        
                                                        ?>
                                                         
                                                        <td><?php echo $delivery_amount;?></td>
                                                        
                                                        <?php } else{?> 
                                                            <td>---</td>    
                                                        <?php } 

                                                            $invoiced_amount = 0;

                                                            foreach($sales_order->cash_invoiced as $cash_inv)
                                                            {
                                                                $invoiced_amount =  $cash_inv->ci_total_amount + $invoiced_amount;
                                                            }
                                                            
                                                            if(!empty($sales_order->cash_invoiced)){?>

                                                                <td><?php echo $invoiced_amount; ?></td>
                                                            
                                                            <?php }  else{?> 

                                                                <td>----</td>  

                                                            <?php } 
                                                            
                                                                
                                                            ?>
                                                            
                                                           <?php if(!empty($sales_order->sales_delivery)){
                                                                $balance =  $sales_order->so_amount_total - $delivery_amount;
                                                            ?> 
                                                            
                                                                <td><?php echo $balance;?></td>

                                                            <?php } else{?> 
                                                                 <td>----</td>    
                                                            <?php } ?>
                                                        

                                    

                                                        
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
            $('#backLog').modal('show');
        });
        
        <?php endif; ?>
        /*modal open end*/


        /* customer droup drown */
         $(".droup_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#backLog'),

            ajax: {
                url: "<?= base_url(); ?>Crm/BackLog/FetchTypes",
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

        /*form submit start*/

        /*$(".submit_btn").on('click', function(){ 

            $('#backLog').modal("hide");

            $('#add_form')[0].reset();

            $('.customer_clz option').remove();

            $('.sales_order option').remove();

        
        });*/


/*#####*/

       



    });





</script>


