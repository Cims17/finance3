<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<h4>
							Tambah Saldo
						</h4>

					</div>
					<div class="card-body">
						<form action="<?php base_url() ?>save_saldo" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="">Akun</label>
								<select type="text" class="form-control select2" name="idAkun" id="idAkun">
									<option value="" selected disabled>Pilih Akun</option>
									<?php foreach ($akun as $ak) : ?>
										<option value="<?= $ak['idAkun'] ?>"><?= $ak['namaAkun'] ?> </option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="form-group">
								<label for="">Nominal</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											Rp
										</div>
									</div>
									<input type="text" class="form-control" name="saldoAwal" id="saldoAwal">
								</div>

							</div>
							<div class="form-group">
								<label for="">Saldo Akhir</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											Rp
										</div>
									</div>

									<input type="text" class="form-control" name="saldoAkhir" id='saldoAkhir' readonly>
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
								<button class="btn btn-primary d-flex align-items-center" type="submit"><i class="fas fa-check mr-2"></i>Simpan</button>
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
	$(document).ready(function() {

		$('#idAkun').change(function() {

			var id = $(this).val();

			$.ajax({
				url: "<?php echo base_url() ?>master_data/getSaldoAkhir/",
				method: "POST",
				data: {
					id: id
				},
				async: true,
				// dataType: 'json',
				success: function(data) {
					console.log(id);
					// /* Fungsi formatRupiah */
					function formatRupiah(angka, prefix) {
						var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
							split = number_string.split(','),
							sisa = split[0].length % 3,
							rupiah = split[0].substr(0, sisa),
							ribuan = split[0].substr(sisa).match(/\d{3}/gi);

						// tambahkan titik jika yang di input sudah menjadi angka ribuan
						if (ribuan) {
							separator = sisa ? ',' : '';
							rupiah += separator + ribuan.join(',');
						}

						rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
						return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
					}
					$('#saldoAkhir').val(formatRupiah(data, ""));
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
			return false;
		});
	});
</script>
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

		// function formatRupiah(angka, prefix) {
		//     var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
		//         split = number_string.split(','),
		//         sisa = split[0].length % 3,
		//         rupiah = split[0].substr(0, sisa),
		//         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		//     // tambahkan titik jika yang di input sudah menjadi angka ribuan
		//     if (ribuan) {
		//         separator = sisa ? ',' : '';
		//         rupiah += separator + ribuan.join(',');
		//     }

		//     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		//     return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
		// }

		// function parseCurrency(num) {
		//     return parseFloat(num.replace(/,/g, ''));
		// }
		$('#saldoAwal').keyup(function() {
			$(this).val(format($(this).val()));
			// var value1 = parseCurrency($('#saldoAkhir').val()) || 0;
			// var value2 = parseCurrency($('#saldoAwal').val()) || 0;
			// var result = value1 + value2;
			// $('#saldoAkhir').val(formatRupiah(result, ""));
		});
	});
</script>
