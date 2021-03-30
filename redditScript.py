#! usr/bin/env python3
import time
import praw
import datetime as dt
import csv
import operator
import os,glob

start_time = time.time()
dataPath ="/home/frank/Data/data/"
rootPath = "/home/frank/Data"
postLimit = 1000 #<----------------- how many reddit post are parsed per subreddit

def saveStats(output, iList):
  writeF = open(dataPath + output + ".csv", "w")
  stockIndex = 0
  for ticker in tickerList:
    writeF.write(ticker + ", " + str(iList[stockIndex]) + "\n")
    stockIndex += 1
  writeF.close()

def search(tittleList, iList):
  for word in tittleList:
    tickerIndex = 0
    if word[0] == "$":
      word = word.replace("$", '').replace(":",'').replace("(", '').replace( ")",'').replace("#", '')
    for ticker in tickerList:
      if ticker == word:
        tCount[tickerIndex] += 1
        iList[tickerIndex] += 1
        #print("matched: " + ticker)
        #break
      tickerIndex += 1

def parse(subreddit, srName):
  tempList = [0] * len(tickerList)
  for submission in subreddit.new(limit=postLimit):#<----------------------------
      wordList = submission.title.split()
      search(wordList, tempList)
  saveStats(srName, tempList)

def sortCsv(filePath):
  f = open(filePath, "r")

  csv1 = csv.reader(f, delimiter=',')

  sort = sorted(csv1, key= lambda x: int(x[1]), reverse=True)
  f.close()
  f = open(filePath, "w")
  for line in sort:
    f.write(str(line[0]) + "," + str(line[1]) + "\n")
  f.close()

def openTickerList():
    try:
        f = open(rootPath + "/formated.txt", "r")
        return f.read().split()
    except:
        print("Failed to load ticker list. Aborting")
        quit()

def saveTotalCount(tCount, tickerList):
    try:
        writeF = open(dataPath + "/output.csv", "w")
        stockIndex = 0
        for ticker in tickerList:
          writeF.write(ticker + ", " + str(tCount[stockIndex]) + "\n")
          stockIndex += 1
        writeF.close()
    except:
        print("Failed to save top 5")
        quit()


reddit = praw.Reddit(client_id='Q5PYWemlLJrxFA', \
                     client_secret='60qhmjJAAx-xbGA_-b5YJEXfOGr0wA', \
                     user_agent='Lurker', \
                     username='No-Ad7746', \
                     password='@pple559')


tickerList = openTickerList()
tCount = [0] * len(tickerList)
subReddits = open("subs.txt", "r")
subRedditList = subReddits.read().split()

for sub in subRedditList:
    try:
        print("parsing" + sub)
        parse(reddit.subreddit(sub), sub)
    except:
        print("failed: " + sub)
print('done')
subReddits.close()


saveTotalCount(tCount, tickerList)


for filename in glob.glob(os.path.join(dataPath, '*.csv')):
  sortCsv(filename)

print("--- runtime: " + str(int(((time.time() - start_time)/60)))  +"m:"+ str(int(( (time.time() - start_time) %60)*1 )) + "s")
