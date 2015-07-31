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

                <section class="block">
                    <header class="block__header">
                        <h1>{{ $instrument->label }}</h1>
                        <button class="block__toggle "><i class="icon ion-ios-minus-empty"></i></button>
                    </header>
                    <main class="block__content">

                        <div id="react__content"></div>

                    </main>
                </section>

            </main>
        </div>
    </div>

@endsection