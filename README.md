### crawling start

+ Used goutte library
+ what is Gutte ? Goutte is a screen scraping and web crawling library for PHP. Goutte provides a nice API to crawl websites and extract data from the HTML/XML responses.
+ CodeIgniter version : 3.1.6


## 삽질 log
###20180131
+ codeigniter를 사용하기 위해 기본적인 폼이 있는 github 사이트에서 https://github.com/gkagm2/ApacheServerInitForm 폼을 받아옴.
+ https://github.com/FriendsOfPHP/Goutte 에 Installation에 composer require fabpot/goutte 하라고 나와있음. 
+ composer가 무엇인기 기억이 안나서 https://opentutorials.org/course/62/5221 에서 강좌를 봄.
+ composer를 미리 설치 해 놨기 때문에 cmd로 C:\Bitnami\wampstack-7.1.12-0\php>에서 php composer.phar로 실행해봄. (정상작동)
+ composer사이트에 들어감. https://getcomposer.org/doc/
+ cmd창에 echo @php "%~dp0composer.phar" %*>composer.bat 라고 입력하면 composer.bat파일이 생성된다하여 그대로 따라함.
+ .bat파일 생성안됨. 파일 속성들어가서 메모장으로 바꿨더니 cmd창에서 composer가 실행이 아예 안되고 메모장으로 뜸.
+ 연결파일 해제 해결방법 탐색중 (이런데서 삽질하다니........)
 https://answers.microsoft.com/ko-kr/windows/forum/windows8_1-files/%EC%97%B0%EA%B2%B0/f2024c68-f350-40b1-ab7a-41684bab92c5?auth=1 : windows7 설정방법이여서 안됨

 http://treemac.tistory.com/100 : windows10 설정방법임 완벽하게 했는데 마지막에 확인버튼을누르면 오류뜨고 안됨.

 https://www.youtube.com/watch?v=rb5df2q-Ync : 첫번째 register에있는 것은 제거하였지만 두번째 부터 해당 레지스트리 파일이 없음.
 
 HKEY_CLASSES_ROOT에 있는것을 찾음. 삭제.
 마지막도 찾음. 삭제함.
+ cmd에서 php composer.phar을 입력하면 텍스트가나옴... 후........
+ https://getcomposer.org/download/ 에서 composer를 다시 설치해봄  설치하는 와중에
~~~~
The PHP exe file you specified did not run correctly:
C:\Bitnami\wampstack-7.1.12-0\php\php.exe

The php.ini used by your command-line PHP is: C:\Bitnami\wampstack-7.1.12-0\php\php.ini

A setting in your php.ini could be causing the problem: Either the 'extension_dir' value is incorrect or the dll does not exist.

Program Output:
PHP Warning:  PHP Startup: Unable to load dynamic library 'C:/Bitnami/wampstack-7.1.12-0/php/ext\php_mysql.dll' - 지정된 모듈을 찾을 수 없습니다.
 in Unknown on line 0
~~~~
라고 뜸.
+ php composer.phar 이라하면 여전히 텍스트가 나옴. (@php "%~dp0composer.phar"%*)
+ composer require fabpot/goutte 를 cmd창에 입력하면 아무것도 안뜸. 뭔가 작업을 하고있는건가?
+ composer.json 파일을 만들어 시도해봄. 여러번 시도 끝에 받는거 성공함.
+ gitlab hook 설정함. 
+ 조금 삽질한 끝에 librarys에 composer.json파일을 만들어 cmd로 composer install을 함. goutte 패키지를 다운받음.
+ goutte.php파일을 하나 만들어서 test용으로 해보려고 하지만 require되지 않아서 안 됨
+ librarys에 옮긴후에 사용하고 싶지만 codeigniter에서 library에있는것을 어떻게 require하는지 모름.
찾아봄 http://www.ciboard.co.kr/user_guide/kr/general/creating_libraries.html

리소스 자동로딩 찾아봄 http://www.ciboard.co.kr/user_guide/kr/general/autoloader.html
application/config/config.php 에서 $config['composer_autoload']의 값을 true로 설정하여 자동로드하게 함. 실행해봤는데 안됨.
+ CI라이브러리를 사용에서 컨트롤러를 초기화해야한다고 함. http://www.ciboard.co.kr/user_guide/kr/general/libraries.html
+ 직접만든것도 초기화 해야 될 것 같아서 controller의 Main.php에 __construct 부분에 초기화 해봄.
+ 찾아봄 http://kcd2015.onoffmix.com/decks/Track1/Track1_Session4_%ED%95%9C%EB%8C%80%EC%8A%B9_CodeIgniter%EC%99%80%20Composer%20%EB%A5%BC%20%EC%9D%B4%EC%9A%A9%ED%95%9C%20%ED%94%84%EB%A1%9C%EC%A0%9D%ED%8A%B8%20%EA%B0%9C%EB%B0%9C.pdf
+ 질문 해보니 htdocs에 composer.json이 있는데 거기다가 하라고 함.
+ goutte client instance를 생성하려고 해봄. 생성 안됨.
+ 참고 http://avenir.ro/codeigniter-tutorials/codeigniter-with-composer/
+ config에서 composer autoload도 true로 설정해놨는데 왜 안될까..
+ 혹시몰라 views에 goutte.php에 있던 문장들을 controller의 Main에 function testGoutte()을 만들어서 거기다가 생성해봄. use Goutte\Client에 syntex에러가 뜬다
+ use에서 불러오는 디렉토리가 use Goutte\Client;로 되어있는데 이부분이 문제인가 싶어 검색해봄 http://www.haruair.com/blog/2843
+ codeigniter composer integration에 관한 동영상도 찾아봄 https://www.youtube.com/watch?v=HTOqj09chB8
+ 동영상대로 controllers 폴더의 Main.php에 함수하나 만들어서 include_once 'vendor/autoload.php'; 로 바꿈.
+ include_once에 경로 앞에 FCPATH 상수를 추가해서 해봄
+ use Goutte\Client; 왜 syntex에러가나는거지...
+ 다시 views에 goutte.php로 문장들을 옮김..
+ 오류가 뜸

~~~~
Type: GuzzleHttp\Exception\RequestException

Message: cURL error 51: SSL: no alternative certificate subject name matches target host name 'www.symfony.com' (see http://curl.haxx.se/libcurl/c/libcurl-errors.html)
~~~~

+ 아래와 같이 사이트를 바꾸니 된다..
~~~~
$crawler = $client->request('GET', 'http://www.smtech.go.kr/front/ifg/no/notice01_list.do');
~~~~

+ https://github.com/FriendsOfPHP/Goutte 에 메뉴얼대로 안됨... 이거 말해줘야 될 듯.
+ 

