<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Tambah Jurnal Penyesuaian
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url() ?>akuntansi/jurnal_penyesuaian/save_jurnal_penyesuaian" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Nama Akun</label>
                                        <select class="form-control select2" name="idAkun">
										<option value="">Pilih Nama Akun</option>
                                            <?php foreach ($akun as $ak ): ?>
                                            <option value="<?=$ak['idAkun']?>"><?=$ak['namaAkun']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <input type="text" class="form-control" name="keterangan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="">Jenis Saldo</label>
                                        <select class="form-control select2" name="jenisSaldo">
                                            <option value="Kredit">Kredit</option>
                                            <option value="Debit">Debit</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="">Tanggal Input</label>
                                        <input type="date" class="form-control" name="tanggal" required>
                                    </div>
                                </div>
                            </div>

							<div class="form-group">
								<label for="">Nominal</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">
											Rp
										</div>
									</div>
									<input type="text" class="form-control" name="nominal" id="nominal" required>
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
		$('#nominal').keyup(function() {
			$(this).val(format($(this).val()));
			// var value1 = parseCurrency($('#saldoAkhir').val()) || 0;
			// var value2 = parseCurrency($('#saldoAwal').val()) || 0;
			// var result = value1 + value2;
			// $('#saldoAkhir').val(formatRupiah(result, ""));
		});
	});
</script>

