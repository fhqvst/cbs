@extends('app')
@section('content')

    <div class="container">
        <div class="row">

            <main class="main-content">

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

            </main>

        </div>
    </div>

@endsection