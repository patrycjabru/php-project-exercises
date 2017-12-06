<!DOCTYPE html>
<?php
    $username=$_POST['username'];
    $password=$_POST['password'];
    $date=$_POST['date'];
    $time=$_POST['time'];
//    $file1=$_POST['file1'];
//    $file2=$_POST['file2'];
//    $file3=$_POST['file3'];
    $content=$_POST['content'];
    $path="D:\programy\\xampp\htdocs\projekt";
    include 'menu.php';
    try {
        $dirIt = new DirectoryIterator($path.'\users');
        $isRegistered=false;
        foreach ($dirIt as $dir) {
            if($dir->getFilename()=='.' or $dir->getFilename()=='..')
                continue;
            $infoFile=fopen($path."\\users\\".$dir->getFilename()."\info.txt","r") or die("Unable to open a file!");
            if (trim(fgets($infoFile))==trim($username)) {
                fclose($infoFile);
                $isRegistered=true;
                $blogName=$dir->getFilename();
                break;
            }
            fclose($infoFile);
        }
        if(!$isRegistered) {
            echo "Taki użytkownik nie istnieje!";
            echo <<<HTML
			<br/><a href="menu.php">Wróc do menu głównego</a><br/>
HTML;
            exit(1);
        }
        $hashPassword=md5($password);
        $infoFile=file($path."\\users\\".$blogName."\info.txt") or die("Unable to open a file!");
        if (trim($infoFile[1])!=trim($hashPassword)) {
        	echo "Nieprawidłowe hasło!";
            echo <<<HTML
			<br/><a href="menu.php">Wróc do menu głównego</a><br/>
HTML;
        	exit(2);
        }

        $info = getdate();
        $date = $info['mday'];
        $month = $info['mon'];
        $year = $info['year'];
        $hour = $info['hours'];
        $min = $info['minutes'];
        $sec = $info['seconds'];
        if ($date<10)
            $date='0'.$date;
        if ($month<10)
            $month='0'.$month;
        if ($hour<10)
            $hour='0'.$hour;
        if ($min<10)
            $min='0'.$min;
        if ($sec<10)
            $sec='0'.$sec;
//        echo $min;
        $fileName=$year.$month.$date.$hour.$min.$sec;
//		echo $date[0].$date[1].$date[2].$date[3].$date[5].$date[6].$date[8].$date[9].$time[0].$time[1].$time[3].$time[4];
	    $allFiles=scandir($path.'\\users'.'\\'.$blogName);
//	    echo $allFiles[2];
	    $allFilesLongEnough[0]=null;
	    foreach ($allFiles as $f) {
	    	if (strlen($f)>=14)
	    		array_push($allFilesLongEnough, $f);
	    }
		array_values($allFiles);
	    foreach ($allFilesLongEnough as $f) {
//	    	echo $f;
	    	$number="";
	    	$maxNumber="";
	    	if($f[1].$f[2].$f[3].$f[4]==$year and $f[5].$f[6]==$month and $f[7].$f[8]==$date and $f[9].$f[10]==$hour and $f[11].$f[12]==$min and $f[13].$f[14]==$sec) {
	    		for ($i=15;$i<strlen($f);$i++) {
	    			$number=$number.$i;
			    }
		    }
		    else {
	    		$number="0";
		    }
            if ($maxNumber<$number)
                $maxNumber=$number;
	    }
	    $number=$maxNumber+1;
	    if ($number<10) {
	    	$number="0".$number;
	    }
	    $fileName=$fileName.$number;
//	    echo $fileName;
	    $fullPath=$path."\users\\".$blogName."\\".$fileName;
	    touch($fullPath);
        $post = fopen($fullPath, "w") or die("Unable to open file!");
//        echo $content;
        fwrite($post,$content);


        $target_dir = $path."\\users\\".$blogName;
        if (is_uploaded_file($_FILES["file1"]["tmp_name"])) {
            touch($target_dir . "\\" . $fileName."1.".pathinfo($_FILES["file1"]['name'], PATHINFO_EXTENSION));
            copy($_FILES["file1"]["tmp_name"], $target_dir . "\\" . $fileName."1.".pathinfo($_FILES["file1"]['name'], PATHINFO_EXTENSION));
        }
        if (is_uploaded_file($_FILES["file2"]["tmp_name"])) {
            touch($target_dir . "\\" . $fileName."2.".pathinfo($_FILES["file2"]['name'], PATHINFO_EXTENSION));
            copy($_FILES["file2"]["tmp_name"], $target_dir . "\\" . $fileName."1.".pathinfo($_FILES["file2"]['name'], PATHINFO_EXTENSION));
        }
        if (is_uploaded_file($_FILES["file3"]["tmp_name"])) {
            touch($target_dir . "\\" . $fileName."3.".pathinfo($_FILES["file3"]['name'], PATHINFO_EXTENSION));
            copy($_FILES["file3"]["tmp_name"], $target_dir . "\\" . $fileName."1.".pathinfo($_FILES["file3"]['name'], PATHINFO_EXTENSION));
        }
	echo <<<HTML
	<br/><a href="menu.php">Wróc do menu głównego</a><br/>
HTML;

    } catch (Exception $e) {echo $e->getMessage();}
?>
