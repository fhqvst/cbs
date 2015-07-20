@extends('app')

@section('content')

<div class="container">
	<div class="row">

		<main class="main-content">

			<section class="block register-form">
				<header class="block__header">
					<h1>Registrera användare</h1>
				</header>
				<main class="block__content">
					@if (count($errors) > 0)
						<div class="notice notice--danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form--full-width" role="form" method="POST" action="{{ url('register') }}">

						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form__group">
							<label class="form__label">Namn</label>
							<input class="form__control" type="text" name="name" value="{{ old('name') }}">
						</div>

						<div class="form__group">
							<label class="form__label">E-post</label>
							<input class="form__control" type="email" name="email" value="{{ old('email') }}">
						</div>

						<div class="form__group">
							<label class="form__label">Lösenord</label>
							<input class="form__control" type="password" name="password">
						</div>

						<div class="form__group">
							<label class="form__label">Bekräfta lösenord</label>
							<input class="form__control" type="password" name="password_confirmation">
						</div>

                        <div class="form__group">
                            <label class="form__label">Välj sektion</label>
                            <select class="form__control" name="section">
                                <option value="IT">IT</option>
                            </select>
                        </div>

						<div class="form__group">
							<button type="submit" class="button button--huge button--green">
								Registrera
							</button>
						</div>
					</form>

				</main>
			</section>

		</main>

	</div>
</div>

@endsection
