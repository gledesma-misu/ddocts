<?php $this->load->view('admin/partials/header.php'); ?>

 <!-- BEGIN: Content -->
        <div class="content"> 
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                   Source Documents
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <a href="javascript:;" data-toggle="modal" data-target="#Create_new" class="btn btn-primary shadow-md mr-2">Create New Source</a> 
                    <div class="pos-dropdown dropdown ml-auto sm:ml-0">
                        <button class="dropdown-toggle notification notification--light notification--bullet btn px-2  box text-gray-700 dark:text-gray-300" aria-expanded="false">
                            <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="chevron-down"></i> </span>
                        </button>
                        <div class="pos-dropdown__dropdown-menu dropdown-menu">
                            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                <?php foreach($request_docs as $request_doc): ?>
                                <?php if ($request_doc['rs_status'] == 0): ?>
                                <a href="javascript:;" data-toggle="modal" data-target="#Edit_request<?php echo $request_doc['rs_id']; ?>" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> <span class="truncate"> 
                                <!--  Name of the staff requested -->
                                <?php foreach($staffs as $staff): ?>
                                    <?php if ($request_doc['rs_request'] == $staff['staff_id']): ?>
                                        <?php echo $staff['fname']; ?>
                                    <?php endif ?>
                                <?php endforeach; ?>

                                -
                                <!--  Date requested -->
                                <?php $post = $request_doc['rs_date'];  
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

                                echo $timeDiff;?>
                                </span></a>
                                <?php else: ?>
                                <p>No Request Found!</p>
                                <?php endif ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- BEGIN: HTML Table Data -->
            <div class="intro-y box p-5 mt-5">
                <table id="source_doc" class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Source Name</th>
                            <th class="text-center whitespace-nowrap">Type</th>
                            <th class="text-center whitespace-nowrap">Code</th>
                            <th class="text-center whitespace-nowrap">Sub Source</th>
                            <th class="text-center whitespace-nowrap">Date Registered</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if(is_array($sources_docs)&&(count($sources_docs)))
                         foreach($sources_docs as $sources_doc): ?>
                            <?php if ($sources_doc['ds_type'] == 1 || $sources_doc['ds_type'] == 0): ?>
                            <tr class="intro-x">
                                <td class="text-center"> <?php echo $sources_doc['ds_name']; ?> </td>
                                <td class="text-center"> 
                                    <?php if ($sources_doc['ds_type'] == 0): ?>
                                        Internal
                                    <?php elseif ($sources_doc['ds_type'] == 1): ?>
                                        External
                                    <?php endif ?>
                                </td>
                                <td class="text-center"> <?php echo $sources_doc['ds_code']; ?></td>
                                <td class="text-center"> <?php echo $sources_doc['ds_sub']; ?></td>
                                <td class="text-center"> 
                                    <?php $date = $sources_doc['ds_date_added'];  
                                    $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                    <?php echo $datepicker; ?>
                                </td>

                                <td class="table-report__action w-30">
                                    <div class="flex justify-center items-center">
                                        <a class="btn btn-sm btn-outline-primary w-24 inline-block" href="javascript:;" data-toggle="modal" data-target="#Update<?php echo $sources_doc['ds_id']; ?>"> <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit </a> &nbsp; | &nbsp;
                                        <a class="btn btn-sm btn-outline-danger w-24 inline-block" href="javascript:;" data-toggle="modal" data-target="#delete<?php echo $sources_doc['ds_id']; ?>"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>Delete </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endif ?>
                        <?php endforeach; ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="whitespace-nowrap">Source Name</th>
                            <th class="text-center whitespace-nowrap">Type</th>
                            <th class="text-center whitespace-nowrap">Code</th>
                            <th class="text-center whitespace-nowrap">Sub Source</th>
                            <th class="text-center whitespace-nowrap">Date Registered</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- END: HTML Table Data -->
        </div>
        <!-- END: Content -->
<!-- Create document source -->
<div id="Create_new" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                   New Source Document 
                </h2>
            </div>
            <?php echo form_open('admin/administrator/create_doc'); ?>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label for="pos-form-1" class="form-label">Source Name</label>
                    <input id="pos-form-1" type="text" id="source" name="source" class="form-control flex-1" placeholder="Enter Source Name">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-2" class="form-label">Select Type Source</label>
                    <select data-placeholder="Select Type Source" id="source_type" name="source_type" class="tail-select w-full form-control">
                        <option value="">Select Type Source</option>
                        <option value="0">Internal</option>
                        <option value="1">External</option>
                    </select>
                </div>
                <div class="col-span-12">
                    <label for="pos-form-3" class="form-label">Sub Source</label>
                    <input id="pos-form-3" type="text"  id="source_sub" name="source_sub" class="form-control flex-1" placeholder="Ex. MISU">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-3" class="form-label">Source Code</label>
                    <input id="pos-form-3" type="text"  id="source_code" name="source_code" class="form-control flex-1" placeholder="Ex. MISU">
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                <button type="submit" class="btn btn-primary w-32">Insert</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- END: Create document source -->

<!-- Request new document source -->
<?php foreach($request_docs as $request_doc): ?>
<div id="Edit_request<?php echo $request_doc['rs_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    New Source Document
                </h2>
            </div>
            <?php echo form_open('admin/administrator/request_doc/'.$request_doc['rs_id']); ?>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label for="pos-form-1" class="form-label">Source Name</label>
                    <input id="pos-form-1" type="text" id="r_source" name="r_source" class="form-control flex-1" value="<?php echo $request_doc['rs_name']; ?>" placeholder="Eneter Source Name">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-2" class="form-label">Select Type Source</label>
                    <select data-placeholder="Select Type Source" id="r_type" name="r_type" class="tail-select w-full form-control">
                        <option value="">Select Type Source</option>
                        <option value="0">Internal</option>
                        <option value="1">External</option>
                    </select>
                </div>
                <div class="col-span-12">
                    <label for="pos-form-3" class="form-label">Sub Source</label>
                    <input id="pos-form-3" id="r_sub" name="r_sub" type="text" class="form-control flex-1" placeholder="DSWD">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-3" class="form-label">Source Code</label>
                    <input id="pos-form-3" id="r_code" name="r_code" type="text" class="form-control flex-1" placeholder="DSWD">
                </div>
                <hr class="col-span-12">
                <div class="col-span-12">
                    <div class="col-span-12">
                        <label for="pos-form-1" class="form-label">Requested By: </label>
                        <?php foreach($staffs as $staff): ?>
                            <?php if ($request_doc['rs_request'] == $staff['staff_id']): ?>
                                <input id="pos-form-1" type="text" disabled class="form-control flex-1" value="<?php echo $staff['fname']; ?>  <?php echo $staff['lname']; ?>" placeholder="Eneter Source Name">
                            <?php endif ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                <button type="submit" class="btn btn-primary w-32">Insert</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- END: Request new document source -->

<!-- update document source -->
<?php foreach($sources_docs as $sources_doc): ?>
<div id="Update<?php echo $sources_doc['ds_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Update Source Document
                </h2> 
            </div>
            <?php echo form_open('admin/administrator/update_doc/'.$sources_doc['ds_id']); ?>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label for="pos-form-1" class="form-label">Source Name</label>
                    <input id="pos-form-1" type="text" id="u_soruce" name="u_soruce" class="form-control flex-1" value="<?php echo $sources_doc['ds_name']; ?>" placeholder="Eneter Source Name">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-2" class="form-label">Select Type Source</label>
                    <?php if ($sources_doc['ds_type'] == '0'): ?>
                        <?php  $Exist = 'Internal'; ?>
                    <?php else: ?>
                        <?php  $Exist = 'External'; ?> 
                    <?php endif ?>

                    <select data-placeholder="Select Type Source" id="type" name="type" class="tail-select w-full form-control">
                        <option value="">Existing: <?php echo $Exist; ?></option>
                        <option value="0">Internal</option>
                        <option value="1">External</option>
                    </select>
                </div>
                <div class="col-span-12">
                    <label for="pos-form-3" class="form-label">Sub Source</label>
                    <input id="pos-form-3" id="sub" name="sub" value="<?php echo $sources_doc['ds_sub']; ?>" type="text" class="form-control flex-1" placeholder="DSWD">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-3" class="form-label">Source Code</label>
                    <input id="pos-form-3" id="code" name="code" value="<?php echo $sources_doc['ds_code']; ?>" type="text" class="form-control flex-1" placeholder="DSWD">
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                <button type="submit" class="btn btn-primary w-32">Update</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- END: update document source -->

<!-- BEGIN: delete Content -->
<?php foreach($sources_docs as $sources_doc): ?>
 <div id="delete<?php echo $sources_doc['ds_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-body p-0">
                <?php echo form_open('admin/administrator/delete_doc/'.$sources_doc['ds_id']); ?>
                 <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                     <div class="text-3xl mt-5">Are you sure?</div>
                     <div class="text-gray-600 mt-2">Do you really want to delete these source document? <br>This process cannot be undone.</div>
                 </div>
                 <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button> <button type="submit" class="btn btn-danger w-24">Delete</button> </div>
                <?php echo form_close(); ?>
             </div>
         </div>
     </div>
 </div> <!-- END: delete Content -->
<?php endforeach; ?>

<!-- Message for new request -->
<?php foreach($request_docs as $request_doc): ?>
<?php if ($request_doc['rs_status'] == 0 && $request_doc['rs_date'] >= $this->session->userdata('last_login')): ?>
<div class="text-center">
    <!-- BEGIN: Notification Content -->
    <div id="success-notification-content" class="toastify-content hidden flex">
        <i class="text-theme-9" data-feather="file-text"></i> 
        <div class="ml-4 mr-4">
            <div class="font-medium">Hi! <?php echo $this->session->userdata('staff_fname') ?> <?php echo $this->session->userdata('staff_lname') ?></div>
            <div class="text-gray-600 mt-1">
                New Request receive
            </div>
        </div>
    </div>
    <!-- END: Notification Content -->
    <!-- BEGIN: Notification Toggle -->
    <div hidden>
        <button id="success-notification-toggle" class="btn btn-primary">Show Notification</button>
    </div>
    <!-- END: Notification Toggle -->
</div>
<?php endif ?>
<?php endforeach; ?>
<!-- ENd Message for new request -->

<!-- Footer -->
<?php $this->load->view('admin/partials/footer.php'); ?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#source_doc').DataTable({
        columnDefs: [ { type: 'date', 'targets': [4] } ],
        order: [[ 4, 'desc' ]],   
    });
</script>

<script type="text/javascript">
    jQuery(function(){
        jQuery('#success-notification-toggle').click();
    });
</script>

<?php if($this->session->flashdata('source_deleted')): ?>
  <script type="text/javascript">
      Swal.fire(
      'Successful!',
      '<?php echo $this->session->flashdata('source_deleted') ?>',
      'success'
    )
  </script>
<?php endif; ?>

<?php if($this->session->flashdata('source_created')): ?>
  <script type="text/javascript">
      Swal.fire(
      'Successful!',
      '<?php echo $this->session->flashdata('source_created') ?>',
      'success'
    )
  </script>
<?php endif; ?>

<?php if($this->session->flashdata('source_updated')): ?>
  <script type="text/javascript">
      Swal.fire(
      'Successful!',
      '<?php echo $this->session->flashdata('source_updated') ?>',
      'success'
    )
  </script>
<?php endif; ?>

<?php if($this->session->flashdata('source_Request')): ?>
  <script type="text/javascript">
      Swal.fire(
      'Successful!',
      '<?php echo $this->session->flashdata('source_Request') ?>',
      'success'
    )
  </script>
<?php endif; ?>