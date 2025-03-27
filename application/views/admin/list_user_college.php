<section>
    <div class="row mb-4">
        <div class="col-lg-12 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-header">
                    <h1 class="h6 text-uppercase mb-0" style="text-align: center;">
                        <?php echo "College Password Change"; ?></h1>
                </div>
                <div class="card-body">


                    <!-- /////// Candidate Show ///////// -->

                    <div class="row mb-4">
                        <div class="col-lg-12 mb-4 mb-lg-0">
                            <div class="card">


                                <div class="card-body">

                                    <table id="user_activity_listing"
                                        class="table table-striped table-bordered table-hover responsive datatbl"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>College Name</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($clg_users as $index => $user): ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= $user->col_name ?></td>
                                                    <td><?= $user->user_name ?></td>
                                                    <td><?= $user->user_password ?></td>
                                                    <td>
                                                        <button class="btn btn-info change-password-btn"
                                                            data-id="<?= $user->user_id ?>"
                                                            data-username="<?= $user->user_name ?>">Change</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- //////// Candidate Show Ends /////// -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm">
                        <input type="hidden" id="userId" name="id">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="text" id="password" name="password" class="form-control input-number"
                                maxlength="4" required>
                        </div>
                        <button type="submit" class="btn btn-info" style="margin-bottom: 2rem;">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</section>



<?php
$this->load->view("common/footer");
?>

<script>
    $(document).ready(function() {
        $('.change-password-btn').on('click', function() {
            const id = $(this).data('id');
            const username = $(this).data('username');
            $('#userId').val(id);
            $('#username').val(username);
            $('#changePasswordModal').modal('show');
        });

        $('#changePasswordForm').on('submit', function(e) {
            e.preventDefault();

            const password = $('#password').val();

            if ($.trim(password) === '') {
                alert('Password cannot be empty.');
                return;
            }

            // Validation: Check if the password is exactly 4 digits
            if (!/^\d{4}$/.test(password)) {
                alert('Password must be exactly 4 digits.');
                return;
            }

            // Proceed with AJAX request if validation passes
            $.ajax({
                url: '<?= site_url('admin/updatePassword') ?>',
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    const res = JSON.parse(response);
                    alert(res.message);
                    if (res.status === 'success') {
                        $('#changePasswordModal').modal('hide');
                        location.reload();
                    }
                }
            });
        });
    });
</script>