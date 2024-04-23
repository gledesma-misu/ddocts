<?php $this->load->view('admin/partials/header.php'); ?>

     <!-- BEGIN: Content -->
        <div class="content">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Dispatch Documents
                </h2>
            </div>
            <!-- BEGIN: HTML Table Data -->
            <div class="intro-y box p-5 mt-5">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                       Document Details
                    </h2>
                    <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                        <a class="btn btn-info shadow-md mr-2" href="javascript:;" data-toggle="modal" data-target="#pdf" > <i class="w-5 h-5" data-feather="printer"></i>&nbsp; Import to PDF </a>
                    
                    <!-- BEGIN: pdf Content -->
                    <div id="pdf" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <?php echo form_open('admin/Records/dispatch_pdf'); ?>
                                    <!-- BEGIN: Modal Header -->
                                    <div class="modal-header">
                                        <h2 class="font-medium text-base mr-auto">Generate PDF File</h2> 
                                    </div> <!-- END: Modal Header -->
                                    <!-- BEGIN: Modal Body -->
                                    <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                                        <div class="col-span-12 sm:col-span-6"> <label for="modal-datepicker-1" class="form-label">From</label> <input type="date" id="modal-datepicker-1" name="date_from" class="form-control" data-single-mode="true"> </div>
                                        <div class="col-span-12 sm:col-span-6"> <label for="modal-datepicker-2" class="form-label">To</label> <input  type="date" id="modal-datepicker-2" name="date_to" class="form-control" data-single-mode="true"> </div>
                                    </div> <!-- END: Modal Body -->
                                    <!-- BEGIN: Modal Footer -->
                                    <div class="modal-footer text-right"> <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button> <button type="submit" class="btn btn-primary w-20">Submit</button> </div> <!-- END: Modal Footer -->
                                <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div> 
                    <!-- END: pdf Content -->

                    </div>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table id="dispatch_doc" class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Document No.</th>
                            <th class="text-center whitespace-nowrap">Type</th>
                            <th class="text-center whitespace-nowrap">Document Title</th>
                            <th class="text-center whitespace-nowrap">Source Document</th>
                            <th class="text-center whitespace-nowrap">Routed From</th>
                            <th class="text-center whitespace-nowrap">Date Routed (Recieved)</th>
                            <th class="text-center whitespace-nowrap">To</th>
                            <th class="text-center whitespace-nowrap">Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($doc_list)&&(count($doc_list)))
                        foreach($doc_list as $doc_list): ?>
                         <tr class="intro-x">
                            <td class="text-center"><?php echo $doc_list['dd_doc_id_code']; ?></td>
                            <td class="text-center">
                                 <?php if ($doc_list['dd_doct_type'] == 0): ?>
                                    Multiple
                                <?php else: ?>
                                    <?php echo $doc_list['dt_name']; ?>
                                <?php endif ?>
                            </td>
                            <td class="text-center">
                                <?php echo $doc_list['dd_title']; ?>
                            </td>
                            <td class="text-center">
                                 <?php $dd_action_taken_id = $doc_list['dd_source']; ?>
                                  <?php 
                                     $dd_action_id = explode(", ", $dd_action_taken_id);
                                     //print_r($dd_action_id);
                                     $dd_action_name = '';
                                     foreach($dd_action_id as $mysource){
                                         $this->load->model('Model_records', 'records');
                                         $data = $this->records->mysources($mysource);
                                         $dd_action_name .= $data['ds_code'] . ', ';
                                         $dd_name =  substr($dd_action_name, 0, -2);
                                     }
                                     echo $dd_name;
                                  ?>
                            </td>
                            <td class="text-center"><?php echo $doc_list['dd_view_doc']; ?></td>
                            <td class="text-center"><?php $date = $doc_list['dd_date_encoded'];  
                                $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                <?php echo $datepicker; ?></td>
                            <td class="text-center"><?php echo $doc_list['dd_staff_name']; ?></td>
                            <td class="table-report__action w-30">
                                <div class="flex justify-center items-center">
                                    <a class="btn btn-sm btn-outline-primary w-24 inline-block" href="<?= base_url('admin/documents/viewDoc/'.$doc_list['dd_id']); ?>"> <i data-feather="file-text" class="w-4 h-4 mr-1"></i> Route </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                           <th class="whitespace-nowrap">Document No.</th>
                            <th class="text-center whitespace-nowrap">Type</th>
                            <th class="text-center whitespace-nowrap">Document Title</th>
                            <th class="text-center whitespace-nowrap">Source Document</th>
                            <th class="text-center whitespace-nowrap">Routed From</th>
                            <th class="text-center whitespace-nowrap">Date Routed (Recieved)</th>
                            <th class="text-center whitespace-nowrap">To</th>
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
