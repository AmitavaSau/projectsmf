<style>
.table td,
.table th {
    padding: 2px 2px;
    vertical-align: middle;
    text-align: center;
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<section class="py-3">
    <div class="row mb-4">
        <div class="col-lg-12 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Final Award Sheet</h2>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="form-group col-md-1">
                            <label class="control-label">College:</label>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            $inst_code_extra = array(
                                'id'    =>     'inst_code',
                                'class' =>     'form-control inst_code'
                            );
                            echo form_dropdown('inst_code', $college, $inst_code, $inst_code_extra);
                            ?>


                        </div>
                        <div class="form-group col-md-1">
                            <label class="control-label">Course:</label>
                        </div>
                        <div class="form-group col-md-2">
                            <?php
                            $course_name_extra = array(
                                'id'    =>     'course_name',
                                'class' =>     'form-control course_name'
                            );
                            echo form_dropdown('course_name', $course, $course_name, $course_name_extra);
                            ?>


                        </div>

                        <div class="form-group col-md-2">
                            <button class="btn btn-dark final_award_sheet_search" type="button"
                                name="search">Search</button>
                        </div>
                    </div>

                    <br>


                    <table id="candidate_basic_listing"
                        class="table table-striped table-bordered table-hover responsive datatbl" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Application No</th>
                                <th>Roll No</th>
                                <th>Reg No</th>
                                <th>Student Name</th>
                                <th>Duration of Practical Training </th>
                                <th>Total No of Hours </th>
                                <th>Year of Passing</th>
                                <th>Award Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (!empty($all_detail)) {
                                $n = 1;
                                foreach ($all_detail as $can) {
                            ?>


                            <tr>
                                <td><?php echo $n; ?></td>
                                <td><?php echo $can['award_code']; ?></td>
                                <td><?php echo $can['award_roll_no']; ?></td>
                                <td><?php echo $can['award_reg_no']; ?></td>
                                <td><?php echo $can['award_student_name']; ?></td>

                                <td>
                                    <input type="text" id="award_duration_practical_from"
                                        name="award_duration_practical_from"
                                        value="<?php echo $can['award_duration_practical_from'] ?>"
                                        class="form-control award_duration_practical_from as_date" readonly>
                                    <span>to</span>
                                    <input type="text" id="award_duration_practical_to"
                                        name="award_duration_practical_to"
                                        value="<?php echo $can['award_duration_practical_to'] ?>"
                                        class="form-control award_duration_practical_to as_date" readonly>


                                </td>


                                <td>
                                    <input type="text" id="award_total_hours" name="award_total_hours"
                                        value="<?php echo $can['award_total_hours'] ?>"
                                        class=" form-control award_total_hours input-number" maxlength="6">
                                </td>
                                <!-- <td>

                                    <input type="text" id="award_period_practical_from"
                                        name="award_period_practical_from"
                                        value="<?php echo $can['award_period_practical_from'] ?>"
                                        class="form-control award_period_practical_from as_date" readonly>
                                    <span>to</span>
                                    <input type="text" id="award_period_practical_to" name="award_period_practical_to"
                                        value="<?php echo $can['award_period_practical_to'] ?>"
                                        class="form-control award_period_practical_to as_date" readonly>

                                </td> -->

                                <td>

                                    <?php
                                            $year_extra = array(
                                                'id'    =>     'award_year_of_passing',
                                                'class' =>     'form-control award_year_of_passing'
                                            );
                                            echo form_dropdown('award_year_of_passing', $year_drp,   $can['award_year_of_passing'], $year_extra);
                                            ?>
                                </td>

                                <td>
                                    <input type="text" id="award_date" name="award_date"
                                        value="<?php echo $can['award_date'] ?>" class="form-control award_date as_date"
                                        readonly>
                                </td>

                                <td>
                                    <input type="hidden" name='award_code' id='award_code' class="award_code"
                                        value="<?php echo $can['award_code']; ?>">
                                    <button type="button" data-count="<?php echo $n; ?>"
                                        class="btn btn-info final_award_sheet_save">SAVE</button>
                                </td>
                            </tr>
                            <?php
                                    $n++;
                                }
                            } else {

                                ?>
                            <tr>
                                <td colspan="10" class="text-center">No data found.</td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <?php
                    if (!empty($all_detail)) {
                    ?>

                    <div class="form-group mt-3">
                        <a class="btn btn-warning btn-sm download_report_award_sheet">DOWNLOAD</a>
                    </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>



<?php
$this->load->view("common/footer");
?>