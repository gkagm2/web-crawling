import urllib.request

from bs4 import BeautifulSoup

#twitter crawling

theurl = "https://twitter.com/realDonaldTrump"
thepage = urllib.request.urlopen(theurl)
soup = BeautifulSoup(thepage, "html.parser")

# <title> 태그를 찾아서 프린트
#print(soup.title.text) # 이렇게 해도 됨
print(soup.find("title").text)


# <a> 태그를 찾는다.
#print(soup.findAll('a'))


""""
# <a> 태그의 href 속성의 값을 출력한다.
for link in soup.find_all('a'):
    #print(link.get('href'))
    print(link.text) # text는 text부분을 가져오는 듯..
"""

# <div class="ProfileHeaderCard">로 되어있을 때
#print(soup.find('div',{"class":"ProfileHeaderCard"})) #div 태그안에 class속성의 값은 ProfileHeaderCard 입력시 이렇게 씀
#print(soup.find('div',{"class":"ProfileHeaderCard"}).find('p')) # .find('p')를 하면 p태그인 것을 찾아냄
#print(soup.find('div',{"class":"ProfileHeaderCard"}).find('p').text) # .text를 하면 p태그의 text부븐을 찾아냄

i=1
for tweets in soup.findAll('div',{"class":"content"}):
    print(i , ": ", tweets.find('p'))
    #print(i , ": ", tweets.find('p').text)
    i = i+1


