<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>

<div class="row">

<div class="col-lg-12">
  
<div class="card">

<div class="card-body">


<ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">

<li class="nav-item"><a class="nav-link <?php if($uri->getSegment(4)=="Ledger") {echo "active" ;} ?>"  href="<?php echo base_url();?>Accounts/Reports/Ledger">Ledger </a></li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(4)=="TrialBalance") {echo "active" ;} ?>" href="<?php echo base_url();?>Accounts/Reports/TrialBalance">Trial Balance</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(4)=="PLAccount") {echo "active" ;} ?>" href="<?php echo base_url();?>Accounts/Reports/PLAccount">Profit & Loss</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(4)=="BalanceSheet") {echo "active" ;} ?>" href="<?php echo base_url();?>Accounts/Reports/BalanceSheet" >Balance Sheet</a> </li>
<li class="nav-item"> <a class="nav-link" >Fixed Asset Schedule</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(4)=="RPSummery") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Accounts/Reports/RPSummery" >Accounts Receivable/Payable Summery</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(4)=="StatementOfAccounts") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Accounts/Reports/StatementOfAccounts">Statement Of Accounts</a> </li>
<li class="nav-item"> <a class="nav-link <?php if($uri->getSegment(4)=="AgedRP") {echo "active" ;} ?>" href="<?php echo base_url(); ?>Accounts/Reports/AgedRP" >Ages Receivables/Payables</a> </li>
<li class="nav-item"> <a class="nav-link" >Bank Reconciliation Statement</a> </li>
<li class="nav-item"> <a class="nav-link" >Year end transaction</a> </li>
		                                 
</ul>

									  </div>


										    </div>
											  </div>
											    </div>