<!DOCTYPE html>
<?php
    include 'menu.php';
	$title=$_GET['title'];
	$username=$_GET['username'];
	$password=$_GET['password'];
	$description=$_GET['description'];
	$path="D:\programy\\xampp\htdocs\projekt";
	if (!file_exists ("users\\".$title)) {
	    try {
            $dirIt = new DirectoryIterator($path.'\users');
//            echo $dirIt->getPath();
//            $dirs=scandir($path.'/users/');
            $isRegistered=false;
            foreach ($dirIt as $dir) {
//                echo $dir->getFilename();
//                echo "\r\n";
                if($dir->getFilename()=='.' or $dir->getFilename()=='..')
                    continue;
//                echo $path."\\".$dir->getFilename()."\info.txt";
                $infoFile=fopen($path."\\users\\".$dir->getFilename()."\info.txt","r") or die("Unable to open a file!");
                if (trim(fgets($infoFile))==trim($username)) {
                    echo "Taki użytkownik jest już zarejestrowany!";
                    fclose($infoFile);
                    $isRegistered=true;
                    break;
                }
                fclose($infoFile);
            }
        } catch (Exception $e) {echo $e->getMessage();}
        if (!$isRegistered) {
            mkdir("users/" . $title, 0777);
//		echo "test";
            touch("users/" . $title . "/info.txt");
            $infoFilePath = "users/" . $title . "/info.txt";
            $infoFile = fopen($infoFilePath, "w") or die("Unable to open file!");
            fwrite($infoFile, $username . "\r\n");
            fwrite($infoFile, md5($password) . "\r\n");
            fwrite($infoFile, $description . "\r\n");
            #w linuxie powinno działać "\n"
            fclose($infoFile);
        }
	}
	else {
	echo "Taki blog już istnieje!";
	}
?> 
