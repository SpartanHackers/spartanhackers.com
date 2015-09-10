<?php
include("database/login.php");

$user = false;
//Log in
if (isset($_REQUEST['pswd']) && isset($_REQUEST['eventName'])) {
	//check login
	$p = $_REQUEST['pswd'];
	$user = logIn($p);

	//save credentials
	if ($user != false) {
		$_SESSION['pswd'] = $p;
	}

	//save event
	$eventSaved = newEvent($_REQUEST['eventName']);
    $_SESSION['eventName'] = $_REQUEST['eventName'];
	if ($eventSaved != 1) {
		echo "<script>alert('New event error, might already be saved in the db');</script>";
	}

} else if (isset($_REQUEST['logout'])) {
	session_unset();
}

echo '    <script src="js/jquery.js"></script> <!-- jQuery -->
    <script src="js/eventSignIn.js"></script>';

include("partials/header.php"); //show our header and CSS

?>
<!-- HTML Always on page -->
<section id="about" class="container content-section text-center">
<div class="col-lg-8 col-lg-offset-2">
<?php

if ($user != null) {
	//LOGGED IN PART OF PAGE
    ?>
    <!-- Email only form -->
    <form id='memberForm'  class="form-horizontal" role="form">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group">        
                    <input id="eventName" type="hidden" name="eventName" value=<?php echo '"'.$_REQUEST['eventName'].'"'; ?>>
                    <span class="input-group-addon">E-mail (must be @msu.edu)</span>
                    <input id="email" name="e-mail" type="text" class="form-control">
                </div>
            </div>
        </div>
        <button class="btn btn-primary">Continue</button>
    </form>

    <!-- More info form -->
    <div id="newMember">
    <form id='newMemberForm'  class="form-horizontal" role="form">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group">
                  <span class="input-group-addon">First Name</span>
                  <input id="first" name="first" type="text" class="form-control">
                </div>
            </div>
            <p></p>
            <div class="input-group">
                <div class="input-group">
                  <span class="input-group-addon">Last Name</span>
                  <input id="last" name="last" type="text" class="form-control">
                </div>
            </div>
            <p></p>
            <div class="input-group">
                <div class="input-group">
                  <span class="input-group-addon">Major</span>
                  <input id="major" name="major" type="text" class="form-control">
                </div>
            </div>
            <p></p>
            <div class="input-group">
                <div class="input-group">
                  <span class="input-group-addon">Expected Graduation:</span>
                  <input id="grad" name="grad" type="text" class="form-control" placeholder="2019">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    <script type="text/javascript">$('#newMember').hide();</script>

    <!-- Log Out Button           
    <form method="post" action="admin.php"  class="form-horizontal" role="form">
        <input type="hidden" name="logout" value="1">
        <button type="submit" class="btn btn-default">Log Out</button>
    </form> -->

<?php
} else {
	//NOT LOGGED IN YET
    ?>

    <!-- Admin panel: password & event title -->
    <form method="post" action="admin.php" class="form-horizontal" role="form">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group">
                  <span class="input-group-addon">Password</span>
                  <input name="pswd" type="password" class="form-control">
                </div>
                <p></p>
                <div class="input-group">
                  <span class="input-group-addon">Event Title</span>
                  <input name="eventName" type="text" class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Log in</button>
    </form>
    <?php
}
?>
</div>
</section>

<?php
include("partials/footer.php");
?>