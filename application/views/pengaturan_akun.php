<?php echo $this->session->flashdata('berhasil_user') ?>
<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Pengaturan Akun
						</h4>
						<div class="d-flex">
							<a href="<?= base_url() ?>pengaturan/tambah_user">
								<div class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i>Tambah Akun</div>
							</a>
						</div>

					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table  table-hover table-striped" id="table-1" style="width:100%;">
								<thead>
									<tr>
										<th width="10px">No</th>
										<th>Username</th>
										<th>Email</th>
										<th>Role</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									foreach ($users as $us) : ?>
										<tr id="<?php echo $us['idUser'] ?>" name="<?php echo $us['username'] ?>">
											<td class="text-center"><?= $i++ ?></td>
											<td><?= $us['username'] ?></td>
											<td><?= $us['email'] ?></td>
											<?php if ($us['role'] == 1) { ?>
												<td>Pemilik Toko</td>
											<?php } else {  ?>
												<td>Kasir</td>
											<?php } ?>
											<td class="d-flex">
												<button type="button" data-toggle="modal" data-target="#update-user<?= $us['idUser'] ?>" class="btn btn-primary d-flex align-items-center mr-2">
													<i class="fas fa-edit mr-2"></i>
													Edit
												</button>

												<button class="btn btn-danger d-flex align-items-center remove">
													<i class="far fa-trash-alt mr-2"></i>
													Hapus
												</button>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php foreach ($users as $us) : ?>
	<div class="modal fade" id="update-user<?= $us['idUser'] ?>" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="formModal">Edit Akun</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('pengaturan/update_user/') . $us['idUser']; ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Username </label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-user"></i>
									</div>
								</div>
								<input type="text" class="form-control" name="username" value="<?= $us['username'] ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label>Email</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-at"></i>
									</div>
								</div>
								<input type="text" class="form-control" name="email" value="<?= $us['email'] ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label>Role</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-user-friends"></i>
									</div>
								</div>
								<select class="form-control" name="role" required>
									<?php if($us['role'] == 1) {?>
                                        <option value="1" selected>Pemilik Toko</option>
                                        <option value="77">Kasir</option>
									<?php } else {?>
										<option value="1">Pemilik Toko</option>
                                        <option value="77" selected>Kasir</option>
									<?php } ?>
                                </select>
							</div>
						</div>
						<div class="d-flex justify-content-around">
							<button type="button" class="btn btn-danger mr-3" data-dismiss="modal">
								<i class="fas fa-backspace mr-1"></i>
								Batal
							</button>
							<button type="submit" class="btn btn-primary">
								<i class="fas fa-save mr-1"></i>
								Simpan
							</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
<?php endforeach ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	$(".remove").click(function() {
		var id = $(this).parents("tr").attr("id");
		var name = $(this).parents("tr").attr("name");
		swal({
			title: "Hapus Data User " + name + " ?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '<?= base_url() ?>pengaturan/delete_perusahaan/' + id,
					type: 'DELETE',
					error: function() {
						alert('Something is wrong');
					},
					success: function(data) {
						swal({
							title: "Data Perusahaan Telah Terhapus"
						}).then(function() {
							location.reload();
						});
					}
				});
			} else {
				// swal("Batal");
			}
		});
	});
</script>
