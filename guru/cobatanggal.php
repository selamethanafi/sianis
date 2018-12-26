<?php
	$tanggal = tanggal_hari_ini();
	$now = new T10DateCalc($tanggal);
	$mdep = $now->nextWeek($tanggal);
	echo $now;
	echo '<br />';
	echo $mdep;
?>
