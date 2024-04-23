<?php $this->load->view('admin/partials/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/template/css/styles.css'); ?>">

      <!-- BEGIN: Content -->
        <div class="content">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Registration of New Staff
                </h2>
            </div>
            <br> 
            <!-- BEGIN: Post Info -->
                    <div class="intro-y box mt-5">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                               Register
                            </h2>
                        </div>

                        <?php echo form_open_multipart('admin/Administrator/reg_staff'); ?>
                          <div id="horizontal-form" class="p-5">
                            <div class="preview">
                                <!-- Source -->
                                <div class="form-inline">
                                    <label for="username" class="form-label sm:w-40" style="text-align: left;">Username</label>
                                    <input type="text" id="username" name="username" class="w-full form-control" placeholder="Enter Username" required> 
                                </div>
                                <div class="form-inline  mt-5">
                                    <label for="password" class="form-label sm:w-40" style="text-align: left;">Password</label>
                                    <input type="text" id="password" name="password" class="w-full form-control" placeholder="Enter Password" required> 
                                </div>
                                <div class="form-inline  mt-5">
                                    <label for="email" class="form-label sm:w-40" style="text-align: left;">Email Address</label>
                                    <input type="email" id="email" name="email" class="w-full form-control" placeholder="Enter Email Address" required> 
                                </div>
                                <div class="form-inline  mt-5">
                                    <label for="fname" class="form-label sm:w-40" style="text-align: left;">First Name</label>
                                    <input type="text" id="fname" name="fname" class="w-full form-control" placeholder="Enter First Name" required> 
                                </div>
                                <div class="form-inline  mt-5">
                                    <label for="lname" class="form-label sm:w-40" style="text-align: left;">Last Name</label>
                                    <input type="text" id="lname" name="lname" class="w-full form-control" placeholder="Enter Last Name" required> 
                                </div>
                                <div class="form-inline  mt-5">
                                    <label for="address" class="form-label sm:w-40" style="text-align: left;">Address</label>
                                    <input type="text" id="address" name="address" class="w-full form-control" placeholder="Enter Address" required> 
                                </div>
                                <div class="form-inline  mt-5">
                                    <label for="em_no" class="form-label sm:w-40" style="text-align: left;">Employee No.</label>
                                    <input type="text" id="em_no" name="em_no" class="w-full form-control" placeholder="Enter Employee No." required> 
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="gender" class="form-label sm:w-40" style="text-align: left;">Gender</label>
                                    <select data-search="true" id="gender" name="gender" class="tail-select w-full form-control" required>
                                        <option value="">Please Select</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                                <div class="form-inline  mt-5">
                                    <label for="em_position" class="form-label sm:w-40" style="text-align: left;">Employee Position</label>
                                    <input type="text" id="em_position" name="em_position" class="w-full form-control" placeholder="Enter Employee Position" required> 
                                </div>
                                <div class="form-inline  mt-5">
                                    <label for="dob" class="form-label sm:w-40" style="text-align: left;">Date of Birth</label>
                                    <input type="date" id="dob" name="dob" class="w-full form-control" placeholder="Enter Date of Birth" required> 
                                </div>
                                <div class="form-inline  mt-5">
                                    <label for="contact" class="form-label sm:w-40" style="text-align: left;">Contact Number</label>
                                    <input type="number" id="contact" name="contact" class="w-full form-control" placeholder="Enter Contact Number" required> 
                                </div>
                                <div class="form-inline mt-5">
                                    <label for="division" class="form-label sm:w-40" style="text-align: left;">Division</label>
                                    <select data-search="true" id="division" name="division" class="tail-select w-full form-control" required>
                                        <?php foreach($staff_divisions as $staff_division): ?>
                                            <option value="<?php echo $staff_division['sd_code']; ?>"><?php echo $staff_division['sd_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select> 
                                </div>
                                <div class="form-inline  mt-5">
                                    <input type="hidden" id="staff_id" name="staff_id" value="<?php echo $count; ?>" class="w-full form-control"> 
                                </div>
                            </div>
                            <div class="text-right mt-5">
                                <button type="submit" class="btn btn-primary w-60 mr-2 mb-2 confirm_id"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Register Staff </button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>

                    </div>
                <!-- END: Post Info -->
        </div>
        <!-- END: Content -->

<?php $this->load->view('admin/partials/footer.php'); ?>

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