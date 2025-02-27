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
                        <div class="modal fade" id="SearchModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form method="GET" onSubmit="return closeSearchModal();" target="<?php if(empty($_GET)) { echo "_blank"; } ?>" class=" class">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bank Reconciliation Statement</h5>
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

                                                                      <td>GL Account</td>

                                                                      <td>

                                                                      <select class="form-control" name="filter_account" required>

                                                                      <option value="">Select Account</option>

                                                                      <?php foreach($accounts as $account){ ?>

                                                                      <option value="<?= $account->ca_id; ?>"><?= $account->ca_name; ?></option>

                                                                      <?php } ?>

                                                                      </select>

                                                                      </td>


                                                                      </tr>
                                                                      




                                                                            <tr>

                                                                            <td>Date </td>

                                                                            <td>
                                                                            <input class="form-control datepicker" type="text"  name="end_date" required readonly/>
                                                                            
                                                                            </td>


                                                                            </tr>
                                                                            
                                                                        
                                                                        </thead>
                                                                    
                                                                    
                                                                     </table>



                                                                </div>

                                                                <!--table section end-->

                                                                <div style="float: right;">
                                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                                        <tr>
                                                                            <td><a href="<?= base_url(); ?>Accounts/Reports/BankReconciliation">Clear</a></td>
                                                                            <!--<td><button>Excel</button></td>
                                                                            <td><button>PDF</button></td>
                                                                            <td><button>Email</button></td>-->
                                                                            <td><button type="submit" data-bbs-dismiss="modal">View</button></td>
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
                                        <h4 class="card-title mb-0 flex-grow-1">View Bank Reconciliation Statement</h4>

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


                                        <button type="button" data-bs-toggle="modal" data-bs-target="#SearchModal" class="btn btn-primary py-1">Search</button>
                                    
                                    </div>
                                    <!-- end card header -->
                                    
                                    <div class="card-body">

                                    <?php if(!empty($_GET)) { ?>

                <table border="1"  class="table table-bordered">

    <thead>
    <tr>
      
      <th colspan="3"><b><?= $bank_account; ?></b></th>

      <th colspan="2" class="text-end"><b>Bank Statement Date: <?php if(!empty($_GET['end_date'])) { echo  date('d M Y',strtotime($_GET['end_date'])); } ?></b></th>

    </tr>
  </thead>

  <tbody>

    <tr>
      <td colspan="3">Beginning GL Balance</td>
      <td colspan="2" class="text-end"><?php echo format_currency($b_gl_balance); ?></td>
    </tr>

    <tr>
      <td colspan="3">Add: Cash Receipts</td>
      <td colspan="2" class="text-end"><?php echo format_currency($add_cash_receipt); ?></td>
    </tr>

    <tr>
      <td colspan="3">Less: Cash Disbursements</td>
      <td colspan="2" class="text-end"><?php echo format_currency($less_cash_dis); ?></td>
    </tr>

    <tr>
      <td colspan="3">Add (Less) Other</td>
      <td colspan="2" class="text-end"></td>
    </tr>

    <tr>
      <td colspan="3">Ending GL Balance</td>
      <td colspan="2" class="text-end"><?php echo format_currency($e_gl_balance); ?></td>
    </tr>

    <tr>
      <td colspan="3">Ending Bank Balance</td>
      <td colspan="2" class="text-end"><?php echo format_currency($e_bank_balance); ?></td>
    </tr>


    <tr>
      <td colspan="5"></td>
    </tr>

    <tr>
      <td colspan="5"><strong>Add back deposits in transit</strong></td>
    </tr>


    <?php foreach($transactions as $trn_debit){ 
    if($trn_debit->credit_amount<1)
    {
    ?>

    <tr>
      <td><?=  $trn_debit->account_name; ?></td>
      <td><?php echo date('d M Y',strtotime($trn_debit->transaction_date)); ?></td>
      <td><?= $trn_debit->reference; ?></td>
      <td  class="text-end"><?= format_currency($trn_debit->debit_amount); ?></td>
      <td></td>
    </tr>
 
    <?php
    }
    ?>

    <?php } ?>


    <tr>
      <td colspan="3"><b>Total deposits in transit</b></td>
      <td colspan="2" class="text-end"><b><?= format_currency($total_deposits)  ?></b></td>
      <td></td>
    </tr>


    <tr>
      <td colspan="5"></td>
    </tr>


    <tr>
      <td colspan="5"><strong>(Less) outstanding checks</strong></td>
    </tr>

    <?php foreach($transactions as $trn_credit){ 
    if($trn_credit->debit_amount<1)
    {
    ?>

    <tr>
      <td><?=  $trn_credit->account_name; ?></td>
      <td><?php echo date('d M Y',strtotime($trn_credit->transaction_date)); ?></td>
      <td><?= $trn_credit->reference; ?></td>
      <td class="text-end"><?= format_currency($trn_credit->credit_amount); ?></td>
      <td></td>
    </tr>
 
    <?php
    }
    ?>

    <?php } ?>
  
  
   
 


    <tr>
      <td colspan="3"><b>Total outstanding checks</b></td>
      <td colspan="2" class="text-end"><b><?= format_currency($total_outstanding) ?></b></td>
    </tr>


    <tr>
      <td colspan="3">Add (Less) Other</td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="3">Total other</td>
      <td colspan="2">-</td>
    </tr>
    <tr>
      <td colspan="3">Unreconciled difference</td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="3"><b>Ending GL Balance</b></td>
      <td colspan="2" class="text-end"><?php  ?></td>
    </tr>
  </tbody>
</table>


<?php } ?>




                
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

        //$data[''];



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


        
$(document).ready(function(){
    $("#btnExport").click(
                function () {
                    tableToExcel('DataTable','Statement Of Accounts','Statement Of Accounts');
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



<script>


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



function closeSearchModal()
{

$('#SearchModal').modal('hide');

}




</script>









