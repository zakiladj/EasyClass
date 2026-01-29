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
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Enfant</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}

                    <a href="{{ route('enfant.abonnement',$enfant->id) }}" class="btn btn-rounded btn-primary mb-5 d-flex "> <strong> Abonnement   Enfant  <span class="glyphicon glyphicon-calendar"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
                        @if($lastAbn)
                            @if($isActive)
                                <div class="alert alert-success text-center mb-0 flex-grow-1 mx-3 py-2">
                                   <span style="direction:ltr; unicode-bidi:bidi-override;">
                                    {{ \Carbon\Carbon::parse($lastAbn->date_fin)->toDateString() }}
                                </span>
                             : الاشتراك ساري المفعول — ينتهي بتاريخ  ✅

                                </div>
                            @else
                                <div class="alert alert-danger text-center mb-0 flex-grow-1 mx-3 py-2">
                                <span style="direction:ltr; unicode-bidi:bidi-override;" class="ltr-number">
                                    {{ \Carbon\Carbon::parse($lastAbn->date_fin)->toDateString() }}
                                </span>
                                :  الاشتراك منتهي — انتهى بتاريخ  ❌

                                </div>
                            @endif
                            @else
                            <div class="alert alert-warning text-center mb-0 flex-grow-1 mx-3 py-2">
                                ⚠️ هذا الطفل لا يملك أي اشتراك حالياً
                            </div>
                            @endif <br>
		  <div class="row">
			<div class="col-12">
             <div class="row"></div>
              <div class="box box-widget widget-user"><br>

					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
                     <a href="{{ route('user.edit',$enfant->id) }}" style="float: right" class="btn btn-rounded btn-success btn-primary  m-5 "> <strong> <i class="fa fa-edit"></i>  Edit  Profile  </strong>  </a>

					  <h3 class="widget-user-username">Information Générale : </h3>
					  <h3 class="widget-user-desc">
                           {{ $enfant->nom }} {{ $enfant->prenom }}
                      </h3>
					</div>

					<div class="widget-user-image">

					  <img class="img-fluid" src="{{ (!empty($enfant->image)? url('upload/enfant/'.$enfant->image):url('upload/no_image.jpg') ) }}" alt="User Avatar">

					</div><br><br>

					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Nom / Prenom : </h5>
							<span class="description-text"> <strong> {{ $enfant->nom }} {{ $enfant->prenom }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Date Naissance  : </h5>
							<span class="description-text"><strong> {{ $enfant->date_naissance }} </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">allergies  : </h5>
							<span class="description-text"> <strong> {{ $enfant->allergies }} </strong>  </span>
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
							<span class="description-text"> <strong> {{ $enfant->adresse }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">date Debut :  </h5>
							<span class="description-text"><strong> {{ $enfant->date_inscription }} </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Date Inscription: </h5>
							<span class="description-text"> <strong> {{ $enfant->created_at }} </strong>  </span>
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
                    @if(!empty($enfant->pere_id))
                         <a href="{{ route('enfant.edit',$enfant->id) }}" style="float: right" class="btn btn-rounded btn-success btn-primary  m-5 "> <strong> <i class="fa fa-edit"></i>  Edit  Profile  </strong>  </a>
                    @else
                         <a href="{{ route('pere.add',$enfant->id) }}" style="float: right" class="btn btn-rounded btn-primary  m-5 "> <strong> <i class="fa fa-edit"></i>  Ajouter Pere  </strong>  </a>
                    @endif


					  <h3 class="widget-user-username">Information Le Père : </h3>
					  <h3 class="widget-user-desc">
                        @if(!empty($enfant->pere_id))
                           {{ $enfant->pere->nom }} {{ $enfant->pere->prenom }}
                        @endif
                      </h3>
					</div>

					<div class="widget-user-image">


					</div><br><br>
                    @if(!empty($enfant->pere_id))
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Nom / Prenom : </h5>
							<span class="description-text"> <strong> {{ $enfant->pere->nom }} {{ $enfant->pere->prenom }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Telephone Mobile  01 : </h5>
							<span class="description-text"><strong> {{ $enfant->pere->numero1 }} </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Profession  : </h5>
							<span class="description-text"> <strong> {{ $enfant->pere->profession }} </strong>  </span>
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
							<span class="description-text"> <strong> {{ $enfant->pere->adresse }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Telephone Mobile  02 : </h5>
							<span class="description-text"><strong> {{ $enfant->pere->numero2 }} </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Date Inscription: </h5>
							<span class="description-text"> <strong> {{ $enfant->pere->created_at }} </strong>  </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>

					  <!-- /.row -->
					</div>
                    @else
                    <h3 class="text-danger"> <strong></strong> Aucune donnée disponible</h3>

                    @endif
				  </div>
			</div>

			<!-- /.col -->
		  </div>
        <div class="row">
			<div class="col-12">


              <div class="box box-widget widget-user"><br>

					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
                     @if(!empty($enfant->maman_id))
                         <a href="{{ route('enfant.edit',$enfant->id) }}" style="float: right" class="btn btn-rounded btn-success btn-primary  m-5 "> <strong> <i class="fa fa-edit"></i>  Edit  Profile  </strong>  </a>
                    @else
                         <a href="{{ route('maman.add',$enfant->id) }}" style="float: right" class="btn btn-rounded btn-primary  m-5 "> <strong> <i class="fa fa-edit"></i>  Ajouter Maman  </strong>  </a>
                    @endif
					  <h3 class="widget-user-username">Information La Maman : </h3>
					  <h3 class="widget-user-desc">
                        @if(!empty($enfant->maman_id))
                           {{ $enfant->maman->nom }} {{ $enfant->maman->prenom }}
                        @endif
                      </h3>
					</div>

					<div class="widget-user-image">


					</div><br><br>
                  @if(!empty($enfant->maman_id))
					<div class="box-footer">
					  <div class="row">
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Nom / Prenom : </h5>
							<span class="description-text"> <strong> {{ $enfant->maman->nom }} {{ $enfant->maman->prenom }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Telephone Mobile 01  : </h5>
							<span class="description-text"><strong> {{ $enfant->maman->numero1 }} </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Profession  : </h5>
							<span class="description-text"> <strong> {{ $enfant->maman->profession }} </strong>  </span>
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
							<span class="description-text"> <strong> {{ $enfant->maman->adresse }} </strong> </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 br-1 bl-1">
						  <div class="description-block">
							<h5 class="description-header">Telephone Mobile 02 :  </h5>
							<span class="description-text"><strong> {{ $enfant->maman->numero2 }} </strong></span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
						  <div class="description-block">
							<h5 class="description-header">Date Inscription: </h5>
							<span class="description-text"> <strong> {{ $enfant->maman->created_at }} </strong>  </span>
						  </div>
						  <!-- /.description-block -->
						</div>
						<!-- /.col -->
					  </div>

					  <!-- /.row -->

					</div>
                   @else
                    <h3 class="text-danger"> <strong></strong> Aucune donnée disponible</h3>
                    @endif


				  </div>
			</div>

			<!-- /.col -->
		  </div>
        <div class="row">
			<div class="col-12">

              <div class="box box-widget widget-user"><br>

					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">

                     <a href="{{ route('user.edit',$enfant->id) }}" style="float: right" class="btn btn-rounded btn-success btn-primary  m-5 "> <strong> <i class="fa fa-edit"></i>  Edit  Profile  </strong>  </a>

					  <h3 class="widget-user-username">Les Documents : </h3>
					  <h3 class="widget-user-desc">
                           {{ $enfant->nom }} {{ $enfant->prenom }}
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
								<th>Id Enfant</th>
								<th>Le Document</th>
								<th>Affichier</th>
							</tr>
						</thead>
                        <tbody>
                            <tr>
                                <td>{{ $enfant->id }}</td>
                                <td> Certaficat Medical  </td>
                                <td>
                                    @if(!empty($enfant->document_certificat_medical))
                                    <a href="{{ asset('upload/enfant/' . $enfant->document_certificat_medical) }}" target="_blank" class="btn btn-sm btn-info">
                                          <i class="fa fa-eye"></i>
                                          Afficher
                                     </a>
                                    @else
                                    <span class="text-danger">Aucun Document Trouvé</span>
                                    @endif
                                 </td>
                            </tr>
                            <tr>
                                <td>{{ $enfant->id }}</td>
                                <td> Piece Identite Pere </td>
                                <td>
                                    @if(!empty($enfant->pere->document_piece_identite))
                                    <a href="{{ asset('upload/enfant/pere/' . $enfant->pere->document_piece_identite) }}" target="_blank" class="btn btn-sm btn-info">
                                          <i class="fa fa-eye"></i>
                                          Afficher
                                     </a>
                                    @else
                                    <span class="text-danger">Aucun Document Trouvé</span>
                                    @endif
                                 </td>
                            </tr>
                            <tr>
                                <td>{{ $enfant->id }}</td>
                                <td> Piece Identite Maman </td>
                                <td>
                                    @if(!empty($enfant->maman->document_piece_identite))
                                    <a href="{{ asset('upload/enfant/maman/' . $enfant->maman->document_piece_identite) }}" target="_blank" class="btn btn-sm btn-info">
                                          <i class="fa fa-eye"></i>
                                          Afficher
                                     </a>
                                    @else
                                      <span class="text-danger ">Aucun Document Trouvé</span>
                                    @endif
                                 </td>
                            </tr>
                             <tr>
                                <td>{{ $enfant->id }}</td>
                                <td> Autorisation Pere </td>
                                <td>
                                    @if(!empty($enfant->pere->document_autorisation))
                                    <a href="{{ asset('upload/enfant/pere/' . $enfant->pere->document_autorisation) }}" target="_blank" class="btn btn-sm btn-info">
                                          <i class="fa fa-eye"></i>
                                          Afficher
                                     </a>
                                    @else
                                    <span class="text-danger">Aucun Document Trouvé</span>
                                    @endif
                                 </td>
                            </tr>
                            <tr>
                                <td>{{ $enfant->id }}</td>
                                <td> Autorisation Maman </td>
                                <td>
                                    @if(!empty($enfant->maman->document_autorisation))
                                    <a href="{{ asset('upload/enfant/maman/' . $enfant->maman->document_autorisation) }}" target="_blank" class="btn btn-sm btn-info">
                                          <i class="fa fa-eye"></i>
                                          Afficher
                                     </a>
                                    @else
                                    <span class="text-danger ">Aucun Document Trouvé</span>
                                    @endif
                                 </td>
                            </tr>
                           <tr>
                                <td>{{ $enfant->id }}</td>
                                <td> Attestation d'inscription  </td>
                                 <td> <a href=" {{ route('enfant.inscription',$enfant->id) }}" class="btn btn-sm btn-info"> <strong> Attestation  <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>

                            </tr>
                            <tr>
                                <td>{{ $enfant->id }}</td>
                                <td> Carte  Enfant   </td>
                                 <td> <a href=" {{ route('enfant.carte',$enfant->id) }}" class="btn btn-sm btn-info"> <strong> Attestation  <span class="glyphicon glyphicon-info-sign"></span> </strong> </a>  </td>

                            </tr>


                        </tbody>


						<tfoot>
							<tr>
								<th>Id Enfant</th>

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


