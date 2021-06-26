<?php
require_once("Form.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOSell.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOSell.php");

class AddGameForm extends Form {
    public function __construct() {
        parent::__construct("addGame");
    }

    protected function generaCamposFormulario($datosIniciales, $errores = array()) {
        if (isset($_SESSION["loggedin"])) {
            $erroresHTML = $this->generaListaErrores($errores);
            $camposFormulario = <<<EOS
                <fieldset>
                    <legend>VALUE SELL</legend>
                    $erroresHTML
                    <div>
                        <label>Name y Firstname: </label>
                        <input type="text" name="gName"/>
                    </div>
                    <div>
                        <label>Email: </label>
                        <input type="text" name="gEmail" />
                    </div>
                    <div id="descr">
                        <label>Phone: </label>
                        <input type="text" name="gPhone"/>
                    </div>
                    <div>
                        <label>Coments: </label>
                        <input type="date" name="gComents" />
                    </div>                                   
                
                </fieldset>
            EOS;
        } else {
            $camposFormulario = "<h2>You are Not Logged In</h2>";
        }

        return $camposFormulario;
    }

    protected function procesaFormulario($datos) {
        $erroresFormulario = array();

        // Obtener campos del formulario
        $name = htmlspecialchars(trim(strip_tags($_POST["gName"])));
        $email = htmlspecialchars(trim(strip_tags($_POST["gEmail"])));      
        $coments = htmlspecialchars(trim(strip_tags($_POST["gComents"])));
       
      
        if (empty($name)) {
            $erroresFormulario[] = "Name cannot be empty";
        }
        if (empty($email)) {
            $erroresFormulario[] = "Email cannot be empty";

        if (empty($phone)) {
            $erroresFormulario[] = "Phone cannot be empty";
        } else if (!is_numeric($price)) {
            $erroresFormulario[] = "Phone has to be a numeric value";
        }

        if (empty($coments)) {
            $erroresFormulario[] = "Coments cannot be empty";
        }
   
        return $erroresFormulario;
    }
}
