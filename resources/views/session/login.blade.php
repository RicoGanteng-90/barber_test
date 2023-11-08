<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in | Sign-up</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <br>
    <br>
        <div class="cont">
        <form action="{{route('session.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form sign-in">
                <h2>Welcome</h2><br>

                @error('email')
                    <div class="alert alert-error"><div style="text-align: center">{{ $message }}</div></div>
                @enderror

                <label>
                    <span>Email</span>
                    <input name="email" type="email" required/>
                </label>
                <label>
                    <span>Password</span>
                    <input name="password" type="password" required/>
                </label>
                <p class="forgot-pass">Forgot password?</p>
                <button type="submit" class="submit">Sign In</button>
            </div>
        </form>
            <div class="sub-cont">
                <div class="img">
                    <div class="img__text m--up">

                        <h3>Don't have an account? Please Sign up!<h3>
                    </div>
                    <div class="img__text m--in">

                        <h3>If you already has an account, just sign in.<h3>
                    </div>
                    <div class="img__btn">
                        <span class="m--up">Sign Up</span>
                        <span class="m--in">Sign In</span>
                    </div>
                </div>
            <form action="{{route('session.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form sign-up">
                    <h2>Create your Account</h2>
                    <label>
                        <span>Name</span>
                        <input name="nama_user" type="text" required/>
                    </label>
                    <label>
                        <span>UserName</span>
                        <input name="username" type="text" required/>
                    </label>
                    <label>
                        <span>Email</span>
                        <input name="email" type="email" required/>
                    </label>
                    <label>
                        <span>Password</span>
                        <input name="password" type="password" required/>
                    </label>
                    <label>
                        <span>Nomor_telp</span>
                        <input name="no_telp" type="text" required/>
                    </label>
                    <label>
                        <span>Alamat</span>
                        <input name="alamat" type="text" required/>
                    </label>
                    <button type="submit" class="submit">Sign Up</button>
                </div>
            </form>
            </div>
        </div>

        <script>
            document.querySelector('.img__btn').addEventListener('click', function() {
                document.querySelector('.cont').classList.toggle('s--signup');
            });
        </script>
</body>
</html>
