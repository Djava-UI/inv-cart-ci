
<?php $this->load->view('modal/modal_add_pelanggan')?>
<?php $this->load->view('modal/modal_edit_pelanggan')?>

<div class="well">
    <a href="#modalAddPelanggan" class="btn btn-large btn-block btn-inverse" data-toggle="modal">
        <i class="icon-plus icon-white"></i> Tambah Data
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Pelanggan</th>
        <th>Nama Pelanggan</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>
            <div class="btn btn-mini btn-inverse btn-block disabled"><i class="icon-th icon-white"></i> Option </div>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no=1;
    if(isset($data_pelanggan)){
        foreach($data_pelanggan as $row){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->kd_pelanggan; ?></td>
                <td><?php echo $row->nm_pelanggan; ?></td>
                <td><?php echo $row->alamat; ?></td>
                <td><?php echo $row->email; ?></td>
                <td>
                    <a class="btn btn-mini" href="#modalEditPelanggan<?php echo $row->kd_pelanggan?>" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
                    <a class="btn btn-mini" href="<?php echo site_url('master/hapus_pelanggan/'.$row->kd_pelanggan);?>"
                       onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>
                </td>
            </tr>

        <?php }
    }
    ?>

    </tbody>
</table>