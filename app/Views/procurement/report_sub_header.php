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
        
          <li class="nav-item"><a class="nav-link <?php  if($uri->getSegment(3)=="MaterialReqReport") {echo "active" ;} ?>"  href="<?= base_url(); ?>Procurement/MaterialReqReport"role="tab" aria-selected="true">Material Requesition Report </a></li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="PurchaseOrderReport") {echo "active" ;} ?>"  href="<?= base_url(); ?>Procurement/PurchaseOrderReport" role="tab" aria-selected="false">Purchase Order Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="SalesOrderReport"){echo "active" ;}?>" href="<?= base_url();?>Procurement/SalesOrderReport" role="tab" aria-selected="false">Material Received Note Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="SalesOrderSummeryReport"){echo "active" ;}?>" href="<?= base_url();?>Procurement/SalesOrderSummeryReport" role="tab" aria-selected="false">LPO to MRN Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="SalesOrderToDn"){echo "active" ;}?>"  href="<?= base_url();?>Crm/SalesOrderToDn" role="tab" aria-selected="false">MRN to Purchase Voucher Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="DeliveryNoteReport"){echo "active";}?>"  href="<?= base_url();?>Crm/DeliveryNoteReport" role="tab" aria-selected="false">LPO to Purchase Voucher Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="DnToCreditInvoice"){echo "active";}?>"  href="<?= base_url();?>Crm/DnToCreditInvoice" role="tab" aria-selected="false">Purchase Voucher Report</a> </li>
          <li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="InvoiceReport"){echo "active";}?>"  href="<?= base_url();?>Crm/InvoiceReport" role="tab" aria-selected="false">Purchase Return Report</a> </li>

          
        </ul>
			</div>
		</div>
	</div>
</div>
