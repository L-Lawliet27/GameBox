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
            $erroresHTML = $this->generaListaErrores($errores);
            $camposFormulario = <<<EOS
                <fieldset>
                    <legend>Add Game</legend>
                    $erroresHTML
                    <div>
                        <label>Name: </label>
                        <input type="text" name="gName"/>
                    </div>
                    <div>
                        <label>Price: </label>
                        <input type="number" step="0.01" min="0" name="gPrice" />
                    </div>
                    <div id="descr">
                        <label>Description: </label>
                        <input type="text" name="gDescription"/>
                    </div>
                    <div>
                        <label>Release Date: </label>
                        <input type="date" name="gReleaseDate" />
                    </div>
                    <div>
                        <label>Genre: </label>
                        <input type="radio" name="gGenre" value="action"/>Action
                        <input type="radio" name="gGenre" value="adventure"/>Adventure
                        <input type="radio" name="gGenre" value="horror"/>Horror
                        <input type="radio" name="gGenre" value="rpg"/>RPG
                    </div>
                    <div>
                        <label>Medium: </label>
                        <input type="checkbox" name="gMedium[]" value="physical"/>Physical
                        <input type="checkbox" name="gMedium[]" value="digital"/>Digital
                    </div>
                    <div>
                        <label>Link: </label>
                        <input type="url" name="gLink"/>
                    </div>
                    <div><Button type="submit" name="gameSubmit">Submit</Button></div>
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
        $price = floatval($_POST["gPrice"]);
        $user = $_SESSION["name"];
        $description = htmlspecialchars(trim(strip_tags($_POST["gDescription"])));
        $releaseDate = $_POST["gReleaseDate"];
        $genre = null;
        $physical = null;
        $digital = null;
        $visits = 0;
        $link = htmlspecialchars(trim(strip_tags($_POST["gLink"])));

        if (empty($name)) {
            $erroresFormulario[] = "Name cannot be empty";
        }

        if (empty($price)) {
            $erroresFormulario[] = "Price cannot be empty";
        } else if (!is_numeric($price)) {
            $erroresFormulario[] = "Price has to be a numeric value";
        }

        if (empty($description)) {
            $erroresFormulario[] = "Description cannot be empty";
        }

        if (empty($releaseDate)) {
            $erroresFormulario[] = "Release date cannot be empty";
        }

        if (isset($_POST["gGenre"])) {
            $genre = $_POST["gGenre"];
        } else {
            $erroresFormulario[] = "Genre cannot be empty";
        }

        if (isset($_POST["gMedium"])) {
            $physical = in_array("physical", $_POST["gMedium"]) ? 1 : 0;
            $digital = in_array("digital", $_POST["gMedium"]) ? 1 : 0;
        } else {
            $erroresFormulario[] = "Medium cannot be empty";
        }

        if (empty($link)) {
            $erroresFormulario[] = "Link cannot be empty";
        }

        if (count($erroresFormulario) == 0) {
            $daoGame = new DAOGame();
            $daoGame->addGame(new DTOGame($name, $price, $user, $description, $releaseDate, $genre, $physical, $digital, $visits, $link));
            $erroresFormulario = <<<EOS
                /GameBox/store/game/cover.php
EOS;
        }

        return $erroresFormulario;
    }
}
?>