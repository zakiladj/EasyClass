@extends('admin.admin_master')
@section('admin_content')
@php
    use Carbon\Carbon;

    $today = Carbon::today()->format('Y-m-d'); // اليوم
    $nextMonth = Carbon::today()->addMonth()->format('Y-m-d'); // اليوم + شهر
@endphp
@if ($errors->any())
    <div style="padding:10px;border:1px solid red;margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('message'))
    <div style="padding:10px;border:1px solid green;margin-bottom:10px;">
        {{ session('message') }}
    </div>
@endif
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
								<li class="breadcrumb-item active" aria-current="page">La Liste Des Parents</li>
							</ol>
						</nav>

					</div>
				</div>
                  {{-- <button style="float: right" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent <span class="glyphicon glyphicon-plus"></span>  </strong>  </button> --}}
                    <a href="{{ route('user.create') }}" class="btn btn-rounded btn-success mb-5"> <strong> Ajouter Parent  <span class="glyphicon glyphicon-plus"></span>  </strong>  </a>
			</div>

		</div>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

         <div class="box">
			<div class="box-header with-border">
                @if ($errors->any())
                    <div style="padding:10px;border:1px solid red;margin-bottom:10px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('message'))
                    <div style="padding:10px;border:1px solid green;margin-bottom:10px;">
                        {{-- {{ session('message') }} --}}
                    </div>
                @endif
			  <h3 class="box-title"> <span class="text-success"> <strong> l'abonnement De {{ $enfant->nom }}  {{ $enfant->prenom }} </strong></span></h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form novalidate method="POST" action="{{ route('abmenfant.store')  }} " enctype="multipart/form-data">

                        @csrf
					  <div class="row">
						<div class="col-6">
							<div class="form-group">
								<h5>Type abonnement :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="abonnement" id="type_abonnement" class="form-control" required data-validation-required-message="This field is required">
                                        <option value="" selected disabled> Selectionner Abonnement </option>
                                        @foreach ($abonnements as $abonnement)
                                             <option value="{{ $abonnement->id }}"
                                                data-prix ="{{ $abonnement->prix }}"
                                                data-inscription = {{ $abonnement->frais_inscription }}
                                                data-livres = {{ $abonnement->frais_livres }} >{{ $abonnement->titre }}</option>
                                        @endforeach
                                    </select>
                                    @error('abonnement')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Date Debut :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="date" name="date_debut" id="start_date" value="{{ $today }}" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('date_debut')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Date Fin :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="date" name="date_fin" id="end_date" value="{{ $nextMonth }}" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('date_fin')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>

                            <div class="form-group">
								<h5> Date Paiement :  <span class="text-danger">*</span></h5>
								<div class="controls">

                                    <input type="date" name="date_paiement" value="{{ $today }}" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('date_paiement')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>

                        </div>
                    </div>
                        <div class="col-6">
                           <div class="form-group">
								<h5>Frais Abonnement :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" readonly name="prix_abonnement"  id="prix_abonnement"  class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('frais_inscription')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5>Frais Inscription :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" readonly name="frais_inscription"  id="frais_inscription"  class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('frais_inscription')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                            <div class="form-group">
								<h5> Frais Des Livres :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" name="frais_livres"  readonly  id="frais_livres" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    @error('livres')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                             <div class="form-group">
								<h5>Total Abonnement :  <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="number" readonly name="total" id="total"   class="form-control text-danger" required data-validation-required-message="This field is required"> </div>
                                    @error('total')
                                            <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                    @enderror
								<div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
							</div>
                        </div>
					  </div>
                    <div class="row mt-3">
                                <div class="col-md-3"></div> <!-- espace à gauche -->
                                <div class="col-md-6">
                                        <h5>Remise :  <span class="text-danger">*</span></h5>
                                         <div class="controls">
                                            <input type="number" name="remise" id="remise" class="form-control" required data-validation-required-message="This field is required"> </div>
                                            @error('remise')
                                                    <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                            @enderror
                                        <div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
                                </div>

                                <div class="col-md-3"></div> <!-- espace à droite -->
                            </div>
                        <div class="row mt-3">
                                <div class="col-md-3"></div> <!-- espace à gauche -->
                                <div class="col-md-6">
                                        <h5>Total Final  :  <span class="text-danger">*</span></h5>
                                         <div class="controls">
                                            <input type="number" readonly name="total_final"  id="total_final" class="form-control text-danger"  required data-validation-required-message="This field is required"> </div>
                                            @error('total_final')
                                                    <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                            @enderror
                                        <div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
                                </div>



                                <div class="col-md-3"></div> <!-- espace à droite -->
                            </div>
                           <div class="row mt-3">
                                <div class="col-md-3"></div> <!-- espace à gauche -->
                                <div class="col-md-6">
                                        <h5>Payeé :  <span class="text-danger">*</span></h5>
                                         <div class="controls">
                                            <input type="number" name="payer" id="payer" class="form-control" required data-validation-required-message="This field is required"> </div>
                                            @error('payer')
                                                    <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                            @enderror
                                        <div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
                                </div>



                                <div class="col-md-3"></div> <!-- espace à droite -->
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3"></div> <!-- espace à gauche -->

                                <div class="col-md-6">
                                        <h5>Rest à Payer :  <span class="text-danger">*</span></h5>
                                         <div class="controls">
                                            <input type="number" name="rest" id="rest" class="form-control" required data-validation-required-message="This field is required"> </div>
                                            @error('rest')
                                                    <div class="text-danger"><strong>{{ $message }}</strong> </div>
                                            @enderror
                                        <div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>
                                </div>

                                <div class="col-md-3"></div> <!-- espace à droite -->
                            </div>
                            <input type="hidden" name="enfant_id" value="{{ $enfant->id }}">
						<div class="text-xs-left">
							<input type="submit" class="btn btn-rounded btn-info mb-5" value="Insert User">
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
<script>
    $(document).ready(function () {
        $('#start_date').on('change', function () {
            const startDate = new Date($(this).val()); // تاريخ البداية

            if (!isNaN(startDate)) {
                let endDate = new Date(startDate);
                endDate.setMonth(endDate.getMonth() + 1); // إضافة شهر واحد

                // تحويل التاريخ إلى صيغة yyyy-mm-dd
                const year  = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, '0');
                const day   = String(endDate.getDate()).padStart(2, '0');

                $('#end_date').val(`${year}-${month}-${day}`);
            }
        });
    });
</script>
<script>
   $(document).ready(function () {

    $("#type_abonnement").on("change", function () {

        var selected = $(this).find(":selected");

        var prix = parseFloat(selected.data("prix"));
        var inscription = parseFloat(selected.data("inscription"));
        var livres = parseFloat(selected.data("livres"));

        $("#prix_abonnement").val(prix);
        $("#frais_inscription").val(inscription);
        $("#frais_livres").val(livres);

        var total = prix + inscription + livres;

        $("#total").val(total);
        $("#total_final").val(total);
        $("#remise").val(0);
        $("#payer").val(total);
        $("#rest").val(0);

        // تعبئة hidden inputs
        $("#total_hidden").val(total);
        $("#total_final_hidden").val(total);

        $("#remise").on("input", function () {

            var total = parseFloat($("#total").val()) || 0;
            var remise = parseFloat($(this).val()) || 0;

            var total_final = total - remise;
            if (total_final < 0) total_final = 0;

            $("#total_final").val(total_final);
            $("#payer").val(total_final);



            // تحديث hidden input
            $("#total_final_hidden").val(total_final);

        });
    });

    // عند إرسال الفورم
    $("form").on("submit", function () {
        $("#total_hidden").val($("#total").val());
        $("#total_final_hidden").val($("#total_final").val());
    });

     $("#payer").on("input", function () {

        var total_final = parseFloat($("#total_final").val()) || 0;
        var payer = parseFloat($(this).val()) || 0;

        // إذا دفع أكثر من اللازم نرجعه للقيمة الصحيحة
        if (payer > total_final) {
            payer = total_final;
            $("#payer").val(payer);
        }

        // حساب الباقي
        var rest = total_final - payer;
        if (rest < 0) rest = 0;

        $("#rest").val(rest);
    });
});

</script>
@endsection
