<?php
require_once("Form.php");

class CreateDiscussionForm extends Form {
    public function __construct() {
        parent::__construct("createDiscussion");
    }

    protected function generaCamposFormulario($datosIniciales, $errores = array()) {
        if (isset($_SESSION["loggedin"])) {
            $erroresHTML = $this->generaListaErrores($errores);
            $camposFormulario = <<<EOS
                $erroresHTML
                Discussion name:
                <input type="text" name="name">
                <button type="submit">Create</button>
            EOS;
        } else {
            $camposFormulario = "You must be logged in to create a discussion!";
        }

        return $camposFormulario;
    }

    protected function procesaFormulario($datos) {
        $erroresFormulario = array();

        // Obtener campos del formulario
        $name = htmlspecialchars(trim(strip_tags($datos["name"])));
        $user = $_SESSION["name"];
        $type = 0;

        if (empty($name)) {
            $erroresFormulario[] = "Discussion name cannot be empty";
        }

        if (count($erroresFormulario) == 0) {
            // Insertar discusión
            $daoDiscussion = new DAODiscussion();
            $discussion = new DTODiscussion($name, $user, date("Y-m-d H:i:s"), $type);
            $daoDiscussion->insertDiscussion($discussion);
            $erroresFormulario = <<<EOS
                /GameBox/forum/discussion.php?id={$discussion->getId()}&page=1&responding=0
            EOS;
        }

        return $erroresFormulario;
    }
}
