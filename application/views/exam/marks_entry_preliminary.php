<section class="py-3">
    <div class="row mb-4">
        <div class="col-lg-12 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Marks Entry for Preliminary</h2>
                </div>
                <div class="card-body">
                    <!-- search form-->
                    <form method="POST" action="<?php echo base_url('examMarks/marks_entry_preliminary'); ?>"
                        id="marks_entry_preliminary">


                        <div class="row">
                            <div class="form-group col-md-1">
                                <label class="control-label">College:</label>
                            </div>
                            <div class="form-group col-md-2">
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

                            <div class="form-group col-md-1">
                                <label class="control-label">Paper:</label>
                            </div>
                            <div class="form-group col-md-2">
                                <?php
                                $cand_paper_extra = array(
                                    'id'    =>     'cand_paper',
                                    'class' =>     'form-control cand_paper'
                                );
                                echo form_dropdown('cand_paper', $paper, $cand_paper, $cand_paper_extra);
                                ?>


                            </div>

                            <div class="form-group col-md-1">
                                <label class="control-label">Paper Segments:</label>
                            </div>
                            <div class="form-group col-md-2">
                                <?php
                                $cand_paper_seg_extra = array(
                                    'id'    =>     'cand_paper_seg',
                                    'class' =>     'form-control cand_paper_seg'
                                );
                                echo form_dropdown('cand_paper_seg', $paper_segments, $cand_paper_seg, $cand_paper_seg_extra);
                                ?>


                            </div>
                        </div>

                        <div class="row d-flex justify-content-end">
                            <div class="form-group col-md-2">
                                <button class="btn btn-dark marks_entry_search" type="button"
                                    name="search">search</button>
                            </div>
                        </div>

                    </form>

                    <table id="candidate_basic_listing"
                        class="table table-striped table-bordered table-hover responsive" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Reg No</th>
                                <th>Roll No</th>
                                <th>Marks Obtained</th>
                                <th>Remarks</th>
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
                                <td><?php echo $can['cand_name']; ?></td>
                                <td><?php echo $can['cand_reg_no']; ?></td>
                                <td><?php echo $can['cand_roll_no']; ?></td>
                                <td><input type="text" id="cand_marks_opt" name="cand_marks_opt"
                                        value="<?php echo $can['cand_marks_opt'] ?>"
                                        class=" form-control cand_marks_opt decimal" maxlength="6"></td>
                                <td>
                                    <select id="cand_marks_remarks" name="cand_marks_remarks"
                                        class="form-control cand_marks_remarks">
                                        <option value="">Select</option>
                                        <!-- <option value="Pass"
                                            <?php echo ($can['cand_marks_remarks'] == 'Pass') ? 'selected' : ''; ?>>Pass
                                        </option>
                                        <option value="Fail"
                                            <?php echo ($can['cand_marks_remarks'] == 'Fail') ? 'selected' : ''; ?>>Fail
                                        </option> -->
                                        <option value="Absent"
                                            <?php echo ($can['cand_marks_remarks'] == 'Absent') ? 'selected' : ''; ?>>
                                            Absent
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" name='pre_cand_code' id='pre_cand_code' class="pre_cand_code"
                                        value="<?php echo $can['pre_cand_code']; ?>">
                                    <button type="button" data-markscount="<?php echo $n; ?>"
                                        class="btn btn-primary marks_entry_save">SAVE</button>
                                </td>
                            </tr>
                            <?php
                                    $n++;
                                }
                            } else {

                                ?>
                            <tr>
                                <td colspan="7" class="text-center">No candidates found.</td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <?php
                    if (!empty($all_detail)) {
                    ?>

                    <div class="form-group mt-3">
                        <a class="btn btn-warning btn-sm download_report_preliminary">DOWNLOAD</a>
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