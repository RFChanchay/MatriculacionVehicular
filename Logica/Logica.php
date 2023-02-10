<?php
require_once("../Model/AutoModel.php");

$data = json_decode(file_get_contents("php://input"));
session_start();
function get_name_file($nombre_original, $tamanio){
    $tmp = explode(".",$nombre_original); //Divido el nombre por el punto y guardo en un arreglo
    
    /*	echo "<br>TEMP: <br>";
        echo "<pre>";
          print_r($tmp);
        echo "</pre>"; */
    
    $numElm = count($tmp); //cuento el número de elemetos del arreglo
    $ext = $tmp[$numElm-1]; //Extraer la última posición del arreglo.
    
    $cadena = "";
    for($i=1;$i<=$tamanio;$i++){
      $c = rand(65,122);
      if(($c >= 91) && ($c <=96)){
        $c = NULL;
         $i--;
       }else{
          $cadena .= chr($c);
       }
    }
    return $cadena . "." . $ext;
}
function moverImg($files){
    $nombre_foto = 'img/' . get_name_file($files['foto']['name'],15);
      move_uploaded_file($files['foto']['tmp_name'],$nombre_foto);
  
} 

switch ($data->operacion) {
    case "Guardar":
        $ProductoModel = new ProductoModel();

        $ProductoModel->setPlaca($data->placa);
        $ProductoModel->setMarcaMotor($data->marcaMotor);
        $ProductoModel->setChasis($data->chasis);
        $ProductoModel->setCombustible($data->combustible);
        $ProductoModel->setAño($data->año);
        $ProductoModel->setEstado($data->estado);
        $usr=$_SESSION["NOMBRE"];
        $ProductoModel->setUsuario($usr);

        if ($data->id == "") {
            //get_name_file($data->foto)
            //moverImg($data->foto);
            echo $ProductoModel->InsertarProducto();
            //print_r($data->foto) ;
        } else {
            $ProductoModel->setId($data->id);
            echo $ProductoModel->ActualizarProducto();
        }
        break;

    case "BuscarTodos":
        $ProductoModel = new ProductoModel();
        $resultado = $ProductoModel->BuscarTodos();
        //print_r($resultado);
        foreach ($resultado as $fila) {
            if($_SESSION["NOMBRE"]==$fila[8]||$_SESSION["tipo"]=='admin'){
                    echo "<tr><td>$fila[0]</td><td>$fila[1]</td><td>$fila[2]</td><td>$fila[3]</td><td>$fila[4]</td><td>$fila[5]</td><td>$fila[6]</td><td><button class='btn btn-danger' onclick='Eliminar($fila[0]);'>Eliminar</button></td><td><button class='btn btn-success' onclick='Rellenar($fila[0]);'>Editar</button></td></tr>"; 
                
            }
        }
        
        
        break;

    case "Eliminar":
        $ProductoModel = new ProductoModel();
        $ProductoModel->setId($data->id);
        $resultado = $ProductoModel->EliminarProducto();
        echo $resultado;
        break;

    case "Rellenar":
        $ProductoModel = new ProductoModel();
        $ProductoModel->setId($data->id);
        $resultado = $ProductoModel->BuscarPorId();
        echo $resultado;
        break;
}
?>