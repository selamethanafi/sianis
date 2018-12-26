<?php
class Siswakelas_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }
 
    //fungsi untuk menampilkan semua data dari tabel database
    function get_siswa($nis) 
   {
//        $query = $this->db->query("select `siswa_kelas`.`nis`, `datsis`.`nama`,`siswa_kelas`.`kelas` from `siswa_kelas` left join `datsis` on `siswa_kelas`.`nis`=`datsis`.`nis` where `siswa_kelas`.`thnajaran`='2015/2016' and `siswa_kelas`.`semester`='2'");
         $query = $this->db->query("select `nis`,`nama` from `datsis` where `nama` like '%$nis%'");
        //cek apakah ada data
        if ($query->num_rows() > 0) { //jika ada maka jalankan
            return $query->result();
        }
    }
}
?>

