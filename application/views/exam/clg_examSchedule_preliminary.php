<?php
//print_r($candidates);
?>
<section class="py-3">
    <div class="row mb-4">
        <div class="col-lg-12 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Exam Schedule for Preliminary</h2>
                </div>
                <div class="card-body">

                    <!-- search data datatbl-->

                    <table id="candidate_basic_listing"
                        class="table table-striped table-bordered table-hover responsive " width="100%">
                        <thead>
                            <tr>

                                <th>Sl No. </th>
                                <th>Course Name </th>
                                <th>Paper</th>
                                <th>Exam Date</th>
                                <th>Exam Start Time</th>
                                <th>Exam End Time </th>
                                <th>PDF</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (!empty($result)) {
                                $n = 1;

                                date_default_timezone_set('Asia/Kolkata'); // Set your timezone
                                $currentDateTime = date('Y-m-d H:i:s');

                                //echo '<pre>'; print_r($result); exit();
                                foreach ($result as $can) {

                                    $examStartDateTime = date('Y-m-d H:i:s', strtotime($can['exam_date'] . ' ' . $can['exam_start_time']));
                                    $examEndDateTime = date('Y-m-d H:i:s', strtotime($can['exam_date'] . ' ' . $can['exam_end_time']));

                                    // Check if the current time is within the exam time range
                                    $isWithinExamTime = ($currentDateTime >= $examStartDateTime && $currentDateTime <= $examEndDateTime);
                            ?>

                            <tr>
                                <td><?php echo $n; ?></td>
                                <td><?php echo $can['crs_name']; ?></td>
                                <td><?php echo $can['exam_paper']; ?></td>
                                <td><?php echo $can['exam_date']; ?></td>
                                <td><?php echo $can['exam_start_time']; ?></td>
                                <td><?php echo $can['exam_end_time']; ?></td>
                                <!-- <td>


                                    <a class="btn" style="background-color: #2f6e18fc;"
                                        href="<?php echo $this->config->base_url(); ?>examMarks/download_question_paper_preliminary/<?php echo $can['exam_id']; ?>">Download
                                        QP</a>

                                </td> -->

                                <td>
                                    <?php if ($isWithinExamTime) { ?>
                                    <a class="btn" style="background-color: #2f6e18fc;"
                                        href="<?php echo $this->config->base_url(); ?>examMarks/download_question_paper_preliminary/<?php echo $can['exam_id']; ?>">
                                        Download QP
                                    </a>
                                    <?php } else { ?>
                                    <button class="btn btn-secondary" disabled>Not Available</button>
                                    <?php } ?>
                                </td>

                            </tr>
                            <?php
                                    $n++;
                                }
                            } else {
                            }
                            ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</section>


<?php
$this->load->view("common/footer");
?>