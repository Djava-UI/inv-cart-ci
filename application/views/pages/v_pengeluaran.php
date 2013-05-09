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
                    <li class="active"><a href="<?php echo site_url('pengeluaran')?>">Pengeluaran</a></li>
                    <li><a href="<?php echo site_url('master')?>">Master Data</a></li>
                </ul>
            </div>
        </div>
    </div><!-- /.navbar -->
</div>
<br>

<!--================ Content Wrapper===========================================-->
<div class="well">
    <a href="<?php echo site_url('pengeluaran/pages_tambah_pengeluaran')?>" class="btn btn-large btn-block btn-inverse" data-toggle="modal">
        <i class="icon-plus icon-white"></i> Tambah Data
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kode Pengeluaran</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th class="span3">
            <div class="btn btn-mini btn-inverse btn-block disabled">
                <i class="icon-th icon-white"></i> Options
            </div>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no=1;
    if(isset($data_pengeluaran)){
        foreach($data_pengeluaran as $row){
            ?>
            <tr class="gradeX">
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->tanggal_pengeluaran; ?></td>
                <td><?php echo $row->kd_pengeluaran; ?></td>
                <td><?php echo $row->jumlah; ?> Items</td>
                <td><?php echo $row->total_harga; ?></td>
                <td>
                    <a class="btn btn-mini btn-block btn-danger" href="<?php echo site_url('pengeluaran/hapus/'.$row->kd_pengeluaran)?>"
                       onclick="return confirm('Anda Yakin ?');"><i class="icon-trash icon-white"></i> Hapus</a>
                </td>
            </tr>
        <?php }
    }
    ?>

    </tbody>
</table>



