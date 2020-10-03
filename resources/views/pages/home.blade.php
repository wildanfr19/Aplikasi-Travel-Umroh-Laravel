@extends('layouts.app')

@section('title','Homepage')

@section('content')

<header class="text-center">
	<h1>
		Explorer the Beautyful Jawa Barat <br>
		As Easy One Click
	</h1>
	<p class="mt-3">
		Explorer aja dulu
		<br/>
		Siapa tahu rindu
	</p>
	<a href="{{ route('register') }}" class="btn btn-get-started px-4 mt-4" title="">
		Get Started
	</a>
</header>
<!-- Main  -->
<main>
	<div class="container">
		<section class="section-stats row justify-content-center" id="stats">
			<div class="col-3 col-md-3 stats-detail">
				<h2>20K</h2>
				<p>Members</p>
			</div>
			<div class="col-3 col-md-3 stats-detail">
				<h2>12</h2>
				<p>Countries</p>
			</div>
			<div class="col-3 col-md-3 stats-detail">
				<h2>3K</h2>
				<p>Hotel</p>
			</div>
			<div class="col-3 col-md-3 stats-detail">
				<h2>72</h2>
				<p>Partners</p>
			</div>
		</section>
	</div>
	<section id="popular" class="section-popular">
		<div class="container">
			<div class="row">
				<div class="col text-center section-popular-heading">
					<h2>Wisata Popular Jawa Barat</h2>
					<p>
						Something that you never try <br>
						before in this World
					</p>
				</div>
			</div>
		</div>
	</section>
	<section class="section-popular-content" id="popularContent">
		<div class="container">
			<div class="section-popular-travel row justify-content-center">
				@foreach($items as $item)
				<div class="col-sm-6 col-md-4 col-lg-3">
					<div class="card-travel text-center d-flex flex-column" style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : '' }}');"
						>
						<div class="travel-country">{{ $item->location }}</div>
						<div class="travel-location">{{ $item->title }}</div>
						<div class="travel-button mt-auto">
							<a href="{{ route('detail', $item->slug) }}" class="btn btn-travel-details px-4">
								View Details
							</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</section>


		<section class="section-networks">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<h2>Our Networks</h2>
						<p>
							Companies are trusted us <br>
							more than just a trip
						</p>
					</div>

					<div class="col-md-8 text-center">
						<img src="{{ asset('frontend/images/partner.png') }}" alt="Logo Partner" class="img-partner">
					</div>
				</div>
			</div>
		</section>

		<section id="testimonialHeading" class="section-testimonial-heading">
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<h2>They Are Loving Us</h2>
						<br>
						<p>
							Moment were giving them <br>
							the best experience
						</p>
					</div>
				</div>
			</div>
		</section>	


		<div class="section section-testimonial-content" id="testimonialContent">
			<div class="container">
				<div class="section-popular-travel row justify-content-center">
					
					<div class="col-sm-6 col-md-6 col-lg-4">
						<div class="card card-testimonial text-center">
							<div class="testimonial-content">
								<img src="frontend/images/testimonial-1.png" alt="User" class="mb-4 rounded-circle">
								<h3 class="mb-4">Angga Rizky</h3>
								<p class="testimonial">
									"It was glorious and I could not stop to say wohoo for every single moment Dankee!"
								</p>
							</div>
							<hr>

							<p class="trip-to mt-2">
								Trip to Lembang
							</p>
						</div>
					</div>


					<div class="col-sm-6 col-md-6 col-lg-4">
						<div class="card card-testimonial text-center">
							<div class="testimonial-content">
								<img src="frontend/images/testimonial-2.png" alt="User" class="mb-4 rounded-circle">
								<h3 class="mb-4">Shayna</h3>
								<p class="testimonial">
									"The trip was amazing and I saw something beautyful and that islan that makes me
									want to learn more"
								</p>
							</div>
							<hr>

							<p class="trip-to mt-2">
								Trip to Nusa Peninda
							</p>
						</div>
					</div>


					<div class="col-sm-6 col-md-6 col-lg-4">
						<div class="card card-testimonial text-center">
							<div class="testimonial-content">
								<img src="frontend/images/testimonial-3.png" alt="User" class="mb-4 rounded-circle">
								<h3 class="mb-4">Shabrina</h3>
								<p class="testimonial">
									"I loved it when the waves was shaking harder -- I was scared too"
								</p>
							</div>
							<hr>

							<p class="trip-to mt-2">
								Trip to Karimun Jawa
							</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center"	>
						<a href="#" class="btn btn-need-help px-4 mt-4 mx-1" title="">
							I Need Help
						</a>

						<a href="{{ route('register') }}" class="btn btn-get-started px-4 mt-4 mx-1" title="">
							Get Started
						</a>
					</div>	
				</div>	
			</div>
		</div>	
	</main>

	@endsection