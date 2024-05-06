<?php

	include('Partials/menu.php');

?>
'
	
	<!---Main content section starts--->

	<div class="main-contant">
		<div class="wrapper">
			<h1>
				DashBoard
			</h1>
			
			<br><br>

			<?php

				if(isset($_SESSION['login']))
				{
					echo $_SESSION['login'];
					unset($_SESSION['login']);
				}

			?>

			<br><br>

			<div class="col-4">
				<h1>5</h1>
				<br>	
				Categories
			</div>

			<div class="col-4">
				<h1>5</h1>
				<br>	
				Categories
			</div>

			<div class="col-4">
				<h1>5</h1>
				<br>	
				Categories
			</div>

			<div class="col-4">
				<h1>5</h1>
				<br>	
				Categories
			</div>

			<div class="clearfix">
				
			</div>

		</div>
	</div>

	<!---Main content section ends--->

<?php

	include('Partials/footer.php');

?>