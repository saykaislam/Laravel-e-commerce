@extends('layout')
@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="register-req">
				<p>Please fillup this form</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Shipping Details</p>
							<div class="form-one">
								<form action="{{url('/save_shipping_details')}}" method="post">
									{{csrf_field()}}
								<input type="text" name="shipping_email"  placeholder="Email*" required="">
								<input type="text" name="shipping_first_name"  placeholder="First Name *" required="">
								<input type="text"  name="shipping_last_name" placeholder="Last Name *" required="">
								<input type="text" name="shipping_address"  placeholder="Address *">
								<input type="text" name="shipping_phone_number"  placeholder="Phone Number *" required="">
                                <input type="text" name="shipping_city"  placeholder="city *" required=""> 
                                <input type="submit" class="btn btn-default" value="Done" required="">
								</form>
							</div>
						</div>
					</div>			
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->



@endsection