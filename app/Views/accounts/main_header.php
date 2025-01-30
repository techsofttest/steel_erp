<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>

<ul class="nav nav-pills nav-custom-outline nav-primary mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="Accounts" && $uri->getSegment(3)!="Reports") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/AccountHead" >Accounts</a>
    </li>
   
    <li class="nav-item waves-effect waves-light">
    <a class="nav-link <?php if($uri->getSegment(3)=="Reports") {echo "active" ;} ?>" href="<?= base_url(); ?>Accounts/Reports/Ledger" >Reports</a>
    </li>
</ul>