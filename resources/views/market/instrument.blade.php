{{--@extends('app')--}}
@section('content')

    <div class="container">
        <div class="row">

            <nav class="breadcrumbs">
                <div class="breadcrumbs__left">
                    <a href="/market"><i class="ion-ios-arrow-back"></i>Tillbaka</a>
                </div>
                <div class="breadcrumbs__right">

                </div>
            </nav>

            <main class="main-content">

                <h1 class="page-title">{{ $instrument->name }}</h1>

                <div class="row">

                    <div class="block-wrapper block-wrapper--two-thirds">

                        <section class="block">
                            <figure class="block__content block__content--no-padding">
                                <div class="instrument__chart">
                                    <div class="instrument__chart__inner"></div>
                                </div>
                            </figure>
                            <header class="block__header">
                                <h1>Aktiedata</h1>
                            </header>
                            <main class="block__content">
                                <?php /*
                            <table class="instrument__meta__table">
                                <tbody>
                                <tr><td>Symbol</td>
                                    <td>{{ $instrument->symbol }}</td></tr>
                                <tr><td>Namn</td>
                                    <td>{{ $instrument->label }}</td></tr>
                                <tr><td>Sektor</td>
                                    <td>{{ $instrument->sector }}</td></tr>
                                <tr><td>ISIN</td>
                                    <td>{{ $instrument->isin_code }}</td></tr>
                                <tr><td>Omsättning</td>
                                    <td>{{ $instrument_meta["revenue"] }}<span class="unit">SEK</span></td></tr>
                                <tr><td>Vinst</td>
                                    <td>{{ $instrument_meta["income"] }}<span class="unit">SEK</span></td></tr>
                                <tr><td>Utdelning</td>
                                    <td>{{ $instrument_meta["dividend"] }}<span class="unit">SEK</span></td></tr>
                                <tr><td>Eget kapital</td>
                                    <td>{{ $instrument_meta["equity"] }}<span class="unit">SEK</span></td></tr>
                                <tr><td>EBIT</td>
                                    <td>{{ $instrument_meta["ebitda"] }}<span class="unit">SEK</span></td></tr>
                                <tr><td>EBIT-marginal</td>
                                    <td>{{ $instrument_meta["ebit_margin"] }}<span class="unit">%</span></td></tr>
                                <tr><td>EBITDA</td>
                                    <td>{{ $instrument_meta["ebit"] }}<span class="unit">SEK</span></td></tr>
                                <tr><td>EBITDA-marginal</td>
                                    <td>{{ $instrument_meta["ebitda_margin"] }}<span class="unit">%</span></td></tr>
                                </tbody>
                                </table>
                                <table class="instrument__meta__table">
                                    <tbody>
                                    <tr><td>Antal aktier</td>
                                        <td>{{ $instrument_meta["shares"] * 1000000 }}</td></tr>
                                    <tr><td>Return on equity</td>
                                        <td>{{ $instrument_meta["return_on_equity"] }}</td></tr>
                                    <tr><td>Return on assets</td>
                                        <td>{{ $instrument_meta["return_on_assets"] }}</td></tr>
                                    <tr><td>Return on capital</td>
                                        <td>{{ $instrument_meta["return_on_capital"] }}</td></tr>
                                    <tr><td>Bruttomarginal</td>
                                        <td>{{ $instrument_meta["gross_margin"] }}<span class="unit">%</span></td></tr>
                                    <tr><td>Andel immateriella tillgångar</td>
                                        <td>{{ $instrument_meta["intangible_assets_percent"] }}<span class="unit">%</span></td></tr>
                                    <tr><td>Nettoskuld</td>
                                        <td>{{ $instrument_meta["net_debt"] }}<span class="unit">SEK</span></td></tr>
                                    <tr><td>Skuldsättningsgrad</td>
                                        <td>{{ $instrument_meta["net_debt_percent"] }}<span class="unit">%</span></td></tr>
                                    <tr><td>Fritt kassaflöde</td>
                                        <td>{{ $instrument_meta["free_cash_flow"] }}<span class="unit">SEK</span></td></tr>
                                    <tr><td>Operativt kassaflöde</td>
                                        <td>{{ $instrument_meta["operating_cash_flow"] }}<span class="unit">SEK</span></td></tr>
                                    <tr><td>Likviditet</td>
                                        <td>{{ $instrument_meta["cash_percent"] }}<span class="unit">%</span></td></tr>
                                    <tr><td>Soliditet</td>
                                        <td>{{ $instrument_meta["solidity"] }}<span class="unit">%</span></td></tr>
                                    </tbody>
                                </table>
                                */ ?>
                            </main>
                        </section>

                    </div>

                    <div class="block-wrapper block-wrapper--third">

                        <section class="block">
                            <header class="block__header">
                                <h1>Orderdjup</h1>
                                <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                            </header>
                            <main class="block__content">
                                <div id="orderbook"></div>
                            </main>
                        </section>

                        <section class="block">
                            <header class="block__header">
                                <h1>Handla</h1>
                                <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                            </header>
                            <main class="block__content">
                                <form id="order-form" class="form--full-width order__form" role="form" method="POST" action="{{ url('market/instrument/order') }}">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="instrument" value="{{ $instrument->id }}">

                                    <div class="form__group form__group--half">
                                        <label class="form__label">Pris</label>
                                        <input class="form__control" type="text" name="price" value="{{ old('price') }}">
                                    </div>
                                    <div class="form__group form__group--half">
                                        <label class="form__label">Volym</label>
                                        <input class="form__control" type="number" name="volume" value="{{ old('volume') }}">
                                    </div>

                                    <div class="form__group">
                                        <label class="form__label">Ordertyp</label>
                                        <div class="form__select">
                                            <select class="form__control" name="type">
                                                <option value="NORMAL">Normal</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form__group order__form__buy-sell">
                                        <button type="submit" name="side" value="1" class="button button--large button--green">
                                            Köp
                                        </button>
                                        <button type="submit" name="side" value="0" class="button button--large button--red">
                                            Sälj
                                        </button>
                                    </div>
                                </form>
                            </main>
                        </section>

                    </div>

                </div>

                <div class="row">

                    <div class="block-wrapper">
                        <section class="block">
                            <header class="block__header">
                                <h1>Mina ordrar</h1>
                                <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                            </header>
                            <main class="block__content">

                            </main>
                        </section>
                    </div>
                </div>

            </main>
        </div>
    </div>

@endsection