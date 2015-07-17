@extends('app')
@section('content')

    <div class="container">
        <div class="row">

            <main class="main-content">

                <section class="block">
                    <header class="block__header">
                        <h1>Portfölj</h1>
                    </header>
                    <main class="block__content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis pellentesque eleifend. Sed porttitor enim non iaculis fringilla. Sed venenatis congue placerat. Curabitur vehicula aliquam felis et tincidunt. Donec urna nisi, tempor eget est eget, tristique ullamcorper lacus. Maecenas aliquam felis ac fermentum convallis. Aliquam pretium, nisi sed semper tincidunt, orci ante dapibus dolor, ac luctus justo neque eget sem.</p>
                    </main>
                </section>

                <section class="block">
                    <header class="block__header">
                        <h1>Marknaden</h1>
                    </header>
                    <main class="block__content">
                        <table class="table__stocks">
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
                                @foreach($stocks as $stock)
                                    <tr>
                                        <td>{{ $stock->symbol }}</td>
                                        <td>{{ $stock->name }}</td>
                                        <td>{{ $stock->change }}</td>
                                        <td>{{ $stock->change_percent }}</td>
                                        <td>{{ $stock->buy }}</td>
                                        <td>{{ $stock->sell }}</td>
                                        <td class="buy-sell-buttons"><button class="button button--small button--green">Köp</button><button class="button button--small button--orange" data-stock="{{ $stock->symbol }}" data-event="sell">Sälj</button></td>
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