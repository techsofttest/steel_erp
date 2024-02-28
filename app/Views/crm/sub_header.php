<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>
<ul class="nav nav-pills nav-custom-outline nav-primary mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="ProductHead") {echo "active" ;} ?>" data-bs-toggle="" href="<?= base_url(); ?>Crm/ProductHead" role="tab">Customer Relationship Management</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="SalesQuotReport") {echo "active" ;} ?>" data-bs-toggle="" href="<?= base_url(); ?>Crm/SalesQuotReport" role="tab">Reports</a>
    </li>
</ul>