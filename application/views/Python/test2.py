#parser
from selenium import webdriver

driver = webdriver.Chrome("C:\\Users\\jjangmen\\AppData\\Local\\Programs\\Python\\Python36-32\\selenium\\webdriver\\chromedriver.exe")
driver.set_page_load_timeout(30)
driver.get('http://smartstore.naver.com/vv8788/products/528910613')
driver.maximize_window()
driver.implicitly_wait(20)
driver.get_screenshot_as_file("naver.png")
driver.quit()
