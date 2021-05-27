<?php
require_once("Form.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOUser.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOUser.php");

class SignUpForm extends Form {
    public function __construct() {
        parent::__construct("signUp");
    }

    protected function generaCamposFormulario($datosIniciales, $errores = array()) {
        $erroresHTML = $this->generaListaErrores($errores);
        $camposFormulario = <<<EOS
            <fieldset>
                <legend>Please fill this form to create an account.</legend>
                $erroresHTML
                <div>
                    <label>Username</label>
                    <input type="text" name="username" value="">
                </div>
                <div>
                    <label>Who you are?: </label>
                    <input type="checkbox" name="rol" value="gamer"/>Gamer
                    <input type="checkbox" name="rol" value="developer"/>Developer
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" value="">
                </div>
                <div>
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" value="">
                </div>
                <div>
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
                    <p>Already have an account? <a href="/GameBox/login/login.php">Login here</a>.</p>
            </fieldset>
        EOS;

        return $camposFormulario;
    }

    protected function procesaFormulario($datos) {
        $daoUser = new DAOUser();
        $erroresFormulario = array();

        // Obtener campos del formulario
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $confirmationPassword = trim($_POST["confirm_password"]);
        $rol = null;

        // Validar nombre de usuario
        if (empty($username)) {
            $erroresFormulario[] = "Username cannot be empty";
        } else if ($daoUser->getUser($username) != null) {
            $erroresFormulario[] = "This username is already taken.";
        }
        // Validar rol
        if (isset($_POST["rol"])) {
            $rol = trim($_POST["rol"]);
        } else {
            $erroresFormulario[] = "rol cannot be empty.";
        }

        // Validar contraseña
        if (empty($password)) {
            $erroresFormulario[] = "Password name cannot be empty.";
        }
        if (strlen($password) < 6) {
            $erroresFormulario[] = "Password must have at least 6 characters.";
        }

        // Validar contraseña de confirmación
        if (empty($confirmationPassword)) {
            $erroresFormulario[] = "Confirmation password cannot be empty.";
        }
        if ($password != $confirmationPassword) {
            $erroresFormulario[] = "Passwords do not match.";
        }

        if (count($erroresFormulario) == 0) {
            $user = new DTOUser($username, password_hash($password, PASSWORD_DEFAULT), $rol);
            $daoUser->insertUser($user);
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->getId();
            $_SESSION["name"] = $user->getName();
            $_SESSION["rol"] = $user->getRol();
            $erroresFormulario = <<<EOS
                /GameBox/index.php
            EOS;
        }

        return $erroresFormulario;
    }
}
