<?php
$regions = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");


if(isset($_POST['submit'])){
	$Name = $_POST['name'];
	$Username = $_POST['username'];
	$Region = $_POST['region'];
	$Birthdate = $_POST['birthdate'];

	$Name = addslashes($Name);
	$Region = $regions[$Region];

	$uid = getUID($_COOKIE['loggedin'], $conn);

	$sql = "INSERT INTO `identities`(`name`, `username`, `region`, `birthdate`, `userid`) 
	VALUES ('$Name','$Username','$Region','$Birthdate','$uid')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		sleep(1);
		header('Location: ?');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

?>

<body>
	<div id="directional_buttons">
		<div id="go-back" onclick="back()">
			-
		</div>
	</div>

	<div id="body-wrapper">
		<div class="container">
			<div class="row add-new-form">
				<form action="" method="POST">
					<div class="col">
						<input type="text" name="name" id="name" placeholder="Name">
						<img src="res/randomicon.png" id="rName">
					</div><br>

					<div class="col"><input type="text" id="username" name="username" placeholder="Username">
						<img src="res/randomicon.png" id="ruserName">
					</div><br>

					<div class="col"><select id="region" name="region">
						<?php
						foreach($regions as $key => $region){
							echo "<option value=" . $key . ">$region</option>";
						}
						?>
					</select><img src="res/randomicon.png" id="rRegion"></div>
					<br>
					<div class="col"><input type="datetime-local" id="birthdate" name="birthdate" placeholder="Birthdate">
						<img src="res/randomicon.png" id="rbirthdate"></div><br>
						<input type="submit" name="submit">

						<img src="res/randomicon.png" id="allR">
					</form>
				</div>
			</div>
		</div>
	</body>

	<script>

		$(document).ready(function(){

			$("#allR").click(function() {
				$("#name").val(faker.name.findName());
				$("#username").val(faker.internet.userName());
				rand = Math.floor(Math.random() * 239);
				options = $("#region > option");
				options[rand].selected = true;
				$("#birthdate").val(faker.date.between(1950, 2019).toISOString().substring(0, 16));
			});

			$("#rName").click(function(){
				$("#name").val(faker.name.findName());

			});

			$("#ruserName").click(function(){
				$("#username").val(faker.internet.userName());
			});

			$("#rbirthdate").click(function(){
				$("#birthdate").val(faker.date.between(1950, 2019).toISOString().substring(0, 16));
			});

			$("#rRegion").click(function(){
				rand = Math.floor(Math.random() * 239);
				options = $("#region > option");
				options[rand].selected = true;


			});

		});

		function back() {
			window.location = "?";
		}

		function randomDate(start, end) {
			return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
		}

		console.log(randomDate(new Date(1947, 0, 1), new Date()));
	</script>