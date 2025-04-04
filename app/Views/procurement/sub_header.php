<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>
<ul class="nav nav-pills nav-custom-outline nav-primary mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="Vendor" || $uri->getSegment(2)=="MaterialRequisition" || $uri->getSegment(2)=="PurchaseOrder" || $uri->getSegment(2)=="MaterialReceivedNote" || $uri->getSegment(2)=="PurchaseVoucher" || $uri->getSegment(2)=="PurchaseReturn" || $uri->getSegment(2)=="FixedAssetCreation" || $uri->getSegment(2)=="DepreciationCalculation" || $uri->getSegment(2)=="FixedAssetDisposal") {echo "active" ;} ?>" data-bs-toggle="" href="<?= base_url(); ?>Procurement/Vendor" role="tab">Procurement</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="Reports" || $uri->getSegment(2)=="MaterialReqReport" || $uri->getSegment(2)=="PurchaseOrderReport" || $uri->getSegment(2)=="MaterialRecReport" || $uri->getSegment(2)=="LPO_MRNReport" || $uri->getSegment(2)=="MRN_PVReport" || $uri->getSegment(2)=="LPO_PVReport" || $uri->getSegment(2)=="PurchaseVoucherReport" || $uri->getSegment(2)=="PendingPurchaseVoucherReport" || $uri->getSegment(2)=="PurchaseReturnReport") {echo "active" ;} ?>" data-bs-toggle=""  href="<?= base_url(); ?>Procurement/Reports" role="tab">Reports</a>
    </li>
</ul>