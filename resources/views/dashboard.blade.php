@extends('app')
@section('content')

    <div class="container">
        <div class="row">

            <main class="main-content">

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
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis pellentesque eleifend. Sed porttitor enim non iaculis fringilla dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                                <div class="setting__actions">
                                    <button>
                                        Synkronisera
                                    </button>
                                </div>
                            </section>
                            <section class="setting">
                                <header class="setting__header">
                                    <h3>
                                        Instrumentcache
                                    </h3>
                                </header>
                                <div class="setting__description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis pellentesque eleifend. Sed porttitor enim non iaculis fringilla dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                                <div class="setting__actions">
                                    <button>
                                        Rensa cache
                                    </button>
                                </div>
                            </section>
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
                                    <button class="button--red">
                                        Stoppa handel
                                    </button>
                                </div>
                            </section>

                        </section>

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
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis pellentesque eleifend. Sed porttitor enim non iaculis fringilla dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                                <div class="setting__actions">
                                    <button>
                                        Synkronisera
                                    </button>
                                </div>
                            </section>
                            <section class="setting">
                                <header class="setting__header">
                                    <h3>
                                        Instrumentcache
                                    </h3>
                                </header>
                                <div class="setting__description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis pellentesque eleifend. Sed porttitor enim non iaculis fringilla dolor sit amet, consectetur adipiscing elit.</p>
                                </div>
                                <div class="setting__actions">
                                    <button>
                                        Rensa cache
                                    </button>
                                </div>
                            </section>
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
                                    <button class="button--red">
                                        Stoppa handel
                                    </button>
                                </div>
                            </section>

                        </section>

                    </main>
                </section>

                <section class="block">
                    <header class="block__header">
                        <h1>Portfölj</h1>
                        <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                    </header>
                    <main class="block__content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis pellentesque eleifend. Sed porttitor enim non iaculis fringilla. Sed venenatis congue placerat. Curabitur vehicula aliquam felis et tincidunt. Donec urna nisi, tempor eget est eget, tristique ullamcorper lacus. Maecenas aliquam felis ac fermentum convallis. Aliquam pretium, nisi sed semper tincidunt, orci ante dapibus dolor, ac luctus justo neque eget sem.</p>
                    </main>
                </section>

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
                                        <td>{{ $instrument->label }}</td>
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