@extends('front.layouts.app', [
    'title' => 'Bees - التصنيفات',
    'active' => 'index',
])
@section('content')
    <main class="page-wrapper">
        <section class="page-section editor-content-section section-3aP0oaBaHQJGe8Ny">
            <div class="container">
                <div class="fr-view">
                    <div class="fr-img-space-wrap">
                        <p><br></p>

                        <h2 style="text-align: center;">
                            <span style="color: rgb(0, 0, 0);">جميع التصنيفات</span>
                        </h2>
                        <table class="mt-4" style="width: 100%; margin-right: calc(0%); border: none;">
                            <tbody>
                            @php
                                $columnsPerRow = 4;
                                $counter = 0;
                            @endphp
                            @foreach($collections as $collection)
                                @if ($counter % $columnsPerRow == 0)
                                    <tr>
                                        @endif
                                        <td style="width: 24.9619%; text-align: justify; vertical-align: top;">
                                            <div class="fr-img-space-wrap">
                                                <div class="fr-img-space-wrap">
                                                    <a href="{{route('web.collections.show',$collection->slug)}}"><img
                                                            src="{{ asset($collection->image) }}"
                                                            data-name="{{ $collection->name_ar }}"
                                                            class="fr-fic fr-dib"
                                                            style="width: 80px; height: 80px;"></a>
                                                </div>
                                            </div>
                                            <div style="text-align: center;">
                                                <span style="font-size: 11px;">{{ $collection->name_ar }}&nbsp;</span>
                                            </div>
                                        </td>
                                        @php
                                            $counter++;
                                        @endphp
                                        @if ($counter % $columnsPerRow == 0)
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>
                        <p><br></p>
                    </div>
                </div>
            </div>

        </section>

    </main>
@endsection
