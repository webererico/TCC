#Temperatura, salvamento e regate banco
#ERICO ROSISKI WEBER
#PROJETO INTEGRADOR - ENGENHARIA CONTROLE E AUTOMACAO - UFSM 2019
#18/06
#!/usr/bin/python
#!/usr/bin/env python

import Adafruit_DHT
#import I2C_LCD_driver
import time
import mysql.connector as mariadb
import datetime

#lcdi2c = I2C_LCD_driver.lcd()
conecta = None;
while conecta is None:
	try:
		conecta =mariadb_connection = mariadb.connect(user='labensaios', password='password', database='labEnsaios')
		cursor = mariadb_connection.cursor()
	except:
		print('AVISO: Erro ao conectar-se com o banco')
# Sensor should be set to Adafruit_DHT.DHT11,
# Adafruit_DHT.DHT22, or Adafruit_DHT.AM2302.
sensor_lab = Adafruit_DHT.DHT22
sensor_sala1 = Adafruit_DHT.DHT11
sensor_sala2 = Adafruit_DHT.DHT11
sensor_exterior = Adafruit_DHT.DHT11

sensor_lab_pin = 18	
sensor_sala1_pin = 27	
sensor_sala2_pin = 22	
sensor_exterior_pin = 17

id_lab = 1
id_sala1 = 2
id_sala2 = 3
id_exterior = 4

#query de consulta
sql_lab = 'INSERT INTO laboratorios(id, spTemp, spUmid, Temp, Umid, erroTemp, erroUmid, idensaio, created_at) VALUES (null, %s, %s, %s, %s, %s, %s , null, %s)'
sql_1 = 'INSERT INTO ambiente1s(id, spTemp, spUmid, Temp, Umid, erroTemp, erroUmid, idensaio, created_at) VALUES (null, %s, %s, %s, %s, %s, %s, null, %s)'
sql_2 = 'INSERT INTO ambiente2s(id, spTemp, spUmid, Temp, Umid, erroTemp, erroUmid, idensaio, created_at) VALUES (null, %s, %s, %s, %s, %s, %s, null, %s)'
sql_e = 'INSERT INTO exteriors(id, Temp, Umid, idEnsaio) VALUES (null, %s, %s,null)'
sql_a_1 ='SELECT spTemp, spUmid, status  from ambientes where id = 1 ' 
sql_a_2 ='SELECT spTemp, spUmid, status  from ambientes where id = 2 ' 
sql_a_lab ='SELECT spTemp, spUmid, status  from ambientes where id = 3 '


# Try to grab a sensor reading.  Use the read_retry method which will retry up
# to 15 times to get a sensor reading (waiting 2 seconds between each retry).

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
	return (erro_t, erro_u)

def controlar_lab(spTemp, spUmid, temp, umid, status):
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
	return (erro_t, erro_u)


def calcular_erro(setPoint, vp):
	erro = float(vp-setPoint)
	return erro;

def exibir_dados ():
	#curs.execute('INSERT INTO aquisicao(id, idade, nome email) VALUES (id, idade, nome, email)')
	lcdi2c.lcd_display_string("TL{0:0.1f} HL:{1:0.1f}%".format(temperature_lab, humidity_lab),1)
	lcdi2c.lcd_display_string("TX{0:0.1f} HX:{1:0.1f}%".format(temperature_exterior, humidity_exterior),2)
	time.sleep(4)
	lcdi2c.lcd_clear()
	lcdi2c.lcd_display_string("T1{0:0.1f} H1:{1:0.1f}%".format(temperature_sala1, humidity_sala1),1)
	lcdi2c.lcd_display_string("T2{0:0.1f} H2:{1:0.1f}%".format(temperature_sala2, humidity_sala2),2)
	time.sleep(4)
	lcdi2c.lcd_clear()



while(1):
	ts = time.time()
	timestamp = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
	cursor.execute(sql_a_1)
	records1 = cursor.fetchall()
	cursor.execute(sql_a_2)
	records2 = cursor.fetchall()
	cursor.execute(sql_a_lab)
	records3 = cursor.fetchall()

	humidity_lab, temperature_lab = Adafruit_DHT.read_retry(sensor_lab, sensor_lab_pin)
	humidity_sala1, temperature_sala1 = Adafruit_DHT.read_retry(sensor_sala1, sensor_sala1_pin)
	humidity_sala2, temperature_sala2 = Adafruit_DHT.read_retry(sensor_sala2, sensor_sala2_pin)
	humidity_exterior, temperature_exterior = Adafruit_DHT.read_retry(sensor_exterior, sensor_exterior_pin)
#	for row in records:
#		print('SALA 1 Temp', row[0])
#		print('\nSALA 1 Umid', row[1])
#	print('Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(temperature_lab, humidity_lab))
#	print('Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(temperature_sala1, humidity_sala1))
#	print('Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(temperature_sala2, humidity_sala2))
	print('EXTERIOR')
	print('Temp={0:0.1f}*C  Humidity={1:0.1f}%'.format(temperature_exterior, humidity_exterior))
	sql_data_ex = (temperature_exterior, humidity_exterior)
	cursor.execute(sql_e, sql_data_ex)
	mariadb_connection.commit()

	for row in records3:
		print('LABORATORIO')	
		erro = controlar_lab (row[0], row[1], temperature_lab, humidity_lab, row[2])
		print('Modo Manual')
		print('Temp :', row[0])
		print('Umid :', row[1])
		print('Erro T: ', erro[0])
		print('Erro U: ', erro[1])
		sql_data_lab = (row[0], row[1], temperature_lab, humidity_lab, erro[0], erro[1], timestamp)
		cursor.execute(sql_lab, sql_data_lab)
		mariadb_connection.commit()
		 
	for row in records1:
		print('SALA 1')
		erro = controlar_sala1(row[0], row[1], temperature_sala1, humidity_sala1, row[2])
		print('Temp : ', row[0])
		print('Umid : ', row[1])
		print('Erro T: ', erro[0])
		print('Erro U: ', erro[1])
		sql_data_1 = (row[0], row[1], temperature_sala1, humidity_sala1, erro[0], erro[1], timestamp)
		cursor.execute(sql_1, sql_data_1)
		mariadb_connection.commit()

	for row in records2:
		print('\nSALA 2\n')
		erro= controlar_sala2(row[0], row[1], temperature_sala2, humidity_sala2, row[2])
		print('Temp: ', row[0])
		print('Umid: ', row[1])
		print('Erro T: ', erro[0])
		print('Erro U: ', erro[1])
		sql_data_2 = (row[0], row[1], temperature_sala2, humidity_sala2, erro[0], erro[1], timestamp)
		cursor.execute(sql_2, sql_data_2)
		mariadb_connection.commit()
#	exibir_dados()
#	time.sleep(20)




