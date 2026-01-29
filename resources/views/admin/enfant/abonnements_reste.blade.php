@extends('admin.admin_master')
@section('admin_content')

  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Abonnements Avec le  Reste</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Abonnements Avec Le Reste</li>
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
								<p class="text-mute mt-20 mb-0 font-size-16">Nombre Des Abonnements </p>
								<h3 class="text-white mb-0 font-weight-500"> {{ $abonActiveCount }} <small class="text-danger"><i class="fa fa-caret-down"></i> -0.5%</small></h3>
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
								<p class="text-mute mt-20 mb-0 font-size-16">Inbound Call</p>
								<h3 class="text-white mb-0 font-weight-500">1,460 <small class="text-danger"><i class="fa fa-caret-up"></i> -1.5%</small></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
							<div class="icon bg-success-light rounded w-60 h-60">
								<i class="text-success mr-0 font-size-24 mdi mdi-phone-outgoing"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Outbound Call</p>
								<h3 class="text-white mb-0 font-weight-500">1,700 <small class="text-success"><i class="fa fa-caret-up"></i> +0.5%</small></h3>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-6">
					<div class="box overflow-hidden pull-up">
						<div class="box-body">
							<div class="icon bg-light rounded w-60 h-60">
								<i class="text-white mr-0 font-size-24 mdi mdi-chart-line"></i>
							</div>
							<div>
								<p class="text-mute mt-20 mb-0 font-size-16">Total Revune</p>
								<h3 class="text-white mb-0 font-weight-500">$4,500k <small class="text-success"><i class="fa fa-caret-up"></i> +2.5%</small></h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">La Liste Des Abonnements </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <strong>
							<tr>
								<th>Id</th>
								<th>Enfant</th>
								<th>Type Abonnement </th>
								<th>Date Debut</th>
								<th>Date Fin </th>
								<th>Remise</th>
								<th>Total</th>
								<th>Date Paiement</th>
								<th>Recu Paiement</th>
                                <th>Information</th>
								<th>Statue </th>
							</tr>
						</thead>
                    <tbody>
                        @foreach ($abonnements as $abonnements )
                        @php
                            $today   = \Carbon\Carbon::now();
                            $end     = \Carbon\Carbon::parse($abonnements->date_fin);
                            $daysLeft = $today->diffInDays($end, false); // ممكن تكون بالسالب إذا الاشتراك منتهي
                        @endphp

                            <tr class="
                                @if($daysLeft < 0)
                                    alert alert-error
                                @elseif($daysLeft <= 5)
                                    alert alert-warning
                                @else
                                    alert alert-success
                                @endif
                            ">
                                <td>{{ $abonnements->id }}</td>
                                <td>{{ $abonnements->enfant->nom }} {{ $abonnements->enfant->prenom }} </td>
                                <td>{{ $abonnements->abonnement->titre  }}</td>
                                <td>{{ $abonnements->date_debut }} </td>
                                <td>{{ $abonnements->date_fin }}</td>
                                <td>{{ $abonnements->remise }} Da</td>
                                <td>{{ $abonnements->montant }} DA</td>
                                <td>{{ $abonnements->date_paiement }}</td>
                                <td>
                                    <a href="{{ route('rest.impression',$abonnements->id) }}" style="box-shadow:0 0 5px #000;" class="btn btn-sm btn-success " >
                                        <strong> Imp Recu <span class="glyphicon glyphicon-info-sign"></span></strong>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('abonnement.information',$abonnements->id) }}" style="box-shadow:0 0 5px #000;" class="btn btn-sm btn-info">
                                        <strong> Information <span class="glyphicon glyphicon-info-sign"></span></strong>
                                    </a>
                                </td>
                                <td>
                                    @if ($abonnements->date_fin < \Carbon\Carbon::now()->toDateString())
                                        <a href="{{ route('abmenfant.renew',$abonnements->id) }}" style="box-shadow:0 0 5px #000;" class="btn btn-sm btn-default">
                                            <strong> Mis à jour <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></strong>
                                        </a>
                                    @else
                                        <span class="btn btn-sm btn-primary" style="box-shadow:0 0 5px #000;">
                                            <strong> Actif <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></strong>
                                        </span>

                                    @endif

                                </td>
                            </tr>

                        @endforeach
                        </tbody>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Enfant</th>
								<th>Type Abonnement </th>
								<th>Date Debut</th>
								<th>Date Fin </th>
								<th>Remise</th>
								<th>Total</th>
								<th>Date Paiement</th>
								<th>Recu Paiement</th>
                                <th>Information</th>
								<th>Statue </th>

							</tr>
						</tfoot>
					  </table>
                      </strong>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			  <!-- /.box -->
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>
  </div>




@endsection
