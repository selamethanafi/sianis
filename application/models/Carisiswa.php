<?php
class Carisiswa extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }
 
    //fungsi untuk menampilkan semua data dari tabel database
    function get_siswa() {
        $query = $this->db->query("select `siswa_kelas`.`nis`, `datsis`.`nama`,`siswa_kelas`.`kelas` from `siswa_kelas` left join `datsis` on `siswa_kelas`.`nis`=`datsis`.`nis` where `siswa_kelas`.`thnajaran`='2015/2016' and `siswa_kelas`.`semester`='2'");
 
        //cek apakah ada data
        if ($query->num_rows() > 0) { //jika ada maka jalankan
            return $query->result();
        }
    }
}
?>
- See more at: http://fabernainggolan.net/input-dinamis-autocomplete-pada-codeignitermysql-dengan-jquer#sthash.pPe3BOYh.dpuf
