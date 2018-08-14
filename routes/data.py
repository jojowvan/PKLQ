import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC 
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.chrome.options import Options
from selenium.common.exceptions import TimeoutException
import os
import subprocess
import json
#import MySQLdb

#db = MySQLdb.connect("localhost","root","","siapLapan")
#cursor = db.cursor()

#ignored_exceptions=(NoSuchElementException,StaleElementReferenceException,)

Daerah = []
Alat = []
Tahun = []
Fail = []

def scrape_file():
	files = driver.find_elements_by_class_name("l-Ab-T-r")
	for fail in files:
		if(fail.text != ''):
			Fail.append(fail.text)

def masuk(fail):
	actionchains = ActionChains(driver)
	actionchains.double_click(fail).perform()

driver = webdriver.Chrome(executable_path=r'D:/Driver/chromedriver.exe')

#Buka Gdrive
driver.get("https://drive.google.com")

#Masuk ke tampilan email
driver.find_element_by_xpath("/html/body/section/div[2]/div/a").click()

#Send email
driver.find_element_by_id('identifierId').send_keys("luthfijojow@gmail.com")

#Masuk ke tampilan password
driver.find_element_by_xpath("//*[@id='identifierNext']/content/span").click()
time.sleep(5)

#Send password
driver.find_element_by_xpath("//*[@id='password']/div[1]/div/div[1]/input").send_keys("ambonso123")
time.sleep(3)

#Login
elem = driver.find_element_by_xpath("//*[@id='passwordNext']/content/span").click()
time.sleep(20)
"""
#Masuk ke siapLapan
wow = driver.find_element_by_xpath("//*[contains(@id,'1NfVMffYdb1ZKSANgwFlrklY06lsARWuc')]/div[2]")
actionchains = ActionChains(driver)
actionchains.double_click(wow).perform()
"""
#Masuk ke Hapus
wow = driver.find_element_by_xpath("//*[contains(@id,'1jw_bJZ_oUpn3emL1uQblm5JGBO3_mFWg')]/div[2]")
actionchains = ActionChains(driver)
actionchains.double_click(wow).perform()

files = driver.find_elements_by_class_name('l-u-V')
for child in files:			#Biak dan Pontianak
	if(child.text != ''):
		masuk(child)
		tahun = driver.find_elements_by_class_name('l-u-V')
		for folder in tahun:	#2017 dan 2018
			if(folder.text != ''):
				masuk(folder)
				scrape_file()
				driver.execute_script("window.history.go(-1)")
		Alat.append(Fail)
		Fail = []
		driver.execute_script("window.history.go(-1)")
		Daerah.append(child.text)

print(json.dumps(Daerah))
print(json.dumps(Alat))
driver.quit()

#cur_win = driver.current_window_handle # get current/main window
#files_1 = WebDriverWait(driver, 3, ignored_exceptions=ignored_exceptions).until(EC.presence_of_element_located((By.ClassName('l-u-V'))))
#files = driver.find_elements_by_class_name('l-u-V')
#files = [a.get_attribute("href") for a in driver.find_elements_by_class_name('l-u-V')]
#files = driver.find_elements_by_class_name('l-Ab-T-r')
#files = driver.find_elements_by_css_selector("[contains('\3a 6o\2e')]")
#files = driver.find_elements_by_xpath("//*[contains(@id,':6o.1')]/div[2]/div[4]/div/span")
#files = driver.find_element_by_id("[contains(':6b')]")
#print(len(files))
#\3a 6o\2e 1949hdtUlRETfDSRHURPQuflcAjwg2r5_
#\3a 6o\2e 1949hdtUlRETfDSRHURPQuflcAjwg2r5_
#for fail in files:	#Biak dan Pontianak
#	print(fail.get_attribute("name"))
#	teks = fail.text
#	masuk(fail)
	
"""
	if(teks.isalpha() or teks.isnumeric() and '.' not in teks):
		print(teks)
		masuk(fail)
		files_1 = driver.find_elements_by_class_name('l-u-V')		
		
		for lvl_1 in files_1:	#2017 dan 2018
			teks1 = lvl_1.text
			if(teks1.isalpha() or teks1.isnumeric() and '.' not in teks):
				print(teks1)
				print(lvl_1)
				masuk(lvl_1)
				files_2 = driver.find_elements_by_class_name('l-u-V')
				
				for lvl_2 in files_2:	#Cadi dan GISTM
					teks2 = lvl_2.text
					if(teks2.isalpha() or teks2.isnumeric() and '.' not in teks):
						print(teks2)
						masuk(lvl_2)
						files_3 = driver.find_elements_by_class_name('l-u-V')
						
						for lvl_3 in files_3:	#Bulan
							teks3 = lvl_3.text
							if(teks3.isalpha() or teks3.isnumeric() and '.' not in teks):
								print(teks3)
								masuk(lvl_3)
								files_4 = driver.find_elements_by_class_name('l-u-V')
								
								for lvl_4 in files_4:	#Tanggal
									teks4 = lvl_4.text
									if(teks4.isalpha() or teks4.isnumeric() and '.' not in teks):
										print(teks4)
								driver.back()		
								#driver.execute_script("window.history.go(-1)")								
						driver.execute_script("window.history.go(-1)")
				driver.execute_script("window.history.go(-1)")
		driver.execute_script("window.history.go(-1)")
#driver.execute_script("window.history.go(-1)")

time.sleep(6000)
"""
"""
				print('lvl_1')
				masuk(lvl_1)
				files_2 = driver.find_elements_by_class_name('l-u-V')
				for lvl_2 in files_2:
					teks = lvl_2.text
					if(teks.isalpha() and '.' not in teks):
						print('lvl_2')
						masuk(lvl_2)
						files_3 = driver.find_elements_by_class_name('l-u-V')
						for lvl_3 in files_3:
							teks = lvl_3.text
							if(teks.isalpha() and '.' not in teks):
								print('lvl_3')
								masuk(lvl_3)
								files_4 = driver.find_elements_by_class_name('l-u-V')
								for lvl_4 in files_4:
									teks = lvl_4.text
									if(teks.isalpha() and '.' not in teks):
										print('lvl_4')
										masuk(lvl_4)
										#files_4 = driver.find_elements_by_class_name('l-u-V')
				#							teks = lvl_3.text	
				#								kondisi(lvl_3.text)
"""
"""
					files_4 = driver.find_elements_by_class_name('l-u-V')
					for lvl_4 in files_4:
						masuk(lvl_4)
						print('end')
						#for lvl_4 in files_4:
							#scrape_file()
"""

"""
keep_going = True
while keep_going:
	try:
		keep_going = driver.find_element_by_class_name('l-u-V').is_displayed()
		
	except:
		files = driver.find_elements_by_class_name("l-Ab-T-r")
		for fail in files:
			print(fail.text)
		keep_going = False

	if (keep_going == True):
		try:
			for fail in files:
				teks = fail.text
				if(teks.isalpha() and '.' not in teks):
		except:
			keep_going = False
"""
"""
	files = driver.find_elements_by_class_name("l-Ab-T-r")
	if(files):
		for fail in files:
			print(fail.text)
	else:
		wow = driver.find_element_by_xpath("//*[contains(@id,'1NfVMffYdb1ZKSANgwFlrklY06lsARWuc')]/div[2]")
		actionchains = ActionChains(driver)
		actionchains.double_click(wow).perform()
		time.sleep(3)
"""

"""
#Masuk ke folder siapLapan
wow = driver.find_element_by_xpath("//*[contains(@id,'1NfVMffYdb1ZKSANgwFlrklY06lsARWuc')]/div[2]")
actionchains = ActionChains(driver)
actionchains.double_click(wow).perform()
time.sleep(3)

#//*[@id=":65.1949hdtUlRETfDSRHURPQuflcAjwg2r5_"]/div[2]

#Masuk ke folder Biak
wow = driver.find_element_by_xpath("//*[contains(@id,'1949hdtUlRETfDSRHURPQuflcAjwg2r5_')]/div[2]")
actionchains = ActionChains(driver)
actionchains.double_click(wow).perform()
time.sleep(3)

#Masuk ke folder 2018
wow = driver.find_element_by_xpath("//*[contains(@id,'126Ncm4BOtdtvaYOvANh0t4ySovcUhD99')]/div[2]")
actionchains = ActionChains(driver)
actionchains.double_click(wow).perform()
time.sleep(3)

#Masuk ke folder Cadi
wow = driver.find_element_by_xpath("//*[contains(@id,'1_vRpSz31e2hhlRc5zUIEEHxVR0j9365W')]/div[2]")
actionchains = ActionChains(driver)
actionchains.double_click(wow).perform()
time.sleep(3)

#Masuk ke folder 05
wow = driver.find_element_by_xpath("//*[contains(@id,'1mHkm4jKuPc8duzA0-uOHSMwDmo1UB_Z7')]/div[2]")
actionchains = ActionChains(driver)
actionchains.double_click(wow).perform()
time.sleep(3)

#Masuk ke folder 01
wow = driver.find_element_by_xpath("//*[contains(@id,'116l8tCa5mTOOUJKRYf2zwZlT493ZvYjc')]/div[2]")
actionchains = ActionChains(driver)
actionchains.double_click(wow).perform()

#Scraping file
files = driver.find_elements_by_class_name("l-Ab-T-r")
for fail in files:
	print(fail.text)

#driver.quit()

#*[@id=":1f.1NfVMffYdb1ZKSANgwFlrklY06lsARWuc"]/div[2]/div[5]
#//*[@id=":1f.1NfVMffYdb1ZKSANgwFlrklY06lsARWuc"]/div[2]/div[3]/div/div/svg/g/path[1]
"""

#options = webdriver.ChromeOptions()
#options.add_argument('--no-startup-window')
#options.add_argument('--dump-dom')
#options.add_argument('--enable-logging=v=1')
#options.add_experimental_option("excludeSwitches",["ignore-certificate-errors"])
#options.add_argument('--no-startup-window')
#options.add_argument('--headless')
#options.add_argument("--window-size=1920x1080")
#options.add_argument('--disable-software-rasterizer')
#options.add_argument('--disable-gpu')
#options.add_argument('--no-sandbox')
#options.add_argument('window-size=0x0')
#options.add_argument('start-maximized')
#options.add_argument('disable-infobars')
#options.add_argument("--disable-extensions")

#driver.minimize_window()
#driver.set_window_position(0, 0)
#driver.set_window_size(0, 0)

#body_html = driver.find_element_by_xpath("/html/body")
#print (body_html.text)
#print (body_html.getAttribute("innerHTML"))
