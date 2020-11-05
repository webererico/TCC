import time
import os
import RPi.GPIO as GPIO
import I2C_LCD_driver
import urllib.request
GPIO.setmode(GPIO.BCM)

# Portas utilizadas no raspberry
btn_S1 = 5 #botao S1 - reinicio de sistema
btn_S2 = 13 #botao S2 - botao desativacao controle
btn_S3 = 6 # botao S3 - reinicio servidor web
btn_S4 = 19 # botao de voltar no menu
btn_enA = 21 
btn_enB = 17
btn_encode = 26
LEDArduino = 20 # led de salvamento sensores
LEDInternet = 16 # led de comunicacao web
buzzer = 22 
# global menuTab 
global menu 
global control
menuTab = 0
menu = 0
control = False

# GPIO pinos de entrada
GPIO.setwarnings(False)
GPIO.setup(btn_S1, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_S2, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_S3, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_S4, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_enA, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_enB, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_encode, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)


# GPIO  pinos de saida
GPIO.setup(LEDArduino, GPIO.OUT)
GPIO.setup(LEDInternet, GPIO.OUT)
GPIO.setup(buzzer, GPIO.OUT)

def showMenu(menu):
    global menuTab
    mylcd.lcd_clear()
    if menuTab == 1:
        if menu == 0:
            mylcd.lcd_display_string("   --> Sala 1 <--  ", 1)
            mylcd.lcd_display_string("       Sala 2      ", 2)
            mylcd.lcd_display_string("       Sala 3      ", 3)
            mylcd.lcd_display_string("voltar", 4)
    
        elif menu == 2:
            mylcd.lcd_display_string("       Sala 1      ", 1)
            mylcd.lcd_display_string("   --> Sala 2 <--  ", 2)
            mylcd.lcd_display_string("       Sala 3      ", 3)
            mylcd.lcd_display_string("voltar", 4)
        
        elif menu == 4:
            mylcd.lcd_display_string("       Sala 1      ", 1)
            mylcd.lcd_display_string("       Sala 2      ", 2)
            mylcd.lcd_display_string("   --> Sala 3 <--  ", 3)
            mylcd.lcd_display_string("voltar", 4)
    elif  menuTab == 2:
        if menu == 0:
            mylcd.lcd_display_string("    NOME DA SALA  ", 1)
            mylcd.lcd_display_string(" --> Temperatura <--  ", 2)
            mylcd.lcd_display_string("       Umidade   ", 3)
            mylcd.lcd_display_string("voltar", 4)
        elif menu == 2:
            mylcd.lcd_display_string("    NOME DA SALA  ", 1)
            mylcd.lcd_display_string("     Temperatura      ", 2)
            mylcd.lcd_display_string("  --> Umidade  <--   ", 3)
            mylcd.lcd_display_string("voltar", 4)
    elif menuTab == 3:
        if menu == 0:
            mylcd.lcd_display_string("    NOME DA SALA  ", 1)
            mylcd.lcd_display_string(" --> set point <--  ", 2)
            mylcd.lcd_display_string("       alertas   ", 3)
            mylcd.lcd_display_string("voltar", 4)
        elif menu == 2:
            mylcd.lcd_display_string("    NOME DA SALA  ", 1)
            mylcd.lcd_display_string("     set point      ", 2)
            mylcd.lcd_display_string("  --> alertas  <--   ", 3)
            mylcd.lcd_display_string("voltar", 4)      
          
            
    
# verifica se tem conexao com a internet
def connect(host='http://google.com'):
    try:
        urllib.request.urlopen(host) #Python 3.x
        GPIO.output(LEDInternet,GPIO.HIGH)
        return True
    except:
        GPIO.output(LEDInternet,GPIO.LOW)
        return False
# test
print( "conectado a internet" if connect() else "sem conexao" )


def buttonEventHandler_S1 (pin):
    mylcd.lcd_clear()
    mylcd.lcd_display_string("Reiniciando ", 1)
    mylcd.lcd_display_string("o sistema ... ", 2)
    GPIO.output(LEDArduino,GPIO.LOW)
    GPIO.output(LEDInternet,GPIO.LOW)
    time.sleep(2.4)
    mylcd.lcd_clear()
    os.system("sudo shutdown -r now")
    

# Botao que desativa o controle e mantem somente salvando os dados
def	 buttonEventHandler_S2 (pin):
    control = not control
    mylcd.lcd_clear()
    if control is True:
        mylcd.lcd_display_string("Controle desativado", 2)
    else: 
        mylcd.lcd_display_string("Controle ativado", 3)
    time.sleep(2.4)
    mylcd.lcd_clear()
# Botao que reinicia o servidor web apache
def buttonEventHandler_S3 (pin):
    mylcd.lcd_clear()
    mylcd.lcd_display_string("Reiniciando", 3)
    mylcd.lcd_display_string("servidor web...", 4)
    GPIO.output(LEDArduino,GPIO.LOW)
    GPIO.output(LEDInternet,GPIO.LOW)
    try:
        os.system("sudo service apache2 stop")
        os.system("sudo service apache2 start")
        os.system("sudo service apache2 restart")
    except:
        print(error)
    time.sleep(2.4)
    mylcd.lcd_clear()


  
# volta no menu
def buttonEventHandler_S4 (pin):
    global menuTab
    menuTab= menuTab - 1
    global menu 
    menu = 0 
    if menuTab < 0:
        menuTab = 0
    
    print(menuTab)
    showMenu(menu)
    
# def buttonEventHandler_enA (pin):
#     if menu< 4:
#         menu = menu + 1
#     else:
#         menu = 1    
#     showMenu(menu)
# def buttonEventHandler_enB (pin):
#     if menu> 0 :
#         menu = menu -1
#     else:
#         menu = 3
#     showMenu(menu)
def buttonEventHandler_encode (pin):
    global menuTab    
    menuTab = menuTab + 1
    print('MenuTab', menuTab)
    showMenu(menu)
        
mylcd = I2C_LCD_driver.lcd()
GPIO.add_event_detect(btn_S1, GPIO.FALLING, callback=buttonEventHandler_S1)
GPIO.add_event_detect(btn_S2, GPIO.FALLING, callback=buttonEventHandler_S2)
GPIO.add_event_detect(btn_S3, GPIO.FALLING, callback=buttonEventHandler_S3)
GPIO.add_event_detect(btn_S4, GPIO.FALLING, callback=buttonEventHandler_S4)
GPIO.add_event_detect(btn_encode, GPIO.FALLING, callback=buttonEventHandler_encode)


clkLastState = GPIO.input(btn_enA)
try:  
    while True :
        clkState = GPIO.input(btn_enA)
        dtState = GPIO.input(btn_enB)
        
        if clkState != clkLastState and  menuTab >0 and  menuTab <5:     
                if dtState != clkState:
                    if(menu >= 0 ):
                        menu -= 1
                    else:
                        menu = 4
                else:
                    if(menu <= 4):
                        menu += 1
                    else:
                        menu = 0         
                print('menu', menu)
                showMenu(menu)
                
        clkLastState = clkState
        time.sleep(0.01)
        # pass  
finally:
    GPIO.cleanup()      