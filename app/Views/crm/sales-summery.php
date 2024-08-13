
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
                                        <h4 class="card-title mb-0 flex-grow-1">View Sales Summery Report <?php if(!empty($from_dates) && !empty($to_dates)){?>(<?php echo $from_dates;?> To <?php echo $to_dates;?>)<?php } ?></h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#SalesSummery" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Date</th>
                                                    <th>Invoice Ref.</th>
                                                    <th>Customer</th>
                                                    <th>Delivery Note Ref.</th>
                                                    <th>Sales Order Ref.</th>
                                                    <th>LPO Ref.</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody_data">
                                               
                                            <?php 
                                               
                                                if(!empty($delivery_data))
                                                {   
                                                   
                                                    $i =1;

                                                    foreach($delivery_data as $del_note){?> 
                                                    <tr>
                                                        <td class="height_class"><?php echo $i;?></td>
                                                        <td class="height_class"><?php echo date('d-M-Y',strtotime($del_note->dn_date));?></td>
                                                        <td colspan="1" align="left" class="p-0" style="height:100%">
                                                           
                                                            <?php if(!empty($del_note->credit_invoice) || !empty($del_note->performa_invoice)){ ?> 
                                                               <table>
                                                                    <?php foreach($del_note->credit_invoice as $cred_inv){?>
                                                                        <tr style="background: unset;border-bottom: hidden !important;" class="invoice-row">
                                                                            <td width="100px"><?php echo $cred_inv->cci_reffer_no;?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                    <?php foreach($del_note->performa_invoice as $per_inv){?>
                                                                        <tr style="background: unset;border-bottom: hidden !important;" class="invoice-row">
                                                                            <td width="100px"><?php echo $per_inv->pf_reffer_no;?></td>
                                                                        </tr> 
                                                                    <?php } ?>
                                                               </table>  
                                                            <?php } ?>
                                                          
                                                        </td>
                                                        <td class="height_class"><?php echo $del_note->cc_customer_name;?></td>
                                                        <td class="height_class"><?php echo $del_note->dn_reffer_no;?></td>
                                                        <td class="height_class"><?php echo $del_note->so_reffer_no;?></td>
                                                        <td class="height_class"><?php echo $del_note->so_lpo;?></td>
                                                       
                                                        <td class="height_class"><?php echo $del_note->dn_total_amount;?></td>
                                                        

                                                    </tr>
        
                                                    
                                                <?php  $i++; }  }  ?>
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


