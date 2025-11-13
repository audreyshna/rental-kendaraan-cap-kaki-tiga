<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
    <title>Create Account</title>
    <link rel = "stylesheet" type = "text/css" href ="<?= base_url('signup.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="logo">
        <img src="<?= base_url('image/logocapkaki3.png') ?>" alt="Logo Cap Kaki 3">
    </div>
    <div class = "content">
        <h1>Create an Account</h1><br><br>
        <form method="POST" action="<?= base_url('auth/signup') ?>">
            Nama Lengkap:<br>
            <input type="text" name = "NamaLengkap" placeholder="Nama Lengkap"><br>
            Nomor Telepon:<br>
            <input type="tel" pattern="[0-9]{10,12}" name = "NomorTelepon" step="1" min="0" placeholder="Nomor Telepon" required><br>
            Email:<br>
            <input type="text" name = "Email" placeholder="Email" pattern=".*@.+" required><br>
            Password:<br>
            <input type="password" name = "Password" placeholder="Password" required><br>
            <br><p>Already have an account?<a href="<?= base_url('auth/login') ?>">Login</a></p>
            <input type="submit" value="Create Account">
        </form>
    </div>
</body>
</html>