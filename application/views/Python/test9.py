import urllib
import urllib.request

from bs4 import BeautifulSoup

#http://minitoon.net/bbs/board.php?bo_table=9997 crawling

def make_soup(url):
    thepage = urllib.request.urlopen(url)
    soupdata = BeautifulSoup(thepage, "html.parser")
    return soupdata

#url에 접속한다.
soup = make_soup("http://minitoon.net/bbs/board.php?bo_table=9997")
for c in soup.find_all('li',{"class":"gall_text_href"}) :
    print(c.find('a').get('href'))

