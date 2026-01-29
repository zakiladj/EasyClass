@extends('admin.admin_master')
@section('admin_content')
@php
  $preset = request('preset'); // ولا استعمل $preset اللي جاية من controller
@endphp

  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Abonnements </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Abonnements</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('abonnement.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Abonnement <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

    <section class="content">
			<div class="row">
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
							<div class="icon bg-primary-light rounded w-60 h-60">
								<i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Nombre Des Empolyes </p>
								<h3 class="text-white mb-0 font-weight-500">{{ $employeesCount }} <small class="text-success"><i class="fa fa-caret-up"></i> +2.5%</small></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
							<div class="icon bg-warning-light rounded w-60 h-60">
								<i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Nombre Des Enfants </p>
								<h3 class="text-white mb-0 font-weight-500">{{ $childrenCount }} <small class="text-success"><i class="fa fa-caret-up"></i> +2.5%</small></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
							<div class="icon bg-info-light rounded w-60 h-60">
								<i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Abonnements en cours </p>
								<h3 class="text-white mb-0 font-weight-500"> {{ $abonEnCours }} <small class="text-danger"><i class="fa fa-caret-down"></i> -0.5%</small></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
							<div class="icon bg-danger-light rounded w-60 h-60">
								<i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Abonnements expirés</p>
								<h3 class="text-white mb-0 font-weight-500">{{ $abonExpirees }} <small class="text-danger"><i class="fa fa-caret-up"></i> -1.5%</small></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
							<div class="icon bg-success-light rounded w-60 h-60">
								{{-- <i class="text-success mr-0 font-size-24 mdi mdi-phone-outgoing"></i> --}}
                                {{-- <i class="text-white mr-0 font-size-24 mdi mdi-chart-line" style="color:#00E396;"></i> --}}
                                {{-- <i class="text-white mr-0 font-size-24 mdi mdi-arrow-up" style="color:#ffffff !important;"></i> --}}
                                <i class="mr-0 font-size-24 mdi mdi-arrow-up-bold" style="color:#ffffff !important;"></i>

							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Revenu du mois</p>
								<h3 class="text-white mb-0 font-weight-500">{{ number_format($revenuTotal, 0, ',', ' ') }} DZD</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
							<div class="icon bg-danger-light rounded w-60 h-60">
								{{-- <i class="text-white mr-0 font-size-24 mdi mdi-chart-line" style="color:#00E396;"></i> --}}
                                <i class="mr-0 font-size-24 mdi mdi-arrow-down-bold" style="color:#ffffff !important;"></i>


							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Charges du mois</p>
								<h3 class="text-white mb-0 font-weight-500">{{ number_format($chargesTotal, 0, ',', ' ') }} DZD</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
        {{-- Analytics: مجموع مدفوعات الموظفين يوميًا --}}
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">تحليل: مجموع مدفوعات الموظفين يوميًا</h4>
          <p class="mb-0">من {{ $from }} إلى {{ $to }}</p>
        </div>

        <div class="box-body">

          {{-- أزرار سريعة --}}
        <div class="mb-15 d-flex align-items-center">
                <a href="{{ route('employe.chart.js', ['preset' => 'today']) }}" class="btn btn-warning">اليوم</a>
                <a href="{{ route('employe.chart.js', ['preset' => 'week']) }}" class="btn btn-primary ml-5">هذا الأسبوع</a>
                <a href="{{ route('employe.chart.js', ['preset' => 'month']) }}" class="btn btn-info ml-5">هذا الشهر</a>
                <a href="{{ route('employe.chart.js', ['preset' => 'year']) }}" class="btn btn-success ml-5">هذه السنة</a>

                {{-- يدز زر الطباعة لليمين --}}
                <a href="{{ route('employe.chart.print', request()->query()) }}"
                    class="btn btn-link ml-auto"
                    title="طباعة">
                    <i class="mdi mdi-printer"></i>طباعة
                </a>
        </div>

          {{-- اختيار بين تاريخين --}}
          <form method="GET" id="rangeForm" action="{{ route('employe.chart.js') }}"  class="row g-2 mb-20 no-validate">

            <input type="hidden" name="preset" value="">
            <div class="col-md-3">
              <label class="form-label">من</label>
              <input type="date" name="from" value="{{ request('from', $from) }}" class="form-control">
            </div>
            <div class="col-md-3">
              <label class="form-label">إلى</label>
              <input type="date" name="to" value="{{ request('to', $to) }}" class="form-control">
            </div>
            <div class="col-md-2 d-flex align-items-end">
              <button type="submit" class="btn btn-dark w-100">عرض</button>
            </div>
          </form>

          {{-- مكان الشارت --}}
          <div id="empDailyChart" style="min-height: 320px;"></div>

        </div>
      </div>
    </div>
  </div>
</section>
 </div>
</div>
@push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
          const preset = @json($preset);
          const chartType = (preset === 'today') ? 'bar' : 'line';

    // ✅ (A) حل popup: نحبسو submit تاع القالب ونديرو redirect يدوي
    const form = document.getElementById('rangeForm');
    if (form) {
        form.addEventListener('submit', function (e) {
        e.preventDefault();          // ✅ مهم جدا
        e.stopImmediatePropagation(); // ✅ يقطع على scripts تاع vendors

        const url = new URL(form.action, window.location.origin);
        const fd = new FormData(form);
        for (const [k, v] of fd.entries()) url.searchParams.set(k, v);

        window.location.href = url.toString();
        }, true);
    }
    // ✅ (B) الشارت
    if (typeof ApexCharts === "undefined") {
        console.log("ApexCharts ما تحمّلاتش - تأكد من مسار apexcharts.js");
        return;
    }
    const el = document.querySelector("#empDailyChart");
    if (!el) return;

    const labels = @json($labels);
    const values = @json($values);

    new ApexCharts(el, {
        chart: { type: chartType, height: 320 },
        series: [{ name: 'المجموع', data: values }],
        dataLabels: {
                    enabled: true,
                    formatter: (val) => val + ' DA',
                    // style: { colors: ['#00c853'] },
                    offsetY: -8
                },
            xaxis: {
                categories: labels,
                  title: {
                            text: 'التواريخ',
                            style: { color: '#ffffff', fontSize: '14px' }
                        },
                labels: {

                    style: {
                    colors: '#ffffff',   // لون التواريخ
                    fontSize: '12px'
                    }
                }
         },
             yaxis: {
                  title: {
                            text: 'المبلغ (DZD)',
                            style: { color: '#ffffff', fontSize: '14px' }
                        },
                labels: {

                    style: {
                    colors: '#ffffff',   // لون أرقام المحور Y
                    fontSize: '12px'
                    },
                    formatter: function (val) {
                    return val + ' DZD';
                    }
                }
      },
                stroke: { curve: 'smooth' },
                title: { text: 'مجموع مدفوعات الموظفين ', align: 'left', style: { color: '#ffffff' } },
                markers: { size: 4, colors: ['#FFA41B'], strokeColors: '#fff', strokeWidth: 2, hover: { size: 7 } },
                grid: { borderColor: '#f1f1f1' },

                colors: ['#77B6EA', '#545454']
            }).render();
        });

    </script>
@endpush
@endsection
