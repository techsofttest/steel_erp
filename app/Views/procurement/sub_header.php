<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>
<ul class="nav nav-pills nav-custom-outline nav-primary mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="Vendor") {echo "active" ;} ?>" data-bs-toggle="" href="<?= base_url(); ?>Procurement/Vendor" role="tab">Procurement</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link" data-bs-toggle="" href="jkavascript:void(0)" role="tab">Reports</a>
    </li>
</ul>