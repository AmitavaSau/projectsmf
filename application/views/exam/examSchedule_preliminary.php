<section class="py-3">
    <div class="card">
        <div class="row justify-content-center" style="padding: 20px;">
            <div class="col-lg-12 col-sm-12 col-xs-12 " style="background-color: #793a0347;padding: 10px;">

                <p style="font-size: 20px;  font-weight: bold;  color: #a30d69;  text-align: center;">Exam Schedule
                    Details
                </p>


                <div class="row mt-3">
                    <div class="col-md-9">
                        <!-- <h5>Details of Exams </h5> -->

                    </div>
                    <div class="col-md-3 text-right mt-1">
                        <button type="button" data-toggle="modal" data-target="#Modal_exam"
                            class="btn btn-success text-right" id="addExamButton"><i class="fa fa-plus"></i> Add
                            Details</button>

                    </div>
                    <div class="col-md-12 mt-4">
                        <table class="table table-bordered table-striped " style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sl No. </th>
                                    <th>Course Name </th>
                                    <th>Paper</th>
                                    <th>Exam Date</th>
                                    <th>Exam Start Time</th>
                                    <th>Exam End Time </th>
                                    <th>PDF</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_data_exam"></tbody>
                        </table>

                    </div>
                </div>



            </div>

            <!-- Modal -->
            <div class="modal fade" id="Modal_exam" tabindex="-1" role="dialog" aria-labelledby="expModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="examForm" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="expModalLabel">Exam Schedule Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="exam_id" name="exam_id">

                                <div class="form-group row">
                                    <label for="exam_crs_code" class="col-sm-6 col-form-label">Course Name</label>
                                    <div class="col-sm-6">

                                        <?php
                                        $crs_extra = array(
                                            'id'    =>     'exam_crs_code',
                                            'class' =>     'form-control exam_crs_code'
                                        );
                                        echo form_dropdown('exam_crs_code', $course_dropdown, null, $crs_extra);
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exam_paper" class="col-sm-6 col-form-label">Paper</label>
                                    <div class="col-sm-6">

                                        <?php
                                        $paper_extra = array(
                                            'id'    =>     'exam_paper',
                                            'class' =>     'form-control exam_paper'
                                        );
                                        echo form_dropdown('exam_paper', $paper_drp, null, $paper_extra);
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exam_date" class="col-sm-6 col-form-label">Exam Date</label>
                                    <div class="col-sm-6">
                                        <input type="date" id="exam_date" name="exam_date" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exam_start_time" class="col-sm-6 col-form-label">Exam Start Time(24Hours
                                        HH:MM:SS)</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="exam_start_time" name="exam_start_time"
                                            class="form-control" placeholder="Exam End Time (HH:MM:SS)" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exam_end_time" class="col-sm-6 col-form-label">Exam End Time(24Hours
                                        HH:MM:SS)</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="exam_end_time" name="exam_end_time" class="form-control"
                                            placeholder="Exam End Time (HH:MM:SS)" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="exam_pdf" class="col-sm-6 col-form-label">Upload PDF</label>
                                    <div class="col-sm-6">
                                        <input type="file" id="exam_pdf" name="exam_pdf" class="form-control"
                                            accept="application/pdf" required>
                                        <p id="existing_pdf"></p>
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


</section>





<?php
$this->load->view("common/footer");
?>

<script>
$(document).ready(function() {

    loadExamData();

    // Set today's date as the minimum date
    let today = new Date().toISOString().split('T')[0];
    $("#exam_date").attr("min", today);
    $("#exam_date").on("keydown", function(e) {
        e.preventDefault();
    });

    $("#exam_pdf").on("change", function() {
        hideError("exam_pdf")
        let file = this.files[0];
        if (file) {
            let fileType = file.type;
            let fileSize = file.size / 1024 / 1024;

            if (fileType !== "application/pdf") {
                showError("exam_pdf", "Only PDF files are allowed!");
                $(this).val("");
            } else if (fileSize > 5) {
                showError("exam_pdf", "File size must be less than 5MB!");
                $(this).val("");
            }
        }
    });

});





$('#addExamButton').on('click', function() {
    $('#examForm')[0].reset(); // Clear form fields
    $('#exam_id').val(''); // Clear hidden ID field
    $('#existing_pdf').html(''); // Remove existing PDF link
    $('#exam_pdf').attr('required', 'required'); // Make PDF required for new entry
    $('#Modal_exam').modal('show');
});


function loadExamData() {
    $.ajax({
        url: 'fetch_examSchedule_preliminiary',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            let tableRows = '';
            let rowNumber = 1;
            response.forEach(function(exam) {

                let pdfUrl = exam.exam_pdf ? '<?php echo base_url(); ?>' + exam.exam_pdf : null;

                let pdfLink = pdfUrl ?
                    `<a href="${pdfUrl}" target="_blank" class="btn btn-sm btn-primary">View PDF</a>` :
                    'No PDF';


                tableRows += `
                    <tr>
                    <td>${rowNumber}</td>
                        <td>${exam.crs_name}</td>
                        <td>${exam.exam_paper}</td>
                        <td>${exam.exam_date}</td>
                        <td>${exam.exam_start_time}</td>
                        <td>${exam.exam_end_time}</td>
                        <td>${pdfLink}</td>
                        <td>
                            <div class="d-flex" >
                                <button style="padding: 0.25rem 0.5rem; margin-right:4px" class="btn btn-sm btn-info edit" data-id="${exam.exam_id }">Edit</button>
                                <button style="padding: 0.25rem 0.5rem;" class="btn btn-sm btn-danger delete" data-id="${exam.exam_id }">Delete</button>
                            </div>
                        </td>
                    </tr>
                `;
                rowNumber++;
            });

            $('#tbl_data_exam').html(tableRows);
        },
        error: function() {
            alert('Failed to load data.');
        }
    });
}

function isValidTime(time) {
    let timePattern = /^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/;
    return timePattern.test(time);
}


$('#examForm').on('submit', function(e) {

    e.preventDefault();
    error_exam = false;
    var exam_id = $("#exam_id").val();

    var exam_crs_code = $("#exam_crs_code").val();
    hideError("exam_crs_code");
    if (exam_crs_code.trim() == "") {
        showError("exam_crs_code", "Required");
        error_exam = true;
    }

    var exam_paper = $("#exam_paper").val();
    hideError("exam_paper");
    if (exam_paper.trim() == "") {
        showError("exam_paper", "Required");
        error_exam = true;
    }

    var exam_date = $("#exam_date").val();
    hideError("exam_date");
    if (exam_date.trim() == "") {
        showError("exam_date", "Required");
        error_exam = true;
    }

    var exam_start_time = $("#exam_start_time").val();
    hideError("exam_start_time");
    if (exam_start_time.trim() == "") {
        showError("exam_start_time", "Required");
        error_exam = true;
    } else if (!isValidTime(exam_start_time)) {
        showError("exam_start_time", "Invalid time format! Use HH:MM:SS (24-hour format).");
        error_exam = true;
    }

    var exam_end_time = $("#exam_end_time").val();
    hideError("exam_end_time");
    if (exam_end_time.trim() == "") {
        showError("exam_end_time", "Required");
        error_exam = true;
    } else if (!isValidTime(exam_end_time)) {
        showError("exam_end_time", "Invalid time format! Use HH:MM:SS (24-hour format).");
        error_exam = true;
    }

    var exam_pdf = $("#exam_pdf").val();
    hideError("exam_pdf");
    if (!exam_id && exam_pdf === "") {
        showError("exam_pdf", "Required");
        error_exam = true;
    }

    if (!error_exam) {

        const formData = new FormData(this);
        const id = $('#exam_id').val();
        const url = 'save_examSchedule_preliminiary';

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false, // Important for file uploads
            contentType: false,
            success: function(response) {
                console.log(response);

                if (response.success) {
                    $('#Modal_exam').modal('hide');
                    swal("Saved!", response.message, "success");
                    loadExamData();
                } else {
                    swal("Error!", response.message, "error");
                }

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
        url: 'get_examSchedule_preliminiary/' + id, // Replace with your CodeIgniter URL
        method: 'GET',
        dataType: 'json',
        success: function(exam) {
            $('#exam_id').val(exam.exam_id);
            $('#exam_crs_code').val(exam.exam_crs_code);
            $('#exam_paper').val(exam.exam_paper);
            $('#exam_date').val(exam.exam_date);
            $('#exam_start_time').val(exam.exam_start_time);
            $('#exam_end_time').val(exam.exam_end_time);

            if (exam.exam_pdf) {
                $('#existing_pdf').html(`
                    <a href="<?php echo base_url(); ?>/${exam.exam_pdf}" target="_blank">View Existing PDF</a>
                `);
                $('#exam_pdf').removeAttr('required');
            } else {
                $('#existing_pdf').html('');
                $('#exam_pdf').attr('required', 'required');
            }

            $('#Modal_exam').modal('show');
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
                    url: 'delete_examSchedule_preliminiary/' + id,
                    method: 'DELETE',
                    dataType: 'json',
                    success: function(response) {

                        loadExamData();

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