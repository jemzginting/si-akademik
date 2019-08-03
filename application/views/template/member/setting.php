<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-default">Setting Password</h4>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-2">
                            <i class="fas fa-key fa-8x text-gray-300"></i>
                        </div>
                        <div class="col-lg-4">
                            <form class="form-group" method="post" id="setting_form">
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder=" New Password">

                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password" onchange="checkPasswordMatch();">
                                    <div class="registrationFormAlert" id="divCheckPasswordMatch">
                                    </div>
                                </div>
                                <button type="submit" id="submit" class="btn btn-success btn-user btn-block" onclick="update_password()">
                                    Change Password
                                </button>
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $("#password1").keyup(checkPasswordMatch);
        $("#password2").keyup(checkPasswordMatch);
        $("#submit").attr("disabled", true);
    });

    function checkPasswordMatch() {
        var password = $("#password2").val();
        var confirmPassword = $("#password1").val();

        if (password != confirmPassword) {
            $("#divCheckPasswordMatch").html("Passwords do not match!");
            $("#submit").attr("disabled", true);
        } else {
            $("#divCheckPasswordMatch").html("Passwords match.");
            $("#submit").attr("disabled", false);
        }
    }

    function update_password() {
        postData = $('#setting_form').serialize();
        $.ajax({

            url: '<?php echo site_url("MemberControl/ganti_password") ?>',
            dataType: "JSON",
            type: "POST",
            data: postData,
            success: function(data) {
                swal({
                    title: 'Ubah Password Berhasil',
                    text: '',
                    type: 'success'
                });
            }
        });
    }
</script>