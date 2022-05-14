<?php
session_start();

$errorEmpty = false;
$errorEmail = false;
$errorPassword = false;
$isEmailEngaged = true;
$isPasswordEngaged = true;

if (isset($_POST['keypress'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['isValidationGood'] = true;

    include 'database.php';

    if (empty($email) && empty($password)) {
        echo "<span class='form-error'>E-mail nie został podany.</span>";
        $errorEmpty = true;
        $_SESSION['isValidationGood'] = false;
    }
    if (empty($password)) {
        echo "<span class='form-error'>Hasło nie zostało podane.</span>";
        $errorEmpty = true;
        $_SESSION['isValidationGood'] = false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span class='form-error'>Podany email nie jest prawidłowy. Przykładowy email wygląda tak lama@lamisiwat.olidiaks</span>";
        $errorEmail = true;
        $_SESSION['isValidationGood'] = false;
    }

    $sql = "select * from Users where email = '$email';";
    /** @noinspection PhpUndefinedVariableInspection */
    $query = $database->query($sql);

    if ($query->num_rows != 0){
        echo "<span class='form-error'>Podany e-mail został już wykorzystany.</span>";
        $isEmailEngaged = false;
        $_SESSION['isValidationGood'] = false;
    }

    if (strlen($password) < 8) {
        echo "<span class='form-error'>Podane hasło jest za krótkie.</span>";
        $errorPassword = true;
        $_SESSION['isValidationGood'] = false;
    }

    if ($_SESSION['isValidationGood']) {
        echo "<span class='form-success'>Wszystko jest ok.</span>";
    }

    $database->close();
} else if ($_POST['email'] && $_POST['password'] && $_SESSION['isValidationGood']) {
    include 'database.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "insert into Users (email, password) value ('$email', '$password');";
    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql) or die();
    $database->close();
    header("Location: login.html");
} else {
    header("Location: Register.html");
}


?>

<script>
    errorEmpty = '<?php echo $errorEmpty;?>';
    errorEmail = '<?php echo $errorEmail;?>';
    errorPassword = '<?php echo $errorPassword;?>';

    if (errorEmpty) {
        form.forEach(element => {
            if (element.tagName === "input") {
                element.classList.add("input-error");
            }
        })
    }

    if (errorEmail) {
        emailForm.classList.remove("input-success")
        emailForm.classList.add("input-error");
    } else {
        emailForm.classList.remove("input-error");
        emailForm.classList.add("input-success");
    }

    if (errorPassword) {
        passwordForm.classList.remove("input-success")
        passwordForm.classList.add("input-error");
    } else {
        passwordForm.classList.remove("input-error");
        passwordForm.classList.add("input-success");
    }

</script>