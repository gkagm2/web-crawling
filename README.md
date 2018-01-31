### crawling start

+ Used goutte library
+ what is Gutte ? Goutte is a screen scraping and web crawling library for PHP. Goutte provides a nice API to crawl websites and extract data from the HTML/XML responses.
+ CodeIgniter version : 3.1.6


## log
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
+ composer.json 파일을 만들어 시도해봄. 여러번 시도 끝에 됨.
