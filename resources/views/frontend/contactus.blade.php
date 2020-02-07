@extends('layouts_frontend.master_frontend')
@section('title','Item')
@section('content')


<div class="container">

	<!-- Start class='row' Three -->
	<div class="row rounded_div_with_shadow">
		<div class="col-md-12">
			<p><b>Address</b></p>
			<hr class="custom_hr">

			<!-- <p><b>Phone No. : </b>TEST</p>
					<p><b>Email : </b>TEST</p>
					<p><b>Address : </b>Testing address Testing address Testing address Testing address Testing address</p> -->
			{!! $page_data !!}
		</div>
	</div>
	<!-- End class='row' Three -->

	<!-- Start class='row' Two -->
	<div class="row rounded_div_with_shadow">

		
			
			<div class="col-md-12">
				<form method="post" action="/contact_us">
					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				<p><b>Send Us A Message</b></p>
				<hr class="custom_hr">
			</div>

			<div class="col-md-12">
				<span><b>First Name *</b></span>
				<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name"
					value="{{ isset($obj)? $obj->first_name:Request::old('first_name') }}" required>
				<p class="text-danger">{{$errors->first('first_name')}}</p>
			</div>

			<div class="col-md-12">
				<span><b>Last Name</b></span>
				<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name"
					value="{{ isset($obj)? $obj->last_name:Request::old('last_name') }}">
				<p class="text-danger">{{$errors->first('last_name')}}</p>
			</div>

			<div class="col-md-12">
				<span><b>Phone No. *</b></span>
				<input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone No."
					value="{{ isset($obj)? $obj->phone:Request::old('phone') }}" required>
				<p class="text-danger">{{$errors->first('phone')}}</p>
			</div>

			<div class="col-md-12">
				<span><b>Email *</b></span>
				<input type="email" class="form-control" name="email" id="email" placeholder="Enter Email"
					value="{{ isset($obj)? $obj->email:Request::old('email') }}" required>
				<p class="text-danger">{{$errors->first('email')}}</p>
			</div>

			<div class="col-md-12">
				<span><b>Message *</b></span>
				<textarea rows="10" cols="50" class="form-control" name="detail_info" id="detail_info"
					placeholder="Enter Your Message"
					required>{{ isset($obj)? $obj->detail_info:Request::old('detail_info') }}</textarea>
				<p class="text-danger">{{$errors->first('detail_info')}}</p>
			</div>


			<div class="col-md-12">
				<hr class="custom_hr">
			</div>

			<div class="col-md-8">
			</div>
			<div class="col-md-4">
				<button type="submit" class="btn btn-primary btn-md pull-right form-control">Send Message</button>
				</form>
			</div>
		
	</div>
	<!-- End class='row' Two -->

	@include('frontend.alerts.alert')

</div>
<br>

<div class="container-fluid">
	<div class="row">
		<iframe
			src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2779.8275660663912!2d96.12750332582384!3d16.808773095504865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ebe7d3182db7%3A0xe6b9c2be650c5b17!2sDigital%20Tree!5e0!3m2!1sen!2smm!4v1571380541458!5m2!1sen!2smm"
			width="100%" height="700px" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
	</div>
</div>

@stop

<!-- Optional JavaScript -->
@section('page_script')

@stop