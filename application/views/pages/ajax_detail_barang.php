<?php
if(isset($detail_barang)){
    foreach($detail_barang as $row){
        ?>

        <div class="control-group">
            <label class="control-label">Kode Barang</label>
            <div class="controls">
                <input name="kd_barang" type="text" value="<?php echo $row->kd_barang; ?>" readonly="readonly">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Nama Barang</label>
            <div class="controls">
                <input name="nm_barang" type="text" value="<?php echo $row->nm_barang; ?>" readonly="readonly">
            </div>
        </div>

        <div class="control-group ">
            <label class="control-label">Harga</label>
            <div class="controls ">
                <input name="harga" type="text" value="<?php echo $row->harga; ?>" readonly="readonly">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Ready Stok</label>
            <div class="controls">
                <input name="stok" type="text" value="<?php echo $row->stok; ?>" readonly="readonly">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Jumlah Pengadaan</label>
            <div class="controls">
                <input name="qty" type="text" class="" placeholder="Input Jumlah Pengadaan...">
            </div>
        </div>
    <?php
    }
}
?>
