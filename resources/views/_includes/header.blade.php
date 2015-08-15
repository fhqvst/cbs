<div class="colors">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>

<header class="topbar">

    <div class="container">
        <div class="row">

            <div class="topbar__logotype">
                <h1 class="logotype">CBSx</h1>
            </div>

            <div class="topbar__navigation">
                <nav>
                    @if(Auth::check())
                        <a href="/">Hem</a>
                        <a href="/market">Marknaden</a>
                        <a href="/account">Konto</a>
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
<div class="subnav">

</div>
