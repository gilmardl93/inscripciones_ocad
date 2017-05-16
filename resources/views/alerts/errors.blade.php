@if (count($errors) > 0)
	<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
		Datos incorrectos<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif