<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
      <title>Sign up</title>
  </head>

  <body>  
    <h1>Sign up</h1>   
    <form action="./insert.php" method="post">         
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Login</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name=login>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name=password>    
      </div>
      <div class="mb-3">
        <input type="hidden" name="role_id" value="2">
        
        <input type="submit" class="btn btn-secondary">

        <a class="btn btn-secondary" href="../index.php">Login</a>
      </div>
    </form>
  </body>
</html>
