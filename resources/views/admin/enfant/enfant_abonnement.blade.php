@extends('admin.admin_master')
@section('admin_content')


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

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title text-success">La Liste Des Abonnements {{ $enfant->nom }}  {{  $enfant->prenom }}</h3>
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
								<th>Update </th>
							</tr>
						</thead>
    <tbody>
             @if ($abonnementEnfant->isEmpty())
                <div class="alert alert-error text-center">
                   Cet enfant n’a aucun abonnement pour le moment
                </div>

            {{-- إذا يوجد اشتراكات --}}
            @else
            @foreach ($abonnementEnfant as $abonnement )
            @php
                $today   = \Carbon\Carbon::now();
                $end     = \Carbon\Carbon::parse($abonnement->date_fin);
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
        <td>{{ $abonnement->id }}</td>
        <td>{{  $abonnementEnfant->first()->enfant->nom }} {{  $abonnementEnfant->first()->enfant->prenom}} </td>
        <td>{{ $abonnement->abonnement->titre }}</td>
        <td>{{ $abonnement->date_debut }} </td>
        <td>{{ $abonnement->date_fin }}</td>
        <td>{{ $abonnement->remise }} Da</td>
        <td>{{ $abonnement->montant }} DA</td>
        <td>{{ $abonnement->date_paiement }}</td>
        <td>
            <a href="{{ route('abonnement.impression',$abonnement->id) }}" style="box-shadow:0 0 5px #000;"  class="btn btn-sm btn-success">
                <strong> Imp Recu <span class="glyphicon glyphicon-info-sign"></span></strong>
            </a>
        </td>
        <td>
            <a href="{{ route('abonnement.information',$abonnement->id) }}" style="box-shadow:0 0 5px #000;"  class="btn btn-sm btn-info">
                <strong> Information <span class="glyphicon glyphicon-info-sign"></span></strong>
            </a>
        </td>
        <td>
            <a href="{{ route('abonnement.edit',$abonnement->id) }}" style="box-shadow:0 0 5px #000;"  class="btn btn-sm btn-warning">
                <strong> Update <span class="glyphicon glyphicon-pencil"></span></strong>
            </a>
        </td>
    </tr>

@endforeach
@endif
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
								<th>Update </th>

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
