<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>
<ul class="nav nav-pills nav-custom-outline nav-primary mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(3)=="ProductHead" || $uri->getSegment(3)=="Products" || $uri->getSegment(3)=="CustomerCreation" || $uri->getSegment(3)=="Enquiry" || $uri->getSegment(3)=="SalesQuotation" || $uri->getSegment(3)=="SalesOrder" || $uri->getSegment(3)=="ProFormaInvoice" || $uri->getSegment(3)=="DeliverNote" || $uri->getSegment(3)=="CashInvoice" || $uri->getSegment(3)=="CreditInvoice" || $uri->getSegment(3)=="SalesReturn") {echo "active" ;} ?>" data-bs-toggle="" href="<?= base_url(); ?>Crm/ProductHead" role="tab">Customer Relationship Management</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="crm_report_per nav-link <?php if($uri->getSegment(3)=="SalesQuotReports" || $uri->getSegment(3)=="SalesQuotReport" || $uri->getSegment(3)=="SalesQuotAnalysisReport" || $uri->getSegment(3)=="SalesOrderReport" || $uri->getSegment(3)=="SalesOrderToDn" || $uri->getSegment(3)=="DeliveryNoteReport" ||  $uri->getSegment(3)=="DnToCreditInvoice" || $uri->getSegment(3)=="InvoiceReport" || $uri->getSegment(3)=="SalesReturnReport" || $uri->getSegment(3)=="SalesSummery" || $uri->getSegment(3)=="BackLog" || $uri->getSegment(3)=="JobProfitability" || $uri->getSegment(3)=="JobSummery") {echo "active" ;} ?>" data-bs-toggle="" href="<?= base_url(); ?>Crm/SalesQuotReports" role="tab">Reports</a>
    </li>
</ul>