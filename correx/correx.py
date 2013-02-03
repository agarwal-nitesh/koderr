import sys


def parse(p):
  arr=[]
  place=[]
  for i in p.split(' '):
    arr.append(int(i))
  for j in range(1,arr[0]+1):
    place.append(arr[j])
  return place


def check(queencol):
  flag=1
  for i in range(len(queencol)):
    
    for j in range(i+1,len(queencol)):
      
      t=abs((queencol[i]-queencol[j])/(i-j))
      if t==1:
        flag=0
      for k in range(j+1,len(queencol)):
        k=abs((queencol[j]-queencol[k])/(j-k))
        if t==k:
          flag=0
  
  return flag


def main():
  col=parse(sys.argv[1])
  ret=check(col)
  print ret

if __name__=='__main__':
  main()
