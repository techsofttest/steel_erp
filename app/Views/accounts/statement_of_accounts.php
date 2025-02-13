
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
                                            <h5 class="modal-title" id="exampleModalLabel">Statement Of Accounts</h5>
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





                                                                       



                                                                            <tr id="Account"  class="account_parent">

                                                                            <td>Account</td>

                                                                            <td>

                                                                            <select class="form-control account_select2_common" name="filter_account">
                     

                                                                            </select>

                                                                            </td>


                                                                            </tr>



                                                                            <tr>


                                                                            <td>Date Range</td>

                                                                            <td>
                                                                            <input class="form-control datepicker" type="text"  name="start_date" readonly/>
                                                                            </td>

                                                                            <td>
                                                                            <input class="form-control datepicker" type="text"  name="end_date" readonly/>
                                                                            </td>


                                                                            </tr>


                                                                        
                                                                        </thead>
                                                                     
                                                                    
                                                                    </table>



                                                                    <div class="row my-2">

                                                                    <div class="col-lg-6 text-center">
                                                                    Receivable <input type="radio" name="ac_type" value="r">
                                                                    </div>
                                                                    

                                                                    <div class="col-lg-6 text-center">
                                                                    Post Date Cheques <input type="checkbox" name="pdc" value="pdc">
                                                                    </div>                                         

                                                                    </div>

                                                                    <div class="row my-2">

                                                                   

                                                                    <div class="col-lg-6 text-center">
                                                                    Payable <input type="radio" name="ac_type" value="p">
                                                                    </div>  
                                                                    <div class="col-lg-6 text-center"></div>

                                                                   

                                                                    </div>



                                                                    <div class="row my-2">

                                                                    <div class="col-lg-6 text-center">
                                                                    Both <input type="radio" name="ac_type" value="b">
                                                                    </div>  
                                                                    <div class="col-lg-6 text-center"></div>                                           

                                                                    </div>



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
                                        <h4 class="card-title mb-0 flex-grow-1 text-center">View Statement Of Accounts</h4>


                                        <?php if(!empty($_GET)) { ?>

                                        <form method="POST" action="" target="_blank">
                                        <input type="hidden" name="pdf" value="1">
                                        <button type="submit"  class="pdf_button report_button" >PDF</button>
                                        </form>

                                        <button id="btnExport" class="excel_button report_button">Excel</button>


                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button class="print_button report_button" type="submit">Print</button>
                                        </form>


                                        <button id="email_button" class="email_button report_button">Email</button>


                                        <?php } ?>



                                        <button type="button" data-bs-toggle="modal" data-bs-target="#SalesQuotReport" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>

                                                <tr>
                                                    <th>Voucher Number</th>
                                                    <th>Date</th>
                                                    <th>Purchase Order</th>
                                                    <th class="text-end">Debit Amount</th>
                                                    <th class="text-end">Credit Amount</th>
                                                    <th class="text-end">Balance</th>
                                                </tr>

                                            </thead>


                                            
                                            <tbody class="tbody_data">


                                            <?php 
                                            $total_credit=number_format(0,2);
                                            $pdc_total = number_format(0,2);
                                            if(empty($c_balance))
                                            {
                                            $c_balance = 0 ;
                                            }

                                            $c_balance = 0 ;
                                           
                                            ?>

                                            <?php 

                                            $total_debit=number_format(0,2);


                                            // Initialize Aging Bucket Totals
                                            $aging_totals = [
                                                "30" => 0,
                                                "60" => 0,
                                                "90" => 0,
                                                "90+" => 0
                                            ];


                                            foreach($transactions as $trn){ 


                                                $days_due = (strtotime(date('Y-m-d')) - strtotime($trn->transaction_date)) / (60 * 60 * 24);
                                                    
                                                    // Determine Aging Bucket
                                                    if ($days_due <= 30) {
                                                        $aging_bucket = "30";
                                                    } elseif ($days_due <= 60) {
                                                        $aging_bucket = "60";
                                                    } elseif ($days_due <= 90) {
                                                        $aging_bucket = "90";
                                                    } else {
                                                        $aging_bucket = "90+";
                                                    }

                                                ?>




                                                <tr>
    
                                                <td><?= $trn->reference; ?></td>
    
                                                <td><?php echo date('d M Y',strtotime($trn->transaction_date)); ?></td>
    
                                                <td><?php if(!empty($trn->purchase_order)) { echo $trn->purchase_order; } ?></td>
    
                                                <td align="right" class="text-end"> 
    
                                                <?php if($trn->debit_amount !="") { 
                                                echo  format_currency($trn->debit_amount);
                                                $total_debit = $total_debit+$trn->debit_amount;
                                                $c_balance = $c_balance + $trn->debit_amount;

                                                $aging_totals[$aging_bucket] += $trn->debit_amount;

                                                } else {?>
                                                    ---
                                                <?php } ?>
                                            
                                                </td>
    
                                                <td align="right">
    
                                                <?php if($trn->credit_amount !="") { 
                                                echo  format_currency($trn->credit_amount); 
                                                $total_credit=$total_credit+$trn->credit_amount;
                                                $c_balance = $c_balance + $trn->credit_amount;

                                                $aging_totals[$aging_bucket] += $trn->credit_amount;

                                                } else {?>
                                                ---
                                                <?php } ?>
    
                                                </td>
    
                                               
    
                                                <td class="text-end"><?= format_currency($c_balance); ?></td>
    
                                                </tr>
    
                                                <?php 
    
                                                } ?>
                                            


                                            </tbody>


                                            <tfoot>

                                            <tr class="no-sort">
                                           
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td align="right" class="text-end"><b style="text-align:right"><?= format_currency($total_debit); ?></b></td>
                                            <td align="right" class="text-end"><b style="text-align:right"><?= format_currency($total_credit); ?></b></td>
                                            <td align="right" class="text-end"><b style="text-align:right"><?= format_currency($c_balance); ?></b></td>
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

                                                <th class="text-end">Amount</th>

                                            </tr>

                                            </thead>


                                        <tbody>


                                    <?php foreach($post_dated_cheques as $pdc){?>

                                    <tr>

                                        <td><?= $pdc->reference; ?></td>

                                        <td><?= date('d M Y',strtotime($pdc->transaction_date)); ?></td>

                                        <td><?= $pdc->cheque_no; ?></td>

                                        <td><?= date('d M Y',strtotime($pdc->cheque_date)); ?></td>

                                        <td><?= $pdc->bank ?></td>

                                        <td align="right"><?= format_currency($pdc->amount) ?></td>

                                    </tr>

                                    <?php } ?>

                                    </tbody>

                                    </table>



                                    <table class="table table-bordered">


                                    <thead>

                                    <tr>

                                    <th class="text-center"><b>Net Amount Due : <?= currency_to_words($c_balance); ?></b></th>

                                    <tr>



                                    </thead>

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
        //$('.datepicker').attr('disabled',true);
        }
        else
        {
        //$('.datepicker').attr('disabled',false);    
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






        




        $(document).ready(function(){
        $(".excel_button").click(
                    function () {
                        tableToExcel('DataTable','Aged Recievables Payables Summary','Aged Recievables Payables Summary');
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




        


    });








</script>








