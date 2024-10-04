

<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register </title>
  <link href="{{ asset('css/stylelogandregis.css') }}" rel="stylesheet">

</head>
<body>
  <div class="wrapper">
    <form action="/register" method="POST">
        @csrf
      <h2>Register</h2>
        <div class="input-field">
        <input type="name" value="" name="name"  required>
        <label>Enter your Name</label>
      </div>
      <div class="input-field">
        <input type="email" value="" name="email" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" value="" name="password" required>
        <label>Enter your password</label>
      </div>
      <button type="submit">Register</button>
      <div class="register">
        <p>you already have account? <a href="">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html>