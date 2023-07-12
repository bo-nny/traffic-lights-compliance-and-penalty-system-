import socket
import pickle
import subprocess
import threading

# Server details
SERVER_IP = '**************'
SERVER_PORT = 3125
PASSWORD = 'bonny'

# Path to save the received images
save_path = '/usr/local/lib/python3.10/dist-packages/yolov5/captured/image.png'

# Thread function to handle client requests
def handle_client(client_socket):
    # Receive the password for authentication
    received_password = client_socket.recv(1024).decode()

    # Authenticate the client
    if received_password != PASSWORD:
        print("Authentication failed.")
        client_socket.send('Authentication failed.'.encode())
        client_socket.close()
        return

    # Send authentication response
    client_socket.send('OK'.encode())

    # Receive the serialized image data
    serialized_image = b""
    while True:
        data = client_socket.recv(4096)
        if not data:
            break
        serialized_image += data

    # Deserialize the image data using pickle
    try:
        image_data = pickle.loads(serialized_image)
    except pickle.UnpicklingError as e:
        print("Error while unpickling image data:", str(e))
        client_socket.close()
        return

    # Save the image data as a file
    #save_path = os.path.join(SAVE_PATH, IMAGE_FILENAME)
    with open(save_path, 'wb') as file:
        file.write(image_data)

    print("Image received and saved.")
 
  #  Run the command after receiving the image
    command = 'sudo yolov5 detect'
    process = subprocess.Popen(command, shell=True)
    process.wait()

    # Handle the output or further processing if needed

    # Close the client socket
    client_socket.close()

# Function to start the server and listen for client connections
def start_server():
    # Establish TCP socket connection
    server_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server_socket.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
    server_socket.bind((SERVER_IP, SERVER_PORT))
    server_socket.listen(5)  # Allow up to 5 client connections

    print("Server started. Waiting for connections...")

    while True:
        client_socket, address = server_socket.accept()
        print("Client connected:", address)

        # Start a new thread to handle the client request
        client_thread = threading.Thread(target=handle_client, args=(client_socket,))
        client_thread.start()

# Start the server
start_server()

