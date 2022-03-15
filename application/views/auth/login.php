<section class="section">
    <div class="container">
        <div class="row align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-lg-5">
                <div class="card card-info" style="overflow: hidden;">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header d-block">
                                <h1 class="mx-auto col-black  d-flex justify-content-center">TOKO ANITA</h1>
								<h4 class="mx-auto col-black d-flex justify-content-center">JL. RADEN PATAH NO.12, NGAWI</h4>
                            </div>
                            <div class="card-body">
								<h6 class="mx-auto col-black d-flex justify-content-center">LOGIN</h6>
                                <form action="<?php base_url() ?>login/login_user" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <?php echo $this->session->flashdata('pesan') ?>
										<label for="">Jenis Akun</label>
										<select name="role" id="role" class="form-control selectric">
												<option value="0" disabled selected>Pilih Jenis Akun</option>
												<option value="1">Pemilik Toko</option>
												<option value="77">Kasir</option>
										</select>
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
										<div class="input-group">
                                        	<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
										<div class="input-group-append">
											<div class="input-group-text"><i class="fas fa-eye-slash " id="togglePassword"></i></div>
										</div>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
										</div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-lg btn-block" tabindex="4">
                                            <h6 class="m-0">
                                                Login
                                            </h6>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            
            // toggle the icon
            this.classList.toggle("far fa-eye");
        });

    </script>
