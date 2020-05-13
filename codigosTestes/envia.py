import serial
import time

conecta = serial.Serial('/dev/ttyUSB0', 9600) # Configuracao da conexao

def pisca(tempo=1):
    while True:
        conecta.write('1') # Escreve 1 no arduino (LED acende)
        time.sleep(tempo) # Aguarda n segundos
        conecta.write('2') # Escreve 2 no arduino (LED apaga)
        time.sleep(tempo) # Aguarda n segundos
if __name__ == '__main__': # Executa a funcao
    pisca()
