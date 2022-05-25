import requests
import pprint


r = requests.get('https://api.vrmasterleague.com/EchoArena/Standings',params={'region':'oce'})

count = 0
while count < 20: 
  i = r.json()['teams']
  teamName = i[count ]['teamName']
  teamId = i[count]["teamID"]
  req = requests.get(f'https://api.vrmasterleague.com/Teams/{teamId}')
  plrs = []
  for j in req.json()['team']['players']:
    plrs.append(j['playerName'])
  count += 1
  print(teamName," : ",plrs)
  file_object = open('teams.txt', 'a')
  file_object.write(f'{teamName} {plrs} \n')
  file_object.close()
  
