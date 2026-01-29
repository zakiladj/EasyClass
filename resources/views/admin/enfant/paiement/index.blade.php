
@php
    $months = [
            1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
            9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
        ];

        $monthName = $months[(int)$month] ?? $month;
@endphp
@extends('admin.admin_master')
@section('admin_content')
  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Paiements </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Paiements</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('fournisseur.impression') }}" class="btn btn-rounded btn-primary mb-5"> <strong> Imprimer   <span class="glyphicon glyphicon-print"></span>  </strong>  </a> </a> <hr>

                    <a href="{{ route('fournisseur.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Fournisseur <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>

			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"> La Liste des Paiements pour <span class="text-success">{{ $monthName }}  / {{ $year }}</span> </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <strong>
							<tr>
								<th>Id</th>
								<th>Nom Complet </th>
								<th>Poste </th>
								<th>Salaire </th>
                                <th>Total Payé</th>
                                <th>Avances</th>
                                <th>Primes</th>
                                <th>Déductions</th>
								<th>Solde Restant  </th>
                                <th>Etat</th>
								<th> Action</th>
                                <th>Information</th>
								<th>Update </th>
							</tr>
						</thead>
                        <tbody>
                            @foreach ($controls as $controls )
                            <tr>
                                <td>{{ $controls->id }}</td>
                                <td>{{ $controls->employes->nom }} {{ $controls->employes->prenom }}</td>
                                <td>{{ $controls->employes->poste }} </td>
                                <td>{{ $controls->employes->salaire }}</td>
                                <td>{{ $controls->paid_total }}</td>
                                <td>{{ $controls->advance_total }}</td>
                                <td>{{ $controls->bonus_total }}</td>
                                <td>{{ $controls->deductions_total }}</td>
                                <td>{{ $controls->rest }}</td>

                                @if($controls->etat == 1)
                                    <td><span class="badge badge-pill badge-success">Active</span></td>
                                @else
                                    <td><span class="badge badge-pill badge-danger">Inactive</span></td>
                                @endif

                                 <td> <a href=" {{ route('paiement.action',$controls->id) }}" class="btn btn-sm btn-link"> <strong>  Action <span class="glyphicon glyphicon-cog"></span> </strong> </a>  </td>
                                 <td> <a href=" {{ route('paiement.information',$controls->id) }}" class="btn btn-sm btn-info"> <strong>  Information  <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>
                                 <td> <a href="{{ route('paiement.print.id',$controls->id) }}" class="btn btn-sm btn-primary"> <strong> Imprimer   <span class="glyphicon glyphicon-print"></span>  </strong></a> </td>
                            </tr>
                            @endforeach
                        </tbody>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Nom Complet </th>
								<th>Poste </th>
								<th>Salaire </th>
                                <th>Total Payé</th>
                                <th>Avances</th>
                                <th>Primes</th>
                                <th>Déductions</th>
								<th>Solde Restant  </th>
                                <th>Etat</th>
								<th>Action </th>
                                <th>Information</th>
								<th>Update </th>
							</tr>
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
