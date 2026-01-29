@extends('admin.admin_master')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Enfant </h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Employes</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
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
                     <a href="{{ route('user.edit',$employes->id) }}" style="float: right" class="btn btn-rounded btn-success btn-primary  m-5 "> <strong> <i class="fa fa-edit"></i>  Edit  Profile  </strong>  </a>

					  <h3 class="widget-user-username">Information Générale : </h3>
					  <h3 class="widget-user-desc">
                           {{ $employes->nom }} {{ $employes->prenom }}
                      </h3>
					</div>

					<div class="widget-user-image">

					  {{-- <img class="img-fluid" src="{{ (!empty($enfant->image)? url('upload/enfant/'.$enfant->image):url('upload/no_image.jpg') ) }}" alt="User Avatar"> --}}

					</div><br><br>

					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Nom / Prenom : </h5>
							<span class="description-text"> <strong> {{ $employes->nom }} {{ $employes->prenom }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header"> téléphone 1   : </h5>
							<span class="description-text"><strong> {{ $employes->telephone }} </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">téléphone 2  : </h5>
							<span class="description-text"> <strong> {{ $employes->telephone2 }} </strong>  </span>
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
							<h5 class="description-header">Address : </h5>
							<span class="description-text"> <strong> {{ $employes->adresse }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">date d'embauche :  </h5>
							<span class="description-text"><strong> {{ $employes->date_embauche }} </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Email: </h5>
							<span class="description-text"> <strong> {{ $employes->email }} </strong>  </span>
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
        <div class="row">
			<div class="col-12">

              <div class="box box-widget widget-user"><br>

					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">



					  <h3 class="widget-user-username">information de Poste  : </h3>
					  <h3 class="widget-user-desc">

                      </h3>
					</div>

					<div class="widget-user-image">


					</div><br><br>

					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Poste  : </h5>
							<span class="description-text"> <strong> {{ $employes->poste }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Salaire : </h5>
							<span class="description-text"><strong> {{ $employes->salaire }} DA </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Niveau  : </h5>
							<span class="description-text"> <strong> {{ $employes->niveau }} </strong>  </span>
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

        <div class="row">
			<div class="col-12">

              <div class="box box-widget widget-user"><br>

					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">


					  <h3 class="widget-user-username">Les Documents : </h3>
					  <h3 class="widget-user-desc">
                           {{ $employes->nom }} {{ $employes->prenom }}
                      </h3>
					</div>
					<div class="widget-user-image">
					</div><br><br>

					<div class="box-footer">
					  <div class="row">
	<!-- /.col -->
					  </div>

					  <!-- /.row -->
					</div>
                    <div class="box-footer">
					  <div class="row">
                 <div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
                            <strong>
							<tr>
								<th>Id Employe</th>
								<th>Le Document</th>
								<th>Affichier</th>
							</tr>
						</thead>
                        <tbody>
                            <tr>
                                <td>{{ $employes->id }}</td>
                                <td> Piece Identite  </td>
                                <td>
                                    @if(!empty($employes->document_piece_identite))
                                    <a href="{{ asset('upload/enfant/employes/' . $employes->document_piece_identite) }}" target="_blank" class="btn btn-sm btn-info">
                                          <i class="fa fa-eye"></i>
                                          Afficher
                                     </a>
                                    @else
                                    <span class="text-danger">Aucun Document Trouvé</span>
                                    @endif
                                 </td>
                            </tr>


                            <tr>
                                <td>{{ $employes->id }}</td>
                                <td> Diplome  </td>
                                <td>
                                    @if(!empty($employes->diplome))
                                    <a href="{{ asset('upload/enfant/employes/' . $employes->diplome) }}" target="_blank" class="btn btn-sm btn-info">
                                          <i class="fa fa-eye"></i>
                                          Afficher
                                     </a>
                                    @else
                                    <span class="text-danger ">Aucun Document Trouvé</span>
                                    @endif
                                 </td>
                            </tr>
                           <tr>
                                <td>{{ $employes->id }}</td>
                                <td> Attestation de travail </td>
                                 <td> <a href=" {{ route('employe.inscription',$employes->id) }}" class="btn btn-sm btn-info"> <strong> Attestation  <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>

                            </tr>
                            <tr>
                                <td>{{ $employes->id }}</td>
                                <td> Carte  Employe   </td>
                                 <td> <a href=" {{ route('employe.carte',$employes->id) }}" class="btn btn-sm btn-info"> <strong> Carte   <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>

                            </tr>


                        </tbody>


						<tfoot>
							<tr>
								<th>Id Employe</th>

								<th>Le Document</th>
								<th>Affichier</th>


							</tr>
						</tfoot>
					  </table>
                      </strong>
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


