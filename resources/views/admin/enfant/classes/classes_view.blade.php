@extends('admin.admin_master')
@section('admin_content')


  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Classes </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Classes</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('classes.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Classe <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">La Liste Des Classes </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <strong>
							<tr>
								<th>Id</th>
								<th>Classe</th>
								<th>Educatrice </th>
								<th>Niveau</th>
								<th>Capacite</th>
								<th>Place Disponible</th>
                                <th>Annee</th>
								<th>Description</th>
                                <th>Enfants </th>
                                <th>Information</th>
								<th>Update </th>
							</tr>
						</thead>
                        <tbody>
                            @foreach ($allData as $classes )
                            <tr>
                                <td>{{ $classes->id }}</td>
                                <td>{{ $classes->nom}}</td>
                                <td>{{ $classes->employe->nom }} {{ $classes->employe->prenom }}</td>
                                <td>{{ $classes->niveau }} </td>
                                <td>{{ $classes->capacite }}</td>
                                <td>{{ $classes->place_disponible }}</td>

                                <td>{{ $classes->annee }}</td>
                                <td>{{ $classes->description }}</td>
                                 <td> <a href=" {{ route('classes.enfant',$classes->id) }}" class="btn btn-sm btn-success"> <strong> Enfants   <span class="glyphicon glyphicon-education"></span> </strong> </a>  </td>
                                 <td> <a href=" {{ route('classes.information',$classes->id) }}" class="btn btn-sm btn-info"> <strong> Information  <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>
                                 <td> <a href="{{ route('classes.edit',$classes->id) }}" class="btn btn-sm btn-warning"> <strong> Update <span class="glyphicon glyphicon-pencil"></span>  </strong></a> </td>

                            </tr>
                            @endforeach
                        </tbody>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Classe</th>
								<th>Educatrice </th>
								<th>Niveau</th>
								<th>Capacite</th>
                                <th>Place Disponible</th>
                                <th>Annee</th>
								<th>Description</th>
                                <th>Enfants </th>
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
