<?php
require_once("Form.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOGame.php");
require_once(PROJECT_ROOT . "/includes/DTOs/DTOGame.php");

class AddGameForm extends Form {
    public function __construct() {
        parent::__construct("addGame");
    }

    protected function generaCamposFormulario($datosIniciales, $errores = array()) {
        if (isset($_SESSION["loggedin"])) {
            if($_SESSION["rol"] =='developer'){
                $erroresHTML = $this->generaListaErrores($errores);
                $camposFormulario = <<<EOS
                    <fieldset>
                        <legend>Add Game</legend>
                        $erroresHTML
                        <div>
                            <label>Name: </label>
                            <input type="text" name="gName" id="Name" title="Name" required/>
                            <span id="nameCheck"></span>
                        </div>
                        <div>
                            <label>Price: </label>
                            <input type="number" step="0.01" min="0" name="gPrice" id="Price" title="Price" required/>
                            <span id="priceCheck"></span>
                        </div>
                        <div id="descr">
                            <label>Description: </label>
                            <input type="text" name="gDescription" id="Description" title="Description" required/>
                            <span id="descrCheck"></span>
                        </div>
                        <div>
                            <label>Release Date: </label>
                            <input type="date" name="gReleaseDate" id="ReleaseDate" title="ReleaseDate" required/>
                            <span id="dateCheck"></span>
                        </div>
                        <div>
                            <label>Genre: </label>
                            <input type="radio" name="gGenre" class="Genre" value="action" required/>Action
                            <input type="radio" name="gGenre" class="Genre" value="adventure" required/>Adventure
                            <input type="radio" name="gGenre" class="Genre" value="horror" required/>Horror
                            <input type="radio" name="gGenre" class="Genre" value="rpg" required/>RPG
                        </div>
                        <div>
                            <label>Medium: </label>
                            <input type="checkbox" name="gMedium[]" class="Medium" value="physical" />Physical
                            <input type="checkbox" name="gMedium[]" class="Medium" value="digital" />Digital
                        </div>
                        <div>
                            <label>Link: </label>
                            <input type="url" name="gLink" id="Link"/>
                            <span id="linkCheck"></span>
                        </div>
                        <div><Button type="submit" id="storeSubmit">Submit</Button></div>
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
        $name = htmlspecialchars(trim(strip_tags($_POST["gName"])));
        $price = floatval($_POST["gPrice"]);
        $user = $_SESSION["name"];
        $description = htmlspecialchars(trim(strip_tags($_POST["gDescription"])));
        $releaseDate = $_POST["gReleaseDate"];
        $genre = null;
        $physical = null;
        $digital = null;
        $visits = 0;
        $link = htmlspecialchars(trim(strip_tags($_POST["gLink"])));

        $genre = $_POST["gGenre"];

        $physical = in_array("physical", $_POST["gMedium"]) ? 1 : 0;
        $digital = in_array("digital", $_POST["gMedium"]) ? 1 : 0;

        $daoGame = new DAOGame();
        $daoGame->addGame(new DTOGame($name, $price, $user, $description, $releaseDate, $genre, $physical, $digital, $visits, $link));
        $erroresFormulario = <<<EOS
            /GameBox/store/game/cover.php
EOS;
        
        return $erroresFormulario;
    }
}
?>