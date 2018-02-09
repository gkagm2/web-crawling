### 해야될 것
+ crawling
+ etc ...

### crawling start

+ Used goutte library
+ what is Gutte ? Goutte is a screen scraping and web crawling library for PHP. Goutte provides a nice API to crawl websites and extract data from the HTML/XML responses.
+ CodeIgniter version : 3.1.6
+ Bootstrap version : 3.3.2


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

+ https://github.com/FriendsOfPHP/Goutte 에 메뉴얼이 주소때문에 오류가남. 제작자에게 말해줘야되나..
+ 추출하는 부분에서 h2.post > a 부분이 나온다. 이게 뭔지 알아봄

~~~~
// Get the latest post in this category and display the titles
$crawler->filter('h2.post > a')->each(function ($node) {
    print $node->text()."\n";
});
~~~~

+ Guzzle Documentation탐방 시작. http://docs.guzzlephp.org/en/stable/#
+ guzzle 동영상 : https://www.youtube.com/watch?v=GfZLYsgtm-4

+ Guzzle + domCrawler 을 이용한 심플 php 웹파싱(스크래핑) http://blog.bongwork.com/archives/137 에서 코드를 분석함.

+ 무엇이 나오는지 분석해본 결과
~~~~
echo __DIR__ . '<br>';
echo FCPATH;
~~~~

+ __DIR__와 FCPATH의 경로가 다르게 나옴.
~~~~
C:\Bitnami\wampstack-7.1.12-0\apache2\htdocs\application\views
C:\Bitnami\wampstack-7.1.12-0\apache2\htdocs\
~~~~

+ 누군가 블로그에 써온걸 가져왔는데 화면에 아무것도 안뜸... 에러일 수도 있으니 http://ra2kstar.tistory.com/102 에 에러 로그를 보여주는걸 적용함.
+ 남의 것을 가져와서 분석하기전에 view에서 testParseCode 디렉토리를 따로 만들어서 거기에 코드 집어넣고 실험해본 결과, 불러옴. 잘 나옴을 확인
+ 남의 것 분석 시작.
+ http://localhost/index.php/main/testcode1 


### 20180201
+ index.php 적기 귀찮아서 config파일에 .htaccess 수정함
+ 페이지를 시작하면Main으로 나올 수 있게 routes.php파일에서 메인 페이지 경로를 수정함.
+ localhost로 들어가면 localhost/index.php/main 에 있는 것이 뜬다.
+ 링크 입력해서 사이트에 들어가는게 번거로워서 navigate를 만듬. 화면에서 링크를 클릭하면 갈 수 있게 함.
+ 코드 분석을 함.

+ crawling하는 class를 따로 만들기로 하여 crawlingClass에 crawling.php를 만든 후 MyCrawling클래스를 하나 만듬. 공통적인 부분이 있어야 되는데.. 후..
+ site마다 크롤링해야될게 다르므로 crawlingTargetSite 디렉토리를 하나 만들어서 거기에 사이트들을 모아놓기로 결정. targetSite.php를 만들어서 크롤링해볼http://www.smtech.go.kr/front/ifg/no/notice01_list.do 사이트의 Smetch 클래스를 만듬.
+ Smetch클래스가 MyCrawling클래스를 extends하려고하는데 서로 다른 디렉토리에 있음. 다른 디렉토리에 있는 것을 연결하기위해 require와 include_once로 실험해봄
+ require는 안되고 include_once는 되길래 차이점이 궁금하여 사이트에서 조사함. http://faultnote.tistory.com/323
+ 위의 사이트에서 문장을 따왔다. 

~~~~
require() 구문

PHP 파서가 실행되기 전에 파일을 포함한다. (C 의 #include 와 같은 개념)
에러 상황시 경고를 발생시키고 이후 코드의 실행이 중단된다.  

include() 구문

PHP 프로세스가 진행되면서 파일을 포함한다. 구문을 만날때 마다 평가한다.
따라서 조건에 따라 파일을 코드를 추가하거나 제외할 수 있다.
에러 상황시 경고를 발생시킨 후 나머지 코드의 실행을 계속한다.
~~~~

+ include_once로 하면 정상 작동 되므로 예제 파일에 있는걸 참고하여 나만의 myCrawling 클래스를 만들어 보겠다. 
+ 음.. 아니다. 에러가 난다. controllers에서 myCrawling파일과 targetSite파일을 불러오니 실행이 된 것이였다.. controllers에 myCrawling파일을 적지 않으면 클래스를 찾을 수 없다고 뜬다.. 그냥 controllers에서 불러오는걸로 해야겠다.
+ bootstrap은 나중에 적용하는걸로...
+ 크롤링 도움된느 사이트 **https://lamp-dev.com/scraping-products-from-walmart-with-php-guzzle-crawler-and-doctrine/958** **http://docs.guzzlephp.org/en/stable/psr7.html#body**
+ 음 위에 사이트를 참고하여 하다보니 소스를 가지고 오긴 했다.
+ css없고, 태그없고.. 더 분석분석~

+ 전체적으로 프레임워크 가다듬음.

+ get방식으로 페이지의 내용을 가져왔으니 조리해봅세.

+ guzzle,Symfony DOM, css-selector가 없어서 패키지 다운.
~~~~
composer require guzzle/guzzle:~3.9
composer require symfony/dom-crawle
composer require symfony/css-selector
~~~~

+ $body = $response->getBody(true)로 하니  추출하는 $crawler = new Crawler($body); 부분에서 에러남 
+ 해결 방법이 나와있음 https://stackoverflow.com/questions/29898972/guzzle-response-cant-be-used-with-domcrawler
+ $body = $response->getBody()->getContents();로 바꿔서 해결.

+ echo $catsHTML;로 확인해보려하니 배열 형태임.  foreach로 하나의 배열마다 var_dump로 어떻게 나오는지 확인해봄.

+ 네이버팜에도 한번 테스트 해봄. targetSite3.php에 복붙. navigate에 추가.
+ Dom이 자꾸 언급됨 dom 검색해봄 http://php.net/manual/en/book.dom.php
+ DOM은 Document Object Model

+ html에 대해서 빠르게 공부.

+ 이해가 안가는부분이 있으니 symfony/dom-crawler에 대해서 알아봐야겠다. https://symfony.com/doc/current/components/dom_crawler.html
+ 음.....................................

### 20180205
+ guzzle 분석중. http://docs.guzzlephp.org/en/stable/psr7.html#headers
+ getBody()로 해본 결과 가져온 데이터로 네이버 사이트를 보여주는데 크롤링 할 부분인 상품평이 없다..어쩐지 안보여준다 했더니...
+ stream_get_meta_data()에 관한 링크 http://php.net/manual/en/function.stream-get-meta-data.php

+ 웹 크롤링 어플리케이션 만들기 링크 : https://www.inflearn.com/course/%EC%9B%B9-%ED%81%AC%EB%A1%A4%EB%A7%81web-crawling-%EC%96%B4%ED%94%8C%EB%A6%AC%EC%BC%80%EC%9D%B4%EC%85%98-%EB%A7%8C%EB%93%A4%EA%B8%B0/?error=login
+ 저작권
+ 저작권법 허용
  + 단순 링크 - 사이트 대표 주소를 링크
  + 직접링크 - 특정 게시물을 링크
+ 저작권법 위반
  + 프레임 링크 - 저작물의 일부를 홈페이지에 표시
  + 임베드 링크 - 저작물 전체를 홈페이지에 표시

+ 로봇 배제 표준(robots.txt)
+ 웹사이트에 로봇이 접근하는 것을 방지하기 위한 규약
+ 예제 
  + 모두 허용
    User-agent: *
    Allow: /
  + 모두 차단
    User-agent: *
    Disallow: /
  + 다양한 조합
    User-agent: googlebot   : googlebot 로봇만 적용
    Disallow: /private/   : 이 디렉토리를 접근 차단한다.
    User-agent: googlebot-news   : googlebot-news 로봇만 적용
    Disallow: /   : 모든 디렉토리를 접근 차단한다.
    User-agent: *   : 모든 로봇 적용
    Disallow: /something/   : 이 디렉토리를 접근 차단한다.
+ 실제 사이트의 robots.txt: 뿜뿌, 클리앙, SLR클럽
+ 관련 뉴스 https://byline.network/2016/02/1-64/
+ 웹 크롤링 시 데이터 못 읽어오는 이유 http://hashcode.co.kr/questions/2039/beautifulsoup%EC%9C%BC%EB%A1%9C-%EC%9B%B9%ED%81%AC%EB%A1%A4%EB%A7%81-%ED%95%A0%EB%95%8C-%EB%8D%B0%EC%9D%B4%ED%84%B0%EB%A5%BC-%EB%AA%BB-%EC%9D%BD%EC%96%B4%EC%98%A4%EB%8A%94%EA%B1%B4-%EC%96%B4%EB%96%BB%EA%B2%8C-%ED%95%B4%EA%B2%B0%ED%95%A0%EC%88%98%EC%9E%88%EC%9D%84%EA%B9%8C%EC%9A%94
+ 구글 크롤링 및 index 생성 https://www.google.com/intl/ko/insidesearch/howsearchworks/crawling-indexing.html
+ python 크롤링 강의 **https://nomade.kr/vod/crawling/127/**

### 20180206
+ crawler site : https://symfony.com/doc/current/components/dom_crawler.html
+ 이 cralwer클래스는 HTML 및 XML 문서에 대한 DOM 탐색을 용이하게 한다.
DomCrawler 구성 요소는 DOM을 조작하거나 HTML/XML을 덮어씌우도록 설계되지 않았다.

#### 사용법
DomElement objects의 instance는 기본적으로 노드를 쉽게 사용할 수 있다. 
~~~~
use Symfony\Component\DomCrawler\Crawler;

$html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <p>Hello Crawler!</p>
    </body>
</html>
HTML;

$crawler = new Crawler($html);

foreach ($crawler as $domElement) {
    var_dump($domElement->nodeName);
}
~~~~

DomCrawler는 공식적인 사양과 일치하도록 HTML을 자동으로 수정한다. 예를 들어, <p>태그 안에 <p>태그를 중첩하면 상위 태그로 이동한다. 

#### 노드 필터링
+ XPath표현식은 사용하기 쉽다.
~~~~
$crawler = $cralwer->filterXpath('descendant-or-self::body/p');
~~~~

DOMXPath::query는 XPath query를 수행하기 위해 내부적으로 사용한다.

CssSelector 구성 요소를 설치 한 경우 더욱 쉬워진다. 
~~~~
$crawler = $crawler->filter('body > p');
~~~~

익명 함수는 좀 더 복잡한 기준으로 필터링 할 수 있다.
~~~~
use Symfony\Component\DomCrawler\Crawler;
// ...

$crawler = $crawler
    ->filter('body > p')
    ->reduce(function (Crawler $node, $i) {
        // filter every other node
        return ($i % 2) == 0;
    });
~~~~

노드를 제거하려면 익명의 함수는 false를 반환해야 한다.

모든 필터 함수들은 필터된 내용이 포함된 새로운 Crawler instance를 리턴한다.

filterXPath()와 filter() 함수들은 모두 XML namespaces와 함께 작동한다. XML namespaces는 자동으로 검색되거나 직접 등록할 수 있다.
~~~~
<?xml version="1.0" encoding="UTF-8"?>
<entry
    xmlns="http://www.w3.org/2005/Atom"
    xmlns:media="http://search.yahoo.com/mrss/"
    xmlns:yt="http://gdata.youtube.com/schemas/2007"
>
    <id>tag:youtube.com,2008:video:kgZRZmEc9j4</id>
    <yt:accessControl action="comment" permission="allowed"/>
    <yt:accessControl action="videoRespond" permission="moderated"/>
    <media:group>
        <media:title type="plain">Chordates - CrashCourse Biology #24</media:title>
        <yt:aspectRatio>widescreen</yt:aspectRatio>
    </media:group>
</entry>
~~~~
+ xml에 대해서 잘 모른다. https://msdn.microsoft.com/ko-kr/library/system.xml.linq.xnamespace.xmlns(v=vs.110).aspx

filerXPath()로 Crawler namespaces 별칭을 등록 할 필요없이 필터링 할 수 있다. 
~~~~
$crawler = $crawler->filterXPaht('//default:entry/media:group//yt:aspectRatio');
~~~~

또한 filter()
~~~~
#crawler = $crawler->filter('default|entry media|group yt|aspectRatio');
~~~~

+ **동적으로 받아오는 부분은 크롤링하면 보이지 않는다. 관련 사례 : https://www.phpschool.com/gnuboard4/bbs/board.php?bo_table=qna_function&wr_id=443525&sca=&sfl=wr_subject%7C%7Cwr_content&stx=%B1%DC%BE%EE&sop=and**

+ dom_crawler
+ https://stackoverflow.com/questions/6965868/dynamic-token-parsing
+ http://php.net/manual/en/function.preg-replace-callback.php
+ https://stackoverflow.com/questions/6965868/dynamic-token-parsing
+ http://nalab.kr/qna/27850988
+ https://apps.timwhitlock.info/jparser/index.html
+ https://timwhitlock.info/tag/jparser/
+ https://davidwalsh.name/php-notifications
+ https://github.com/Seravo/wp-nettix-sync/blob/master/parser.php

+ composer에 https://davidwalsh.name/php-notifications 가 있길래 composer로 설치도 함.
+ include하는 방법을 몰라서 사용을 못함.

+ 들러봄https://packagist.org/packages/stil/curl-easy
+ composer stil/curl-easy 설치, $request = new \cURL\Request('~~~');에서 오류남 어떻게 include하는지 모름. 방법을 찾아봐야겠음.

####python
+ python설치
+ pycharm 설치
+ https://beomi.github.io/2017/01/20/HowToMakeWebCrawler/
+ beautifulsoup 설치, requests 설치
+ windows환경에서 pip로 셜치하려면 python이 설치되어있는 디렉토리로 이동 후 Script디렉토리에서 해야 함
+ 출력결과 똑같이 구매평이 안보임.
+ server side framework 'Django' 강의 :  https://developer.mozilla.org/en-US/docs/Learn/Server-side/Django/Introduction

+ http://excelsior-cjh.tistory.com/entry/04-Scrapy%EB%A5%BC-%EC%9D%B4%EC%9A%A9%ED%95%9C-%EB%89%B4%EC%8A%A4%ED%81%AC%EB%A1%A4%EB%A7%81-%ED%95%98%EA%B8%B0
+ 동기적인 방법으로 가져오기위해 selenium을 설치 (pip install selenium)
+ beautifulsoup, selenium : https://beomi.github.io/2017/02/27/HowToMakeWebCrawler-With-Selenium/
+ https://wayhome25.github.io/python/2017/04/25/cs-27-crawling/
+ test3.py 파일을 만듬 오류 생김 
~~~~
https://stackoverflow.com/questions/16626734/typeerror-module-object-is-not-callable-when-importing-selenium
~~~~

+ 어떤 문제인지 찾기 https://stackoverflow.com/questions/16626734/typeerror-module-object-is-not-callable-when-importing-selenium

+ selenium 동영상 :  https://www.youtube.com/watch?v=zRrubJ13I8s
+ selenium 동영상 : https://www.youtube.com/watch?v=oM-yAjUGO-E

### 20180207
+ selenium 동영상 :  https://www.youtube.com/watch?v=zRrubJ13I8s
+ 위의 사이트에 동영상보면서 하니 페이스북 로그인 됨.  긁기만 하면 될 듯.
+ 네이버 카페를 긁어보겠음.

+ pycharm 글꼴, 글꼴 크기, 테마 설정
+ test5.py 파일로 네이버 로그인 후 원하는 링크로 가서 해당 글이나 이미지 불러올 수 있게 만듬
+ python crawling 강의 : **https://www.youtube.com/watch?v=o0RasL5uxkg**
+ 도날드트럼프 twitter crawling 해봄 test6.py 
+ python crawling 강의 : **https://www.youtube.com/watch?v=H8wUYz22joM&t=5s**
+ https://www.youtube.com/watch?v=H8wUYz22joM&t=5s 사이트의 테이블 정보를 crawling 해봄 test7.py
+ [1:] 이게 무슨 뜻인지 검색 https://stackoverflow.com/questions/27652686/python-what-does-for-x-in-a1-mean , https://stackoverflow.com/questions/509211/understanding-pythons-slice-notation
+ .cvs 파일 형식이 무엇인   지 https://ko.wikipedia.org/wiki/CSV_(%ED%8C%8C%EC%9D%BC_%ED%98%95%EC%8B%9D)
+ test7_basketball.csv 파일에 쓰기로 해놨음.
+ 밤토끼 웹툰 사이트를 crawling해보려고 했는데 request 오류뜬다. 다른 예제를 했을 때는 잘 되는 소스 코드였는데 왜이러지... test8.py
오류 내용
~~~~
Traceback (most recent call last):
  File "C:/Bitnami/wampstack-7.1.12-0/apache2/htdocs/application/views/Python/test8.py", line 9, in <module>
    thepage = urllib.request.urlopen(theurl)
  File "C:\Users\jjangmen\AppData\Local\Programs\Python\Python36-32\lib\urllib\request.py", line 223, in urlopen
    return opener.open(url, data, timeout)
  File "C:\Users\jjangmen\AppData\Local\Programs\Python\Python36-32\lib\urllib\request.py", line 532, in open
    response = meth(req, response)
  File "C:\Users\jjangmen\AppData\Local\Programs\Python\Python36-32\lib\urllib\request.py", line 642, in http_response
    'http', request, response, code, msg, hdrs)
  File "C:\Users\jjangmen\AppData\Local\Programs\Python\Python36-32\lib\urllib\request.py", line 570, in error
    return self._call_chain(*args)
  File "C:\Users\jjangmen\AppData\Local\Programs\Python\Python36-32\lib\urllib\request.py", line 504, in _call_chain
    result = func(*args)
  File "C:\User
  s\jjangmen\AppData\Local\Programs\Python\Python36-32\lib\urllib\request.py", line 650, in http_error_default
    raise HTTPError(req.full_url, code, msg, hdrs, fp)
urllib.error.HTTPError: HTTP Error 403: Forbidden
~~~~

### 20180208
+ python을 빠르게 알려주는 90분짜리 동영상이 있다. 이걸 봄 https://www.youtube.com/watch?v=sEL6AsovDDQ&t=2225s
+ self가 뭔지 ? https://wikidocs.net/1742
+ crawling으로 img 다운로드 시도 https://uwaterloo.ca/
+ https://pixabay.com/ko/ 에 있는 사진들 다운로드 성공
+ python과 django 알려주는 사이트 : https://tutorial.djangogirls.org/ko/django_installation/
+ 크롤링해서 가져온 .jpeg 파일을 웹 브라우저에 보여주려고 하는데 엑박이 뜸. https://okky.kr/article/231083
+ 경로를 다양하게 설정해봤으나 안됨.
+ php 현재 디렉토리 경로를 출력하는 소스 : http://www.jynote.net/48

###20180209
+ bootstrap 3.3.2버전 적용
+ python os.path가 어떤것에 관한 것인지 조사 https://docs.python.org/2/library/os.path.html
+ 파일 읽고 쓰기 정보 https://wikidocs.net/26
