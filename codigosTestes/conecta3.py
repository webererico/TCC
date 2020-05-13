
import serial
import sys
import string
import time
import mysql.connector as mariadb
import datetime
import I2C_LCD_driver

#IDs DAS SALAS NO BANCO DA DADOS
id_lab = 1
id_sala1 = 2
id_sala2 = 3
id_exterior = 4

#ULTIMO ESTADO DE CADA AMBIENTE
estado_lab = 0
estado_sala1 = 0
estado_sala2 = 0
estado_exterior= 0
#CONTROLE DO AMBIENTE
controle_lab = 0
controle_sala1 = 0
controle_sala2 = 0

#QUERYS DE CONSULTA E INSERSAO
sql_lab = 'INSERT INTO laboratorios(id, spTemp, spUmid, temp, umid, eTemp, eUmid, energia, created_at) VALUES (null, %s, %s, %s, %s, %s, %s , %s, %s)'
sql_1 = 'INSERT INTO sala1s(id, spTemp, spUmid, temp, umid, eTemp, eUmid, energia, created_at) VALUES (null, %s, %s, %s, %s, %s, %s, null, %s)'
sql_2 = 'INSERT INTO sala2s(id, spTemp, spUmid, temp, umid, eTemp, eUmid, energia, created_at) VALUES (null, %s, %s, %s, %s, %s, %s, null, %s)'
sql_e = 'INSERT INTO exteriors(id, temp, umid, energia, created_at) VALUES (null, %s, %s,null, %s)'
sql_a_1 ='SELECT spTemp, spUmid, status, maxTemp, minTemp, maxUmid, minUmid  from ambientes where id = 1 '
sql_a_2 ='SELECT spTemp, spUmid, status, maxTemp, minTemp, maxUmid, minUmid  from ambientes where id = 2 '
sql_a_lab ='SELECT spTemp, spUmid, status, maxTemp, minTemp, maxUmid, minUmid  from ambientes where id = 3 '

# CRIA O OBJETO DO DISPLAY
mylcd = I2C_LCD_driver.lcd()

#FUNCAO PARA CONECTAR NO BANCO
def conecta_banco():
	conecta = None
	while conecta is None:
		try:
			conecta =mariadb_connection = mariadb.connect(user='labensaios', password='labensaios', database='labEnsaios')
			cursor = mariadb_connection.cursor()
			mylcd.lcd_display_string("Database Conectado ",1)
			print('Banco conectado')
			time.sleep(1)
		except:
			mylcd.lcd_display_string("Erro Database ",1)
			print('AVISO: Erro ao conectar-se com o banco')
			time.sleep(1)
	return conecta, cursor, mariadb_connection

#FUNCAO CONECTA COM O ARDUINO
def conecta_arduino():
	ser = None
	while ser is None:
		try:
			ser = serial.Serial("/dev/ttyUSB0", 9600)
			mylcd.lcd_display_string("Arduino Conectado ",2)
			print('Arduino Conectado')
			time.sleep(1)
			mylcd.lcd_display_string("Iniciando Sistema", 3)
			time.sleep(1)
		except:
			mylcd.lcd_display_string("Erro Arduino ",2)
			print('Erro Conexao USB - Arduino')
			time.sleep(1)
	return ser;

def controlar_sala1(spTemp, spUmid, temp, umid, status):
	erro_t=  calcular_erro(spTemp, temp)
	erro_u = calcular_erro(spUmid, umid)
	if(status == "automatico"):
		print('Modo automatico')
		if erro_t>0:
			print('DIMINUI TEMPERATURA')
			if(erro_u>0):
				print('DIMINUIR UMIDADE')
			else:
				print('AUMENTAR UMIDADE')
		else:
			print('AUMENTA TEMPERATURA')
			if(erro_u>0):

				print('DIMINUIR UMIDADE')
			else:
				print('AUMENTAR UMIDADE')
	else:
		print('Modo Manual')
	return (erro_t, erro_u)


def controlar_sala2(spTemp, spUmid, temp , umid, status):
	erro_t=  calcular_erro(spTemp, temp)
	erro_u = calcular_erro(spUmid, umid)
	if(status == "automatico"):
		print('Modo automatico')
		if erro_t>0:
			print('DIMINUI TEMPERATURA')
			if(erro_u>0):
				print('DIMINUIR UMIDADE')
			else:
				print('AUMENTAR UMIDADE')
		else:
			print('AUMENTA TEMPERATURA')
			if(erro_u>0):
				print('DIMINUIR UMIDADE')
			else:
				print('AUMENTAR UMIDADE')
	else:
		print('Modo Manual')
	return (erro_t, erro_u)

def controlar_lab(spTemp, spUmid, temp, umid, status, estado_lab):
	erro_t=  calcular_erro(spTemp, temp)
	erro_u = calcular_erro(spUmid, umid)
	if(status == "automatico"):
		print('Modo automatico')
		if erro_t>0:
			print('DIMINUI TEMPERATURA')
			estado_lab = envia_comando(round(spTemp), estado_lab)
			if(erro_u>0):
				print('DIMINUIR UMIDADE')
			else:
				print('AUMENTAR UMIDADE')
		else:
			print('AUMENTA TEMPERATURA')
			estado_lab = envia_comando(round(spTemp), estado_lab)
			if(erro_u>0):
				print('DIMINUIR UMIDADE')
			else:
				print('AUMENTAR UMIDADE')
	else:
		print('Modo Manual')
	return (erro_t, erro_u)

def calcular_erro(setPoint, vp):
	erro = float(vp-setPoint)
	return erro;

def envia_comando(comando, estado):
	# if(comando != estado):
	# 	ser.write(1)
	# 	print('comando enviado', comando)
		return estado

def informa_estado(controle_lab , controle_sala1, controle_sala2):
	mylcd.lcd_display_string("LAB: ",2, 0)
	mylcd.lcd_display_string("S1: ",2, 6)
	mylcd.lcd_display_string("S2: ",2, 11)
	if(controle_lab == "manual"):
		mylcd.lcd_display_string("M",2, 4)
	else:
		mylcd.lcd_display_string("A",2, 4)
	if(controle_sala1 == "manual"):
		mylcd.lcd_display_string("M",2, 9)
	else:
		mylcd.lcd_display_string("A",2, 9)
	if(controle_sala2 == "manual"):
		mylcd.lcd_display_string("M",2, 14)
	else:
		mylcd.lcd_display_string("A",2, 14)

conecta, cursor, mariadb_connection= conecta_banco()
ser = conecta_arduino()
mylcd.lcd_clear()
while ser is not None and conecta is not None:
	try :

	 	try:
			data =ser.readline()
			print (data)
	 		dados =data.split(" ")
			#print('Dado 0',dados[0])
			#print('Dado 10', dados[9])
	 		dado = str(dados[0])
	 		if dado =='s':
				mylcd.lcd_display_string("Ard:OK DB:OK SYS:ON ",1)
	 			del(dados[0])
	 			del(dados[9])
				print (dados)
	 			dados = [float(i) for i in dados]
 		  		ts = time.time()
				timestamp = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
				cursor.execute(sql_a_1)
				records1 = cursor.fetchall()
				cursor.execute(sql_a_2)
				records2 = cursor.fetchall()
				cursor.execute(sql_a_lab)
				records3 = cursor.fetchall()

				# time.sleep(2)
# EXTERIOR
				print('EXTERIOR')
				print('Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(dados[6],dados[7]))
				sql_data_ex = (dados[6], dados[7], timestamp)
		 		cursor.execute(sql_e, sql_data_ex)
				mariadb_connection.commit()
#LABORATORIO
				for row in records3:
					print('LABORATORIO')
					controle_lab = row[2]
					erro = controlar_lab (row[0], row[1], dados[0], dados[7], row[2], estado_lab)
					print('Temp: ', dados[0])
					print('Umid: ', dados[1])
					print('spTemp : ', row[0])
					print('spUmid : ', row[1])
					print('Erro T: ', erro[0])
					print('Erro U: ', erro[1])
					sql_data_lab = (row[0], row[1], dados[0], dados[1], erro[0], erro[1],dados[7], timestamp)
					cursor.execute(sql_lab, sql_data_lab)
					mariadb_connection.commit()
					mylcd.lcd_display_string("Temp:{0:.1f}".format(dados[0]),4,0)
					mylcd.lcd_display_string("U:{0:.1f} %".format(dados[1]),4, 11)
					
#SALA 1
				for row in records1:
					print('SALA 1')
					controle_sala1 = row[2]
					erro = controlar_sala1(row[0], row[1], dados[2], dados[3], row[2])
					print('Temp: ', dados[2])
					print('Umid: ', dados[3])
					print('spTemp : ', row[0])
					print('spUmid : ', row[1])
					print('Erro T: ', erro[0])
					print('Erro U: ', erro[1])
					sql_data_1 = (row[0], row[1], dados[2], dados[3], erro[0], erro[1], timestamp)
					cursor.execute(sql_1, sql_data_1)
					mariadb_connection.commit()
#SALA 2
				for row in records2:
					print('\nSALA 2\n')
					controle_sala2 = row[2],
					erro= controlar_sala2(row[0], row[1], dados[4], dados[5], row[2])
					print('Temp: ', dados[4])
					print('Umid: ', dados[5])
					print('spTemp : ', row[0])
					print('spUmid : ', row[1])
					print('Erro T: ', erro[0])
					print('Erro U: ', erro[1])
					sql_data_2 = (row[0], row[1], dados[4], dados[5], erro[0], erro[1], timestamp)
					cursor.execute(sql_2, sql_data_2)
					mariadb_connection.commit()

				informa_estado(controle_lab, controle_sala1, controle_sala2)
				time.sleep(60)
			elif (dado == 'e'):
				mylcd.lcd_clear()
				mylcd.lcd_display_string("Erro na leitura",2)
				mylcd.lcd_display_string("dos sensores",3)
				mylcd.lcd_display_string("Reinicie o Arduino",4)
				time.sleep(2)
	 	except:
	 		print "Unexpected error:", sys.exc_info()
	 		sys.exit()
	except:
			ser.close()
			mylcd.lcd_clear()
			mylcd.lcd_display_string("Erro DB ou Arduino",1)
			mylcd.lcd_display_string("Reconectando...",2)
	 		conecta =conecta_banco()
	 		ser = conecta_arduino()
			mylcd.lcd_clear()


mylcd.lcd_display_string("Ard: OK | DB:OK ",1)
