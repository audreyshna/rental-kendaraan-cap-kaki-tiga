<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" contents="IE-edge">
    <title>login page</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('login.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="logo">
        <img src="<?= base_url('image/logocapkaki3.png') ?>" alt="Logo Cap Kaki 3">
    </div>
    <div id="login">
        <div id="login-content">
            <div id="login-title">
                <b><h1>LOGIN</h1></b>
                <div class="underline-title">

                </div>
            </div>
            <?php if (session()->getFlashdata('error')): ?>
                <div style="color: red; margin: 10px 0;">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url('auth/login/authenticate') ?>" class="form">
                 <label for="user-email" styles="padding-top: 13px">&nbsp;E-mail</label>
                 <input id="user-email" class="form-content" type="email" 
                 name="Email" placeholder= "Email"  pattern=".+@.+" required/>
                 <div class="form-border">
                    
                 <label for="user-password" styles="padding-top: 22px">&nbsp;Password</label>
                 <input id="user-password" class="form-content" type="password" 
                 name="password" placeholder= "Password" required/>
                 
                 <div class="container">
                    <div class="signup-cover">
                        <p>Don't have an account? <a href="<?= site_url('auth/signup') ?>"> Create Account </a></p>
                        <button id="login-btn">LOGIN</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>