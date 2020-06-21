<?php
require_once "inc/header.php";

// validation 

if (isset($_POST['submit'])) {
	$name 					= $query->link->real_escape_string(Helpers::processData($_POST['name']));
	$email 					= $query->link->real_escape_string(Helpers::processData($_POST['email']));
	$message 				= $query->link->real_escape_string(Helpers::processData($_POST['message']));
	$error = [];
	if (empty($name)) {
		$error['name'] 		= "Field must be not empty";
	}
	if (empty($message)) {
		$error['message'] 	= "Field must be not empty";
	}

	if (empty($email)) {
		$error['email'] 	= "Field must be not empty";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error['email'] 	= "Your entered email address isnot valid";
	}
	if (empty($error)) {
		$messageSql 		= "INSERT INTO messages(name,email,message) VALUES('$name','$email','$message')";
		$messageQuery 		= $query->insert($messageSql);
		if ($messageQuery) {
			$success 		= "Message send successfully!";
			$name 			= '';
			$email 			= '';
			$message 		= '';
		}
	}
}



?>


<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">

            <!-- success message  -->

            <?php

			if (isset($success)) {
				echo "<span style='color:green'>" . $success . "</span>";
			}

			?>

            <h2>Contact us</h2>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>Your Name:</td>
                        <td>
                            <input type="text" name="name" placeholder="Enter first name"
                                value="<?= isset($name) ? $name : '' ?>" />

                            <!-- error message  -->
                            <?php
							if (isset($error['name'])) {
								echo "<p style='color:red'>" . $error['name'] . "</p>";
							}
							?>
                        </td>
                    </tr>

                    <tr>
                        <td>Your Email Address:</td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Email Address"
                                value="<?= isset($email) ? $email : '' ?>" />
                            <!-- error message  -->
                            <?php
							if (isset($error['email'])) {
								echo "<p style='color:red'>" . $error['email'] . "</p>";
							}
							?>

                        </td>
                    </tr>
                    <tr>
                        <td>Your Message:</td>
                        <td>
                            <textarea name='message'>
								<?= isset($message) ? $message : '' ?>
							</textarea>

                            <!-- error message  -->
                            <?php
							if (isset($error['message'])) {

								echo "<p style='color:red'>" . $error['message'] . "</p>";
							}
							?>

                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Submit" />
                        </td>
                    </tr>
                </table>
                <form>
        </div>

    </div>
    <?php
	require_once "inc/sidebar.php";

	?>
</div>

<?php require_once "inc/footer.php"; ?>