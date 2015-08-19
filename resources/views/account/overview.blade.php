@extends('account.account')
@section('content')

    <section class="block">
        <header class="block__header">
            <h1>Konto</h1>
            <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
        </header>
        <main class="block__content settings">

            <section class="setting__group">

                <header class="setting__group__header">
                    <h2>
                        Kontoinställningar
                    </h2>
                </header>

                <section class="setting">
                    <header class="setting__header">
                        <h3>
                            Radera konto
                        </h3>
                    </header>
                    <div class="setting__description">
                        <p>Raderar det här kontot, dess portfölj, ordrar och statistik..</p>
                    </div>
                    <div class="setting__actions">
                        <button class="button button--red" id="action__delete-account">
                            Ta bort konto
                        </button>
                    </div>
                </section>

            </section>

        </main>
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
                <table class="orders-table">
                    <thead>
                    <tr>
                        <th>Typ</th>
                        <th>Symbol</th>
                        <th>Pris</th>
                        <th>Volym</th>
                        <th>Tid</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)

                        <tr>
                            <td>{{ $order->side }}</td>
                            <td>{{ $order->instrument->symbol }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->volume }}</td>
                            <td>{{ date('H:i:s', strtotime($order->updated_at)) }}</td>
                            <td>
                                <i class="icon ion-ios-pen"></i>
                                <i class="icon ion-ios-times"></i>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <h3>Avslutade</h3>
            </main>
        </section>

    </div>

@endsection