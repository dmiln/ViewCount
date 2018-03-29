<?php
echo 'Сайт счетчика<br/>';
echo '<br/>';
$s = $_SERVER['PHP_SELF'];
$filename = "../Counter1.txt";
echo $s.'<br>';
//первый счетчик
if (file_exists($filename)){
	$handle = fopen($filename, "r+");
	$count = fread($handle, filesize($filename));
	$count++;
	echo 'просмотры: '.$count;
	fclose($handle);
	$handle = fopen($filename, "w");
	fwrite($handle, $count);
	fclose($handle);
}else{
	$count = 1;
	$handle = fopen($filename, "w+");
	fwrite($handle, $count);
	echo 'просмотры: '.$count;
	fclose($handle);
}

 //второй счетчик
echo "<br><br>";
$today = date("d.m.y");
//echo $today;
echo "<br>";
$count2 = 1;
$filename2 = "../Counter2.txt";
if (file_exists($filename2)){
	$handle2=fopen($filename2, "r+");
	$arr = file ($filename2, FILE_IGNORE_NEW_LINES);
	fclose($handle2);
	 if(($arr[0]) == $today){
		$arr[1]++;
		echo 'просмотры за '.$today.': '.sprintf("%d",$arr[1])."<br />";
		$handle2 = fopen($filename2, "w");
		fwrite($handle2,$today.PHP_EOL.$arr[1]);
		fclose($handle2);
	 }else{
		 $handle2 = fopen($filename2, "w");
		 fwrite($handle2,$today.PHP_EOL.$count2);
		 echo 'просмотры за '.$today.': '.$count2;
		 fclose($handle2);
	 }
	; 
}else{
	$handle2 = fopen($filename2, "w+");
	fwrite($handle2,$today.PHP_EOL.$count2);
	echo 'просмотры за '.$today.': '.$count2;
	fclose($handle2);
};

//третий счетчик
echo "<br><br>";
$ip = $_SERVER['REMOTE_ADDR'];
$filename3 = "../Counter3.txt";
if (file_exists($filename3)){
	$handle3 = fopen($filename3, "r+");
	$mas = file ($filename3, FILE_IGNORE_NEW_LINES);
	fclose($handle3);
	//echo $mas[0];
	$i = count($mas);
	if(!in_array($ip,$mas)){
		$handle3=fopen($filename3, "a+");
		fwrite($handle3,$ip.PHP_EOL);
		$mas1 = file ($filename3, FILE_IGNORE_NEW_LINES);
		$k = count($mas1);
		echo "обращений с уникального IP: ".$k;
		fclose($handle3);
	}else{
		echo "обращений с уникального IP: ".$i;
	}
}else{
	$handle3 = fopen($filename3, "w");
	fwrite($handle3,$ip.PHP_EOL);
	echo "обращений с уникального IP: ".$count2;
	fclose($handle3);
}

?>