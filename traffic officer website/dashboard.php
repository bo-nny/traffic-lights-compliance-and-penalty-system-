<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="./css/style.css">

	<title>Traffic Offiver Hub</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<!-- <i class='bx bxs-smile'></i> -->
			<img src="./images/images.jpeg" alt="Smile Image" style="width: 30px; height: 50px;margin-left: 5px;">


			<span class="text" style="color: white">TLCP System</span>
		</a>
    
		<span class="tool" style="color: white">Service Tools</span>
		
		<ul class="side-menu top">
			<li class="active">
				<a href="#" id="Fined">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Fined</span>
				</a>
			</li>
      
			</li>

			<li>
				<a href="#" id="Unfined">
					<i class='bx bxs-group' ></i>
					<span class="text">Results</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<button class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
        </button>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link" style="color: white;">Licenese Plate Number</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
      <h3> Dark mode</h3>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			
			<a href="#" class="profile">
				<img src="./images/flag.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Officer Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Dashboard</a>
						</li>
					</ul>
				</div>
				
			</div>
<!-- 
			<ul class="box-info">
				<li>
					<span class="text">
            <h3 > Licenese Plate Monitor</h3><br>
						<video id="videoPlayer" autoplay muted></video>
					</span>
				</li>
				
			</ul> -->

                        <div id="content-placeholder"></div>
			<div class="table-data" id="table-data">
				<div class="order">
					<div class="head">
						<h3>Captured Plates</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					
					<table >
						<thead>
							<tr>
								<th>Id</th>
								<th>Driver Name</th>
								<th>Sex</th>
								<th>Date Of Birth</th>
								<th class="wide-column">Contact</th>
								<th>license_Plate</th>
								<th>Permit Number</th>
								<th class="wide-column">National_id</th>
								<th >Place of Work</th>
								<th >Residence</th>
								<th>Age</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody >
							<?php
							$con = mysqli_connect('localhost', 'root', 'password', 'tlcps');
							$query = "SELECT * FROM captured";
							$result = mysqli_query($con, $query);

							if (mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									?>
									<tr>
										<td align="center"><?php echo $row['id']; ?></td>
										<td align="center"><?php echo $row['dname']; ?></td>
										<td align="center"><?php echo $row['sex']; ?></td>
										<td align="center"><?php echo $row['dob']; ?></td>
										<td align="center"><?php echo $row['contact']; ?></td>
										<td align="center"><?php echo $row['license_plate']; ?></td>
										<td align="center"><?php echo $row['permit_no']; ?></td>
										<td align="center"><?php echo $row['national_id']; ?></td>
										<td align="center"><?php echo $row['place_of_work']; ?></td>
										<td align="center"><?php echo $row['residence']; ?></td>
										<td align="center"><?php echo $row['age']; ?></td>
										<td align="center"><span class="status completed" style="background-color: green;">fined</span></td>
									</tr>
							<?php
								}
							} else {
								echo "<tr><td colspan='12'>No data found in the table.</td></tr>";
							}
							mysqli_close($con);
							?>
						</tbody>
					</table>
				</div>
				
			</div>
		</main>
		<!-- MAIN -->
        <!-- ... -->

<script>
  // Get references to the table-data div and the content placeholder div
  var tableData = document.getElementById("table-data");
  var contentPlaceholder = document.getElementById("content-placeholder");

  // Assign action to the "Fined" link
  document.getElementById("Fined").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default link behavior (page refresh or navigation)

    // Show the table-data div and hide the content placeholder
    tableData.style.display = "block";
    contentPlaceholder.style.display = "none";
  });

  // Assign action to the "Unfined" link
  document.getElementById("Unfined").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default link behavior (page refresh or navigation)

    // Hide the table-data div and show the content placeholder
    tableData.style.display = "none";
    contentPlaceholder.style.display = "block";

    // Fetch the content of "results.php" using AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Extract the specific elements from the fetched content
        var responseHTML = xhr.responseText;
        var parser = new DOMParser();
        var doc = parser.parseFromString(responseHTML, "text/html");
        var h1Element = doc.querySelector("h1");
        var imgElement = doc.querySelector("img");

        // Replace the content inside the "content-placeholder" div with the extracted elements
        contentPlaceholder.innerHTML = "";
        contentPlaceholder.appendChild(h1Element);
        contentPlaceholder.appendChild(imgElement);
      }
    };
    xhr.open("GET", "result.php", true);
    xhr.send();
  });
</script>

<!-- ... -->


	<script src="./js/script.js"></script> 
</body>
</html>
