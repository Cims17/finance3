<section class="section">
    <div class="container">
        <div class="row align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-lg-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h4 class="mx-auto">Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url()?>auth/register/daftar"  method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">Nama</label>
                                <input id="nama" type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                    
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-lg btn-block" tabindex="4">
                                    <h6 class="m-0">
                                        Daftar
                                    </h6>
                                </button>
                            </div>
                            <h6 class="text-center">
                                Sudah Punya Akun? <a href="<?= base_url()?>auth/login">Login</a>
                            </h6>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>