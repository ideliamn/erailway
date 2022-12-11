<?php $this->load->view('layout/header') ?>

<div class="container mt-3 mb-3 justify-content-center d-flex">
    <div class="card py-2" style="width: 90%">
        <div class="card-body">
            <h3 class="mb-5 mx-3 text-center">REGISTER</h3>
            <form id="form-register" action="<?= base_url() . 'register/store' ?>" method="POST">
                <div class="row mx-3 my-3">
                    <div class="col-4">
                        <label>Nama Lengkap</label>
                    </div>
                    <div class="col-8">
                        <input class="form-control uppercase" name="name" placeholder="Nama Lengkap" required>
                    </div>
                </div>
                <div class="row mx-3 my-3">
                    <div class="col-4">
                        <label>NIK</label>
                    </div>
                    <div class="col-8">
                        <input class="form-control" name="nik" placeholder="NIK" required>
                    </div>
                </div>
                <div class="row mx-3 my-3">
                    <div class="col-4">
                        <label>Nomor Handphone</label>
                    </div>
                    <div class="col-8">
                        <input class="form-control number" name="phone" placeholder="Nomor Handphone" required>
                    </div>
                </div>
                <div class="row mx-3 mt-3 mb-5">
                    <div class="col-4">
                        <label>E-mail</label>
                    </div>
                    <div class="col-8">
                        <input class="form-control" name="email" type="email" placeholder="E-mail" required>
                    </div>
                </div>
                <div class="row mx-3 my-3">
                    <div class="col-4">
                        <label>Password</label></label>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-10">
                                <input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
                            </div>
                            <div class="col-2 align-items-center d-flex">
                                <i id="toggle-password" class="fas fa-eye-slash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-3 mt-3 mb-5">
                    <div class="col-4">
                        <label>Confirm Password</label></label>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-10">
                                <input class="form-control" id="password-confirm" name="confirm_password" type="password" placeholder="Confirm Password" required>
                            </div>
                            <div class="col-2 align-items-center d-flex">
                                <i id="toggle-password-confirm" class="fas fa-eye-slash"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-column text-center px-5 py-2 mt-3 mb-3">
                    <button type="submit" id="register-submit" class="btn py-2 px-3 btn-primary btn-block confirm-button">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // toggle password
        const togglePassword = document.getElementById("toggle-password")
        let passwordInput = document.getElementById("password")
        togglePassword.addEventListener('click', function(e) {
            if (passwordInput.type === "password") {
                passwordInput.type = "text"
                togglePassword.className = 'fas fa-eye'
            } else {
                passwordInput.type = "password"
                togglePassword.className = 'fas fa-eye-slash'
            }
        })

        // toggle password confirm
        const togglePasswordConfirm = document.getElementById("toggle-password-confirm")
        let passwordInputConfirm = document.getElementById("password-confirm")
        togglePasswordConfirm.addEventListener('click', function(e) {
            if (passwordInputConfirm.type === "password") {
                passwordInputConfirm.type = "text"
                togglePasswordConfirm.className = 'fas fa-eye'
            } else {
                passwordInputConfirm.type = "password"
                togglePasswordConfirm.className = 'fas fa-eye-slash'
            }
        })

        // swal store register
        $(document).on('submit', '#form-register', function(e) {
            e.preventDefault()
            if ($('#password').val() != $('#password-confirm').val()) {
                alert('Password not match with retype password !')
                return false
            }
            $.ajax({
                url: $('#form-register').attr('action'),
                type: 'POST',
                data: $('#form-register').serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: data.message,
                            icon: "success"
                        }, function() {
                            window.location = base_url + "login";
                        });
                    } else {
                        Swal.fire({
                            title: data.message,
                            icon: "error"
                        });
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: data.message,
                        icon: "error"
                    });
                }
            })
        })
    });
</script>

<?php $this->load->view('layout/footer') ?>