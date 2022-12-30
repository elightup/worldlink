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
					<input type="text" id="search" name="search" value="{{ old('search') }}" placeholder="Điền mã đơn hàng để tìm kiếm thông tin" required>
					<a class="button check_ma">Tìm kiếm</a>
				</div>
			</div>
			<div class="form-progress"><img src="{{ url( 'images/Loading_icon.gif' ) }}"></div>
			<p class="result-check"></p>
			<div class="form__content-ajax hidden">
				<h3 class="color-accent">Thông tin chi tiết đơn hàng</h3>
				<input type="hidden" id="account_id" name="account_id">
				<div class="form-row">
					<label for="name">Tên khách hàng: </label>
					<div id="name"></div>
				</div>
				<div class="form-row">
					<label for="order_status">Tình trạng đơn hàng: </label>
					<div id="order_status"></div>
				</div>
				<div class="form-row">
					<label for="shipping_status">Tình trạng giao hàng: </label>
					<div id="shipping_status"></div>
				</div>
				<div class="form-row">
					<label for="order_create">Thời gian tạo: </label>
					<div id="order_create"></div>
				</div>
				<div class="form-row">
					<label for="order_note">Ghi chú: </label>
					<div id="order_note"></div>
				</div>
				<div class="form-row">
					<table role="grid">
						<thead role="rowgroup">
							<tr role="row">
								<th scope="col" class="cell-code k-header">Mã hàng</th>
								<th scope="col" class="cell-auto k-header">Tên hàng</th>
								<th scope="col" class="cell-quantity k-header">Số lượng</th>
								<th scope="col" class="cell-total txtR k-header">Đơn giá</th>
								<th scope="col" class="cell-quantity k-header">Giảm giá</th>
								<th scope="col" class="cell-total txtR k-header">Giá bán</th>
								<th scope="col" class="cell-total txtR k-header th-show">Thành tiền</th>
							</tr>
						</thead>
						<tbody class="order_details">

						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>
@endsection
