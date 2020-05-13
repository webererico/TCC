import RPi.GPIO as GPIO
import gspread
from oauth2client.service_account import ServiceAccountCredentials
from datetime import datetime
import time

#carrega as credenciais para uso das APIs do Google

scope = ["https://spreadsheets.google.com/feeds","https://www.googleapis.com/auth/spreadsheets","https://www.googleapis.com/auth/drive.file","https://www.googleapis.com/auth/drive"]
creds = ServiceAccountCredentials.from_json_keyfile_name('credenciais.json', scope)
client = gspread.authorize(creds)

#Informa a planilha do Google Sheets a ser acessada
#Sera considerado que todas as informacoes serao escritas somente na primeira aba da planilha
# sheet = client.open('LabEnsaios').sheet1
sheet = client.open("LabEnsaios").worksheet('Sala1')

#Por tempo indeterminado,faz:

while True:
#obtem a data e hora atuais
	now = datetime.now()
	datahora = now.strftime("%d/%m/%Y %H:%M:%S")
	linha_a_ser_adicionada = [datahora, str('Teste'), str('funciona')]
	sheet.append_row(linha_a_ser_adicionada)
#aguarda um minuto
	time.sleep(5)
