<?php  $uri = new \CodeIgniter\HTTP\URI(current_url());?>
<ul class="nav nav-pills nav-custom-outline nav-primary mb-3" role="tablist">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link <?php if($uri->getSegment(2)=="ProductHead" || $uri->getSegment(2)=="Products" || $uri->getSegment(2)=="CustomerCreation" || $uri->getSegment(2)=="Enquiry" || $uri->getSegment(2)=="SalesQuotation" || $uri->getSegment(2)=="SalesOrder" || $uri->getSegment(2)=="ProFormaInvoice" || $uri->getSegment(2)=="DeliverNote" || $uri->getSegment(2)=="CashInvoice" || $uri->getSegment(2)=="CreditInvoice" || $uri->getSegment(2)=="SalesReturn") {echo "active" ;} ?>" data-bs-toggle="" href="<?= base_url(); ?>Crm/ProductHead" role="tab">Customer Relationship Management</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="crm_report_per nav-link <?php if($uri->getSegment(2)=="SalesQuotReports" || $uri->getSegment(2)=="SalesQuotReport" || $uri->getSegment(2)=="SalesQuotAnalysisReport" || $uri->getSegment(2)=="SalesOrderReport" || $uri->getSegment(2)=="SalesOrderToDn" || $uri->getSegment(2)=="DeliveryNoteReport" ||  $uri->getSegment(2)=="DnToCreditInvoice" || $uri->getSegment(2)=="InvoiceReport" || $uri->getSegment(2)=="SalesReturnReport" || $uri->getSegment(2)=="SalesSummery" || $uri->getSegment(2)=="BackLog" || $uri->getSegment(2)=="JobProfitability" || $uri->getSegment(2)=="JobSummery" || $uri->getSegment(2)=="WorkProgress") {echo "active" ;} ?>" data-bs-toggle="" href="<?= base_url(); ?>Crm/SalesQuotReports" role="tab">Reports</a>
    </li>
</ul>

<style>

.center_padding{

    padding-top: 20px !important;

}
.adjust_width{

    width: 91%;
}

</style>