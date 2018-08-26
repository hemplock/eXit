<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'DashboardController@index')->name('home');

    Route::get('/etx/tx/{hash}/{type}', 'EthController@readTransaction')
        ->name('tx.render')
        ->where('hash', '\d{1}x.+');

    Route::get('farmer/{farmer}/check-data-identity', 'FarmerController@checkDataIdentity')->name('farmer.check-data-identity');
    Route::post('farmer/{farmer}/hack', 'FarmerController@hackUpdate')->name('farmer.hack');
    Route::resource('farmer', 'FarmerController',[
        'only' => ['index', 'show', 'create', 'store', 'update', 'edit'],
    ]);
    Route::get('farmer/{farmer}/file/{file}/download','FarmerController@download')
        ->name('farmer.download');
    Route::resource('farmer/{farmer}/harvest', 'HarvestContorller',[
        'only' => ['index', 'show', 'create', 'store'],
    ]);
    Route::get('farmer/email/validate', function(Illuminate\Http\Request $request){

        $email = trim( array_get( $request->query('farmer',[]), 'email' ));
        //john.way@way-farmers-group.com
        $farmerID = trim($request->query('farmer_id'));

        $count = \App\Models\Farmer::where('email',  $email);
        if($farmerID){
            $count->where('id', '<>', $farmerID);
        }

        $count = $count
            ->get()
            ->count();

        return  $count > 0 ? "false"  : "true";
    })->name('farmer.validate');

    Route::get('tester/{tester}/check-data-identity', 'TesterController@checkDataIdentity')->name('tester.check-data-identity');
    Route::post('tester/{tester}/hack', 'TesterController@hackUpdate')->name('tester.hack');
    Route::resource('tester', 'TesterController',[
        'only' => ['index', 'show', 'create', 'store', 'update', 'edit'],
    ]);
    Route::get('tester/{tester}/file/{file}/download','TesterController@download')
        ->name('tester.download');
    Route::resource('tester/{tester}/harvest', 'HarvestContorller',[
        'only' => ['index', 'show', 'create', 'store'],
    ]);
    Route::get('tester/email/validate', function(Illuminate\Http\Request $request){

        $email = trim( array_get( $request->query('tester',[]), 'email' ));
        //john.way@way-testers-group.com
        $testerID = trim($request->query('tester_id'));

        $count = \App\Models\Tester::where('email',  $email);
        if($testerID){
            $count->where('id', '<>', $testerID);
        }
        $count = $count
            ->get()
            ->count();
        return  $count > 0 ? "false"  : "true";
    })->name('tester.validate');

    //Route::get('sponsor/{sponsor}/check-data-identity', 'SponsorController@checkDataIdentity')->name('sponsor.check-data-identity');
    //Route::post('sponsor/{sponsor}/hack', 'SponsorController@hackUpdate')->name('sponsor.hack');
    //Route::resource('sponsor', 'SponsorController',[
    //    'only' => ['index', 'show', 'create', 'store', 'update', 'edit'],
    //]);
    Route::get('sponsor/{sponsor}/file/{file}/download','SponsorController@download')
        ->name('sponsor.download');
    Route::resource('sponsor/{sponsor}/harvest', 'HarvestContorller',[
            'only' => ['index', 'show', 'create', 'store'],
    ]);
            Route::get('sponsor/email/validate', function(Illuminate\Http\Request $request){

                $email = trim( array_get( $request->query('sponsor',[]), 'email' ));
                //john.way@way-testers-group.com
                $sponsorID = trim($request->query('sponsorr_id'));

                $count = \App\Models\Sponsor::where('email',  $email);
                if($sponsorID){
                    $count->where('id', '<>', $sponsorID);
                }
                $count = $count
                    ->get()
                    ->count();

                return  $count > 0 ? "false"  : "true";
            })->name('sponsor.validate');

//Route::get('certifier/{certifier}/check-data-identity', 'CertifierController@checkDataIdentity')->name('certifier.check-data-identity');
    //Route::post('certifier/{certifier}/hack', 'CertifierController@hackUpdate')->name('certifier.hack');
    //Route::resource('certifier', 'CertifierController',[
        //'only' => ['index', 'show', 'create', 'store', 'update', 'edit'],
        //]);

    Route::get('certifier/{certifier}/file/{file}/download','CertifierController@download')
        ->name('certifier.download');
    Route::resource('certifier/{certifier}/harvest', 'HarvestContorller',[
        'only' => ['index', 'show', 'create', 'store'],
    ]);
        Route::get('certifier/email/validate', function(Illuminate\Http\Request $request){

            $email = trim( array_get( $request->query('certifier',[]), 'email' ));
            //john.way@way-certifiers-group.com
            $certifierID = trim($request->query('certifier_id'));

            $count = \App\Models\Certifier::where('email',  $email);
            if($certifierID){
                $count->where('id', '<>', $certifierID);
            }

            $count = $count
                ->get()
                ->count();

            return  $count > 0 ? "false"  : "true";
        })->name('certifier.validate');

    Route::resource('lab','LabController',[
        'only' => ['index', 'show', 'create', 'store'],
    ]);
    Route::get('lab/{lab}/file/{file}/download','LabController@download')->name('lab.download');

    Route::resource('lab/{lab}/expertise', 'ExpertiseController',[
        'only' => ['index', 'show', 'create', 'store'],
    ]);
    Route::resource('pharm','PharmController',[
            'only' => ['index', 'show', 'create', 'store'],
        ]);
    Route::get('pharm/{pharm}/file/{file}/download','PharmController@download')->name('pharm.download');
    Route::get('transaction', 'TransactionController@index')->name('transaction.index');
    Route::get('harvest_list', 'HarvestContorller@indexList')->name('harvest.list');
    Route::get('expertise_list', 'ExpertiseController@indexList')->name('expertise.list');
    Route::get('drop', 'RecoveryController@drop')->name('drop');
    Route::get('recovery', 'RecoveryController@recovery')->name('recovery');
});

Route::get('/harvest/label/{uid}', 'QRController@labelHarvest')->name('qr.hLabel');
Route::get('/expertise/label/{uid}', 'QRController@labelExpertise')->name('qr.eLabel');


Auth::routes();

Route::get('verify/token/{token}', 'Auth\VerificationController@verify')->name('auth.verify');
Route::get('verify/resend', 'Auth\VerificationController@resend')->name('auth.resend');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
