<header class="topbar">

    <div class="container">
        <div class="row">

            <div class="topbar__logotype">
                <h1 class="logotype"></h1>
            </div>

            <div class="topbar__navigation">
                <nav>
                    @if(Auth::check())
                        <a href="/dashboard">Dashboard</a>
                        <a href="/market">Marknaden</a>
                        <a href="/news">Nyheter</a>
                        <a href="/account">Profil</a>
                        <a href="/logout">Logga ut</a>
                    @else
                        <a href="/register">Registrera</a>
                        <a href="/login">Logga in</a>
                    @endif
                </nav>
            </div>

        </div>
    </div>

</header>
