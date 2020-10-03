@extends('layouts.app')

@section('title','DETAILS')



@section('content')

<main>
	<section class="section-details-header">
	</section>
	<section class="section-details-content">
		<div class="container">
			<div class="row">
				<div class="col p-0">
					<nav>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">Paket Travel</li>
							<li class="breadcrumb-item active">Details</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 pl-lg-0">
					<div class="card card-details">
						<h1>{{ $item->title }}</h1>
						<p>
							{{ $item->location }}
						</p>
						@if($item->galleries->count())

						<div class="gallery">
							<div class="xzoom-container">
								<img src="{{ Storage::url($item->galleries->first()->image) }}" class="xzoom" id="xzoom-default" xoriginal="{{ Storage::url($item->galleries->first()->image) }}" alt="">
							</div>

							<div class="xzoom-thumbs">
								@foreach($item->galleries as $gallery)
								<a href="frontend/images/details.jpg" title="">
									<img src="{{ Storage::url($gallery->image) }}" class="xzoom-gallery" width="128" xpreview="{{ Storage::url($gallery->image) }}" alt="">
								</a>
								@endforeach
							</div>
						</div>

						@endif
						<h2>Tentang Wisata</h2>
						<p>{!! $item->about !!}</p>
						<div class="features row">
							<div class="col-md-4">
								
								<div class="description">
									<img src="{{ asset('frontend/images/ic_event.png') }}" alt="">
								</div>
								<div class="description">
									<h3>Featured Event</h3>
									<p>{{ $item->featured_event }}</p>
								</div>
							</div>
							<div class="col-md-4">
								<div class="description">
									<img src="{{ asset('frontend/images/ic_language.png') }}" alt="">
								</div>
								<div class="description">
									<h3>Language</h3>
									<p>{{ $item->language }}</p>
								</div>
							</div>
							<div class="col-md-4 border-left">
								<div class="description">
									<img src="{{ asset('frontend/images/ic_foods.png') }}" alt="">
								</div>
								<div class="description">
									<h3>Foods</h3>
									<p>{{ $item->foods }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="card card-details card-right">
						<h2>Members are going</h2>
						<div class="members any-2">
							<img src="{{ asset('frontend/images/member-1.png') }}" class="member-image mr-1" alt="">
							<img src="{{ asset('frontend/images/member-2.png') }}" class="member-image mr-1" alt="">
							<img src="{{ asset('frontend/images/member-3.png') }}" class="member-image mr-1" alt="">
							<img src="{{ asset('frontend/images/member-4.png') }}" class="member-image mr-1" alt="">
							<img src="{{ asset('frontend/images/member-5.png') }}" class="member-image mr-1" alt="">
						</div>
						<hr>
						<h2>Trip Informations</h2>
						<table class="trip-informations">
							<tr>
								<th width="50%">Date of departure</th>
								<td width="50%" class="text-right">{{ \Carbon\Carbon::parse($item->departure_date)->format('F n, Y') }}</td>
							</tr>
							<tr>
								<th width="50%">Duration</th>
								<td width="50%" class="text-right">{{ $item->duration }}</td>
							</tr>
							<tr>
								<th width="50%">Type</th>
								<td width="50%" class="text-right">{{ $item->type }}</td>
							</tr>
							<tr>
								<th width="50%">Price</th>
								<td width="50%" class="text-right">Rp. {{ number_format($item->price) }} / person</td>
							</tr>
						</table>
					</div>

					<div class="join-container">
						@auth

						<form action="{{ route('checkout.process', $item->id) }}" method="post">
							@csrf
							<button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
								Join Now
							</button>
						</form>

						@endauth

						@guest

						<a href="{{ route('checkout', $item->id) }}" class="btn btn-block btn-join-now mt-3 py-2" title="">
							Login Or Register to Join
						</a>

						@endguest
						
					</div>
				</div>
			</div>
		</div>


		
	</section>
</main>

@endsection

@push('prepend-style')
<link rel="stylesheet" href="{{ asset('frontend/libraries/xzoom/xzoom.css') }}">
@endpush

@push('addon-script')


<script type="text/javascript" src="{{ asset('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('.xzoom, .xzoom-gallery').xzoom({
			zoomWidth: 500,
			title: false,
			tint: '#333',
			Xoffset: 15
		});
	});
</script>

@endpush