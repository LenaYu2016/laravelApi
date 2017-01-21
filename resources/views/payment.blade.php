@extends('layouts.app')

@section('content')
    <form action="payment" method="POST">
        {{csrf_field()}}
        <script
                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{config('services.stripe.key')}}"
                data-amount="2500"
                data-name="First"
                data-description="test"
                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                data-locale="auto"
                data-currency="cad"
        data-zip-code="true">
        </script>
    </form>
@endsection
