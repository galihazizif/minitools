#!/usr/bin/php
<?php

$url = "https://tiket1.kereta-api.co.id/?_it8tnz=TXc9PQ==&_8dnts=YzJOb1pXUjFiR1U9";

$tahun = !empty($argv[1])?$argv[1]:"2017";
$bulan = !empty($argv[2])?$argv[2]:"06";
$tgl = !empty($argv[3])?$argv[3]:"22";
$origination = !empty($argv[4])?$argv[4]:"GMR#GAMBIR";
$destination = !empty($argv[5])?$argv[5]:"PWT#PURWOKERTO";

$fields = [
	"tanggal" => $tahun.$bulan.$tgl."#Kamis, 22 Juni 2017",
	"origination" => $origination,
	"destination" => $destination,
	"adult" => "1",
	"infant" => "0",
	"Submit" => "Tampilkan"
];
ob_implicit_flush();
$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
echo "Menyiapkan koneksi ...\n";
$i = 1;
$ok = 0;
$notOk = 0;
while(true){
	sleep(1);
	echo "Connecting KAI (".$i.") S(".$ok."),F(".$notOk."), ".$tahun.$bulan.$tgl.", ".$origination." to ".$destination." \r";
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($fields));
	curl_setopt($ch,CURLOPT_USERAGENT, $agent);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,20);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	

	if($httpcode == 200){
		$ok++;
	}else{
		$notOk++;
	}

	echo "Respon: ".$httpcode.",OK:(".$ok."),NotOK(".$notOk.")\r";
	
	/*$search = '<input type="submit" name="Submit" value="&nbsp;&nbsp;Pesan&nbsp;&nbsp;" class="itButton"';*/
	$arrSearch = [
		'form_o_124',
		'form_n_124',
		'form_k_124',		
		'form_b_124',
		'form_w_124',
		'form_m_124',
		'form_o_120',
		'form_n_120',
		'form_k_120',		
		'form_b_120',

	];

	foreach($arrSearch as $search){
		if(stripos($data, $search) != false){
			$txt = "Ada tiket untuk ".$tahun.$bulan.$tgl.",".$origination." to ".$destination.", buruan pesan.".PHP_EOL;
			echo $txt;
			exec("notify-send \"".$txt."\"");
			exec("speaker-test -t sine -f 2000 -l 1");
			break;
		}
	}

	$i++;
}


?>
