@extends('admin.admin_master')
@section('admin_content')


  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Parents </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Student Years</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('student.class.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Years <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">La Liste Des Student Years </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <strong>
							<tr>
								<th>Id</th>
                                <th>Name</th>


								<th>Level</th>
								<th>Dsecription</th>
								<th>status</th>
								<th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Information</th>
								<th>Update </th>
								<th>Delete</th>
							</tr>
						</thead>
                        <tbody>
                            @foreach ($allData as $year )

                            <tr>
                                <td>{{ $year->id }}</td>
                                <td>{{ $year->name }}</td>
                                <td>{{ $year->level_order	 }}</td>
                                <td>{{ $year->description }}</td>

                                <td>
                                    @if($year->status == "active")
                                    <span class="badge rounded-pill bg-success fs-5 px-3 py-2">Active</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger fs-5 px-3 py-2">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $year->created_at}}</td>
                                <td>{{ $year->updated_at }}</td>
                                 <td> <a href=" {{ route('year.details',$year->id) }}" class="btn btn-sm btn-info"> <strong> Information  <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>
                                 <td> <a href="{{ route('year.edit',$year->id) }}" class="btn btn-sm btn-warning"> <strong> Update <span class="glyphicon glyphicon-pencil"></span>  </strong></a> </td>
                                 <td> <a href="{{ route('year.delete',$year->id) }}" class="btn btn-sm btn-danger" id="delete"> Delete <span class="glyphicon glyphicon-remove"></span> </a> </td>


                            </tr>
                            @endforeach
                        </tbody>


						<tfoot>
							<tr>
								<th>Id</th>
								<th>Name</th>
                                <th>Level</th>
								<th>Description</th>
                                <th>Status</th>

								<th>Created AT</th>
								<th>Updated At</th>
                                <th>Information</th>
								<th>Update </th>
								<th>Delete</th>


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
