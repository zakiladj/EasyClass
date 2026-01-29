@extends('admin.admin_master')
@section('admin_content')


  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Shift {{ $detail->name }} </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">Shift Information</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('student.shift.add') }}" class="btn btn-rounded btn-success mb-5 d-flex "> <strong> Ajouter Shift <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">
                <div class="row"></div>
              <div class="box box-widget widget-user"><br>

					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
                     <a href="{{ route('shift.edit',$detail->id) }}" style="float: right" class="btn btn-rounded btn-success btn-primary  m-5 "> <strong> <i class="fa fa-edit"></i>  Edit Shift    </strong>  </a>


					</div>

					<div class="widget-user-image">

                        <h3 class="text-success"> <strong> Shift Name :  </strong>  </h3> <hr>
                        <center> <h5>  <strong> {{ $detail->name  }} </strong>  </h5></center>


					</div><br><br>

					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header text-success">Name : </h5>
							<span class="description-text"> <strong> {{ $detail->name }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->

						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header text-success">Start Time :   : </h5>
							<span class="description-text"> <strong> {{ $detail->start_time }} </strong>  </span>
						  </div>
						  <!-- /.description-block -->
						</div>

						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header text-success">End Time  : </h5>
							<span class="description-text"> <strong> {{ $detail->end_time }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>

					  <!-- /.row -->
					</div>
                    <div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header text-success">Description  : </h5>
							<span class="description-text"> <strong> {{ $detail->description }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->

						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header text-success">Created At : </h5>
							<span class="description-text"> <strong> {{ $detail->created_at }} </strong>  </span>
						  </div>
						  <!-- /.description-block -->
						</div>
                        <div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header text-success">Updated At : </h5>
							<span class="description-text"> <strong> {{ $detail->updated_at }} </strong>  </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>

					  <!-- /.row -->
					</div>
				  </div>
			</div>

			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>
  </div>




@endsection
