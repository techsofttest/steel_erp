<!--header section start-->

 <?php 
 if(empty($_GET))
 {
 echo view('accounts/reports_sub_header');
 }
 else{
    ?>
   
   <style>
   
       
   /* Report Full Page No Scroll */
   
   header
   {
   
   display:none;
   
   }
   
   footer
   {
   
   display:none;
   
   }
   
   .page-content
   {
   
   padding:5px 0px;
   
   }
   
   .main-content
   {
      margin:15px !important;
   }
   
   
   /* #### */
   
   
   </style>
   
    <?php } ?>

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
                                <form method="GET" target="<?php if(empty($_GET)) { echo "_blank"; } ?>" class="Dashboard-form class">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Profit And Loss Account</h5>
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
                                                                            
                                                                        
                                                                        </thead>
                                                                     
                                                                    
                                                                    
                                                                     </table>



                                                                     <div class="row my-2">

                                                                    <div class="col-lg-6 text-center">
                                                                    Monthwise <input type="checkbox" name="month" value="1">
                                                                    </div>

                                                                    <div class="col-lg-6 text-center">
                                                                    Zero Balance <input type="checkbox" name="zero" value="1">
                                                                    </div>                                                  

                                                                    </div>



                                                                </div>

                                                                <!--table section end-->

                                                                <div style="float: right;">
                                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                                        <tr>
                                                                            <td><a href="<?= base_url(); ?>Accounts/Reports/PLAccount">Clear</a></td>
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

                                <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;font-weight: 600;color: black;">View Profit Loss Account Report <?php if(!empty($from_dates) && !empty($to_dates)){?>(<?php echo $from_dates;?> To <?php echo $to_dates;?>)<?php } ?></h4>
                             
                                   
                                <?php if(!empty($_GET)) { ?>

                                <form method="POST" action="" target="_blank">
                                <input type="hidden" name="pdf" value="1">
                                <button type="submit"  class="pdf_button report_button" >PDF</button>
                                </form>
                              
                                <button class="excel_button report_button">Excel</button>

                                
                                    <button class="print_button report_button" type="button">Print</button>
                               

                             
                                <button id="email_button" class="email_button report_button" type="button">Email</button>
                               

                                <?php } ?>

                                <button type="button" data-bs-toggle="modal" id="clear_data" data-bs-target="#SalesQuotReport" class="btn btn-primary py-1">Search</button>
                               
                            
                            </div><!-- end card header -->

                                    
                                    <div class="card-body">
                                        
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            

                                            <thead>

                                                <tr>

                                                    <th width="60%" class="text-center">Description</th>
                                                    <th width="10%" class="text-end"><?= $month_year ?></th>
                                                    <th width="10%" class="text-end">%</th>
                                                    <th width="10%" class="text-end">Year To Date</th>
                                                    <th width="10%" class="text-end">%</th>
                                                    
                                                </tr>

                                            </thead>
                                            

                                            <tbody class="tbody_data <?php if(empty($_GET)){ echo "d-none"; } ?>">


                                            <?php
                                            

                                            $revenue_accounts=[];

                                            foreach($accounts as $account)
                                            {

                                                if(empty($_GET['zero']))
                                                {
                                                if( ($account->ending_balance_month==0) && ($account->ending_balance_year==0))
                                                { 
                                                continue;
                                                }
                                                }

                                                if($account->at_name=="Income")
                                                {

                                                    $revenue_accounts[]=$account;  

                                                }

                                            }


                                            $cos_accounts = [];

                                            foreach($accounts as $account)
                                            {

                                                if(empty($_GET['zero']))
                                                {
                                                if( ($account->ending_balance_month==0) && ($account->ending_balance_year==0))
                                                {
                                                continue;
                                                }
                                                }

                                                if($account->at_name=="Cost of Sales")
                                                {
                                                    
                                                    $revenue_accounts[]=$account;  

                                                }

                                            }


                                            $expense_accounts = [];

                                            foreach($accounts as $account)
                                            {
                                                if(empty($_GET['zero']))
                                                {
                                                if(($account->ending_balance_month==0) && ($account->ending_balance_year==0))
                                                {
                                                continue;
                                                }
                                                }

                                                if($account->at_name=="Expenses")
                                                {

                                                    $expense_accounts[]=$account;  

                                                }

                                            }

                                            
                                            ?>


                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            </tr>

                                            <tr>

                                            <th align="center" style="text-align:center;text-decoration:underline"><b style="font-size:14px;">Revenues</b></th>
                                           
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                            </tr>


                                            <?php $total_revenue_month = array_sum(array_column($revenue_accounts,'ending_balance_month')); ?>
                                            <?php $total_revenue_year = array_sum(array_column($revenue_accounts,'ending_balance_year')); ?>
                                            <?php foreach($revenue_accounts as $ra){ 
                                                
                                            $month_perc=0.00;

                                            if($total_revenue_month != 0)
                                            $month_perc = $ra->ending_balance_month/$total_revenue_month*100;

                                            $year_perc=0.00;

                                            if($total_revenue_year != 0)
                                            $year_perc = $ra->ending_balance_year/$total_revenue_year*100;

                                            ?>

                                            <tr>

                                            <th><?= $ra->ca_name; ?></th>
                                           
                                            <td align="right"><?= format_currency($ra->ending_balance_month) ?></td>
                                            <td align="right"><?= number_format($month_perc,2) ?></td>
                                            <td align="right"><?= format_currency($ra->ending_balance_year) ?></td>
                                            <td align="right"><?= number_format($year_perc,2) ?></td>
                                            
                                            </tr>

                                            <?php } ?>


                                            <tr>

                                            <th align="center" style="text-align:center"><b style="font-size:14px;">Total Revenues</b></th>

                                            <td class="text-end"><b><?= format_currency($total_revenue_month); ?></b></td>
                                            <td class="text-end"><b>100.00</b></td>
                                            <td class="text-end"><b><?= format_currency($total_revenue_year) ?></b></td>
                                            <td class="text-end"><b>100.00</b></td>

                                            </tr>





                                            <!-- COST OF SALES START -->

                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            </tr>

                                            <tr>

                                            <th align="center"  style="text-align:center;text-decoration:underline"><b style="font-size:14px;">Cost Of Sales</b></th>
                                           
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                            </tr>

                                            <?php $total_cos_month = array_sum(array_column($cos_accounts,'ending_balance_month')); ?>
                                            <?php $total_cos_year = array_sum(array_column($cos_accounts,'ending_balance_year')); ?>

                                            <?php foreach($cos_accounts as $cosa){ ?>

                                            <?php 
                                                $month_perc=0.00;

                                                if($total_cos_month != 0)
                                                $month_perc = $cosa->ending_balance_month/$total_cos_month*100;

                                                $year_perc=0.00;

                                                if($total_cos_year != 0)
                                                $year_perc = $cosa->ending_balance_year/$total_cos_year*100;

                                            ?>

                                            <tr>
                                            <th class=""><?= $cosa->ca_name; ?></th>
                                           
                                            <td align="right"><?= format_currency($cosa->ending_balance_month) ?></td>
                                            <td align="right"><?= number_format($month_perc,2) ?></td>
                                            <td align="right"><?= format_currency($cosa->ending_balance_year) ?></td>
                                            <td align="right"><?= number_format($year_perc,2) ?></td>
                                            
                                            </tr>

                                            <?php } ?>


                                            <tr>

                                            <th align="center" style="text-align:center"><b style="font-size:14px;">Total Cost Of Sales</b></th>

                                            <td class="text-end"><b><?= format_currency($total_cos_month); ?></b></td>

                                            <?php 
                                            $total_cos_month_perc=0.00;
                                            if($total_cos_month!=0 && $total_revenue_month!=0)
                                            $total_cos_month_perc = $total_cos_month/$total_revenue_month*100;
                                            ?>
                                            <td class="text-end"><b><?= number_format($total_cos_month_perc,2) ?></b></td>

                                            <td class="text-end"><b><?= format_currency($total_cos_year); ?></b></td>

                                            <?php 
                                            $total_cos_year_perc=0.00;
                                            if($total_cos_year!=0 && $total_revenue_year!=0)
                                            $total_cos_year_perc = $total_cos_year/$total_revenue_year*100; 
                                            
                                            ?>

                                            <td class="text-end"><b><?= number_format($total_cos_year_perc,2); ?></b></td>

                                            </tr>

                                            <!-- COST OF SALES END -->


                                            <tr>

                                            <th align="center" style="text-align:center"><b style="font-size:14px;">Gross Profit</b></th>

                                            <?php 
                                            
                                            $gross_profit_month = $total_revenue_month-$total_cos_month; 
                                            
                                            $gross_profit_year = $total_revenue_year-$total_cos_year;

                                            ?>

                                            <?php 
                                            $gross_perc_month = 0.00;

                                            if($total_revenue_month != 0 && $total_revenue_month!=0)
                                            $gross_perc_month = $gross_profit_month/$total_revenue_month*100; 

                                            $gross_perc_year = 0.00;

                                            if($total_revenue_year != 0 && $total_revenue_year!=0)
                                            $gross_perc_year = $gross_profit_year/$total_revenue_year*100;
                                            
                                            ?>

                                            <td class="text-end"><b><?= format_currency($gross_profit_month) ?></b></td>

                                            <td class="text-end"><b><?= number_format($gross_perc_month,2) ?></b></td>
                                            
                                            <td class="text-end"><b><?= format_currency($gross_profit_year) ?></b></td>

                                            <td class="text-end"><b><?= number_format($gross_perc_year,2) ?></b></td>

                                            </tr>





                                            <!-- EXPENSES START -->


                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            </tr>

                                            <tr>

                                            <th align="center"  style="text-align:center;text-decoration:underline"><b style="font-size:14px;">Expenses</b></th>
                                           
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                            </tr>

                                            <?php $total_expense_month = array_sum(array_column($expense_accounts,'ending_balance_month')); ?>
                                            <?php $total_expense_year = array_sum(array_column($expense_accounts,'ending_balance_year')); ?>

                                            <?php foreach($expense_accounts as $ea){ ?>

                                            <?php 
                                                $month_perc=0.00;

                                                if($total_expense_month != 0)
                                                $month_perc = $ea->ending_balance_month/$total_expense_month*100;

                                                $year_perc=0.00;

                                                if($total_expense_year != 0)
                                                $year_perc = $ea->ending_balance_year/$total_expense_year*100;

                                            ?>

                                            <tr>
                                            <th class=""><?= $ea->ca_name; ?></th>
                                           
                                            <td align="right"><?= format_currency($ea->ending_balance_month) ?></td>
                                            <td align="right"><?= number_format($month_perc,2) ?></td>
                                            <td align="right"><?= format_currency($ea->ending_balance_year) ?></td>
                                            <td align="right"><?= number_format($year_perc,2) ?></td>
                                            
                                            </tr>

                                            <?php } ?>


                                            <tr>

                                            <th align="center" style="text-align:center"><b style="font-size:14px;">Total Expenses</b></th>

                                            <td class="text-end"><b><?= format_currency($total_expense_month); ?></b></td>

                                            <?php 
                                            $total_expense_month_perc=0.00;
                                            if($total_expense_month!=0 && $total_revenue_month!=0)
                                            $total_expense_month_perc = $total_expense_month/$total_revenue_month*100;
                                            ?>
                                            <td class="text-end"><b><?= number_format($total_expense_month_perc,2) ?></b></td>

                                            <td class="text-end"><b><?= format_currency($total_expense_year); ?></b></td>

                                            <?php 
                                            $total_expense_year_perc=0.00;
                                            if($total_expense_year!=0 && $total_revenue_year!=0)
                                            $total_expense_year_perc = $total_expense_year/$total_revenue_year*100; 
                                            
                                            ?>

                                            <td class="text-end"><b><?= number_format($total_expense_year_perc,2); ?></b></td>

                                            </tr>



                                          


                                            <!-- EXPENSES END -->

                                            <?php
                                            
                                            $net_profit_month = $total_expense_month-$gross_profit_month;


                                            $net_profit_month_perc= $total_expense_month_perc-$gross_perc_month;


                                            $net_profit_year=$total_expense_year-$gross_profit_year;

                                            $net_profit_year_perc=$total_expense_year_perc-$gross_perc_year;


                                            ?>


                                            <tr>
                                            <th align="center"  style="text-align:center;"><b style="font-size:14px;">Net Profit</b></th>
                                            <td class="text-end"><b>(<?= format_currency($net_profit_month); ?></b>)</td>
                                            <td class="text-end"><b>(<?= number_format($net_profit_month_perc,2) ?>)</b></td>
                                            <td class="text-end"><b>(<?= format_currency($net_profit_year) ?>)</b></td>
                                            <td class="text-end"><b>(<?= number_format($net_profit_year_perc,2)?>)</b></td>
                                            </tr>



                                            <?php 

                                            /*

                                            $total_credit=0;

                                            $grand_total_ytd = 0;

                                            
                                            foreach($account_heads as $ah)
                                            { 
                                            $total_ytd = number_format(0,2); 
                                            $total_first_month = number_format(0,2); 
                                            foreach($ah->Charts as $ca)
                                            {
                                            $total_ytd = $total_ytd+$ca->ytd_total;
                                            $grand_total_ytd = $grand_total_ytd + $ca->ytd_total;

                                            $total_first_month = $total_first_month + $ca->tran_total;

                                            }
                                            ?>
                                            
                                         
                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            </tr>

                                            <tr>

                                            <th><b style="font-size:18px;"><?= $ah->ah_account_name; ?></b></th>
                                           
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            
                                            </tr>

                                            <?php
                                            $total_perc = 0;
                                            $total_fm_perc=0;
                                            foreach($ah->Charts as $ca)
                                            {

                                            if($ca->ytd_total>0)
                                            {
                                            $perc = number_format(($ca->ytd_total/$total_ytd)*100,2);
                                            } else
                                            {
                                            $perc=0;
                                            }

                                            if($ca->tran_total>0)
                                            {
                                            $fm_perc= number_format(($ca->tran_total/$total_first_month)*100,2);
                                            }
                                            else
                                            {
                                            $fm_perc=0;
                                            }
                                            ?>
                                            <tr>

                                            <td><?= $ca->ca_name; ?></td>
                                            
                                            <td><?php echo isset($ca->tran_total) ? $ca->tran_total : 0 ; ?></td>
                                            
                                            <td><?= $fm_perc ?> %</td>

                                            <td><?= $ca->ytd_total; ?></td>
                                            <td><?= $perc ?> %</td>

                                            </tr>

                                            
                                            <?php 
                                            $total_perc = $total_perc+$perc;
                                            $total_fm_perc=$total_fm_perc+$fm_perc;
                                            } 
                                            ?>


                                            <tr>

                                            <th><b style="font-size:13px;">Total <?= $ah->ah_account_name; ?></b></th>
                                           
                                            <td><?= $total_first_month; ?></td>
                                            <td><?=$total_fm_perc?> %</td>
                                            <td><?= $total_ytd; ?></td>
                                            <td><?=$total_perc ?> %</td>
                                            
                                            </tr>



                                            <?php 
                                            
                                        } */ ?>




                                            </tbody>



                                            <?php /*
                                            <tfoot>

                                            <tr class="no-sort">

                                            <td><b style="font-size:17px">Net Profit</b></td>
                                            
                                            <td><b></b></td>
                                            <td><b></b></td>
                                            <td><b><?= $grand_total_ytd; ?></b></td>
                                            <td><b></b></td>
                                          
                                            </tr>

                                            </tfoot>
                                            */
                                            ?>



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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>




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
        <?php }  */?>




        $('#filter_range').change(function(){

        var val = $(this).val();

        if(val !="Range")
        {
        $('.datepicker').attr('disabled',true);
        }
        else
        {
        $('.datepicker').attr('disabled',false);    
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
                //error placemenrt
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





$(document).ready(function(){
$(".excel_button").click(
            function () {
                tableToExcel('DataTable','Profit & Loss Account Report','Profit & Loss Account Report');
            }            
 );
})
function getIEVersion()
// Returns the version of Windows Internet Explorer or a -1
// (indicating the use of another browser).
{
    var rv = -1; // Return value assumes failure.
    if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
            rv = parseFloat(RegExp.$1);
    }
    return rv;
}

function tableToExcel(table, sheetName, fileName) {
    

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");
    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        return fnExcelReport(table, fileName);
    }

    var uri = 'data:application/vnd.ms-excel;base64,',
        templateData = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
        base64Conversion = function (s) { return window.btoa(unescape(encodeURIComponent(s))) },
        formatExcelData = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }

    $("tbody > tr[data-level='0']").show();

    if (!table.nodeType)
        table = document.getElementById(table)

    var ctx = { worksheet: sheetName || 'Worksheet', table: table.innerHTML }

    var element = document.createElement('a');
    element.setAttribute('href', 'data:application/vnd.ms-excel;base64,' + base64Conversion(formatExcelData(templateData, ctx)));
    element.setAttribute('download', fileName);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);

    $("tbody > tr[data-level='0']").hide();
}

function fnExcelReport(table, fileName) {
    
    var tab_text = "<table border='2px'>";
    var textRange;

    if (!table.nodeType)
        table = document.getElementById(table)

    $("tbody > tr[data-level='0']").show();
    tab_text =  tab_text + table.innerHTML;

    tab_text = tab_text + "</table>";
    tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
    tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    txtArea1.document.open("txt/html", "replace");
    txtArea1.document.write(tab_text);
    txtArea1.document.close();
    txtArea1.focus();
    sa = txtArea1.document.execCommand("SaveAs", false, fileName + ".xls");
    $("tbody > tr[data-level='0']").hide();
    return (sa);
}





$('body').on('click','.print_button',function(e){
    
    // Open the PDF generation script in a new window

    var pdfWindow = window.open('<?= base_url()."Accounts/Reports/PLAccount?".$_SERVER['QUERY_STRING']?>&action=Print', '_blank');

    // Automatically print when the PDF is loaded
    pdfWindow.onload = function() {
        pdfWindow.print();
    };

    });




    });




document.getElementById("email_button").addEventListener("click", function() {
    // Select the table element
    var range = document.createRange();
    range.selectNode(document.getElementById("DataTable"));
    window.getSelection().removeAllRanges();  // Clear any existing selections
    window.getSelection().addRange(range);    // Select the table content

    try {
        // Copy the selected content to clipboard
        var successful = document.execCommand('copy');
        if (successful) {
            // Alert to notify the user
            alertify.success("Table copied to clipboard! Please paste it in the email composer.");

            // Email subject and body message
            var subject = encodeURIComponent("General Ledger Report");
            var body = encodeURIComponent("Please paste the copied table here:\n\n");

            // Open the email composer
            window.location.href = "mailto:?subject=" + subject + "&body=" + body;

            // Optionally clear the selection after copying
            window.getSelection().removeAllRanges();
        } else {
            alertify.error("Failed to copy table.");
        }
    } catch (err) {
            alertify.error("Error in copying table: ", err);
    }
});



</script>





</script>








