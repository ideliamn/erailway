<nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand abs" href="<?= base_url() ?>">e-Railway</a>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="collapseNavbar">
            <ul class="navbar-nav">
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="#">My Booking</a>
                </li> -->
            </ul>
            <?php if ($this->session->id) : ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">My Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link button-logout" href="javascript:void(0)">Logout</a>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() . 'login' ?>">Login</a>
                    </li>
                </ul>
            <?php endif ?>
        </div>
    </div>
</nav>