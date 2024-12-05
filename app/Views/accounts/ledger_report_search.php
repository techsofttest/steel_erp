 <!--header section start-->

 <?php echo view('accounts/reports_sub_header');?>

<!--header section end-->



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
                                <form method="GET" target="_blank" class="Dashboard-form class">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">General Ledger</h5>
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
                                                                                <td>Select</td>
                                                                               
                                                                                <td>

                                                                                    <select class="form-control" name="filter_type" id="filter_type">
                                                                                        
                                                                                        <option value="">Select Account</option>

                                                                                        <option value="Account">Account</option>
                                                                                       
                                                                                        <option value="Account_Head">Account Head</option>

                                                                                        <option value="Account_Type">Account Type</option>
                                                                                        
                                                                                    </select>

                                                                                </td>
                                                                            
                                                                            </tr>




                                                                            <tr id="Account" style="display:none;">

                                                                            <td>Account</td>

                                                                            <td>

                                                                            <select class="form-control" name="filter_account">

                                                                            <option value="">Select Account</option>
                                                                            
                                                                            <?php foreach($accounts as $account){ ?>

                                                                            <option value="<?= $account->ca_id; ?>"><?= $account->ca_name; ?></option>

                                                                            <?php } ?>

                                                                            </select>

                                                                            </td>


                                                                            </tr>




                                                                            <tr id="Account_Head" style="display:none;">

                                                                            <td>Account Head</td>

                                                                            <td>

                                                                            <select class="form-control" name="filter_account_head">

                                                                            <option value="">Select Account Head</option>

                                                                            <?php foreach($account_heads as $ah){ ?>

                                                                            <option value="<?= $ah->ah_id; ?>"><?= $ah->ah_account_name; ?></option>

                                                                            <?php } ?>

                                                                            </select>

                                                                            </td>

                                                                            </tr>





                                                                            <tr id="Account_Type" style="display:none;">

                                                                            <td>Account Type</td>

                                                                            <td>

                                                                            <select class="form-control" name="filter_account_type">

                                                                            <option value="">Select Account Type</option>

                                                                            <?php foreach($account_types as $account_type)
                                                                            {
                                                                            ?>
                                                                            
                                                                            <option value="<?php echo $account_type->at_id; ?>"><?php echo $account_type->at_name; ?></option>

                                                                            <?php } ?>

                                                                            </select>

                                                                            </td>


                                                                            </tr>







                                                                            <tr>


                                                                            <td>Time Frame</td>

                                                                            <td>

                                                                                <select class="form-control" id="filter_range" name="filter_timeframe">
                                                                                        
                                                                                        <option value="">Select Time</option>

                                                                                        <option value="Range">Range</option>

                                                                                        <option value="Month">Current Month</option>

                                                                                        <option value="Year">Current Year</option>
                                                                                       
                                                                                        
                                                                                </select>



                                                                            </td>


                                                                            </tr>



                                                                            <tr id="range_picker">


                                                                            <td>Date From</td>

                                                                            <td>
                                                                            <input class="form-control datepicker" type="text"  name="start_date" readonly />
                                                                            </td>


                                                                            <td>Date To</td>

                                                                            <td>
                                                                            <input class="form-control datepicker" type="text"  name="end_date" readonly />
                                                                            </td>


                                                                            </tr>



                                                                            <tr>

                                                                            <td>Range From</td>

                                                                            <td>
                                                                            
                                                                            <select class="form-control" name="range_from">

                                                                            <option value="">Select Range From</option>

                                                                            <?php foreach($account_heads_filter as $ahf){ ?>

                                                                            <option value="<?php echo $ahf->ah_head_id; ?>"><?php echo $ahf->ah_head_id; ?></option>

                                                                            <?php } ?>

                                                                            </select>

                                                                            </td>

                                                                            <td>Range To</td>

                                                                            <td>
                                                                            
                                                                            <select class="form-control" name="range_to">

                                                                            <option value="">Select Range To</option>

                                                                            <?php foreach($account_heads_filter as $ahf){ ?>

                                                                            <option value="<?php echo $ahf->ah_head_id; ?>"><?php echo $ahf->ah_head_id; ?></option>

                                                                            <?php } ?>

                                                                            </select>

                                                                            </td>

                                                                            </tr>

                                                                            
                                                                        
                                                                        </thead>
                                                                     
                                                                    
                                                                    
                                                                     </table>
                                                                </div>

                                                                <!--table section end-->

                                                                <div style="float: right;">
                                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                                        <tr>
                                                                        <td><a href="<?= base_url(); ?>Accounts/Reports/Ledger">Clear</a></td>
                                                                            <!--<td><button>Excel</button></td>
                                                                            <td><button>PDF</button></td>
                                                                            <td><button>Email</button></td>-->
                                                                            <td><button type="submit" data-bs-dismiss="modal" aria-label="Close">View</button></td>
                                                                        </tr>
                                                                        <tr>
                                                                            
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                
                                                                
                                                                

                    
                                                            </div>
                
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end col-->
                                            </div>
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
                                        <h4 class="card-title mb-0 flex-grow-1">View General Ledger</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#SalesQuotReport" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Voucher Number</th>
                                                    <th>Voucher Type</th>
                                                    <th>Related Account</th>
                                                    <th>Debit Amount</th>
                                                    <th>Credit Amount</th>
                                                    <th>Balance</th>
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody_data">

                                            <?php
                                            
                                            if(!empty($open_balance))
                                            {
                                            $balance=$open_balance;
                                            }
                                            else
                                            {
                                            $balance=0;
                                            }

                                            ?>


                                            <tr>
                                          
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>Opening Balance</b></td>
                                            <td><?= $balance; ?></td>

                                            </tr>


                                            <?php 

                                            /*

                                            $total_credit=0;

                                            foreach($payments as $pay){ ?>

                                            <tr>
                                          
                                            <td><?php echo date('d-m-Y',strtotime($pay->pay_date)); ?></td>
                                            <td><?= $pay->pay_ref_no; ?></td>
                                            <td>Payment</td>
                                            <td><?= $pay->cc_customer_name; ?></td>
                                            <td>---</td>
                                            <td><?= $pay->pay_amount; ?></td>
                                            <td><?= $balance = $balance+$pay->pay_amount; ?></td>

                                            </tr>

                                            <?php 
                                            $total_credit = $total_credit+$pay->pay_amount;

                                        } ?>



                                            <?php 
                                            $total_debit=0;
                                            foreach($receipts as $rec){ ?>

                                            <tr>
                                           
                                            <td><?php echo date('d-m-Y',strtotime($rec->r_date)); ?></td>
                                            <td><?= $rec->r_ref_no; ?></td>
                                            <td>Receipt</td>
                                            <td><?= $rec->cc_customer_name; ?></td>
                                            <td><?= $rec->r_amount; ?></td>
                                            <td>---</td>
                                            <td><?= $balance = $balance-$rec->r_amount; ?></td>


                                            </tr>

                                            <?php 
                                            $total_debit = $total_debit+$rec->r_amount;
                                            } */ ?>



                                            <?php 
                                            $total_credit=0;
                                            $total_debit=0;
                                            foreach($vouchers as $vc){ ?>


                                            <tr>
                                           
                                            <td><?php echo date('d-m-Y',strtotime($vc->transaction_date)); ?></td>

                                            <td><?= $vc->reference; ?></td>

                                            <td>

                                            <?php /* if($vc->debit_amount !="") { 
                                                echo  "Receipt";
                                               } else {
                                                echo "Payment";
                                               } */ ?>

                                               <?= $vc->voucher_type; ?>


                                            </td>

                                            <td><?= $vc->account_name; ?></td>

                                            <td>

                                               <?php if($vc->debit_amount !="") { 
                                                echo  $vc->debit_amount;
                                                $total_debit = $total_debit-$vc->debit_amount;

                                               } else {?>
                                                ---
                                               <?php } ?>
                                            
                                            </td>

                                            <td> 
                                                
                                               <?php if($vc->credit_amount !="") { 
                                                echo  $vc->credit_amount; 
                                                $total_credit=$total_credit+$vc->credit_amount;
                                                
                                               } else {?>
                                                ---
                                               <?php } ?></td>

                                            <td>
                                            
                                              <?php
                                                
                                                if(!empty($vc->debit_amount))
                                                {
                                                $balance = $balance-$vc->debit_amount; 
                                                }
                                                else
                                                {
                                                $balance = $balance+$vc->credit_amount; 
                                                }

                                                echo $balance;

                                              ?>
                                              
                                            
                                            </td>


                                           </tr>


                                            <?php } ?>



                                            </tbody>



                                            <tfoot>

                                            <tr class="no-sort">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?= $total_debit; ?></b></td>
                                            <td><b><?= $total_credit; ?></b></td>
                                            <td><b></b></td>
                                            </tr>

                                            </tfoot>



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




        //Search Modal Fns Start


        $('#filter_type').change(function(){

        var type = $(this).val();

        $('#Account').hide();

        $('#Account_Head').hide();

        $('#Account_Type').hide();

        $('#'+type+'').show();


        });



        //Search Modal Fns End







        /*modal open start*/

        <?php /* if(empty($_GET)){ ?>
        $(window).on('load', function() {
            $('#SalesQuotReport').modal('show');
        });
        <?php } */ ?>



        $('#filter_range').change(function(){

        var val = $(this).val();

        if(val !="Range")
        {
        $('.datepicker').attr('readonly',true);

        /*
        if(val=="Month")
            {
                var date = new Date();
                var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                $('input[name=start_date]').val(FormatDate(firstDay));
                $('input[name=end_date]').val(FormatDate(lastDay));

            }

        if(val=="Year")
        {
            var date = new Date();
            var firstDay = new Date(date.getFullYear(), 0, 1); // First day of current year
            var lastDay = new Date(date.getFullYear(), 11, 31);

            $('input[name=start_date]').val(FormatDate(firstDay));
            $('input[name=end_date]').val(FormatDate(lastDay));
        
        }
        */

        }
        else
        {
        $('.datepicker').attr('readonly',false);  

        $('input[name=start_date]').val('');
        $('input[name=end_date]').val('');  
        }

        });

       
        
        
        
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




        $('#DataTable').DataTable( {
        responsive: true,
        ordering: false,
        paging: false,
        order: [[0, 'asc']]
        } );


        


    });





</script>








