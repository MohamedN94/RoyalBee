@extends('dashboard.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">{{ __('dashboard.order_details') }}</h1>

            <!-- User Information Section -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h2>{{ __('dashboard.user_information') }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>{{ __('dashboard.first_name') }}:</strong> {{ $product->paymentAddress->first_name }}</p>
                            <p><strong>{{ __('dashboard.last_name') }}:</strong> {{ $product->paymentAddress->last_name }}</p>
                            <p><strong>{{ __('dashboard.email') }}:</strong> {{ $product->paymentAddress->email }}</p>
                            <p><strong>{{ __('dashboard.phone') }}:</strong> {{ $product->paymentAddress->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{ __('dashboard.street_address') }}:</strong> {{ $product->paymentAddress->street_address }}</p>
                            <p><strong>{{ __('dashboard.region') }}:</strong> {{ $product->paymentAddress->region }}</p>
                            <p><strong>{{ __('dashboard.country') }}:</strong> {{ $product->paymentAddress->country }}</p>
                            <p><strong>{{ __('dashboard.emirate') }}:</strong> {{ $product->paymentAddress->emirate }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Information Section -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h2>{{ __('dashboard.order', ['id' => $product->id]) }}</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>{{ __('dashboard.order_date') }}:</strong> {{ $product->created_at->format('d-m-Y') }}</p>
                            <p><strong>{{ __('dashboard.total_amount') }}:</strong> {{ $product->amount }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{ __('dashboard.payment_method') }}:</strong> 
                                <span class="{{ $product->payment_method == 1 ? 'warning' : '' }}">
                                    {{ $product->payment_method == 1 ? __('dashboard.cash_on_delivery') : __('dashboard.online_payment') }}
                                </span>
                            </p>
                            <p><strong>{{ __('dashboard.status') }}:</strong> 
                                <span class="{{ $product->status == 0 ? 'text-danger' : 'text-success' }}">
                                    {{ $product->status == 0 ? __('dashboard.pending') : __('dashboard.completed') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h2>{{ __('dashboard.products') }}</h2>
                </div>
                <div class="card-body">
                    @if($product->products->isNotEmpty())
                        <div class="row">
                            @foreach($product->products as $item)
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <img src="{{ asset($item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->name_ar }}</h5>
                                            <p class="card-text"><strong>{{ __('dashboard.quantity') }}:</strong> {{ $item->pivot->quantity }}</p>
                                            <p class="card-text"><strong>{{ __('dashboard.price') }}:</strong>  {{ $item->pivot->amount }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>{{ __('dashboard.no_products_found') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>

    .card-header {
        font-size: 1.25rem;
        font-weight: bold;
    }
    .card-body p {
        margin-bottom: 0.5rem;
    }
    .card-body img {
        max-height: 200px;
        object-fit: contain;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .card-body {
        padding: 20px;
    }
    .card-body h5 {
        font-size: 1.1rem;
        font-weight: bold;
    }
    .card-body .card-text {
        font-size: 0.9rem;
    }
    .warning {
        color: #111196 !important;
    }
    .text-danger {
        color: #dc3545 !important;
    }
    .text-success {
        color: #28a745 !important;
    }
</style>