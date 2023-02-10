<?php
//include("Config/conn.php");
include("Config/Database.php");
session_start();
//$_SESSION['PERMISO'] = FALSE;
if($_SESSION['PERMISO']==FALSE){
  echo "<script>
            
            window.location.href = 'index.php';
            </script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="js/script.js"></script>
  <title>Productos</title>
</head>

<body onload="BuscarTodos();">

  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">SISTEMA VEHICULAR - Cliente</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="create.php">Crear Usuario</a>
            
          </div>
        </div>
        <form class="row g-3" action="salir.php" method="post" id="formulario">
          <button type="submit" class="btn btn-danger">SALIR</button>
        </form>
      </div>
    </nav>
  </div>
  <div class="container">
    <div class="row">
      <form onsubmit="return false;" class="row g-3">
        <div class="col-md-6">
          <input type="hidden" id="idp">
          <label for="inputplaca" class="form-label">Placa</label>
          <input type="text" class="form-control" id="placa">
        </div>
        <div class="col-md-6">
          <label for="inputmarcaMotor" class="form-label">Marca del motor</label>
          <select id="marcaMotor" class="form-select">
          <option selected>Seleccione...</option>
            <option value=1>Chevrolet</option>
            <option value=2>Fiat</option>
            <option value=3>GW</option>
            <option value=4>Great Wall</option>
            <option value=5>Toyota</option>
            <option value=6>Mazda</option>
            <option value=7>Kia</option>
            <option value=8>Hyundai</option>
            <option value=9>Ford</option>
            <option value=10>Peugeout</option>
            <option value=11>Volkswagen</option>
            <option value=12>Daihatsu</option>
            <option value=13>Susuki</option>
            <option value=14>Citroen</option>
            <option value=15>Jeep</option>
            <option value=16>JAC</option>
            <option value=17>Hino</option>
            <option value=18>Renault</option>

          </select>
        </div>
        <div class="col-md-6">
          <label for="inputchasis" class="form-label">Chasis</label>
          <input type="text" class="form-control" id="chasis">
        </div>
        <div class="col-md-6">
          <label for="inputcombustible" class="form-label">Combustible</label>
          <select id="combustible" class="form-select">
            <option selected>Seleccione...</option>
            <option value="Gasolina">Gasolina</option>
            <option value="Diesel">Diesel</option>
            <option value="Otro">Otro</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="inputaño" class="form-label">Año</label>
          <input type="number" class="form-control" id="año">
        </div>
        <div class="col-md-6">
          <label for="inputestado" class="form-label">Estado</label>
          <input type="text" class="form-control" id="estado" readonly placeholder="En revision...">
        </div>
        <div class="col-md-12">
          <label for="inputfoto" class="form-label">Foto</label>
          <input type="file" class="form-control" id="foto">
        </div>

        <div class="col-6">
          <button type="submit" class="btn btn-primary" onclick="Guardar();">Guardar</button>
        </div>

      </form>

      <div class="alert alert-success" role="alert" id="res">
        ...
      </div>
    </div>

    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>PLACA</th>
            <th>MARCA MOTOR</th>
            <th>CHASIS</th>
            <th>COMBUSTIBLE</th>
            <th>AÑO</th>
            <th>ESTADO</th>
          </tr>
        </thead>
        <tbody id="datos">
        </tbody>
      </table>
    </div>
  </div>

</body>

</html>