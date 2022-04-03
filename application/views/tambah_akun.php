<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-7">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Tambah Akun
						</h4>

					</div>
					<div class="card-body">
						<form action="<?php echo base_url() ?>pengaturan/save_user" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="">Username</label>
								<input type="text" class="form-control" name="username" required>
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input id="email" type="email" class="form-control" name="email" required>
							</div>
							<div class="form-group">
								<label for="">Password</label>
								<input type="text" class="form-control" name="password" required>
							</div>
							<div class="form-group">
								<label for="">Role</label>
								<select class="form-control select2" name="role" required>
									<option value="" selected disabled>Pilih Role User</option>
									<option value="1">Admin</option>
									<option value="77">Kasir</option>
								</select>
							</div>
							<div class="form-group d-flex">
								<button class="btn btn-primary d-flex align-items-center" type="submit"><i class="fas fa-save mr-2"></i>Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>
