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
                                <form method="GET"  class="Dashboard-form class">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Aged Receivables/Payments Report</h5>
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
                                                                                        
                                                                                        <option>Select Account</option>

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

                                                                            <option value="<?= $account->cc_id; ?>"><?= $account->cc_customer_name; ?></option>

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


                                                                            <td>Date</td>

                                                                            <td>
                                                                            <input class="form-control datepicker" type="text"  name="start_date" readonly/>
                                                                            </td>

                                                                            </tr>





                                                                        


                                                                            <tr>

                                                                            <td>GL Account</td>

                                                                            <td>

                                                                            <select class="form-control" name="filter_account">

                                                                            <option value="">Select Account</option>
                                                                            
                                                                            <?php foreach($accounts as $account){ ?>

                                                                            <option value="<?= $account->cc_id; ?>"><?= $account->cc_customer_name; ?></option>

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
                                                                            <td><a href="<?= base_url(); ?>Accounts/Reports/StatementOfAccounts">Clear</a></td>
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
                                        <h4 class="card-title mb-0 flex-grow-1">View Aged Recievables & Payables</h4>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#SalesQuotReport" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>

                                                <tr>
                                                    <th>Voucher Number</th>
                                                    <th>Date</th>
                                                    <th>Purchase Order</th>
                                                    <th>Debit Amount</th>
                                                    <th>Credit Amount</th>
                                                    <th>PDC Allocation</th>
                                                    <th>Cum Balance</th>
                                                </tr>

                                            </thead>


                                            
                                            <tbody class="tbody_data">




                                              <?php 
                                            $total_credit=number_format(0,2);
                                            foreach($payments as $pay){ ?>

                                            <tr>
                                            <td><?= $pay->pay_ref_no; ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($pay->pay_date)); ?></td>
                                            <td></td>
                                            <td>---</td>
                                            <td><?= $pay->pay_total; ?></td>
                                            <td></td>
                                            <td>Balance</td>
                                            </tr>

                                            <?php 
                                            $total_credit = $total_credit+number_format($pay->pay_total,2);;
                                            } 
                                            ?>


                                            <?php 

                                            $total_debit=number_format(0,2);

                                            foreach($receipts as $rec){ ?>

                                            <tr>
                                            <td><?= $rec->r_ref_no; ?></td>
                                            <td><?php echo date('d-m-Y',strtotime($rec->r_date)); ?></td>
                                            <td></td>
                                            <td><?= $rec->r_amount; ?></td>
                                            <td>---</td>
                                            <td></td>
                                            <td>Balance</td>
                                            </tr>

                                            <?php 

                                            $total_debit = $total_debit+number_format($rec->r_amount,2);

                                            } ?>


                                            </tbody>



                                            <tfoot>

                                            <tr class="no-sort">
                                           
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?= $total_debit; ?></b></td>
                                            <td><b><?= $total_credit; ?></b></td>
                                            <td><b>0.00</b></td>
                                            <td><b>0.00</b></td>
                                            </tr>

                                            </tfoot>



                                        </table>





                                        <table class="table table-bordered">


                                        <thead>

                                        <tr>

                                            <th>Receipt No</th>

                                            <th>Receipt Date</th>

                                            <th>Cheque No</th>

                                            <th>Cheque Date</th>

                                            <th>Bank</th>

                                            <th>Amount</th>

                                        </tr>

                                        </thead>



                                        <tbody>

                                        <tr>

                                            <td>RV-2020-00015</td>

                                            <td>25-Aug-2020</td>

                                            <td>01000286</td>

                                            <td>20-Oct-2020</td>

                                            <td>Doha Bank</td>

                                            <td>4,500.00</td>

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

        <?php if(empty($_GET)){ ?>
        $(window).on('load', function() {
            $('#SalesQuotReport').modal('show');
        });
        <?php } ?>




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








