<?php $this->load->view('admin/partials/header.php'); ?>

 <!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Document search
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <div class="relative text-gray-700 dark:text-gray-300">
                <input type="text" class="form-control py-3 px-4 w-full lg:w-64 box pr-10 placeholder-theme-13" id="my_searchdoc" name="my_searchdoc" placeholder="Search Doc...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> 
            </div>
            &nbsp;&nbsp;&nbsp;
            <button class="btn btn-primary lg:w-auto mt-3 lg:mt-0 right-5" id="searchBtn"> Search Document </button>
        </div>
    </div>

    <div class="intro-y box p-5 mt-5" id="nosearch">
        <div class="alert alert-danger show mb-2" role="alert">
            <div class="flex items-center">
                <div class="font-medium text-lg">Hi! <?= $this->session->userdata('staff_fname'); ?> <?= $this->session->userdata('staff_lname'); ?> document cannot found!</div>
            </div>
            <div class="mt-3">Please provide necessary and correct data in the Search Document form.</div>
        </div>
    </div>

     <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
            <!-- BEGIN: Item List -->
            <div class="intro-y col-span-12 lg:col-span-8">
                <div class="grid grid-cols-12 gap-5" id="result">
                </div>
            </div>
            <!-- END: Item List -->
             <div class="col-span-12 lg:col-span-4" id="dispay">
             </div>
        </div>
    </div>

    
</div>
<!-- END: Content -->


<?php $this->load->view('admin/partials/footer.php'); ?>

<script>   
   $(document).ready(function() {
    $('#searchBtn').click(function () {
    var my_searchdoc = $('#my_searchdoc').val();
    // alert(my_searchdoc);
    if(my_searchdoc == ''){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Search Document is empty!',
        });
    }else{
    $.showLoading({name: 'line-pulse', allowHide: false });
         $.ajax({
             url:"<?php echo base_url();?>admin/Documents/search_documents",
             data:  {my_searchdoc: my_searchdoc},
             dataType: 'JSON',
             type:"POST",
             success: function(result){
                var obj = JSON.parse(JSON.stringify(result));
                setTimeout(function() { $.hideLoading(); }, 500);
                var numResult = obj.length;
                if(numResult == undefined){
                    var image = obj.vd_zone;
                    $("#result").html(`<div class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in"><a href="javascript:;" onclick="get_doc(`+obj.dd_id+`)">
                        <input type="hidden" id="get_id" value="`+obj.dd_id+`">
                        <div class="font-medium text-base"> `+obj.dd_doc_id_code+` </div>
                        <div class="text-gray-600"> `+obj.dd_title+` </div>
                     </a></div>`);
                    $( "#nosearch" ).hide();
                }else{
                    var each_output = obj.map(function(obj){
                    return `<div class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in"><a href="javascript:;" onclick="get_doc(`+obj.dd_id+`)">
                        <input type="hidden" id="get_id" value="`+obj.dd_id+`">
                        <div class="font-medium text-base"> `+obj.dd_doc_id_code+` </div>
                        <div class="text-gray-600"> `+obj.dd_title+` </div>
                    </a></div>`;
                    });
                    $('#result').html(each_output);
                    $( "#nosearch" ).hide();
                   }
             }, //result
            error: function(){
               setTimeout(function() { $.hideLoading(); }, 500);
               $("#result").html(``); 
               $( "#nosearch" ).show();
               Swal.fire({
                  icon: 'error',
                  title: 'Document cannot found!',
                  text: 'Please provide necessary and correct data in the Search Document form.',
                });
            } // error
        });
    }
    });
  });
</script>


<script type= "text/javascript">
    function get_doc(id){
        //alert("Hello World!"+ +id);
        $.showLoading({name: 'line-pulse', allowHide: false });
        $.ajax({
            url:"<?php echo base_url();?>admin/Documents/display_doc",
            data: {docs_id: id},
            dataType: 'JSON',
            type:"POST",
            success: function(result){
                var obj = JSON.parse(JSON.stringify(result));
                setTimeout(function() { $.hideLoading(); }, 500);
                console.log(obj);

                var numResult = obj.length;
                if(numResult == undefined){
                    $("#dispay").html(`<div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Document Details
                            </h2>
                            `+obj.dd_status+`
                        </div>

                        <div class="tab-content">
                            <div class="box p-5 mt-5 zoom-in">
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                                    <div>
                                        <div class="text-gray-600"> Document title </div>
                                        <div class="mt-1"> `+obj.dd_title+` </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Document ID </div>
                                        <div class="mt-1"> `+obj.dd_doc_id_code+` </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Type of Document </div>
                                        <div class="mt-1"> `+obj.dd_doct_type+` </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Document Source </div>
                                        <div class="mt-1"> `+obj.dd_source+` </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Action Taken </div>
                                        <div class="mt-1"> `+obj.dd_action_taken+` </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Document Routed </div>
                                        <div class="mt-1"> `+obj.dd_view_doc+` </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Document Recived Date </div>
                                        <div class="mt-1"> `+obj.dd_date_routed+` </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600">  Concern Staff </div>
                                        <div class="mt-1"> `+obj.dd_routed_to+` </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex mt-5">
                                <a href="<?php echo base_url();?>admin/documents/viewDoc/`+obj.dd_id+`" class="btn btn-primary w-32 shadow-md ml-auto">View More</a>
                            </div>
                        </div>`);
                }
            }
        });
    }
</script>