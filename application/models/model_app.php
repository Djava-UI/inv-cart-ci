<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Gilang
 * Date: 5/8/13
 * Time: 9:16 AM
 * To change this template use File | Settings | File Templates.
 */

class Model_app extends CI_Model{
    function __construct(){
        parent::__construct();

    }

    //    KODE PENGADAAN
    public function getKodePengadaan()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_pengadaan,7)) as kd_max from tbl_pengadaan_header");
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
        return "PD-".$kd;
    }

    //    KODE PENGELUARAN
    public function getKodePengeluaran()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_pengeluaran,7)) as kd_max from tbl_pengeluaran_header");
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
        return "PL-".$kd;
    }

    public function getKurangStok($kd_barang,$kurang)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok - $kurang;
        }
        return $stok;
    }

    public function getTambahStok($kd_barang,$tambah)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok + $tambah;
        }
        return $stok;
    }

    public function getKembalikanStok($kd_barang)
    {
        $q = $this->db->query("select stok from tbl_barang where kd_barang='".$kd_barang."'");
        $stok = "";
        foreach($q->result() as $d)
        {
            $stok = $d->stok;
        }
        return $stok;
    }

    public function getAllData($table)
    {
        return $this->db->get($table);
    }

    public function getAllDataLimited($table,$limit,$offset)
    {
        return $this->db->get($table, $limit, $offset);
    }

    public function getSelectedDataLimited($table,$data,$limit,$offset)
    {
        return $this->db->get_where($table, $data, $limit, $offset);
    }

    public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }

    function updateData($table,$data,$field_key)
    {
        $this->db->update($table,$data,$field_key);
    }

    function deleteData($table,$data)
    {
        $this->db->delete($table,$data);
    }

    function insertData($table,$data)
    {
        $this->db->insert($table,$data);
    }

    function manualQuery($q)
    {
        return $this->db->query($q);
    }
}