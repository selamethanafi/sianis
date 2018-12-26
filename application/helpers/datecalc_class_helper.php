<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//============================================================+
// Nama Berkas 		: datecalc_class_helper.php
// Lokasi      		: application/helpers
// Terakhir diperbarui	: Rab 01 Jul 2015 11:53:41 WIB 
// Author      		: Selamet Hanafi
//
// (c) Copyright:
//               MAN Tengaran
//               www.mantengaran.sch.id
//               selamethanafi@yahoo.co.id
//
// License:
//    Copyright (C) 2009-2014 MAN Tengaran
//    Informasi detil ada di LISENSI.TXT 
//============================================================+
?>
<?php
	/*
		Class Name	: T10DateCalc
		Purpose		: Various Date Operation and Formating
		Author		: Chandra Jatnika  
		URL			: http://chandrajatnika.com
		Language	: Indonesian
	*/
	class T10DateCalc{
		var $_time; // akan menyimpan unix time dari tanggal yang anda masukkan
		var $_d; // akan menyimpan data Hari dari tanggal
		var $_m; // akan menyimpan data Bulan dari tanggal
		var $_y; // akan menyimpan data Tahun dari tanggal
		var $_h; // akan menyimpan data Jam dari tanggal
		var $_i; // akan menyimpan data Menit dari tanggal
		var $_s; // akan menyimpan data Detik dari tanggal
		// array di bawah untuk mendeskripsikan nama-nama bulan dalam bahasa indonesia
		var $_indoMonth = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
 
		/* Parameter pada konstruktor yang harus dimasukkan adalah sebuah tanggal 
		   dengan format 'Y-m-d' atau 'Y-m-d H:i:s'	*/
		function T10DateCalc($dateString){
			$this->_time = strtotime($dateString); // membuat unix tanggal dengan fungsi strtotime
			$this->_d = date('d',$this->_time); // ambil data Hari dari unix format
			$this->_m = date('m',$this->_time); // ambil data Bulan dari unix format
			$this->_y = date('Y',$this->_time); // ambil data Tahun dari unix format
			$this->_h = date('H',$this->_time); // ambil data Jam dari unix format
			$this->_i = date('i',$this->_time); // ambil data Menit dari unix format
			$this->_s = date('s',$this->_time); // ambil data Detik dari unix format
		}
 
		function getIndonesianFormat(){
			// akan mengembalikan nilai 05 September 2008 apabila anda memasukan format tanggal 2008-09-05
			return $this->_d .' '. $this->_indoMonth[date('n',$this->_time)] .' '. $this->_y;
		}
 
		function _getDate($intervalDay=0,$intervalMonth=0,$intervalYear=0){
			// fungsi yang akan mengembalikan nilai tanggal berdasarkan selisih hari, bulan dan tahun yang diinginkan
			if($this->_h == '00' && $this->_i == '00' && $this->_s == '00')
			 $formatDate = 'Y-m-d'; // apabila jam, menit dan detik tidak dimasukkan pada tanggal awal maka format tanggal yang dikembalikan adalah Y-m-d 
			else $formatDate = 'Y-m-d H:i:s';
			return date($formatDate,mktime($this->_h,$this->_i,$this->_s,$this->_m+$intervalMonth,$this->_d+$intervalDay,$this->_y+$intervalYear));
		}
 
		function nextDay($interval=1){ return $this->_getDate($interval); }	// mendapatkan tanggal hari selanjutnya dari tanggal awal yang anda masukkan	
		function previousDay($interval=1){ return $this->_getDate(-$interval); } // mendapatkan tanggal hari sebelumnya dari tanggal awal yang anda masukkan		
		function nextWeek(){ return $this->_getDate(7);	} // mendapatkan tanggal minggu selanjutnya dari tanggal awal yang anda masukkan
		function previousWeek(){ return $this->_getDate(-7); } // mendapatkan tanggal minggu sebelumnya dari tanggal awal yang anda masukkan		
		function nextMonth($interval=1){ return $this->_getDate(0,$interval); } // mendapatkan tanggal bulan selanjutnya dari tanggal awal yang anda masukkan
		function previousMonth($interval=1){ return $this->_getDate(0,-$interval); } // mendapatkan tanggal bulan sebelumnya dari tanggal awal yang anda masukkan
		function nextYear($interval=1){ return $this->_getDate(0,0,$interval); } // mendapatkan tanggal tahun selanjutnya dari tanggal awal yang anda masukkan
		function previousYear($interval=1){ return $this->_getDate(0,0,-$interval); } // mendapatkan tanggal tahun sebelumnya dari tanggal awal yang anda masukkan
 
		function compareDate($date2){
			// mendapatkan jumlah selisih dari tanggal yang anda masukan pada kontruktor awal dan tanggal yang anda masukkan pada parameter method ini
			$t = strtotime($date2);
			$gregorian1 = gregoriantojd($this->_m,$this->_d,$this->_y); // dapatkan format julian day dari tanggal awal
			$gregorian2 = gregoriantojd(date('m',$t),date('d',$t),date('Y',$t)); // dapatkan format julian day dari tanggal akhir
			$diff = $gregorian2 - $gregorian1;
 
			return $diff; // kembalikan hasil selisih tanggal
		}
 
	}
?>
