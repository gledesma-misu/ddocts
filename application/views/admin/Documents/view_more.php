
<?php $this->load->view('admin/partials/header.php'); ?>

<!-- BEGIN: Content -->
        <div class="content">
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Document Receive
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Profile Menu -->
                <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
                    <div class="intro-y box mt-5">
                        <?php foreach($get_id_staffs as $limit_doc): ?>
                        <?php if ($limit_doc['dd_recieved_doc'] == 0 && $limit_doc['dd_disregard_doc'] == 0): ?>
                        <a href="javascript:;" id="show<?php echo $limit_doc['dd_id'];?>" class="docdata"><div class="intro-x">
                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                <input type="hidden" name="docId" id="docId" value="<?php echo $limit_doc['dd_id']; ?>">
                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                    <img alt="Rubick Tailwind HTML Admin Template" src="<?php echo base_url('assets/template/images/doc_icon.png'); ?>">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">
                                        <?php foreach($staffs as $staff): ?>
                                         <?php if ($limit_doc['dd_encoded_doc'] == $staff['staff_id']): ?>
                                            <?php echo $staff['fname']; ?> <?php echo $staff['lname']; ?>
                                        <?php endif ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="text-gray-600 text-xs mt-0.5">
                                        <?php $date = $limit_doc['dd_date_encoded'];  
                                        $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                        <?php echo $datepicker; ?> 
                                    </div>
                                </div>
                                <div class="text-theme-9">

                                    <?php 
                                    $post = $limit_doc['dd_date_encoded'];
                                    //Let's set the current time
                                    date_default_timezone_set('Asia/Manila');
                                    $date_now = date('Y-m-d H:i:s', time());
                                    $toTime = strtotime($date_now);

                                    //And the time the notification was set
                                    $fromTime = strtotime($post);

                                    //Now calc the difference between the two
                                    $timeDiff = floor(abs($toTime - $fromTime) / 60);

                                    //Now we need find out whether or not the time difference needs to be in
                                    //minutes, hours, or days
                                    if ($timeDiff < 2) {
                                        $timeDiff = "Just now";
                                    } elseif ($timeDiff > 2 && $timeDiff < 60) {
                                        $timeDiff = floor(abs($timeDiff)) . " minutes ago";
                                    } elseif ($timeDiff > 60 && $timeDiff < 120) {
                                        $timeDiff = floor(abs($timeDiff / 60)) . " hour ago";
                                    } elseif ($timeDiff < 1440) {
                                        $timeDiff = floor(abs($timeDiff / 60)) . " hours ago";
                                    } elseif ($timeDiff > 1440 && $timeDiff < 2880) {
                                        $timeDiff = floor(abs($timeDiff / 1440)) . " day ago";
                                    } elseif ($timeDiff > 2880) {
                                        $timeDiff = floor(abs($timeDiff / 1440)) . " days ago";
                                    }

                                    echo $timeDiff;
                                    ?>

                                </div>
                            </div>
                        </div></a>
                        <?php endif ?>
                        <?php endforeach; ?> 
                    </div>
                </div>
                <!-- END: Profile Menu -->
                <div class="col-span-12 lg:col-span-8 xxl:col-span-9" >
                    <!-- BEGIN: Personal Information -->
                    <div class="intro-y box mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Document details
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12">

                                <div  id="result">
                                  <div class="alert alert-danger show mb-2" role="alert">
                                     <div class="flex items-center">
                                         <div class="font-medium text-lg">Please select document!</div>
                                     </div>
                                     <div class="mt-3">Document Cannot found please select atleast one.</div>
                                 </div>
                                 </div>
                                
                                </div>
                            </div>
                
                        </div>
                    </div>
                    <!-- END: Personal Information -->
                </div>
            </div>
        </div>
        <!-- END: Content -->

<!--  Modal Recieve -->
<?php foreach($get_id_staffs as $get_id_staff): ?>
<div id="Recieve<?php echo $get_id_staff['dd_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('admin/Dashboard/recieve_doc'); ?>
            <input type="hidden" name="get_id" value="<?php echo $get_id_staff['dd_id']; ?>">
            <div class="modal-body p-0">
                <div class="p-5 text-center">
                    <i data-feather="help-circle" class="w-16 h-16 text-theme-10 mx-auto mt-3"></i> 
                    <div class="text-3xl mt-5">Are you sure?</div>
                    <div class="text-gray-600 mt-2">
                        Do you want to recieve this document?
                    </div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                    <button type="submit" class="btn btn-primary w-40">Yes, recieve it!</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- End Modal Recieve -->

<!-- Message document details -->

<div class="text-center">
    <!-- BEGIN: Notification Content -->
    <div id="success-notification-content" class="toastify-content hidden flex">
        <i class="text-theme-9" data-feather="folder"></i> 
        <div class="ml-4 mr-4">
            <div class="font-medium">Hi! <?php echo $this->session->userdata('staff_fname') ?> <?php echo $this->session->userdata('staff_lname') ?></div>
            <div class="text-gray-600 mt-1">You Have Recieve <b><?php echo $count; ?></b> Documents.</div>
        </div>
    </div>
    <!-- END: Notification Content -->
    <!-- BEGIN: Notification Toggle -->
    <div hidden>
        <button id="success-notification-toggle" class="btn btn-primary">Show Notification</button>
    </div>
    <!-- END: Notification Toggle -->
</div>
<!--End Message document details -->


<?php $this->load->view('admin/partials/footer.php'); ?>


<script type="text/javascript">
$(".docdata").click(function(){ 
 var id = $(this).attr('id');
 var doc_id = id.replace("show",'');
//  alert(doc_id);
 $.showLoading({name: 'line-pulse', allowHide: false });
    $.ajax({
        url:"<?php echo base_url('admin/Documents/search_doc');?>",
        data: {doc_id: doc_id},
        dataType: 'JSON',
        type:"POST",
        success: function(result){
            console.log(result);
            var button;
            var obj = JSON.parse(JSON.stringify(result));
            setTimeout(function() { $.hideLoading(); }, 500);
            var numResult = obj.length;
            // console.log(obj.sess + ' ' + obj.dd_encode_doc);
            if (obj.dd_encode_doc != obj.sess){
                button = '<a class="btn btn-outline-primary w-34 inline-block mr-1 mb-2" href="javascript:;" data-toggle="modal" data-target="#Recieve`+obj.dd_id+`">Recieve</a>';
            }
            else {
                button = ''
            }
 
            if(numResult == null){
            $("#result").html(`<div class="overflow-x-auto" id="result">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"><b>`+obj.dd_title+`</b></th>
                                <th class="border-b-2 dark:border-dark-5 text-right whitespace-nowrap"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-b dark:border-dark-5">
                                    <div class="font-medium whitespace-nowrap">Type of Document</div>
                                </td>
                                <td class="text-right border-b dark:border-dark-5 ">
                                `+obj.dd_doct_type+`
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b dark:border-dark-5">
                                    <div class="font-medium whitespace-nowrap">Source Document</div>
                                </td>
                                <td class="text-right border-b dark:border-dark-5">
                                `+obj.dd_source+`
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b dark:border-dark-5">
                                    <div class="font-medium whitespace-nowrap">Required Action</div>
                                </td>
                                <td class="text-right border-b dark:border-dark-5">
                                `+obj.dd_action_taken+`
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b dark:border-dark-5">
                                    <div class="font-medium whitespace-nowrap">Document Recieved Date</div>
                                </td>
                                <td class="text-right border-b dark:border-dark-5">
                                `+obj.dd_date_routed+`
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b dark:border-dark-5">
                                    <div class="font-medium whitespace-nowrap">Routed From</div>
                                </td>
                                <td class="text-right border-b dark:border-dark-5">
                                `+obj.dd_view_doc+`
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b dark:border-dark-5">
                                    <div class="font-medium whitespace-nowrap">Date Routed</div>
                                </td>
                                <td class="text-right border-b dark:border-dark-5">
                                `+obj.dd_date_routed+`
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b dark:border-dark-5">
                                    <div class="font-medium whitespace-nowrap">Concern Staff/s</div>
                                </td>
                                <td class="text-right border-b dark:border-dark-5">
                                `+obj.dd_staff_name+`
                                </td>
                            </tr>
                            <tr>
                                <td class="border-b dark:border-dark-5">
                                    <div class="font-medium whitespace-nowrap">Notes/Remarks</div>
                                </td>
                                <td class="text-right border-b dark:border-dark-5">
                                `+obj.dd_note+`
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end mt-4">
                    `+button+` 
                </div>`); 
            }
        }
    }); //end of ajax   
});
</script>

<!-- successful Recieve the document -->
<?php if($this->session->flashdata('sucs_doc')): ?>
  <script type="text/javascript">
    Swal.fire({
      title: 'SECCESSFUL!',
      text: "Do you want to view the document datails?",
      icon: 'success',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, view it!'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "<?php echo base_url('admin/documents/viewDoc/'.$this->session->flashdata('sucs_doc'));?>";
      }
    });
  </script>
<?php endif; ?>

<script type="text/javascript">
    jQuery(function(){
        jQuery('#success-notification-toggle').click();
    });
</script>


