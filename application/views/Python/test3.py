from bs4 import BeautifulSoup
from selenium import webdriver

driver = webdriver.Chrome()
driver.get("http://ntry.com/#/stats/ladder/date.php?date=2014-01-04")

html = driver.page_source
soup = BeautifulSoup(html, "html.parser")

prodList = soup.find_all("td", {"class": "round_cell"})
print(prodList)