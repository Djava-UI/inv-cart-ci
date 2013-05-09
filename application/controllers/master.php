<?php
class Master extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model('model_master');
    }

    function index(){
        $data=array(
            'title'=>'Master Data',
            'kd_barang'=>$this->model_master->getKodeBarang(),
            'kd_pelanggan'=>$this->model_master->getKodePelanggan(),
            'data_barang'=>$this->model_master->getAllBarang(),
            'data_pelanggan'=>$this->model_master->getAllPelanggan(),
        );
        $this->load->view('element/v_header',$data);
        $this->load->view('pages/v_master');
        $this->load->view('element/v_footer');
    }

//
//    ===================== INSERT =====================
    function tambah_barang(){
        $data=array(
            'kd_barang'=> $this->model_master->getKodeBarang(),
            'nm_barang'=>$this->input->post('nm_barang'),
            'stok'=>$this->input->post('stok'),
            'harga'=>$this->input->post('harga'),
        );
        $this->model_master->insertBarang($data);
        redirect("master");
    }
    function tambah_pelanggan(){
        $data=array(
            'kd_pelanggan'=> $this->model_master->getKodePelanggan(),
            'nm_pelanggan'=>$this->input->post('nm_pelanggan'),
            'alamat'=>$this->input->post('alamat'),
            'email'=>$this->input->post('email'),
        );
        $this->model_master->insertPelanggan($data);
        redirect("master");
    }


//    ======================== EDIT =======================
    function edit_barang(){
        $id = $this->input->post('kd_barang');
        $data=array(
            'kd_barang'=> $this->input->post('kd_barang'),
            'nm_barang'=>$this->input->post('nm_barang'),
            'stok'=>$this->input->post('stok'),
            'harga'=>$this->input->post('harga'),
        );
        $this->model_master->updateBarang($id,$data);
        redirect("master");
    }
    function edit_pelanggan(){
        $id = $this->input->post('kd_pelanggan');
        $data=array(
            'kd_pelanggan'=> $this->input->post('kd_pelanggan'),
            'nm_pelanggan'=>$this->input->post('nm_pelanggan'),
            'alamat'=>$this->input->post('alamat'),
            'email'=>$this->input->post('email'),
        );
        $this->model_master->updatePelanggan($id,$data);
        redirect("master");
    }

//    ========================== DELETE =======================
    function hapus_barang(){
        $id = $this->uri->segment(3);
        $this->model_master->deleteBarang($id);
        redirect("master");
    }
    function hapus_pelanggan(){
        $id = $this->uri->segment(3);
        $this->model_master->deletePelanggan($id);
        redirect("master");
    }
}


