<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?= ($datasetting['logo_aplikasi'] == 'default.png' ? base_url('assets/img/setting/logo.jpg') : base_url('assets/img/setting/' . $datasetting['logo_aplikasi'])) ?>" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4><?= $title ?></h4>
                            </div>

                            <div class="card-body">
                                <?php if ($this->session->flashdata('authmsg')) : ?>

                                    <?= $this->session->flashdata('authmsg') ?>

                                <?php endif ?>
                                <form action="" method="post" style="max-width: 600px;">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control <?= form_error('username') ? 'invalid' : '' ?>" placeholder="Your username or email" value="<?= set_value('username') ?>" required />

                                        <div class="invalid-feedback">
                                            <?= form_error('username') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input type="password" name="password" class="form-control <?= form_error('password') ? 'invalid' : '' ?>" placeholder="Enter your password" value="<?= set_value('password') ?>" required />
                                        <div class="invalid-feedback">
                                            <?= form_error('password') ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember" id="password" class="custom-control-input" tabindex="3" id="remember-me">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                                Login
                                            </button>
                                        </div>
                                </form>

                            </div>
                        </div>

                        <div class="simple-footer">
                            Copyright &copy; CV CARAKA ABADI <?= date('Y') ?> <BR>Support By @ <a href="https://www.instagram.com/aris.wahyudi86">Aris WIT</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
</body>

</html>