<style>

.report_button
{
    margin-right: 14px;
    color: white;
    padding: 3px 11px;
    border-radius: 4px;
}
.pdf_button
{
    background: red;
    border: red;
}
.excel_button
{
    background: green;
    border: green;
}
.email_button
{
    background: dodgerblue;
    border: dodgerblue;
}
.print_button
{
    background: blueviolet;
    border: blueviolet;
}


</style>

<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
        
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="SalesQuotReport") {echo "active" ;} ?>"  href="<?= base_url(); ?>Crm/SalesQuotReport"role="tab" aria-selected="true">Sales Quot Report </a></li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="SalesQuotAnalysisReport") {echo "active" ;} ?>"  href="<?= base_url(); ?>Crm/SalesQuotAnalysisReport" role="tab" aria-selected="false">Sales Quot Analysis Report</a> </li>
          
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="SalesQuotSummerReport") {echo "active" ;} ?>"  href="<?= base_url(); ?>Crm/SalesQuotSummerReport" role="tab" aria-selected="false">Sales Quot Summery Report</a> </li>
          
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="SalesOrderReport"){echo "active" ;}?>" href="<?= base_url();?>Crm/SalesOrderReport" role="tab" aria-selected="false">Sales Order Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="SalesOrderSummeryReport"){echo "active" ;}?>" href="<?= base_url();?>Crm/SalesOrderSummeryReport" role="tab" aria-selected="false">Sales Order Summery Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="SalesOrderToDn"){echo "active" ;}?>"  href="<?= base_url();?>Crm/SalesOrderToDn" role="tab" aria-selected="false">Sales Order To DN / Cash In Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="DeliveryNoteReport"){echo "active";}?>"  href="<?= base_url();?>Crm/DeliveryNoteReport" role="tab" aria-selected="false">Delivery Note Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="DnToCreditInvoice"){echo "active";}?>"  href="<?= base_url();?>Crm/DnToCreditInvoice" role="tab" aria-selected="false">DN To Credit Invoice Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="InvoiceReport"){echo "active";}?>"  href="<?= base_url();?>Crm/InvoiceReport" role="tab" aria-selected="false">Invoice Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="SalesReturnReport"){echo "active";}?>"  href="<?= base_url();?>Crm/SalesReturnReport" role="tab" aria-selected="false">Sales Return Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="SalesSummery"){echo "active";}?>"  href="<?= base_url();?>Crm/SalesSummery" role="tab" aria-selected="false">Sales Summery Report </a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="BackLog"){echo "active";}?>"  href="<?= base_url();?>Crm/BackLog" role="tab" aria-selected="false">Backlog </a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="JobProfitability"){echo "active";}?>"  href="<?= base_url();?>Crm/JobProfitability" role="tab" aria-selected="false">Job Profitability Report </a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="JobSummery"){echo "active";}?>"  href="<?= base_url();?>Crm/JobSummery" role="tab" aria-selected="false">Job Summery Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(2)=="WorkProgress"){echo "active";}?>"  href="<?= base_url();?>Crm/WorkProgress" role="tab" aria-selected="false">Work In Progress</a> </li>
        
        </ul>
			</div>
		</div>
	</div>
</div>
