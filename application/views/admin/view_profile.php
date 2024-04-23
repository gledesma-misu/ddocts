<?php $this->load->view('admin/partials/header.php'); ?>

<!-- BEGIN: Content -->
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                View Profile Information
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
                <div class="intro-y box mt-5 lg:mt-0">
                    <div class="relative flex items-center p-5">
                        <div class="w-12 h-12 image-fit">
                            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="<?php echo base_url('assets/template/images/female_avatar.png'); ?>">
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium text-base"> <?= $this->session->userdata('staff_fname'); ?> <?= $this->session->userdata('staff_lname'); ?> </div>
                            <div class="text-gray-600"> <?= $this->session->userdata('staff_position'); ?> </div>
                        </div>
                    </div>
                    <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                        <div class="boxed-tabs nav nav-tabs flex-col justify-center sm:flex-row text-gray-700 dark:text-gray-300" role="tablist">
                            <a id="top-products-laravel-tab" data-toggle="tab" data-target="#laravel" href="javascript:;" class="w-full sm:w-30 mb-2 sm:mb-0 py-2 rounded-md box dark:bg-dark-5 text-center sm:mx-2 active" role="tab" aria-selected="true"> <i data-feather="activity" class="block w-6 h-6 mb-2 mx-auto"></i> Profile Infirmation </a>
                            <a id="top-products-symfony-tab" data-toggle="tab" data-target="#symfony" href="javascript:;" class="w-full sm:w-30 mb-2 sm:mb-0 py-2 rounded-md box dark:bg-dark-5 text-center sm:mx-2" role="tab" aria-selected="false"> <i data-feather="settings" class="block w-6 h-6 mb-2 mx-auto"></i> Edit Profile </a>
                            <a id="top-products-bootstrap-tab" data-toggle="tab" data-target="#bootstrap" href="javascript:;" class="w-full sm:w-30 mb-2 sm:mb-0 py-2 rounded-md box dark:bg-dark-5 text-center sm:mx-2" role="tab" aria-selected="false"> <i data-feather="lock" class="block w-6 h-6 mb-2 mx-auto"></i> Change Password </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Daily Sales -->
                <div class="intro-y box col-span-12 xxl:col-span-6">
                <div class="p-5">
                        <div class="tab-content">
                            <!-- ================================================= Tab 1 start ============================================= -->
                            <div id="laravel" class="tab-pane active" role="tabpanel" aria-labelledby="top-products-laravel-tab">
                                <div class="flex items-center  py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                        Profile Information
                                    </h2>
                                </div>
                                <div class="flex flex-col sm:flex-row items-center mt-3 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <div class="w-12 h-12 flex-none image-fit">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="<?php echo base_url('assets/template/images/profile-8.jpg'); ?>">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <a href="" class="font-medium">Full Name</a> 
                                        <div class="text-gray-600 mr-5 sm:mr-5"><?= $this->session->userdata('staff_fname'); ?> <?= $this->session->userdata('staff_lname'); ?></div>
                                    </div>
                                </div>
                                <div class="flex flex-col sm:flex-row items-center mt-3 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <div class="w-12 h-12 flex-none image-fit">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="<?php echo base_url('assets/template/images/profile-8.jpg'); ?>">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <a href="" class="font-medium">Staff Division</a> 
                                        <div class="text-gray-600 mr-5 sm:mr-5">
                                        <?php switch ($this->session->userdata('staff_division')){
                                            case 2:
                                                echo "Office of the Executive Director";
                                            break;
                                            case 3:
                                                echo "Office of the Deputy Executive Director";
                                            break;
                                            case 4:
                                                echo "Management Information Systems Unit";
                                            break;
                                            case 5:
                                                echo "Administrative Finance and Division -  Record Section";
                                            break;
                                            case 6:
                                                echo "Administrative Finance and Division -  HRMD Section";
                                            break;
                                            case 7:
                                                echo "Administrative Finance and Division -  Budget Section";
                                            break;
                                            case 8:
                                                echo "Administrative Finance and Division -  Property and Supply";
                                            break;
                                            case 9:
                                                echo "Administrative Finance and Division -  Cash Section";
                                            break;
                                            case 10:
                                                echo "Administrative Finance and Division -  Accounting Section";
                                            break;
                                            case 11:
                                                echo "Administrative Finance and Division -  Procurement Section";
                                            break;
                                            case 12:
                                                echo "Administrative Finance and Division -  General Services";
                                            break;
                                            case 13:
                                                echo "Policy, Planning, and Research Division";
                                            break;
                                            case 14:
                                                echo "Localization and Institutionalization Division";
                                            break;
                                            case 15:
                                                echo "LID - Regional Committee and Subcommittee for the Welfare of Children";
                                            break;
                                            case 16:
                                                echo "Public Affairs and Information Office";
                                            break;
                                            case 17:
                                                echo "Monitoring and Evaluation Division";
                                            break;
                                            case 18:
                                                echo "Office of the Executive Director - Legal";
                                            break;
                                            case 19:
                                                echo "Project Management Office";
                                            break;                                             
                                            default: 
                                                echo "ERROR";
                                            break;   
                                        }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col sm:flex-row items-center mt-3 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <div class="w-12 h-12 flex-none image-fit">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="<?php echo base_url('assets/template/images/profile-8.jpg'); ?>">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <a href="" class="font-medium">Official Email</a> 
                                        <div class="text-gray-600 mr-5 sm:mr-5"> <?= $this->session->userdata('staff_official_email'); ?> </div>
                                    </div>
                                </div>
                                <div class="flex flex-col sm:flex-row items-center mt-3 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <div class="w-12 h-12 flex-none image-fit">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="<?php echo base_url('assets/template/images/profile-8.jpg'); ?>">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <a href="" class="font-medium">Staff Postion</a> 
                                        <div class="text-gray-600 mr-5 sm:mr-5"> <?= $this->session->userdata('staff_position'); ?> </div>
                                    </div>  
                                </div>
                                <div class="flex flex-col sm:flex-row items-center mt-3 ">
                                    <div class="w-12 h-12 flex-none image-fit">
                                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="<?php echo base_url('assets/template/images/profile-8.jpg'); ?>">
                                    </div>
                                    <div class="ml-4 mr-auto">
                                        <a href="" class="font-medium">Postion Title</a> 
                                        <div class="text-gray-600 mr-5 sm:mr-5">
                                            <?php if ($this->session->userdata('staff_position_title') == ''): ?>
                                                None
                                            <?php else: ?>
                                                <?php echo $this->session->userdata('staff_position_title'); ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ================================================= Tab 2 start ============================================= -->
                            <div id="symfony" class="tab-pane" role="tabpanel" aria-labelledby="top-products-symfony-tab">
                                <div class="flex items-center  py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                       Edit Profile Information
                                    </h2>
                                </div>
                                <div class="form-inline mt-3">
                                    <label for="p_fname" class="form-label sm:w-40" style="text-align: left;">First Name</label>
                                    <input id="p_fname" name="p_fname" type="text" class="form-control" placeholder="Enter First Name" value="<?= $this->session->userdata('staff_fname'); ?>" required>
                                </div>
                                <input type="hidden" id="staff_id" name="staff_id" value="<?= $this->session->userdata('staff_id'); ?>">
                                <div class="form-inline mt-3">
                                    <label for="p_mname" class="form-label sm:w-40" style="text-align: left;">Middle Name</label>
                                    <input id="p_mname" name="p_mname" type="text" class="form-control" placeholder="Enter Middle Name" value="<?= $this->session->userdata('staff_mname'); ?>" required>
                                </div>
                                <div class="form-inline mt-3">
                                    <label for="p_lname" class="form-label sm:w-40" style="text-align: left;">Last Name</label>
                                    <input id="p_lname" name="p_lname" type="text" class="form-control" placeholder="Enter Last Name" value="<?= $this->session->userdata('staff_lname'); ?>" required> 
                                </div>
                                <div class="form-inline mt-3">
                                    <label for="p_div" class="form-label sm:w-40" style="text-align: left;">Staff Division</label>
                                    <?php switch ($this->session->userdata('staff_division')){
                                            case 2:
                                                $Exist = "Office of the Executive Director";
                                            break;
                                            case 3:
                                                $Exist = "Office of the Deputy Executive Director";
                                            break;
                                            case 4:
                                                $Exist = "Management Information Systems Unit";
                                            break;
                                            case 5:
                                                $Exist = "Administrative Finance and Division -  Record Section";
                                            break;
                                            case 6:
                                                $Exist = "Administrative Finance and Division -  HRMD Section";
                                            break;
                                            case 7:
                                                $Exist = "Administrative Finance and Division -  Budget Section";
                                            break;
                                            case 8:
                                                $Exist = "Administrative Finance and Division -  Property and Supply";
                                            break;
                                            case 9:
                                                $Exist = "Administrative Finance and Division -  Cash Section";
                                            break;
                                            case 10:
                                                $Exist = "Administrative Finance and Division -  Accounting Section";
                                            break;
                                            case 11:
                                                $Exist = "Administrative Finance and Division -  Procurement Section";
                                            break;
                                            case 12:
                                                $Exist = "Administrative Finance and Division -  General Services";
                                            break;
                                            case 13:
                                                $Exist = "Policy, Planning, and Research Division";
                                            break;
                                            case 14:
                                                $Exist = "Localization and Institutionalization Division";
                                            break;
                                            case 15:
                                                $Exist = "LID - Regional Committee and Subcommittee for the Welfare of Children";
                                            break;
                                            case 16:
                                                $Exist = "Public Affairs and Information Office";
                                            break;
                                            case 17:
                                                $Exist = "Monitoring and Evaluation Division";
                                            break;
                                            case 18:
                                                $Exist = "Office of the Executive Director - Legal";
                                            break;
                                            case 19:
                                                $Exist = "Project Management Office";
                                            break;                                            
                                            default: 
                                                $Exist = "ERROR";
                                            break;   
                                        }?>
                                    <select data-placeholder="<?php $Exist; ?>" data-search="true" class="tail-select w-full form-control" id="p_div" name="p_div" required>
                                        <optgroup label="Required Actions">
                                            <option value="">Existing: <?php echo $Exist; ?></option>
                                            <option value="2">Office of the Executive Director</option>
                                            <option value="3">Office of the Deputy Executive Director</option>
                                            <option value="4">Management Information Systems Unit</option>
                                            <option value="5">Administrative Finance and Division -  Record Section</option>
                                            <option value="6">Administrative Finance and Division -  HRMD Section</option>
                                            <option value="7">Administrative Finance and Division -  Budget Section</option>
                                            <option value="8">Administrative Finance and Division -  Property and Supply</option>
                                            <option value="9">Administrative Finance and Division -  Cash Section</option>
                                            <option value="10">Administrative Finance and Division -  Accounting Section</option>
                                            <option value="11">Administrative Finance and Division -  Procurement Section</option>
                                            <option value="12">Administrative Finance and Division -  General Services</option>
                                            <option value="13">Policy, Planning, and Research Division</option>
                                            <option value="14">Localization and Institutionalization Division</option>
                                            <option value="15">LID - Regional Committee and Subcommittee for the Welfare of Children</option>
                                            <option value="16">Public Affairs and Information Office</option>
                                            <option value="17">Monitoring and Evaluation Division</option>
                                            <option value="18">Office of the Executive Director - Legal</option>
                                            <option value="19">Project Management Office</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-inline mt-3">
                                    <label for="p_email" class="form-label sm:w-40" style="text-align: left;">Official Email</label>
                                    <input id="p_email" name="p_email" type="email" class="form-control" placeholder="Enter Official Email" value="<?= $this->session->userdata('staff_official_email'); ?>" required>
                                </div>
                                <input type="hidden" id="staff_id" name="staff_id" value="<?= $this->session->userdata('staff_id'); ?>">
                                <div class="form-inline mt-3">
                                    <label for="p_position" class="form-label sm:w-40" style="text-align: left;">Staff Postion</label>
                                    <input id="p_position" name="p_position" type="text" class="form-control" placeholder="Enter Official Email" value="<?= $this->session->userdata('staff_position'); ?>" required>
                                </div>
                                <div class="form-inline py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <label for="p_position_title" class="form-label sm:w-40" style="text-align: left;">Staff Postion Title</label>
                                    <input id="p_position_title" name="p_position_title" type="text" class="form-control" placeholder="Enter Staff Postion Title" value="<?= $this->session->userdata('staff_position_title'); ?>" required>
                                </div>

                                <div class="text-right mt-5">
                                    <a href="javascript:;" class="btn btn-primary w-60 mr-2 mb-2" id="update"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Save Changes </a>
                                </div>

                            </div>

                            <!-- ================================================= Tab 3 start ============================================= -->
                            <div id="bootstrap" class="tab-pane" role="tabpanel" aria-labelledby="top-products-bootstrap-tab">
                                <div class="flex items-center  py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <h2 class="font-medium text-base mr-auto">
                                       Change Password
                                    </h2>
                                </div>
                                <div class="form-inline mt-3">
                                    <label for="password" class="form-label sm:w-40" style="text-align: left;">New Password</label>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="New Password" required>
                                </div>
                                <div class="form-inline py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                                    <label for="password1" class="form-label sm:w-40" style="text-align: left;">Confirm Password</label>
                                    <input id="password1" p_position_title="password1" type="password" class="form-control" placeholder="Confirm Password" required>
                                </div>
                                <div class="text-right mt-5">
                                    <button type="submit" class="btn btn-primary w-60 mr-2 mb-2" id="change"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Change Password </button>
                                </div>
                            </div>

                             <!-- ================================================= End of Tabs ============================================= -->


                        </div>
                    </div>
                </div>

                    
                </div>
            </div>
            <!-- END: Daily Sales -->
        </div>
    </div>
<!-- END: Content -->



<?php $this->load->view('admin/partials/footer.php'); ?>

<script type="text/javascript">
$("#update").click(function(){
 var staff = $('#staff_id').val();
 var p_fname = $('#p_fname').val();
 var p_mname = $('#p_mname').val();
 var p_lname = $('#p_lname').val();
 var p_div = $('#p_div').val();
 var p_email = $('#p_email').val();
 var p_position = $('#p_position').val();
 var p_position_title = $('#p_position_title').val();
 //alert(staff+' '+p_fname+' '+p_mname+' '+p_mname+' '+p_lname+' '+p_div+' '+p_email+' '+p_position+' '+p_position_title);
 $.showLoading({name: 'line-pulse', allowHide: false });
    $.ajax({
        url: "<?php echo base_url('Api_docts/profile_update/'); ?>",
        data: {staff:staff, p_fname:p_fname, p_mname:p_mname, p_lname:p_lname, p_div:p_div, p_email:p_email, p_position:p_position, p_position_title:p_position_title},
        dataType: 'JSON',
        type:"POST",
        success: function(result){
            setTimeout(function() { $.hideLoading(); }, 500);
            setTimeout(function () {
                window.location.href = "<?php echo base_url('admin/dashboard/view_profile');?>";
            myApp.hidePreloader();
            }, 3000); 
            Swal.fire(
            'SECCESSFUL',
            'Profile Information Updated Successfully!',
            'success'
            );
        }
    }); //end of ajax    
});
</script>

<script type="text/javascript">
$("#change").click(function(){
    var staff = $('#staff_id').val();
 var password = $('#password').val();
 var password1 = $('#password1').val();
 mypassword1 = password.replace(/(^\s+|\s+$)/g, "");
 mypassword2 = password1.replace(/(^\s+|\s+$)/g, "");
 $.showLoading({name: 'line-pulse', allowHide: false });
if (mypassword1 != mypassword2) { 
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password did not match: Please try again!',
    });
}else{
    $.ajax({
        url: "<?php echo base_url('Api_docts/change_pass/'); ?>",
        data: {password:password, staff:staff},
        dataType: 'JSON',
        type:"POST",
        success: function(result){
                setTimeout(function() { $.hideLoading(); }, 500);
                    setTimeout(function () {
                        window.location.href = "<?php echo base_url('admin/dashboard/view_profile');?>";
                    myApp.hidePreloader();
                    }, 3000); 
                Swal.fire(
                'SECCESSFUL',
                'Change Password Updated Successfully!',
                'success'
                );
            }
        }); //end of ajax  
    }
});
</script>
