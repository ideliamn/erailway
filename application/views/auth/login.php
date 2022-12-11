<?php $this->load->view('layout/header') ?>

<div class="container mt-3 mb-3 justify-content-center d-flex">
    <div class="card py-2" style="width: 50%">
        <div class="card-body">
            <h3 class="mb-4 mx-3 text-center">LOGIN</h3>
            <form id="form-login" action="<?= base_url() . 'login/store' ?>" method="POST">
                <div class="row mx-3">
                    <label>E-mail</label>
                </div>
                <div class="row my-2 mx-3">
                    <input class="form-control lowercase nospace" name="email_or_phone" placeholder="E-mail atau Nomor Handphone" required>
                </div>
                <div class="row mt-4 mx-3">
                    <label>Password <i id="toggle-password" class="fas fa-eye-slash"></i></label>
                </div>
                <div class="row my-2 mx-3">
                    <input class="form-control lowercase nospace" id="password" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="flex-column text-center px-5 py-2 mt-3 mb-3">
                    <button type="submit" class="btn py-2 px-3 btn-primary btn-block confirm-button">Login</button>
                    <a class="row py-2 justify-content-center" href="<?= base_url() . 'register' ?>">
                        <p><small>Belum punya akun? Register</small></p>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // toggle password
        const tooglePassword = document.getElementById("toggle-password")
        let passwordInput = document.getElementById("password")
        tooglePassword.addEventListener('click', function(e) {
            if (passwordInput.type === "password") {
                passwordInput.type = "text"
                tooglePassword.className = 'fas fa-eye'
            } else {
                passwordInput.type = "password"
                tooglePassword.className = 'fas fa-eye-slash'
            }
        })

        // swal store register
        $(document).on('submit', '#form-login', function(e) {
            e.preventDefault()
            $.ajax({
                url: $('#form-login').attr('action'),
                type: 'POST',
                data: $('#form-login').serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire({
                            title: data.message,
                            icon: "success"
                        }).then(function() {
                            window.location = base_url + "search";
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
    })
</script>

<?php $this->load->view('layout/footer') ?>