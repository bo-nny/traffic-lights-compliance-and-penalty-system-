document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.login100-form');
    const submitButton = document.querySelector('.login100-form-btn');
  
    form.addEventListener('submit', function(event) {
      event.preventDefault();
  
      // Retrieve the input values
      const officerId = document.querySelector('input[name="officerid"]').value;
      const password = document.querySelector('input[name="password"]').value;
  
      // Create a FormData object to send the data to the PHP file
      const formData = new FormData();
      formData.append('officerid', officerid);
      formData.append('password', password);
  
      // Send an AJAX request to the PHP file for verification
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'verify_login.php', true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          if (response.success) {
            // Redirect to the dashboard page upon successful login
            window.location.href = 'dashboard.html';
          } else {
            // Display an error message for incorrect password
            alert('Incorrect password. Please try again.');
          }
        }
      };
      xhr.send(formData);
    });
  });
  