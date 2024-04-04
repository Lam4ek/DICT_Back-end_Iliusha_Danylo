<?php
// TODO 1: PREPARING ENVIRONMENT: 1) session 2) functions
session_start();
function saveToUsers($name, $email, $csvFile) {
	$row = array($name, $email);
	$file = fopen($csvFile, 'a');
	fputcsv($file, $row);
	fclose($file);
}

function saveToComments($name, $comment, $csvFile) {
	$row = array($name, $comment, date("Y-m-d H:i:s"));
	$file = fopen($csvFile, 'a');
	fputcsv($file, $row);
	fclose($file);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$comment = $_POST["comment"];
	
	$usersCsvFile = 'users.csv';
	$commentsCsvFile = 'comments.csv';
	
	saveToUsers($name, $email, $usersCsvFile);
	saveToComments($name, $comment, $commentsCsvFile);
	
	header("Location: {$_SERVER['PHP_SELF']}");
	exit();
}

function displayGuestbook($csvFile) {
	$file = fopen($csvFile, 'r');
	echo "<ul>";
	while (($row = fgetcsv($file)) !== FALSE) {
			echo "<li><strong>{$row[0]}:</strong> {$row[1]} <span>({$row[2]})</span></li>";
	}
	echo "</ul>";
	fclose($file);
}
?>

<!DOCTYPE html>
<html>

<?php require_once 'sectionHead.php' ?>

<body>

<div class="container">

    <!-- navbar menu -->
    <?php require_once 'sectionNavbar.php' ?>
    <br>

    <!-- guestbook section -->
    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            GuestBook form
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">

									<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name" required><br>
                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email" required><br>
                        <label for="comment">Comment:</label><br>
                        <textarea id="comment" name="comment" required></textarea><br>
                        <button type="submit">Submit</button>
                  </form>

                </div>
            </div>

        </div>
    </div>

    <br>

    <div class="card card-primary">
        <div class="card-header bg-body-secondary text-dark">
            Сomments
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">

								<?php displayGuestbook('comments.csv'); ?>

                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
