from bs4 import BeautifulSoup
from selenium import webdriver
# facebook site crawling test
driver = webdriver.Chrome("C:\\Users\\jjangmen\\AppData\\Local\\Programs\\Python\\Python36-32\\selenium\\webdriver\\chromedriver_win32\\chromedriver.exe")
driver.get("https://www.facebook.com")
driver.maximize_window()
driver.implicitly_wait(20)
driver.get_screenshot_as_file("./Screenshots/Facebook.png")

# 로그인

# id 입력 
driver.find_element_by_id("email").send_keys("gkagm2@naver.com")

# password 입력
driver.find_element_by_id("pass").send_keys("wkdgusaud1!")

driver.find_element_by_id("loginbutton").click()
driver.get_screenshot_as_file("./Screenshots/Facebook2.png")



