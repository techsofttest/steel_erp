
<div class="tab-content text-muted">
								
    <div class="tab-pane active" id="nav-crm-top-1-1" role="tabpanel">
                    
        <div class="row">
            
            <div class="col-lg-12">
                
                <!-- Tab panes -->
                <div class="tab-content text-muted">
                    <!--product head tab--> 
                    <div class="tab-pane active" id="arrow-1" role="tabpanel">
                        
                        
                        <!--sales rout report modal start-->
                        <div class="modal fade" id="JobProfitability" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form  class="Dashboard-form class" method="GET" target="_blank" action="<?php echo base_url();?>Crm/JobProfitability/GetData" id="add_form">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Job profitability</h5>
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
                                                                                <td style="padding: 0px !important;"><input type="date" name="form_date" id="" onclick="this.showPicker();"  class="form-control"></td>
                                                                                <td style="width: 10% !important;text-align: center;">To</td>
                                                                                <td style="padding: 0px !important;"><input type="date" name="to_date" id="" onclick="this.showPicker();" class="form-control"></td>
                                                                            
                                                                            </tr>
                                                                            
                                                                        
                                                                        </thead>

                                                                    
                                                                        <tbody  class="travelerinfo">
                                                                            
                                                                            <tr>
                                                                                <td>Customer</td>
                                                                                <td>
                                                                                    <select class="form-select droup_customer  customer_clz" name="customer">
                                                                                        <option value="" selected disabled>Select Customer</option>
                                                                                        <?php foreach($customer_creation as $cust_creation){?> 
                                                                                            <option value="<?php echo $cust_creation->cc_id;?>"><?php echo $cust_creation->cc_customer_name;?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>


                                                                            <tr>
                                                                                <td>Sales Order Ref</td>
                                                                                <td>
                                                                                    <select class="form-select sales_order_ref sales_order" name="sales_order">
                                                                                        <option value="" selected disabled>Select Order Ref</option>
                                                                                        <?php foreach($sales_orders_data as $sales_data){?> 
                                                                                            <option value="<?php echo $sales_data->so_id; ?>"><?php echo $sales_data->so_reffer_no;?></option>    
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
                                                                                    <select class="form-select executive_clz" name="sales_executive">
                                                                                        <option value="" selected disabled>Select Executive</option>
                                                                                        <?php foreach($sales_executive as $sals_exec){?> 
                                                                                            <option value="<?php echo $sals_exec->se_id;?>"><?php echo $sals_exec->se_name; ?></option>    
                                                                                        <?php } ?>
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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">View Job Profitability <?php if(!empty($from_dates) && !empty($to_dates)){?>(<?php echo $from_dates;?> To <?php echo $to_dates;?>)<?php } ?></h4>
                                        
                                        <form method="POST" target="_blank">
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
                                        
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#JobProfitability" class="btn btn-primary py-1">Search</button>
                                    </div><!-- end card header -->
                                    <div class="card-body">
                                        <table id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort">Sl no</th>
                                                    <th>Date</th>
                                                    <th>Sales Order Ref</th>
                                                    <th>Customer Name</th>
                                                    <th>Invoice Ref</th>
                                                    <th>LPO Ref</th>
                                                    <th>Sales Executive</th>
                                                    <th class="text-end">Revenue</th>
                                                    <th style="width:100px" class="text-end">Expenses</th>
                                                    <th style="width:100px" class="text-end">Gross Profit</th>
                                                    <th style="width:100px" class="text-end">%</th>
                                                 
                                                </tr>
                                            </thead>
                                            
                                            <tbody class="tbody_data">
                                            <?php
                                               


                                                if(!empty($sales_orders))
                                                {   
                                                    $revenue =0 ;

                                                    $expenses1 = 0;
                                                    $expenses2 = 0;
                                                    $expenses3 = 0;
                                                    $expenses4 = 0;
                                                    $expenses5 = 0;
    
                                                    $gross_profit1 = 0;
                                                    $gross_profit2 = 0;
                                                    $gross_profit3 = 0;
                                                    $gross_profit4 = 0;
                                                    $gross_profit5 = 0;
    
                                                    $percentage1 = 0;
                                                    $percentage2 = 0;
                                                    $percentage3 = 0;
                                                    $percentage4 = 0;
                                                    $percentage5 = 0;

                                                    $i=1;
                                                    foreach($sales_orders as $sales_order){
                                                         
                                                    ?> 
                                                   
                                                    <tr>

                                                        <td><?php echo $i;?></td>
                                                        <td><?php echo date('d-M-Y',strtotime($sales_order->so_date));?></td>
                                                        <td><a href="<?php echo base_url();?>Crm/SalesOrder?view_so=<?php echo $sales_order->so_id;?>" target="_blank"><?php echo $sales_order->so_reffer_no;?></a></td>
                                                       
                                                        <td><?php echo $sales_order->cc_customer_name;?></td>

                                                        <td colspan="1" align="left" class="p-0">
                                                            <table>
                                                            <?php 

                                                                if(!empty($sales_order->purchase_vouchers)){
                                                                
                                                                foreach ($sales_order->purchase_vouchers as $pur_vouch) { ?> 
                                                                                
                                                                <tr style="background: unset;border-bottom: hidden !important;">
                                                                    
                                                                    <td  style="width:100px" ><?php echo $pur_vouch->pv_reffer_id; ?> </td>

                                                                   
                                                                    
                                                                    
                                                                </tr>

                                                            <?php } } 
                                                                
                                                                if(!empty($sales_order->purchase_return_prod)){

                                                                    foreach($sales_order->purchase_return_prod as $pv_prod){ ?> 

                                                                    <tr style="background: unset;border-bottom: hidden !important;">
                                                                    
                                                                        <td  style="width:100px" ><?php echo $pv_prod->pr_reffer_id; ?> </td>
                                                                    
                                                                    
                                                                    </tr>


                                                                <?php    }  }

                                                                if(!empty($sales_order->petty_cash)){
                                                                
                                                                    foreach($sales_order->petty_cash as $p_cash){ ?>

                                                                    <tr style="background: unset;border-bottom: hidden !important;">
                                                                    
                                                                        <td  style="width:100px" ><?php echo $p_cash->pcv_voucher_no; ?> </td>
                                                                
                                                                
                                                                    </tr>  

                                                                <?php  } }

                                                                if(!empty($sales_order->journal_voucher)){
                                                                    
                                                                    foreach($sales_order->journal_voucher as $jour_vouch){ ?> 
                                                                      
                                                                    <tr style="background: unset;border-bottom: hidden !important;">
                                                                    
                                                                        <td  style="width:100px" ><?php echo $jour_vouch->jv_voucher_no; ?> </td>
                                                                
                                                                    </tr>  
                                                                    
                                                                    <?php } }
                                                                
                                                                

                                                                
                                                                ?>                        
                                                                                            
                                                            </table>
                                                        </td>


                                                        <td><?php echo $sales_order->so_lpo;?></td>

                                                        <td><?php echo $sales_order->se_name;?></td>

                                                        <td class="text-end"><?php echo $sales_order->so_amount_total;?></td>

                                                        <?php $revenue = $sales_order->so_amount_total + $revenue; ?>

                                                        <td colspan="3" align="left" class="p-0">
                                                            <table>
                                                            <?php 

                                                                if(!empty($sales_order->purchase_vouchers)){
                                                                
                                                                foreach ($sales_order->purchase_vouchers as $pur_vouch) { ?> 
                                                                                
                                                                <tr style="background: unset;border-bottom: hidden !important;">
                                                                    
                                                                    <td   style="width:100px" class="text-end"><?php echo format_currency($pur_vouch->pvp_amount); ?> </td>



                                                                    <?php 

                                                                        $expenses1  = $pur_vouch->pvp_amount + $expenses1;
                                                                    
                                                                        $gross_profit =  $sales_order->so_amount_total - $pur_vouch->pvp_amount; 
                                                                        
                                                                    ?>

                                                                    <td style="width:100px" class="text-end"><?php echo format_currency($gross_profit); ?></td>

                                                                    <?php 
                                                                        $gross_profit1 =  $gross_profit +   $gross_profit1; 

                                                                        $percentage = $gross_profit * 100;

                                                                        $percentage1 =  $percentage +  $percentage1;

                                                                        
                                                                    ?>

                                                                    <td style="width:100px" class="text-end"><?php echo format_currency($percentage); ?></td>

                                                                    
                                                                </tr>

                                                            <?php } } 
                                                                
                                                                if(!empty($sales_order->purchase_return_prod)){

                                                                    foreach($sales_order->purchase_return_prod as $pv_prod){ ?> 

                                                                    <tr style="background: unset;border-bottom: hidden !important;">
                                                                    
                                                                        <td style="width:100px" class="text-end"><?php echo format_currency($pv_prod->prp_rate); ?> </td>

                                                                        <?php 

                                                                            $expenses2  = $pv_prod->prp_rate + $expenses2;
                                                                    
                                                                            $gross_profit =  $sales_order->so_amount_total - $pv_prod->prp_rate;
                                                                            
                                                                            $gross_profit2 =  $gross_profit +   $gross_profit2; 
                                                                            
                                                                        ?>

                                                                        <td style="width:100px" class="text-end"><?php echo format_currency($gross_profit); ?></td>

                                                                        <?php 
                                                                        
                                                                            $percentage = $gross_profit * 100;
                                                                            
                                                                            
                                                                            $percentage2 =  $percentage +  $percentage2;
                                                                        
                                                                        ?>

                                                                        <td style="width:100px" class="text-end"><?php echo format_currency($percentage); ?></td>

                                                                    
                                                                    </tr>


                                                                <?php  }  }

                                                                if(!empty($sales_order->petty_cash)){

                                                                    foreach($sales_order->petty_cash as $p_cash){ ?>

                                                                    <tr style="background: unset;border-bottom: hidden !important;">
                                                                    
                                                                        <td style="width:100px" class="text-end"><?php echo format_currency($p_cash->pci_amount); ?> </td>

                                                                        <?php 

                                                                            $expenses3  = $p_cash->pci_amount + $expenses3;

                                                                            $gross_profit =  $sales_order->so_amount_total - $p_cash->pci_amount; 

                                                                            $gross_profit3 =  $gross_profit +   $gross_profit3;
                                                                            
                                                                        ?>

                                                                        <td style="width:100px" class="text-end"><?php echo format_currency($gross_profit); ?></td>

                                                                        <?php 
                                                                        
                                                                            $percentage = $gross_profit * 100;

                                                                            $percentage3 =  $percentage + $percentage3;
                                                                            
                                                                        ?>

                                                                        <td style="width:100px" class="text-end"><?php echo format_currency($percentage); ?></td>
                                                                
                                                                
                                                                    </tr>  

                                                                <?php  } }

                                                                if(!empty($sales_order->journal_voucher)){

                                                                    foreach($sales_order->journal_voucher as $jour_vouch){ ?> 
                                                                      
                                                                    <tr style="background: unset;border-bottom: hidden !important;">
                                                                    
                                                                        <td  style="width:100px" class="text-end">
                                                                            
                                                                            <?php if(!empty($jour_vouch->ji_debit)){ echo  format_currency($jour_vouch->ji_debit); } 
                                                                            elseif($jour_vouch->ji_credit){ echo format_currency($jour_vouch->ji_credit); }?> 
                                                                            
                                                                        </td>
                                                                        
                                                                        <?php if(!empty($jour_vouch->ji_debit)){

                                                                          $expenses4  = $jour_vouch->ji_debit + $expenses4;
                                                                          
                                                                          $gross_profit =  $sales_order->so_amount_total - $jour_vouch->ji_debit;
                                                                          
                                                                          $gross_profit4 =  $gross_profit +   $gross_profit4;

                                                                        ?> 
                                                                             
                                                                             <td style="width:100px" class="text-end"><?php echo format_currency($gross_profit); ?></td> 

                                                                             <?php 
                                                                             
                                                                                $percentage = $gross_profit * 100;

                                                                                $percentage4 =  $percentage +  $percentage4;
                                                                                
                                                                            ?>

                                                                              <td style="width:100px" class="text-end"><?php echo format_currency($percentage); ?></td>
                                                                            
                                                                        <?php } elseif(!empty($jour_vouch->ji_credit)){
                                                                            
                                                                            $expenses5  = $jour_vouch->ji_credit + $expenses5;

                                                                            $gross_profit =  $sales_order->so_amount_total - $jour_vouch->ji_credit;

                                                                            $gross_profit5 =  $gross_profit +   $gross_profit5;

                                                                        ?>
                                                                            
                                                                            <td style="width:100px" class="text-end"><?php echo format_currency($gross_profit); ?></td> 

                                                                            <?php 
                                                                                
                                                                                $percentage5 = $gross_profit * 100; 

                                                                                $percentage5 =  $percentage +  $percentage5;
                                                                                
                                                                            ?>

                                                                            <td style="width:100px" class="text-end"><?php echo format_currency($percentage); ?></td>
                                                                            
                                                                        <?php } ?>
                                                                
                                                                    </tr>  
                                                                    
                                                                    <?php } }

                                                                    $expenses =  $expenses1 + $expenses2 + $expenses3 + $expenses4 + $expenses5;

                                                                    $total_gross_profit = $gross_profit1 +  $gross_profit2 +  $gross_profit3 + $gross_profit4 +  $gross_profit5;
                                                                    
                                                                    $total_percentage =  $percentage1 + $percentage2 + $percentage3 + $percentage4 + $percentage5;
                                                                ?>                        
                                                                                            
                                                            </table>
                                                        </td>

                                                        

                                                       
                                                        
                                                        

                                                        
     
                                                        
                                                    </tr>
                                                        
                                                    <?php  $i++; } ?> 
                                                    
                                                    <tr>
                                                        <td>Total</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-end"><b><?php echo format_currency($revenue); ?></b></td>
                                                        <td class="text-end"><b><?php echo format_currency($expenses); ?></b></td>
                                                        <td class="text-end"><b><?php echo format_currency($total_gross_profit); ?></b></td>
                                                        <td class="text-end"><b><?php echo format_currency($total_percentage); ?></b></td>
                                                      
                                                    </tr>
                                                    
                                                <?php   } ?>
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
            $('#JobProfitability').modal('show');
        });

        <?php endif; ?>
        
        
        /*modal open end*/


        /* customer droup drown */
         /*$(".droup_customer").select2({
            placeholder: "Select Customer",
            theme : "default form-control- customer_width",
            dropdownParent: $('#JobProfitability'),

            ajax: {
                url: "<?= base_url(); ?>Crm/JobProfitability/FetchTypes",
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
        })*/
        /**/

         /*print button section start*/
         $('body').on('click','.print_button',function(e){
              
              // Open the PDF generation script in a new window
              var pdfWindow = window.open('<?= base_url()."Crm/JobProfitability/GetData/?".$_SERVER['QUERY_STRING']?>&action=Print', '_blank');
  
              // Automatically print when the PDF is loaded
              pdfWindow.onload = function() {
                  pdfWindow.print();
              };
  
        });

        /*fetch  sales executive by  customer*/   

        $("body").on('change', '.customer_clz', function(){ 


            var id = $(this).val();


            $.ajax({

                url : "<?php echo base_url(); ?>Crm/JobProfitability/FetchData",

                method : "POST",

                data:{ID: id},

                success:function(data)
                {   
                    var data = JSON.parse(data);

                    //console.log(data.prod_details);
                    $('.executive_clz').html(data.quot_det);
                    
                    $('.sales_order_ref').html(data.sales_reff);

                }


            });
        });
        
        /*####*/


        /*form submit start*/

        /*$(".submit_btn").on('click', function(){ 

            $('#JobProfitability').modal("hide");

            $('#add_form')[0].reset();

            $('.customer_clz option').remove();

            $('.sales_order option').remove();

            $('.executive_clz option').remove();
        
        });*/


/*#####*/


      
        $(document).ready(function() {
            $(".excel_button").click(
                function() {
                    tableToExcel('DataTable', 'Job Profitability Report', 'Job Profitability Report');
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


