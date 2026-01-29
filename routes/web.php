<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;

use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentFeeCategoryController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;


//
// ===================== PUBLIC ROUTES =====================
//

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::view('/test-chart', 'admin.chart.chart_js')->name('test.chart');


//
// ===================== ADMIN PROTECTED ROUTES =====================
//

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        // return view('admin.index');
        return redirect()->route('abmenfant.view');
    })->name('dashboard');


    //
    // ---------- User Management ----------
    //
    Route::prefix('users')->group(function () {
        Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
        Route::get('/create', [UserController::class, 'UserCreate'])->name('user.create');
        Route::post('/store', [UserController::class, 'UserStore'])->name('user.store');
        Route::get('/information', [UserController::class, 'UserInformation'])->name('user.information');
        Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('user.delete');
    });


    //
    // ---------- Profile ----------
    //
    Route::prefix('profile')->group(function () {
        Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
        Route::get('/viewprofile/{id}', [ProfileController::class, 'ProfileIdView'])->name('profileId.view');
        Route::get('/edit', [UserController::class, 'ProfileEdit'])->name('profile.edit');
        Route::get('/password_edit', [ProfileController::class, 'PasswordView'])->name('password.view');
        Route::post('/ps_update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
    });


    //
    // ---------- Setups ----------
    //
    Route::prefix('setups')->group(function () {

        // Student Class
        Route::get('student/class/view', [StudentClassController::class, 'StudentView'])->name('student.class.view');
        Route::get('student/class/add', [StudentClassController::class, 'ClassAdd'])->name('student.class.add');
        Route::post('student/class/store', [StudentClassController::class, 'ClassStore'])->name('class.store');
        Route::get('student/class/edit/{id}', [StudentClassController::class, 'ClassEdit'])->name('class.edit');
        Route::post('student/class/update/{id}', [StudentClassController::class, 'ClassUpdate'])->name('class.update');
        Route::get('student/class/delete/{id}', [StudentClassController::class, 'ClassDelete'])->name('class.delete');
        Route::get('student/class/view/{id}', [StudentClassController::class, 'ClassDetails'])->name('class.details');

        // Student Year
        Route::get('student/year/view', [StudentYearController::class, 'YearView'])->name('student.year.view');
        Route::get('student/year/add', [StudentYearController::class, 'YearAdd'])->name('student.year.add');
        Route::post('student/year/store', [StudentYearController::class, 'YearStore'])->name('year.store');
        Route::get('student/year/edit/{id}', [StudentYearController::class, 'YearEdit'])->name('year.edit');
        Route::post('student/year/update/{id}', [StudentYearController::class, 'YearUpdate'])->name('year.update');
        Route::get('student/year/delete/{id}', [StudentYearController::class, 'YearDelete'])->name('year.delete');
        Route::get('student/year/view/{id}', [StudentYearController::class, 'YearDetails'])->name('year.details');

        // Student Group
        Route::get('student/group/view', [StudentGroupController::class, 'GroupView'])->name('student.group.view');
        Route::get('student/group/add', [StudentGroupController::class, 'GroupAdd'])->name('student.group.add');
        Route::post('student/group/store', [StudentGroupController::class, 'GroupStore'])->name('group.store');
        Route::get('student/group/edit/{id}', [StudentGroupController::class, 'GroupEdit'])->name('group.edit');
        Route::post('student/group/update/{id}', [StudentGroupController::class, 'GroupUpdate'])->name('group.update');
        Route::get('student/group/delete/{id}', [StudentGroupController::class, 'GroupDelete'])->name('group.delete');
        Route::get('student/group/view/{id}', [StudentGroupController::class, 'GroupDetails'])->name('group.details');

        // Student Shift
        Route::get('student/shift/view', [StudentShiftController::class, 'ShiftView'])->name('student.shift.view');
        Route::get('student/shift/add', [StudentShiftController::class, 'ShiftAdd'])->name('student.shift.add');
        Route::post('student/shift/store', [StudentShiftController::class, 'ShiftStore'])->name('shift.store');
        Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'ShiftEdit'])->name('shift.edit');
        Route::post('student/shift/update/{id}', [StudentShiftController::class, 'ShiftUpdate'])->name('shift.update');
        Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'ShiftDelete'])->name('shift.delete');
        Route::get('student/shift/view/{id}', [StudentShiftController::class, 'ShiftDetails'])->name('shift.details');

        // Fee Category
        Route::get('student/fee/category/view', [StudentFeeCategoryController::class, 'FeeCategoryView'])->name('student.fee.category.view');
        Route::get('student/fee/category/add', [StudentFeeCategoryController::class, 'FeeCategoryAdd'])->name('student.fee.category.add');
        Route::post('student/fee/category/store', [StudentFeeCategoryController::class, 'FeeCategoryStore'])->name('fee.category.store');
        Route::get('student/fee/category/edit/{id}', [StudentFeeCategoryController::class, 'FeeCategoryEdit'])->name('fee.category.edit');
        Route::post('student/fee/category/update/{id}', [StudentFeeCategoryController::class, 'FeeCategoryUpdate'])->name('fee.category.update');
        Route::get('student/fee/category/delete/{id}', [StudentFeeCategoryController::class, 'FeeCategoryDelete'])->name('fee.category.delete');
        Route::get('student/fee/category/view/{id}', [StudentFeeCategoryController::class, 'FeeCategoryDetails'])->name('fee.category.details');

        // Fee Amount
        Route::get('fee/amount/view', [FeeAmountController::class, 'AmountView'])->name('fee.category.amount');
        Route::get('fee/amount/add', [FeeAmountController::class, 'AmountAdd'])->name('fee.amount.add');
        Route::post('fee/amount/store', [FeeAmountController::class, 'AmountStore'])->name('fee.amount.store');
        Route::get('fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'AmountEdit'])->name('fee.amount.edit');
        Route::post('fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'AmountUpdate'])->name('fee.amount.update');
        Route::get('fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'AmountDetails'])->name('fee.amount.details');
        Route::get('fee/amount/delete/{id}', [FeeAmountController::class, 'AmountDelete'])->name('fee.amount.delete');
    });


    //
    // ---------- Enfant ----------
    //
    Route::prefix('enfant')->group(function () {
        Route::get('/view', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantView'])->name('enfant.view');
        Route::get('/view2', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantView2'])->name('enfant.view2');
        Route::get('/add', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantAdd'])->name('enfant.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantStore'])->name('enfant.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantEdit'])->name('enfant.edit');
        Route::get('/information/{id}', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'Enfantinformation'])->name('enfant.information');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantUpdate'])->name('enfant.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantDelete'])->name('enfant.delete');
        Route::get('/inscription/{id}', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantInscription'])->name('enfant.inscription');
        Route::get('/enfants/{id}/carte', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'genererCarte'])->name('enfant.carte');
        route::get('/abonnement/{id}', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantAbonnement'])->name('enfant.abonnement');
        Route::get('/enfant/impression', [App\Http\Controllers\Backend\Enfant\EnfantController::class, 'EnfantImpression'])->name('enfant.impression');


    });

    //
    // ---------- Pere ----------
    //
    Route::prefix('pere')->group(function () {
        Route::get('/add/{id}', [App\Http\Controllers\Backend\Enfant\PereController::class, 'PereAdd'])->name('pere.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\PereController::class, 'PereStore'])->name('pere.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\PereController::class, 'PereEdit'])->name('pere.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\PereController::class, 'PereUpdate'])->name('pere.update');
    });

    //
    // ---------- Maman ----------
    //
    Route::prefix('maman')->group(function () {
        Route::get('/add/{id}', [App\Http\Controllers\Backend\Enfant\MamanController::class, 'MamanAdd'])->name('maman.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\MamanController::class, 'MamanStore'])->name('maman.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\MamanController::class, 'MamanEdit'])->name('maman.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\MamanController::class, 'MamanUpdate'])->name('maman.update');
    });


    //
    // ---------- Abonnement ----------
    //
    Route::prefix('abonnement')->group(function () {
        Route::get('/view', [App\Http\Controllers\Backend\Enfant\AbmController::class, 'AbonnementView'])->name('abonnement.view');
        Route::get('/add', [App\Http\Controllers\Backend\Enfant\AbmController::class, 'AbonnementAdd'])->name('abonnement.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\AbmController::class, 'AbonnementStore'])->name('abonnement.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\AbmController::class, 'AbonnementEdit'])->name('abonnement.edit');
        Route::get('/information/{id}', [App\Http\Controllers\Backend\Enfant\AbmController::class, 'Abonnementinformation'])->name('abonnement.information');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\AbmController::class, 'AbonnementUpdate'])->name('abonnement.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\Enfant\AbmController::class, 'AbonnementDelete'])->name('abonnement.delete');
        Route::get('/impression', [App\Http\Controllers\Backend\Enfant\AbmController::class, 'AbonnementImpression'])->name('abonnements.impression');
    });

    //
    // ---------- Employes ----------
    //
    Route::prefix('employes')->group(function () {
        Route::get('/view', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'EmployesView'])->name('employes.view');
        Route::get('/add', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'EmployesAdd'])->name('employes.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'EmployesStore'])->name('employes.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'EmployesEdit'])->name('employes.edit');
        Route::get('/information/{id}', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'Employesinformation'])->name('employes.information');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'EmployesUpdate'])->name('employes.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'EmployesDelete'])->name('employes.delete');
        Route::get('/impression', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'EmployesImpression'])->name('employes.impression');
        Route::get('/carte/{id}', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'EmployesCarte'])->name('employe.carte');
        Route::get('/attestation/{id}', [App\Http\Controllers\Backend\Enfant\EmployesController::class, 'EmployesAttestation'])->name('employe.inscription');
    });

    //
    // ---------- Classes ----------
    //
    Route::prefix('classes')->group(function () {
        Route::get('/view', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'ClassesView'])->name('classes.view');
        Route::get('/add', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'ClassesAdd'])->name('classes.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'ClassesStore'])->name('classes.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'ClassesEdit'])->name('classes.edit');
        Route::get('/information/{id}', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'Classesinformation'])->name('classes.information');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'ClassesUpdate'])->name('classes.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'ClassesDelete'])->name('classes.delete');
        Route::get('/enfant/{id}', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'ClassesEnfant'])->name('classes.enfant');
        Route::get('/impression/{id}', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'ClassesImpression'])->name('classes.impression');
        Route::get('/impression_classe/{id}', [App\Http\Controllers\Backend\Enfant\ClassesController::class, 'ClassesImpressionEnfant'])->name('classes.impression_enfant');
    });

    //
    // ---------- PDF ----------
    //
    Route::prefix('pdf')->group(function () {
        Route::get('/pdf', [App\Http\Controllers\Backend\Enfant\PdfController::class, 'PdvView'])->name('pdf.view');
        Route::get('/inscription', [App\Http\Controllers\Backend\Enfant\PdfController::class, 'PdfInscription'])->name('pdf.inscription');
    });

    //
    // ---------- Abm Enfant ----------
    //
    Route::prefix('abmenfant')->group(function () {
        Route::get('/view', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantView'])->name('abmenfant.view');
        Route::get('/add/{id_enfant}', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantAdd'])->name('abmenfant.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantStore'])->name('abmenfant.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantEdit'])->name('abmenfant.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantUpdate'])->name('abmenfant.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantDelete'])->name('abmenfant.delete');
        Route::get('/details/{id}', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantDetails'])->name('abmenfant.details');
        Route::get('/impression/{id}', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantImpression'])->name('abonnement.impression');
        Route::get('/renew/{id}', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantRenew'])->name('abmenfant.renew');
        Route::post('/renew/store', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantRenewStore'])->name('abmenfantrenew.store');
        Route::get('/reste/view', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantResteView'])->name('abmenfant.reste');
        Route::get('/rest_imp/{id}', [App\Http\Controllers\Backend\Enfant\AbmEnfantController::class, 'AbmEnfantImpressionRest'])->name('rest.impression');



    });
    Route::prefix('finance')->group(function () {
        Route::get('/view', [App\Http\Controllers\Backend\Enfant\FinanceController::class, 'FinanceView'])->name('finance.view');
        Route::get('/add', [App\Http\Controllers\Backend\Enfant\FinanceController::class, 'FinanceAdd'])->name('finance.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\FinanceController::class, 'FinanceStore'])->name('finance.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\FinanceController::class, 'FinanceEdit'])->name('finance.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\FinanceController::class, 'FinanceUpdate'])->name('finance.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\Enfant\FinanceController::class, 'FinanceDelete'])->name('finance.delete');
        Route::get('/information/{id}', [App\Http\Controllers\Backend\Enfant\FinanceController::class, 'Financeinformation'])->name('finance.information');
        Route::get('/impression', [App\Http\Controllers\Backend\Enfant\FinanceController::class, 'FinanceImpression'])->name('finance.impression');
        Route::get('charge/view', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeView'])->name('charge.view');
        Route::get('charge/add', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeAdd'])->name('charge.add');
        Route::post('charge/store', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeStore'])->name('charge.store');
        Route::get('charge/edit/{id}', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeEdit'])->name('charge.edit');
        Route::post('charge/update/{id}', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeUpdate'])->name('charge.update');
        Route::get('charge/delete/{id}', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeDelete'])->name('charge.delete');
        Route::get('charge/information/{id}', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'Chargeinformation'])->name('charge.information');
        Route::get('charge/impression', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeImpression'])->name('charge.impression');
    });
    Route::prefix('charge')->group(function () {
       Route::get('/view', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeView'])->name('charge.view');
        Route::get('/add', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeAdd'])->name('charge.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeStore'])->name('charge.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeEdit'])->name('charge.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeUpdate'])->name('charge.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeDelete'])->name('charge.delete');
        Route::get('/information/{id}', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'Chargeinformation'])->name('charge.information');
        Route::get('/impression', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeImpression'])->name('charge.impression');
        Route::get('/charge_id.impression/{id}', [App\Http\Controllers\Backend\Enfant\ChargeController::class, 'ChargeIdImpression'])->name('chargeid.impression');

    });

    Route::prefix('fournisseurs')->group(function () {
        Route::get('/view', [App\Http\Controllers\Backend\Enfant\FournisseurController::class, 'FournisseurView'])->name('fournisseur.view');
        Route::get('/add', [App\Http\Controllers\Backend\Enfant\FournisseurController::class, 'FournisseurAdd'])->name('fournisseur.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\FournisseurController::class, 'FournisseurStore'])->name('fournisseur.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\FournisseurController::class, 'FournisseurEdit'])->name('fournisseur.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\FournisseurController::class, 'FournisseurUpdate'])->name('fournisseur.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\Enfant\FournisseurController::class, 'FournisseurDelete'])->name('fournisseur.delete');
        Route::get('/information/{id}', [App\Http\Controllers\Backend\Enfant\FournisseurController::class, 'Fournisseurinformation'])->name('fournisseur.information');
        Route::get('/impression', [App\Http\Controllers\Backend\Enfant\FournisseurController::class, 'FournisseurImpression'])->name('fournisseur.impression');
    });
    Route::prefix('paiement')->group(function () {
        Route::get('/view', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementView'])->name('paiement.view');
        Route::get('/add', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementAdd'])->name('paiement.add');
        Route::post('/store', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementStore'])->name('paiement.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementEdit'])->name('paiement.edit');
        Route::post('/update/{id}', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementUpdate'])->name('paiement.update');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementDelete'])->name('paiement.delete');
        Route::get('/information/{id}', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'Paiementinformation'])->name('paiement.information');
        Route::get('/impression', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementImpression'])->name('paiement.impression');
        Route::post('/openMonth', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'OpenMonth'])->name('paiement.openMonth');
        Route::get('/index/{year}/{month}', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementIndex'])->name('paiement.index');
        Route::get('/action/{id}', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementAction'])->name('paiement.action');
        Route::post('/action/store', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementActionStore'])->name('action.store');
        Route::get('/print/{id}', [App\Http\Controllers\Backend\Enfant\PaiementController::class, 'PaiementPrintId'])->name('paiement.print.id');


    });
    Route::prefix('chart')->group(function () {
        Route::get('/chartjs', [App\Http\Controllers\Backend\enfant\ChartController::class, 'ChartJs'])->name('chart.js');
        Route::get('/EnfantChart', [App\Http\Controllers\Backend\enfant\ChartController::class, 'EnfantChart'])->name('enfant.chart.js');
        Route::get('/ChargeChart', [App\Http\Controllers\Backend\enfant\ChartController::class, 'ChargeChart'])->name('charge.chart.js');
        Route::get('/EmployeChart', [App\Http\Controllers\Backend\enfant\ChartController::class, 'EmployeChart'])->name('employe.chart.js');
        Route::get('/PrintChartEnfant', [App\Http\Controllers\Backend\enfant\ChartController::class, 'EnfantChartPrint'])->name('enfant.chart.print');
        Route::get('/EmployeeChartPrint', [App\Http\Controllers\Backend\enfant\ChartController::class, 'EmployeeChartPrint'])->name('employe.chart.print');
        Route::get('/ChartPrint', [App\Http\Controllers\Backend\enfant\ChartController::class, 'ChartPrint'])->name('chart.print');
        Route::get('/ChargePrint', [App\Http\Controllers\Backend\enfant\ChartController::class, 'ChargePrint'])->name('charge.chart.print');






    });
});
