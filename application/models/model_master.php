<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Gilang
 * Date: 2/25/13
 * Time: 4:24 PM
 * To change this template use File | Settings | File Templates.
 */

class Model_master extends CI_Model{
    function __construct(){
        parent::__construct();
    }

//    GET DATA
    function getAllBarang(){
        return $this->db->query("select * from tbl_barang ")->result();
    }
    function getAllPelanggan(){
        return $this->db->query("select * from tbl_pelanggan ")->result();
    }

//    GET DATA BY ID
    public function getBarangById($id){
        $this->db->where('kd_barang',$id);
        $query = $this->db->get('tbl_barang');
        return $query->result();
    }
    public function getPelangganById($id){
        $this->db->where('kd_pelanggan',$id);
        $query = $this->db->get('tbl_pelanggan');
        return $query->result();
    }



//    INSERT DATA

    function insertBarang($data){
        $query = $this->db->insert('tbl_barang',$data);
        return $query;
    }
    function insertPelanggan($data){
        $query = $this->db->insert('tbl_pelanggan',$data);
        return $query;
    }


//    UPDATE DATA
    function updateBarang($id,$data){
        $this->db->where('kd_barang',$id);
        $update = $this->db->update('tbl_barang',$data);
        return $update;
    }
    function updatePelanggan($id,$data){
        $this->db->where('kd_pelanggan',$id);
        $update = $this->db->update('tbl_pelanggan',$data);
        return $update;
    }


//    DELETE DATA
    function deleteBarang($id){
        $this->db->where('kd_barang',$id);
        $delete = $this->db->delete('tbl_barang');
        return $delete;
    }
    function deletePelanggan($id){
        $this->db->where('kd_pelanggan',$id);
        $delete = $this->db->delete('tbl_pelanggan');
        return $delete;
    }


//    KODE BARANG
    function getKodeBarang()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_barang,7)) as kd_max from tbl_barang");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%07s", $tmp);
            }
        }
        else
        {
            $kd = "0000001";
        }
        return "BR-".$kd;
    }

    //    KODE PELANGGAN
    public function getKodePelanggan()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_pelanggan,6)) as kd_max from tbl_pelanggan");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }
        else
        {
            $kd = "000001";
        }
        return "PLG-".$kd;
    }


}