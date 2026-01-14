@include('view.layout.header')

<div class="container py-5 text-center">
    <h1>Thank You!</h1>
    <p>Your order #{{ $order->order_number }} has been placed successfully.</p>
    <a href="{{ route('user-dashboard') }}" class="btn btn-primary">View Orders</a>
</div>

@include('view.layout.footer')