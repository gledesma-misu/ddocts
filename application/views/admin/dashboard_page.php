<?php $this->load->view('admin/partials/header.php'); ?>

<!-- BEGIN: Content -->
<div class="content">
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Box and datatable -->
        <div class="col-span-12 xxl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: four box button -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Dashboard
                        </h2>

                        <div class="grid grid-cols-12 gap-2 mt-5">
                            
                        </div>
                        <div class="box zoom-in ml-2">
                            <div class="box p-1">
                                <div class="text-lg font-black text-gray-900 dark:text-white mb-1">Completed</div>
                                <div class="text-base font-light">
                                    <i data-feather="file-text" class="report-box__icon text-theme-10"></i>
                                    Incoming Documents - <?php echo count($incoming_doc); ?>
                                </div>
                            </div>
                        </div>
                        <div class="box zoom-in ml-2">
                            <div class="box p-1">
                                <div class="text-lg font-black text-gray-900 dark:text-white mb-1">Completed</div>
                                <div class="text-base font-light ">
                                    <i data-feather="file-text" class="report-box__icon text-theme-10"></i>
                                    Outgoing Documents - <?php echo count($outgoing_doc); ?>
                                </div>
                            </div>
                        </div>
                        <div class="box zoom-in ml-2">
                            <div class="box p-1">
                                <div class="text-lg font-black text-gray-900 dark:text-white mb-1">Pending</div>
                                <div class="text-base font-light ">
                                    <i data-feather="file-text" class="report-box__icon text-theme-10"></i>
                                    Outgoing Documents - <?php echo count($outgoing_doc); ?>
                                </div>
                            </div>
                        </div>
                        <div class="box zoom-in ml-2">
                            <div class="box p-1">
                                <div class="text-lg font-black text-gray-900 dark:text-white mb-1">Pending</div>
                                <div class="text-base font-light ">
                                    <i data-feather="file-text" class="report-box__icon text-theme-10"></i>
                                    Outgoing Documents - <?php echo count($outgoing_doc); ?>
                                </div>
                            </div>
                        </div>
                        <a href="<?= base_url('admin/dashboard'); ?>" class="ml-auto flex items-center text-theme-1 dark:text-theme-10"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <!-- <div class="sm:col-span-6 xl:col-span-2 intro-y" >
                            <div class="box zoom-in">
                                <div class="box p-2">
                                    <i data-feather="file-text" class="report-box__icon text-theme-10"></i>
                                    <div class="text-base font-light">Incoming Documents - <?php echo count($incoming_doc); ?></div>
                                </div>
                            </div>
                            <div class="box zoom-in mt-3">
                                <div class="box p-2">
                                    <i data-feather="file-text" class="report-box__icon text-theme-10"></i>
                                    <div class="text-base font-light ">Outgoing Documents - <?php echo count($outgoing_doc); ?></div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <a href="<?= base_url('admin/documents'); ?>">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="file-text" class="report-box__icon text-theme-10"></i>
                                        </div>
                                        <div class="text-2xl font-light leading-8 mt-6">Create new record</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <a href="<?= base_url('admin/documents/incoming'); ?>">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="log-in" class="report-box__icon text-theme-10"></i>
                                        </div>
                                        <div class="text-2xl font-light leading-8 mt-6">For Action</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <a href="<?= base_url('admin/documents/outgoing'); ?>">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="log-out" class="report-box__icon text-theme-10"></i>
                                        </div>
                                        <div class="text-2xl font-light leading-8 mt-6">Completed</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <a href="<?= base_url('admin/documents/search'); ?>">
                                    <div class="box p-5">
                                        <div class="flex">
                                            <i data-feather="search" class="report-box__icon text-theme-10"></i>
                                        </div>
                                        <div class="text-2xl font-light leading-8 mt-6">search</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END: four box button -->

                <!-- BEGIN: Data Table -->
                <div class="col-span-12 mt-6 box p-5 mt-5">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Pending Documents
                        </h2>
                    </div>
                    <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                        <table id="zero_config" class="table table-report sm:mt-2">
                            <thead>
                                <tr>
                                    <th class="text-center whitespace-nowrap">Document No.</th>
                                    <th class="whitespace-nowrap">Type of Document</th>
                                    <th class="text-center whitespace-nowrap">Document Title</th>
                                    <th class="text-center whitespace-nowrap">Source</th>
                                    <th class="text-center whitespace-nowrap">Routed To</th>
                                    <th class="text-center whitespace-nowrap">Concerned Staff</th>
                                    <th class="text-center whitespace-nowrap">Date Sent</th>
                                    <th class="text-center whitespace-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (is_array($staff_details) && (count($staff_details)))
                                    foreach ($staff_details as $staff_details) : ?>
                                    <?php if ($staff_details['dd_recieved_doc'] == 0 && $staff_details['dd_disregard_doc'] == 0) : ?>

                                        <tr class="intro-x">
                                            <td class="text-center"> <?php echo $staff_details['dd_doc_id_code']; ?> </td>
                                            <td class="text-center">
                                                <?php if ($staff_details['dd_doct_type'] == 0) : ?>
                                                    Multiple
                                                <?php else : ?>
                                                    <?php echo $staff_details['dt_name']; ?>
                                                <?php endif ?>

                                            </td>
                                            <td class="w-40"><a href="javascript:;" data-toggle="modal" data-target="#View<?php echo $staff_details['dd_id']; ?>">
                                                    <div class="flex items-center justify-center text-theme-9"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> <?php echo $staff_details['dd_title']; ?> </div>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <?php $dd_action_taken_id = $staff_details['dd_source']; ?>

                                                <?php
                                                $dd_action_id = explode(", ", $dd_action_taken_id);
                                                //print_r($dd_action_id);
                                                $dd_action_name = '';
                                                foreach ($dd_action_id as $mysource) {
                                                    $this->load->model('Model_dashboard', 'dashboard');
                                                    $data = $this->dashboard->mysources($mysource);
                                                    $dd_action_name .= $data['ds_code'] . ', ';
                                                    $dd_name =  substr($dd_action_name, 0, -2);
                                                }
                                                echo $dd_name;
                                                ?>

                                            </td>
                                            <td class="text-center"><?php echo $staff_details['dd_view_doc']; ?></td>
                                            <td class="text-center"><?php echo $staff_details['dd_staff_name']; ?></td>
                                            <td class="text-center"><?php $date = $staff_details['dd_date_recieved'];
                                                                    $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                                <?php echo $datepicker; ?></td>
                                            <td class="table-report__action w-56">

                                                <div class="flex justify-center items-center">
                                                    <?php if ($staff_details['dd_encoded_doc'] != $this->session->userdata('staff_id')) :
                                                    ?><a class="btn btn-sm btn-outline-primary w-24 inline-block" href="javascript:;" data-toggle="modal" data-target="#Recieve<?php echo $staff_details['dd_id']; ?>"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Receive </a>
                                                        &nbsp; | &nbsp;
                                                    <?php endif ?>
                                                    <a class="btn btn-sm btn-outline-danger w-24 inline-block" href="javascript:;" data-toggle="modal" data-target="#Disregard<?php echo $staff_details['dd_id']; ?>"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Disregard </a>

                                                    <div class="preview">
                                                        <!-- BEGIN: Modal Content -->
                                                        <div id="Disregard<?php echo $staff_details['dd_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <?php echo form_open('admin/Dashboard/disregard_doc'); ?>
                                                                    <input type="hidden" name="get_id" value="<?php echo $staff_details['dd_id']; ?>">
                                                                    <input type="hidden" name="get_name" value="<?php echo $staff_details['dd_doc_id_code']; ?>">
                                                                    <!-- BEGIN: Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h2 class="font-medium text-base mr-auto">
                                                                            Disregard Document
                                                                        </h2>
                                                                    </div>
                                                                    <!-- END: Modal Header -->
                                                                    <!-- BEGIN: Modal Body -->
                                                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                                                                        <?php
                                                                        $source = $this->dashboard->mysources($this->session->userdata('staff_division'));

                                                                        $my_disvision = $source['ds_name'];
                                                                        $my_div = $source['ds_code'];
                                                                        ?>
                                                                        <div class="col-span-12 sm:col-span-12">
                                                                            <label for="get_my_staff" class="form-label"> Staff Name </label>
                                                                            <input type="text" class="form-control" value="<?= $this->session->userdata('staff_fname'); ?> <?= $this->session->userdata('staff_lname'); ?>" disabled>
                                                                        </div>
                                                                        <div class="col-span-12 sm:col-span-12">
                                                                            <label for="get_my_division" class="form-label"> Division </label>
                                                                            <input type="text" class="form-control" value="<?php echo $my_disvision; ?>" id="get_my_division" name="get_my_division" disabled>
                                                                        </div>
                                                                        <div class="col-span-12 sm:col-span-12">
                                                                            <label for="editor1" class="form-label"> Notes / Remarks </label>
                                                                            <textarea placeholder="Enter Notes / Remarks" id="editor1" name="editor1" class="form-control" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <!-- END: Modal Body -->
                                                                    <!-- BEGIN: Modal Footer -->

                                                                    <div class="modal-footer text-right">
                                                                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-25"> <i data-feather="x" class="w-4 h-4"></i> &nbsp; Cancel</button>
                                                                        <button type="submit" class="btn btn-danger w-25"> <i data-feather="activity" class="w-4 h-4"></i> &nbsp; Disregard </button>
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

                                    <?php endif ?>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center whitespace-nowrap">Document No.</th>
                                    <th class="whitespace-nowrap">Type of Document</th>
                                    <th class="text-center whitespace-nowrap">Document Title</th>
                                    <th class="text-center whitespace-nowrap">Source</th>
                                    <th class="text-center whitespace-nowrap">Routed To</th>
                                    <th class="text-center whitespace-nowrap">Concerned Staff</th>
                                    <th class="text-center whitespace-nowrap">Date Sent</th>
                                    <th class="text-center whitespace-nowrap">Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- END: Data Table -->

            </div>
        </div>
        <!-- END: Box and datatable -->

        <!-- BEGIN: Side Panel -->
        <div class="col-span-12 xxl:col-span-3">
            <div class="xxl:border-l border-theme-5 -mb-10 pb-10">
                <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                    <!-- BEGIN: New Document Received -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                New Document Received
                            </h2>
                        </div>
                        <div class="mt-5">
                            <?php foreach ($limit_docs as $limit_doc) : ?>
                                <?php if ($limit_doc['dd_recieved_doc'] == 0 && $limit_doc['dd_disregard_doc'] == 0) : ?>
                                    <a href="javascript:;" data-toggle="modal" data-target="#View<?php echo $limit_doc['dd_id']; ?>">
                                        <div class="intro-x">
                                            <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                    <img alt="Rubick Tailwind HTML Admin Template" src="<?php echo base_url('assets/template/images/doc_icon.png'); ?>">
                                                </div>
                                                <div class="ml-4 mr-auto">
                                                    <div class="font-medium">
                                                        <?php foreach ($staffs as $staff) : ?>
                                                            <?php if ($limit_doc['dd_encoded_doc'] == $staff['staff_id']) : ?>
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
                                        </div>
                                    </a>
                                <?php endif ?>
                            <?php endforeach; ?>
                            <a href="<?= base_url('admin/documents/viewMore'); ?>" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600 tooltip" title="View All Document Received!">View More</a>
                        </div>
                    </div>
                    <!-- END: New Document Received -->

                    <!------------------------------------------------------------------------------>

                    <!-- BEGIN: Recent Activities -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Recent Activities
                            </h2>
                            <a href="<?= base_url('admin/dashboard/view_all_history'); ?>" class="ml-auto text-theme-1 dark:text-theme-10 truncate tooltip" title="View All Recent Activities!">Show More</a>
                        </div>
                        <div class="report-timeline mt-5 relative">
                            <?php foreach ($get_my_historys as $get_my_history) : ?>
                                <div class="intro-x relative flex items-center mb-3">
                                    <div class="report-timeline__image">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img alt="Rubick Tailwind HTML Admin Template" src="<?php echo base_url('assets/template/images/history.png'); ?>">
                                        </div>
                                    </div>
                                    <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                        <div class="flex items-center">
                                            <div class="font-medium">
                                                <?php foreach ($staffs as $staff) : ?>
                                                    <?php if ($get_my_history['dh_doc_id'] == $staff['staff_id']) : ?>
                                                        <?php echo $staff['fname']; ?> <?php echo $staff['lname']; ?>
                                                    <?php endif ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="text-xs text-gray-500 ml-auto">
                                                <?php
                                                $post = $get_my_history['dh_reg_date'];
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
                                        <div class="text-gray-600 mt-1"><?php echo $get_my_history['dh_action']; ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- END: Recent Activities -->

                    <!-- BEGIN: Disregard documents -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Disregard Documents
                            </h2>
                            <i data-feather="help-circle" class="report-box__icon text-theme-10 tooltip" title="Note (Document will remove after 2 days)"></i>
                        </div>
                        <div class="report-timeline mt-5 relative">
                            <?php foreach ($limit_docs as $limit_doc) : ?>
                                <?php date_default_timezone_set('Asia/Manila');
                                $date_now = $limit_doc['dd_date_encoded'];
                                $date_end = date('Y-m-d', strtotime($date_now . ' + 2 day')) . ' ' . date('H:i:s', time());
                                ?>
                                <?php if ($limit_doc['dd_disregard_doc'] == 1) : ?>
                                    <div class="intro-x relative flex items-center mb-3">
                                        <div class="report-timeline__image">
                                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                <img alt="Rubick Tailwind HTML Admin Template" src="<?php echo base_url('assets/template/images/doc_icon.png'); ?>">
                                            </div>
                                        </div>
                                        <a href="javascript:;" data-toggle="modal" data-target="#R_disregard<?php echo $limit_doc['dd_id']; ?>">
                                            <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                                <div class="flex items-center">
                                                    <div class="font-medium">
                                                        <?php foreach ($staffs as $staff) : ?>
                                                            <?php if ($limit_doc['dd_encoded_doc'] == $staff['staff_id']) : ?>
                                                                <?php echo $staff['fname']; ?> <?php echo $staff['lname']; ?>
                                                            <?php endif ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div class="text-xs text-gray-500 ml-auto">
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
                                                <div class="text-gray-600 mt-1"><?php echo $limit_doc['dd_disregard_note']; ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- END: New Disregard documents -->
                </div>
            </div>
        </div>
        <!-- End: Side Panel -->
    </div>
</div>
<!-- END: Content -->

<!-- Message document details -->
<?php foreach ($get_id_staffs as $get_id_staff) : ?>

    <?php date_default_timezone_set('Asia/Manila');
    $date_now = $get_id_staff['dd_date_encoded'];
    $date_end = date('Y-m-d', strtotime($date_now . ' + 1 day')) . ' ' . date('H:i:s', time());
    ?>

    <?php if ($get_id_staff['dd_recieved_doc'] == 0 && $get_id_staff['dd_disregard_doc'] == 0 && $date_end >= $this->session->userdata('last_login')) : ?>
        <div class="text-center">
            <!-- BEGIN: Notification Content -->
            <div id="success-notification-content" class="toastify-content hidden flex">
                <i class="text-theme-9" data-feather="file-text"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Hi! <?php echo $this->session->userdata('staff_fname') ?> <?php echo $this->session->userdata('staff_lname') ?></div>
                    <div class="text-gray-600 mt-1">New Document receive!</div>
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
<!--End Message document details -->

<!-- view document details -->
<?php foreach ($get_id_staffs as $get_id_staff) : ?>
    <div id="View<?php echo $get_id_staff['dd_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Document Details
                    </h2>
                </div>
                <!-- END: Modal Header -->
                <!-- BEGIN: Modal Body -->
                <div class="modal-body">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            <?php echo $get_id_staff['dd_title']; ?>
                        </h2>
                    </div>
                    <div class="intro-y overflow-auto lg:overflow-visible sm:mt-0">
                        <table class="table table-report">
                            <tbody>
                                <tr class="intro-x">
                                    <td class="text-left"> Type of Document </td>
                                    <td class="text-left"><?php if ($get_id_staff['dd_doct_type'] == 0) : ?>
                                            <?php $dd_docbundle = $get_id_staff['dd_bundleDocs']; ?>
                                            <?php
                                                                $dd_docbundle_get = explode(", ", $dd_docbundle);
                                                                //print_r($dd_action_id);
                                                                $dd_docbundle_g = '';
                                                                foreach ($dd_docbundle_get as $dd_docbundle_ge) {
                                                                    $this->load->model('Model_dashboard', 'dashboard');
                                                                    $data = $this->dashboard->get_bundle($dd_docbundle_ge);
                                                                    $dd_docbundle_g .= $data['dt_name'] . ', ';
                                                                    $dd_doc =  substr($dd_docbundle_g, 0, -2);
                                                                }
                                                                echo "<b>" . $dd_doc . "</b>";
                                            ?>
                                        <?php else : ?>
                                            <?php echo $get_id_staff['dt_name']; ?>
                                        <?php endif ?>
                                    </td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="text-left"> Source Document </td>
                                    <td class="text-left">
                                        <?php $dd_action_taken_id = $get_id_staff['dd_source']; ?>

                                        <?php
                                        $dd_action_id = explode(", ", $dd_action_taken_id);
                                        //print_r($dd_action_id);
                                        $dd_action_name = '';
                                        foreach ($dd_action_id as $mysource) {
                                            $this->load->model('Model_dashboard', 'dashboard');
                                            $data = $this->dashboard->mysources($mysource);
                                            $dd_action_name .= $data['ds_code'] . ', ';
                                            $dd_name =  substr($dd_action_name, 0, -2);
                                        }
                                        echo $dd_name;
                                        ?>
                                    </td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="text-left"> Required Action </td>
                                    <td class="text-left">
                                        <?php $dd_action = $get_id_staff['dd_action_taken']; ?>
                                        <?php
                                        $action_id = explode(", ", $dd_action);
                                        //print_r($dd_action_id);
                                        $action_name = '';
                                        foreach ($action_id as $myaction) {
                                            $this->load->model('Model_dashboard', 'dashboard');
                                            $data = $this->dashboard->get_action($myaction);
                                            $action_name .= $data['da_name'] . ', ';
                                            $action_status =  substr($action_name, 0, -2);
                                        }
                                        echo $action_status;
                                        ?>

                                    </td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="text-left"> Document Received Date </td>
                                    <td class="text-left"> <?php $date = $get_id_staff['dd_date_encoded'];
                                                            $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                        <?php echo $datepicker; ?> </td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="text-left"> Routed From </td>
                                    <td class="text-left"> <?php echo $staff_details['dd_view_doc']; ?></td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="text-left"> Date Routed </td>
                                    <td class="text-left"> <?php $date = $get_id_staff['dd_date_encoded'];
                                                            $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                        <?php echo $datepicker; ?> </td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="text-left"> Concern Staff </td>
                                    <td class="text-left"> <?php echo $get_id_staff['dd_staff_name']; ?> </td>
                                </tr>
                                <tr class="intro-x">
                                    <td class="text-left"> Notes/Remarks </td>
                                    <td class="text-left"> <b><?php echo $get_id_staff['dd_note']; ?></b> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END: Modal Body -->
                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer text-right">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary w-30 mr-2 mb-2"> <i data-feather="x" class="w-4 h-4 mr-2"></i> Close </button>| &nbsp;
                    <?php if ($get_id_staff['dd_encoded_doc'] != $this->session->userdata('staff_id')) : ?>
                        <a href="javascript:;" data-toggle="modal" data-target="#Recieve<?php echo $get_id_staff['dd_id']; ?>" class="btn btn-primary w-30 mr-2 mb-2"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Receive </a>|
                    <?php endif; ?>
                    &nbsp;<a href="javascript:;" data-toggle="modal" data-target="#Disregard<?php echo $get_id_staff['dd_id']; ?>" class="btn btn-danger w-30 mr-2 mb-2"> <i data-feather="trash-2" class="w-4 h-4 mr-2"></i> Disregard </a>
                </div>
                <!-- END: Modal Footer -->
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- END: view document details -->

<!--  Modal Recieve -->
<?php foreach ($get_id_staffs as $get_id_staff) : ?>
    <div id="Recieve<?php echo $get_id_staff['dd_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open('admin/Dashboard/recieve_doc'); ?>
                <input type="hidden" name="get_id" value="<?php echo $get_id_staff['dd_id']; ?>">
                <input type="hidden" name="get_name" value="<?php echo $get_id_staff['dd_doc_id_code']; ?>">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-feather="help-circle" class="w-16 h-16 text-theme-10 mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-gray-600 mt-2">
                            Do you want to Receive this document?
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-primary w-40">Yes, Receive it!</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Modal Recieve -->

<!--  Modal UnDisregard -->
<?php foreach ($get_id_staffs as $get_id_staff) : ?>
    <div id="R_disregard<?php echo $get_id_staff['dd_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open('admin/Dashboard/remove_disregard'); ?>
                <input type="hidden" name="get_id" value="<?php echo $get_id_staff['dd_id']; ?>">
                <input type="hidden" name="get_name" value="<?php echo $get_id_staff['dd_doc_id_code']; ?>">
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-feather="help-circle" class="w-16 h-16 text-theme-10 mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-gray-600 mt-2">
                            Do you want to remove this document on the disregard list?
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                        <button type="submit" class="btn btn-primary w-40">Yes, Remove to disregard!</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- End Modal UnDisregard -->



<?php $this->load->view('admin/partials/footer.php'); ?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#zero_config').DataTable({
            columnDefs: [{
                type: 'date',
                'targets': [5]
            }],
            order: [
                [5, 'desc']
            ],
        });
    });
</script>

<!-- successful Recieve the document -->
<?php if ($this->session->flashdata('sucs_doc')) : ?>
    <script type="text/javascript">
        Swal.fire({
            title: 'SUCCESSFUL!',
            text: "Do you want to view the document datails?",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, view it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('admin/documents/viewDoc/' . $this->session->flashdata('sucs_doc')); ?>";
            }
        });
    </script>
<?php endif; ?>

<!-- successful desregard the document -->
<?php if ($this->session->flashdata('disregard_suc')) : ?>
    <script type="text/javascript">
        Swal.fire(
            'SUCCESSFUL!',
            '<?php echo $this->session->flashdata('disregard_suc') ?>',
            'success'
        );
    </script>
<?php endif; ?>

<!-- successful desregard the document -->
<?php if ($this->session->flashdata('remove_dis')) : ?>
    <script type="text/javascript">
        Swal.fire(
            'SUCCESSFUL!',
            '<?php echo $this->session->flashdata('remove_dis') ?>',
            'success'
        );
    </script>
<?php endif; ?>

<!-- successful first login -->
<?php if ($this->session->flashdata('message') == 1) : ?>
    <script type="text/javascript">
        $(document).ready(function() {
            var name = '<?php echo $this->session->userdata('staff_fname') ?> <?php echo $this->session->userdata('staff_lname') ?>';

            Swal.fire(
                'SUCCESSFUL',
                'Welcome ' + name + ' this is CWC-DocTS version 1.0.1',
                'success'
            )
        });
    </script>
<?php endif ?>

<script type="text/javascript">
    jQuery(function() {
        jQuery('#success-notification-toggle').click();
    });
</script>