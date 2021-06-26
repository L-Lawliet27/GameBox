<?php
require_once(__DIR__ . "/../includes/config.php");
require_once(PROJECT_ROOT . "/includes/forms/LoginForm.php");
require_once(PROJECT_ROOT . "/includes/DAOs/DAOUser.php");

$title = "Profile";

//$name = $datos["name"];
$name = $_SESSION["name"];
$rol =  $_SESSION["rol"];

$daoUser = new DAOUser();
$users = $daoUser->getAllUsers();

$html = "<table border='1' width='100%'>";
$html .= "<tr>";
$html .= "<th>User Id</th>";
$html .= "<th>Name</th>";
$html .= "<th>Rol</th>";
$html .= "<th>Fecha</th>";
$html .= "<th>Action</th>";
$html .= "</tr>";
if (!empty($users)) {
    foreach ($users as $key => $user) {
        $data=explode('|',$user->rol);
        $html .= "<tr>";
        $html .= "<td>".$data[3]."</td>";
        $html .= "<td>".$data[0]."</td>";
        $html .= "<td>".$data[1]."</td>";
        $html .= "<td>".$data[2]."</td>";
        $html .= "<td>".'<a class="btnInactivate" href="javascript:void(0);" 
                    onclick="javascript:confirmAction('."'inactivateUser.php?id=".$data[3]."'".')" title="Inactivate this Product?">
                    <i>X </i>
                </a>'."</td>";
        $html .= "</tr>";
    }
}
$html .= "</table>";


if( $_SESSION["rol"] !='admin2'){
    $usersYes = $daoUser->GetAllfriendYes();
    $usersNot = $daoUser->GetAllfriendNot();

    $html = "<table border='1' width='400px'>";
    $html.='<tr><td><select id="selectFriends" name="usuarios" multiple="multiple" width="100%" style="height: 200px;">';
    foreach ($usersNot as $key => $user) {
        $data=explode('|',$user->rol);
        $html.='<option value="'.$data[3].'" title="'.$data[0].'" >'.$data[0].'</option>';    
    }
    $html.='</select></td>';
    $html.='<td>
                <button type="button" id="botones" onclick="javascript:addAsFriend('.$data[3].')">Add as my Friend?, Yes!</button>
                <button type="button" id="botonNot" onclick="javascript:removeAsFriend('.$data[3].')">Remove as a my Friend?</button>
            </td>';
    $html.='<td><select id="addedFriends" name="usuarios2" multiple="multiple" width="100%" style="height: 200px;">';
    foreach ($usersYes as $key => $user) {
        $data=explode('|',$user->rol);
        $html.='<option value="'.$data[3].'" title="'.$data[0].'" >'.$data[0].'</option>';    
    }
    $html.='</select></td></tr>';
    $html.='</table>';

}
    

$content = <<<EOS
<table>
    <tr>
        <td>
            <section>
                <div>
                    <h2> Nombre de usuario </h2>
                    <input readonly id="nombre" type="text" name="name" value="$name"
                </div>
                <div>
                    <h2> Rol de usuario </h2>
                    <input readonly id="nombre" type="text" name="name" value="$rol"
                </div>
            </section>
        </td>
        <td>
            {$html}
        </td>
    </tr>
</table>

EOS;

$content .= "esto es una pruenba ";

require_once(PROJECT_ROOT . "/includes/templates/mainTemplate.php");
