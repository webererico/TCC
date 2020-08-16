import I2C_LCD_driver
import RPi.GPIO as GPIO
from time import *




GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(16,GPIO.OUT)
GPIO.setup(20,GPIO.OUT)
# GPIO.output(27,GPIO.LOW)
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
    GPIO.output(16,GPIO.LOW)
    GPIO.output(20,GPIO.LOW)


# import I2C_LCD_driver
# from time import *
# import RPi.GPIO as GPIO # Import Raspberry Pi GPIO library


# mylcd = I2C_LCD_driver.lcd()
# def button_callback(channel):
#      mylcd.lcd_display_string("eai NINA", 2)



# GPIO.setwarnings(False) # Ignore warning for now
# GPIO.setmode(GPIO.BOARD) # Use physical pin numbering
# GPIO.setup(13, GPIO.IN, pull_up_down=GPIO.PUD_DOWN) # Set pin 10 to be an input pin and set initial value to be pulled low (off)
# GPIO.add_event_detect(13, GPIO.RISING,callback=button_callback) # Setup event on pin 10 rising edge
# message = input("Press enter to quit\n\n") # Run until someone presses enter
# GPIO.cleanup() # Clean up
