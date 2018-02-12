<?php
    define("FILE_NAME","url.txt"); //define file name
    define("FILE_PATH","./application/views/Python/"); //define save path
    define("DIRECTORY_PATH","./application/views/Python/twitterImgFile/");
?>

<center>
    <h1>상대방 twitter의 메인 URL을 입력하세요</h1>
    <form action="" method="post">
        <input type="text" name="url">
        <input type="submit" value="크롤링 시작">
    </form>
</center>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET') { //*
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') { // *
        $url =$_POST['url'];
        if($url == NULL){ //입력하지않고 검색 시.
            echo "아무것도 입력하지 않았습니다.";
        } else { //url입력하고 검색 시.   <- perfect code 
            $myfile = fopen(FILE_PATH . FILE_NAME, "w");//url.txt 파일에 url을 입력한다.
            fwrite($myfile,$url); 
            fclose($myfile);
        }


        $file_count = 0; //파일의 개수를담을 변수
        $dir_count = 0; //디렉토리의 개수를 담을 변수
        $file_name = "1.jpeg";
        if(file_exists(DIRECTORY_PATH . $file_name)){ //파일이 존재하는지 여부 
            echo "file exist" ;

            //opendir함수를 이용해서 디렉토리의 핸들을 얻어옴
            $result = opendir(FILE_PATH . "twitterImgFile"); 

            //readdir함수를 이용해서 디렉토리에 있는 디렉토리와 파일들의 이름을 배열로 읽어들임
            while($file = readdir($result)) { //readdir call function으로 불러옴.
                if($file == false){ //file을 읽지 못하면
                    echo "read file error"; //error 출력 
                }
                if($file == "." || $file == "..") {
                    continue; //파일명이 "." 이나 ".."이면 무시
                }
                $fileInfo = pathinfo($file); //확장자를 구했죠. 
                echo "fileInfo pathinfo : $fileInfo <br>"; //Array로 나옴.
                $fileExt = "fileInfo : " .  $fileInfo['extension']; //파일의 확장자를 구함
                echo "<br>fileExt is : ***$fileExt***"; //key 값으로 확장자를 받아옴. fileInfo : jpeg
            }


        } else { //파일이 존재하지 않으면 
            echo "file not exist";
        }
        

        if(empty($fileExt)){
            $dir_count++; //파일에 확장자가 없으면 디렉토리로 판단하여 dir_count를 증가시킴
            echo $dir_count;
        } else {
            $file_count++; //파일에 확장자가 있으면 file_count를 증가시킴
            echo $file_count;
        }

        echo "디렉토리의 갯수는 : ".$dir_count."<br>";
        echo "파일의 갯수는 : ".$file_count;

    ///////////////////////////////////
    /*
        function dirZip($resource,$dir) { 
            if(filetype($dir) === 'dir') {
              clearstatcache(); 
       
                if($fp = @opendir($dir)) { 
                    while(false !== ($ftmp = readdir($fp))){ 
                        if(($ftmp !== ".") && ($ftmp !== "..") && ($ftmp !== "")) { 
                            if(filetype($dir.'/'.$ftmp) === 'dir') { 
                                clearstatcache();   
            
                                // 디렉토리이면 생성하기 
                                $resource->addEmptyDir($dir.'/'.$ftmp); 
                                set_time_limit(0);   
                                
                                dirZip($resource,$dir.'/'.$ftmp); 
                            } else { 
                                // 파일이면 파일 압축하기 
                                $resource->addFile($dir.'/'.$ftmp); 
                            }
                        }
                    }
                  if(is_resource($fp)){ 
                        closedir($fp); 
                  } 
            } else { 
                // 파일이면 파일 압축하기 
                $resource->addFile($dir); 
            }
        } // end func 
       
       
       
       
        // 압축할 디렉토리 
        $dir = 'mail'; 
       
        // 압축파일 이름 
        $zipfile = "zipfile.zip"; 
       
        $zip = new ZipArchive; 
        $res = $zip->open($zipfile, ZipArchive::CREATE); 
        if ($res === TRUE) {        
             dirZip($zip,$dir); 
             $zip->close(); 
        } else { 
             echo "에러 코드: ".$res; 
        }
        */
////////////////////////////////////





        // $filepath = FILE_PATH ."twitterImgFile/"."$filename.jpeg";
        // echo $filepath;

        ?>
        <!--
        <a href="<?=$filepath ?>" download>download</a>
    -->
        <?php
        }

?>