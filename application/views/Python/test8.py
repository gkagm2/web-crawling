import urllib.request
from bs4 import BeautifulSoup

#https://pixabay.com/ko/   crawling

theurl = "https://pixabay.com/ko/"
thepage = urllib.request.urlopen(theurl)
soup = BeautifulSoup(thepage, "html.parser")

i=1
for img in soup.findAll('img'):
    temp = img.get('src')
    if temp[:1] == "/":
        continue
    else :
        image = temp

    nametemp = img.get('alt')
    if len(nametemp) == 0 :
        filename = str(i)
        i = i+1
    else :
        filename = nametemp
    imagefile = open(filename + ".jpeg", 'wb')
    imagefile.write(urllib.request.urlopen(image).read())
    print(image)






