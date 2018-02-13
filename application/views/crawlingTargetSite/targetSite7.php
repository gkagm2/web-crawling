<?php
    define("FILE_NAME","url.txt"); //define file name
    define("FILE_STORAGE_PATH","./application/views/Python/"); //define save path
    define("DIRECTORY_NAME","twitterImgFile/");
    define("DIRECTORY_PATH","./application/views/Python/" . DIRECTORY_NAME );
    define("READ_FILE_NAME","imageSrcUrl.txt");
    define("OS_MODE","linux");
?>
<!-- URL 입력 FORM -->
<center>
    <h1>상대방 twitter의 메인 URL을 입력하세요</h1>
    <form action="" method="post">
        <input type="text" name="url">
        <input type="submit" value="크롤링 시작">
    </form>
</center>

<?php
    //GET방식이면
    if($_SERVER['REQUEST_METHOD'] == 'GET') { 
    }

    //POST방식이면
    if($_SERVER['REQUEST_METHOD'] == 'POST') { 

        

        $url =$_POST['url']; //폼으로 입력한 url을 $url에 넣는다.
        if($url == NULL){ //빈칸으로 입력하였으면
            echo "아무것도 입력하지 않았습니다."; //입력하지 않았다고 출력한다.
        } else { //url입력하고 검색 시.   <- perfect code 
            $savingUrlFile = FILE_STORAGE_PATH . FILE_NAME; //url을 저장 할 파일    
            $myfile = fopen($savingUrlFile, "w");//url.txt 파일을 열고 
            fwrite($myfile,$url); //url.txt파일에 url을 저장한다.
            fclose($myfile); //저장 후 파일을 닫는다.
        }

        $readFileName = FILE_STORAGE_PATH . READ_FILE_NAME;
        echo $readFileName;


        //파일 읽기
        // $fp = fopen($readFileName, "r");
        // $imageUrl = fread($fp, filesize($readFileName));
        // fclose($fp);

        // $fp = fopen($fileName, "r") or die("파일열기에 실패하였습니다");
        // while(!feof($fp)){
        //    $buffer .= fgets($fp)."<br>";
        // }
        // echo$buffer;
        // fclose($fp);




        // $count =0;
        // $i = 0;
        // $temp = "";
        // $imageUrlIndex[20] = ("");
        // echo $imageUrl[0];
        // while($imageUrl[$i] != NULL){ //NULL이 아니면
        //     if($imageUrl[$i] == ' '){ //공백이면
        //         $imageUrlIndex[$count];
        //         $count++;
        //         $temp = ""; 

        //     } else {
        //         $temp = $temp . $imageUrl[$i];
        //     }
        //     $i++;
        // }

        // foreach($imageUrl as $data){
        //     var_dump($data);
        // }

        // var_dump($imageUrl);


        if(OS_MODE == "linux"){ //운영체제가 리눅스면
            echo "--linux--";
            //TODO: linux 명령어 실행시키기.. 경로가 맞는지도 모르겠고 윈도우 환경에서는 어떻게 해야되는지..
            //리눅스 명령어를 실행시킨다.
            system("python ./application/views/Python/twitterPictureCrawling.py");
        } else if(OS_MODE == "windows") { //운영체제가 윈도우면
            echo "--windows--";
            //윈도우 명령어를 실행시킨다.
        }

        $numberOfFile = 0; //파일의 개수를담을 변수
        $numberOfDir = 0; //디렉토리의 개수를 담을 변수
        $fileName = "temp";
        //TODO: 파일을 가져와야 함.

        //파일이 존재하는지 여부 

        $fileName = DIRECTORY_PATH . $fileName; //파일 이름을 절대 경로로 만들어 준다.

        //파일이 존재하는지 확인
        if(file_exists($fileName)){
            echo "file exist" ;
        } else { //파일이 존재하지 않으면 
            echo "file not exist";
        }

        echo "<br>";
        //opendir함수를 이용해서 디렉토리의 핸들을 얻어옴
        $result = opendir(DIRECTORY_PATH);    

        ?>
        <button>
            download 
        </button>
        <?php
        //readdir함수를 이용해서 디렉토리에 있는 디렉토리와 파일들의 이름을 배열로 읽어들임
        while($fileName = readdir($result)) { //readdir call function으로 불러옴.
            if($fileName == false){ //fileName을 읽지 못하면
                echo "read file error"; //error 출력 
            }
            if($fileName == "." || $fileName == "..") {
                continue; //파일명이 "." 이나 ".."이면 무시
            }
            //echo "$fileName <br>";
            ?>
            <form action="">
                <input type="checkbox">
                <img src="<?= $imageUrl?>" alt="<?= $fileName?>" height="42" width="42">
            </form>

            <!--<a href="http://" download></a>-->
            <?php
            echo "<br>";

            //$fileInfo = pathinfo($fileName); //확장자를 구했죠. 
            //echo "fileInfo pathinfo : $fileInfo <br>"; //Array로 나옴.
            //$fileExt = "fileInfo : " .  $fileInfo['extension']; //파일의 확장자를 구함
            //echo "<br>fileExt is : ***$fileExt***"; //key 값으로 확장자를 받아옴. fileInfo : jpeg
            
            if(empty($fileExt)){
                $numberOfDir++; //파일에 확장자가 없으면 디렉토리로 판단하여 dir_count를 증가시킴
            } else {
                $numberOfFile++; //파일에 확장자가 있으면 file_count를 증가시킴
            }
        }
        echo "디렉토리의 갯수는 : ".$numberOfDir."<br>";
        echo "파일의 갯수는 : ".$numberOfFile;

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
    }
?>