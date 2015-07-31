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

                <h1>{{ $instrument->label }}</h1>

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
                                        Handel & transaktioner
                                    </h3>
                                </header>
                                <div class="setting__description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis pellentesque eleifend. Sed porttitor enim non iaculis fringilla dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                                <div class="setting__actions">
                                    <button class="button--green" id="action__get-tradables">
                                        Hämta tradables
                                    </button>
                                </div>
                            </section>

                        </section>

                    </main>
                </section>

                <section class="block block--half">
                    <figure class="block__content block__content--no-padding">
                        <div class="instrument__chart">
                            <div class="instrument__chart__inner"></div>
                        </div>
                    </figure>
                    <header class="block__header">
                        <h1>Aktiedata</h1>
                    </header>
                    <main class="block__content">
                        <dl class="instrument__meta__table">
                            <dt>Symbol</dt>
                            <dd>{{ $instrument->symbol }}</dd>
                            <dt>Namn</dt>
                            <dd>{{ $instrument->label }}</dd>
                        </dl>
                        <dl class="instrument__meta__table">
                            <dt>Sektor</dt>
                            <dd>{{ $instrument->sector }}</dd>
                            <dt>ISIN</dt>
                            <dd>{{ $instrument->isin_code }}</dd>
                        </dl>
                    </main>
                </section>

                <section class="block block--half">
                    <header class="block__header">
                        <h1>Orderdjup</h1>
                        <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                    </header>
                    <main class="block__content">

                    </main>
                </section>

            </main>
        </div>
    </div>

@endsection