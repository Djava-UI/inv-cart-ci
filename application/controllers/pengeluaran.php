<?php
class Pengeluaran extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model('model_app');
        $this->load->model('model_master');
    }

    function index(){
        $data=array(
            'title'=>'Pengeluaran Barang',
            'data_pengeluaran'=>$this->model_app->manualQuery("SELECT a.kd_pengeluaran,  a.tanggal_pengeluaran,a.total_harga,
			(select count(kd_pengeluaran) as jum from tbl_pengeluaran_detail where kd_pengeluaran=a.kd_pengeluaran)
			as jumlah from tbl_pengeluaran_header a ORDER BY a.kd_pengeluaran DESC")->result(),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_pengeluaran');
        $this->load->view('element/v_footer',$data);

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
    }

//    GET DATA
    function pages_tambah_pengeluaran(){
        $data=array(
            'title'=>'Tambah Pengeluaran Barang',
            'kd_pengeluaran'=>$this->model_app->getKodePengeluaran(),
            'data_barang'=>$this->model_app->manualQuery("SELECT * from tbl_barang where stok > 0")->result(),
            'data_pelanggan'=>$this->model_master->getAllPelanggan()
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_pengeluaran');
        $this->load->view('element/v_footer',$data);
    }

    function get_detail_barang(){
        $id=$this->input->post('kd_barang');
        $data=array(
            'detail_barang'=>$this->model_master->getBarangById($id),
        );
        $this->load->view('pages/ajax_detail_barang',$data);
    }

    function get_detail_pelanggan(){
        $id=$this->input->post('kd_pelanggan');
        $data=array(
            'detail_pelanggan'=>$this->model_master->getPelangganById($id),
        );
        $this->load->view('pages/ajax_detail_pelanggan',$data);
    }

//    INSERT DATA
    function tambah_pengeluaran_to_cart(){
        $data = array(
            'id'    => $this->input->post('kd_barang'),
            'qty'   => $this->input->post('qty'),
            'price' => $this->input->post('harga'),
            'name'  => $this->input->post('nm_barang'),
        );
        $this->cart->insert($data);
        redirect('pengeluaran/pages_tambah_pengeluaran');
    }

    function tambah_pengeluaran(){
        $d_header['kd_pengeluaran'] = $this->model_app->getKodePengeluaran();
        $temp = $d_header['kd_pengeluaran'];
        $d_header['total_harga'] = $this->input->post('total');
        $d_header['kd_pelanggan'] = $this->input->post('kd_pelanggan');
        $d_header['tanggal_pengeluaran'] = date("Y-m-d",strtotime($this->input->post('tanggal_pengeluaran')));
        $this->model_app->insertData("tbl_pengeluaran_header",$d_header);

        foreach($this->cart->contents() as $items){
            $d_detail['kd_pengeluaran'] = $temp;
            $d_detail['kd_barang'] = $items['id'];
            $d_detail['qty'] = $items['qty'];
            $d_detail['harga'] = $items['price'];
            $this->model_app->insertData("tbl_pengeluaran_detail",$d_detail);

            $d_u['stok'] = $this->model_app->getKurangStok($d_detail['kd_barang'],$d_detail['qty']);
            $key['kd_barang'] = $d_detail['kd_barang'];
            $this->model_app->updateData("tbl_barang",$d_u,$key);
        }
        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
        redirect('pengeluaran');
    }



//    DELETE
    function hapus_barang(){
        $id= $this->uri->segment(3);
        $bc=$this->model_app->getSelectedData("tbl_pengeluaran_header",$id);
        foreach($bc->result() as $dph){
            $sess_data['kd_pengeluaran'] = $dph->kd_pengeluaran;
            $this->session->set_userdata($sess_data);
        }

        $kode = explode("/",$_GET['kode']);
        if($kode[0]=="tambah")
        {
            $data = array(
                'rowid' => $kode[1],
                'qty'   => 0
            );
            $this->cart->update($data);
        }
        else if($kode[0]=="edit")
        {
            $data = array(
                'rowid' => $kode[1],
                'qty'   => 0
            );
            $this->cart->update($data);
            $hps['kd_pengeluaran'] = $kode[2];
            $hps['kd_barang'] = $kode[3];
            $this->model_app->deleteData("tbl_pengeluaran_detail",$hps);

            $key_barang['kd_barang'] = $hps['kd_barang'];
            $d_u['stok'] = $kode[4]+$kode[5];
            $this->model_app->updateData("tbl_barang",$d_u,$key_barang);
        }
        redirect('pengeluaran/pages_edit/'.$this->session->userdata('kd_pengeluaran'));
    }

    function hapus(){
        $hapus['kd_pengeluaran'] = $this->uri->segment(3);
        $q = $this->model_app->getSelectedData("tbl_pengeluaran_detail",$hapus);
        foreach($q->result() as $d){
            $d_u['stok'] = $this->model_app->getTambahStok($d->kd_barang,$d->qty);
            $key['kd_barang'] = $d->kd_barang;
            $this->model_app->updateData("tbl_barang",$d_u,$key);
        }
        $this->model_app->deleteData("tbl_pengeluaran_header",$hapus);
        $this->model_app->deleteData("tbl_pengeluaran_detail",$hapus);
        redirect('pengeluaran');
    }
}
