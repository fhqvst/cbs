@extends('app')
@section('content')

    <div class="container">
        <div class="row">

            <main class="main-content">

                <!-- <section class="notice notice--success">
                    <section class="notice__content">
                        <p class="notice__description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <button class="button notice__close"><i class="icon ion-ios-close-empty"></i></button>
                    </section>
                </section> -->

                <h1 class="page-title">Marknaden</h1>

                <section class="block">
                    <header class="block__header">
                        <h1>Nasdaq OMX Stockholm Large Cap</h1>
                        <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                    </header>
                    <main class="block__content">
                        <table class="stocks-table">
                            <thead>
                                <tr>
                                    <th>Namn</th>
                                    <th></th>
                                    <th>+/-%</th>
                                    <th>+/-</th>
                                    <th>Köp</th>
                                    <th>Sälj</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($instruments as $instrument)
                                    <tr>
                                        <td>{{ $instrument->symbol }}</td>
                                        <td><a href="/market/instrument/{{ $instrument->id }}">{{ $instrument->name }}</a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="buy-sell-buttons"><button class="button button--small button--green">Köp</button><button class="button button--small button--orange" data-stock="{{ $instrument->symbol }}" data-event="sell">Sälj</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </main>
                </section>

            </main>

        </div>
    </div>

@endsection