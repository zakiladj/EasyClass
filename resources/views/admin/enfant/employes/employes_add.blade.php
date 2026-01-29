@extends('admin.admin_master')
@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



  <div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">La Liste Des Employes </h3>
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
                    <a href="{{ route('employes.add') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Employe  <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

        <div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title"> <span class="text-success"> <strong> Ajouter Un Employé </strong></span></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form novalidate method="POST" action="{{ route('employes.store')  }} " enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-6">
							<div class="form-group">
								<h5>Nom :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="nom" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('nom')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>prenom :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="prenom" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('prenom')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Numero Telephone 01 :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" name="num1" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('num1')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Numero Telephone 2  :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="num2" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('num2')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Email :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="email" name="email" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('email')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Adresse :  <span class="text-danger">*</span></h5>
								<div class="controls">

                                    <input type="text" name="adresse" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('adresse')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>

                        </div>
                        <div class="col-6">
                            <div class="form-group">
								<h5>Niveau :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="niveau" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('niveau')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                             <div class="form-group">
								<h5>Poste :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="poste" id="type_frais" class="form-control" required data-validation-required-message="This field is required">
                                        <option value="educatrice" selected>Educatrice</option>
                                        <option value="secrétaire">Secrétaire</option>
                                        <option value="aide">Aide</option>
                                        <option value="autre">Autre</option>
                                    </select>
                                    @error('poste')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
							</div>
                            <div class="form-group">
								<h5>Salaire :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="salaire" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('salaire')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Piece Identite :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="document_piece_identite" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('piece_identite')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                             <div class="form-group">
								<h5>Diplome :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="file" name="diplome" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('diplome')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
							<h5>Date D'embauche :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="date" name="date_embauche" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('date_embauche')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>

                        </div>
					  </div>
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Ajouter  Employé">
						</div>

					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>
  </div>



<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection
