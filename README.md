# Traffic lights compliance and penalty system 

## Description 
Traffic lights compliance and penalty system is an embedded and web-based system that captures or records video streams using a raspberry pi camera and sends them the server for analyzing through inferencing to detect the license plate.
The system uses the Africa is talking API to issue penalties to the violating drivers identified from the database.

## Requirements
1.	Raspberry pi
2.	Ultra sonic sensor 
3.	3 Led lights 
4.	Jumper cables 
5.	Breadboard
6.	Raspberry pi camera
7.	Resistors 

## Get Started
To get started with the Traffic lights compliance and penalty system flow the steps. 

## Hardware setup 
Connect the circuit with the led lights connected to 3 resistor and on the raspberry pi connect the pins to the following GPIO pin: the red_pin = 17, yellow_pin = 18, green_pin = 22.

For the sensor use the 2 ohms and 1 ohm resistor to step down the echo voltage and connect the trig and echo to GPIO 21 and  20 respectively.

## Circuit diagram
![TLCPS Device!](https://drive.google.com/file/d/1euLnVMIXa3LYagNq5uaVkPg3zU8Zk_uB/view?usp=sharing)


1.	Clone the Gitlab or Git hub repository onto you raspberry pi. Install open cv, py tesseract, Africa is talking, Yolov5 and all the necessary dependencies on both the server and the raspberry pi 4 
2.	Collect a dataset to train your Yolov5 model. Annotate the dataset.
3.	Use the new Final plates.ipynb notebook to train the model. You can use google Collab to run the notebook.
4.	Obtain a model name.pt file which is the well-trained model.
5.	Deploy the server.py on the server to accept different clients to connect on the server.
6.	Use the detection.py to run inference on the images and videos so that we obtain the license plate.
7.	Extract the text from the cropped inference image using py tesseract 
8.	Send to the dataset created before and identify the owner
9.	Send the SMS text to the owner including the penalty details. 

## Web sub system 
The web interface is for traffic lights officers that help them monitor the system performance and to show the system accuracy and detection made.

## Technologies used 
Traffic lights compliance and penalty system is built using the following technologies:
Python 3.10, Mysql, PHP, Open Cv, Css, Africa is talking API
