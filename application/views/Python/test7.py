import urllib
import urllib.request
import os
from string import ascii_lowercase
from bs4 import BeautifulSoup

# http://www.basketball-reference.com/players/a/ 사이트를 crawling

#함수를 하나 만든다.
def make_soup(url):
    thepage = urllib.request.urlopen(url)
    soupdata = BeautifulSoup(thepage, "html.parser")
    return soupdata

#초기화
playerdata = playerdatasaved = ""

# for letter in ascii_lowercase: #이걸 돌리면 a부터z까지 페이지대로 가져옴.
letter = 'a'
soup = make_soup("http://www.basketball-reference.com/players/" + letter + "/") #html source를 soup로 받아옴.
for record in soup.findAll('tr'):
    playerdata = record.find('th').text #th부분을 가져옴
    for data in record.findAll('td'): #td 부분을 차례대로 가져옴
        playerdata =  playerdata + ", " + data.text
    if len(playerdata) != 0:
        playerdatasaved = playerdatasaved + "\n" + playerdata[1:] # 1:이 무슨 의미지

header = "Player, From, To, Pos, Ht, Wt, Birth, Date, College"
file = open(os.path.expanduser("Test7_Basketball.csv"), "wb")
file.write(bytes(header, encoding="ascii", errors='ignore'))
file.write(bytes(playerdatasaved, encoding="ascii", errors='ignore'))
print(header)
print(playerdatasaved)