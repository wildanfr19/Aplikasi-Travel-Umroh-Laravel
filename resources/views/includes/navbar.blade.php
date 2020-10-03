<div class="container">
<nav class="row navbar navbar-expand-lg navbar-light bg-white">
	<a href="{{ route('home') }}" class="navbar-brand" title="">
		<img src="{{ asset('frontend/images/logo.png') }}" alt="logo NOMADS">
	</a>
	<button type="button" class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navb">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navb">
		<ul class="navbar-nav ml-auto mr-3">
			<li class="nav-item mx-md-2">
				<a href="#home" class="nav-link active page-scroll">Home</a>
			</li>
			<li class="nav-item mx-md-2">
				<a href="#paket-travel" class="nav-link page-scroll">Paket Travel</a>
			</li>
			<li class="nav-item dropdown">
				<a
				href="#"
				class="nav-link dropdown-toggle"
				id="navbardrop"
				data-toggle="dropdown"
				>
				Services
			</a>
			<div class="dropdown-menu">
				<a href="#" class="dropdown-item">Link</a>
				<a href="#" class="dropdown-item">Link</a>
				<a href="#" class="dropdown-item">Link</a>
			</div>
		</li>
		<li class="nav-item mx-md-2">
			<a href="#testimonial" class="nav-link page-scroll">Testimonial</a>
		</li>
		<!-- Mobile -->
	</ul>
	@guest

	<form class="form-inline d-sm-block d-md-none">
		<button type="submit" onclick="event.preventDefault(); location.href='{{ route('login') }}'" class="btn btn-login my-2 my-sm-0 ">
			Masuk
		</button>
	</form>
	<!-- Dekstop Button -->
	<form class="form-inline my-2 my-lg-0 d-none d-md-block">
		<button type="submit" onclick="event.preventDefault(); location.href='{{ route('login') }}'" class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
			Masuk
		</button>
	</form>

	@endguest

	@auth

	<form class="form-inline d-sm-block d-md-none" action="{{ route('logout') }}" method="POST">
		@csrf
		<button type="submit"  class="btn btn-login my-2 my-sm-0 ">
			Keluar
		</button>
	</form>
	<!-- Dekstop Button -->
	<form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{ route('logout') }}" method="POST">
		@csrf
		<button type="submit"  class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
			Keluar
		</button>
	</form>

	@endauth
	
</nav>
</div>
