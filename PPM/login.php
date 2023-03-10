<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Employee's Payroll Management System</title>

  <?php include('./header.php'); ?>
  <?php include('./db_connect.php'); ?>
  <?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
  
  <style>
   body {
      width: 100%;
      height: 100vh; /* changed from 100% to 100vh */
      /*background: #007bff;*/
    }
    
    /* added class to main element */
    main.main {
      width: 100%;
      height: 100vh; /* changed from 100% to 100vh */
      background: white;
    }
    
    /* added class to login-right element */
    div.login-right {
      position: absolute;
      right: 0;
      width: 100%;
      height: 100vh; /* changed from 100% to 100vh */
      background: orange;
      display: flex;
      align-items: center;
    }
    
    /* added class to card element */
    div.card {
      margin: auto;
      z-index: 1;
    }
    
    /* added class to logo element */
    div.logo {
      margin: auto;
      font-size: 8rem;
      background: white;
      padding: .5em 0.7em;
      border-radius: 50% 50%;
      color: #000000b3;
      z-index: 10;
    }
    
    /* added class to login-right::before element */
    div.login-right::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh; /* changed from 100% to 100vh */
      background-image:linear-gradient(to top, rgba(0,0,0,0.5)50%,rgba(0,0,0,0.5)50%),url(assets/img/payroll.jfif);
      
    }

	
  </style>

</head>

<body>

  <main class="main">
   

    <div class="login-right">
  
      <div class="card col-md-4">
		  
        <div class="card-body">
          <form id="login-form">
            <div class="form-group">
              <label for="username" class="control-label">Username</label>
              <input type="text" id="username" name="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="password" class="control-label">Password</label>

  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>