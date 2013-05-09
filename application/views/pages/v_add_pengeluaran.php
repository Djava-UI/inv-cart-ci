<?php $this->load->view('modal/modal_add_pengeluaran_barang')?>

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
    <form class="form-horizontal" method="post" action="<?php echo site_url('pengeluaran/update_pengeluaran_barang')?>">

        <div class="control-group">
            <label class="control-label">Kode Pengeluaran</label>
            <div class="controls">
                <input type="text" class="uneditable-input input-xlarge" name="kd_pengeluaran" value="<?php echo $kd_pengeluaran; ?>" readonly="true">
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>pengeluaran</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th class="span3">
                    <a href="#modalAddPengeluaranBarang" class="btn btn-inverse btn-block" data-toggle="modal">
                        <i class="icon-th icon-plus-sign icon-white"></i> Tambah Barang
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; $no=1;?>
            <?php foreach($this->cart->contents() as $items): ?>
                <?php echo form_hidden('rowid[]', $items['rowid']); ?>

                <tr class="gradeX">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $items['id']; ?></td>
                    <td><?php echo $items['name']; ?></td>
                    <td><?php echo $items['qty']; ?></td>
                    <td>Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
                    <td>Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
                    <td>
                        <a class="btn btn-mini btn-danger btn-block delbutton" href="#" class="delbutton"
                           id="<?php echo 'tambah/'.$items['rowid'].'/'.$kd_pengeluaran.'/'.$items['id'].'/'.$items['qty']; ?>">
                            <i class="icon-trash icon-white"></i> Hapus Barang</a>
                    </td>
                </tr>

                <?php $i++; $no++;?>
            <?php endforeach; ?>
            </tbody>
        </table>

    </form>

    <div class="form-actions">
        <form action="<?php echo site_url('pengeluaran/tambah_pengeluaran') ?>" method="post">
            <div class="row">
                <div class="span4">
                    <div class="control-group">
                        <label class="control-label">Daftar Pelanggan</label>
                        <div class="controls">
                            <select id="kd_pelanggan" tabindex="5" class="chzn-select" name="kd_pelanggan" value="" data-placeholder="Pilih Pelanggan">
                                <option value=""></option>
                                <?php
                                if(isset($data_pelanggan)){
                                    foreach($data_pelanggan as $row){
                                        ?>
                                        <option value="<?php echo $row->kd_pelanggan?>"><?php echo $row->nm_pelanggan?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div id="detail_pelanggan" name="detail_pelanggan"></div>
                </div>

                <div class="span5">
                    <div class="control-group">
                        <label class="control-label">Total Harga</label>
                        <div class="controls">
                            <input type="text" class="uneditable-input input-xlarge" name="total"
                                   value="Rp. <?php echo $this->cart->format_number($this->cart->total()); ?>">
                        </div>
                    </div>

                    <input id="tanggal_pengeluaran" type="hidden" name="tanggal_pengeluaran" data-date-format="dd-mm-yyyy" value="<?php echo isset($date) ? $date : date('d-m-Y')?>" data-date="12-02-2012">

                    <div>
                        <button type="submit" class="btn btn-primary"><i class="icon-ok-sign icon-white"></i> Save</button>
                        <a href="<?php echo site_url('pengeluaran')?>" class="btn"><i class="icon-remove-sign"></i> Cancel</a>
                    </div>
                </div>
            </div>


        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".delbutton").click(function(){
            var element = $(this);
            var del_id = element.attr("id");
            var info = del_id;
            if(confirm("Anda yakin akan menghapus?"))
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>pengeluaran/hapus_pengeluaran",
                    data: "kode="+info,
                    cache: false,
                    success: function(){
                    }
                });
                $(this).parents(".gradeX").animate({ opacity: "hide" }, "slow");
            }
            return false;
        });

        $("#kd_pelanggan").change(function(){
            var kd_pelanggan = $("#kd_pelanggan").val();
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('pengeluaran/get_detail_pelanggan'); ?>",
                data: "kd_pelanggan="+kd_pelanggan,
                cache:false,
                success: function(data){
                    $('#detail_pelanggan').html(data);
                }
            });
        });
    })
</script>