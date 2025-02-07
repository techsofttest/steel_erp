<?php  
//$uri = new \CodeIgniter\HTTP\URI(current_url());
$uri = service('request')->uri;
?>

<?php if($uri->getSegment(2)!="Reports") { ?>

<div class="row">

<div class="col-lg-12">
  
<div class="card">

<div class="card-body">




<ul class="nav nav-tabs nav-border-top nav-border-top-primary mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="AccountHead") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/AccountHead" >Account Head</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="ChartsOfAccounts") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/ChartsOfAccounts">Charts of Accounts</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="Receipts") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/Receipts">Receipts</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="Payments") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/Payments">Payments</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="JournalVouchers") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/JournalVouchers">Journal Vouchers</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="PettyCashVoucher") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/PettyCashVoucher" >Petty Cash Voucher</a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="BankRec") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/BankRec" >Bank Reconciliation</a>
    </li>

</ul>




    </div>
    </div>
    </div>
    </div>


<?php } ?>