<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('fungsi','url'));
		$this->load->database();
		$tanda = $this->session->userdata('tanda');
		if($tanda!="")
		{
			if(($tanda !="BP") and ($tanda !="Tatausaha") and ($tanda !="PA"))
			{
			redirect('login');
			}
		}
		else
		{
			redirect('login');
		}

	}
	public function search()
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();

		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);

		// cari di database

//		$data = $this->db->from('autocomplete')->like('nama',$keyword)->get();	
		$data = $this->db->query("select `siswa_kelas`.`nis`, `datsis`.`nama`,`siswa_kelas`.`kelas` from `siswa_kelas` left join `datsis` on `siswa_kelas`.`nis`=`datsis`.`nis` where `siswa_kelas`.`thnajaran`='$thnajaran' and `siswa_kelas`.`semester`='$semester' and `datsis`.`nama` like '%$keyword%' and `siswa_kelas`.`status`='Y'");

		// format keluaran di dalam array
		$arr = array();
		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'	=>$row->nama,
				'nis'	=>$row->nis,
				'kelas'	=>$row->kelas
			);
		}
		// minimal PHP 5.2
		echo json_encode($arr);
	}
	function tampil()
	{
		$thnajaran = cari_thnajaran();
		$semester = cari_semester();
		$user = $this->uri->segment(3);
		$aksi = $this->uri->segment(4);
		$nama = $this->input->post('kirimNama');
		$this->load->model('Siswa_model');
		$data['hasil_semua']=$this->Siswa_model->tampil_siswa_semua($nama);
		$data['hasil_limit']=$this->Siswa_model->tampil_siswa_limit($nama);
		if($nama!="")
		{
				echo 'Pilih Siswa berikut. <p class="text-info">Bila tidak ada silakan memeriksa daftar siswa per kelas</p>';
				foreach($data['hasil_limit']->result() as $result)
				{
					$nis = $result->nis;
					$kelas = nis_ke_kelas_thnajaran_semester($nis,$thnajaran,$semester);
					if(!empty($kelas))
					{
				 		echo '<div class="col-sm-4"><p><a href="'.base_url().''.$user.'/'.$aksi.'/'.$result->nis.'"><b>'.$result->nama.'</b> '.$kelas.'</a></p></div>';
					}
				}
		}
		else
		{
			echo "error";
		}
	}
}
?>
