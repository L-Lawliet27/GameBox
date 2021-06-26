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
            if($_SESSION["rol"] =='developer'){
                $erroresHTML = $this->generaListaErrores($errores);
                $camposFormulario = <<<EOS
                    <fieldset>
                        <legend>Add Product</legend>
                        $erroresHTML
                        <div>
                            <label>Name: </label> 
                            <input type="text" name="pName" id="Name" required/>
                            <span id="nameCheck"></span>
                        </div>
                        <div>
                            <label>Price: </label> 
                            <input type="number" step="0.01" min="0" name="pPrice" id="Price" required/>
                            <span id="priceCheck"></span>
                        </div>
                            <div id="descr">
                            <label>Description: </label> 
                            <input type="text" name="pDescription" id="Description" required/>
                            <span id="descrCheck"></span>
                        </div>
                        <div>
                            <label>Type: </label>
                            <input type="radio" name="pType" class="Type" value ="equipment" required>Equipment
                            <input type="radio" name="pType" class="Type" value ="console" required>Console
                        </div>
                        <div>
                            <label>Link: </label> 
                            <input type="url" name="pLink" id="Link" required/>
                            <span id="linkCheck"></span>
                        </div>
                        <div>
                            <button type="submit" id="storeSubmit">Submit</button>
                        </div>
                    </fieldset>
EOS;
            }else{
                $camposFormulario = "<h2>You are Not a Developer</h2>";
            }
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

        $type = $_POST["pType"];


        $daoProduct = new DAOProduct();
        $daoProduct->addProduct(new DTOProduct($name, $price, $user, $type, $description, $link));
        $erroresFormulario = <<<EOS
            /GameBox/store/product/cover.php 
EOS;    

        return $erroresFormulario;
    }
}
?>