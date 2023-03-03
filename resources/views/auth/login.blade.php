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
    <div class="login-container">
        <div class="login-img">
            <div class="img-par">
                <img src="{{ asset('/people.png') }}"><img>
            </div>
            <div class="log-text">
                <p>Mock is just waiting for you inside.</p>
                <p>Just get it done!</p>
            </div>
        </div>
        <div class="login-form">
            <div class="log-head">
                <p>Sign in</p>
            <div>
            <div class="log-wel">
                <p>Just making sure that you are eligible</p>
                <p>for taking this mock</p>
            <div>
            <div class="form-par">
            <form action="/login/home" method="POST">
                @csrf
                <div class="new">
                    <label>Email</label>
                    <input type="email" id="" name="email"/>
                </div>
                <div class="new">
                    <label>Password</label>
                    <input type="password" id="" name="password"/>
                </div>
                <button class="log-btn">Login</button>
            </form>
            @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
            @if (session()->has('success'))
                <script>
                    sucessAlert('{{ session('success') }}');
                </script>
            @endif
            </div>
        </div>
    </div>
</body>
<script>
    function sucessAlert(message){
        alert(message);
    }
</script>
</html>