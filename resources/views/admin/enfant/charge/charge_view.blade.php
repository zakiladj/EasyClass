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
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Charges</li>
							</ol>
						</nav>

					</div>
				</div>
                    <a href="{{ route('charge.impression') }}" class="btn btn-rounded btn-primary mb-5"> <strong> Imprimer   <span class="glyphicon glyphicon-print"></span>  </strong>  </a> </a> <hr>
                    <a href="{{ route('charge.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Charges <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>
		</div>
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">La Liste Des Charges </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <strong>
							<tr>
								<th>Id</th>
								<th>Titre</th>
								<th>La Categorie</th>
								<th>Le Montant</th>
                                <th>Fournisseur</th>
								<th>Date </th>
                                <th>Note</th>
								<th>Pièce Jointe</th>
                                <th>Information</th>
								<th>Update </th>
							</tr>
						 </thead>
                        <tbody>
                            @foreach ($allData as $charge )
                            <tr>
                                <td>{{ $charge->id }}</td>
                                <td>{{ $charge->nom }}</td>
                                <td>{{ $charge->category->name }}</td>
                                <td>{{ $charge->montant }} DA</td>
                                <td>{{ $charge->fournisseur->nom_commercial }}</td>
                                <td>{{ $charge->date_charge }}</td>
                                <td>{{ $charge->note }}</td>
                                <td>
                                    @if($charge->attachment)
                                        <a href="{{ route('chargeid.impression',$charge->id) }}" style="box-shadow:0 0 5px #000;" class="btn btn-sm btn-success " >
                                          <strong> Voir <span class="glyphicon glyphicon-info-sign"></span></strong>
                                       </a>
                                    @else
                                        Aucun fichier
                                    @endif
                                </td>
                                <td><a href=" {{ route('charge.information',$charge->id) }}" class="btn btn-sm btn-info"> <strong> Information  <span class="glyphicon glyphicon-info-sign"></span></strong></a></td>
                                <td><a href="{{ route('charge.edit',$charge->id) }}" class="btn btn-sm btn-warning"> <strong> Update <span class="glyphicon glyphicon-pencil"></span></strong></a></td>
                            </tr>
                            @endforeach
                        </tbody>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Titre</th>
								<th>La Categorie</th>
								<th>Le Montant</th>
                                <th>Fournisseur</th>
								<th>Date </th>
                                <th>Note</th>
								<th>Pièce Jointe</th>
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
