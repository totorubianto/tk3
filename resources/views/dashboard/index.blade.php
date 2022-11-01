@extends('layouts.main', ['title' => 'Dashboard', 'page_heading' => 'Dashboard'])

@section('content')
<section class="row">
	<div class="col-12 col-lg-12">
		<div class="row">
			<div class="col-6 col-lg-3 col-md-6">
				<a >
					<div class="card card-stat">
						<div class="card-body px-3 py-4-5">
							<div class="row">
								<div class="col-md-4">
									<div class="stats-icon purple">
										<i class="iconly-boldProfile"></i>
									</div>
								</div>
								<div class="col-md-8">
									<h6 class="text-muted font-semibold">Pembeli</h6>
									<h6 class="font-extrabold {{ $pembeliCount <= 0 ? 'text-danger' : '' }} mb-0">
										{{ $pembeliCount }}
									</h6>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>


		</div>
		@include('dashboard.charts.chart')
		<div class="row">
			<div class="col-12 col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4>Laporan Pembelian</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-striped table-lg">
								<thead>
									<tr>
										<th>Nama Pembeli</th>
										<th>Total Bayar</th>
										<th>Tanggal</th>
										<th>Pencatat</th>
									</tr>
								</thead>
								<tbody>
									@forelse($latestCashTransactions as $latestCashTransaction)
									<tr>
										<td class="col-5">
											<div class="d-flex align-items-center">
												<p class="font-bold ms-3 mb-0">
													{{ $latestCashTransaction->students->name }}
												</p>
											</div>
										</td>
										<td class="col-auto">
											<p class=" mb-0">
												{{ indonesian_currency($latestCashTransaction->amount) }}
											</p>
										</td>
										<td class="col-auto">
											<p class=" mb-0">
												{{ date('d-m-Y', strtotime($latestCashTransaction->date)) }}
											</p>
										</td>
										<td class="col-auto">
											<p class=" mb-0">
												{{ $latestCashTransaction->users->name }}
											</p>
										</td>

									</tr>
									@empty
									<tr>
										<td colspan="5">
											<p class="fw-bold text-danger text-center text-uppercase">Data kosong!</p>
										</td>
									</tr>
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('modal')
@include('dashboard.modal.show')
@endpush

@push('js')
@include('dashboard.script')
@endpush
