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
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Parents</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('user.create') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">
                 <div class="box box-inverse bg-img" style="background-image: url(../images/gallery/full/1.jpg);" data-overlay="2">
					  <div class="flexbox px-20 pt-20">
						<label class="toggler toggler-danger text-white">
						  <input type="checkbox">
                           @if($profileData->usertype == 'admin')
                                <i class="fa fa-shield"> <strong> Admin</strong> </i>
                            @else
                                <i class="fa fa-user"> <strong> User </strong></i>
                            @endif
						</label><br>


						{{-- <div class="dropdown">
						  <a data-toggle="dropdown" href="#"><i class="ti-more-alt rotate-90 text-white"></i></a>
						  <div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
							<a class="dropdown-item" href="#"><i class="fa fa-picture-o"></i> Shots</a>
							<a class="dropdown-item" href="#"><i class="ti-check"></i> Follow</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#"><i class="fa fa-ban"></i> Block</a>
						  </div>
						</div> --}}
                      <a href="{{ route('user.edit',$profileData->id) }}" class="btn btn-rounded btn-primary mb-5"> <strong> <i class="fa fa-edit"></i>  Edit  Profile  </strong>  </a>

					  </div>

					  <div class="box-body text-center pb-50">
						<a href="#">
						  <img class="avatar avatar-xxl avatar-bordered" src="../images/avatar/5.jpg" alt="">
						</a>
						<h4 class="mt-2 mb-0"><a class="hover-primary text-white" href="#">{{ $profileData->name }} </a></h4>
						<span><i class="fa fa-map-marker w-20"></i> Algeria </span>
					  </div>

					  <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
						<li>
						  <span class="opacity-60"><strong>Gender :</strong> </span><br>
						  <span class="font-size-20">{{ $profileData->gender }}</span>
						</li>
						<li>
						  <span class="opacity-60"><strong>Address : </strong></span><br>
						  <span class="font-size-20">{{ $profileData->address }}</span>
						</li>
						<li>
						  <span class="opacity-60"><strong>Mobile Number :</strong> </span><br>
						  <span class="font-size-20">{{ $profileData->mobile }} </span>
						</li>
					  </ul><br>
                     <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
						<li>
						  <span class="opacity-60"><strong>Email :</strong> </span><br>
						  <span class="font-size-20">{{ $profileData->email }}</span>
						</li>
						<li>
						  <span class="opacity-60"><strong>Created At  : </strong></span><br>
						  <span class="font-size-20">{{ $profileData->created_at }}</span>
						</li>
						<li>
						  <span class="opacity-60"><strong>Updated At:</strong> </span><br>
						  <span class="font-size-20">{{ $profileData->updated_at }} </span>
						</li>
					  </ul>
					</div>

			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>
  </div>




@endsection
