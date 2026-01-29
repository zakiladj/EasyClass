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
                    <a href="{{ route('classes.impression_enfant',$class->id) }}" class="btn btn-rounded btn-primary mb-5"> <strong> Imprimer Classe <span class="glyphicon glyphicon-print"></span>  </strong>  </a> <hr> <br>
                    <a href="{{ route('classes.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Classe <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>


			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Les  Enfants  de La Classe  <span class="text-success">{{ $class->nom }}</span> </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <strong>
							<tr>
								<th>Id</th>
								<th>Enfant </th>
								<th>Date Inscription  </th>
                                <th>Parent </th>
                                <th>Contact Parent </th>
                                <th>Adresse Parent </th>
								<th>Classe</th>
								<th>Educatrice</th>
                                <th>Enfant </th>
                                <th>Information</th>
							</tr>
						</thead>
                        <tbody>
                            @foreach ($data as $enfant  )
                            <tr>
                                <td>{{ $enfant->id }}</td>
                                <td>{{ $enfant->nom }} {{ $enfant->prenom  }}</td>
                                <td>{{ $enfant->created_at}}</td>
                                {{-- <td>{{ $enfant->pere->nom   }} {{ $enfant->pere->prenom }}</td> --}}
                                <td>{{ $enfant->pere->nom ?? '---' }} {{ $enfant->pere->prenom ?? '' }}</td>
                                <td>{{ $enfant->telephone }} </td>
                                <td>{{ $enfant->adresse }} </td>
                                <td>{{ $class->nom }}</td>
                                <td>{{ $class->employe->nom }} {{ $class->employe->prenom }}</td>
                                <td> <a href=" {{ route('enfant.information',$enfant->id) }}" class="btn btn-sm btn-success"> <strong> Enfant   <span class="glyphicon glyphicon-education"></span> </strong> </a>  </td>
                                <td> <a href=" {{ route('classes.information',$class->id) }}" class="btn btn-sm btn-info"> <strong> Information  <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>

                            </tr>
                            @endforeach
                        </tbody>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Enfant </th>
								<th>Date Inscription  </th>
                                <th>Parent </th>
                                <th>Contact Parent </th>
                                <th>Adresse Parent </th>
								<th>Classe</th>
								<th>Educatrice</th>
                                <th>Enfant </th>
                                <th>Information</th>
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
