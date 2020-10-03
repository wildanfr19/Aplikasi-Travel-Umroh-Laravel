@extends('layouts.checkout')

@section('title','CHECKOUT')

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
							<li class="breadcrumb-item">Details</li>
							<li class="breadcrumb-item active">Checkout</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-8 pl-lg-0">
					<div class="card card-details">
						@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
						<h1>Who Is Going?</h1>
						<p>
							Trip to {{ $item->travel_package->title }},{{ $item->travel_package->location }}
						</p>
						<div class="attende">
							<table class="table table-responsive-sm text-center">
								<thead>
									<tr>
										<th>Picture</th>
										<th>Name</th>
										<th>Nationality</th>
										<th>Visa</th>
										<th>Passport</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@forelse($item->details as $detail)
									<tr>
										<td>
											<img src="https://ui-avatars.com/api/?name{{ $detail->username }}" height="60" alt="">
										</td>
										<td class="align-middle">{{ $detail->username }}</td>
										<td class="align-middle">{{ $detail->nationality }}</td>
										<td class="align-middle">{{ $detail->is_visa ? '30 Days':'N/A'  }}</td>
										<td class="align-middle">{{ \Carbon\Carbon::parse($detail->doe_passport) > \Carbon\Carbon::now()  ? 'Active' : 'Inactive' }}</td>
										<td class="align-middle">
											<a onclick="return confirm('Are you sure?')" href="{{ route('checkout.remove', $detail->id) }}" title="">
												<img src="{{ asset('frontend/images/ic_remove.png') }}" alt="">
											</a>
										</td>
									</tr>
									@empty

									<tr>
										<td colspan="6">Data Kosong</td>
									</tr>

									@endforelse
								</tbody>
							</table>
						</div>
						<div class="member mt-3">
						  <h2>Add Member</h2>
						  <form class="form-inline" method="post" action="{{ route('checkout.create', $item->id) }}">
						    @csrf
						    <label for="username" class="sr-only">Name</label>
						    <input
						      type="text"
						      name="username"
						      class="form-control mb-2 mr-sm-2"
						      id="inputUsername"
						      placeholder="Username"
						    />

						  <label for="nationality" class="sr-only">Name</label>
						  <input
						      type="text"
						      name="nationality"
						      class="form-control mb-2 mr-sm-2"
						      style="width: 50px;"
						      id="inputNationality"
						      placeholder="Nationality"
						  />

						    <label for="is_visa" class="sr-only">Visa</label>
						    <select
						      name="is_visa"
						      id="inputVisa"
						      class="custom-select mb-2 mr-sm-2"
						      required
						    >
						      <option value="" selected>VISA</option>
						      <option value="1">30 Days</option>
						      <option value="0">N/A</option>
						    </select>

						    <label for="doePassport" class="sr-only"
						      >DOE Passport</label
						    >
						    <div class="input-group mb-2 mr-sm-2">
						      <input
						        type="text"
						        name="doe_passport"
						        class="form-control datepicker"
						        id="doePassport"
						        placeholder="DOE Passport"
						      />
						    </div>

						    <button type="submit" class="btn btn-add-now">
						      Add Now
						    </button>
						  </form>
						  <h3 class="mt-2 mb-0">Note</h3>
						  <p class="disclaimer mb-0">
						    You are only able to invite member that has registered in
						    Nomads.
						  </p>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card card-details card-right">
						
						<h2>Checkout Informations</h2>
						<table class="trip-informations">
							<tr>
								<th width="50%">Members</th>
								<td width="50%" class="text-right">{{ $item->details->count() }}</td>
							</tr>
							<tr>
								<th width="50%">Additional VISA</th>
								<td width="50%" class="text-right">{{ $item->addtional_visa }}</td>
							</tr>
							<tr>
								<th width="50%">Trip Price</th>
								<td width="50%" class="text-right">Rp.{{ number_format($item->travel_package->price) }}, 00 / Person</td>
							</tr>
							<tr>
								<th width="50%">Sub total</th>
								<td width="50%" class="text-right">Rp.{{ number_format($item->transactions_total) }}, 00</td>
							</tr>
							<tr>
								<th width="">Total(+Unique)</th>
								<td width="" class="text-right">
								<span class="text-blue">Rp.{{ number_format($item->transactions_total) }}, {{-- </span>
								<span class="text-orange">{{-- {{ mt_rand(0,99) }} --}}
							</td>
							</tr>
						</table>
						<hr>
						<h2>Payment Instructions</h2>
						<p class="payment-instructions">
						  Please complete your payment before to continue the wonderful
						  trip
						</p>
						<div class="bank">
						  <div class="bank-item pb-3">
						    <img
						      src="{{ asset('frontend/images/ic_bank.png') }}"
						      alt=""
						      class="bank-image"
						    />
						    <div class="description">
						      <h3>PT Nomads ID</h3>
						      <p>
						        0881 8829 8800
						        <br />
						        Bank Central Asia
						      </p>
						    </div>
						    <div class="clearfix"></div>
						  </div>
						  <div class="bank-item pb-3">
						    <img
						      src="{{ asset('frontend/images/ic_bank.png') }}"
						      alt=""
						      class="bank-image"
						    />
						    <div class="description">
						      <h3>PT Nomads ID</h3>
						      <p>
						        0899 8501 7888
						        <br />
						        Bank HSBC
						      </p>
						    </div>
						    <div class="clearfix"></div>
						  </div>
						</div>
					</div>
					<div class="join-container">
						<a href="{{ route('checkout.success', $item->id) }}" class="btn btn-block btn-join-now mt-3 py-2" title="">Join Now</a>
					</div>
					<div class="text-center mt-3">
					  <a href="{{ route('detail', $item->travel_package->slug)}}" class='text-muted'>
					    Cancel Booking
					  </a>
					</div>
				</div>
			</div>
		</div>

	</section>
</main>

@endsection

@push('prepend-style')

<link rel="stylesheet" href="{{ asset('frontend/libraries/gijgo/css/gijgo.min.css') }}">

@endpush
@push('addon-script')

<script type="text/javascript" src="{{ asset('frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
<script>
	$(document).ready(function() {
	

		$('.datepicker').datepicker({
		       format: 'yyyy-mm-dd',
		       uiLibrary: 'bootstrap4',
		       icons: {
		         rightIcon: '<img src="{{ url('frontend/images/ic_doe.png') }}"/>'
		       }
		     });
	});
</script>

@endpush