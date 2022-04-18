<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Edit Barang
                        </h4>

                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url() ?>master_data/update_barang" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="">Kode Barang</label>
                                        <input type="text" value="<?= $barang->idBarang ?>" hidden name="idBarang">
                                        <input type="text" class="form-control" name="kodeBarang" value="<?= $barang->kodeBarang ?>">
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="">Jenis Barang</label>
                                        <select class="form-control selectric" name="idJenis">
                                            <?php foreach ($jenis as $jns) : ?>
                                                <option value="<?= $jns['idJenis'] ?>" <?php echo ($jns['idJenis'] == $barang->idJenis) ? "selected" : ""; ?>><?= $jns['namaJenis'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

							<div class="form-group">
								<label for="">Nama Barang</label>
								<input type="text" class="form-control" name="nama" value="<?= $barang->nama ?>">
							</div>

                            <div class="row">
                                <div class="col-6">

                                    <div class="form-group">

                                        <label for="">Stok</label>
                                        <input type="number" class="form-control" name="stok" value="<?= $barang->stok ?>">
                                    </div>


                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Harga</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" name="harga" value="<?= $barang->harga ?>">

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" value="<?= $barang->keterangan ?>">
                            </div>
                            <div class="form-group d-flex">
                                <a href="<?= base_url()?>master_data/data_barang"><div class="btn btn-danger d-flex align-items-center mr-3"><i class="fa fa-times mr-2"></i>Batal</div></a>
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
