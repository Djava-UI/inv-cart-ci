<!-- Modal -->
<?php
if (isset($data_barang)){
foreach($data_barang as $row){
?>
<div id="modalEditBarang<?php echo $row->kd_barang?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Edit Data Barang</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?php echo site_url('master/edit_barang')?>">

            <div class="control-group">
                <label class="control-label">Kode Barang</label>
                <div class="controls">
                    <input name="kd_barang" type="text" value="<?php echo $row->kd_barang;?>" class="uneditable-input" readonly="true">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Nama Barang</label>
                <div class="controls">
                    <input name="nm_barang" type="text" value="<?php echo $row->nm_barang;?>" >
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Stok</label>
                <div class="controls">
                    <input name="stok" type="text" value="<?php echo $row->stok;?>">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Harga</label>
                <div class="controls">
                    <input name="harga" type="text" value="<?php echo $row->harga;?>">
                </div>
            </div>


            <!--            ACTION BUTTON -->
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Save</button>
            </div>

        </form>


    </div>

</div>

<?php }
}
?>