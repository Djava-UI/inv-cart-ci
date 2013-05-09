<!-- Modal -->
<?php
if(isset($data_pelanggan)){
foreach($data_pelanggan as $row){
?>
<div id="modalEditPelanggan<?php echo $row->kd_pelanggan?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Edit Data Pelanggan</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" method="post" action="<?php echo site_url('master/edit_pelanggan')?>">


            <div class="control-group">
                <label class="control-label">Kode Pelanggan</label>
                <div class="controls">
                    <input name="kd_pelanggan" type="text" value="<?php echo $row->kd_pelanggan; ?>" class="uneditable-input" readonly="true">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Nama Pelanggan</label>
                <div class="controls">
                    <input name="nm_pelanggan" type="text" value="<?php echo $row->nm_pelanggan; ?>">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Alamat</label>
                <div class="controls">
                    <input name="alamat" type="text" value="<?php echo $row->alamat; ?>">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                    <input name="email" type="text" value="<?php echo $row->email; ?>">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Save changes</button>
            </div>


        </form>
    </div>
</div>


<?php }
}
?>