<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="Vendor") {echo "active" ;} ?>"  href="<?= base_url(); ?>Procurement/Vendor" role="tab" aria-selected="true">Vendor </a></li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="MaterialRequisition") {echo "active" ;} ?>"  href="<?= base_url(); ?>Procurement/MaterialRequisition" role="tab" aria-selected="true">Material Requisition </a></li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="PurchaseOrder") {echo "active" ;} ?>"  href="<?= base_url(); ?>Procurement/PurchaseOrder" role="tab" aria-selected="false">Purchase order</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="MaterialReceivedNote"){echo "active" ;}?>"  href="<?= base_url();?>Procurement/MaterialReceivedNote" role="tab" aria-selected="false">Material Received Note</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="PurchaseVoucher"){echo "active"; }?>"  href="<?= base_url();?>Procurement/PurchaseVoucher" role="tab" aria-selected="false">Purchase Voucher</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="PurchaseReturn"){echo "active";}?>"  href="<?= base_url();?>Procurement/PurchaseReturn" role="tab" aria-selected="false">Purchase Return</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="ProFormaInvoice"){echo "active"; }?>" href="<?= base_url();?>Crm/ProFormaInvoice"  role="tab" aria-selected="false">Fixed Asset Creation</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="DeliverNote"){echo "active";}?>"  href="<?= base_url();?>Crm/DeliverNote" role="tab" aria-selected="false">Depreciation Calculation</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="CashInvoice"){echo "active";}?>"  href="<?= base_url();?>Crm/CashInvoice" role="tab" aria-selected="false">Fixed Asset Disposal</a> </li>
          
        </ul>
			</div>
		</div>
	</div>
</div>