<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-lg-9    ">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Tambah Barang
						</h4>

					</div>
					<div class="card-body">
						<form action="<?php base_url() ?>save_barang" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label for="">Kode Barang</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fas fa-list"></i>
												</div>
											</div>
											<input type="text" class="form-control" name="kodeBarang" required>
										</div>

									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label for="">Jenis Barang</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fas fa-layer-group"></i>
												</div>
											</div>
											<select type="text" class="form-control select2" name="jenisBarang" required>
												<option value="" selected disabled>Pilih Jenis Barang</option>
												<?php foreach ($jenis as $jn) : ?>
													<option value="<?php echo $jn['idJenis'] ?>"><?php echo $jn['namaJenis'] ?></option>
												<?php endforeach ?>
											</select>
										</div>


									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="">Nama Barang</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fas fa-drafting-compass"></i>
										</div>
									</div>
									<input type="text" class="form-control" name="namaBarang" value="<?= $nama ?>" required>
								</div>

							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="">Stok</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													<i class="fas fa-archive"></i>
												</div>
											</div>
											<input type="number" class="form-control" name="stok" value="<?= $jml ?>">
										</div>

									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label for="">Harga</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">
													Rp
												</div>
											</div>
											<input type="text" class="form-control" name="harga" id="harga" required>
										</div>
									</div>
								</div>
							</div>


							<div class="form-group">

								<label for="">Keterangan</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											<i class="fas fa-info-circle"></i>
										</div>
									</div>
									<input type="text" class="form-control" name="keterangan">
								</div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	// $(document).ready(function() {

	// });
	$(function() {
		var format = function(num) {
			var str = num.toString().replace("", ""),
				parts = false,
				output = [],
				i = 1,
				formatted = null;
			if (str.indexOf(".") > 0) {
				parts = str.split(".");
				str = parts[0];
			}
			str = str.split("").reverse();
			for (var j = 0, len = str.length; j < len; j++) {
				if (str[j] != ",") {
					output.push(str[j]);
					if (i % 3 == 0 && j < (len - 1)) {
						output.push(",");
					}
					i++;
				}
			}
			formatted = output.reverse().join("");
			return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
		};
		$('#harga').keyup(function() {
			$(this).val(format($(this).val()));
		});
	});
</script>
