<?php  $uri = service('request')->uri; ?>



<div class="row">

<div class="col-lg-12">
  
<div class="card">

<div class="card-body">


<ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">

<li class="nav-item"><a class="nav-link <?php if($uri->getSegment(3)=="Ledger") {echo "active" ;} ?>"  href="<?php echo base_url();?>Accounts/Reports/Ledger">Ledger </a></li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="TrialBalance") {echo "active" ;} ?>" href="<?php echo base_url();?>Accounts/Reports/TrialBalance">Trial Balance</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="PLAccount") {echo "active" ;} ?>" href="<?php echo base_url();?>Accounts/Reports/PLAccount">Profit & Loss</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="BalanceSheet") {echo "active" ;} ?>" href="<?php echo base_url();?>Accounts/Reports/BalanceSheet" >Balance Sheet</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="RPSummery") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Accounts/Reports/RPSummery" >Accounts Receivable/Payable Summery</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="StatementOfAccounts") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Accounts/Reports/StatementOfAccounts">Statement Of Accounts</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(3)=="AgedRP") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Accounts/Reports/AgedRP" >Aged Receivables/Payables</a> </li>
<li class="nav-item disabled"> <a class="nav-link <?php if($uri->getSegment(3)=="FixedAsset") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Accounts/Reports/FixedAsset">Fixed Asset Schedule</a> </li>
<li class="nav-item disabled"> <a class="nav-link <?php if($uri->getSegment(3)=="BankReconciliation") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Accounts/Reports/BankReconciliation">Bank Reconciliation Statement</a> </li>
		                                 
</ul>

									  </div>


										    </div>
											  </div>
											    </div>