

#! usr/bin/env python3
import praw
import datetime as dt
import csv
import operator
import os,glob

def saveStats(output, iList):
  writeF = open("/home/Data/data/" + output + ".csv", "w")
  stockIndex = 0
  for ticker in stockList:
    writeF.write(ticker + ", " + str(iList[stockIndex]) + "\n")
    stockIndex += 1
  writeF.close()

def search(tittleList, iList):
  for word in tittleList:
    tickerIndex = 0
    if word[0] == "$":
      word = word.replace("$", '').replace(":",'').replace("(", '').replace( ")",'').replace("#", '')
    for ticker in stockList:
      if ticker == word:
        tCount[tickerIndex] += 1
        iList[tickerIndex] += 1
        #print("matched: " + ticker)
        #break
      tickerIndex += 1

def parse(subreddit, srName):
  tempList = [0] * len(stockList)
  for submission in subreddit.new(limit=1000):#<----------------------------
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

reddit = praw.Reddit(client_id='client id', \
                     client_secret='client secret', \
                     user_agent='user agent', \
                     username='username', \
                     password='password')

f = open("/home/Data/formated.txt", "r")
stockList = f.read().split()

tCount = [0] * len(stockList)
subReddits = open("subs.txt", "r")
subRedditList = subReddits.read().split()

for sub in subRedditList:
    try:
        print("parsing" + sub)
        parse(reddit.subreddit(sub), sub)
    except:
        print("failed: " + sub)
print('done 1')
subReddits.close()



writeF = open("/home/Data/data/output.csv", "w")
stockIndex = 0
for ticker in stockList:
  writeF.write(ticker + ", " + str(tCount[stockIndex]) + "\n")
  stockIndex += 1
writeF.close()

folder_path = 'data'
for filename in glob.glob(os.path.join(folder_path, '*.csv')):
  sortCsv(filename)
