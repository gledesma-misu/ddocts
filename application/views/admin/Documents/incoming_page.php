<?php $this->load->view('admin/partials/header.php'); ?>

<style>
    .pagination a{
      color: black;
      float: left;
      font-size: 14px; 
      padding: 2px 8px;
      text-decoration: none;
    }

    .pagination a.active {
      background-color: #4CAF50;
      color: white;
      border-radius: 5px;
    }

    .pagination a:hover:not(.active) {
      background-color: #ddd;
      border-radius: 5px;
    }
</style>

        <!-- BEGIN: Content -->
        <div class="content">
          <div class="intro-y block sm:flex items-center h-10 mt-8">
              <h2 class="text-lg font-medium truncate mr-5"> 
                 For Action Document
              </h2>
              <div class="flex items-center sm:ml-auto mt-3 sm:mt-0"> 
                    <?php echo form_open('admin/Documents/search_incoming') ?>
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <input type="text" class="form-control py-3 px-4 w-full lg:w-64 box pr-10 placeholder-theme-13" id="search_doc" name="search_doc" placeholder="Search Doc ID...">
                        <button type="submit"><i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 tooltip" title="Click me to search!" data-feather="search"></i></button>
                    </div>
                    <?php echo form_close(); ?>
              </div>
          </div>
            <!-- BEGIN: HTML Table Data -->
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Document No.</th>
                            <th class="text-center whitespace-nowrap">Document Type</th>
                            <th class="text-center whitespace-nowrap">Document Title</th>
                            <th class="text-center whitespace-nowrap">Source</th>
                            <th class="text-center whitespace-nowrap">Routed To</th>
                            <th class="text-center whitespace-nowrap">Date Sent</th>
                            <th class="text-center whitespace-nowrap">Date Received</th>
                            <th class="text-center whitespace-nowrap">Concerned Staff</th>
                            <th class="text-center whitespace-nowrap">Doc. Status</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php if(is_array($posts)&&(count($posts)))
                        foreach($posts as $post): ?>
                        <?php if ($post['dd_status'] != 4): ?>
                        <tr class="intro-x">
                            <td class="text-center"> <?php echo $post['dd_doc_id_code']; ?> </td>
                            <td class="text-center">
                                    <?php if ($post['dd_doct_type'] == 0): ?>
                                        Multiple
                                    <?php else: ?>
                                        <?php echo $post['dt_name']; ?>
                                    <?php endif ?>
                            </td>
                            <td class="w-40">
                                <a href="javascript:;" data-toggle="modal" data-target="#View<?php echo $post['dd_id']; ?>">
                                    <div class="flex items-center justify-center text-theme-9"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> <?php echo $post['dd_title']; ?> </div>
                                </a>
                            </td>
                            <td class="text-center"> <?php $dd_action_taken_id = $post['dd_source']; ?>
                              <?php 
                                 $dd_action_id = explode(", ", $dd_action_taken_id);
                                //  print_r($post['dd_source']);
                                 $dd_action_name = '';
                                 foreach($dd_action_id as $mysource){
                                     $this->load->model('Model_dts', 'dts');
                                     $data = $this->dts->mysources($mysource);
                                     $dd_action_name .= $data['ds_code'] . ', ';
                                     $dd_name =  substr($dd_action_name, 0, -2);
                                 }
                                 echo $dd_name;
                              ?></td>
                            <td class="text-center"> <?php echo $post['dd_view_doc']; ?> </td>
                            <td class="text-center"> <?php echo $post['dd_date_encoded']; ?> </td>
                            <td class="text-center">
                                <?php $date = $post['dd_date_encoded'];  
                                $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                <?php echo $datepicker; ?>
                            </td>
                            <td class="text-center">
                            <?php echo $post['dd_staff_name']; ?>
                            </td>

                            <td class="text-center"><?php switch ($post['dd_status']){
                                    case 1:
                                        echo '<span class="px-2 py-1 rounded-full bg-theme-6 text-white mr-1"> Pending </span>';
                                    break;
                                    case 2:
                                        echo '<span class="px-2 py-1 rounded-full bg-theme-12 text-white mr-1"> OnProcess </span>';
                                    break;
                                    case 3:
                                        echo '<span class="px-2 py-1 rounded-full bg-theme-1 text-white mr-1"> Reprocess </span>';
                                    break;
                                    case 4:
                                        echo '<span class="px-2 py-1 rounded-full bg-theme-9 text-white mr-1"> Completed </span>';
                                    break;
                                    default:
                                        echo "ERROR";
                                    break;  
                                }?>
                            </td>

                            <td class="table-report__action w-30">
                                <div class="flex justify-center items-center">
                                    <a class="btn btn-sm btn-outline-primary w-24 inline-block" href="<?= base_url('admin/documents/viewDoc/'.$post['dd_id']); ?>"> <i data-feather="file-text" class="w-4 h-4 mr-1"></i>Route</a>
                                </div>
                            </td>
                        </tr>
                        <?php else: ?>

                        <?php endif ?>
                        <?php endforeach; ?> 
                    </tbody>
                    <tfoot>
                      <tr>
                            <th class="whitespace-nowrap">Document No.</th>
                            <th class="text-center whitespace-nowrap">Document Type</th>
                            <th class="text-center whitespace-nowrap">Document Title</th>
                            <th class="text-center whitespace-nowrap">Source</th>
                            <th class="text-center whitespace-nowrap">Routed To</th>
                            <th class="text-center whitespace-nowrap">Date Sent</th>
                            <th class="text-center whitespace-nowrap">Date Received</th>
                            <th class="text-center whitespace-nowrap">Concerned Staff</th>
                            <th class="text-center whitespace-nowrap">Doc. Status</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                      </tr>
                  </tfoot>
                </table>
            </div>
            <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                  <?php echo $this->pagination->create_links(); ?>
              </div>
        </div>
        <!-- END: Content -->

<!-- BEGIN: Modal Content -->
<?php foreach($get_id_staffs as $get_id_staff): ?>
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
                                <td class="text-left">
                                    <?php if ($get_id_staff['dd_doct_type'] == 0): ?>
                                    <?php $dd_docbundle = $get_id_staff['dd_bundleDocs']; ?>
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
                                         foreach($dd_action_id as $mysource){
                                             $this->load->model('Model_dts', 'dts');
                                             $data = $this->dts->mysources($mysource);
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
                                    <?php $dd_action_taken_id = $get_id_staff['dd_action_taken']; ?>

                                    <?php 
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
                                    ?>

                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="text-left"> Document Recieved Date </td>
                                <td class="text-left">  <?php $date = $get_id_staff['dd_date_encoded'];  
                                $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                <?php echo $datepicker; ?> </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="text-left"> Routed From </td>
                                <td class="text-left"> 
                                     <?php $dd_action_taken_id = $get_id_staff['dd_source']; ?>
                                      <?php 
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
                                      ?>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="text-left"> Date Routed </td>
                                <td class="text-left"> <?php $date = $get_id_staff['dd_date_encoded'];  
                                $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                <?php echo $datepicker; ?> </td>
                            </tr>
                             <tr class="intro-x">
                                <td class="text-left"> Concern Staff </td>
                                <td class="text-left"> 
                                <?php echo $get_id_staff['dd_staff_name']; ?>
                                </td>
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
                 <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                 <a href="<?= base_url('admin/documents/viewDoc/'.$get_id_staff['dd_id']); ?>" class="btn btn-primary w-30">View More</a>
             </div>
             <!-- END: Modal Footer -->
         </div>
     </div>
 </div>
 <?php endforeach; ?>
 <!-- END: Modal Content -->

 <div id="success-notification-content" class="toastify-content hidden flex"> <i class="text-theme-6" data-feather="check-circle"></i>
     <div class="ml-4 mr-4">
         <div class="font-medium">Hello! <?= $this->session->userdata('staff_fname'); ?> <?= $this->session->userdata('staff_lname'); ?></div>
         <div class="text-gray-600 mt-1">You have <b><?php echo $count; ?></b> documents need for action.</div>
     </div>
 </div> <!-- END: Notification Content -->

 <!-- BEGIN: Notification Toggle --> <button id="success-notification-toggle" class="btn btn-primary hidden">Show Notification</button> <!-- END: Notification Toggle -->

<?php $this->load->view('admin/partials/footer.php'); ?>

<script type="text/javascript">
    jQuery(function(){
        jQuery('#success-notification-toggle').click();
    });
</script>
