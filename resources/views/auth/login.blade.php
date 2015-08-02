@extends('app')

@section('content')

<div class="container">
	<div class="row">

		<main class="main-content">

			<section class="block register-form">
				<header class="block__header">
					<h1>Logga in</h1>
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

					<form class="form--full-width" role="form" method="POST" action="{{ url('login') }}">

						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form__group">
							<label class="form__label">E-post</label>
							<input class="form__control" type="email" name="email" value="{{ old('email') }}">
						</div>

						<div class="form__group">
							<label class="form__label">Lösenord</label>
							<input class="form__control" type="password" name="password">
						</div>

						<div class="form__group">
							<input type="checkbox" name="remember"> Kom ihåg mig
						</div>

						<div class="form__group">
							<button type="submit" class="button button--huge button--green">
								Logga in
							</button>
						</div>
					</form>

					{{--<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>--}}

				</main>
			</section>

		</main>

	</div>
</div>

@endsection
