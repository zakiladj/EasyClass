@extends('admin.admin_master')
@section('admin_content')


  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Enfants </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Enfants</li>
							</ol>
						</nav>

					</div>
				</div>
                    <a href="{{ route('enfant.impression') }}" class="btn btn-rounded btn-primary mb-5"> <strong> Imprimer   <span class="glyphicon glyphicon-print"></span>  </strong>  </a> </a> <hr>

                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('enfant.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Enfant <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">La Liste Des Enfants </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <strong>
							<tr>
								<th>Id</th>
								<th>Nom & Prenom</th>
								<th>Date Naissance </th>
								<th>Adresse</th>
								<th>Allergies</th>
								<th>Infos Medicales</th>
								<th>Date Inscription</th>
                                <th>Information</th>
								<th>Update </th>

							</tr>
						</thead>
                        <tbody>
                            @foreach ($allData as $enfant )

                            <tr>
                                <td>{{ $enfant->id }}</td>
                                <td>{{ $enfant->nom }} {{ $enfant->prenom }} </td>
                                <td>{{ $enfant->date_naissance }}</td>
                                <td>{{ $enfant->adresse }}</td>
                                <td>{{ $enfant->allergies }}</td>
                                <td>{{ $enfant->infos_medicales }}</td>
                                <td>{{ $enfant->date_inscription }}</td>


                                 <td> <a href=" {{ route('enfant.information',$enfant->id) }}" class="btn btn-sm btn-info"> <strong> Information  <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>
                                 <td> <a href="{{ route('enfant.edit',$enfant->id) }}" class="btn btn-sm btn-warning"> <strong> Update <span class="glyphicon glyphicon-pencil"></span>  </strong></a> </td>


                            </tr>
                            @endforeach
                        </tbody>


						<tfoot>
							<tr>
								<th>Id</th>
								<th>Nom & Prenom</th>
								<th>Date Naissance </th>
								<th>Adresse</th>
								<th>Allergies</th>
								<th>Infos Medicales</th>
								<th>Date Inscription</th>
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

