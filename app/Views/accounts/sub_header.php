<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>

<ul class="nav nav-pills nav-custom-outline nav-primary mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="AccountHead") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/AccountHead" >Account Head</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="ChartsOfAccounts") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/ChartsOfAccounts">Charts of Accounts</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="Receipts") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/Receipts">Receipts</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="Payments") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/Payments">Payments</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="JournalVouchers") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/JournalVouchers">Journal Vouchers</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="PettyCashVoucher") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/PettyCashVoucher" >Petty Cash voucher</a>
    </li>

    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="BankRec") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/BankRec" >Bank Reconciliation</a>
    </li>

    <li class="nav-item waves-effect waves-light">
    <a class="nav-link <?php if($uri->getSegment(3)=="Reports") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/Reports/Ledger" >Reports</a>
    </li>
</ul>