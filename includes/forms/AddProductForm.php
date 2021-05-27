<?php
require_once("Form.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOProduct.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOProduct.php");

class AddProductForm extends Form {
    public function __construct() {
        parent::__construct("addProduct");
    }

    protected function generaCamposFormulario($datosIniciales, $errores = array()) {
        if (isset($_SESSION["loggedin"])) {
            $erroresHTML = $this->generaListaErrores($errores);
            $camposFormulario = <<<EOS
                <fieldset>
                    <legend>Add Product</legend>
                    $erroresHTML
                    <div>
                        <label>Name: </label> 
                        <input type="text" name="pName"/>
                    </div>
                    <div>
                        <label>Price: </label> 
                        <input type="number" step="0.01" min="0" name="pPrice" />
                    </div>
                        <div id="descr">
                        <label>Description: </label> 
                        <input type="text" name="pDescription"/>
                    </div>
                    <div>
                        <label>Type: </label>
                        <input type="radio" name="pType" value ="equipment">Equipment
                        <input type="radio" name="pType" value ="console">Console
                    </div>
                    <div>
                        <label>Link: </label> 
                        <input type="url" name="pLink"/>
                    </div>
                    <div>
                        <button type="submit" name="productSubmit">Submit</button>
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
        $name = htmlspecialchars(trim(strip_tags($_POST["pName"])));
        $price = floatval($_POST["pPrice"]);
        $user = $_SESSION["name"];
        $type = null;
        $description = htmlspecialchars(trim(strip_tags($_POST["pDescription"])));
        $link = htmlspecialchars(trim(strip_tags($_POST["pLink"])));

        if (empty($name)) {
            $erroresFormulario[] = "Name cannot be empty";
        }

        if (empty($price)) {
            $erroresFormulario[] = "Price cannot be empty";
        } else if (!is_numeric($price)) {
            $erroresFormulario[] = "Price has to be a numeric value";
        }

        if (isset($_POST["pType"])) {
            $type = $_POST["pType"];
        } else {
            $erroresFormulario[] = "Type cannot be empty";
        }

        if (empty($description)) {
            $erroresFormulario[] = "Description cannot be empty";
        }

        if (empty($link)) {
            $erroresFormulario[] = "Link cannot be empty";
        }

        if (count($erroresFormulario) == 0) {
            $daoProduct = new DAOProduct();
            $daoProduct->addProduct(new DTOProduct($name, $price, $user, $type, $description, $link));
            $erroresFormulario = <<<EOS
                /GameBox/store/product/cover.php
EOS;
        }

        return $erroresFormulario;
    }
}
?>