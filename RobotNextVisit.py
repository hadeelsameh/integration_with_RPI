import requests
import json
import time
### check for time now
time_now = time.localtime() 
day = time.strftime("%Y-%m-%d",time_now)
timeStamp=time.strftime("%H:%M:%S",time_now)
s=timeStamp.split(":")
local_hour=int(s[0])
local_min=int(s[1])
print(local_hour ,local_min)
##dictionary to pass to api
x = {}
## covert dictionary to json object 
sorted_string = json.dumps(x, indent=4, sort_keys=True)
#requesting API
url="http://IP/LoginRegister/getid.php"
r = requests.post(url, json=x)
arr=json.loads(r.text)
IDs=[]
out=[]
for i in range(len(arr)):
    IDs.append(int(arr[i]['id']))
print(IDs)
for i in IDs :
    x = {'id': i}
    url="http://IP/LoginRegister/getVISIT.php"
    r2 = requests.post(url, json=x)
    try:
        arr2=json.loads(r2.text)
        for k in range(len(arr2)):
            splitted=arr2[k]['time'].split(":")
            hour=splitted[0]
            minute=splitted[1]
            if(int(hour) >= local_hour):
                if(int(hour) == local_hour):
                    if(int(minute) >= local_min):
                        out.append([i,hour,minute,int(arr2[k]['isvideocall'])])
                else:
                    out.append([i,hour,minute,int(arr2[k]['isvideocall'])])
    except :
        pass

for i in range(len(out)):
    
    x = {'id': out[i][0]}
    url="http://IP/LoginRegister/bed.php"
    r3 = requests.post(url, json=x)
    arr3=json.loads(r3.text)
    #print(arr3)
    for k in range(len(arr3)):
        out[i].append(int(arr3[k]['roomid']))
        out[i].append(arr3[k]['color'])
# Result array
#[ [patientid ,hour, minute, (0->measure 1->call 2->both) ,roomid ,bed_color],..]
print(out)

    
