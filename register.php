<?php
/**
 * @param mixed $email
 * @param mixed $password
 * @param mysqli $database
 * @return bool[]
 */
function validateRegisterForm(mixed $email, mixed $password, mysqli $database): array
{
    $errorEmpty = false;
    $errorEmail = false;
    $errorPassword = false;
    $isGoodValidation = true;

    if (empty($email) && empty($password)) {
        echo "<span class='form-error'>E-mail nie został podany.</span>";
        $errorEmpty = true;
        $isGoodValidation = false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<span class='form-error'>Podany email nie jest prawidłowy. Przykładowy email wygląda tak lama@lamisiwat.olidiaks</span>";
        $errorEmail = true;
        $isGoodValidation = false;
    }

    $sql = "select * from Users where email = '$email';";
    /** @noinspection PhpUndefinedVariableInspection */
    $query = $database->query($sql);

    if ($query->num_rows != 0) {
        echo "<span class='form-error'>Podany e-mail został już wykorzystany.</span>";
        $isGoodValidation = false;
    }

    if (strlen($password) < 8) {
        echo "<span class='form-error'>Podane hasło jest za krótkie.</span>";
        $errorPassword = true;
        $isGoodValidation = false;
    }

    if ($isGoodValidation) {
        echo "<span class='form-success'>Wszystko jest ok.</span>";
    }
    return array($errorEmpty, $errorEmail, $errorPassword, $isGoodValidation);
}

/**
 * @param $errorEmpty
 * @param $errorEmail
 * @param $errorPassword
 * @return void
 */
function validateJs($errorEmpty, $errorEmail, $errorPassword): void
{

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
    <?php
}

session_start();

$email = $_POST['email'];
$password = $_POST['password'];
include 'database.php';
/** @noinspection PhpUndefinedVariableInspection */
list($errorEmpty, $errorEmail, $errorPassword, $isGoodValidation) = validateRegisterForm($email, $password, $database);

if (isset($_POST['keypress'])) {

    validateJs($errorEmpty, $errorEmail, $errorPassword);

    $database->close();

} else if (isset($database) && isset($email) && isset($password) && $isGoodValidation) {
    $sql = $_POST['secure-code'] == '0000' ?
        "insert into Users (email, password, role) value ('$email', '$password', 'administrator');" :
        "insert into Users (email, password, role) value ('$email', '$password', 'user')";
    /** @noinspection PhpUndefinedVariableInspection */
    $database->query($sql) or die("Nie udało się wprowadzić danych do bazy danych.<br>" . $database->error);
    $database->close();
    include "login.html";
    echo "Zarejestrowano";
} else if (isset($database)) {
    $database->close();
    include "Register.html";
    validateJs($errorEmpty, $errorEmail, $errorPassword);
}
?>

