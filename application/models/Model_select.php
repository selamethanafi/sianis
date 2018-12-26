<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Model_select extends CI_Model
{

function __construct(){

parent::__construct();

}


function provinsi(){


$this->db->order_by('name','ASC');
$provinces= $this->db->get('provinces');


return $provinces->result_array();


}


function kabupaten($provId){

$kabupaten="<option value='0'>--pilih--</option>";

$this->db->order_by('name','ASC');
$kab= $this->db->get_where('regencies',array('province_id'=>$provId));

foreach ($kab->result_array() as $data ){
$kabupaten.= "<option value='$data[id]'>$data[name]</option>";
}

return $kabupaten;

}

function kecamatan($kabId){
$kecamatan="<option value='0'>--pilih--</option>";

$this->db->order_by('name','ASC');
$kec= $this->db->get_where('districts',array('regency_id'=>$kabId));

foreach ($kec->result_array() as $data ){
$kecamatan.= "<option value='$data[id]'>$data[name]</option>";
}

return $kecamatan;
}

function kelurahan($kecId){
$kelurahan="<option value='0'>--pilih--</option>";

$this->db->order_by('name','ASC');
$kel= $this->db->get_where('villages',array('district_id'=>$kecId));

foreach ($kel->result_array() as $data ){
$kelurahan.= "<option value='$data[id]'>$data[name]</option>";
}

return $kelurahan;
}

function data_desa($id_desa)
{
	$datadesa = null;
	$tdesa = $this->db->get_where('villages',array('id'=>$id_desa));
	foreach ($tdesa->result_array() as $data ){
		$datadesa = array($data['id'],$data['name'],$data['district_id']);
	}
	return $datadesa;
}
function data_kecamatan($id_kec)
{
	$datakec = null;
	$tkec = $this->db->get_where('districts',array('id'=>$id_kec));
	foreach ($tkec->result_array() as $data ){
		$datakec = array($data['id'],$data['name'],$data['regency_id']);
	}
	return $datakec;
}
function data_kabupaten($id_kab)
{
	$datakab = null;
	$tkab = $this->db->get_where('regencies',array('id'=>$id_kab));
	foreach ($tkab->result_array() as $data ){
		$datakab = array($data['id'],$data['name'],$data['province_id']);
	}
	return $datakab;
}
function data_provinsi($id_prov)
{
	$dataprov = null;
	$tprov = $this->db->get_where('provinces',array('id'=>$id_prov));
	foreach ($tprov->result_array() as $data ){
		$dataprov = array($data['id'],$data['name']);
	}
	return $dataprov;
}

}
