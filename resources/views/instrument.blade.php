@extends('app')
@section('content')

    <div class="container">
        <div class="row">

            <nav class="breadcrumbs">
                <div class="breadcrumbs__left">
                    <a href="/"><i class="ion-ios-arrow-back"></i>Tillbaka</a>
                </div>
                <div class="breadcrumbs__right">

                </div>
            </nav>

            <main class="main-content">

                <h1 class="page-title">{{ $instrument->name }}</h1>

                <section class="block">
                    <header class="block__header">
                        <h1>System</h1>
                        <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                    </header>
                    <main class="block__content settings">

                        <section class="setting__group">

                            <header class="setting__group__header">
                                <h2>
                                    Övrigt
                                </h2>
                            </header>

                            <section class="setting">
                                <header class="setting__header">
                                    <h3>
                                        Börsdata
                                    </h3>
                                </header>
                                <div class="setting__description">
                                    <p>Hämtar börsdata för <strong>alla instrument</strong> på nytt. Börsdata.se använder ett annat system för att identifiera instrument.</p>
                                </div>
                                <div class="setting__actions">
                                    <button class="button--green" id="action__get-tradables">
                                        Hämta Börsdata
                                    </button>
                                </div>
                            </section>

                        </section>

                    </main>
                </section>

                <div class="block-wrapper block-wrapper--half">

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

                <div class="block-wrapper block-wrapper--half">

                    <section class="block">
                        <header class="block__header">
                            <h1>Beskrivning</h1>
                            <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                        </header>
                        <main class="block__content">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </main>
                    </section>

                    <section class="block">
                        <header class="block__header">
                            <h1>Orderdjup</h1>
                            <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                        </header>
                        <main class="block__content">

                        </main>
                    </section>

                </div>

            </main>
        </div>
    </div>

@endsection