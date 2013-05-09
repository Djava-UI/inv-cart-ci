<?php
if(isset($detail_pelanggan)){
    foreach($detail_pelanggan as $row){
        ?>

        <div class="control-group">
            <label class="control-label">Kode Pelanggan</label>
            <div class="controls">
                <input name="kd_pelanggan" type="text" value="<?php echo $row->kd_pelanggan; ?>" readonly="readonly">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Nama Pelanggan</label>
            <div class="controls">
                <input name="nm_pelanggan" type="text" value="<?php echo $row->nm_pelanggan; ?>" readonly="readonly">
            </div>
        </div>

        <div class="control-group ">
            <label class="control-label">Alamat</label>
            <div class="controls ">
                <input name="alamat" type="text" value="<?php echo $row->alamat; ?>" readonly="readonly">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Email</label>
            <div class="controls">
                <input name="email" type="text" value="<?php echo $row->email; ?>" readonly="readonly">
            </div>
        </div>
    <?php
    }
}
?>
