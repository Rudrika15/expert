<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('loginTemplateCss/css/style.css')}}">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			{{-- <div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Student Login</h2>
				</div>
			</div> --}}
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Login</h3>
						<form action="{{route('studentLoginStored')}}" method="post" enctype="multipart/form-data" class="login-form">
                            @csrf
                    
                            <div class="form-group">
		      			<input type="text" class="form-control rounded-left" name="name" placeholder="Name">
                          @if($errors -> has('name'))
                          <span class="text-danger">{{$errors -> first('name')}}</span>
                          @endif	
                    </div>
	            <div class="form-group">
                    <input type="text" name="email" class="form-control rounded-left" placeholder="Email" class="form-control">
                    @if($errors -> has('email'))
                    <span class="text-danger">{{$errors -> first('email')}}</span>
                    @endif	  
                </div>
                <div class="form-group">
                    <input type="text" class="form-control rounded-left" name="phoneNumber" placeholder="PhoneNumber">
                    @if($errors -> has('phoneNumber'))
                    <span class="text-danger">{{$errors -> first('phoneNumber')}}</span>
                    @endif	
              </div>
                
	            <div class="form-group">
	            	<button type="submit" value="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
	            </div>
	          
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

