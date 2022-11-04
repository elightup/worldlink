@extends('layouts.app')

@section('main')
	<p> Bạn hãy nhập mã đơn hàng để tra cứu thông tin chi tiết của đơn hàng </i>
	</p>
	<div id="ma_vach" class="">
		<form method="POST" action="{{ url( 'form' ) }}" class="form-information" data-url="{{ url( 'ajax' ) }}">
			@csrf
			@if (Session::has('success'))
				<div class="alert alert--success">
					{{ Session::get('success') }}
				</div>
			@endif

			@if ($errors->any())
				<div class="alert alert--danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="form__check-code">
				<label for="search">Tìm kiếm thông tin</label>
				<div style="display: flex">
					<input type="text" id="search" name="search" value="{{ old('search') }}" placeholder="Điền tên, số điện thoại hoặc email để tìm kiếm thông tin" required>
					<a class="button check_ma">Tìm kiếm</a>
				</div>
			</div>
			<div class="form-progress"><img src="{{ url( 'images/Loading_icon.gif' ) }}"></div>
			<p class="result-check"></p>
			<div class="form__content-ajax">
				<h3 class="color-accent">Thông tin chi tiết đơn hàng</h3>
				<input type="hidden" id="account_id" name="account_id">
				<div class="form-row">
					<label for="name">Tên công ty</label>
					<input type="text" id="name" name="name" value="{{ old('name') }}">
				</div>
				<div class="form-row">
					<label for="ma_so_thue">Mã số thuế</label>
					<input type="text" id="ma_so_thue" name="ma_so_thue" value="{{ old('ma_so_thue') }}">
				</div>
				<div class="form-row">
					<label for="email">Email</label>
					<input type="email" id="email" name="email" value="{{ old('email') }}" required>
				</div>
				<div class="form-row">
					<label for="phone">Số điện thoại</label>
					<input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
				</div>
			</div>
		</form>
	</div>
@endsection
