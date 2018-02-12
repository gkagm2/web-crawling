import urllib
import urllib.request

from bs4 import BeautifulSoup
import os
from bs4.diagnose import diagnose

def make_soup(url):
    thepage = urllib.request.urlopen(url)
    soupdata = BeautifulSoup(thepage, "html.parser")
    return soupdata


#url.txt 파일을 읽는다.
with open('url.txt', 'r',encoding='utf-8') as readFile:
    url= readFile.read()
    readFile.closed

url = url + "/media"
print(url)

soup = make_soup(url)

nameCount = 1
for img in soup.find_all('div',{"class":"AdaptiveMedia-photoContainer js-adaptive-photo "}):
    print(img.find('img').get('src'))
    imgUrl = img.find('img').get('src')
    fileName = str(nameCount)
    nameCount += 1
    imagefile = open("./twitterImgFile/"+fileName + ".jpeg", 'wb')
    imagefile.write(urllib.request.urlopen(imgUrl).read())
    print(img)
