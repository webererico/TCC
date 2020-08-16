# import I2C_LCD_driver
# import RPi.GPIO as GPIO
# from time import *




# GPIO.setmode(GPIO.BCM)
# GPIO.setwarnings(False)
# GPIO.setup(16,GPIO.OUT)
# GPIO.setup(20,GPIO.OUT)
# # GPIO.output(27,GPIO.LOW)
# GPIO.setup(21, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)
# GPIO.setup(17, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)
# mylcd = I2C_LCD_driver.lcd()
# while True:
#     if GPIO.input(21) == GPIO.LOW:
#         # mylcd.lcd_display_string("eai NINA", 2)
#         GPIO.output(16,GPIO.HIGH)
#     if GPIO.input(17) == GPIO.HIGH:
#         # mylcd.lcd_display_string("Vai da pra quem hj?", 3)
#         GPIO.output(20,GPIO.HIGH)
#     GPIO.output(16,GPIO.LOW)
#     GPIO.output(20,GPIO.LOW)


# import I2C_LCD_driver
# from time import *
# import RPi.GPIO as GPIO # Import Raspberry Pi GPIO library


# mylcd = I2C_LCD_driver.lcd()
# def button_callback(channel):
#      mylcd.lcd_display_string("eai NINA", 2)



# GPIO.setwarnings(False) # Ignore warning for now
# GPIO.setmode(GPIO.BOARD) # Use physical pin numbering
# GPIO.setup(19, GPIO.IN, pull_up_down=GPIO.PUD_DOWN) # Set pin 10 to be an input pin and set initial value to be pulled low (off)
# GPIO.add_event_detect(19, GPIO.RISING,callback=button_callback) # Setup event on pin 10 rising edge
# message = input("Press enter to quit\n\n") # Run until someone presses enter
# GPIO.cleanup() # Clean up


import time
import os
import RPi.GPIO as GPIO
import I2C_LCD_driver
GPIO.setmode(GPIO.BCM)

btn_S1 = 5
btn_S2 = 13
btn_S3 = 6
btn_S4 = 19
btn_enA = 21
btn_enB = 17
btn_encode = 26
LEDArduino = 20
LEDInternet = 16
buzzer = 21
global menuTab 
global menu 
menuTab = 1
menu = 1

# GPIO btn_input set up as input.
GPIO.setwarnings(False)
GPIO.setup(btn_S1, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_S2, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_S3, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_S4, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)
GPIO.setup(btn_enA, GPIO.IN, pull_up_down = GPIO.PUD_UP)
GPIO.setup(btn_enB, GPIO.IN, pull_up_down = GPIO.PUD_UP)
GPIO.setup(btn_encode, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)

GPIO.setup(LEDArduino, GPIO.OUT)
GPIO.setup(LEDInternet, GPIO.OUT)
GPIO.setup(buzzer, GPIO.OUT)

def showMenu(menu, menuTab):
    mylcd.lcd_clear()
    if menuTab ==1:
        if menu == 1:
            mylcd.lcd_display_string("   --> Sala 1 <--  ", 1)
            mylcd.lcd_display_string("       Sala 2      ", 2)
            mylcd.lcd_display_string("       Sala 3      ", 3)
    
        elif menu == 2:
            mylcd.lcd_display_string("       Sala 1      ", 1)
            mylcd.lcd_display_string("   --> Sala 2 <--  ", 2)
            mylcd.lcd_display_string("       Sala 3      ", 3)
        
        elif menu == 3:
            mylcd.lcd_display_string("       Sala 1      ", 1)
            mylcd.lcd_display_string("       Sala 2      ", 2)
            mylcd.lcd_display_string("   --> Sala 3 <--  ", 3)
    elif  menuTab ==2:
        if menu == 1:
            mylcd.lcd_display_string("   NOME DA SALA  ", 1)
            mylcd.lcd_display_string(" --> Temperatura <--  ", 3)
            mylcd.lcd_display_string("     Umidade   ", 4)
    
        elif menu == 2:
            mylcd.lcd_display_string("   NOME DA SALA  ", 1)
            mylcd.lcd_display_string("   Temperatura ", 3)
            mylcd.lcd_display_string(" --> Umidade  <--   ", 4)
    


def buttonEventHandler_S1 (pin):
    if menuTab > 0:
        menuTab = menuTab -1
    else:
         menuTab = 1
    
def	 buttonEventHandler_S2 (pin):
    GPIO.output(LEDArduino,GPIO.HIGH)
    GPIO.output(LEDInternet,GPIO.HIGH)
    GPIO.output(buzzer,GPIO.HIGH)
    print('teste')
    # print('entrou alto')
    # # turn LED off
    # GPIO.output(LED_output,False)

def buttonEventHandler_S3 (pin):
    mylcd.clear()
    mylcd.lcd_display_string("Reiniciando o Sistema", 2)
    GPIO.output(LEDArduino,GPIO.LOW)
    GPIO.output(LEDInternet,GPIO.LOW)
    os.system("sudo shutdown -r now")

def buttonEventHandler_S4 (pin):
    mylcd.clear()
    mylcd.lcd_display_string("Desligando Sistema", 2)
    GPIO.output(LEDArduino,GPIO.LOW)
    GPIO.output(LEDInternet,GPIO.LOW)
    os.system("sudo shutdown -h now")

def buttonEventHandler_enA (pin):
    if menu< 4:
        menu = menu + 1
    else:
        menu = 1    
    showMenu(menu)
def buttonEventHandler_enB (pin):
    if menu> 0 :
        menu = menu -1
    else:
        menu = 3
    showMenu(menu)
def buttonEventHandler_encode (pin):
    # menuTab = menuTab + 1
    showMenu(menu, menuTab)
    

        
mylcd = I2C_LCD_driver.lcd()

GPIO.add_event_detect(btn_S1, GPIO.FALLING, callback=buttonEventHandler_S1)
GPIO.add_event_detect(btn_S2, GPIO.FALLING, callback=buttonEventHandler_S2)
GPIO.add_event_detect(btn_S3, GPIO.FALLING, callback=buttonEventHandler_S3)
GPIO.add_event_detect(btn_S4, GPIO.FALLING, callback=buttonEventHandler_S4)
# GPIO.add_event_detect(btn_enA, GPIO.FALLING, callback=buttonEventHandler_enA)
# GPIO.add_event_detect(btn_enB, GPIO.FALLING, callback=buttonEventHandler_enB)
GPIO.add_event_detect(btn_encode, GPIO.FALLING, callback=buttonEventHandler_encode)


clkLastState = GPIO.input(btn_enA)
try:  
    while True :
        clkState = GPIO.input(btn_enA)
        if clkState != clkLastState:
                dtState = GPIO.input(btn_enB)
                if dtState != clkState:
                    if(menu <4):
                        menu += 1
                    else:
                        menu = 1           
                else:
                    if(menu > 0 ):
                        menu -= 1
                    else:
                        menu = 3 
                showMenu(menu, menuTab)
                print menu
        clkLastState = clkState
        time.sleep(0.01)
        # pass  
finally:
    GPIO.cleanup()      

