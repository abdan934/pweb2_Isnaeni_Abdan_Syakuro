@extends('layout/layout_login')

@section('konten')
<div class="container" id="container"> 
	<div class="form-container sign-up-container">
		<form action="/register" method="POST">
			<h1>Register</h1>
            <br>
          @include('komponen/pesan_login')
            <br>
            @csrf
			<input type="text" name="name" placeholder="Nama" required/>
			<input type="email" name="email" placeholder="Email" value="{{Session::get('email')}}" required/>
			<input type="text" name="username" placeholder="Username" value="{{Session::get('username')}}" required/>
			<input type="password" name="password" placeholder="Password" required/>
			<input type="password" name="password_confirmation" placeholder="Confirm Password" required/>
			<button type="submit" name="submit">Daftar</button>
		</form>
	</div>
    </section>
    <section id="masuk">
	<div class="form-container sign-in-container">
		<form action="/login" method="POST">
			@csrf
			
			<br>
			<h1>Masuk</h1>
			<br>
			@include('komponen/pesan_login')
			<br>
			<input type="text" placeholder="Username" name="username" value="{{Session::get('username')}}" required/>
			<input type="password" placeholder="Password" name="password" required/>
          
			<a href="#">Lupa Password?</a>
			<button name="submit" type="submit">Masuk</button>
		</form>
	</div>
    </section>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				{{-- <h1>Hi Kamu,</h1>
				<p>Silahkan masuk jika anda sudah mempunyai akun</p> --}}
                <h1><img src="{{'images/pnc-nobg.png'}}"></h1>
				<button class="ghost" id="signIn">Masuk</button>
			</div>
			<div class="overlay-panel overlay-right">
				{{-- <h1>Hi, Kamu</h1>
				<p>Belum punya akun?</p> --}}
                <h1><img src="{{'images/pnc-nobg.png'}}"></h1>
				<button class="ghost" id="signUp" >Register</button>
			</div>
		</div>
	</div>
</div>
@endsection

<footer>

</footer>

<script>
	 setTimeout(function() {
        document.getElementById('labelpesan').click();
    }, 100);
</script>



