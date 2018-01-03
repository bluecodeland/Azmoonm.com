@extends('layouts.app')

@section('title', 'محصور')

@section('content')
<div class="container">
	<div class="error">
		<div class="error-code m-b-10 m-t-20"><i class="fa fa-warning"></i> 601 </div>
		<h3 class="font-bold">مشکلی پیش آمده</h3>

		<div class="error-desc">
			شما مجوز لازم برای انجام این کار را ندارید. <br/>
		</div>
	</div>
</div>
@endsection
