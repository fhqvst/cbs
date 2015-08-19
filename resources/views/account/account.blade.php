@include('_includes.header')

    <div class="container">
        <div class="row">

            <aside class="sidebar">

               @include('account.sidebar')

            </aside>

            <main class="main-content">

                @yield('content')

            </main>

        </div>
    </div>

@include('_includes.footer')
