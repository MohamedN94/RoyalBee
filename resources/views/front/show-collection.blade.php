@extends('front.layouts.app', [
    'title' => "Bees - {$collection->name_ar}",
    'active' => 'index',
])
@section('content')
    <main class="page-wrapper">
        <section class="section products-list-section section-rb5lKWK85ASuBRVS">
            <div class="container">
                <div class="app-heading">
                    <h3 class="heading-primary"> {{$collection->name_ar}}</h3>
                </div>
                @livewire('collection-products',['slug' => $collection->slug])
            </div>

        </section>
    </main>
@endsection
