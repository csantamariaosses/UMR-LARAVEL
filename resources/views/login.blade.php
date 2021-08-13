<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row mt-4">
        <div class="col-4"></div>
        <div class="col-4"><h3>UMR</h3></div>
        <div class="col-4"></div>
    </div>
  
    <div class="row mt-4">

        <div class="col-4"></div>
        <div class="col-4">
          <div class="card" style="width: 18rem;">
            <div class="card-header">
            Acceso
            </div>
            <form  method="POST" action="acceso">
            @csrf
            <div>
            <table>
                <tr><td>Usuario</td><td><input type="text" name="usuario" id="usuario"  placeholder="uuario"></td></tr>
                <tr><td>Password</td><td><input type="password" name="password" id="password" placeholder="password" value="current-password"></td></tr>
                <tr><td></td><td><button class="btn btn-outline-secondary btn-block" type="submit" >Ingresar</button></td></tr>
            </table>
            </div>
            </form>
            <div class="card-footer">
                    
            </div>

        </div>
        </div>
        <div class="col-4"></div>
    </div>
  
</div>    
</body>
</html>