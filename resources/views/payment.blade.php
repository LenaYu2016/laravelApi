@extends('layouts.app')

@section('content')
    <form action="payment" method="POST" id="pay">
        {{csrf_field()}}

        <input type="hidden" name="stripeEmail" id="stripeEmail"/>
        <input type="hidden" name="stripeToken" id="stripeToken"/>
        <input type="submit" value="Pay now" class="btn btn-primary" id="submit"/>
    </form>
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <script>
        var stripe=StripeCheckout.configure(
                {
                    key:"{{config('services.stripe.key')}}",
                    image:"https://stripe.com/img/documentation/checkout/marketplace.png",
                    locale:"auto",
                    token:function(token){
                        document.querySelector('#stripeToken').value=token.id;
                        document.querySelector('#stripeEmail').value=token.email;
                        document.querySelector('#pay').submit();
                    }
                }
        );
        document.querySelector('#submit').addEventListener('click',function(e){
            e.preventDefault();

            stripe.open({
                name:"Website",
                description:"Buy custom website",
                amount:5000,
                zipCode:true
            });

        });

    </script>
@endsection
