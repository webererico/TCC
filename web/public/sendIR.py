import serial #BIBLIOTECA SERIAL
import sys #BIBLIOCA SISTEMA


#!/usr/bin/env python3
#importa as bibliotecas
import serial
import time
import IRcodes

if __name__ == '__main__':
    print 'Number of arguments:', len(sys.argv), 'arguments.'
    print 'Argument List:', str(sys.argv)
    # ser = serial.Serial('/dev/ttyUSB0', 9600) # estabelece a conexao com a COM3 a 9600 de baud rate
    # while True:
        #ser.write(ir1.encode()) #enviar serial a variavel ir
        #time.sleep(1)
        #ser.write(ir2.encode())
        #time.sleep(1)
        #ser.write(ir3.encode())
	# ser.write(IRcodes.irSignal1_17)
	#ser.write("\n")
	#ser.write(variaveis.irSignal1_17)
	#print("enviou")
        #time.sleep(10)

    ser.close()
