const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})


const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})


if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})

// script.js

// Wait for the DOM content to load
document.addEventListener('DOMContentLoaded', function() {
	const videoPlayer = document.getElementById('videoPlayer');
	let mediaRecorder;
	let recordedChunks = [];

	// Check if the browser supports media devices and getUserMedia
	if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	  navigator.mediaDevices.getUserMedia({ video: true })
		.then(function(stream) {
		  // Set the video source to the stream from the camera
		  videoPlayer.srcObject = stream;

		  // Create a MediaRecorder instance to record the stream
		  mediaRecorder = new MediaRecorder(stream);

		  // When Start Recording event is triggered
		  mediaRecorder.addEventListener('start', function() {
			// Clear any previously recorded chunks
			recordedChunks = [];
		  });

		  // Listen to dataavailable event to collect recorded video chunks
		  mediaRecorder.addEventListener('dataavailable', function(event) {
			if (event.data.size > 0) {
			  recordedChunks.push(event.data);
			}
		  });

		  // Listen to stop event to process the recorded video
		  mediaRecorder.addEventListener('stop', function() {
			// Create a new Blob from the recorded chunks
			const videoBlob = new Blob(recordedChunks, { type: 'video/webm' });

			// Set the video source to the recorded video
			videoPlayer.src = URL.createObjectURL(videoBlob);
		  });

		  // Start recording immediately
		  mediaRecorder.start();
		})
		.catch(function(error) {
		  console.log('Error accessing camera:', error);
		});
	} else {
	  console.log('Media devices or getUserMedia not supported.');
	}
  });
  
 // code to logout of the system 
 // Add event listener to the logout button
const logoutButton = document.querySelector('.logout');
logoutButton.addEventListener('click', logout);

 function logout() {
	// Redirect to the login page
	window.location.href = 'index.php';
}

