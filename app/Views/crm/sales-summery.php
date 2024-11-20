<style>

.divcontainer {
  overflow-x: scroll;
  overflow-y: auto;
  /*transform: rotateX(180deg);*/
}

.divcontainer table {
 /* transform: rotateX(180deg);*/
}

.table-responsive {
  width: 100%;
  display: block overflow-x: scroll;
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
                        <div class="modal fade" id="SalesSummery" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form  class="Dashboard-form class" method="GET" target="_blank" action="<?php echo base_url();?>Crm/SalesSummery/GetData" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sales Summery Report</h5>
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
                                                                                <td><input type="date" name="form_date" id="" onclick="this.showPicker();"  class="form-control"></td>
                                                                                <td>To</td>
                                                                                <td><input type="date" name="to_date" id="" onclick="this.showPicker();" class="form-control"></td>
                                                                            
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
                                                                                <td>Sales Executive</td>
                                                                                <td>
                                                                                    <select class="form-select sales_order_ref sales_order" name="sales_executive">
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
                                            <button class="btn btn btn-success submit_btn" data-bs-dismiss="modal" type="submit">Search</button>
                                        </div>
                                        
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!--####-->


                      


                        <!--datatable section start-->

                        <div class="row">
                            <div class="col-lg-12" style="padding:0px">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;font-weight: 600;color: black;margin-right:-17%">Sales Summer Report <?php if (!empty($from_dates) && !empty($to_dates)) { ?>(<?php echo $from_dates; ?> To <?php echo $to_dates; ?>)<?php } ?></h4>

                                        <form method="POST" target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button type="submit" class="pdf_button report_button">PDF</button>
                                        </form>

                                        <!-- <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1"> -->
                                        <button class="excel_button report_button" type="submit">Excel</button>
                                        <!-- </form> -->

                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button class="print_button report_button" type="submit">Print</button>
                                        </form>

                                        <!-- <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1"> -->
                                        <button class="email_button report_button" type="submit" id="email_button">Email</button>
                                        <!-- </form> -->

                                        <button type="button" data-bs-toggle="modal" data-bs-target="#InvoiceReport" class="btn btn-primary py-1">Search</button>
                                    </div>
                                    <div class="card-body table-responsive divcontainer" style="overflow-x:scroll;">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort text-center"  style="width:50px">Sl no</th>
                                                    <th class="text-center" style="width:100px">Date</th>
                                                    <th class="text-center" style="width:200px">Invoice Ref.</th>
                                                    <th class="text-center" style="width:700px">Customer</th>
                                                    <th class="text-center" style="width:200px">Sales Order Ref.</th>
                                                    <th class="text-center" style="width:200px">LPO Ref.</th>
                                                    <th class="text-center" style="width:200px">Sales Executive</th>
                                                    <th class="text-center" width="50px">Amount</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody_data">
                                               
                                            <?php 
                                               $total_amount = 0 ;
                                             
                                                if(!empty($sales_data))
                                                {   
                                                   
                                                    $i =1;

                                                    foreach($sales_data as $sale_data){?> 
                                                    <tr>
                                                        <td class="height_class text-center" style="width:50px" ><?php echo $i; ?></td>
                                                        <td class="height_class text-center" style="width:100px"><?php echo date('d-M-Y', strtotime($sale_data->date)); ?></td>
                                                        <?php
                                                            if($sale_data->link == "cash invoice"){
                                                              
                                                                $href="Crm/CashInvoice";

                                                                $view = "view_cash";

                                                            }
                                                            else if($sale_data->link == "credit invoice"){
                                                                  
                                                                $href="Crm/CreditInvoice";

                                                                $view = "view_crn";
                                                            }
                                                            else{

                                                                $href="";

                                                                $view = "";
                                                            }

                                                        ?>
                                                        <td  class="p-0 text-center" style="height:100%,width:200px"><a href="<?php echo base_url();?><?= $href ?>?<?php echo $view; ?>=<?php echo $sale_data->reffer_id;?>" target="_blank"><?php echo $sale_data->reference; ?></a><br></td>
                                                        <td class="height_class" style="width:700px"><?php echo $sale_data->customer_name; ?></td>
                                                        <td class="height_class text-center" style="width:200px"><a href="<?php echo base_url(); ?>Crm/SalesOrder?view_so=<?php echo $sale_data->sales_order_id; ?>" target="_blank"><?php echo $sale_data->sales_order; ?></a></td>
                                                        <td class="height_class text-center" style="width:200px"><?php echo $sale_data->sales_lpo; ?></td>
                                                        <td class="height_class text-center" style="width:200px"><?php echo $sale_data->sales_exec; ?></td>
                                                        <td class="height_class text-end" width="50px"><?php echo format_currency($sale_data->amount); ?></td>
                                                        
                                                        <?php $total_amount =  $sale_data->amount + $total_amount; ?>
                                                    
                                                    </tr>
        
                                                    
                                                <?php  $i++; }  }  ?>

                                                <tr>
                                                    <td>Total</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-end"><b><?php echo format_currency($total_amount);?></b></td>
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

        /*modal open start*/
        <?php if(empty($_GET)): ?>

        $(window).on('load', function() {
            $('#SalesSummery').modal('show');
        });
        
         <?php endif; ?>

        /*modal open end*/


        /* customer droup drown */
         $(".droup_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#SalesSummery'),

            ajax: {
                url: "<?= base_url(); ?>Crm/SalesSummery/FetchTypes",
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

            $('#SalesSummery').modal("hide");

            $('#add_form')[0].reset();

            $('.customer_clz option').remove();

            $('.sales_order option').remove();
        });*/

    /*#####*/




       


    });


   





</script>


