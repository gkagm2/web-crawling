import urllib
import urllib.request

from bs4 import BeautifulSoup
import  os
from selenium import webdriver

#http://minitoon.net/bbs/board.php?bo_table=9997 crawling

def make_soup(url):
    thepage = urllib.request.urlopen(url)
    soupdata = BeautifulSoup(thepage, "html.parser")
    return soupdata

totalfile = ""
count = 1
#url에 접속한다.
soup = make_soup("http://minitoon.net/bbs/board.php?bo_table=9997")

for c in soup.find_all('li',{"class":"gall_li "}) :
    title = c.find('li',{"class":"gall_text_href"}).text
    author = c.find('li', {"class":"manga_writer"}).text[2:]
    imglink = c.find('a') # img와 a 태그가 같이 나오기 때문에 따로 안만듬




    print(str(count) + title + "작가 : " + author)
    print(str(imglink))

    totalfile = totalfile + str(count) + title + "작가 : " + author + "\n" + str(imglink) + "\n"
    print()
    count += 1




file = open(os.path.expanduser("cartoon.csv"),"wb")
file.write(bytes(totalfile, encoding="utf-8", errors="ignore"))
file.write(bytes())



