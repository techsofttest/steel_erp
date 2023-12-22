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
        <a class="nav-link" data-bs-toggle="tab" href="#border-nav-5" role="tab">Journal Voucher</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link" data-bs-toggle="tab" href="#border-nav-6" role="tab">Petty cash voucher</a>
    </li>
    <li class="nav-item waves-effect waves-light">
    <a class="nav-link" data-bs-toggle="tab" href="#border-nav-7" role="tab">Reports</a>
    </li>
</ul>