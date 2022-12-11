<footer class="jumbotron jumbotron-fluid py-2 bg-primary">
    <div class="container text-center text-white">eRailway 2022</div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- function logout -->
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.button-logout', function(e) {
            console.log('klik logout')
            e.preventDefault()
            Swal.fire({
                title: 'Yakin ingin logout?',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: 'Ya',
                denyButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: base_url + "logout",
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            if (data.status === true) {
                                console.log('true')
                                Swal.fire({
                                    title: data.message,
                                    icon: "success"
                                }).then(function() {
                                    window.location = base_url + "search";
                                });
                            } else {
                                console.log('false', data.message)
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
                } else if (result.isDenied) {
                    Swal.close();
                }
            })
        })
    });
</script>

</body>

</html>