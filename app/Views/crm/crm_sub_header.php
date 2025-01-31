<?php $uri = service('request')->uri; ?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="ProductHead") {echo "active" ;} ?>"  href="<?= base_url(); ?>Crm/ProductHead" role="tab" aria-selected="true">Product Details </a></li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="Products") {echo "active" ;} ?>"  href="<?= base_url(); ?>Crm/Products" role="tab" aria-selected="true">Products </a></li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="CustomerCreation") {echo "active" ;} ?>"  href="<?= base_url(); ?>Crm/CustomerCreation" role="tab" aria-selected="false">Customer Creation</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="Enquiry"){echo "active" ;}?>"  href="<?= base_url();?>Crm/Enquiry" role="tab" aria-selected="false">Enquiry</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="SalesQuotation"){echo "active"; }?>"  href="<?= base_url();?>Crm/SalesQuotation" role="tab" aria-selected="false">Sales Quotation</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="SalesOrder"){echo "active";}?>"  href="<?= base_url();?>Crm/SalesOrder" role="tab" aria-selected="false">Sales Order</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="ProFormaInvoice"){echo "active"; }?>" href="<?= base_url();?>Crm/ProFormaInvoice"  role="tab" aria-selected="false">Pro-forma Invoice</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="DeliverNote"){echo "active";}?>"  href="<?= base_url();?>Crm/DeliverNote" role="tab" aria-selected="false">Delivery Note</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="CashInvoice"){echo "active";}?>"  href="<?= base_url();?>Crm/CashInvoice" role="tab" aria-selected="false">Cash Invoice</a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="CreditInvoice"){echo "active";}?>"  href="<?= base_url();?>Crm/CreditInvoice" role="tab" aria-selected="false">Credit Invoice </a> </li>
          <li class="nav-item"><a class="nav-link <?php if($uri->getSegment(2)=="SalesReturn"){echo "active";}?>"  href="<?= base_url();?>Crm/SalesReturn" role="tab" aria-selected="false">Sales return </a> </li>
        </ul>
			</div>
		</div>
	</div>
</div>