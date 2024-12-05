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
                                                                                <td>
                                                                                    <select class="form-select droup_customer  customer_clz" name="customer">
                                                                                        <option value="" selected disabled>Select Customer</option>
                                                                                        <?php foreach($customer_creation as $cus_data){?>
                                                                                            <option value="<?php echo $cus_data->cc_id;?>" ><?php echo $cus_data->cc_customer_name;?></option>
                                                                                        <?php } ?>

                                                                                    </select>
                                                                                </td>
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

                                        <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="pdf" value="1">
                                            <button type="submit" class="pdf_button report_button">PDF</button>
                                        </form>


                                        <!-- <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1"> -->
                                        <button class="excel_button report_button" type="submit">Excel</button>
                                        <!-- </form> -->

                                        <!--<form method="POST" action="" target="_blank">
                                            <input type="hidden" name="pdf" value="1">-->
                                            <button class="print_button report_button" type="submit">Print</button>
                                        <!--</form>-->

                                        <!-- <form method="POST" action="" target="_blank">
                                            <input type="hidden" name="excel" value="1"> -->
                                        <button class="email_button report_button" type="submit" id="email_button">Email</button>
                                        <!-- </form> -->

                                        <button type="button" data-bs-toggle="modal" data-bs-target="#SalesSummery" class="btn btn-primary py-1">Search</button>
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

                                               $total_amount1 = 0 ;
                                             
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
                                                            else if($sale_data->link == "sales return"){

                                                                $href="Crm/SalesReturn";

                                                                $view = "view_rut";
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
                                                        <?php if($sale_data->amount_check == "sales return"){ ?> 
                                                             
                                                           
                                                            
                                                            <td class="height_class text-end" width="50px">-<?php echo format_currency($sale_data->amount); ?></td>

                                                            <?php   $total_amount =    $total_amount -  $sale_data->amount; ?>


                                                        <?php } else{ ?> 

                                                           

                                                            <td class="height_class text-end" width="50px"><?php echo format_currency($sale_data->amount); ?></td>

                                                            <?php   $total_amount =   $sale_data->amount +  $total_amount; ?>
                                                           
                                                            
                                                        <?php } ?>
                                                        
                                                        
                                                       
                                                    
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


        /*print button section start*/
        $('body').on('click','.print_button',function(e){
              
              // Open the PDF generation script in a new window
              var pdfWindow = window.open('<?= base_url()."Crm/SalesSummery/GetData/?".$_SERVER['QUERY_STRING']?>&action=Print', '_blank');
  
              // Automatically print when the PDF is loaded
              pdfWindow.onload = function() {
                  pdfWindow.print();
              };
  
          });
          


        


        /*form submit start*/

        /*$(".submit_btn").on('click', function(){ 

            $('#SalesSummery').modal("hide");

            $('#add_form')[0].reset();

            $('.customer_clz option').remove();

            $('.sales_order option').remove();
        });*/

    /*#####*/



    $(document).ready(function() {
            $(".excel_button").click(
                function() {
                    tableToExcel('DataTable', 'Sales Summery', 'Sales Summery');
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
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
            {
                return fnExcelReport(table, fileName);
            }

            var uri = 'data:application/vnd.ms-excel;base64,',
                templateData = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
                base64Conversion = function(s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                },
                formatExcelData = function(s, c) {
                    return s.replace(/{(\w+)}/g, function(m, p) {
                        return c[p];
                    })
                }

            $("tbody > tr[data-level='0']").show();

            if (!table.nodeType)
                table = document.getElementById(table)

            var ctx = {
                worksheet: sheetName || 'Worksheet',
                table: table.innerHTML
            }

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
            tab_text = tab_text + table.innerHTML;

            tab_text = tab_text + "</table>";
            tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
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
        window.getSelection().removeAllRanges(); // Clear any existing selections
        window.getSelection().addRange(range); // Select the table content

        try {
            // Copy the selected content to clipboard
            var successful = document.execCommand('copy');
            if (successful) {
                // Alert to notify the user
                alert("Table copied to clipboard! Please paste it in the email composer.");

                // Email subject and body message
                var subject = encodeURIComponent("Invoice Report");
                var body = encodeURIComponent("Please paste the copied table here:\n\n");

                // Open the email composer
                window.location.href = "mailto:?subject=" + subject + "&body=" + body;

                // Optionally clear the selection after copying
                window.getSelection().removeAllRanges();
            } else {
                console.log("Failed to copy table.");
            }
        } catch (err) {
            console.error("Error in copying table: ", err);
        }
    });
</script>


