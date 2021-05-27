<?php
require_once("Form.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOUser.php");

class LoginForm extends Form {
    public function __construct() {
        parent::__construct("login");
    }

    protected function generaCamposFormulario($datosIniciales, $errores = array()) {
        $erroresHTML = $this->generaListaErrores($errores);
        $camposFormulario = <<<EOS
            <fieldset>
                <legend>Please fill in your credentials to login.</legend>
                $erroresHTML
                <div>
                    <label>Username</label>
                    <input type="text" name="username" value="">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                <div>
                    <input type="submit" value="Login">
                </div>
                <p>Don't have an account? <a href="/GameBox/login/signUp.php">Sign-up now</a>.</p>
            </fieldset>
        EOS;

        return $camposFormulario;
    }

    protected function procesaFormulario($datos) {
        $erroresFormulario = array();

        // Obtener campos del formulario
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        if (empty($username)) {
            $erroresFormulario[] = "Username cannot be empty.";
        }

        if (empty($password)) {
            $erroresFormulario[] = "Password name cannot be empty.";
        }

        $daoUser = new DAOUser();
        $user = $daoUser->getUser($username);

        if ($user == null || !password_verify($password, $user->getHashedPassword())) {
            $erroresFormulario[] = "Invalid username or password.";
        }

        if (count($erroresFormulario) == 0) {
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
