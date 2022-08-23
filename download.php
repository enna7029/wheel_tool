<?php

//copy下载
function download1()
{
	$path='download1/';
	$name=mt_rand(1,1000).time().'.jpg';
	@mkdir($path,0777,true);
	$image_url=$path.$name;

	copy('http://file.nantang-tech.com/uploads/20200703/54d5b0e71a1d949effa3803aadd59a2b.jpg',$image_url);
}

//fopen和curl下载
function download2()
{
	$path='download2/';
	$name=mt_rand(1,1000).time().'.jpg';
	@mkdir($path,0777,true);
	$image_url=$path.$name;

	$curl=curl_init();
	$fp=fopen($image_url,'wb');
	curl_setopt($curl,CURLOPT_URL,'http://file.nantang-tech.com/uploads/20200703/54d5b0e71a1d949effa3803aadd59a2b.jpg');
	curl_setopt($curl,CURLOPT_FILE,$fp);
	curl_setopt($curl,CURLOPT_HEADER,0);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($curl,CURLOPT_TIMEOUT,60);
	curl_exec($curl);
	curl_close($curl);
	fclose($fp);
	return true;
}

//readfile,ob_get_contents和file_put_contents
function download3()
{
	$path='download3/';
	$name=mt_rand(1,1000).time().'.jpg';
	@mkdir($path,0777,true);
	$image_url=$path.$name;

	$arrContextOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ]
    ];

    ob_start(); 
    @readfile('http://file.nantang-tech.com/uploads/20200703/54d5b0e71a1d949effa3803aadd59a2b.jpg', false, stream_context_create($arrContextOptions)); 
    $img = ob_get_contents(); 
    ob_end_clean();
    file_put_contents($image_url, $img);
}

//fopen和header
function download4()
{
	$path='download4/';
	$name=mt_rand(1,1000).time().'.jpg';
	@mkdir($path,0777,true);
	$image_url=$path.$name;

	$file='http://file.nantang-tech.com/uploads/20200703/54d5b0e71a1d949effa3803aadd59a2b.jpg';
	header("Content-type:application/octet-stream");
	header("Content-Disposition:attachment;filename = " . basename($file));
	header("Accept-ranges:bytes");
	header("Accept-length:" . filesize($file));
	$handle = fopen($file, 'rb');
	while (!feof($handle)) {
	    echo fread($handle, 102400);
	}
	fclose($handle);
}




