@extends('admin.admin_master')
@section('admin_content')


  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Les Information Des Classes </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Classe {{ $class->nom }}</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('classes.add') }}" class="btn btn-rounded btn-success mb-5 d-flex "> <strong> Ajouter Classe  <span class="glyphicon glyphicon-plus"></span>  </strong>  </a><br>


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
                     <a href="{{ route('classes.edit',$class->id) }}" style="float: right" class="btn btn-rounded btn-success btn-primary  m-5 "> <strong> <i class="fa fa-edit"></i>  Edit  Classe  </strong>  </a>
                     <a href="{{ route('classes.impression',$class->id) }}" style="float: right" class="btn btn-rounded btn-primary  m-5 "> <strong> <i class="fa fa-print"></i>  Imprimer  </strong>  </a>


					  <h3 class="widget-user-username">Classe  : </h3>
					  <h3 class="widget-user-desc">
                               <span class="text-success"> <i class="fa fa-list"></i>  <strong>{{ $class->nom }} </strong></span>
                      </h3>
					</div>

					<div class="widget-user-image">

					  {{-- <img class="img-fluid" src="{{ (!empty($profileData->image)? url('upload/user_image/'.$profileData->image):url('upload/no_image.jpg') ) }}" alt="User Avatar"> --}}

					</div><br><br>

					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Educatrice : </h5>
							<span class="description-text"> <strong> {{ $class->employe->nom }} {{ $class->employe->prenom }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Capacite  : </h5>
							<span class="description-text"><strong> {{ $class->capacite }} Enfants </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Place Disponible  : </h5>

							<span class="description-text"> <strong> {{ $class->place_disponible }} Enfants </strong>  </span>
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
							<h5 class="description-header">Information  : </h5>
							<span class="description-text"> <strong> {{ $class->description }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Année :  </h5>
							<span class="description-text"><strong> {{ $class->annee }} </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Date  Creation : </h5>
							<span class="description-text"> <strong> {{ $class->created_at }} </strong>  </span>
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
