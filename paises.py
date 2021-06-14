import requests
import json
import sys
#Bibliotecas.


resp = json.loads(requests.get('https://covid-api.mmediagroup.fr/v1/cases').content)
#Pega todo o json da api.

Paises = []
#Cria um Array Vazia.


for x in resp:
    Paises.append(x)
#A cada pais adiciona na array.

json_dump = json.dumps(Paises)
#Transforma o array em um json para melhor vizualiação.


print(json_dump) #Printa o json.