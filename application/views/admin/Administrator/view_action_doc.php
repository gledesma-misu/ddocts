<?php $this->load->view('admin/partials/header.php'); ?>

     <!-- BEGIN: Content -->
        <div class="content">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Action Documents
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <a href="javascript:;" data-toggle="modal" data-target="#Create_new" class="btn btn-primary shadow-md mr-2"> Create New Action </a> 
                </div>
            </div>
            <!-- BEGIN: HTML Table Data -->
            <div class="intro-y box p-5 mt-5">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                     Document Details
                    </h2>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table id="dispatch_doc" class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap"> Name </th>
                            <th class="text-center whitespace-nowrap"> Code </th>
                            <th class="text-center whitespace-nowrap"> Date Register</th>
                            <th class="text-center whitespace-nowrap"> Action </th> 
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($action_docs)&&(count($action_docs)))
                         foreach($action_docs as $action_doc): ?>
                            <tr class="intro-x">
                                <td class="text-center"> <?php echo $action_doc['da_name']; ?> </td>
                                <td class="text-center"> <?php echo $action_doc['da_code']; ?> </td>
                                <td class="text-center"> 
                                    <?php $date = $action_doc['da_date'];  
                                    $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                    <?php echo $datepicker; ?>
                                </td>

                                <td class="table-report__action w-30">
                                    <div class="flex justify-center items-center">
                                        <a class="btn btn-sm btn-outline-primary w-24 inline-block" href="javascript:;" data-toggle="modal" data-target="#Edit<?php echo $action_doc['da_id']; ?>"> <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit </a> &nbsp; | &nbsp;
                                        <a class="btn btn-sm btn-outline-danger w-24 inline-block" href="<?= base_url('admin/Administrator/action_remove/'.$action_doc['da_id']); ?>"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>Delete </a>

                                        <div class="preview">
                                            <!-- BEGIN: Modal Content -->
                                            <div id="Edit<?php echo $action_doc['da_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <?php echo form_open('admin/Administrator/update_action/'.$action_doc['da_id']); ?>
                                                        <!-- BEGIN: Modal Header -->
                                                        <div class="modal-header">
                                                            <h2 class="font-medium text-base mr-auto">
                                                                Update Action Document
                                                            </h2>
                                                        </div>
                                                        <!-- END: Modal Header -->
                                                        <!-- BEGIN: Modal Body -->
                                                            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                                <div class="col-span-12 sm:col-span-12">
                                                                    <label for="fname" class="form-label"> Action Name </label>
                                                                    <input type="text" id="ac_update" name="ac_update" class="form-control" value="<?php echo $action_doc['da_name']; ?>" required>
                                                                </div>
                                                                <div class="col-span-12 sm:col-span-12">
                                                                    <label for="lname" class="form-label"> Document Code </label>
                                                                    <input type="text" id="co_update" name="co_update" class="form-control" value="<?php echo $action_doc['da_code']; ?>" required>
                                                                </div>

                                                                <div class="col-span-12 sm:col-span-12">
                                                                    <?php
                                                                        date_default_timezone_set('Asia/Manila');
                                                                        $date_now = date('Y-m-d H:i:s');
                                                                        $datepicker = date("M-d-Y h:i A", strtotime($date_now));
                                                                    ?>
                                                                    <label for="lname" class="form-label"> Date Update </label>
                                                                    <input type="text" disabled class="form-control" value="<?php echo $datepicker; ?>" required>
                                                                </div>

                                                                
                                                            </div>
                                                            <!-- END: Modal Body -->
                                                        <!-- BEGIN: Modal Footer -->
                                                        
                                                        <div class="modal-footer text-right">
                                                            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-25"> <i data-feather="x" class="w-4 h-4"></i> &nbsp; Cancel</button>
                                                            <button type="submit"  class="btn btn-primary w-25"> <i data-feather="activity" class="w-4 h-4"></i> &nbsp; Save Changes </button>
                                                        </div>
                                                        <?php echo form_close(); ?>
                                                        <!-- END: Modal Footer -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END: Modal Content -->
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="whitespace-nowrap"> Name </th>
                            <th class="text-center whitespace-nowrap"> Code </th>
                            <th class="text-center whitespace-nowrap"> Date Register</th>
                            <th class="text-center whitespace-nowrap"> Action </th> 
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
            <!-- END: HTML Table Data -->
        </div>
        <!-- END: Content -->

<!-- Create type doc -->
<div id="Create_new" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                   New Action Document
                </h2>
            </div>
            <?php echo form_open('admin/administrator/action_create'); ?>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label for="pos-form-1" class="form-label"> Action Name </label>
                    <input id="pos-form-1" type="text" id="actionName_doc" name="actionName_doc" class="form-control flex-1" placeholder="Eneter Action Name">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-1" class="form-label"> Action Code </label>
                    <input id="pos-form-1" type="text" id="actionCode_doc" name="actionCode_doc" class="form-control flex-1" placeholder="Eneter Action Code">
                </div>
                <div class="col-span-12">

                <?php
                    date_default_timezone_set('Asia/Manila');
                    $date_now = date('Y-m-d H:i:s');
                    $datepicker = date("M-d-Y h:i A", strtotime($date_now));
                ?>
                    <label for="pos-form-1" class="form-label"> Dete Register </label>
                    <input id="pos-form-1" type="text" disabled id="actionDate_doc" name="actionDate_doc" class="form-control flex-1" value="<?php echo $datepicker; ?>">
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
<!-- END: Create Create type doc -->


<?php $this->load->view('admin/partials/footer.php'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin/assets/extra-libs/DataTables/datatables.min.js'); ?>"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#dispatch_doc').DataTable({
        columnDefs: [ { type: 'date', 'targets': [2] } ],
        order: [[ 2, 'desc' ]],   
    });
</script>

<?php if($this->session->flashdata('action_created')): ?>
  <script type="text/javascript">
      Swal.fire(
      'Successful!',
      '<?php echo $this->session->flashdata('action_created') ?>',
      'success'
    )
  </script>
<?php endif; ?>