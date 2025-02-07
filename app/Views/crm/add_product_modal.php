<!-- add product modal content start-->
<div class="modal fade" id="AddProdModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form  class="Dashboard-form class" id="add_prod_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
        
                                <div class="card-body">
                                                            
                                    <div class="live-preview ">
                                                                    
                                        

                                        <!-- Single Row Start -->

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basiInput" class="form-label">Product Name</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text"   name="product_details" class="form-control input_length" required>

                                            </div>

                                        </div>

                                        <!-- ### -->


                                        <!-- Single Row Start -->

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basiInput" class="form-label">Product Head</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <select class="form-select product_head_select product_head input_length"  name="product_product_head" required></select>

                                            </div>

                                        </div>

                                        <!-- ### -->


                                        <!-- Single Row Start -->

                                        <div class="row align-items-center mb-2 margin_zero">

                                            <div class="col-col-md-3 col-lg-3">

                                                <label for="basiInput" class="form-label">Code</label>

                                            </div>

                                            <div class="col-col-md-9 col-lg-9">

                                                <input type="text"   name="product_code" class="form-control product_code input_length" required readonly>

                                            </div>

                                        </div>

                                        <!-- ### -->
                                                             
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

<!-- add product modal content end-->


<script>
document.addEventListener("DOMContentLoaded", function(event) { 

    /*add section*/ 
    $(function() {
        $('#add_prod_form').validate({
            rules: {
                required: 'required',
                
            },
            messages: {
                required: 'This field is required',
                
            },
            errorPlacement: function(error, element) {} ,
            submitHandler: function(form) {
            $.ajax({
                url: "<?php echo base_url(); ?>Crm/Products/Add",
                method: "POST",
                data: $(form).serialize(),
                success: function(data) {
                    var data = JSON.parse(data);
                    
                    if(data.status === "true")
                    {   
                        $('#add_prod_form')[0].reset();
                    
                        $('.product_head').html("");

                        alertify.success('Data Added Successfully').delay(3).dismissOthers();

                        $('#AddProdModal').modal('hide');

                        datatable.ajax.reload( null, false )
                    }
                    else{
                        alertify.error('Duplicate Product Name').delay(3).dismissOthers();
                        
                        datatable.ajax.reload( null, false )
                    }
                    
                }
                
            });
            return false; // prevent the form from submitting
        }
    });
});

/*###*/




/*fetch code by product head*/


$("body").on('change', '.product_head', function(){ 

    console.log('tr');

    var id = $(this).val();

    $.ajax({

        url : "<?php echo base_url(); ?>Crm/Products/Code",

        method : "POST",

        data: {ID: id},

        success:function(data)
        {   
            var data = JSON.parse(data);

        
        $(".product_code").val(data.product_head_code);

        //$(".edit_produt_code").val(data.product_head_code);
        
            
        }


    });

});


/*####*/



/*droupdrown*/
$(".product_head_select").select2({
    placeholder: "Select Product Head",
    theme : "default form-control- customer_width",
    dropdownParent: $('#AddProdModal'),
    ajax: {
        url: "<?= base_url(); ?>Crm/Products/FetchTypes",
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
        processResults: function(data, params) {
            //console.log(data);
            //  NO NEED TO PARSE DATA `processResults` automatically parse it
            //var c = JSON.parse(data);
            console.log(data);
            var page = params.page || 1;
            return {
                results: $.map(data.result, function (item) { return {id: item.ph_id, text: item.ph_product_head}}),
                pagination: {
                // THE `10` SHOULD BE SAME AS `$resultCount FROM PHP, it is the number of records to fetch from table` 
                    more: (page * 10) <= data.total_count
                }
            };
        },              
    }
})
/*###*/

/*reset addd */

$('.add_model_btn').click(function(){

   
    
});


/*#######*/



});

</script>                        