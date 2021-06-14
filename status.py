import requests
import json
import sys
#Bibliotecas.

resp = json.loads(requests.get('https://covid-api.mmediagroup.fr/v1/cases').content)
#Pega todo o json da api.

data_set = {
    "Pais": resp[sys.argv[1]]["All"]["country"],
    "Confirmado": resp[sys.argv[1]]["All"]["confirmed"],
    "recuperado": resp[sys.argv[1]]["All"]["recovered"],
    "mortes": resp[sys.argv[1]]["All"]["deaths"]
}
#Cria um array contendo todas as informaçoes do pais especificado.


json_dump = json.dumps(data_set)
#Transforma o array em um json para melhor vizualiação.


print(json_dump)#Printa o json.