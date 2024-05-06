<?php $this->load->view('admin/partials/header.php'); ?>

     <!-- BEGIN: Content -->
        <div class="content">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Staff Details
                </h2>
            </div>
            <!-- BEGIN: HTML Table Data -->
            <div class="intro-y box p-5 mt-5">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                     Staff Details
                    </h2>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table id="dispatch_doc" class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Staff ID.</th>
                            <th class="text-center whitespace-nowrap">Full Name</th>
                            <th class="text-center whitespace-nowrap">Employee No.</th>
                            <th class="text-center whitespace-nowrap">Position</th>
                            <th class="text-center whitespace-nowrap">Office/Division/Unit</th>
                            <th class="text-center whitespace-nowrap">Email</th>
                            <th class="text-center whitespace-nowrap">Date Register</th>
                            <th class="text-center whitespace-nowrap">Status</th>
                            <th class="text-center whitespace-nowrap">Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($staff_divisions)&&(count($staff_divisions)))
                        foreach($staff_divisions as $staff_division): ?>
                         <tr class="intro-x">
                            <td class="text-center"><?php echo $staff_division['id']; ?></td>
                            <td class="text-center"><?php echo $staff_division['fname']; ?> <?php echo $staff_division['lname']; ?></td>
                            <td class="text-center"><?php echo $staff_division['employee_no']; ?></td>
                            <td class="text-center"><?php echo $staff_division['position']; ?></td>
                            <td class="text-center"><?php echo $staff_division['division']; ?></td>
                            <td class="text-center"><?php echo $staff_division['email']; ?></td>
                            <td class="text-center"><?php $date = $staff_division['reg_date'];  
                                $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                <?php echo $datepicker; ?></td>
                            <td class="text-center"><?php 
                            if($staff_division['su'] == 0){
                                echo '<span class="px-2 py-1 rounded-full bg-theme-9 text-white mr-1"> Activated </span>';
                                $icon ='lock';
                                $color ='btn btn-sm btn-outline-danger w-8 inline-block';
                            }else{
                                echo '<span class="px-2 py-1 rounded-full bg-theme-6 text-white mr-1"> Deactivated </span>';
                                $icon ='unlock';
                                $color ='btn btn-sm btn-outline-primary w-8 inline-block';
                            }
                            ?></td>
                            <td class="table-report__action w-30">
                                <div class="flex justify-center items-center">
                                    <a class="<?php echo $color; ?>" href="<?= base_url('admin/Administrator/staff_status/'.$staff_division['id'].'/'.$staff_division['su']); ?>"> <i data-feather="<?php echo $icon; ?>" class="w-4 h-4 mr-1"></i></a>&nbsp;|&nbsp;
                                    <a class="btn btn-sm btn-outline-primary w-8 inline-block" href="javascript:;" data-toggle="modal" data-target="#edit<?php echo $staff_division['staff_id_account']; ?>"> <i data-feather="edit" class="w-4 h-4 mr-1"></i></a>&nbsp;|&nbsp;
                                    <a class="btn btn-sm btn-outline-danger w-8 inline-block" href="<?= base_url('admin/Administrator/staff_remove/'.$staff_division['staff_id_account']); ?>"> <i data-feather="trash" class="w-4 h-4 mr-1"></i></a>

                                    <div class="preview">
                                        <!-- BEGIN: Modal Content -->
                                        <div id="edit<?php echo $staff_division['staff_id_account']; ?>" class="modal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <?php echo form_open('admin/Administrator/update_staff_account'); ?>
                                                    <input type="hidden" name="get_id" value="<?php echo $staff_division['staff_id_account']; ?>">
                                                    <!-- BEGIN: Modal Header -->
                                                    <div class="modal-header">
                                                        <h2 class="font-medium text-base mr-auto">
                                                            Update Account
                                                        </h2>
                                                    </div>
                                                    <!-- END: Modal Header -->
                                                    <!-- BEGIN: Modal Body -->
                                                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                                            <div class="col-span-12 sm:col-span-12">
                                                                <label for="fname" class="form-label"> First Name </label>
                                                                <input type="text" id="fname" name="fname" class="form-control" value="<?php echo $staff_division['fname']; ?>" required>
                                                            </div>
                                                            <div class="col-span-12 sm:col-span-12">
                                                                <label for="lname" class="form-label"> Last Name </label>
                                                                <input type="text" id="lname" name="lname" class="form-control" value="<?php echo $staff_division['lname']; ?>" required>
                                                            </div>
                                                            <div class="col-span-12 sm:col-span-12">
                                                                <label for="em_no" class="form-label"> Employee No. </label>
                                                                <input type="text" id="em_no" name="em_no" class="form-control" value="<?php echo $staff_division['employee_no']; ?>" required>
                                                            </div>
                                                            <div class="col-span-12 sm:col-span-12">
                                                                <label for="position" class="form-label"> Position </label>
                                                                <input type="text" id="position" name="position" class="form-control" value="<?php echo $staff_division['position']; ?>" required>
                                                            </div>
                                                            <div class="col-span-12 sm:col-span-12">
                                                                <label for="email" class="form-label"> Email Address </label>
                                                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $staff_division['email']; ?>" required>
                                                            </div>
                                                            <div class="col-span-12 sm:col-span-12">
                                                                <label for="get_my_staff" class="form-label"> Division </label>
                                                                <select data-search="true" id="division" name="division" class="tail-select w-full form-control" required>
                                                                    <?php foreach($staff_divs as $staff_div): ?>
                                                                        <option value="<?php echo $staff_div['sd_code']; ?>"><?php echo $staff_div['sd_name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select> 
                                                            </div>
                                                        </div>
                                                        <!-- END: Modal Body -->
                                                    <!-- BEGIN: Modal Footer -->
                                                    
                                                    <div class="modal-footer text-right">
                                                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-25"> <i data-feather="x" class="w-4 h-4"></i> &nbsp; Cancel</button>
                                                        <button type="submit" class="btn btn-primary w-25"> <i data-feather="activity" class="w-4 h-4"></i> &nbsp; Save Changes </button>
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
                            <th class="whitespace-nowrap">Staff ID.</th>
                            <th class="text-center whitespace-nowrap">Full Name</th>
                            <th class="text-center whitespace-nowrap">Employee No.</th>
                            <th class="text-center whitespace-nowrap">Position</th>
                            <th class="text-center whitespace-nowrap">Division</th>
                            <th class="text-center whitespace-nowrap">email</th>
                            <th class="text-center whitespace-nowrap">Date Register</th>
                            <th class="text-center whitespace-nowrap">Status</th>
                            <th class="text-center whitespace-nowrap">Action</th> 
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div> 
            <!-- END: HTML Table Data -->
        </div>
        <!-- END: Content -->


<?php $this->load->view('admin/partials/footer.php'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/admin/assets/extra-libs/DataTables/datatables.min.js'); ?>"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#dispatch_doc').DataTable({
        columnDefs: [ { type: 'date', 'targets': [5] } ],
        order: [[ 5, 'desc' ]],   
    });
</script>

<?php if($this->session->flashdata('s_updated')): ?>
   <script type="text/javascript">
    Swal.fire({
      title: '<strong>SUCCESSFUL!</strong>',
      icon: 'success',
      html:
        '<?php echo $this->session->flashdata('s_updated');?>',
      showCloseButton: true,
      focusConfirm: true,
      allowEscapeKey: true,
      confirmButtonText:
        '<i class="fa fa-thumbs-up"></i> GREAT!',
      confirmButtonAriaLabel: 'DONE!'
    })
  </script>
<?php endif; ?>

<?php if($this->session->flashdata('s_remove')): ?>
   <script type="text/javascript">
    Swal.fire({
      title: '<strong>SUCCESSFUL!</strong>',
      icon: 'success',
      html:
        '<?php echo $this->session->flashdata('s_remove');?>',
      showCloseButton: true,
      focusConfirm: true,
      allowEscapeKey: true,
      confirmButtonText:
        '<i class="fa fa-thumbs-up"></i> GREAT!',
      confirmButtonAriaLabel: 'DONE!'
    })
  </script>
<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>
   <script type="text/javascript">
    Swal.fire({
      title: '<strong>SUCCESSFUL!</strong>',
      icon: 'success',
      html:
        '<?php echo $this->session->flashdata('success');?>',
      showCloseButton: true,
      focusConfirm: true,
      allowEscapeKey: true,
      confirmButtonText:
        '<i class="fa fa-thumbs-up"></i> GREAT!',
      confirmButtonAriaLabel: 'DONE!'
    })
  </script>
<?php endif; ?>
