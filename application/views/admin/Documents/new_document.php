<?php $this->load->view('admin/partials/header.php'); ?>

<link rel="stylesheet" href="<?php echo base_url('assets/template/css/styles.css'); ?>">

<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <?php if ($records_incoming == '1') {
            $textdisplay = '/ Incoming - External "Records Offices"';
        } else {
            $textdisplay = '';
        } ?>
        <h2 class="text-lg font-medium mr-auto">
            Route Document <?php echo $textdisplay; ?>
        </h2>
    </div>
    <br>
    <!-- BEGIN: Post Info -->
    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Document Details
            </h2>
        </div>

        <?php echo form_open_multipart('admin/Documents/newdoc', ['id' => 'staffForm']); ?>
        <div id="horizontal-form" class="p-5">
            <div class="preview">
                <!-- Source -->
                <div class="form-inline">
                    <label for="source_doc" class="form-label sm:w-40" style="text-align: left;">Source</label>
                    <input type="text" hidden id="records_status" name="records_status" value="<?php echo $records_incoming; ?>">
                    <select id="source_doc" name="source_doc" class="w-full form-control">
                        <?php if ($records_incoming == 1) : ?>
                            <optgroup label="External">
                                <?php foreach ($all_sources as $all_source) : ?>
                                    <?php if ($all_source['ds_type'] == 1) : ?>
                                        <option value="<?php echo $all_source['ds_id']; ?>"><?php echo $all_source['ds_name']; ?></option>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </optgroup>
                            <optgroup label="Others">
                                <?php foreach ($all_sources as $all_source) : ?>
                                    <?php if ($all_source['ds_type'] == 2) : ?>
                                        <option value="">Please Select</option>
                                        <option value="<?php echo $all_source['ds_id']; ?>"><?php echo $all_source['ds_name']; ?></option>
                                    <?php endif ?>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php else : ?>
                            <?php switch ($this->session->userdata('staff_division')) {
                                case 2:
                                    $dd_id = "2";
                                    $dd_text = 'PPRD - Policy, Planning, and Research Division';
                                    break;
                                case 3:
                                    $dd_id = "3";
                                    $dd_text = 'LID - Localization and Institutional Division';
                                    break;
                                case 4:
                                    $dd_id = 4;
                                    $dd_text = 'MISU - Management Information Systems Unit';
                                    break;
                                case 5:
                                    $dd_id = "5";
                                    $dd_text = 'AFD - Administrative and Finance Division';
                                    break;
                                case 6:
                                    $dd_id = "6";
                                    $dd_text = 'PAIO - Public Affairs and Information Office';
                                    break;
                                case 7:
                                    $dd_id = "7";
                                    $dd_text = 'OED - Office of the Executive Director';
                                    break;
                                case 8:
                                    $dd_id = "8";
                                    $dd_text = 'ODED - Office of the Deputy Executive Director';
                                    break;
                                case 9:
                                    $dd_id = "9";
                                    $dd_text = 'PMO - Project Management Office';
                                    break;
                                case 10:
                                    $dd_id = "10";
                                    $dd_text = 'MED - Monitoring and Evalution Division';
                                    break;
                                default:
                                    echo "ERROR";
                                    break;
                            } ?>
                            <?php foreach ($all_sources as $all_source) : ?> <!-- Here is the code use for the Select Option-->
                                <?php if ($all_source['ds_id'] == $this->session->userdata('staff_division')) : ?>
                                    <option value="<?php echo $all_source['ds_id']; ?>" selected><?php echo $all_source['ds_name']; ?></option>
                                <?php endif ?>
                            <?php endforeach; ?>
                            <!-- <option value="<?php echo $dd_id; ?>" selected><?php echo $dd_text; ?></option> -->
                            <!-- <optgroup label="Internal"> 
                                          <?php foreach ($all_sources as $all_source) : ?>
                                                <?php if ($all_source['ds_type'] == 0) : ?>
                                                <option value="<?php echo $all_source['ds_id']; ?>"><?php echo $all_source['ds_sub']; ?> - <?php echo $all_source['ds_name']; ?></option>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                        </optgroup>
                                        <optgroup label="External">
                                          <?php foreach ($all_sources as $all_source) : ?>
                                                <?php if ($all_source['ds_type'] == 1) : ?>
                                                <option value="<?php echo $all_source['ds_id']; ?>"><?php echo $all_source['ds_sub']; ?> - <?php echo $all_source['ds_name']; ?></option>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                        </optgroup>
                                        <optgroup label="Others">
                                          <?php foreach ($all_sources as $all_source) : ?>
                                                <?php if ($all_source['ds_type'] == 2) : ?>
                                                <option value="<?php echo $all_source['ds_id']; ?>"><?php echo $all_source['ds_name']; ?></option>
                                                <?php endif ?>
                                            <?php endforeach; ?>
                                        </optgroup> -->
                        <?php endif ?>
                    </select>
                </div>

                <!-- if the select is not in the list -->
                <div class="form-inline mt-5" id="not_listed" style="display: none">
                    <label for="not_liste" class="form-label sm:w-40" style="text-align: left;">New Document Source</label>
                    <textarea placeholder="Enter New Document Source" id="not_liste" name="not_liste" class="form-control" minlength="8"></textarea>
                </div>

                <!-- Subject Title -->
                <div class="form-inline mt-5">
                    <label for="sub_title" class="form-label sm:w-40" style="text-align: left;">Subject Title</label>
                    <textarea placeholder="Enter Subject Title" id="sub_title" name="sub_title" class="form-control" required></textarea>
                </div>


                <!-- Upload Scan -->
                <div class="form-inline mt-5">
                    <label for="files" class="form-label sm:w-40" style="text-align: left;">Upload Scan</label>
                    <div id="multiple-file-upload" class="form-control">
                        <div class="preview">
                            <div class="fallback">
                                <input type="file" class="upload" id="files" <?php if (!empty($files_array)) {
                                                                                    if (count($files_array) >= 10) {
                                                                                        echo 'disabled';
                                                                                    }
                                                                                } ?> accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,application/vnd.ms-excel" name="files[]" onchange="readURL(this);" multiple />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Check box for type of document -->
                <div class="form-inline mt-5">
                    <label for="moredocs" class="form-label sm:w-40" style="text-align: left;">Multiple Documents</label>
                    <div class="form-check">
                        <input id="moredocs" name="moredocs" class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="checkbox-switch-1">If more than one document please check this box</label>
                    </div>
                </div>

                <!-- type of Document single -->
                <div class="form-inline mt-5" id="action_solo">
                    <label for="type_doc" class="form-label sm:w-40" style="text-align: left;">Type of Document</label>
                    <select data-search="true" id="type_doc" name="type_doc" class="tail-select w-full form-control">
                        <optgroup label="Type of Document">
                            <option value="0">Select</option>
                            <?php foreach ($type_documents as $type_document) : ?>
                                <option value="<?php echo $type_document['dt_id']; ?>"><?php echo $type_document['dt_name']; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>

                <!-- type of Document multi -->
                <div class="form-inline mt-5" id="action_multi" style="display: none">
                    <label for="type_docs" class="form-label sm:w-40" style="text-align: left;">Type of documents</label>
                    <select data-placeholder="Select Type of documents" data-search="true" class="tail-select w-full form-control" id="type_docs" name="type_docs[]" multiple>
                        <optgroup label="Type of documents">
                            <?php foreach ($type_documents as $type_document) : ?>
                                <option value="<?php echo $type_document['dt_id']; ?>"><?php echo $type_document['dt_name']; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>


                <!-- Required Action -->
                <div class="form-inline mt-5">
                    <label for="action_taken" class="form-label sm:w-40" style="text-align: left;">Required Action</label>
                    <select data-placeholder="Select Required Action" data-search="true" class="tail-select w-full form-control" id="action_taken" name="action_taken[]" multiple>
                        <optgroup label="Required Actions">
                            <?php foreach ($type_action_takens as $type_action_taken) : ?>
                                <option value="<?php echo $type_action_taken['da_id']; ?>"><?php echo $type_action_taken['da_name']; ?></option>
                            <?php endforeach; ?>
                        </optgroup>
                    </select>
                </div>

                <!-- Document Recieved Date -->
                <div class="form-inline mt-5">
                    <?php date_default_timezone_set('Asia/Manila');
                    $date_now = date('Y-m-d H:i:s');
                    $picker = date("M-d-Y h:i A", strtotime($date_now)); ?>
                    <?php if ($this->session->userdata('staff_position') == 'Records Officer I' || $this->session->userdata('staff_position') == 'Records Officer II') : ?>
                        <label for="datepicker" class="form-label sm:w-40" style="text-align: left;">Document Created Date</label>
                    <?php else : ?>
                        <label for="datepicker" class="form-label sm:w-40" style="text-align: left;">Document Sent Date</label>
                    <?php endif ?>
                    <input type="text" class="form-control" value="<?php echo $picker; ?>" disabled>
                    <input id="datepicker" name="datepicker" type="hidden" class="form-control" value="<?php echo $picker; ?>">
                </div>

                <div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;">Route to Divsion/Unit</label>
                    </div>
                    <?php foreach ($all_sources as $all_source) : ?>
                        <?php if ($all_source['ds_id'] != 1) : ?>
                            <div class="form-inline mt-5">
                                <label class="form-label sm:w-40" style="text-align: left;"></label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="<?php echo $all_source['ds_id']; ?>" name="div_unit[]" value="<?php echo $all_source['ds_code']; ?>">
                                    <label class="form-check-label" for="<?php echo $all_source['ds_id']; ?>"><?php echo $all_source['ds_name']; ?></label>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </div>
                <!-- division checkboxs -->
                <!-- <div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;">Route to Divsion/Unit</label>
                        <div class="form-check">
                            <input id="div1" class="form-check-input" type="checkbox" name="div_unit[]" value="OED">
                            <label class="form-check-label" for="div1">Office of Executive Director</label>
                        </div>
                    </div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;"></label>
                        <div class="form-check">
                            <input id="div2" class="form-check-input" type="checkbox" name="div_unit[]" value="ODED">
                            <label class="form-check-label" for="div2">Office of Deputy Executive Director</label>
                        </div>
                    </div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;"></label>
                        <div class="form-check">
                            <input id="div3" class="form-check-input" type="checkbox" name="div_unit[]" value="PPRD">
                            <label class="form-check-label" for="div3">Policy, Planning and Research Division</label>
                        </div>
                    </div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;"></label>
                        <div class="form-check">
                            <input id="div4" class="form-check-input" type="checkbox" name="div_unit[]" value="LID">
                            <label class="form-check-label" for="div4">Localization and Institutional Division</label>
                        </div>
                    </div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;"></label>
                        <div class="form-check">
                            <input id="div5" class="form-check-input" type="checkbox" name="div_unit[]" value="AFD">
                            <label class="form-check-label" for="div5">Administrative and Finance Division</label>
                        </div>
                    </div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;"></label>
                        <div class="form-check">
                            <input id="div6" class="form-check-input" type="checkbox" name="div_unit[]" value="PAIO">
                            <label class="form-check-label" for="div6">Public Affairs and Informations Office</label>
                        </div>
                    </div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;"></label>
                        <div class="form-check">
                            <input id="div7" class="form-check-input" type="checkbox" name="div_unit[]" value="MISU">
                            <label class="form-check-label" for="div7">Management Information System Unit</label>
                        </div>
                    </div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;"></label>
                        <div class="form-check">
                            <input id="div8" class="form-check-input" type="checkbox" name="div_unit[]" value="PMO">
                            <label class="form-check-label" for="div8">Project Management Office</label>
                        </div>
                    </div>
                    <div class="form-inline mt-5">
                        <label class="form-label sm:w-40" style="text-align: left;"></label>
                        <div class="form-check">
                            <input id="div9" class="form-check-input" type="checkbox" name="div_unit[]" value="MED">
                            <label class="form-check-label" for="div9">Monitoring and Evaluation Division</label>
                        </div>
                    </div>
                </div> -->
                <!-- end of division checkboxs -->
                <!-- Concern Staff -->
                <div class="form-inline mt-5">
                    <label for="staff_details" class="form-label sm:w-40" style="text-align: left;">Concern Staff/s</label>
                    <select data-placeholder="Select Concern Staffs" data-search="true" class="tail-select w-full form-control" id="staff_details" name="staff_details[]" multiple required>
                        <?php foreach ($staffs as $staff) : ?>
                            <?php $dev = $this->dts->get_s_division($staff['division']); ?>
                            <optgroup label="<?php echo $dev['sd_name']; ?>">
                                <?php if ($staff['lname'] == $this->session->userdata('staff_lname')) :  ?>
                                    <option value="<?php echo $staff['staff_id']; ?>" selected>
                                        <?php echo $staff['fname']; ?> <?php echo $staff['lname']; ?>
                                    </option>
                                <?php else : ?>
                                    <option value="<?php echo $staff['staff_id']; ?>">
                                        <?php echo $staff['fname']; ?> <?php echo $staff['lname']; ?>
                                    </option>
                                <?php endif ?>

                            </optgroup>
                        <?php endforeach; ?>
                    </select>
                </div>
               

                <!-- Subject Title -->
                <div class="form-inline mt-5">
                    <label for="editor1" class="form-label sm:w-40" style="text-align: left;">Notes / Remarks</label>
                    <textarea placeholder="Enter Notes / Remarks" id="editor1" name="editor1" class="form-control" required></textarea>
                </div>
            </div>
            <div class="text-right mt-5">
                <button type="submit" id="submit-btn" class="btn btn-primary w-60 mr-2 mb-2 confirm_id"> <i data-feather="activity" class="w-4 h-4 mr-2"></i> Route Document </button>
            </div>
        </div>
        <?php echo form_close(); ?>

    </div>
    <!-- END: Post Info -->
</div>
<!-- END: Content -->

<?php $this->load->view('admin/partials/footer.php'); ?>

<script>
    document.getElementById('staffForm').addEventListener('submit', function(event) {
        const staffDetails = document.getElementById('staff_details');
        const typeDoc = document.getElementById('type_doc');
        const actionTaken = document.getElementById('action_taken');
        var checkboxes = document.querySelectorAll('input[name="div_unit[]"]');
        var checked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!checked) {
            Swal.fire({
                icon: 'error',
                text: 'Please select division/s to route the document',
            });
            event.preventDefault(); // Prevent form submission
        }

        if (staffDetails.selectedOptions.length < 2) {
            Swal.fire({
                icon: 'error',
                text: 'Please select at least two staff members.',
            });
            event.preventDefault(); // Prevent form submission
            return;
        }

        const selectedTypeDoc = Array.from(typeDoc.selectedOptions).map(option => option.value);
        if (selectedTypeDoc.includes("0")) {
            Swal.fire({
                icon: 'error',
                text: 'Please select at least one type of document.',
            });
            event.preventDefault(); // Prevent form submission
            return;
        }

        if (actionTaken.selectedOptions.length === 0) {
            Swal.fire({
                icon: 'error',
                text: 'Please select at least one required action.',
            });
            event.preventDefault(); // Prevent form submission
            return;
        }
    });
</script>

<!-- Limit Max file size upload -->
<script type="text/javascript">
    var uploadField = document.getElementById("files[]");

    uploadField.onchange = function() {
        if (this.files[0].size > 20971520) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'File is too big! Max size is 20mb.',
            });
            this.value = "";
        };
    };
</script>

<?php if ($this->session->flashdata('success')) : ?>
    <script type="text/javascript">
        Swal.fire({
            title: '<strong> SUCCESSFUL! </strong>',
            icon: 'success',
            html: 'New Records has been Added!',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
            confirmButtonAriaLabel: 'Thumbs up, great!'
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('#moredocs').change(function() {
            if (this.checked) {
                $("#action_multi").show(1000);
                $("#action_solo").hide(1000);
            } else {
                $("#action_solo").show(1000);
                $("#action_multi").hide(1000);
                $("#type_docs").find('option:selected').prop('selected', false);;
            }
        });
    });
</script>


<script type="text/javascript">
    $(function() {
        $("#source_doc").change(function(event) {
            if (event.target.value == '1') {
                $("#not_listed").show(1000); //show if option 'select' is not selected
                Swal.fire(
                    'New Source Document?',
                    'Please Enter The name of Source Document',
                    'question'
                );
            } else {
                $("#not_listed").hide(1000); //hide if option 'select' is selected
            }
        });
    });
</script>

<script type="text/javascript">
    $('.confirm_id').on('click', function(e) {
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