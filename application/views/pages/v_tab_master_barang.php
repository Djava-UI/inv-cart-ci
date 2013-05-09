<?php $this->load->view('modal/modal_add_barang')?>
<?php $this->load->view('modal/modal_edit_barang')?>

<div class="well">
    <a href="#modalAddBarang" class="btn btn-large btn-block btn-inverse" data-toggle="modal">
        <i class="icon-plus icon-white"></i> Tambah Data
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Harga</th>
        <th class="span2">
            <div class="btn btn-mini btn-inverse btn-block disabled">
                <i class="icon-th icon-white"></i> Options
            </div>
        </th>
    </tr>
    </thead>
    <tbody>

    <?php
    $no=1;
    if(isset($data_barang)){
    foreach($data_barang as $row){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row->kd_barang; ?></td>
        <td><?php echo $row->nm_barang; ?></td>
        <td><?php echo $row->stok; ?></td>
        <td><?php echo $row->harga; ?></td>
        <td>
            <a class="btn btn-mini" href="#modalEditBarang<?php echo $row->kd_barang?>" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
            <a class="btn btn-mini" href="<?php echo site_url('master/hapus_barang/'.$row->kd_barang);?>"
               onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>
        </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>