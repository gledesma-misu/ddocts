<?php $this->load->view('admin/partials/header.php'); ?>


<!-- BEGIN: Content -->
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                View All Notification
            </h2>
        </div>

        <!-- BEGIN: Notification -->
            <div class="intro-y box p-5 mt-5">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        All Notification
                    </h2>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <?php foreach($all_notifs as $all_notif): ?>
                    <div class="alert alert-secondary show mb-2" role="alert">
                        <div class="flex items-center">
                            <div class="font-medium text-lg">Name : <?php echo $all_notif['added_by']; ?></div>
                            <div class="text-xs bg-gray-600 px-1 rounded-md text-white ml-auto">
                                <?php 
                                    $post = $all_notif['reg_date'];
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
                        <div class="mt-3">Action : <?php echo $all_notif['action_message']; ?></div>
                    </div>
                <?php endforeach; ?>
                </div>
                
            </div>
        <!-- END: Notification  -->
    </div>
<!-- END: Content -->



<?php $this->load->view('admin/partials/footer.php'); ?>