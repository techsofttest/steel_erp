<!--Start Petty cash voucher  col-->
<div class="tab-pane" id="border-nav-6" role="tabpanel">




 <!-- Add Modal -->


 <div class="modal fade" id="AddModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
            <form  class="Dashboard-form class" id="add_form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Petty Cash Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


    <div class="row">


<div class="col-lg-12">
    <div class="card">



    <div class="card-body">
                    <div class="live-preview">
						<form action="#" method="post" class="Dashboard-form" id="add_form">
                            <div class="row align-items-end">
							    <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Date</label>
                                        <input type="date" onclick="this.showPicker()"  name="pcv_date" class="form-control " required>
                                    </div>
                                </div>
								<!--end col-->
                                <div class="col-col-md-4 col-lg-4">
                                    <div>
                                        <label for="basiInput" class="form-label">Credit Account</label>
                                        <select class="form-select " name="pcv_credit_account" required>
                                            <option selected="" >Select</option>
                                            
                                            <?php foreach($accounts as $account){ ?>

                                                <option value="<?php echo $account->ca_id; ?>"><?php echo $account->ca_name; ?></option>

                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>






                                <div class="col-col-md-12 col-lg-12">


<table class="table table-bordered" style="overflow-y:scroll;">

            <thead>
                <tr>    
                <th>Sl No</th>
                <th>Sales Order No</th>
                <th>Debit Account</th>
                <th>Amount</th>
                <th>Narration</th>
                <th></th>
                </tr>
            </thead>

            <tbody id="sel_invoices">


            <tr class="so_row">

                <th class="sl_no">1</th> 
                
                <th>

                <select name="pcv_sale_invoice[]" class="form-control">

                <option value="0">None</option>

                <?php foreach($sales_orders as $sorder){ ?>

                <option value="<?php echo $sorder->so_id; ?>"><?php echo $sorder->so_order_no; ?></option>

                <?php } ?>

                </select>

                </th>


                <th> <select name="pcv_account[]" class="form-control">

                <option value="">Select Account</option>

                <?php foreach($accounts as $account){ ?>

                <option value="<?php echo $account->ca_id; ?>"><?= $account->ca_name; ?></option>

                <?php } ?>
                
                </select>

                </th>
                
                <th><input name="pcv_debit[]" type="number" class="form-control pcv_amount" ></th>

                <th><input name="pcv_remarks[]" type="text" class="form-control" ></th>

                <th> <a href="javascript:void(0);" class="del_elem" style="display:none;"><i class='ri-close-line'></i></a></th>

            </tr>


            </tbody>

            <tr>

            <td colspan="3">Total</td>

            <td id="total_amount_disp">0</td>
            
            <input type="hidden" id="total_amount_inp" name="total_amount">


            </tr>


</table>



</div>


<div class="col-lg-12 text-center">
                                    
    <a class="add_more" href="javascript:void(0);"><span class=""><i class="ri-add-circle-line"></i>Add More</span></a>

</div>



                            </div>
                        <!--end row-->
						</form>
                    </div>
                                    
                </div>


    </div>
</div>

<!--end col-->
</div>

</div>
            <div class="modal-footer justify-content-center">
                <button  class="btn btn btn-success">Save</button>
            </div>

        </div>
        </form>

    </div>
</div>






    <!-- ### -->








    		
					
	<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">View Petty Cash Vouchers</h4>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#AddModal" class="btn btn-primary py-1">Add</button>
                </div><!-- end card header -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped delTable">
                        
                        <thead>
                            <tr>
                                <th class="no-sort">Sl no</th>
                                <th>Date</th>
                                <th>Voucher No</th>
                                <th>Credit Account</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
           
                    </table>
                                    
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
                                          
</div>
										
										
<!--end Petty cash voucher col-->

<script>

    document.addEventListener("DOMContentLoaded", function(event){

        /*add*/
        $(function() {
            $('#add_form').validate({
                
                rules: {
                    required: 'required',
                },
                messages: {
                    required: 'This field is required',
                },
                errorPlacement: function(error, element) {} ,
                submitHandler: function(form){
                    $.ajax({
                        url: "<?php echo base_url(); ?>Accounts/PettyCashVoucher/Add",
                        method: "POST",
                        data: $(form).serialize(),
                        success: function(data){
                            $('#add_form')[0].reset();
                            $('#AddModal').modal('hide');
                            alertify.success('Data Added Successfully').delay(3).dismissOthers();
                            datatable.ajax.reload( null, false )
                        }
                    });
                    return false; // prevent the form from submitting
                }
            });
        });
        /*####*/


            /*cost calculation add more*/

            var max_fieldcost = 30;

            $("body").on('click', '.add_more', function(){

            var cc = $('.so_row').length;

            if(cc < max_fieldcost){ 

            cc++;
            //$(".cost_cal").append("<div class='row cost_cal_row'><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Material / Services</label><select id='quotation_material' class='form-control quotation_material_clz'><option value='' selected disabled>Select Material / Services</option></select></div><div class='col-md-3 col-lg-3'><label for='basiInput' class='form-label'>Qty</label><input type='number' name='qd_qty' class='form-control cost_qty' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Rate</label><input type='number' name='qd_rate' class='form-control cost_rate' required></div><div class='col-md-3 col-lg-3'><label for='basicInput' class='form-label'>Amount</label><input readonly type='number' name='qd_amount' class='form-control cost_amount' required style='width:95%'></div><div class='remove-cost'><div class='remainpass cost_remove'><i class='ri-close-line'></i></div></div></div>");
        
            var $clone =  $('.so_row:first').clone();

            $clone.find("input").val("");

            $clone.find("select").val(0);

            $clone.find(".sl_no").html(cc);

            $clone.find(".del_elem").show();

            $clone.insertAfter('.so_row:last');

            }

        });



        $(document).on("click", ".del_elem", function() 
        {
        
        $(this).closest('.so_row').remove();
        
        var sl_no =1;

        $('body .so_row').each(function()
        {

        $(this).find('.sl_no').html(sl_no);

        sl_no++;

        });

        totalCalcutate();  

        });

        /**/


        $("body").on('keyup', '.pcv_amount', function(){ 

        totalCalcutate();    

        });



        function totalCalcutate()
        {
 
        var total = 0;
        
        $('body .pcv_amount').each(function()
        {

        var sub_tot = $(this).val();

        total += parseInt(sub_tot)||0;

        });

        $('#total_amount_inp').val(total);

        $('#total_amount_disp').html(total);


        }









        /*sales order  droupdrown*/
         $(".order_select").select2({
        placeholder: "Sales order No",
        theme : "default form-control-",
        ajax: {
                url: "<?= base_url(); ?>Accounts/PettyCashVoucher/FetchTypes",
                dataType: 'json',
                delay: 250,
                cache: false,
                minimumInputLength: 1,
                allowClear: true,
                data: function (params) {
                    return {
                        term: params.term,
                        page: params.page || 1,
                    };
                },
                processResults: function(data, params){
                    //console.log(data);
                    //  NO NEED TO PARSE DATA `processResults` automatically parse it
                    //var c = JSON.parse(data);
                    console.log(data);
                    var page = params.page || 1;
                    return {
                        results: $.map(data.result, function (item) { return {id: item.so_id, text: item.so_order_no}}),
                        pagination: {
                        // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                            more: (page * 10) <= data.total_count
                        }
                    };
                },              
            }
        })
        /*###*/






         /*data table start*/ 


         function initializeDataTable() {

            /*
            if ($.fn.DataTable.isDataTable("#accountTable")) {
                $('#accountTable').DataTable().clear().destroy();
            }
            */

            datatable = $('#datatable').DataTable({
                'stateSave': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url': "<?php echo base_url(); ?>Accounts/PettyCashVoucher/FetchData",
                    'data': function (data) {
                        // CSRF Hash
                        var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                        var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                        return {
                            data: data,
                            [csrfName]: csrfHash, // CSRF Token
                        };
                    },
                    dataSrc: function (data) {
                        // Update token hash
                        $('.txt_csrfname').val(data.token);
                        // Datatable data
                        return data.aaData;
                    }
                },
                'columns': [
                    { data: 'pcv_id' },
                    { data: 'pcv_date'},
                    { data: 'pcv_voucher_no' },
                    { data : 'pcv_credit_account'},
                    { data: 'action' },
                ]
                
            });
            }

            $(document).ready(function () {
            initializeDataTable();
            });
            /*###*/











    });
</script>

