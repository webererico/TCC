import I2C_LCD_driver
import RPi.GPIO as GPIO
from time import *

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(16,GPIO.OUT)
GPIO.setup(20,GPIO.OUT)

GPIO.setup(21, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)
GPIO.setup(17, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)
mylcd = I2C_LCD_driver.lcd()
while True:
    if GPIO.input(21) == GPIO.LOW:
        # mylcd.lcd_display_string("eai NINA", 2)
        GPIO.output(16,GPIO.HIGH)
    if GPIO.input(17) == GPIO.HIGH:
        # mylcd.lcd_display_string("Vai da pra quem hj?", 3)
        GPIO.output(20,GPIO.HIGH)
    GPIO.output(20,GPIO.HIGH)
    GPIO.output(20,GPIO.HIGH)


