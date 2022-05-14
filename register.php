<?php
session_start();

$errorEmpty = false;
$errorEmail = false;
$errorPassword = false;
if (isset($_POST['keypress'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['isValidationGood'] = true;

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

    if (strlen($password) < 8) {
        echo "<span class='form-error'>Podane hasło jest za krótkie.</span>";
        $errorPassword = true;
        $_SESSION['isValidationGood'] = false;
        echo "hasło jest błędy";
    }

    if ($_SESSION['isValidationGood']) {
        echo "<span class='form-success'>Wszystko jest ok.</span>";
    }
}

if ($_POST['email'] && $_POST['password'] && !$_POST['keypress'] && $_SESSION['isValidationGood']) {

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

    // if (!errorPassword && !errorEmail && !errorEmpty) {
    //     form.forEach(element => {
    //         if (element.tagName === "input") {
    //             element.value = "";
    //         }
    //     })
    // }


</script>