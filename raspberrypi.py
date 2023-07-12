import RPi.GPIO as GPIO
import time
import cv2
from PIL import Image
import os
import picamera
import socket
import pickle

# Suppress GPIO warnings
GPIO.setwarnings(False)

# Pin assignments for GPIO
red_pin = 17
yellow_pin = 18
green_pin = 22

# Pin assignments for ultrasonic sensor
TRIG = 21
ECHO = 20

# Set up GPIO pins as output
GPIO.setmode(GPIO.BCM)
GPIO.setup(red_pin, GPIO.OUT)
GPIO.setup(yellow_pin, GPIO.OUT)
GPIO.setup(green_pin, GPIO.OUT)

def turn_on_camera():
    camera.start()

def turn_off_camera():
    camera.release()

def turn_on_red_light():
    GPIO.output(red_pin, GPIO.HIGH)
    

def turn_off_red_light():
    # time.sleep(10)
    GPIO.output(red_pin, GPIO.LOW)

def turn_on_yellow_light():
    GPIO.output(yellow_pin, GPIO.HIGH)
    time.sleep(5)

def turn_off_yellow_light():
    GPIO.output(yellow_pin, GPIO.LOW)

def turn_on_green_light():
    GPIO.output(green_pin, GPIO.HIGH)
    time.sleep(10)

def turn_off_green_light():
    GPIO.output(green_pin, GPIO.LOW)
    
def dis_measure():
    start_time = time.time()
    while True:
        # print("running")
        GPIO.setup(TRIG, GPIO.OUT)
        GPIO.setup(ECHO, GPIO.IN)
        GPIO.output(TRIG, False)

        time.sleep(0.01)
        GPIO.output(TRIG, True)
        time.sleep(0.0001)
        GPIO.output(TRIG, False)

        while GPIO.input(ECHO) == 0:
            pulse_start = time.time()

        while GPIO.input(ECHO) == 1:
            pulse_end = time.time()

        pulse_duration = pulse_end - pulse_start
        distance = pulse_duration * 17150
        distance = round(distance, 2)
        print("Distance:", distance, "cm")
        
        if distance < 10:
            capture()
            send_image()
            # continue
        elapsed = time.time() - start_time
        if elapsed >= 10:
            break
        
def capture():      
    def capture_image():
    # Create the output folder if it doesn't exist
        output_folder = "/home/hp/TLCPS/output_images"
        if not os.path.exists(output_folder):
            os.makedirs(output_folder)

        # Set the file path and name for the captured image
        image_path = os.path.join(output_folder, "image.png")
        # Capture the image
        with picamera.PiCamera() as camera:
            camera.resolution = (1280, 720)  # Adjust the resolution as needed
            camera.start_preview()
            # Camera warm-up time
            time.sleep(2)
            camera.capture(image_path)
        # return image_path
    capture_image()

def send_image():
    # Server details
    SERVER_IP = '104.248.63.15'
    SERVER_PORT = 2125
    PASSWORD = 'bonny'

    # Path to the image file
    IMAGE_PATH = '/home/hp/TLCPS/output_images/image.png'

    # Establish TCP socket connection
    client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    client_socket.connect((SERVER_IP, SERVER_POR ))

    # Send password for authentication
    client_socket.send(PASSWORD.encode())

    # Receive authentication response
    response = client_socket.recv(1024).decode()
    if response != 'OK':
        print("Authentication failed.")
        client_socket.close()
        exit()

    # Read the image file
    with open(IMAGE_PATH, 'rb') as file:
        image_data = file.read()

    # Serialize the image data using pickle
    serialized_image = pickle.dumps(image_data)

    # Send the serialized image data
    client_socket.send(serialized_image)

    # Close the socket connection
    client_socket.close()
            
                
def main():
    timer_duration = 10
    while True:
        turn_on_red_light()
        dis_measure()   
         
        turn_off_red_light()
        turn_on_yellow_light()
        # time.sleep(5)
        turn_off_yellow_light()

        turn_on_green_light()
        # time.sleep(10)
        turn_off_green_light()
        
        turn_on_yellow_light()
        # time.sleep(5)
        turn_off_yellow_light()
        
    # Cleanup GPIO settings (this code won't be reached due to the infinite loop)
    GPIO.cleanup()
    
    
if __name__ == "__main__":
    main()
