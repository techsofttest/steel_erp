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
                                            <h5 class="modal-title" id="exampleModalLabel">Fixed Asset Report</h5>
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


                                                                        <tr id="range_picker">

                                                                        <td>Date</td>

                                                                        <td>
                                                                        <input class="form-control datepicker" type="text"  name="end_date" readonly/>
                                                                        </td>

                                                                        </tr>



                                                                        <tr>
                                                                                <td>Account Type</td>
                                                                               
                                                                                <td>

                                                                                    <select class="form-control" name="filter_type" id="filter_type">
                                                                                        
                                                                                        <option value="">Select Account Type</option>

                                                                                        
                                                                                       
                                                                                        <option value="Account_Head">Account Head</option>

                                                                                        <option value="Account_Type">Account Type</option>
                                                                                        
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


                                
                                                                            
                                                                        
                                                                        </thead>
                                                                     
                                                                    
                                                                    
                                                                     </table>
                                                                   



                                                                </div>

                                                                <!--table section end-->

                                                                <div style="float: right;">
                                                                    <table class="table table-bordered table-striped enq_tab_submit menu">
                                                                        <tr>
                                                                            <td><a href="<?= base_url(); ?>Accounts/Reports/TrialBalance">Clear</a></td>
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

                                <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;font-weight: 600;color: black;">View Fixed Asset Report <?php if(!empty($from_dates) && !empty($to_dates)){?>(<?php echo $from_dates;?> To <?php echo $to_dates;?>)<?php } ?></h4>
                                
                                
                                <?php if( (!empty($_GET)) ) { ?>



                                <form method="POST"  target="_blank">
                                    <input type="hidden" name="pdf" value="1">
                                    <button type="submit"  class="pdf_button report_button" >PDF</button>
                                </form>


                               
                                    <button id="excel_btn_export" class="excel_button report_button" >Excel</button>
                                
                                
                                    <button class="print_button report_button" type="button">Print</button>
                                

                                
                                <button id="email_button" class="email_button report_button" type="button">Email</button>
                                
                                <?php } ?>

                                <button type="button" data-bs-toggle="modal" id="clear_data" data-bs-target="#SalesQuotReport" class="btn btn-primary py-1">Search</button>
                                
                            
                            </div>
                                
                                <!-- end card header -->



                                    <div class="card-body">
                                        <table id="" class="table table-bordered table-striped delTable display dataTable">
                                            
                                            <thead>

                                                <tr>
                                                  
                                                    <th align="right" style="text-align:center;">Description</th>
                                                    <th align="right" style="text-align:right;">Date Acquired</th>
                                                    <th align="right" style="text-align:right;">Purchase Value</th>
                                                    <th align="right" style="text-align:right;">Percentage</th>
                                                    <th align="right" style="text-align:right;">Entitlement</th>
                                                    <th align="right" style="text-align:right;">Depreciation</th>
                                                    <th align="right" style="text-align:right;">Disaposal</th>
                                                    <th align="right" style="text-align:right;">WDV</th>
                                                    
                                                </tr>

                                            </thead>
                                            

                                            <tbody class="tbody_data">

                                                    <?php foreach($accounts as $account){ ?>

                                                     <tr>

                                                        <td colspan="8"><b><?php echo $account->ah_account_name; ?> </b></td>
                                                        

                                                     </tr>   

                                                    <?php foreach($account->items as $it) { ?>

                                                    <tr>
                                                        <td><?= $it->cfs_description; ?></td>
                                                        <td style="text-align:right;"><?= date('d M Y',strtotime($it->cfs_acquired_date)) ?></td>
                                                        <td style="text-align:right;"><?php echo $it->dpc_amount; ?></td>
                                                        <td style="text-align:right;"><?= $it->cfs_depreciation ?>%</td>
                                                        <td style="text-align:right;"><?= $it->dpcd_entitlement ?></td>
                                                        <td style="text-align:right;"><?= $it->dpc_depreciation; ?></td>
                                                        <td style="text-align:right;"></td>
                                                        <td style="text-align:right;"><?php echo $it->dpc_amount; ?></td>
                                                    </tr>

                                                    <?php } ?>

                                                    <tr>
                                                        <td></td>
                                                        <td style="text-align:right;"></td>
                                                        <td style="text-align:right;"></td>
                                                        <td style="text-align:right;"></td>
                                                        <td style="text-align:right;"></td>
                                                        <td style="text-align:right;"></td>
                                                        <td style="text-align:right;"></td>
                                                        <td style="text-align:right;"></td>
                                                    </tr>

                                                    <?php } ?>




                                            </tbody>



                                            <tfoot>

                                            <tr class="no-sort">

                                            <td></td>
                                            <td><b style="font-size:20px;"></b></td>
                                            <td style="text-align:right;"><b></b></td>
                                            <td align="right" style="text-align:right;"><b></b></td>
                                            <td align="right" style="text-align:right;"><b></b></td>
                                            <td style="text-align:right;"><b></b></td>
                                            <td></td>
                                            <td style="text-align:right;"><b></b></td>
                                          
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






        
    $(document).ready(function(){
$("#excel_btn_export").click(
            function () {
                tableToExcel('DataTable','Trial Balance Report','Trial Balance Report');
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

    var pdfWindow = window.open('<?= base_url()."Accounts/Reports/TrialBalance?".$_SERVER['QUERY_STRING']?>&action=Print', '_blank');

    // Automatically print when the PDF is loaded
    pdfWindow.onload = function() {
        pdfWindow.print();
    };

    });





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
            var subject = encodeURIComponent("Trial Balance Report");
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








