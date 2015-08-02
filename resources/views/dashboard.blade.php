@extends('app')
@section('content')

    <div class="container">
        <div class="row">

            <main class="main-content">

                <section class="notice notice--warning">
                    <section class="notice__content">
                        <p class="notice__description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <button class="button notice__close"><i class="icon ion-ios-close-empty"></i></button>
                    </section>
                </section>

                <section class="block">
                    <header class="block__header">
                        <h1>System</h1>
                        <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                    </header>
                    <main class="block__content settings">

                        <section class="setting__group">

                            <header class="setting__group__header">
                                <h2>
                                    Instrument
                                </h2>
                            </header>

                            <section class="setting">
                                <header class="setting__header">
                                    <h3>
                                        Synkronisering
                                    </h3>
                                </header>
                                <div class="setting__description">
                                    <p>Laddar in marknader, listor och alla aktier på OMX Stockholm Large Cap.</p>
                                </div>
                                <div class="setting__actions">
                                    <button class="button button--green" id="action__synchronize">
                                        Synkronisera
                                    </button>
                                </div>
                            </section>

                        </section>

                    </main>
                </section>

                <div class="block-wrapper">

                    <section class="block block--half">
                        <header class="block__header">
                            <h1>Portfölj</h1>
                            <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                        </header>
                        <main class="block__content">
                            <section class="portfolio-meta">
                                <dl>
                                    <dt>Eget kapital</dt>
                                    <dd>{{ number_format(round($portfolio->balance, 2), 2, '.', ' ') }} <span class="unit">SEK</span></dd>
                                </dl>
                                <dl>
                                    <dt>Avkastning</dt>
                                    <dd>{{ number_format(round($portfolio->total_value - $portfolio->balance, 2), 2, '.', ' ') }} <span class="unit">SEK</span></dd>
                                </dl>
                                <dl>
                                    <dt>Totalt värde</dt>
                                    <dd>{{ number_format(round($portfolio->total_value, 2), 2, '.', ' ') }} <span class="unit">SEK</span></dd>
                                </dl>
                            </section>
                        </main>
                    </section>

                    <section class="block block--half">
                        <header class="block__header">
                            <h1>Ordrar</h1>
                            <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                        </header>
                        <main class="block__content">
                            <h3>Aktiva</h3>
                            <h3>Avslutade</h3>
                        </main>
                    </section>

                </div>

                <section class="block">
                    <header class="block__header">
                        <h1>Marknaden</h1>
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
                                        <td><a href="/instrument/{{ $instrument->id }}">{{ $instrument->name }}</a></td>
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