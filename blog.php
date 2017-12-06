<!DOCTYPE html>
<?php

$path = "D:\programy\\xampp\htdocs\projekt\users";
include 'menu.php';
echo <<<HTML
	<a href="menu.php">Wróc do menu głównego</a><br/>
HTML;
if (empty($_GET)) {
    foreach (new DirectoryIterator($path) as $blog) {
        if ($blog->isDot()) continue;
        $blogView="?name=".$blog;
        echo <<<HTML
            <a href=$blogView>$blog</a><br/>
HTML;
    }
    echo <<<HTML
            <br/><a href="CreateNewBlog.html">Utwórz nowy blog</a><br/>
HTML;

}
else {
    $blogName = $_GET["name"];
    $fullPath = $path . "\\" . $blogName;
    if (!file_exists($fullPath)) {
        echo "Nie ma takiego bloga!";
        exit(1);
    }
    $postPattern='/[0-9]/';
    $filePattern='/[0-9]+\\.+.*/';
////    echo $filePattern;
    $commentPattern='/[0-9].k/';
    $posts=array();
    $files=array();
    $comments=array();
    $listOfFiles=scandir($fullPath);
//    echo sizeof($posts);
    foreach ($listOfFiles as $singleFile) {
        if(preg_match($filePattern,$singleFile)) {
            array_push($files,$singleFile);
            continue;
        }
        if(preg_match($commentPattern,$singleFile)) {
            array_push($comments, $singleFile);
            continue;
        }
        if(preg_match($postPattern, $singleFile)) {
            array_push($posts, $singleFile);
        }
    }
//    echo sizeof($files);
//    echo sizeof($posts);
//    echo $posts[0];
//    foreach (new DirectoryIterator($fullPath) as $file) {
//        if(preg_match($postPattern, $file)) {
//            $test=array_push($posts, $file);
//            echo $test;
////            echo $posts[0];
//        }
//        if(preg_match($filePattern,$file))
//            array_push($files,$file);
//        if(preg_match($commentPattern,$file))
//            array_push($comments,$file);
//    }
//    echo $posts[0];
    sort($posts);
    sort($files);
    sort($comments);
    $infoFile=file($fullPath."\info.txt") or die("Unable to open a file!");
    echo "Użytkownik: ".$infoFile[0]."\r\n";
    echo <<<HTML
            <br/>
HTML;
    echo "Blog: ".$blogName."\r\n";
    echo <<<HTML
            <br/>
HTML;
    echo "Opis: ".$infoFile[2]."\r\n";
    echo <<<HTML
            <br/>
HTML;
	$linkPost="AddNewPost.php";
    echo <<<HTML
            <a href=$linkPost>"Dodaj wpis"</a>
HTML;
    echo <<<HTML
            <br/><br/><br/>
HTML;
//    echo sizeof($posts);
//    echo $posts[0];
	$iterator=0;
	if (sizeof($posts>0)) {
        foreach ($posts as $singlePost) {
        	$iterator++;
//            $singlePostAsArray = file($singlePost);
//	        echo $singlePost;
	        echo "WPIS ".$iterator;
            echo <<<HTML
            <br/>
HTML;
            $postAsArray=file($fullPath."\\".$singlePost);
            for ($iter=0;$iter<sizeof($postAsArray);$iter++) {
                echo $postAsArray[$iter];
                echo <<<HTML
            <br/>
HTML;
            }
            foreach ($files as $singleFile) {
            	if (preg_match("/".$singlePost."1.".".*"."/",$singleFile))
            		$file1=$singleFile;
                if (preg_match("/".$singlePost."2.".".*"."/",$singleFile))
                    $file2=$singleFile;
                if (preg_match("/".$singlePost."3.".".*"."/",$singleFile))
                    $file3=$singleFile;
            }
            if (isset($file1)) {
//            	$file1Path=$fullPath."\\$singlePost"."1.f";
                $file1Path=pathinfo($file1,PATHINFO_DIRNAME)."//users//".$blogName."//".pathinfo($file1,PATHINFO_BASENAME);
                echo <<<HTML
                
            <a href=$file1Path target="_blank" download>"Plik 1"</a><br/>
HTML;
                unset($file1);
            }
            if (isset($file2)) {
//                $file2Path=$fullPath."\\$singlePost"."2.f";
                $file2Path=pathinfo($file2,PATHINFO_DIRNAME)."//users//".$blogName."//"."//".pathinfo($file2,PATHINFO_BASENAME);
                echo <<<HTML
            <a href=$file2Path download>"Plik 2"</a><br/>
HTML;
                unset($file2);
            }
            if (isset($file3)) {
//                $file3Path=$fullPath."\\$singlePost"."3.f";
                $file3Path=pathinfo($file3,PATHINFO_DIRNAME)."//users//".$blogName."//"."//".pathinfo($file3,PATHINFO_BASENAME);
                echo <<<HTML
            <a href=$file3Path download>"Plik 3"</a><br/>
HTML;
                unset($file3);
            }










//            if (isset($file2)) {
//                echo <<<HTML
//            <a href=$fullPath."2.f">"Plik 2"</a><br/>
//HTML;
//            }
//            if (isset($file3)) {
//                echo <<<HTML
//            <a href=$fullPath."3.f">"Plik 3"</a><br/>
//HTML;
//            }
            echo <<<HTML
            <br/><br/>
HTML;
			$iteratorCom=-2;
//			echo sizeof($posts);
            if (sizeof($comments>0) and file_exists($fullPath . "\\" . $singlePost . ".k")) {
                $commentToThisPost = scandir($fullPath . "\\" . $singlePost . ".k");
//                echo sizeof($commentToThisPost);
                foreach ($commentToThisPost as $singleComment) {
                    $iteratorCom++;
                    if ($singleComment == "." or $singleComment == "..") continue;
                    echo "KOMENTARZ " . $iteratorCom;
                    echo <<<HTML
            <br/>
HTML;
                    $commentAsArray=file($fullPath . "\\" . $singlePost . ".k"."\\".$singleComment);
                    echo $commentAsArray[0];
                    echo <<<HTML
            <br/>
HTML;
                    echo $commentAsArray[1][0].$commentAsArray[1][1].$commentAsArray[1][2].$commentAsArray[1][3]."-".$commentAsArray[1][4].$commentAsArray[1][5]."-".$commentAsArray[1][6].$commentAsArray[1][7]." ".$commentAsArray[1][8].$commentAsArray[1][9].":".$commentAsArray[1][10].$commentAsArray[1][11];
                    echo <<<HTML
            <br/>
HTML;
                    echo $commentAsArray[2];
                    echo <<<HTML
            <br/>
HTML;
                    for ($it=3;$it<sizeof($commentAsArray);$it++) {
                        echo $commentAsArray[$it];
                        echo <<<HTML
            <br/>
HTML;
                    }

                    echo <<<HTML
            <br/>
HTML;
                }
                echo <<<HTML
            <br/>
HTML;
            }


                    $linkComment = "AddNewComment.php?blog=" . $blogName . "&wpis=" . $singlePost;
                    echo <<<HTML
            <a href=$linkComment>"Dodaj komentarz"</a>
HTML;
                    echo <<<HTML
            <br/><br/>
HTML;
		}
    }








}

?>