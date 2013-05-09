<!--========================= Header + Navbar ==============================-->
<div class="masthead">
    <h3 class="muted">Aplikasi Inventori Sederhana</h3>
    <h4 class="muted">Dengan Memanfaatkan Class Cart Pada Codeigniter</h4>
    <br>

    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <li><a href="<?php echo site_url('dashboard')?>">Dashboard</a></li>
                    <li><a href="<?php echo site_url('pengadaan')?>">Pengadaan</a></li>
                    <li><a href="<?php echo site_url('pengeluaran')?>">Pengeluaran</a></li>
                    <li class="active"><a href="<?php echo site_url('master')?>">Master Data</a></li>
                </ul>
            </div>
        </div>
    </div><!-- /.navbar -->
</div>
<br>

<!--========================= Content Wrapper ==============================-->
<div class="tabbable tabs-left">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabBarang" data-toggle="tab">Barang</a></li>
        <li><a href="#tabPelanggan" data-toggle="tab">Pelanggan</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tabBarang">
            <?php $this->load->view('pages/v_tab_master_barang')?>
        </div>
        <div class="tab-pane" id="tabPelanggan">
            <?php $this->load->view('pages/v_tab_master_pelanggan')?>
        </div>
    </div>
</div>