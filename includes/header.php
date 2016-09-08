<nav class ="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-right" href="../index.php"><img src="../images/logo.png" alt="Logo"></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="../index.php">Home</a></li>

			  <?php
				  include_once 'session.php';
			if(loggedIn()){
			?>
				<li><a href="">View Members</a></li>
				<li><a href="">Forum</a></li>
				<li><a href="">My Profile</a></li>
				<li><a href="">Log Out</a></li>
			<?php
			}else{
			?>
			<li><a href="../login.php">Login</a></li>
			<li><a href="../contact.php">Contact Us</a></li>

			<li><a href="../help.php">helpinfo</a></li>
			<?php
			}
			?>

        </div><!--/.nav-collapse -->
	</div>


</nav>
