<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">



<head>

    <meta charset="utf-8" />
    <title><?php echo site_title//Defined in app/constants ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    
    <!--header section start-->

    <?php echo view('includes/header');?>

    <!--header section end-->



    <style>
        #page-topbar{
            width: 100%;
            left: unset;
        }
        .main-content{
            margin-left: unset;
        }
        .footer{
            left: unset;
            width: 100%;
        }
        .pdf_button {
            background: red;
            border: red;
        }
        .report_button {
            margin-right: 14px;
            color: white;
            padding: 3px 11px;
            border-radius: 4px;
        }
        .excel_button {
            background: green;
            border: green;
        }
    </style>


   

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">

            







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
                                <form method="GET" class="Dashboard-form class">
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
                                                                            <input class="form-control datepicker" type="text"  name="start_date" readonly disabled/>
                                                                            </td>


                                                                            <td>Date To</td>

                                                                            <td>
                                                                            <input class="form-control datepicker" type="text"  name="end_date" readonly disabled/>
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
                                                                            <td><button type="submit">View</button></td>
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
                                        <table id="DataTable" class="ReportTable table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Voucher Number</th>
                                                    <th>Voucher Type</th>
                                                    <th>Related Account</th>
                                                    <th class="text-end">Debit Amount</th>
                                                    <th class="text-end">Credit Amount</th>
                                                    <th class="text-end">Balance</th>
                                                    
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
                                            <td class="text-end"><b>Opening Balance</b></td>
                                            <td class="text-end"><?= $balance; ?></td>

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
                                           
                                            <td><?php echo date('d-F-Y',strtotime($vc->transaction_date)); ?></td>

                                            <td>
                                            <?php if(($vc->voucher_type=="Receipt") || ($vc->voucher_type=="Receipt Invoice")){
                                             $href="Accounts/Receipts";
                                             } 
                                             else if($vc->voucher_type=="Cash Invoice")
                                             {
                                             $href="CRM/CashInvoice";
                                             }
                                             else if($vc->voucher_type=="Credit Invoice")
                                             {
                                             $href="CRM/CreditInvoice";
                                             }
                                             else
                                             {
                                             $href="";
                                             }
                                             ?>
                                            <a target="_blank" href="<?= base_url(); ?><?= $href ?>?view=<?= $vc->id; ?>">
                                            <?= $vc->reference; ?>
                                              </a>
                                        
                                            </td>

                                            <td>

                                            <?php /* if($vc->debit_amount !="") { 
                                                echo  "Receipt";
                                               } else {
                                                echo "Payment";
                                               } */ ?>

                                               <?= $vc->voucher_type; ?>


                                            </td>

                                            <td><?= $vc->account_name; ?></td>

                                            <td class="currency_format1 text-end">

                                               <?php if($vc->debit_amount !="") { 

                                                echo  format_currency($vc->debit_amount);
                                                $total_debit = $total_debit+$vc->debit_amount;

                                               } else if($vc->credit_amount<0) {

                                                echo  format_currency($vc->credit_amount); 
                                                $total_debit=$total_debit+$vc->credit_amount;
                                                
                                               } ?>
                                            
                                            </td>

                                            <td class="currency_format1 text-end"> 
                                                
                                               <?php if($vc->credit_amount !="" && $vc->credit_amount>0) { 
                                                echo  format_currency($vc->credit_amount); 
                                                $total_credit=$total_credit+$vc->credit_amount;
                                                
                                               } else {?>
                                                
                                               <?php } ?></td>

                                            <td class="currency_format1 text-end">
                                            
                                              <?php
                                                
                                                if(!empty($vc->debit_amount))
                                                {
                                                $balance = $balance+$vc->debit_amount; 
                                                }
                                                else
                                                {
                                                $balance = $balance-$vc->credit_amount; 
                                                }

                                                echo format_currency($balance);

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
                                            <td><b></b></td>
                                            <td class="text-end"><b ><?= format_currency($total_credit); ?></b></td> 
                                            
                                            <td class="text-end"><b ><?= format_currency($balance); ?></b></td>
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



</div>
<!-- End Page-content -->











<!--footer section start-->

<?php echo view('includes/footer'); ?>

<!--footer section end-->




</body>



</html>






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



        /*
        $('#filter_range').change(function(){

        var val = $(this).val();

        if(val !="Range")
        {
        $('.datepicker').attr('disabled',true);

            if(val=="Month")
            {
                var date = new Date();
                var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
                var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                $('input[name=start_date]').val(firstDay);
                $('input[name=end_date]').val(firstDay);

            }

            if(val=="Year")
            {

            

            }

        }
        else
        {
        $('.datepicker').attr('disabled',false);    
        }

        });

        */

       
        
        
        
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

        /*quot report form submit*/
        $(function() {
            var form = $('#sales_quot_report_form');
            
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
                        url: "<?php echo base_url(); ?>Crm/SalesQuotReport/GetData",
                        method: "POST",
                        data: $(currentForm).serialize(),
                        success: function(data) {
                            var responseData = JSON.parse(data);

                            if(responseData.status ==='False')
                            {
                                alertify.error('No Data Found').delay(3).dismissOthers();
                            }
                         
                            $('.tbody_data').html(responseData.product_data);

                            $("#SalesQuotReport").modal('hide');

                            $('#sales_quot_report_form')[0].reset();

                            $('.customer_clz').val('').trigger('change');

                            $('.executive_clz').val('').trigger('change');

                            $('.product_clz').val('').trigger('change');

                            datatable.ajax.reload(null, false);

                            
                        
                        }
                    });
                }
            });
        });

        /*####*/



        $('#DataTable').DataTable( {
        responsive: true,
        ordering: false,
        paging: false,
        order: [[0, 'asc']]
        } );


        


    });





</script>








