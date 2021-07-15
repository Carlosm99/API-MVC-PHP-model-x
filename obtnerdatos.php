<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="container">
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand"><strong>REST API Versión PHP</strong></a>
    <a class="navbar-brand"></a>
    <a class="navbar-brand" href="#">
      <img src="https://qroo.gob.mx/sites/default/files/inline-images/TecChetumal-232x300_0.png" width="90" height="105"
        alt="">
    </a>
    <form class="form-inline">
      <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </nav>
  <!-- space------------------------------------------------------------------navbar -->
  <br>
  <div class="progress">
    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
      aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
  </div>
  <!-- space------------------------------------------------------------------progressbar -->
  <br>

  <!-- space------------------------------------------------------------------paragraph -->
  <br>
  <p>
    <!-- <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
           
        </a> -->
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
      aria-expanded="true">
      Tablas
    </button>

  </p>
  <div class="collapse" id="collapseExample">
    <div class="card card-body">




      <form action="" method="post">

        <!-- <button type="submit" name="region" value="Africa" class="btn btn-outline-danger">Africa</button>
            <button type="submit" name="region" value="Americas" class="btn btn-outline-secondary">Americas</button>
            <button type="submit" name="region" value="Asia" class="btn btn-outline-success">Asia</button>            
            <button type="submit" name="region" value="Europe" class="btn btn-outline-warning">Europe</button>
            <button type="submit" name="region" value="Oceania" class="btn btn-outline-info">Oceania</button> -->
        <div class="container">
          <div class="row">
            <div class="col">
              <div>
     
                <h6>Seleccione la tabla que dese visualizar datos</h6>

              </div>

              <div class="form-check">
                <input class="form-check-input" type="radio" name="region"  value="corridas"
                  >
                <label class="form-check-label" for="exampleRadios1">
                  Corridas
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="region"  value="admin"
                  >
                <label class="form-check-label" for="exampleRadios1">
                  Admin
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="region"  value="usuarios"
                >
                <label class="form-check-label" for="exampleRadios1">
                  Users
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="region" value="busline"
                  >
                <label class="form-check-label" for="exampleRadios1">
                  Busline
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="region"  value="boletos"
                  >
                <label class="form-check-label" for="exampleRadios1">
                  Boletos
                </label>
              </div>

            </div>

          </div>
        </div>
        
        <br>
        <button type="submit" name="submit"class="btn btn-outline-success ">Visualizar </button>
      </form>
    </div>
  </div>
  </div>
  

  <?php 
                         
             if(isset($_POST['submit'])){
                      $region = $_POST['region'];  
                   
             
             
              $curl = curl_init();
            //   CURLOPT_URL => "http://127.0.0.1:8000/api.corridasapp.com/v1/'. $region .",
              curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1:8000/api.corridasapp.com/v1/".$region,
                
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  "cache-control: no-cache"
                ),
              ));

              $response = curl_exec($curl);
              echo $response;
              $err = curl_error($curl);
             // print_r ($response);
              curl_close($curl);




                    }
               
           

            
     ?>





  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>