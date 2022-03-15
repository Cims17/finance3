<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<div class="main-content">
    <section class="section">
		<form action="<?php echo base_url('transaksi/tambah_data_pembelian') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Tambah Pembelian
                        </h4>

                    </div>
                    <div class="card-body">
                        
                            
                            <div class="form-group">
                                <label for="">No Transaksi</label>
                                <div class="input-group">
                                    
                                    <input type="text" class="form-control" name="noTransaksi" value="<?php echo $noTransaksi ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="">Supplier</label>
                                <div class="input-group">
                                    <select type="text" class="form-control select2" name="idSupplier" required>
                                        <option value="">Pilih Supplier</option>
                                        <?php foreach ($supplier as $supp) : ?>
                                            <option value="<?php echo $supp['idSupp'] ?>"><?php echo $supp['nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">

                                <label for="">Keterangan</label>
                                <div class="input-group">
                                    <textarea type="text" class="form-control" name="keterangan" required> </textarea>
                                </div>

                            </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Detail Transaksi
                        </h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-3">
                                <div class="form-group mb-0">
                                    <label for="">Nama Barang</label>

                                </div>
                            </div>

							<div class="col-2">
                                <div class="form-group mb-0">
                                    <label for="">Kuantitas</label>

                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group mb-0">
                                    <label for="">Harga</label>

                                </div>
                            </div>
                            
                            <div class="col-3">
                                <div class="form-group mb-0">
                                    <label for="">Total</label>

                                </div>
                            </div>
                        </div>

						<div class="input_fields_wrap">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group my-2">
                                        <input type="text" class="form-control" name="namaBarang[0]" required>
                                    </div>
                                </div>

								<div class="col-2">
                                    <div class="form-group my-2">

                                        <input type="number" min="1" class="form-control" id="kuantitas0" onkeyup="kuantitas(<?= '0'?>)" name="kuantitas[0]" required>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group my-2">

                                        <input type="number" min="1" class="form-control" id="harga0" onkeyup="harga(<?= '0'?>)" name="harga[0]" required>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group my-2">

                                        <input type="text" class="form-control" id="totalHarga0" name="totalHarga[0]" readonly>
                                    </div>
                                </div>		
                            </div>
						</div>
							<div class="text-center mt-3">
								<button class="btn btn-info add_field_button" type="button"><i class="fas fa-plus mr-2"></i>Tambah Barang</button>
							</div>	



                        <div class="form-group d-flex mt-3">
                            <button class="btn btn-primary d-flex align-items-center" type="submit"><i class="fas fa-save mr-2"></i>Simpan</button>
                        </div>
					
                    </div>
                </div>
            </div>
        </div>
		</form>
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

<script type="text/javascript">
    $(document).ready(function() {
        var max_fields = 20; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        aa = 1; ba = 1; ca = 1; db = 1; jc = 1; fb = 1; gb = 1; hc = 1; ic = 1;
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            //max input box allowed
            x++; //text box increment
            $(wrapper).append(''+
                '<div class="row">'+
                    '<div class="col-3">'+
						'<div class="form-group my-2">'+
							'<input type="text" class="form-control" name="namaBarang['+ aa++ +']" required>'+
						'</div>'+
                    '</div>'+
                    '<div class="col-2 ">'+
						'<div class="form-group my-2">'+
							'<input type="number" min="1" class="form-control" id="kuantitas'+ ba++ +'" onkeyup="kuantitas('+ ca++ +')" name="kuantitas['+ db++ +']" required>'+
						'</div>'+
                    '</div>'+
                    '<div class="col-3">'+
                        '<div class="form-group my-2">'+
							'<input type="number" min="1" class="form-control" id="harga'+ fb++ +'" onkeyup="harga('+ gb++ +')" name="harga['+ hc++ +']" required>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-3">'+
                        '<div class="form-group my-2">'+
                                '<input type="text" class="form-control" id="totalHarga'+ ic++ +'" name="totalHarga['+ jc++ +']" readonly>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-1">'+
                        '<button href="#" class="btn btn-danger remove_field mt-2"><i class="fas fa-trash fa-1x"></button>'+
                    '</div>'+
                '</div>'
            ); // add input boxes.
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        })
    });

    function kuantitas($a){
        return hitung($a);
    }

    function harga($b){
        return hitung($b);
    }
	
    function hitung($c){
        var kuantitas      = document.getElementById("kuantitas"+$c).value;
        var harga = document.getElementById('harga'+$c).value;
        totalHarga = kuantitas * harga;
        document.getElementById("totalHarga"+$c).value = totalHarga;
    }

</script>

