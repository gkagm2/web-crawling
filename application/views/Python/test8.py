import urllib
import urllib.request

from bs4 import BeautifulSoup

#밤토끼 crawling

theurl = "https://webtoon.bamtoki.com/"
thepage = urllib.request.urlopen(theurl)
# print(thepage)
#soup = BeautifulSoup(thepage, "html.parser")


