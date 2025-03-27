<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">



</head>






<style type="text/css">
* {
    padding: 0;
    margin: 0;
}

body {

    border: 1px solid black;
    margin: 25px 25px 25px 25px;
}

.tbl_exam td,
.tbl_exam th {
    padding: 10px;
}
</style>

<body>

    <table style="width:100%;height:10%;" cellspacing="0">
        <tr style="width:100%;">
            <td style=" height:10%; width:14%;" align="center">
                <img src="data:image/png;base64, <?php echo base64_encode(file_get_contents('assets/img/logo-pdf.png')) ?>"
                    alt="" height="70" width="70">

            </td>
            <td style="height:10%; width:65%; vertical-align: center;text-align: center;font-weight:bold">
                <p style="font-size:20px;"><b>State Medical Faculty of West Bengal
                    </b></p><br>
                <span style="font-size:13px;">Final Examination </span><br>
                <span
                    style="font-size:11px;"><?php echo $result[0]['course_full_name'] . " : " . $result[0]['course_full'] ?></span>



            </td>
            <td style="height:10%; width:14%;" align="center">
            </td>
        </tr>

    </table>

    <div style="border: 1px solid black;text-align: center;font-size:12px;font-weight:bold"> Slip Roll for
        <span><?php echo $cand_paper ?></span>
        Examination for :
        <span><?php echo $cand_paper_seg ?></span>
    </div>
    <br>

    <table border="1" style="width:100%;text-align: center;font-size:12px" cellspacing="0" class="tbl_exam">
        <thead>
            <tr>
                <th>Exam</th>
                <th>Full marks</th>
                <th>Pass Marks</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $cand_paper_seg ?></td>
                <td>100</td>
                <td>50</td>
                <td>Absent
                </td>
            </tr>
        </tbody>
    </table>

    <br>

    <div style="border: 1px solid black;text-align: center;font-size:12px;font-weight:bold">
        <span><?php echo $result[0]['inst_name'] ?></span>
    </div>

    <br>

    <table border="1" style="width:100%;height:20%;text-align: center;font-size:12px" cellspacing="0" class="tbl_exam">
        <thead>
            <tr>
                <th>Sl. No</th>
                <th>Student's Registration No</th>
                <th>Roll No</th>
                <th>Marks Obtained</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (!empty($result)) {
                $n = 1;
                foreach ($result as $can) {
            ?>

            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $can['cand_reg_no']; ?></td>
                <td><?php echo $can['cand_roll_no']; ?></td>
                <td><?php echo $can['cand_marks_opt']; ?></td>
                <td><?php echo $can['cand_marks_remarks']; ?></td>
            </tr>

            <?php
                    $n++;
                }
            }

            ?>
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right; font-size: 14px; font-weight: bold;">
        <div style="display: inline-block; text-align: center;">
            <hr style="width: 270px; border: 1px solid black; margin: 0;">
            Signature of Principal/Co-ordinator/Professor
        </div>
    </div>





</body>

</html>