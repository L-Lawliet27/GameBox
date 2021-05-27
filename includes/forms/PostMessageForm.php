<?php
require_once("Form.php");

class PostMessageForm extends Form {
    private $action;
    private $discussion;

    public function __construct($action, $discussion) {
        $this->action = $action;
        $this->discussion = $discussion;
        parent::__construct("postMessage");
    }

    protected function generaCamposFormulario($datosIniciales, $errores = array()) {
        $erroresHTML = $this->generaListaErrores($errores);
        $camposFormulario = <<<EOS
            $erroresHTML
            <textarea name="content"></textarea>
            <br>
            <button type="submit">Post</button>
            <br><br>
        EOS;

        return $camposFormulario;
    }

    protected function procesaFormulario($datos) {
        $erroresFormulario = array();

        // Obtener campos del formulario
        $content = htmlspecialchars(trim(strip_tags($datos["content"])));
        $responding = $_GET["responding"];
        $user = $_SESSION["name"];

        if (empty($content)) {
            $erroresFormulario[] = "Message cannot be empty";
        }

        if (count($erroresFormulario) == 0) {
            // Insertar mensaje
            $daoMessage = new DAOMessage();
            $daoMessage->insertMessage(new DTOMessage($this->discussion, $responding, $user, $content));

            // Actualizar la fecha de modificación de la discusión
            $daoDiscussion = new DAODiscussion();
            $modifiedDiscussion = $daoDiscussion->getDiscussion($this->discussion);
            $modifiedDiscussion->setLastTime(date("Y-m-d H:i:s"));
            $daoDiscussion->updateDiscussion($this->discussion, $modifiedDiscussion);

            $erroresFormulario = <<<EOS
                $this->action
            EOS;
        }

        return $erroresFormulario;
    }
}
