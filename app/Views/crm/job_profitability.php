<style>
.modal-dialog{
    width: 500px;
    margin: auto;
}
.adjust_width {
    width: 92%;
}
.not_found{

	text-align: center;
	width: 100%;
	font-size: 30px;
	font-weight: 700;
	color: black;
        
       
}
.select2-container--default .select2-selection--single .select2-selection__placeholder {
    
        color: var(--vz-body-color);
        font-weight: 400;
    }

    .select2-results__option[aria-selected] {

        cursor: pointer;
        color: var(--vz-body-color);
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
    
    padding-top: 5px;
}
.tr_height_eq{

    height:30px;
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
                                                                                
                                                                                <td class="center_padding" style="white-space: nowrap; vertical-align: middle;">From</td>
                                                                                <td style=""><input style="" type="date" name="form_date" id="" onclick="this.showPicker();"  class="form-control adjust_width"></td>
                                                                                <td style="white-space: nowrap; text-align: center; vertical-align: middle;">To</td>
                                                                                <td style=""><input type="date" name="to_date" id="" onclick="this.showPicker();" class="form-control adjust_width"></td>
                                                                            
                                                                            </tr>
                                                                            
                                                                        
                                                                        </thead>

                                                                    
                                                                        <tbody  class="travelerinfo">
                                                                            
                                                                            <tr>
                                                                                <td style="width: 30%;" class="center_padding">Customer</td>
                                                                                <td style="width: 70%;" colspan="4">
                                                                                    <select class="form-select droup_customer  customer_clz" name="customer">
                                                                                        <option value="" selected disabled>Select Customer</option>
                                                                                        <?php foreach($customer_creation as $cust_creation){ ?> 
                                                                                            <option value="<?php echo $cust_creation->cc_id;?>"><?php echo $cust_creation->cc_customer_name;?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                                
                                                                            </tr>


                                                                            <tr>
                                                                                <td style="width: 30%; width: 30%; white-space: nowrap; vertical-align: middle;" class="center_padding" class="center_padding">Sales Order Ref</td>
                                                                                <td style="width: 70%;" colspan="4">
                                                                                    <select class="form-select sales_order_ref sales_order" name="sales_order">
                                                                                        <option value="" selected disabled>Select Order Ref</option>
                                                                                        <?php foreach($sales_orders_data as $sales_data){ ?> 
                                                                                            <option value="<?php echo $sales_data->so_id; ?>"><?php echo $sales_data->so_reffer_no;?></option>    
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                               
                                                                            </tr>


                                                                            <tr>
                                                                                <td style="width: 30%; white-space: nowrap; vertical-align: middle;" class="center_padding" class="center_padding">Sales Executive</td>
                                                                                <td style="width: 70%;" colspan="4">
                                                                                    <select class="form-select executive_clz" name="sales_executive">
                                                                                        <option value="" selected disabled>Select Executive</option>
                                                                                        <?php foreach($sales_executive as $sals_exec){ ?> 
                                                                                            <option value="<?php echo $sals_exec->se_id;?>"><?php echo $sals_exec->se_name; ?></option>    
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </td>
                                                                               
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
                                            <button class="btn btn btn-success submit_btn"  data-bs-dismiss="modal" type="submit">Search</button>
                                        </div>
                                        
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!--####-->


                      


                        <!--datatable section start-->
                          <?php if(!empty($_GET)){?> 
                        <div class="row">
                            <div class="col-lg-12" style="padding:0px;">
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
                                    <div class="card-body table-responsive divcontainer" style="overflow-x:scroll;">
                                        <table style="table-layout:fixed;" id="DataTable" class="table table-bordered table-striped delTable display dataTable">
                                            <thead>
                                                <tr>
                                                    <th class="no-sort"  class="no-sort text-center" style="white-space: nowrap;width:40px">Sl no</th>
                                                    <th class="text-center" style="white-space: nowrap;width:70px">Date</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Sales Order Ref</th>
                                                    <th class="text-center" style="white-space: nowrap;width:300px">Customer Name</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Invoice Ref</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">LPO Ref</th>
                                                    <th class="text-center" style="white-space: nowrap;width:100px">Sales Executive</th>
                                                    <th class="text-end"    style="white-space: nowrap;width:100px">Revenue</th>
                                                    <th class="text-end"    style="white-space: nowrap;width:100px" >Expenses</th>
                                                    <th class="text-end"    style="white-space: nowrap;width:100px" >Gross Profit</th>
                                                    <th class="text-end"    style="white-space: nowrap;width:100px" >%</th>
                                                 
                                                </tr>
                                            </thead>
                                             <?php  if(!empty($sales_orders)){?> 
                                            <tbody class="tbody_data">
                                            <?php
                                               


                                                if(!empty($sales_orders))
                                                {   
                                                    $revenue =0 ;

                                                    $cash_invoices = 0;
                                                    $credit_invoices = 0;
                                                    $sales_returns = 0;

                                                    $expenses_total =0;

                                                    $final_gross = 0;

                                                    $final_percentage = 0;

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

                                                        <td class="text-center" style="white-space: nowrap;width:40px"><?php echo $i;?></td>
                                                        <td class="text-center" style="white-space: nowrap;width:70px"><?php echo date('d-M-Y',strtotime($sales_order->so_date));?></td>
                                                        <td class="text-center" style="white-space: nowrap;width:100px"><a href="<?php echo base_url();?>Crm/SalesOrder?view_so=<?php echo $sales_order->so_id;?>" target="_blank"><?php echo $sales_order->so_reffer_no;?></a></td>
                                                        <?php
                                                        $vendor_names = [];

                                                        if (!empty($sales_order->purchase_vouchers)) {
                                                            foreach ($sales_order->purchase_vouchers as $pv) {
                                                                if (!empty($pv->cc_customer_name)) {
                                                                    $vendor_names[$pv->cc_customer_name] = true; 
                                                                }
                                                            }
                                                        }

                                                        ?>

                                                        <td style="width: 300px; word-wrap: break-word; white-space: normal;">

                                                            <span><?php echo $sales_order->cc_customer_name; ?></span>

                                                            <?php if (!empty($vendor_names)) { ?>
                                                            <?php foreach (array_keys($vendor_names) as $vendor) { ?>
                                                                <br>
                                                                <br>
                                                                <span>
                                                                    <?php echo $vendor; ?>
                                                                </span>
                                                            <?php } ?>

                                                            <?php } ?>

                                                        </td>


                                                        <td colspan="1" align="left" class="p-0">
                                                            <table>

                                                                <!------>

                                                                <?php if(empty($sales_order->so_credit_status)){ ?>

                                                                    <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;width:100px;" class="text-center tr_height_eq">
                                                                   
                                                                    <td  style="width:100px" >&nbsp</td>
                                                                    
                                                                    </tr>


                                                                <?php }
                                                                
                                                                ?>

                                                                <!------>

                                                               <?php if(!empty($sales_order->cash_invoice)){
                                     
                                                                   
                                                                    foreach($sales_order->cash_invoice as $cash_val){  ?>
                                                                                                  
                                                                    
                                                                    <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;width:100px;" class="text-center tr_height_eq">
                                                                   
                                                                    <td  style="width:100px" ><?php echo $cash_val->ci_reffer_no; ?></td>
                                                                    
                                                                    </tr>

                                                                    <?php

                                                                                        

                                                                } } 
                                                                
                                                                if(!empty($sales_order->credit_invoice)){

                                                                    foreach($sales_order->credit_invoice as $credit_val){ 
                                                                   
                                                                        
                                                                    ?>

                                                                        <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;width:100px" class="text-center tr_height_eq">
                                                                    
                                                                            <td  style="width:100px" ><?php echo $credit_val->cci_reffer_no; ?></td>

                                                                        </tr>

                                                                        <?php
   

                                                                  
                                                                  } } ?>


                                                                 <!---->

                                                                <?php
                                                                   
                                                                    if(!empty($sales_order->sales_return)){

                                                                        foreach($sales_order->sales_return as $sales_ret){  ?>

                                                                        <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;width:100px" class="text-center tr_height_eq">
                                                                    
                                                                            <td  style="width:100px" ><?php echo $sales_ret->sr_reffer_no; ?></td>

                                                                        </tr>


                                                                <?php    }

                                                                    }
                                                                
                                                                ?>

                                                                <!---->


                                                            <?php 
                                                                $printedPV = [];
                                                                if(!empty($sales_order->purchase_vouchers)){

                                                                     $pvList = $sales_order->purchase_vouchers;
                                                                     $rowCount = count($pvList);
                                                                
                                                                foreach ($pvList as $index => $pv) { 
                                                                   if (!empty($pv->pv_reffer_id) && !in_array($pv->pv_reffer_id, $printedPV)) {    
                                                                ?> 
                                                                                
                                                                <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;width:100px" class="text-center tr_height_eq">
                                                                    
                                                                    <td  style="width:100px" ><?= $pv->pv_vendor_inv ?> </td>
                                                                     
                                                                </tr>

                                                                

                                                            <?php $printedPV[] = $pv->pv_reffer_id; } }  }


                                                                
                                                                $printedPR = [];
                                                                if(!empty($sales_order->purchase_return_prod)){

                                                                    //$pvList1 = $sales_order->purchase_return_prod;
                                                                    //$rowCount1 = count($pvList1);

                                                                    foreach($sales_order->purchase_return_prod as $pr){ 
                                                                      if (!empty($pr->pr_reffer_id) && !in_array($pr->pr_reffer_id	, $printedPR)) {        
                                                                    ?> 
                                                                       
                                                                    <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;width:100px" class="text-center tr_height_eq">
                                                                         
                                                                        <td  style="width:100px" ><?php echo $pr->pr_reffer_id; ?> </td>
                                                                        
                                                                    
                                                                    </tr>


                                                                <?php $printedPR[] = $pr->pr_reffer_id;  }  } }



                                                                if(!empty($sales_order->petty_cash)){

                                                                    $pvList5 = $sales_order->petty_cash;
                                                                    $rowCount5 = count($pvList5);
                                                                
                                                                    foreach($pvList5 as $index => $pc){ ?>

                                                                    <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;width:100px" class="text-center tr_height_eq">
                                                                        <?php if ($index == 0){ ?>
                                                                        <td  style="width:100px"><?php echo $pc->pcv_voucher_no; ?></td>
                                                                        <?php } ?>
                                                                
                                                                    </tr>  

                                                                <?php  } }

                                                                if(!empty($sales_order->journal_voucher)){

                                                                    $pvList2 = $sales_order->journal_voucher;
                                                                    $rowCount2 = count($pvList2);
                                                                    
                                                                    foreach($pvList2 as $index => $jv){ ?> 
                                                                      
                                                                    <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;width:100px" class="text-center tr_height_eq">
                                                                        <?php if ($index == 0){ ?>
                                                                        <td  style="width:100px" ><?php echo $jv->jv_voucher_no; ?></td>
                                                                        <?php }  ?>
                                                                    </tr>  
                                                                    
                                                                    <?php } }
                                                                
                                                                
                                                                ?>    
                                                                
                                                               
                                                                                            
                                                            </table>
                                                        </td>


                                                        <td class="text-center" style="white-space: nowrap;width:100px"><?php echo $sales_order->so_lpo;?></td>

                                                        <td class="text-center" style="white-space: nowrap;width:100px"><?php echo $sales_order->se_name;?></td>

                                                        <?php

                                                            $single_cash = 0;
                                                            $single_credit = 0;
                                                            $single_returns = 0;
                                                            
                                                            if(!empty($sales_order->cash_invoice)){
                                                            
                                                                foreach($sales_order->cash_invoice as $cash_inv){

                                                                    $cash_invoices  += $cash_inv->ci_total_amount;

                                                                    $single_cash += $cash_inv->ci_total_amount;
                                                                }
                                                            }


                                                            if(!empty($sales_order->credit_invoice)){

                                                                foreach($sales_order->credit_invoice as $credit_inv){

                                                                    $credit_invoices += $credit_inv->cci_total_amount;

                                                                    $single_credit += $credit_inv->cci_total_amount;
                                                                }

                                                            }


                                                            if(!empty($sales_order->sales_return)){

                                                                foreach($sales_order->sales_return as $sales_rut){

                                                                   $sales_returns += $sales_rut->sr_total;

                                                                   $single_returns += $sales_rut->sr_total;
 
                                                                }
                                                            }

                                                            $revenue = $cash_invoices + $credit_invoices;

                                                            $revenue = $revenue - $sales_returns;
                                                        
                                                        ?>

                                                        <td class="text-end p-0" style="white-space: nowrap;width:100px">
                                                            <table>
                                                                <?php if(!empty($sales_order->cash_invoice)){ ?>
                                                                    <?php foreach($sales_order->cash_invoice as $cash_inv){ 
                                                                    
                                                                    ?>
                                                                       <tr class="tr_height_eq" style="border-bottom: hidden !important"><td><?php echo format_currency($cash_inv->ci_total_amount); ?></td></tr>
                                                                    <?php  } ?>
                                                                <?php } ?>

                                                                <?php if(!empty($sales_order->credit_invoice)){ ?>
                                                                    <?php foreach($sales_order->credit_invoice as $credit_inv){ 
                                                                          
                                                                        
                                                                    ?>
                                                                        <tr class="tr_height_eq" style="border-bottom: hidden !important"><td><?php echo format_currency($credit_inv->cci_total_amount); ?></td></tr>

                                                                    <?php  } ?>
                                                                <?php } ?>

                                                                <?php if(!empty($sales_order->sales_return)){ ?>
                                                                    <?php foreach($sales_order->sales_return as $sales_rut){ ?>
                                                                       <tr class="tr_height_eq" style="border-bottom: hidden !important"><td>-<?php echo format_currency($sales_rut->sr_total); ?></td></tr>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </table>
                                                        </td>

                                                        <?php $cash_credit = $single_cash + $single_credit; //echo format_currency($cash_credit); ?>

                                                        <td colspan="1" align="left" class="p-0">
    <table>
        <?php 
            // initialize
            $expenses1 = $expenses2 = $expenses3 = $expenses4 = $expenses5 = 0;

            /* PURCHASE VOUCHERS */
            if(!empty($sales_order->cash_invoice)){ 
                
                $cash_count = !empty($sales_order->cash_invoice) ? count($sales_order->cash_invoice) : 0;

                for ($j = 0; $j < $cash_count-1; $j++) {
                    
                    echo "<tr class='tr_height_eq' style='border-bottom: hidden !important'><td>&nbsp;</td></tr>";
                }
                
                ?>

                <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;
    width: 100px;" class="tr_height_eq">
                        <td style="width:100px" class="text-end">&nbsp
                           
                        </td>
                    </tr>
            <?php } 
            if(!empty($sales_order->credit_invoice)){

                $credit_count = !empty($sales_order->credit_invoice) ? count($sales_order->credit_invoice) : 0;

                for ($j = 0; $j < $credit_count-1; $j++) {
                    
                    echo "<tr class='tr_height_eq' style='border-bottom: hidden !important'><td>&nbsp;</td></tr>";

                } ?>


                <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;
    width: 100px;" class="tr_height_eq">
                    <td style="width:100px" class="text-end">&nbsp
                        
                    </td>
                </tr>


            <?php }

            /*sales return */

            if(!empty($sales_order->sales_return)){

                $return_count = !empty($sales_order->sales_return) ? count($sales_order->sales_return) : 0;

                for ($j = 0; $j < $return_count-1; $j++) {
                    
                    echo "<tr class='tr_height_eq' style='border-bottom: hidden !important'><td>&nbsp;</td></tr>";
                } ?>


                <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;
    width: 100px;" class="tr_height_eq">
                    <td style="width:100px" class="text-end">&nbsp
                        
                    </td>
                </tr>


            <?php }

            /**/

            /**/
            if (!empty($sales_order->purchase_vouchers)) {

                $pvTotals = []; 

                $expenses1 = 0;
               

                foreach ($sales_order->purchase_vouchers as $pur_vouch) {

                    // Sum ONLY matching sales order vouchers
                    //if ($pur_vouch->pvp_sales_order == $sales_order->so_reffer_no) {

                    if (!empty($pur_vouch->pvp_reffer_id)) {

                        if (!isset($pvTotals[$pur_vouch->pvp_reffer_id])) {

                            $pvTotals[$pur_vouch->pvp_reffer_id] = 0;
                        }
                        $pvTotals[$pur_vouch->pvp_reffer_id] += $pur_vouch->pvp_amount;
                        $expenses1 += $pur_vouch->pvp_amount;

                    }
                        
                       // $total_pur_vouch += $pur_vouch->pvp_amount;

                        //$expenses1 += $pur_vouch->pv_total;

                        //$expenses1 += $pur_vouch->pvp_amount;
                    //}

                    // if you still need expenses
                    //$expenses1 += $pur_vouch->pv_total;

                }

            ?>  
            
                <!-- Show ONLY the total -->
                 <?php foreach ($pvTotals as $pvId => $pv_amount) { ?>
                <tr style="background: unset; border-bottom: hidden !important;white-space: nowrap;
    width: 100px;" class="tr_height_eq">
                    <td style="width:100px" class="text-end">
                        <?php echo format_currency($pv_amount); ?>
                    </td>
                </tr>
                <?php } ?>
            <?php
            }
            /**/

            /* PURCHASE RETURN */
            if(!empty($sales_order->purchase_return_prod)){

                $pRTotals = []; 

                $expenses2 = 0;
                
                foreach($sales_order->purchase_return_prod as $pv_prod){ 
                     
                   
                    if (!isset($pRTotals[$pv_prod->prp_purchase_return_id])) {

                        $pRTotals[$pv_prod->prp_purchase_return_id] = 0;
                    }

                    $pRTotals[$pv_prod->prp_purchase_return_id] += $pv_prod->prp_amount;
                    $expenses2 += $pv_prod->prp_amount;
                    
                    
                ?> 

                    

                <?php 
                   // $expenses2 += $pv_prod->pr_total_amount;
                } ?>
                <?php foreach ($pRTotals as $prId => $prp_amount) { ?>
                <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;
    width: 100px;" class="tr_height_eq">
                        <td style="width:100px" class="text-end">
                            -<?php echo format_currency($prp_amount); ?>
                        </td>
                    </tr>



          <?php   } }

            /* PETTY CASH */
            if(!empty($sales_order->petty_cash)){
                foreach($sales_order->petty_cash as $p_cash){ ?>

                    <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;
    width: 100px;" >
                        <td style="width:100px" class="text-end">
                            <?php echo format_currency($p_cash->pci_amount); ?>
                        </td>
                    </tr>

                <?php 
                    $expenses3 += $p_cash->pci_amount;
                }
            }

            /* JOURNAL VOUCHER */
            if(!empty($sales_order->journal_voucher)){

                foreach($sales_order->journal_voucher as $jour_vouch){ ?> 
                    
                    <tr style="background: unset;border-bottom: hidden !important;white-space: nowrap;
    width: 100px;">
                        <td style="width:100px" class="text-end">
                            <?php 

                                if(!empty($jour_vouch->ji_debit))  
                                    echo format_currency($jour_vouch->ji_debit);
                                elseif(!empty($jour_vouch->ji_credit)) 
                                    echo format_currency($jour_vouch->ji_credit);
                            ?>
                        </td>
                    </tr>

                <?php 

                    if(!empty($jour_vouch->ji_debit))  $expenses4 += $jour_vouch->ji_debit;
                    if(!empty($jour_vouch->ji_credit)) $expenses5 += $jour_vouch->ji_credit;

                }
            }

            /* FINAL TOTAL EXPENSES */
            $expenses = ($expenses1 + $expenses3 + $expenses4 + $expenses5) - $expenses2;
        ?>

        <!-- TOTAL EXPENSES -->
        <!--<tr style="background: #f2f2f2; font-weight:bold;">
            <td style="width:100px" class="text-end">
                <?php echo format_currency($expenses); ?>
            </td>
        </tr>-->

    </table>
</td>

<!-- NOW OUTSIDE EXPENSE TABLE: GROSS PROFIT COLUMN -->

<!---->


<!---->

<td class="text-end">
    
<?php
$invoice_revenue = ($single_cash + $single_credit) - $single_returns;

$row_revenue = $invoice_revenue;
$total_gross_profit = $row_revenue - $expenses;
?>


        
<?php echo format_currency($total_gross_profit); ?>
</td>


<!---->

<!-- NOW OUTSIDE EXPENSE TABLE: PERCENTAGE COLUMN -->
<td class="text-end">
    <?php 

        $total_percentage = 0;

        /*if($sales_order->so_amount_total != 0){

            //$total_percentage = ($total_gross_profit / $sales_order->so_amount_total) * 100;

            
        }*/

        if ($row_revenue != 0) {

            $total_percentage = ($total_gross_profit / $row_revenue) * 100;
        }   

        

        echo number_format($total_percentage, 2) . '%';
    ?>
</td>

<?php 

    $expenses_total  +=  $expenses; 
    
    $final_gross  +=  $total_gross_profit;

    $final_percentage += $total_percentage;

    if ($revenue > 0) {
        $final_percentage1 = ($final_gross / $revenue) * 100;
    } else {
        $final_percentage1 = 0; 
    }

     
?>

                                              
                                                        
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
                                                        <td class="text-end"><b><?php echo format_currency($revenue); ?></b><br> </td>
                                                        <td class="text-end"><b><?php echo format_currency($expenses_total); ?></b></td>
                                                        <td class="text-end"><b><?php echo format_currency($final_gross); ?></b></td>
                                                        <td class="text-end"><b><?php echo format_currency($final_percentage1); ?>%</b></td>
                                                      
                                                    </tr>
                                                    
                                                <?php   } ?>
                                            </tbody>

                                            <?php }  else{ ?>
                                              
                                                <tbody>
                                                   
                                                    <tr>
                                                        <td colspan="10" class="not_found">No Data Found !!</td>
                                                    </tr>

                                                </tbody>
                                                
                                            <?php }  ?> 

                                        </table>
                
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>

                        
                        <?php } ?>  
                            

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
         $(".droup_customer").select2({
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
        })
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


