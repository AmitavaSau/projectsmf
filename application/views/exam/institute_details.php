<section class="py-3">
    <div class="card">
        <div class="row justify-content-center" style="padding: 20px;">
            <div class="col-lg-12 col-sm-12 col-xs-12 " style="background-color: #4367d247;padding: 10px;">
                <p style="font-size: 20px;  font-weight: bold;  color: #a30d69;  text-align: center;">Centre-in-charge
                    Details
                </p>
                <div id="" class="m-t-30">
                    <?php
                    $form = array(
                        'class'                    =>    'form-material',
                        'data-toggle'            =>    'validator',
                        'role'                    =>    'form',
                        'id'                     =>     'institute_edit',
                        'data-parsley-validate'    =>    ''
                    );
                    echo form_open_multipart('examMarks/institute_details_save', $form);

                    ?>

                    <div class="row mt-30 ">
                        <div class="form-group col-md-2">
                            <label class="control-label">Name of the Centre-in-Charge:</label>

                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" id="col_center_in_charge_name" name="col_center_in_charge_name"
                                class="form-control col_center_in_charge_name "
                                value="<?php echo $cand_details[0]['col_center_in_charge_name'] ?>"
                                placeholder="Name of the Centre-in-Charge">
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label">Designation of Centre-in-Charge:</label>

                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" id="col_center_in_charge_designation"
                                name="col_center_in_charge_designation"
                                class="form-control col_center_in_charge_designation"
                                value="<?php echo $cand_details[0]['col_center_in_charge_designation'] ?>"
                                placeholder="Designation of Centre-in-Charge">
                        </div>
                    </div>

                    <div class="row">

                        <div class="form-group col-md-2">
                            <label class="control-label">Name of the Institution:</label>

                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" id="col_name" name="col_name" class="form-control col_name"
                                value="<?php echo $cand_details[0]['col_name'] ?>"
                                placeholder="Name of the Institution/ College" readonly>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label">State:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" id="col_center_state" name="col_center_state"
                                class="form-control col_center_state" value='WEST BENGAL' readonly>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="form-group col-md-2">
                            <label class="control-label">Address 1:</label>

                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" id="col_center_address_1" name="col_center_address_1"
                                class="form-control col_center_address_1"
                                value="<?php echo $cand_details[0]['col_center_address_1'] ?>" placeholder="Address">
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label">Address 2:</label>

                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" id="col_center_address_2" name="col_center_address_2"
                                class="form-control col_center_address_2"
                                value="<?php echo $cand_details[0]['col_center_address_2'] ?>" placeholder="Address">
                        </div>

                    </div>

                    <div class="row">


                        <div class="form-group col-md-2">
                            <label class="control-label">District:</label>
                        </div>
                        <div class="form-group col-md-4">
                            <?php
                            $dist_extra = array(
                                'id'    =>     'col_center_dist',
                                'class' =>     'form-control col_center_dist'
                            );
                            echo form_dropdown('col_center_dist', $dist_drp, $cand_details[0]['col_center_dist'], $dist_extra);
                            ?>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label">Pin Code:</label>

                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" id="col_center_pin" name="col_center_pin"
                                class="form-control col_center_pin input-number"
                                value="<?php echo $cand_details[0]['col_center_pin'] ?>" placeholder="Pin Code"
                                maxlength="6">
                        </div>

                    </div>

                    <div class="row ">
                        <div class="form-group col-md-2">
                            <label class="control-label">Mobile: </label>

                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" id="col_center_mob" name="col_center_mob"
                                class="form-control col_center_mob input-number"
                                value="<?php echo $cand_details[0]['col_center_mob'] ?>" placeholder="Mobile "
                                maxlength="10">
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label">Email: </label>

                        </div>

                        <div class="form-group col-md-4">
                            <input type="text" id="col_center_email" name="col_center_email"
                                class="form-control col_center_email"
                                value="<?php echo $cand_details[0]['col_center_email'] ?>" placeholder="Email ">
                        </div>

                    </div>


                    <div class="row py-3 ">

                        <div class="form-group col-md-12 text-center ">
                            <br>


                            <button type="button" class="btn btn-info ml-2 btn-save-institute-details">Save</button>
                            <a class="btn ml-2" style="background-color: #a84184fc;" href="
                                <?php echo $this->config->base_url(); ?>dashboard" class="link">Cancel</a>

                            <p style="margin-top: 16px;font-size: 16px;color: #db0913;font-weight: bold;"> Note : Once
                                Centre-in-charge Details are filled and saved, you will be able to fill the
                                Examiner's details .</p>

                        </div>


                    </div>


                    </form>
                </div>


            </div>

            <?php if ($cand_details[0]['col_center_mob'] != '') {  ?>
            <div class="col-lg-12 col-sm-12 col-xs-12 "
                style="background-color: #2dee6f47;margin-top:20px;padding: 10px;">

                <p style="font-size: 20px;  font-weight: bold;  color: #a30d69;  text-align: center;">Examiners Details
                </p>


                <div class="row mt-3">
                    <div class="col-md-9">
                        <!-- <h5>Details of Examiners </h5> -->

                    </div>
                    <div class="col-md-3 text-right mt-1">
                        <button type="button" data-toggle="modal" data-target="#Modal_examiner"
                            class="btn btn-warning text-right" id="addExaminerButton"><i class="fa fa-plus"></i> Add
                            Details</button>

                    </div>
                    <div class="col-md-12 mt-4">
                        <table class="table table-bordered table-striped " style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl No. </th>
                                    <th>Exam </th>
                                    <th>Examiner </th>
                                    <th>Course</th>
                                    <th>Mention Paper</th>
                                    <th>Examiner Name</th>
                                    <th>Examiner Designation </th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_data_examiner"></tbody>
                        </table>

                    </div>
                </div>



            </div>

            <!-- Modal -->
            <div class="modal fade" id="Modal_examiner" tabindex="-1" role="dialog" aria-labelledby="expModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="examinerForm">
                            <div class="modal-header">
                                <h5 class="modal-title" id="expModalLabel">Examiner Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="examiner_id" name="examiner_id">

                                <!-- Example of inline labels and fields -->
                                <div class="form-group row">
                                    <label for="examiner_exam" class="col-sm-3 col-form-label">Exam</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $exam_extra = array(
                                                'id'    =>     'examiner_exam',
                                                'class' =>     'form-control examiner_exam'
                                            );
                                            echo form_dropdown('examiner_exam', $exam_drp, null, $exam_extra);
                                            ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="examiner_type" class="col-sm-3 col-form-label">Examiner</label>
                                    <div class="col-sm-9">

                                        <?php
                                            $type_extra = array(
                                                'id'    =>     'examiner_type',
                                                'class' =>     'form-control examiner_type'
                                            );
                                            echo form_dropdown('examiner_type', $type_drp, null, $type_extra);
                                            ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="examiner_course" class="col-sm-3 col-form-label">Course</label>
                                    <div class="col-sm-9">

                                        <?php
                                            $crs_extra = array(
                                                'id'    =>     'examiner_course',
                                                'class' =>     'form-control examiner_course'
                                            );
                                            echo form_dropdown('examiner_course', $course, null, $crs_extra);
                                            ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="examiner_paper" class="col-sm-3 col-form-label">Mention Paper</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="examiner_paper" name="examiner_paper"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="examiner_name" class="col-sm-3 col-form-label">Examiner Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="examiner_name" name="examiner_name" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="examiner_designation"
                                        class="col-sm-3 col-form-label">Designation</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="examiner_designation" name="examiner_designation"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="examiner_mob" class="col-sm-3 col-form-label">Mobile No.</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="examiner_mob" name="examiner_mob"
                                            class="form-control input-number" maxlength="10" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="examiner_email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" id="examiner_email" name="examiner_email"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <?php } ?>



</section>





<?php
$this->load->view("common/footer");
?>

<script>
loadExaminerData();

$('#addExaminerButton').on('click', function() {
    $('#examinerForm')[0].reset(); // Clear the form
    $('#examiner_id').val(''); // Clear the hidden ID field
    $('#Modal_examiner').modal('show'); // Show the modal
});


function loadExaminerData() {
    $.ajax({
        url: 'fetch_examiners',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            let tableRows = '';
            let rowNumber = 1;
            response.forEach(function(examiner) {
                tableRows += `
                    <tr>
                    <td>${rowNumber}</td>
                        <td>${examiner.examiner_exam}</td>
                        <td>${examiner.examiner_type}</td>
                        <td>${examiner.examiner_course}</td>
                        <td>${examiner.examiner_paper}</td>
                        <td>${examiner.examiner_name}</td>
                        <td>${examiner.examiner_designation}</td>
                        <td>${examiner.examiner_mob}</td>
                        <td style="max-width:200px">${examiner.examiner_email}</td>
                        <td>
                            <div class="d-flex" >
                                <button style="padding: 0.25rem 0.5rem; margin-right:4px" class="btn btn-sm btn-info edit" data-id="${examiner.examiner_id }">Edit</button>
                                <button style="padding: 0.25rem 0.5rem;" class="btn btn-sm btn-danger delete" data-id="${examiner.examiner_id }">Delete</button>
                            </div>
                        </td>
                    </tr>
                `;
                rowNumber++;
            });

            $('#tbl_data_examiner').html(tableRows);
        },
        error: function() {
            alert('Failed to load data.');
        }
    });
}


$('#examinerForm').on('submit', function(e) {

    e.preventDefault();
    error_exam = false;

    var pattern = /^[a-zA-Z0-9 \-\/.]+$/;

    var examiner_exam = $("#examiner_exam").val();
    hideError("examiner_exam");
    if (examiner_exam.trim() == "") {
        showError("examiner_exam", "Required");
        error_exam = true;
    }

    var examiner_type = $("#examiner_type").val();
    hideError("examiner_type");
    if (examiner_type.trim() == "") {
        showError("examiner_type", "Required");
        error_exam = true;
    }

    var examiner_course = $("#examiner_course").val();
    hideError("examiner_course");
    if (examiner_course.trim() == "") {
        showError("examiner_course", "Required");
        error_exam = true;
    }

    var examiner_paper = $("#examiner_paper").val();
    hideError("examiner_paper");
    if (examiner_paper.trim() == "") {
        showError("examiner_paper", "Required");
        error_exam = true;
    }

    var examiner_name = $("#examiner_name").val();
    hideError("examiner_name");
    if (examiner_name.trim() == "") {
        showError("examiner_name", "Required");
        error_exam = true;
    }

    var examiner_mob = $("#examiner_mob").val();
    hideError("examiner_mob");
    if (examiner_mob.trim() == "") {
        showError("examiner_mob", "Required");
        error_exam = true;
    } else if (examiner_mob.length != 10) {
        showError("examiner_mob", "Mobile Number is not valid");
        error_exam = true;
    }

    var examiner_email = $("#examiner_email").val();
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    hideError("examiner_email");
    if (examiner_email.trim() == "") {
        showError("examiner_email", "Required");
        error_exam = true;
    } else if (!regex.test(examiner_email)) {
        showError("examiner_email", "Email is not valid");
        error_exam = true;
    }



    if (!error_exam) {

        const formData = $(this).serialize();
        const id = $('#examiner_id').val();
        const url = 'save_examiner';

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            success: function(response) {
                $('#Modal_examiner').modal('hide');
                loadExaminerData();
                swal("Saved!", response.message, "success");
            },
            error: function(xhr) {
                alert('Something went wrong!');
            }
        });

    }
});

$(document).on('click', '.edit', function() {
    const id = $(this).data('id');
    $.ajax({
        url: 'get_examiner/' + id, // Replace with your CodeIgniter URL
        method: 'GET',
        dataType: 'json',
        success: function(examiner) {
            $('#examiner_id').val(examiner.examiner_id);
            $('#examiner_exam').val(examiner.examiner_exam);
            $('#examiner_type').val(examiner.examiner_type);
            $('#examiner_course').val(examiner.examiner_course);
            $('#examiner_paper').val(examiner.examiner_paper);
            $('#examiner_name').val(examiner.examiner_name);
            $('#examiner_designation').val(examiner.examiner_designation);
            $('#examiner_mob').val(examiner.examiner_mob);
            $('#examiner_email').val(examiner.examiner_email);
            $('#Modal_examiner').modal('show');
        }
    });
});


$(document).on('click', '.delete', function(e) {
    const id = $(this).data('id');
    swal({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#F0404C",
            confirmButtonText: "Yes, I am sure!",
            cancelButtonText: "No, cancel it!",
            closeOnConfirm: true,
            closeOnCancel: true,
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: 'delete_examiner/' + id,
                    method: 'DELETE',
                    dataType: 'json',
                    success: function(response) {

                        loadExaminerData();

                    },
                    error: function() {
                        swal("Error!", "Something went wrong while deleting the examiner.",
                            "error");
                    }
                });
            } else {
                e.preventDefault();
            }
        }
    );



});
</script>