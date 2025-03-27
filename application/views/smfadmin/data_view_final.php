<?php
//echo '<pre>';
//print_r($_SESSION);
?>
<?php if ($cand_code != "") { ?>

<style>
label {
    font-size: 12px
}
</style>


<section class="py-3">
    <div class="card">

        <div class="row justify-content-center" style="padding: 40px;">
            <!-- <p style="font-size: 25px;  font-weight: bold;  color: #a30d69;  text-align: center;">State Medical Faculty
                of West Bengal
            </p> -->
            <div class="col-lg-10 col-sm-10 col-xs-10">
                <div id="" class="m-t-30">

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Name:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_name'] ?></label>


                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Father's Name:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_fname'] ?></label>


                        </div>


                    </div>

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Regitration No:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_reg_no'] ?></label>


                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Registration Date:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_reg_date'] ?></label>


                        </div>


                    </div>

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Category:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_category'] ?></label>


                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Date of Birth:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_dob'] ?></label>


                        </div>


                    </div>

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Contact No:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_mob'] ?></label>


                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Email Id:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_email'] ?></label>


                        </div>


                    </div>

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Permanent Address:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_address1'] ?></label>
                            <label class="control-label"><?php echo $cand_details[0]['view_address2'] ?></label>
                            <label class="control-label"><?php echo $cand_details[0]['view_address3'] ?></label>


                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Institue Name:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_inst_name'] ?></label>


                        </div>


                    </div>

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Course:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_course_name'] ?></label>


                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Admission Date:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_adm_date'] ?></label>


                        </div>


                    </div>

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Admit Card Issue Date:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_preliminary_exam'] ?></label>


                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Status:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label
                                class="control-label"><?php echo $cand_details[0]['view_preliminary_status'] ?></label>


                        </div>


                    </div>

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Admit Card Issue Date:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_final_exam'] ?></label>


                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Status:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_final_status'] ?></label>


                        </div>
                    </div>

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Provisional Certificate Date:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label
                                class="control-label"><?php echo $cand_details[0]['view_provisional_certificate'] ?></label>


                        </div>


                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Award Date:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label class="control-label"><?php echo $cand_details[0]['view_award_date'] ?></label>


                        </div>
                    </div>

                    <div class="row ">

                        <div class="form-group col-md-2">
                            <label class="control-label"><b>Final Certificate Date:</b></label>
                            <br />
                        </div>
                        <div class="form-group col-md-4">
                            <label
                                class="control-label"><?php echo $cand_details[0]['view_final_certificate_date'] ?></label>


                        </div>


                    </div>

                    <div class="row mt-3">
                        <div class="form-group col-md-3">
                            <label class="control-label">
                                Photograph
                            </label>
                            <br />
                            <img height='96'
                                src="<?php echo base_url('upload/smf_final_document/photo/smf_' . $cand_details[0]['view_cand_code'] . '_p.jpg') ?>" />
                        </div>
                        <div class="form-group col-md-3">

                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">
                                Signature
                            </label>
                            <br />
                            <img height='48'
                                src="<?php echo base_url('upload/smf_final_document/signature/smf_' . $cand_details[0]['view_cand_code'] . '_s.jpg') ?>" />


                        </div>
                    </div>


                    <input type="hidden" name="view_cand_code" id="view_cand_code"
                        value="<?php echo $cand_details[0]['view_cand_code'] ?>">




                </div>


            </div>

            <div class="col-lg-12 col-sm-12 col-xs-12 " style="margin-top:20px;padding: 10px;">

                <p style="font-size: 20px;  font-weight: bold;  color: #a30d69;  text-align: center;">Remarks
                </p>


                <div class="row mt-3">
                    <div class="col-md-9">
                        <!-- <h5>Details of Examiners </h5> -->

                    </div>
                    <div class="col-md-3 text-right mt-1">
                        <button type="button" data-toggle="modal" data-target="#Modal_remarks"
                            class="btn btn-warning text-right" id="addRemarksButton"><i class="fa fa-plus"></i>
                            Add Remarks</button>

                    </div>
                    <div class="col-md-12 mt-4">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">Sl No. </th>
                                    <th width="50%">Remarks </th>
                                    <th width="20%">Remarks Date & Time</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_data_remarks"></tbody>
                        </table>

                    </div>
                </div>



            </div>

            <!-- Modal -->
            <div class="modal fade" id="Modal_remarks" tabindex="-1" role="dialog" aria-labelledby="expModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="Form">
                            <div class="modal-header">
                                <h5 class="modal-title" id="expModalLabel">Remarks Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="rmks_id" name="rmks_id">

                                <!-- Example of inline labels and fields -->
                                <div class="form-group row">
                                    <label for="rmks_remarks" class="col-sm-3 col-form-label">Remarks</label>
                                    <div class="col-sm-9">
                                        <textarea id="rmks_remarks" name="rmks_remarks" class="form-control" rows="4"
                                            style="width: 300px;" required> </textarea>

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

            <div class="row py-3 ">
                <div class="form-group col-md-12 text-center ">
                    <br>
                    <a class="btn ml-2" style="background-color: #a84184fc;" href="
                                <?php echo $this->config->base_url(); ?>smfAdmin/data_viewing_final"
                        class="link">Back</a>
                </div>
            </div>



</section>

<?php
} else {
?>
<section class="py-3">
    <div class="card">
        <div class="row justify-content-center" style="padding: 40px;">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div id="" class="m-t-30">
                    <?php
                        $form = array(
                            'class'                    =>    'form-material',
                            'data-toggle'            =>    'validator',
                            'role'                    =>    'form',
                            'id'                     =>     'candsearchform',
                            'data-parsley-validate'    =>    ''
                        );
                        echo form_open_multipart('admin/data_viewing_final', $form);
                        ?>
                    <div class="highlight">
                        <div class="row ">

                            <div class="form-group col-md-4">
                                <?php
                                    $appl_cand_code = array(
                                        'name'            => 'cand_code',
                                        'id'              => 'cand_code',
                                        'value'           => '',
                                        'autocomplete'    =>    'off',
                                        'placeholder'    =>    'Candidate code',
                                        'class'            =>    'col-xs-10 col-sm-10 form-control'
                                    );

                                    echo form_input($appl_cand_code);
                                    ?>

                            </div>
                            <div class="form-group col-md-4">
                                <button type="button" class="btn btn-primary btn-final-search">Search</button>
                                <input type="hidden" name="search" id="search_action" value="SEARCH">

                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">

                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

</section>
<?php
}
$this->load->view("common/footer");
?>

<script>
<?php if ($cand_code != "") { ?>
loadRemarksData();
<?php } ?>

$('#addRemarksButton').on('click', function() {
    $('#Form')[0].reset(); // Clear the form
    $('#rmks_id').val(''); // Clear the hidden ID field
    $('#Modal_remarks').modal('show'); // Show the modal
});


function loadRemarksData() {
    var view_cand_code = $("#view_cand_code").val();
    $.ajax({
        url: '../fetch_remarks_final',
        method: 'GET',
        dataType: 'json',
        data: {
            cand_code: view_cand_code
        },
        success: function(response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            let tableRows = '';
            let rowNumber = 1;
            response.forEach(function(remarks) {
                tableRows += `
                    <tr>
                        <td>${rowNumber}</td>
                        <td>${remarks.rmks_remarks}</td>
                        <td>${remarks.rmks_time}</td>
                        
                        <td>
                            <button class="btn btn-sm btn-info edit" data-id="${remarks.rmks_id  }">Edit</button>
                            <button class="btn btn-sm btn-danger delete" data-id="${remarks.rmks_id  }">Delete</button>
                        </td>
                    </tr>
                `;
                rowNumber++;
            });

            $('#tbl_data_remarks').html(tableRows);
        },
        /* error: function() {
            alert('Failed to load data.');
        } */
    });
}


$('#Form').on('submit', function(e) {

    e.preventDefault();
    error_remarks = false;

    var rmks_remarks = $("#rmks_remarks").val();
    hideError("rmks_remarks");
    if (rmks_remarks.trim() == "") {
        showError("rmks_remarks", "Required");
        error_remarks = true;
    }

    if (!error_remarks) {

        const formData = $(this).serialize();
        const id = $('#rmks_id').val();
        const url = '../save_remarks_final';
        const candCode = $('#view_cand_code').val();

        const finalData = formData + '&rmks_cand_code=' + encodeURIComponent(candCode);

        $.ajax({
            url: url,
            method: 'POST',
            data: finalData,
            success: function(response) {
                $('#Modal_remarks').modal('hide');
                loadRemarksData();
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
        url: '../get_remarks_final/' + id,
        method: 'GET',
        dataType: 'json',
        success: function(remarks) {
            $('#rmks_id').val(remarks.rmks_id);
            $('#rmks_remarks').val(remarks.rmks_remarks);
            $('#Modal_remarks').modal('show');
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
                    url: '../delete_remarks_final/' + id,
                    method: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        loadRemarksData();
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