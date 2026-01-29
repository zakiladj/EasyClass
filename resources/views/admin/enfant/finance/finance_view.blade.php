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
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Catégories financières</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('finance.impression') }}" class="btn btn-rounded btn-primary mb-5"> <strong> Imprimer   <span class="glyphicon glyphicon-print"></span>  </strong>  </a> </a> <hr>

                    <a href="{{ route('finance.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Catégories financières <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>

			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">La Liste Des Catégories financières </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <strong>
							<tr>
								<th>Id</th>
								<th>Catégorie financière</th>
								<th>Type </th>
								<th>Etat</th>
                                <th>Description</th>
								<th>Created By </th>
								<th>Created At</th>
                                <th>Information</th>
								<th>Update </th>
							</tr>
						</thead>
                        <tbody>
                            @foreach ($allData as $categorie )
                            <tr>
                                <td>{{ $categorie->id }}</td>
                                <td>{{ $categorie->name}}</td>
                                <td>{{ $categorie->type }} </td>
                                @if($categorie->is_active == 1)
                                    <td><span class="badge badge-pill badge-success">Active</span></td>
                                @else
                                    <td><span class="badge badge-pill badge-danger">Inactive</span></td>
                                @endif
                                <td >{{ $categorie->note }}</td>
                                <td>{{ $categorie->creator->name }}</td>
                                <td>{{ $categorie->created_at }}</td>

                                 <td> <a href=" {{ route('finance.information',$categorie->id) }}" class="btn btn-sm btn-info"> <strong> Information  <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>
                                 <td> <a href="{{ route('finance.edit',$categorie->id) }}" class="btn btn-sm btn-warning"> <strong> Update <span class="glyphicon glyphicon-pencil"></span>  </strong></a> </td>

                            </tr>
                            @endforeach
                        </tbody>
						<tfoot>
							<tr>
								<th>Id</th>
								<th>Catégorie financière</th>
								<th>Type </th>
								<th>Etat</th>
                                <th>Description</th>

								<th>Created By </th>
								<th>Created At</th>
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
