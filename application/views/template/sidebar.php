<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo base_url()?>"> <span class="logo-name">TOKO ANITA</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown <?php echo ($this->uri->segment(1) == '') ? 'active' : '' ?>">
                <a href="<?php echo base_url()?>" class="nav-link"><i data-feather="home"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown <?php echo ($this->uri->segment(1) === 'master_data') ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="folder"></i><span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ($this->uri->segment(2) === 'saldo_awal') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>master_data/saldo_awal">Saldo Awal</a></li>
                    <li class="<?php echo ($this->uri->segment(2) === 'info_perusahaan') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>master_data/info_perusahaan">Info Perusahaan</a></li>
                    <li class="<?php echo ($this->uri->segment(2) === 'data_perkiraan_akun') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>master_data/data_perkiraan_akun">Data Perkiraan Akun</a></li>
                    <li class="<?php echo ($this->uri->segment(2) === 'data_barang') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>master_data/data_barang">Data Barang</a></li>
                    <li class="<?php echo ($this->uri->segment(2) === 'data_pelanggan') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>master_data/data_pelanggan">Data Pelanggan</a></li>
                    <li class="<?php echo ($this->uri->segment(2) === 'data_supplier') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>master_data/data_supplier">Data Supplier</a></li>
                </ul>
            </li>
			<?php if ($this->uri->segment(2) == 'tambah_penjualan') { ?>
				<li class="dropdown">
            <?php } else { ?>
            <li class="dropdown <?php echo ($this->uri->segment(1) === 'transaksi') ? 'active' : '' ?>">
			<?php } ?>
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="bar-chart"></i><span>Data Transaksi</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ($this->uri->segment(2) === 'daftar_penjualan') ? 'active' : '' ?> <?php echo ($this->uri->segment(2) === 'tambah_penjualan') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>transaksi/daftar_penjualan">Daftar Penjualan</a></li>
                    <li class="<?php echo ($this->uri->segment(2) === 'daftar_pembelian') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>transaksi/daftar_pembelian">Data Pembelian</a></li>
                </ul>
            </li>
			
            <li class="menu-header">Laporan</li>
            <li class="dropdown <?php echo ($this->uri->segment(1) === 'akuntansi') ? 'active' : '' ?>">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="calendar"></i><span>Akuntansi</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ($this->uri->segment(2) === 'jurnal_umum') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>akuntansi/jurnal_umum">Jurnal Umum</a></li>
                    <li class="<?php echo ($this->uri->segment(2) === 'buku_besar') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>akuntansi/buku_besar">Buku Besar</a></li>
                    <li class="<?php echo ($this->uri->segment(2) === 'jurnal_penyesuaian') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>akuntansi/jurnal_penyesuaian">Jurnal Penyesuaian</a></li>
                </ul>
            </li>
            <?php if ( $this->session->userdata('role') == '77') { ?>
			
			<?php }else{ ?>
            <li class="dropdown <?php echo ($this->uri->segment(1) === 'laporan') ? 'active' : '' ?>">
                <a href="<?php echo base_url()?>pengaturan" class="menu-toggle nav-link has-dropdown"><i data-feather="file-text"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php echo ($this->uri->segment(2) === 'laporan_laba_rugi') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>laporan/laporan_laba_rugi">Laporan Laba Rugi</a></li>
                    <li class="<?php echo ($this->uri->segment(2) === 'laporan_posisi_keuangan') ? 'active' : '' ?>"><a class="nav-link" href="<?php echo base_url() ?>laporan/laporan_posisi_keuangan">Laporan Posisi Keuangan</a></li>
                </ul>
            </li>
			
            <li class="menu-header">Akun</li>
            <li class="dropdown <?php echo ($this->uri->segment(1) === 'pengaturan') ? 'active' : '' ?>">
                <a href="<?php echo base_url()?>pengaturan" class="nav-link "><i data-feather="settings"></i><span>Pengaturan Akun</span></a>     
            </li>

			<?php } ?>
        </ul>
    </aside>
</div>
