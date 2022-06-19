#!C:\Users\DogCu\anaconda3\python.exe
#-*- coding: utf-8 -*-
import sys
import codecs
sys.stdout = codecs.getwriter("utf-8")(sys.stdout.detach())
######### 2~5번행 까지는 브라우저에서 한글을 표기하기 위한 코드##########
import cgi
import cgitb
cgitb.enable()
# cgitb는 CGI 프로그래밍시 디버깅을 위한 모듈로, cgitb.enable()
# 할 경우 런타임 에러를 웹브라우저로 전송한다
# cgitb.enable() 하지 않은 상태로 실행 중 오류가 발생한 경우
# 웹서버는 클라이언트에게 HTTP 응답코드 500을 전송한다
# HTTP 규격에서, 헤더 전송 이후에는 반드시 줄바꿈을 하게 되어있으므로 마지막에 \r\n을 전송한다
# 마지막에 \r\n을 전송하지 않으면 브라우저 측에서 오류가 발생한다
import pymysql
import requests
from bs4 import BeautifulSoup

#url에 넣기 위해 #을 기준으로 나눈다.
battletag=str(sys.argv[1])
data = battletag.split("#")

conn = pymysql.connect(host='localhost', user='root', password='qhdks12#$', db='userdb', charset='utf8')
curs = conn.cursor()

playerID = data[0]+"%23"+data[1]
##overlog 홈페이지상의 사용자고유식별자 추출
preurl = "https://overwatch.op.gg/search/?playerName="+playerID #크롤링할주소
prereq = requests.get(preurl)
prehtml = prereq.text
soup = BeautifulSoup(prehtml, 'html.parser')
isUid = soup.find("div",{"class":"GameType"})
if isUid ==None:
	sql = """UPDATE overwatchtier SET isSecret=1 WHERE battletag=%s"""
	curs.execute(sql,(battletag))
	conn.commit() 
	conn.close()	
else:	
	uidLayout = soup.find("div", {"class":"GameType"})
	uidList = uidLayout.find_all("a")
	for a in uidList:
		href = a.attrs['href']
		text = a.string	
	##href 태그로부터 앞의 14개의 문자를 제거하여 uid값만 추출
	uid = href[14:]
	
	url ="https://overwatch.op.gg/detail/overview/"+uid
	req = requests.get(url)
	html = req.text
	soup = BeautifulSoup(html, 'html.parser')
	##프로필 비공개여부 확인
	isSecret = soup.find("div",{"class":"profile-not-found"})
##프로필 비공개가 아니라면
	if isSecret == None:
		secret = 0		
		TierLayout = soup.find("div",{"class":"role-tier"})
		##탱커
		TankerTier = TierLayout.find_all("div",{"class":"role-tier__column"})[0]
		##탱커 이미지 추출
		TankerImgList = TankerTier.find_all("img")
		Tankerimglist=[]
		for a in TankerImgList:	
			Tankerimglist.append(a.attrs['src'])
		TankerBadgeImg = Tankerimglist[0]
		TankerTierImg = Tankerimglist[1]
		##탱커 티어정보
		##언랭일 경우를 판별하기위한 조건문
		if 'rank-1' in str(TankerTierImg):
			TankerTierName = 'Unranked'
			TankerScore = 'Unranked'
			TankerWinRate = TankerTier.find("b",{"class":"role-tier__winrate"}).text
		else:	
			TankerTierName = (TankerTier.find("span",{"class":"role-tier__text text-navy"}).text).strip()
			TankerScore = (TankerTier.find("b",{"class":"role-tier__score text-navy"}).text).replace(",","")
			TankerWinRate = TankerTier.find("b",{"class":"role-tier__winrate"}).text
		##딜러
		DealerTier = TierLayout.find_all("div",{"class":"role-tier__column"})[1]
		##딜러 이미지 추출
		DealerImgList = DealerTier.find_all("img")
		Dealerimglist=[]
		for a in DealerImgList:	
			Dealerimglist.append(a.attrs['src'])
		DealerBadgeImg = Dealerimglist[0]
		DealerTierImg = Dealerimglist[1]
		##딜러 티어정보
		if 'rank-1' in str(DealerTierImg):
			DealerTierName = 'Unranked'
			DealerScore = 'Unranked'
			DealerWinRate = DealerTier.find("b",{"class":"role-tier__winrate"}).text
		else:
			DealerTierName = (DealerTier.find("span",{"class":"role-tier__text text-navy"}).text).strip()
			DealerScore = (DealerTier.find("b",{"class":"role-tier__score text-navy"}).text).replace(",","")
			DealerWinRate = DealerTier.find("b",{"class":"role-tier__winrate"}).text

		##힐러
		HealerTier = TierLayout.find_all("div",{"class":"role-tier__column"})[2]
		##힐러 이미지 추출
		HealerImgList = HealerTier.find_all("img")
		Healerimglist=[]
		for a in HealerImgList:	
			Healerimglist.append(a.attrs['src'])
		HealerBadgeImg = Healerimglist[0]
		HealerTierImg = Healerimglist[1]
		##힐러 티어정보
		if 'rank-1' in str(HealerTierImg):
			HealerTierName = 'Unranked'
			HealerScore = 'Unranked'
			HealerWinRate = HealerTier.find("b",{"class":"role-tier__winrate"}).text
		else:
			HealerTierName = (HealerTier.find("span",{"class":"role-tier__text text-navy"}).text).strip()
			HealerScore = (HealerTier.find("b",{"class":"role-tier__score text-navy"}).text).replace(",","")
			HealerWinRate = HealerTier.find("b",{"class":"role-tier__winrate"}).text	
		
		sql = """UPDATE overwatchtier SET TankerTierName=%s, TankerScore=%s, DealerTierName=%s, DealerScore=%s, HealerTierName=%s, HealerScore=%s WHERE battletag=%s"""
		curs.execute(sql,(TankerTierName, TankerScore, DealerTierName, DealerScore, HealerTierName, HealerScore, battletag))
		conn.commit() 
		conn.close()
	##프로필이 비공개라면
	else:
		sql = """UPDATE overwatchtier SET isSecret=1 WHERE battletag=%s"""
		curs.execute(sql,(battletag))
		conn.commit() 
		conn.close()	

