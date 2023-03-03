<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('/style.css') }}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
</head>
<body>
    
</body>
<body>
    <div class="login-container lop">
        <div class="login-img stimg">
            <div class="img-par signimg">
                <img src="{{ asset('/sign.jpg') }}"><img>
            </div>
            <div class="log-text np">
                <p>Mock is just waiting for you inside.</p>
                <p>Just get it done!</p>
            </div>
        </div>
        <div class="login-form signform">
            <div class="log-head">
                <p>Sign up</p>
            <div>
            <div class="log-wel">
                <p>Just making sure that you are eligible</p>
                <p>for taking this mock</p>
            <div>
            <div class="form-par">
                <form action="/user/signup" method="POST">
                    @csrf
                    <div class="new stl">
                        <label>Username</label>
                        <input type="text" id="" name="username"/>
                    </div>
                    <div class="new stl">
                        <label>Email</label>
                        <input type="email" id="" name="email"/>
                    </div>
                    <div class="new stl">
                        <label>Password</label>
                        <input type="password" id="" name="password"/>
                    </div>
                    <div class="new stl">
                        <label>Confirm Password</label>
                        <input type="password" id="" name="confirm"/>
                    </div>
                    <button class="log-btn lt">Signup</button>
                </form>
            @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
            </div>
        </div>
    </div>
</body>
</html>