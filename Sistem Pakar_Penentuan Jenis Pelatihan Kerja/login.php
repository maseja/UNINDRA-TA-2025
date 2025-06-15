<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap');

body {
    background: linear-gradient(135deg, #e9f5ff 0%, #fafdff 100%);
    min-height: 100vh;
    font-family: 'Montserrat', Arial, sans-serif;
}
.login-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 28px 0;
}
.login-form {
    background: #fff;
    padding: 38px 34px 30px 34px;
    border-radius: 1.7rem;
    box-shadow: 0 10px 36px rgba(0,51,102,0.12), 0 1.5px 3.5px rgba(0,0,0,0.07);
    max-width: 400px;
    width: 100%;
    animation: fadeInUp 1.2s cubic-bezier(.7,.1,.3,1);
    position: relative;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px);}
    to { opacity: 1; transform: none;}
}
.login-form .header-image {
    width: 70px;
    height: 70px;
    display: block;
    margin: 0 auto 16px auto;
    border-radius: 16px;
    background: #f1f6fa;
    padding: 10px;
}
.login-form h1 {
    font-size: 2.1rem;
    font-weight: 700;
    letter-spacing: 0.02em;
    color: #003366;
    margin-bottom: 6px;
}
.login-form .form-group label {
    color: #0c2547;
    font-size: 1.07rem;
    font-weight: 500;
}
.login-form .form-control {
    border-radius: 1em;
    font-size: 1.1rem;
    padding: 10px 16px;
    border: 1.5px solid #cce6f2;
    transition: box-shadow .25s;
}
.login-form .form-control:focus {
    border-color: #338eda;
    box-shadow: 0 0 0 2px #b4dafe66;
}
.show-password {
    color: #338eda;
    font-size: 1.2rem;
    cursor: pointer;
    outline: none;
    line-height: 1;
}
.show-password:focus {
    outline: none;
}

.login-form .btn-primary {
    background: linear-gradient(90deg, #338eda 60%, #003366 100%);
    border: none;
    border-radius: 1em;
    font-size: 1.13rem;
    padding: 10px 0;
    width: 100%;
    font-weight: 600;
    letter-spacing: 0.03em;
    box-shadow: 0 2px 8px #cce6f2;
    transition: background .2s, box-shadow .2s, transform .1s;
}
.login-form .btn-primary:hover, .login-form .btn-primary:focus {
    background: linear-gradient(90deg, #003366 60%, #338eda 100%);
    box-shadow: 0 6px 20px #a3cfff55;
    transform: translateY(-2px) scale(1.01);
}
.login-form .text-forgot {
    margin-top: 18px;
    font-size: .99rem;
}
.login-form .text-forgot a {
    color: #338eda;
    text-decoration: underline;
    transition: color .2s;
}
.login-form .text-forgot a:hover {
    color: #003366;
}
@media (max-width: 500px) {
    .login-form { padding: 24px 8vw 16px 8vw;}
    .login-form .header-image { width: 54px; height: 54px; }
    .login-form h1 { font-size: 1.3rem; }
}
</style>

<div class="login-container">
    <div class="login-wrapper">
        <form class="login-form" method="post" autocomplete="off">
            <img src="assets/images/KEMNAKERRI.png" class="header-image" alt="Logo Instansi" />
            <h1 class="text-center">Selamat Datang</h1>
            <p class="text-center mb-4" style="font-size:.98rem;color:#4b5c6b;">
                Sistem Pakar Penentuan Pelatihan Kerja<br><span style="color:#338eda">Kementerian Ketenagakerjaan RI</span>
            </p>
            <?php if ($_POST) include 'aksi.php'; ?>
            <div class="form-group" style="position:relative;">
                <label for="inputUser">Username</label>
                <input type="text" id="inputUser" class="form-control" placeholder="Masukkan username" name="user" autofocus required />
            </div>
<div class="form-group position-relative" style="position:relative;">
    <label for="inputPassword">Password</label>
    <div style="position:relative;">
        <input type="password" id="inputPassword" class="form-control" placeholder="Masukkan password" name="pass" required style="padding-right:44px;">
        <button type="button" class="show-password" tabindex="-1" onclick="togglePassword()" 
            style="position:absolute; top:50%; right:14px; transform:translateY(-50%); border:none; background:none; padding:0; margin:0;">
            <span class="glyphicon glyphicon-eye-open"></span>
        </button>
    </div>
</div>
            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit">
                    <span class="glyphicon glyphicon-log-in"></span> Masuk
                </button>
            </div>
            <div class="text-forgot text-center">
                <a href="?m=forgot">Lupa password?</a>
            </div>
            <div class="text-forgot text-center mt-2">
                <a href="?m=signup">Daftar akun baru</a>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    var pass = document.getElementById("inputPassword");
    var btn = document.querySelector(".show-password span");
    if (pass.type === "password") {
        pass.type = "text";
        btn.classList.remove('glyphicon-eye-open');
        btn.classList.add('glyphicon-eye-close');
    } else {
        pass.type = "password";
        btn.classList.remove('glyphicon-eye-close');
        btn.classList.add('glyphicon-eye-open');
    }
}
</script>
