from bs4 import BeautifulSoup
from selenium import webdriver
# naver cafe crawling test
driver = webdriver.Chrome("C:\\Users\\jjangmen\\AppData\\Local\\Programs\\Python\\Python36-32\\selenium\\webdriver\\chromedriver_win32\\chromedriver.exe")


#driver.get("http://cafe.naver.com/devenglish/258")
driver.get("https://nid.naver.com/nidlogin.login")

driver.maximize_window()
driver.implicitly_wait(20)
driver.get_screenshot_as_file("./Screenshots/naver.cafe1.png")

#login

#input id
driver.find_element_by_id("id").send_keys(" ")

#input_password
driver.find_element_by_id("pw").send_keys(" ")
driver.find_element_by_class_name("btn_global").click()

driver.get_screenshot_as_file("./Screenshots/naver.cafe2.png")
    
driver.get("http://cafe.naver.com/devenglish/258")
driver.maximize_window()
driver.implicitly_wait(20)

driver.get_screenshot_as_file("./Screenshots/naver.cafe3.png")

#
# driver.get_screenshot_as_file("./Screenshots/naver.cafe.png")
#
#
# driver.get("https://nid.naver.com/nidlogin.login?template=plogin&mode=form&url=http://cafe.naver.com/OpenerRedirect.nhn%3Fopenerurl%3D/devenglish/258")
# driver.maximize_window()
# driver.implicitly_wait(20)
#
#
# driver.get_screenshot_as_file("./Screenshots/naver.cafe2.png")
