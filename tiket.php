#!/usr/bin/php
<?php

function cekParam($param,$seq){
	$label = [
		1 => "Tahun",
		2 => "Bulan",
		3 => "Hari / Tanggal",
		4 => "Stasiun asal",
		5 => "Stasiun tujuan",
		6 => "Pilihan kereta",
	];

	if(empty($param[$seq])){
		echo $label[$seq]." harus diisi".PHP_EOL;
		exit(0);
	}

	return $param[$seq];

}

$url = "https://tiket1.kereta-api.co.id/?_it8tnz=TXc9PQ==&_8dnts=YzJOb1pXUjFiR1U9";

$tahun = cekParam($argv,1);
$bulan = cekParam($argv,2);
$tgl = cekParam($argv,3);
$origination = cekParam($argv,4);
$destination = cekParam($argv,5);
$pilihanKereta = cekParam($argv,6);

$arrSearch = [];
$exploded = explode(',', $pilihanKereta);
foreach($exploded as $ex){
	if(!empty($ex)){
		$arrSearch[] = "form_".$ex;
	}
}

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
	/*$arrSearch = [
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

	];*/

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
