<?php
/**
 * @param string $email
 * @param string $password
 * @param mysqli $database
 * @return bool[]
 */
function validateRegisterForm(string $email, string $password, mysqli $database): array
{
    $errorEmpty = false;
    $errorEmail = false;
    $errorPassword = false;
    $isGoodValidation = true;
    $formSuccess = '';
    $formError = '';

    if (empty($email)) {
        $formError .= "<li class='form-error'>E-mail nie został podany.</li>";
        $errorEmpty = true;
        $isGoodValidation = false;
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formError .= "<li class='form-error'>Podany email nie jest prawidłowy. Przykładowy email wygląda tak lama@lamisiwat.olidiaks</li>";
        $errorEmail = true;
        $isGoodValidation = false;
    } else {
        $formSuccess .= "<li class='form-success'>Podano prawidłowy email</li>";
    }

    $sql = "select * from Users where email = '$email';";
    /** @noinspection PhpUndefinedVariableInspection */
    $query = $database->query($sql);

    if ($query->num_rows != 0) {
        $formError .= "<li class='form-error'>Podany e-mail został już wykorzystany.</li>";
        $isGoodValidation = false;
    } else {
        $formSuccess .= "<li class='form-success'>Podany e-mail nie jest zajęty.</li>";
    }

    if (strlen($password) < 8) {
        $formError .= "<li class='form-error'>Podane hasło jest za krótkie.</li>";
        $errorPassword = true;
        $isGoodValidation = false;
    } else {
        $formSuccess .= "<li class='form-success'>Podane hasło jest prawidłowe</li>";
    }

    ?>
    <div class="form-div">
    <ol class="form-success">
        <?php echo $formSuccess; ?>
    </ol>
    <ol class="form-error">
        <?php echo $formError; ?>
    </ol>
    </div>


    <?php
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
    header("Location: login.html");
} else if (isset($database)) {
    $database->close();
    include "Register.html";
    validateJs($errorEmpty, $errorEmail, $errorPassword);
}
?>

