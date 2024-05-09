<?php $this->load->view('admin/partials/header.php'); ?>

 <!-- BEGIN: Content -->
        <div class="content">
            <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                   Documents Type
                </h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <a href="javascript:;" data-toggle="modal" data-target="#Create_new" class="btn btn-primary shadow-md mr-2">Create New Document type</a> 
                </div>
            </div>
            <!-- BEGIN: HTML Table Data -->
            <div class="intro-y box p-5 mt-5">
                <table id="type_doc" class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">Document Type Name</th>
                            <th class="text-center whitespace-nowrap">Category</th>
                            <th class="text-center whitespace-nowrap">Date Registered</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php if(is_array($type_docs)&&(count($type_docs)))
                         foreach($type_docs as $type_doc): ?>
                            <tr class="intro-x">
                                <td class="text-center"> <b><?php echo $type_doc['dt_name']; ?></b> </td>
                                <td class="text-center"> 
                                    <?php if ($type_doc['dt_category'] == 0): ?>
                                        <b>Please Select Category</b>
                                    <?php else: ?>
                                            <?php $dd_action_taken_id = $type_doc['dt_category']; 

                                           $dd_action_id = explode(", ", $dd_action_taken_id);
                                           //print_r($dd_action_id);
                                           $dd_action_name = '';
                                           foreach($dd_action_id as $dd_action){
                                               $this->load->model('Model_admin', 'admin');
                                               $data = $this->admin->get_action($dd_action);
                                               $dd_action_name .= $data['dtc_name'] . ', ';
                                               $dd_name =  substr($dd_action_name, 0, -2);
                                           }
                                           echo "<b>".$dd_name."</b>";
                                        ?>

                                    <?php endif ?>
                                </td>
                                <td class="text-center"> 
                                    <?php $date = $type_doc['dt_date_added'];  
                                    $datepicker = date("M-d-Y h:i A", strtotime($date)); ?>
                                    <?php echo $datepicker; ?>
                                </td>

                                <td class="table-report__action w-30">
                                    <div class="flex justify-center items-center">
                                        <a class="btn btn-sm btn-outline-primary w-24 inline-block" href="javascript:;" data-toggle="modal" data-target="#Update<?php echo $type_doc['dt_id']; ?>"> <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit </a> &nbsp; | &nbsp;
                                        <a class="btn btn-sm btn-outline-danger w-24 inline-block" href="javascript:;" data-toggle="modal" data-target="#delete<?php echo $type_doc['dt_id']; ?>"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?> 
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="whitespace-nowrap">Document Type Name</th>
                            <th class="text-center whitespace-nowrap">Category</th>
                            <th class="text-center whitespace-nowrap">Date Registered</th>
                            <th class="text-center whitespace-nowrap">Action</th>
                        </tr>
                    </tfoot>
                </table>
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
                   New Document type
                </h2>
            </div>
            <?php echo form_open('admin/administrator/type_create'); ?>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label for="pos-form-1" class="form-label"> Document type Name </label>
                    <input id="pos-form-1" type="text" id="type_doc" name="type_doc" class="form-control flex-1" placeholder="Enter Source Name">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-2" class="form-label">Select Category</label>
                    <select data-placeholder="Select Category" id="type_cate" name="type_cate" class="tail-select w-full form-control">
                        <?php foreach($type_doc_categories as $type_doc_category): ?>
                            <option value="<?php echo $type_doc_category['dtc_id']; ?>"> <?php echo $type_doc_category['dtc_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
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

<!-- update document type -->
<?php foreach($type_docs as $type_doc): ?>
<div id="Update<?php echo $type_doc['dt_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Update Source Document
                </h2> 
            </div>
            <?php echo form_open('admin/administrator/update_type/'.$type_doc['dt_id']); ?>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12">
                    <label for="pos-form-1" class="form-label">Document Type Name</label>
                    <input id="pos-form-1" type="text" id="u_name_type" name="u_name_type" class="form-control flex-1" value="<?php echo $type_doc['dt_name']; ?>" placeholder="Eneter Source Name">
                </div>
                <div class="col-span-12">
                    <label for="pos-form-2" class="form-label">Select Type Category</label>
                    <?php if ($type_doc['dt_category'] == '0'): ?>
                        <?php  $Exist = 'No Existing Category!'; ?>
                    <?php else: ?>
                         <?php switch ($type_doc['dt_category']){
                            case 1:
                                $Exist = 'Personnel';
                            break;
                            case 2:
                                $Exist = 'Financial Documents';
                            break;
                            case 3:
                                $Exist = 'Procurement Documents';
                            break;
                            case 4:
                                $Exist = 'COA Concerns';
                            break;
                            case 5:
                                $Exist = 'Internal Documents';
                            break;
                            case 6:
                                $Exist = 'External Documents';
                            break;
                            case 7:
                                $Exist = 'Guidelines';
                            break;
                            case 8:
                                $Exist = 'Memorandum';
                            break;
                            default:
                                echo "ERROR";
                            break;  
                          }?>
                    <?php endif ?>
                    <select data-placeholder="Select Type Source" id="u_cate" name="u_cate" class="tail-select w-full form-control">
                           <?php foreach($type_doc_categories as $type_doc_category): ?>
                            <option value="<?php echo $type_doc['dt_category']; ?>">Existing: <?php echo $Exist; ?></option>
                            <option value="<?php echo $type_doc_category['dtc_id']; ?>"> <?php echo $type_doc_category['dtc_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
                <button type="submit" class="btn btn-primary w-32">Update</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- END: update document type -->

<!-- BEGIN: delete Content -->
<?php foreach($type_docs as $type_doc): ?>
 <div id="delete<?php echo $type_doc['dt_id']; ?>" class="modal" tabindex="-1" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-body p-0">
                <?php echo form_open('admin/administrator/delete_type/'.$type_doc['dt_id']); ?>
                 <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                     <div class="text-3xl mt-5">Are you sure?</div>
                     <div class="text-gray-600 mt-2">Do you really want to delete these source document? <br>This process cannot be undone.</div>
                 </div>
                 <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button> <button type="submit" class="btn btn-danger w-24">Delete</button> </div>
                <?php echo form_close(); ?>
             </div>
         </div>
     </div>
 </div> <!-- END: delete Content -->
<?php endforeach; ?>


<!-- ------------------------------------------------Footer------------------------------------------ -->
<?php $this->load->view('admin/partials/footer.php'); ?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/

    $('#type_doc').DataTable({
        columnDefs: [ { type: 'date', 'targets': [2] } ],
        order: [[ 2, 'desc' ]],   
    });
</script>

<?php if($this->session->flashdata('type_created')): ?>
  <script type="text/javascript">
      Swal.fire(
      'Successful!',
      '<?php echo $this->session->flashdata('type_created') ?>',
      'success'
    )
  </script>
<?php endif; ?>

<?php if($this->session->flashdata('type_updated')): ?>
  <script type="text/javascript">
      Swal.fire(
      'Successful!',
      '<?php echo $this->session->flashdata('type_updated') ?>',
      'success'
    )
  </script>
<?php endif; ?>

<?php if($this->session->flashdata('type_deleted')): ?>
  <script type="text/javascript">
      Swal.fire(
      'Successful!',
      '<?php echo $this->session->flashdata('type_deleted') ?>',
      'success'
    )
  </script>
<?php endif; ?>