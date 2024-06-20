<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head --> 
    <head>
        <meta charset="utf-8">
        <link href="<?php echo base_url('favicon.gif'); ?>" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Dashboard - DDOCTS</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

        <link rel="stylesheet" href="<?php echo base_url('assets/template/dist/css/app.css'); ?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/template/vendors/loadingjs/loading.min.css'); ?>">
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="main">
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="" class="flex mr-auto">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="<?php echo base_url('assets/template/dist/images/logo.svg'); ?>">
                </a>
                <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <ul class="border-t border-theme-29 py-5 hidden">
                
                <li>
                    <a href="side-menu-light-inbox.html" class="menu">
                        <div class="menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="menu__title"> Dashboard </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-file-manager.html" class="menu">
                        <div class="menu__icon"> <i data-feather="hard-drive"></i> </div>
                        <div class="menu__title"> Documents </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-point-of-sale.html" class="menu">
                        <div class="menu__icon"> <i data-feather="credit-card"></i> </div>
                        <div class="menu__title">Division Documents</div>
                    </a>
                </li>
               
                
            </ul>
        </div>
        <!-- END: Mobile Menu -->

        <!-- BEGIN: Top Bar -->
        <div class="border-b border-theme-29 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
            <div class="top-bar-boxed flex items-center">
                <!-- BEGIN: Logo -->
                <a href="" class="-intro-x hidden md:flex">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="<?php echo base_url('assets/template/dist/images/logo.svg'); ?>">
                    <span class="text-white text-lg ml-3"> DocTS - <span class="font-medium">CWC</span> </span>
                </a>
                <!-- END: Logo -->
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb breadcrumb--light mr-auto"> 
                    <!-- <a href="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
                    <a href="" class="breadcrumb--active">Dashboard</a>  -->
                </div>
                <!-- END: Breadcrumb -->

                <!-- BEGIN: Notifications -->
                <div class="intro-x dropdown mr-4 sm:mr-6">
                    <div class="dropdown-toggle notification notification--light notification--bullet cursor-pointer" id="notification" role="button" aria-expanded="false"> <i data-feather="bell" class="notification__icon dark:text-gray-300"></i> </div>
                    <div class="notification-content pt-2 dropdown-menu">
                        <div class="notification-content__box dropdown-menu__content box dark:bg-dark-6">
                            <div class="notification-content__title">Notifications</div>

                            <div id="notif_list"></div>

                            <a href="<?= base_url('admin/dashboard/view_all_notif'); ?>" class="intro-x w-full block text-center btn btn-sm btn-secondary mt-5">View More</a>
                        </div>
                    </div>
                </div>
                <!-- END: Notifications -->

                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8">
                    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false">
                        <img alt="Rubick Tailwind HTML Admin Template" src="<?php echo base_url('assets/template/images/female_avatar.png'); ?>">
                    </div>
                    <div class="dropdown-menu w-56">
                        <div class="dropdown-menu__content box bg-theme-26 dark:bg-dark-6 text-white">
                            <div class="p-4 border-b border-theme-27 dark:border-dark-3">
                                <div class="font-medium"> <?= $this->session->userdata('staff_fname'); ?> <?= $this->session->userdata('staff_lname'); ?> </div>
                                <div class="text-xs text-theme-28 mt-0.5 dark:text-gray-600"> <?= $this->session->userdata('staff_position'); ?> </div>
                            </div>
                            <div class="p-2">
                                <a href="<?= base_url('admin/dashboard/view_profile'); ?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                            </div>
                            <div class="p-2 border-t border-theme-27 dark:border-dark-3">
                                <a href="<?php echo base_url('admin/dashboard/logout'); ?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Account Menu -->
            </div>
        </div>
        <!-- END: Top Bar -->

    <!-- BEGIN: Top Menu -->
    <nav class="top-nav"> 
            <ul>
                <li>
                <?php if($this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == 'Dashboard'){ $url = 'top-menu--active';}else{ $url = '';}?>
                    <a href="<?= base_url('admin/dashboard'); ?>" class="top-menu <?php echo $url; ?>">
                        <div class="top-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="top-menu__title"> Dashboard <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                    </a>
                </li>
                <li>
                <?php if($this->uri->segment(2) == 'documents'){ $url = 'top-menu--active';}else{ $url = '';}?>
                    <a href="javascript:;" class="top-menu <?php echo $url; ?>">
                        <div class="top-menu__icon"> <i data-feather="folder"></i> </div>
                        <div class="top-menu__title"> Documents <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?= base_url('admin/documents'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="edit-2"></i> </div>
                                <div class="top-menu__title"> Create new record </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/documents/incoming'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> For Action </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/documents/outgoing'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="file"></i> </div>
                                <div class="top-menu__title"> Completed </div>
                            </a>
                            <a href="<?= base_url('admin/documents/search'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="search"></i> </div>
                                <div class="top-menu__title"> Search </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                <?php if($this->uri->segment(2) == 'DivisionDoc'){ $url = 'top-menu--active';}else{ $url = '';}?>
                    <a href="javascript:;" class="top-menu <?php echo $url; ?>">
                        <div class="top-menu__icon"> <i data-feather="file-text"></i> </div>
                        <div class="top-menu__title"> Division Documents <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?= base_url('admin/DivisionDoc/pending'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> For Action </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/DivisionDoc/completed'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="file"></i> </div>
                                <div class="top-menu__title"> Completed </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/DivisionDoc/upload_files'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="download"></i> </div>
                                <div class="top-menu__title"> Download Files </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if ($this->session->userdata('staff_position') == 'Records Officer I' || $this->session->userdata('staff_position') == 'Records Officer II'): ?>
                <li>
                <?php if($this->uri->segment(2) == 'Records'){ $url = 'top-menu--active';}else{ $url = '';}?>
                    <a href="javascript:;" class="top-menu <?php echo $url; ?>">
                        <div class="top-menu__icon"> <i data-feather="database"></i> </div>
                        <div class="top-menu__title"> Records <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?= base_url('admin/Records/dispatch'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Outgoing Documents </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/Records/archive'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Completed - Archive </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/Records/forarchive'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Pending - For Archive </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/Records/incoming_ex'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Incoming - External </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/documents/incoming_records'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Create New Record </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
               
                <?php if($this->session->userdata('id') == 1) : ?>       
                <li>
                <?php if($this->uri->segment(2) == 'administrator'){ $url = 'top-menu--active';}else{ $url = '';}?>
                    <a href="javascript:;" class="top-menu <?php echo $url; ?>">
                        <div class="top-menu__icon"> <i data-feather="settings"></i> </div>
                        <div class="top-menu__title"> Administrator <i data-feather="chevron-down" class="top-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="">
                        <li>
                            <a href="<?= base_url('admin/administrator'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Source Document </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/administrator/typeDoc'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Type Document </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/administrator/actionDoc'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Action Document </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/administrator/view_staff'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> View Staff </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('admin/administrator/register_new'); ?>" class="top-menu">
                                <div class="top-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="top-menu__title"> Register Staff </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
<!-- END: Top Menu -->



        