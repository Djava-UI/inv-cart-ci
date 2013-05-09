<?php
class Pengadaan extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model('model_app');
        $this->load->model('model_master');
    }

    function index(){
        $data=array(
            'title'=>'Pengadaan Barang',
            'data_pengadaan'=>$this->model_app->manualQuery("SELECT a.kd_pengadaan, a.tanggal_pengadaan,a.total_harga,
			(select count(kd_pengadaan) as jum from tbl_pengadaan_detail where kd_pengadaan=a.kd_pengadaan)
			as jumlah from tbl_pengadaan_header a ORDER BY a.kd_pengadaan DESC")->result(),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_pengadaan');
        $this->load->view('element/v_footer',$data);

        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
    }

//    GET DATA
    function pages_tambah_pengadaan(){
        $data=array(
            'title'=>'Tambah Pengadaan Barang',
            'kd_pengadaan'=>$this->model_app->getKodePengadaan(),
            'data_barang'=>$this->model_app->manualQuery("SELECT * from tbl_barang where stok <= 5")->result(),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_add_pengadaan');
        $this->load->view('element/v_footer',$data);
    }

    function get_detail_barang(){
        $id=$this->input->post('kd_barang');
        $data=array(
            'detail_barang'=>$this->model_master->getBarangById($id),
        );
        $this->load->view('pages/ajax_detail_barang',$data);
    }

//    INSERT DATA
    function tambah_pengadaan_to_cart(){
        $data = array(
            'id'    => $this->input->post('kd_barang'),
            'qty'   => $this->input->post('qty'),
            'price' => $this->input->post('harga'),
            'name'  => $this->input->post('nm_barang'),
        );
        $this->cart->insert($data);
        redirect('pengadaan/pages_tambah_pengadaan');
    }

    function tambah_pengadaan(){
        $d_header['kd_pengadaan'] = $this->model_app->getKodePengadaan();
        $temp = $d_header['kd_pengadaan'];
        $d_header['total_harga'] = $this->input->post('total');
        $d_header['tanggal_pengadaan'] = date("Y-m-d",strtotime($this->input->post('tanggal_pengadaan')));
        $this->model_app->insertData("tbl_pengadaan_header",$d_header);

        foreach($this->cart->contents() as $items){
            $d_detail['kd_pengadaan'] = $temp;
            $d_detail['kd_barang'] = $items['id'];
            $d_detail['qty'] = $items['qty'];
            $d_detail['harga'] = $items['price'];
            $this->model_app->insertData("tbl_pengadaan_detail",$d_detail);

            $d_u['stok'] = $this->model_app->getTambahStok($d_detail['kd_barang'],$d_detail['qty']);
            $key['kd_barang'] = $d_detail['kd_barang'];
            $this->model_app->updateData("tbl_barang",$d_u,$key);
        }
        $this->session->unset_userdata('limit_add_cart');
        $this->cart->destroy();
        redirect('pengadaan');
    }



//    DELETE
    function hapus_barang(){
        $id= $this->uri->segment(3);
        $bc=$this->model_app->getSelectedData("tbl_pengadaan_header",$id);
        foreach($bc->result() as $dph){
            $sess_data['kd_pengadaan'] = $dph->kd_pengadaan;
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
            $hps['kd_pengadaan'] = $kode[2];
            $hps['kd_barang'] = $kode[3];
            $this->model_app->deleteData("tbl_pengadaan_detail",$hps);

            $key_barang['kd_barang'] = $hps['kd_barang'];
            $d_u['stok'] = $kode[4]+$kode[5];
            $this->model_app->updateData("tbl_barang",$d_u,$key_barang);
        }
        redirect('pengadaan/pages_edit/'.$this->session->userdata('kd_pengadaan'));
    }

    function hapus(){
        $hapus['kd_pengadaan'] = $this->uri->segment(3);
        $q = $this->model_app->getSelectedData("tbl_pengadaan_detail",$hapus);
        foreach($q->result() as $d){
            $d_u['stok'] = $this->model_app->getKurangStok($d->kd_barang,$d->qty);
            $key['kd_barang'] = $d->kd_barang;
            $this->model_app->updateData("tbl_barang",$d_u,$key);
        }
        $this->model_app->deleteData("tbl_pengadaan_header",$hapus);
        $this->model_app->deleteData("tbl_pengadaan_detail",$hapus);
        redirect('pengadaan');
    }
}
