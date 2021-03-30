#! usr/bin/env python3
import time
import praw
import datetime as dt
import csv
import operator
import os,glob

start_time = time.time()
dataPath =""
rootPath = ""
postLimit = 1000 #<----------------- how many reddit post are parsed per subreddit

def saveStats(output, iList):
  writeF = open(dataPath + output + ".csv", "w")
  stockIndex = 0
  for ticker in iList:
    writeF.write(ticker + ", " + str(iList[ticker]) + "\n")
  writeF.close()

def search(tittleList, iList):
  for word in tittleList:
    tickerIndex = 0

    word = word.replace("$", '').replace(":",'').replace("(", '').replace( ")",'').replace("#", '')
    if word in tickerList:
      tickerList[word] += 1
      iList[word] += 1

def parse(subreddit, srName, tempList):
  for submission in subreddit.new(limit=postLimit):
#<----------------------------
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
        temp = f.read().split()
        f.close()
        tickerDictionary = {}
        for t in temp:
            tickerDictionary[t] = 0
        return tickerDictionary

    except:
        print("Failed to load ticker list. Aborting")
        quit()

def saveTotalCount(tCount, tickerList):
    try:
        writeF = open(dataPath + "/output.csv", "w")
        stockIndex = 0
        for ticker in tickerList:
          writeF.write(ticker + ", " + str(tickerList[ticker]) + "\n")
        writeF.close()
    except:
        print("Failed to save top 5")
        quit()
def top5(g):
    t = 0
    for h in g:
        if t == 5:
            print('-------')
            break
        else:
            print(g[h])
            t+=1



reddit = praw.Reddit(client_id='Q5PYWemlLJrxFA', \
                     client_secret='60qhmjJAAx-xbGA_-b5YJEXfOGr0wA', \
                     user_agent='Lurker', \
                     username='No-Ad7746', \
                     password='@pple559')

tickerList = openTickerList()
zeroCountList = openTickerList()
tCount = [0] * len(tickerList)
subReddits = open("subs.txt", "r")
subRedditList = subReddits.read().split()

for sub in subRedditList:
    try:
        print("parsing" + sub)
        for e in zeroCountList:
            zeroCountList[e] = 0
        parse(reddit.subreddit(sub), sub, zeroCountList)
    except:
        print("failed: " + sub)
print('done')
subReddits.close()


saveTotalCount(tCount, tickerList)


for filename in glob.glob(os.path.join(dataPath, '*.csv')):
  sortCsv(filename)

print("--- runtime: " + str(int(((time.time() - start_time)/60)))  +"m:"+ str(int(( (time.time() - start_time) %60)*1 )) + "s")
