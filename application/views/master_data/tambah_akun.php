<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Tambah Akun
						</h4>

					</div>
					<div class="card-body">
						<form action="<?php base_url() ?>save_akun" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="">Nama Akun</label>
								<input type="text" class="form-control" name="namaAkun" required>
							</div>
							<div class="form-group">
								<label for="">Jenis Akun</label>
								<select type="text" name="jenis" id="jenis" class="form-control selectric" required>
									<option value="" name="" disabled selected>Pilih Jenis Akun</option>
									<?php foreach ($jenis as $jns) : ?>
										<option value="<?= $jns['idJenis'] ?>"><?= $jns['namaJenis'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-row">
								<div class="form-group col-md-5">
									<label for="">Kode Jenis</label>
									<input type="text" class="form-control" id="kodeJenis" name="kodeJenis" readonly>
								</div>
								<div class="form-group col-md-1 d-flex align-items-center">
									<div class="mt-4 ml-3">-</div>
								</div>
								<div class="form-group col-md-6">
									<label for="">No Akun</label>
									<input type="text" class="form-control" id="kodeAkun" name="kodeAkun" required>
								</div>
							</div>
							<div class="form-group">
								<label for="">Keterangan</label>
								<input type="text" class="form-control" name="keterangan">
							</div>
							<div class="form-group d-flex">
								<button class="btn btn-primary d-flex align-items-center" type="submit"><i class="fas fa-check mr-2"></i>Simpan</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$(document).ready(function() {

		$('#jenis').change(function() {
			var idJenis = $('#jenis').val();
			if (idJenis != '') {
				$.ajax({
					url: "<?php echo base_url(); ?>master_data/get_kodejenis",
					method: "POST",
					data: {idJenis: idJenis},
					dataType: 'json',
					success: function(data) {
						var len = data.length;
						if(len > 0){
							var kode = data[0].kodeJenis;
					
							$('#kodeJenis').val(kode);
						}
						
					}


				})
			}
		})
	});
</script>
