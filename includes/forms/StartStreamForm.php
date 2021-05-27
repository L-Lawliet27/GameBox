<?php
require_once("Form.php");
require_once(__DIR__ . "/../config.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAODiscussion.php");

class StartStreamForm extends Form {
    public function __construct() {
        parent::__construct("startStream");
    }

    protected function generaCamposFormulario($datosIniciales, $errores = array()) {
        $camposFormulario = "";

        if (isset($_SESSION["loggedin"])) {
            $erroresHTML = $this->generaListaErrores($errores);
            $camposFormulario = <<<EOS
                $erroresHTML
                Stream name:
                <input type="text" name="name">
                Platform:
                <select name="platform">
                    <option value="0">Youtube</option>
                    <option value="1">Facebook</option>
                    <option value="2">Twitch</option>
                </select>
                Link:
                <input type="text" name="link">
                <button type="submit">Start</button>
                <button type="submit" name="help">Help</button>
            EOS;
        } else {
            $camposFormulario = "You must be logged in to start a stream!";
        }

        return $camposFormulario;
    }

    protected function procesaFormulario($datos) {
        $erroresFormulario = array();

        if (isset($datos["help"])){
            $erroresFormulario[] = <<<EOS
                For Youtube link "youtube.com/watch?v=P_nj6wW6Gsc", for example, introduce "P_nj6wW6Gsc".
            EOS;
            $erroresFormulario[] = <<<EOS
                For Facebook, each video has an unique number ("1131916223489418", for example). Introduce it.
            EOS;
            $erroresFormulario[] = <<<EOS
                For Twitch, only streams are supported, not videos. For link "twitch.tv/ibai", for example, introduce "ibai".
            EOS;
            return $erroresFormulario;
        }

        // Obtener campos del formulario
        $name = htmlspecialchars(trim(strip_tags($datos["name"])));
        $platform = $datos["platform"];
        $link = htmlspecialchars(trim(strip_tags($datos["link"])));
        $user = $_SESSION["name"];
        $type = 1;

        if (empty($name)) {
            $erroresFormulario[] = "Name cannot be empty";
        }

        if (empty($link)) {
            $erroresFormulario[] = "Link cannot be empty";
        }

        if (count($erroresFormulario) == 0) {
            $daoDiscussion = new DAODiscussion();
            $discussion = new DTODiscussion("Comments", $user, date("Y-m-d H:i:s"), $type);
            $daoDiscussion->insertDiscussion($discussion);

            $daoStream = new DAOStream();
            $stream = new DTOStream($name, $platform, $link, $user, $discussion->getId());
            $daoStream->insertStream($stream);
            $erroresFormulario = <<<EOS
                /GameBox/streams/stream.php?id={$stream->getId()}&page=1
            EOS;
        }

        return $erroresFormulario;
    }
}
