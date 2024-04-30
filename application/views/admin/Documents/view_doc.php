<?php $this->load->view('admin/partials/header.php'); ?>

<!-- BEGIN: Content -->
        <div class="content">
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    DOCUMENT DETAILS 
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Profile Menu -->
                <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
                    <div class="intro-y box mt-5">
                        <div class="relative flex items-center p-5">
                            <div class="w-12 h-12 image-fit">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="<?php echo base_url('assets/template/images/doc_icon.png'); ?>">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium text-base">Document ID</div>
                                <div class="text-gray-600"> <b><?php echo $doc_details['dd_doc_id_code']; ?></b> </div>
                            </div>
                            <div >
                               <!--  dropdown -->
                                  <div class="dropdown"> 
                                  <?php if ($doc_details['dd_status'] == "4") : ?> 
                                    <div class="alert alert-success show flex items-center mb-2" role="alert"> <i data-feather="thumbs-up" class="w-6 h-6 mr-2"></i> Completed </div>
                                  <?php else: ?>
                                    <button class="dropdown-toggle btn btn-primary tooltip" title="Select Action!" aria-expanded="false">Action Button</button>
                                     <div class="dropdown-menu w-56"> 
                                        <div class="dropdown-menu__content box dark:bg-dark-1"> <div class="p-4 border-b border-gray-200 dark:border-dark-5 font-medium">Please Select Action</div> 
                                            <div class="p-2">  
                                            <?php if ($doc_details['dd_encoded_doc'] == $this->session->userdata('staff_id')): ?>
                                                <a href="javascript:;" data-toggle="modal" data-target="#Upload_file" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-plus" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> Upload File </a>
                                            <?php else: ?>
                                                <a href="javascript:;" data-toggle="modal" data-target="#Document_Action" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="activity" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> Route </a> 
                                                <a href="javascript:;" data-toggle="modal" data-target="#Doc_Complate" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="thumbs-up" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> Complete </a> 
                                                <a href="javascript:;" data-toggle="modal" data-target="#Upload_file" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-plus" class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"></i> Upload File </a>
                                            <?php endif ?>
                                            </div> 
                                        </div> 
                                    </div> 
                                  <?php endif ?>
                                 </div> 
                                 <!-- end dropdown -->
                            </div>
                        </div>

                        <div class="p-5 border-t border-gray-200 dark:border-dark-5">
                            <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                                    <div>
                                        <div class="text-gray-600">Document title </div>
                                        <div class="mt-1"> 
                                            <b><?php echo $doc_details['dd_title']; ?> </b>
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Type of Document </div>
                                        <div class="mt-1"> 
                                            <?php if ($doc_details['dd_doct_type'] == 0): ?>
                                                <?php $dd_docbundle = $doc_details['dd_bundleDocs']; ?>
                                               <?php 
                                                   $dd_docbundle_get = explode(", ", $dd_docbundle);
                                                   //print_r($dd_action_id);
                                                   $dd_docbundle_g = '';
                                                   foreach($dd_docbundle_get as $dd_docbundle_ge){
                                                       $this->load->model('Model_dts', 'dts');
                                                       $data = $this->dts->get_bundle($dd_docbundle_ge);
                                                       $dd_docbundle_g .= $data['dt_name'] . ', ';
                                                       $dd_doc =  substr($dd_docbundle_g, 0, -2);
                                                   }
                                                   echo "<b>".$dd_doc."</b>";
                                                ?>
                                            <?php else: ?>
                                                <?php echo $doc_details['dt_name']; ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Document Source </div>
                                        <div class="mt-1"> <?php
                                            $dd_action_taken_id = $doc_details['dd_source'];

                                             $dd_action_id = explode(", ", $dd_action_taken_id);
                                             //print_r($dd_action_id);
                                             $dd_action_name = '';
                                                 foreach($dd_action_id as $mysource){
                                                     $this->load->model('Model_dts', 'dts');
                                                     $data = $this->dts->mysources($mysource);
                                                     $dd_action_name .= $data['ds_code'] . ', ';
                                                     $dd_name =  substr($dd_action_name, 0, -2);
                                                 }
                                            echo $dd_name;
                                         ?> </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Document Routed to </div>
                                        <div class="mt-1"> <b><?php echo $doc_details['dd_view_doc']; ?></b> </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Action Taken </div>
                                        <div class="mt-1"> <?php 
                                            $dd_action_taken_id = $doc_details['dd_action_taken']; 

                                               $dd_action_id = explode(", ", $dd_action_taken_id);
                                               //print_r($dd_action_id);
                                               $dd_action_name = '';
                                               foreach($dd_action_id as $dd_action){
                                                   $this->load->model('Model_dts', 'dts');
                                                   $data = $this->dts->get_action($dd_action);
                                                   $dd_action_name .= $data['da_name'] . ', ';
                                                   $dd_name =  substr($dd_action_name, 0, -2);
                                               }
                                               echo "<b>".$dd_name."</b>";
                                        ?> </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600"> Document Recived Date </div>
                                        <div class="mt-1"> 
                                            <?php
                                            $date = $doc_details['dd_date_encoded'];  
                                            $datepicker = date("M-d-Y h:i A", strtotime($date));
                                            echo $datepicker;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="intro-x flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
                                    <div>
                                        <div class="text-gray-600">  Concern Staff </div>
                                        <div class="mt-1"> <b><?php echo $doc_details['dd_staff_name']; ?></b> </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <table class="table table-report">
                        <tbody>
                             <tr class="intro-x">
                                <td class="text-left"> <b>Status</b> </td>  
                                <td class="text-left"> <div class="box zoom-in">
                                    <?php switch ($doc_details['dd_status']){
                                    case 0:
                                        echo '<div class="alert alert-danger-soft show flex items-center mb-2 tooltip" title="This document is For Recieving!"" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> For Recieving </div>';
                                    break;
                                    case 1:
                                        echo '<div class="alert alert-danger-soft show flex items-center mb-2 tooltip" title="This document is Pending!"" role="alert"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> Pending </div>';
                                    break;
                                    case 2:
                                        echo '<div class="alert alert-warning-soft show flex items-center mb-2 tooltip" title="This document is On Process!" role="alert"> <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i>  On Process </div>';
                                    break;
                                    case 3:
                                        echo '<div class="alert alert-primary show flex items-center mb-2 tooltip" title="This document is Re Process!"" role="alert"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> Re-process </div>';
                                    break;
                                    case 4:
                                        echo '<div class="alert alert-success show flex items-center mb-2 tooltip" title="This document is Completed!"" role="alert"> <i data-feather="thumbs-up" class="w-6 h-6 mr-2"></i> Completed (Released doc.)</div>';
                                    break;
                                    default:
                                        echo "ERROR";
                                    break;  
                                  }?>
                                </div></td> 
                            </tr>
                        </tbody>
                    </table>

                    <h2 class="intro-y text-lg font-medium mr-auto mt-2">
                        File Uploaded
                    </h2>
                <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-3">

                    <?php $test = $v_words."/".$get_imgs; 
                    ?>   
                    <?php $i = 0;                       
                        if ($doc_details['dd_filename'] == '|No Uploaded Files!|') : 
                         echo '<div class="intro-y col-span-6 sm:col-span-4 md:col-span-6 xxl:col-span-3">
                                 <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                    <a href="#" class="w-3/5 file__icon file__icon--file mx-auto tooltip" title="No file found!">
                                        <div class="file__icon__file-name"><?php echo $ext; ?></div>
                                    </a>
                                     <a href="#" class="block font-medium mt-4 text-center truncate">No Files Uploaded</a> 
                                 </div>
                             </div>';
                         else : 
                         $array = substr($doc_details['dd_filename'], 1, -1);   
                         $files_array1 = explode('||',$array); 
                         foreach($files_array1 as $key) : ?>
                        <?php $ext = pathinfo($key, PATHINFO_EXTENSION); 
                        $link = $divfold."/".$key;
                        ?>
                        
                        <div class="intro-y col-span-6 sm:col-span-4 md:col-span-6 xxl:col-span-3">
                            <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                <a href="<?= base_url('assets/upload'."/".$v_words."/".$link); ?>" target="_blank" class="w-3/5 file__icon file__icon--file mx-auto tooltip" title="View this file!">
                                    <div class="file__icon__file-name"><?php echo $ext; ?></div>
                                </a>
                                <a href="" class="block font-medium mt-4 text-center truncate"><?php echo $key; ?></a> 
                                <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-600 tooltip" title="Select Action!"></i> </a>
                                    <div class="dropdown-menu w-40">
                                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                            <a href="<?= base_url('admin/documents/delete_file_attachment/'.$key."/".$doc_details['dd_id']); ?>" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </a>
                                            <a href="<?= base_url('assets/upload'."/".$test."/".$key); ?>" download class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="folder-plus" class="w-4 h-4 mr-2"></i> download </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                        <?php endif; ?>

                </div>

                </div>
                <!-- END: Profile Menu -->
                <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                    <!-- BEGIN: Display Information -->
                    <div class="intro-y box lg:mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Document Transaction Flow
                            </h2>
                        </div>
                        <div class="p-5">
                            <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                            	<div class="report-timeline mt-9 relative">
                                <?php if (empty($doc_reply)): ?>
                                    <div class="box ">
                                        <div class="border-l-2 border-theme-6 pl-4 text-gray-600 mt-2">
                                                <div class="alert alert-secondary show mb-2" role="alert">
                                                    <div class="flex items-center">
                                                        <div class="font-small text-lg">No Conversion and Action found!</div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php foreach($doc_reply as $doc_reply): ?>
                                    <div class="report-timeline mt-9 relative">
                                        <div class="intro-x relative flex items-center mb-3">
                                            <div class="report-timeline__image">
                                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                <?php switch ($doc_reply['doc_current_status']){
                                                    case 1:
                                                        $test = "assets/template/images/doc_icon_pending.png";
                                                    break;
                                                    case 2:
                                                        $test = "assets/template/images/doc_icon.png";
                                                    break;
                                                    case 3:
                                                        $test = "assets/template/images/doc_icon_blue.png";
                                                    break;
                                                    case 4:
                                                        $test = "assets/template/images/doc_icon_complate.png";
                                                    break;
                                                    default:
                                                    echo "ERROR";
                                                    break;  
                                                }?>
                                                    <img alt="Rubick Tailwind HTML Admin Template" src="<?php echo base_url($test); ?>">
                                                </div>
                                            </div>

                                            <!--=============== Forech for comment and action ========================================== -->
                                            <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                                <div class="flex items-center">
                                                    <div class="font-medium">
                                                    <?php if ($doc_reply['doc_affiliated'] == "1") : ?>
                                                        <a href="#" class='text-theme-10'>Replied by </a> 
                                                            <?php foreach($staffs as $staff): ?>
                                                                <?php if ($doc_reply['staff_name'] == $staff['staff_id']): ?>
                                                                <?php switch ($staff['division']){
                                                                    case 2:
                                                                        echo "Policy Planning and Research Division";
                                                                    break;
                                                                    case 3:
                                                                        echo "Localization and Institutionalization Division";
                                                                    break;
                                                                    case 4:
                                                                        echo "Management Information System Unit";
                                                                    break;
                                                                    case 5:
                                                                        echo "Administrative and Finance Division";
                                                                    break;
                                                                    case 6:
                                                                        echo "Public Affairs and Information Office";
                                                                    break;
                                                                    case 9:
                                                                        echo "Office of the Executive Director";
                                                                    break;
                                                                    default: 
                                                                        echo "ERROR";
                                                                    break;  
                                                                }?>
                                                                <?php endif ?>
                                                            <?php endforeach; ?>
                                                    <?php elseif ($doc_reply['doc_affiliated'] == "0") : ?>
                                                        Replied by Office of the Executive Director
                                                    <?php elseif ($doc_reply['doc_affiliated'] == "2") : ?>
                                                        <a href="#" class='text-theme-10'>Document Action Report</a> 
                                                        <?php if ($doc_details['dd_dispatch_doc'] == '1'): ?>
                                                          / Download Dispatch File <a href="<?= base_url('assets/template/images/Delivery.pdf'); ?>" download class="text-theme-10 tooltip" title="Click me to download!"> HERE </a> 
                                                        <?php endif ?>
                                                        <br>
                                                        <?php $taken_id = $doc_reply['doc_current_action']; 
                                                        $dd_action_id = explode(", ", $taken_id);
                                                        $dd_action_name = '';
                                                        foreach($dd_action_id as $dd_action){
                                                            $data = $this->dts->get_action($dd_action);
                                                            $dd_action_name .= $data['da_name'] . ', ';
                                                            $action_name =  substr($dd_action_name, 0, -2);
                                                        }
                                                        echo $action_name;
                                                        ?>
                                                    <?php endif ?>
                                                    </div>
                                                    <div class="text-xs text-gray-500 ml-auto"> 
                                                    <?php switch ($doc_reply['doc_current_status']){
                                                        case 1:
                                                        echo '<span class="px-3 py-2 report-box__icon text-theme-6"><i data-feather="alert-triangle" class="report-box__icon text-theme-6"></i>  Pending </span>';
                                                        $text_theme = '6';
                                                        break;
                                                        case 2:
                                                        echo '<span class="px-3 py-2 report-box__icon text-theme-12"><i data-feather="alert-triangle" class="report-box__icon text-theme-12"></i>  On Process </span>';
                                                        $text_theme = '12';
                                                        break;
                                                        case 3:
                                                        echo '<span class="px-3 py-2 report-box__icon text-theme-10"><i data-feather="alert-triangle" class="report-box__icon text-theme-10"></i>  Re-Process </span>';
                                                        $text_theme = '1';
                                                        break;
                                                        case 4:
                                                        echo '<span class="px-3 py-2 report-box__icon text-theme-9"><i data-feather="alert-triangle" class="report-box__icon text-theme-9"></i> This document was released. (Completed) </span>';
                                                        $text_theme = '9';
                                                        break;
                                                        default:
                                                        echo "ERROR";
                                                        break;  
                                                    }?>
                                                    <i data-feather="clock" class="report-box__icon text-theme-7"></i>
                                                    <?php 
                                                        $post = $doc_reply['comment_date'];
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
                                                <a href="javascript:;" data-toggle="modal" data-target="#Action_Message<?php echo $doc_reply['id']; ?>" class="tooltip" title="View this conversion!">
                                                    <?php if ($doc_reply['doc_affiliated'] == "1" || $doc_reply['doc_affiliated'] == "0" ) : ?>
                                                    <div class="border-l-2 border-theme-<?php echo $text_theme; ?> pl-4 text-gray-600 mt-2">
                                                            <div class="alert alert-secondary show mb-2" role="alert">
                                                                <div class="flex items-center">
                                                                    <div class="font-small text-lg"><?php echo $doc_reply['reply']; ?></div>
                                                                </div>
                                                                <div class="mt-3">
                                                                <?php foreach($staffs as $staff): ?>
                                                                    <?php if ($doc_reply['staff_name'] == $staff['staff_id']): ?>
                                                                        - commented by&nbsp;<i><?php echo $staff['fname']; ?>  <?php echo $staff['lname']; ?> </i>
                                                                        <?php if ($doc_reply['doc_current_file'] == ''): ?>

                                                                        <?php else: ?>
                                                                        <span class='text-theme-10'>| with uploaded files </span> 
                                                                        <?php endif ?>
                                                                    <?php endif ?>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <?php elseif ($doc_reply['doc_affiliated'] == "2") : ?>
                                                        <?php if ($doc_reply['doc_current_status'] == "2" || $doc_reply['doc_current_status'] == "3" ) : ?>
                                                            <div class="border-l-2 border-theme-<?php echo $text_theme; ?> pl-4 text-gray-600 mt-2">
                                                            <div class="alert alert-secondary show mb-2" role="alert">
                                                                <div class="flex items-center">
                                                                    <div class="font-small text-lg"><?php $taken_id = $doc_reply['doc_current_action']; 
                                                                        $dd_action_id = explode(", ", $taken_id);
                                                                        $dd_action_name = '';
                                                                        foreach($dd_action_id as $dd_action){
                                                                            $data = $this->dts->get_action($dd_action);
                                                                            $dd_action_name .= $data['da_name'] . ', ';
                                                                            $action_name =  substr($dd_action_name, 0, -2);
                                                                        }
                                                                        echo $action_name;
                                                                    ?></div>
                                                                </div>
                                                                <div class="mt-3"><?php echo $doc_reply['reply']; ?></div>
                                                            </div>
                                                            </div>
                                                        <?php elseif ($doc_reply['doc_current_status'] == "4") : ?>
                                                            <div class="border-l-2 border-theme-<?php echo $text_theme; ?> pl-4 text-gray-600 mt-2">
                                                                <div class="alert alert-success show mb-2" role="alert">
                                                                    <div class="flex items-center">
                                                                        <div class="font-medium text-lg">The document process is now completed</div>
                                                                    </div>
                                                                    <div class="mt-3">End process. <em style="font-size: 12px;">If edit is necessary for this document please contact the system admin.</em></div>
                                                                </div>
                                                            </div>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                </a>
                                            </div>
                                        
                                        <!--======= End Forech for comment and action ========================================== -->
                                        </div>
                                    </div>
                                    <?php endforeach; ?> 

                                <?php endif ?>

                                </div>
                            </div>
                        </div>
                    </div>
                        <?php if (!empty($doc_reply)): ?>
                            <div class="p-3 border-t border-gray-200 dark:border-dark-5 flex">
                                <a href="javascript:;" data-toggle="modal" data-target="#Reply_Message"  class="btn btn-primary w-60 py-2 px-3 ml-auto"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Reply Message </a>
                            </div>
                        <?php else: ?>
                        
                        <?php endif ?>
                    <!-- END: Display Information -->
                </div>
            </div>
        </div>
        <!-- END: Content -->

<!-- Start: Message notification -->
    <div id="success-notification-content" class="toastify-content hidden flex"> <i class="text-theme-9" data-feather="file-text"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium">Hello! <?= $this->session->userdata('staff_fname'); ?> <?= $this->session->userdata('staff_lname'); ?></div>
            <div class="text-gray-600 mt-1">This document is <?php switch ($doc_details['dd_status']){
                        case 0:
                            echo "<span class='text-theme-6'> For Receiving </span>";
                        break;
                        case 1:
                            echo "<span class='text-theme-6'> Pending </span>";
                        break;
                        case 2:
                            echo "<span class='text-theme-12'> On Process </span>";
                        break;
                        case 3:
                            echo "<span class='text-theme-10'> Re-process </span>";
                        break;
                        case 4:
                            echo "<span class='text-theme-9'> Completed </span> ";
                        break;
                        default: 
                            echo "ERROR";
                        break;  
                    }?></div>
        </div>
    </div> <!-- END: Notification Content -->
    <button id="success-notification-toggle" class="btn btn-primary hidden">Show Notification</button> <!-- END: Notification Toggle -->
<!-- END: Message notification -->

<!-- Modal View Message and action -->
  <?php foreach($action_messages as $action_message): ?>
    <div id="header-footer-modal" class="p-5">
      <div class="preview">
          <!-- BEGIN: Modal Content -->
          <div id="Action_Message<?php echo $action_message['id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <!-- BEGIN: Modal Header -->
                      <div class="modal-header">
                          <h2 class="font-medium text-base mr-auto">
                                <?php if ($action_message['doc_affiliated'] == "1") : ?>
                                    <a href="#" class='text-theme-10'>Replied by </a> 
                                        <?php foreach($staffs as $staff): ?>
                                            <?php if ($action_message['staff_name'] == $staff['staff_id']): ?>
                                            <?php switch ($staff['division']){
                                                case 2:
                                                    echo "Policy Planning and Research Division";
                                                    $get_div = 'PPD';
                                                break;
                                                case 3:
                                                    echo "Localization and Institutionalization Division";
                                                    $get_div = 'LID';
                                                break;
                                                case 4:
                                                    echo "Management Information System Unit";
                                                    $get_div = 'MISU';
                                                break;
                                                case 5:
                                                    echo "Administrative and Finance Division";
                                                    $get_div = 'AFD';
                                                break;
                                                case 6:
                                                    echo "Public Affairs and Information Office";
                                                    $get_div = 'PAIO';
                                                break;
                                                case 9:
                                                    echo "Office of the Executive Director";
                                                    $get_div = 'OED';
                                                break;
                                                default: 
                                                    echo "ERROR";
                                                    $get_div = 'ERROR';
                                                break;  
                                            }?>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                <?php elseif ($action_message['doc_affiliated'] == "0") : ?>
                                    Replied by Office of the Executive Director
                                    <!-- =================================== All staff ============================================= -->
                                <?php elseif ($action_message['doc_affiliated'] == "2") : ?>
                                    <a href="#" class='text-theme-10'>Document Action Report</a> 
                                    <br>
                                    <?php $taken_id = $action_message['doc_current_action']; 
                                    $dd_action_id = explode(", ", $taken_id);
                                    $dd_action_name = '';
                                    foreach($dd_action_id as $dd_action){
                                        $data = $this->dts->get_action($dd_action);
                                        $dd_action_name .= $data['da_name'] . ', ';
                                        $action_name =  substr($dd_action_name, 0, -2);
                                    }
                                    echo $action_name;
                                    ?>
                                <?php endif ?>
                          </h2>
                      </div>
                      <!-- END: Modal Header -->
                       <!-- BEGIN: Modal Body -->
                       <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12 text-right">
                                    <div class="text-xs text-gray-500 ml-auto"> 
                                        <?php switch ($action_message['doc_current_status']){
                                            case 1:
                                            echo '<span class="px-3 py-2 report-box__icon text-theme-6"><i data-feather="alert-triangle" class="report-box__icon text-theme-6"></i>  Pending </span>';
                                            $text_theme = '6';
                                            break;
                                            case 2:
                                            echo '<span class="px-3 py-2 report-box__icon text-theme-12"><i data-feather="alert-triangle" class="report-box__icon text-theme-12"></i>  On Process </span>';
                                            $text_theme = '12';
                                            break;
                                            case 3:
                                            echo '<span class="px-3 py-2 report-box__icon text-theme-10"><i data-feather="alert-triangle" class="report-box__icon text-theme-10"></i>  Re-Process </span>';
                                            $text_theme = '1';
                                            break;
                                            case 4:
                                            echo '<span class=" report-box__icon text-theme-9"><i data-feather="alert-triangle" class="report-box__icon text-theme-9"></i> This document was released. (Completed)<br></span>';
                                            $text_theme = '9';
                                            break;
                                            default:
                                            echo "ERROR";
                                            break;  
                                        }?>
                                        <i data-feather="clock" class="report-box__icon text-theme-7"></i>
                                        <?php $datepicker = date("M-d-Y h:i A", strtotime($action_message['comment_date'])); 
                                        echo $date_recieve = $datepicker;?>
                                    </div>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <?php if ($action_message['doc_affiliated'] == "1" || $action_message['doc_affiliated'] == "0" ) : ?>
                                    <div class="alert alert-secondary show mb-2" role="alert">
                                        <div class="flex items-center">
                                            <div class="font-small text-lg"><?php echo $action_message['reply']; ?></div>
                                        </div>
                                        <div class="mt-3">
                                        <?php foreach($staffs as $staff): ?>
                                            <?php if ($action_message['staff_name'] == $staff['staff_id']): ?>
                                                - commented by &nbsp; <i><?php echo $staff['fname']; ?>  <?php echo $staff['lname']; ?></i>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php elseif ($action_message['doc_affiliated'] == "2") : ?>
                                    <?php if ($action_message['doc_current_status'] == "2" || $action_message['doc_current_status'] == "3" ) : ?>
                                        <div class="alert alert-secondary show mb-2" role="alert">
                                            <div class="flex items-center">
                                                <div class="font-small text-lg"><?php $taken_id = $action_message['doc_current_action']; 
                                                    $dd_action_id = explode(", ", $taken_id);
                                                    $dd_action_name = '';
                                                    foreach($dd_action_id as $dd_action){
                                                        $data = $this->dts->get_action($dd_action);
                                                        $dd_action_name .= $data['da_name'] . ', ';
                                                        $action_name =  substr($dd_action_name, 0, -2);
                                                    }
                                                    echo $action_name;
                                                ?></div>
                                            </div>
                                            <div class="mt-3"><?php echo $action_message['reply']; ?></div>
                                        </div>
                                    <?php elseif ($action_message['doc_current_status'] == "4") : ?>
                                            <div class="alert alert-success show mb-2" role="alert">
                                                <div class="flex items-center">
                                                    <div class="font-medium text-lg">The document process is now completed</div>
                                                </div>
                                                <div class="mt-3">End process. <em style="font-size: 12px;">If edit is necessary for this document please contact the system admin.</em></div>
                                            </div>
                                    <?php endif ?>
                                <?php endif ?> 
                            </div>

                            <div class="col-span-12 sm:col-span-12">
                                <h2 class="intro-y text-lg font-medium mr-auto mt-2">
                                    File Uploaded
                                </h2>  

                                        <?php foreach($staffs as $staff): ?>
                                            <?php if ($action_message['staff_name'] == $staff['staff_id']): ?>
                                            <?php switch ($staff['division']){
                                                case 2:
                                                    $get_div = 'PPD';
                                                break;
                                                case 3:
                                                    $get_div = 'LID';
                                                break;
                                                case 4:
                                                    $get_div = 'MISU';
                                                break;
                                                case 5:
                                                    $get_div = 'AFD';
                                                break;
                                                case 6:
                                                    $get_div = 'PAIO';
                                                break;
                                                case 9:
                                                    $get_div = 'OED';
                                                break;
                                                default: 
                                                    $get_div = 'ERROR';
                                                break;  
                                            }?>
                                            <?php $encoded = $staff['lname']; ?>
                                            <?php endif ?>
                                        <?php endforeach; ?>
                                <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-3">
                                <?php $test = $get_div."/".$encoded; ?>   
                                <?php $i = 0;  
                                    if ($action_message['doc_current_file'] == '') : 
                                    echo '<div class="intro-y col-span-6 sm:col-span-4 md:col-span-6 xxl:col-span-3">
                                            <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                               <a href="#" class="w-3/5 file__icon file__icon--file mx-auto tooltip" title="No file found!">
                                                   <div class="file__icon__file-name"><?php echo $ext; ?></div>
                                               </a>
                                                <a href="#" class="block font-medium mt-4 text-center truncate">No Files Uploaded</a> 
                                            </div>
                                        </div>';
                                    else : 
                                    $array = substr($action_message['doc_current_file'], 1, -1);  
                                    $files_array1 = explode('||',$array); 
                                    foreach($files_array1 as $key) : ?>
                                    <?php $ext = pathinfo($key, PATHINFO_EXTENSION); ?>
                                    <div class="intro-y col-span-6 sm:col-span-4 md:col-span-6 xxl:col-span-3">
                                        <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                            <a href="<?= base_url('assets/upload'."/".$test."/".$key); ?>" target="_blank" class="w-3/5 file__icon file__icon--file mx-auto">
                                                <div class="file__icon__file-name"><?php echo $ext; ?></div>
                                            </a>
                                            <a href="" class="block font-medium mt-4 text-center truncate"><?php echo $key; ?></a> 
                                            <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                                                <a class="dropdown-toggle w-5 h-5 block" href="<?= base_url('assets/upload'."/".$test."/".$key); ?>" download aria-expanded="false"> <i data-feather="save" class="w-5 h-5 text-gray-600"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            

                        </div>
                        <!-- END: Modal Body -->
                      <!-- BEGIN: Modal Footer -->
                      
                      <div class="modal-footer text-right">
                          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-25"> <i data-feather="x" class="w-4 h-4"></i> &nbsp; Close</button>
                      </div>
                      <!-- END: Modal Footer -->
                  </div>
              </div>
          </div>
          <!-- END: Modal Content -->
      </div>
  </div>
 <?php endforeach; ?>
<!-- End Modal View Message and action -->

<!--  Modal Complate -->
    <div id="Doc_Complate" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo form_open('admin/Documents/complate_doc/'.$doc_details['dd_id']); ?>
                <div class="modal-body p-0">
                    <div class="p-5 text-center">
                        <i data-feather="help-circle" class="w-16 h-16 text-theme-10 mx-auto mt-3"></i> 
                        <div class="text-3xl mt-5">Are you sure?</div>
                        <div class="text-gray-600 mt-2">
                            Do you want to Complate this document?
                        </div>
                    </div>
                    <div class="px-5 pb-8 text-center">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                        <button type="submit"  class="btn btn-primary w-40">Yes, Complate it!</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<!-- End Modal Complate -->

<!-- Modal Document Action -->
    <div id="header-footer-modal" class="p-5">
        <div class="preview">
            <!-- BEGIN: Modal Content -->
            <div id="Document_Action" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">   
                    <div class="modal-content">
                    <?php echo form_open_multipart('admin/Documents/viewDoc_process/'.$doc_details['dd_id']); ?>
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Document Action
                            </h2>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <?php switch ($this->session->userdata('staff_division')){
                                case 2:
                                    $my_div = 'PPD';
                                break;
                                case 3:
                                    $my_div = 'LID';
                                break;
                                case 4:
                                    $my_div = 'MISU';
                                break;
                                case 5:
                                    $my_div = 'AFD';
                                break;
                                case 6:
                                    $my_div = 'PAIO';
                                break;
                                case 9:
                                    $my_div = 'OED';
                                break;
                                default: 
                                    $my_disvision = "ERROR";
                                break;  
                            }?>
                            <input type="hidden" value="<?php echo $my_div; ?>" id="my_div" name="my_div">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">Document Status</label>
                                <select data-placeholder="Select Document Status" data-search="true" class="tail-select w-full form-control" id="doc_status" name="doc_status">
                                    <optgroup label="Required Actions">
                                        <option value="2">On Process</option>
                                        <option value="3">Re-process</option>
                                        <option value="4">Release Document</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="dispatch" class="form-label"> For Dispatch </label>
                                <div class="form-check">
                                    <input id="dispatch" name="dispatch" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="dispatch">If you want to dispatch this document please check this box.</label>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                    <label for="modal-form-1" class="form-label"> Action Taken </label>
                                    <select data-placeholder="Select Required Action" data-search="true" class="tail-select w-full form-control" id="doc_action" name="doc_action[]" multiple>
                                        <optgroup label="Required Actions">
                                            <?php foreach($type_action_takens as $type_action_taken): ?>
                                                <option value="<?php echo $type_action_taken['da_id']; ?>"><?php echo $type_action_taken['da_name']; ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                    <label for="editor1" class="form-label"> Notes / Remarks </label>
                                    <textarea placeholder="Enter Notes / Remarks" id="editor1" name="editor1" class="form-control"></textarea>
                            </div>
                        </div>
                        <!-- END: Modal Body -->
                        <!-- BEGIN: Modal Footer -->
                        <div class="modal-footer text-right">
                            <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                            <button type="submit" data-dismiss="modal" class="btn btn-primary w-20" id="btn_action">Confirm</button>
                        </div>
                        <?php echo form_close(); ?>
                        <!-- END: Modal Footer -->
                    </div>
                </div>
            </div>
            <!-- END: Modal Content -->
        </div>
    </div>
<!-- End Modal Document Action -->

<!-- Modal Reply Message -->
    <div id="header-footer-modal" class="p-5">
      <div class="preview">
          <!-- BEGIN: Modal Content -->
          <div id="Reply_Message" class="modal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                  <?php echo form_open_multipart('admin/Documents/viewDoc_reply_notes/'.$doc_details['dd_id']); ?>
                      <!-- BEGIN: Modal Header -->
                      <div class="modal-header">
                          <h2 class="font-medium text-base mr-auto">
                              Reply Message
                          </h2>
                      </div>
                      <!-- END: Modal Header -->
                       <!-- BEGIN: Modal Body -->
                       <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">

                        <?php switch ($this->session->userdata('staff_division')){
                            case 2:
                                $my_disvision = "Policy Planning and Research Division";
                                $my_div = 'PPRD';
                            break;
                            case 3:
                                $my_disvision = "Localization and Institutionalization Division";
                                $my_div = 'LID';
                            break;
                            case 4:
                                $my_disvision = "Management Information System Unit";
                                $my_div = 'MISU';
                            break;
                            case 5:
                                $my_disvision = "Administrative and Finance Division";
                                $my_div = 'AFD';
                            break;
                            case 6:
                                $my_disvision = "Public Affairs and Information Office";
                                $my_div = 'PAIO';
                            break;
                            case 9:
                                $my_disvision = "Office of the Executive Director";
                                $my_div = 'OED';
                            break;
                            default: 
                                $my_disvision = "ERROR";
                            break;  
                        }?>

                            <div class="col-span-12 sm:col-span-12">
                                <label for="get_my_staff" class="form-label"> Staff Name </label>
                                <input type="text" class="form-control" value="<?= $this->session->userdata('staff_fname'); ?> <?= $this->session->userdata('staff_lname'); ?>" disabled>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="get_my_division" class="form-label"> Division </label>
                                <input type="text" class="form-control" value="<?php echo $my_disvision; ?>" id="get_my_division" name="get_my_division" disabled>
                            </div>
                            <input type="hidden" value="<?php echo $my_div; ?>" id="my_div" name="my_div">
                            <?php if ($my_div == "OED") : ?>
                                <input type="hidden" value="0" id="oed_other" name="oed_other">
                            <?php else: ?>
                                <input type="hidden" value="1" id="oed_other" name="oed_other">
                            <?php endif ?>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="editor1" class="form-label"> Notes / Remarks </label>
                                <textarea placeholder="Enter Notes / Remarks" id="editor1" name="editor1" class="form-control"></textarea>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                              <label for="modal-form-1" class="form-label">Select files</label>
                                <div id="multiple-file-upload" class="form-control">
                                    <div class="preview"> 
                                            <div class="fallback">
                                                <input type="file" class="upload" id="files" <?php if (!empty($files_array)) {
                                               if (count($files_array) >= 10) {
                                                echo 'disabled';
                                               }
                                              } ?>

                                              accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,application/vnd.ms-excel" name="files[]" onchange="readURL(this);" multiple/>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal Body -->
                      <!-- BEGIN: Modal Footer -->
                      
                      <div class="modal-footer text-right">
                          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-25"> <i data-feather="x" class="w-4 h-4"></i> &nbsp; Cancel</button>
                          <button type="submit" data-dismiss="modal" class="btn btn-primary w-25 reply"> <i data-feather="send" class="w-4 h-4"></i> &nbsp; Send </button>
                      </div>
                      <?php echo form_close(); ?>
                      <!-- END: Modal Footer -->
                  </div>
              </div>
          </div>
          <!-- END: Modal Content -->
      </div>
  </div>
<!-- End Modal Reply Message -->

<!-- Modal Upload files -->
 <div id="header-footer-modal" class="p-5">
      <div class="preview">
          <!-- BEGIN: Modal Content -->
          <div id="Upload_file" class="modal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                  <?php echo form_open_multipart('admin/Documents/file_attachment/'.$doc_details['dd_id']."/".$v_words."/".$get_imgs); ?>
                      <!-- BEGIN: Modal Header -->
                      <div class="modal-header">
                          <h2 class="font-medium text-base mr-auto">
                              Upload New Files
                          </h2>
                      </div>
                      <!-- END: Modal Header -->
                      <!-- BEGIN: Modal Body -->
                      <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                          <div class="col-span-12 sm:col-span-12">
                              <label for="modal-form-1" class="form-label">Select files</label>
                                <div id="multiple-file-upload" class="form-control">
                                    <div class="preview"> 
                                            <div class="fallback">
                                                <input type="file" class="upload" id="files" <?php if (!empty($files_array)) {
                                               if (count($files_array) >= 10) {
                                                echo 'disabled';
                                               }
                                              } ?>

                                              accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,application/vnd.ms-excel" name="files[]" onchange="readURL(this);" multiple/>
                                            </div>
                                    </div>
                                </div>
                          </div>
                      </div>
                      <!-- END: Modal Body -->
                      <!-- BEGIN: Modal Footer -->
                      <div class="modal-footer text-right">
                          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                          <button type="submit" class="btn btn-primary w-20">Upload</button>
                      </div>
                      <?php echo form_close(); ?>
                      <!-- END: Modal Footer -->
                  </div>
              </div>
          </div>
          <!-- END: Modal Content -->
      </div>
  </div>
<!-- End Modal Upload files -->
   <!-- =================================================================================================================================================== -->
 <?php $this->load->view('admin/partials/footer.php'); ?>

 <script type="text/javascript">
    jQuery(function(){
        jQuery('#success-notification-toggle').click();
    });
</script>

<?php if($this->session->flashdata('deleted')): ?>
  <script type="text/javascript">
    Swal.fire({
          icon: 'success',
          title: 'Successful!',
          text: '<?php echo $this->session->flashdata('deleted') ?>',
        })
  </script>
<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>
  <script type="text/javascript">
    Swal.fire({
          icon: 'success',
          title: 'Successful!',
          text: '<?php echo $this->session->flashdata('success') ?>',
        })
  </script>
<?php endif; ?>

<?php if($this->session->flashdata('process_success')): ?>
  <script type="text/javascript">
    Swal.fire({
          icon: 'success',
          title: 'Successful!',
          text: '<?php echo $this->session->flashdata('process_success') ?>',
        })
  </script>
<?php endif; ?>

<script type="text/javascript">
var uploadField = document.getElementById("files[]");

uploadField.onchange = function() {
    if(this.files[0].size > 20971520 ){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'File is too big! Max size is 20mb.',
        });
       this.value = "";
    };
};
</script>

<script type="text/javascript">
$('#btn_action').on('click',function(e){
     let timerInterval
      Swal.fire({
        title: 'Please Wait...',
        html: 'I will close in <b></b> milliseconds.',
        timer: 5000,
        timerProgressBar: true,
        onBeforeOpen: () => {
          Swal.showLoading()
          timerInterval = setInterval(() => {
            const content = Swal.getContent()
            if (content) {
              const b = content.querySelector('b')
              if (b) {
                b.textContent = Swal.getTimerLeft()
              }
            }
          }, 100)
        },
        onClose: () => {
          clearInterval(timerInterval)
        }
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          console.log('I was closed by the timer')
        }
      })
});
</script>

<script type="text/javascript">
$('.reply').on('click',function(e){
     let timerInterval
      Swal.fire({
        title: 'Please Wait...',
        html: 'I will close in <b></b> milliseconds.',
        timer: 3000,
        timerProgressBar: true,
        onBeforeOpen: () => {
          Swal.showLoading()
          timerInterval = setInterval(() => {
            const content = Swal.getContent()
            if (content) {
              const b = content.querySelector('b')
              if (b) {
                b.textContent = Swal.getTimerLeft()
              }
            }
          }, 100)
        },
        onClose: () => {
          clearInterval(timerInterval)
        }
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          console.log('I was closed by the timer')
        }
      })
});
</script>

