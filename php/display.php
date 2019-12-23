<?php

if(isset($_GET['remove'])){
	$id = $_GET['remove'];

	$sql = "DELETE FROM `identities` WHERE `id` = " . strval($id);
	$result = $conn->query($sql);
	header("Location: ?");
}

?>

<body>
	<div id="add-new" onclick="addnew()">
		+
	</div>

	<div id="body-wrapper">
		<div class="container">
			<div class="row">
				<?php

				// Display Identities

				if(isset($identities)){
					$count = 0;
					foreach($identities as $identity){
						$count++;
						echo '<div class="col-sm identity-container">';
						echo $identity->Name . "<br>";
						echo $identity->Username . "<br>";
						echo $identity->Region . "<br>";
						echo $identity->Birthdate;
						echo '<div class="remove" id="' . $identity->Id . '">x</div>';
						echo '</div>';

						if($count % 5 == 0){
							echo '</div>';
							echo '<div class="row">';
						}

					}
				}
				

				?>
			</div>
		</div>
	</div>
</body>

<script>

	$(document).ready(function(){
		$('.remove').click(function(event) {
			var id = $(this).attr('id');
			if (window.confirm("Are you sure?")) {
				window.location = "?remove=" + id;
        }
		});
	});

	function addnew() {
		window.location = "?addnew=1"
	}
</script>