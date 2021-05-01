<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/email','EmailController@index')->name('email.index');

    //at the national level
    Route::group(['middleware'=>['IsAdmin']],function (){
        Route::prefix('admin')->group(function (){
            Route::resource('/dashboard','National\RegionDashboardController');
            Route::resource('/users','National\AdminUsersController');
            Route::resource('/Anonymous','National\AnonymousAdminsController');
            Route::resource('/searchPost','National\AdminCategoriesController');
            Route::resource('/region','National\RegionController');
            Route::resource('/area','National\AreaController');
            Route::resource('/district','National\DistrictController');
            Route::resource('/locals','National\LocalsController');
            Route::resource('nationalSms','National\NationalSMSController');
            Route::resource('viewLocals','National\NationalViewLocalMembersController');
            Route::resource('adminLocals','National\nationAdminCategoris');
        });
        Route::prefix('area/search')->group(function (){
            Route::get('/','National\FindAreaDistrictAndLocalController@area')->name('NareaSearch');
            Route::post('/','National\FindAreaDistrictAndLocalController@area')->name('NareaSearch');
        });
        Route::prefix('district/search')->group(function (){
            Route::get('/','National\FindAreaDistrictAndLocalController@district')->name('NdistrictSearch');
            Route::post('/','National\FindAreaDistrictAndLocalController@district')->name('NdistrictSearch');
        });
        Route::prefix('Locals/search')->group(function (){
            Route::get('/','National\FindAreaDistrictAndLocalController@locals')->name('NLoclsSearch');
            Route::post('/','National\FindAreaDistrictAndLocalController@locals')->name('NLocalsSearch');
        });
        Route::prefix('nationalLocalSearch')->group(function (){
            Route::post('/','National\NationalLocalSearchController@store')->name('nationalLocalSearch');
            Route::get('/','National\NationalLocalSearchController@store')->name('nationalLocalSearch');
        });
        Route::prefix('nationalAttendances')->group(function (){
            Route::get('/{id}','National\NationalLocalSearchController@index')->name('nationalAttendance');
            Route::post('/','National\NationalLocalSearchController@indexpost')->name('nationalAttendancePost');
        });
        Route::prefix('nationalAudit')->group(function (){
            Route::get('/','National\NationalLocalSearchController@nationalaudit')->name('nationalauditLogin');
            Route::get('/{id}','National\NationalLocalSearchController@audit')->name('nationalAudit');
        });
        Route::prefix('/national/empty/')->group(function (){
            Route::post('/trail','National\NationalLocalSearchController@empty')->name('emptyTrail');
            Route::get('/all','National\NationalLocalSearchController@empty2')->name('allEmptyTrail2');
            Route::post('/all','National\NationalLocalSearchController@empty2')->name('emptyTrail2');
        });

        Route::resource('users/admin','National\AdminEditUsersController');
        Route::resource('swapping','National\swapController');
        Route::resource('DistrictSwapping','National\districtSwappController');
        Route::resource('AreaSwapping','National\AreaSwappController');

        Route::prefix('circulating')->group(function (){
            Route::post('/posting','National\PostRegionCircularController@store')->name('regioncircular.store');
            Route::get('/posting/{id}','National\PostRegionCircularController@delete')->name('regioncircularDelete');
            Route::get('/districtCircular','National\PostCircularToDistrictController@index')->name('districtCircular.index');
            Route::post('/districtCircular/create','National\PostCircularToDistrictController@store')->name('districtCircular.store');

            Route::get('/NatDCircular','National\PostCircularToDistrictController@district')->name('NatDCircular');
            Route::get('/NatDCircular/{id}','National\PostCircularToDistrictController@districtshow')->name('NatDCircularS');
            Route::post('/NatDCircularP','National\PostCircularToDistrictController@districtPost')->name('NatDCircularP');
            Route::get('/NatDCircularP/{id}','National\PostCircularToDistrictController@districtPostD')->name('NatDCircularPD');


            Route::get('/NatACircular','National\PostCircularToDistrictController@area')->name('NatACircular');
            Route::get('/NatACircular/{id}','National\PostCircularToDistrictController@area')->name('NatACircularS');
            Route::post('/NatACircularP','National\PostCircularToDistrictController@areaPost')->name('NatACircularP');
            Route::get('/NatACircularPD/{id}','National\PostCircularToDistrictController@areadelete')->name('NatACircularPD');


            Route::get('/NatLCircular','National\PostCircularToDistrictController@locals')->name('NatLCircular');
            Route::get('/NatLCircular/{id}','National\PostCircularToDistrictController@localsshow')->name('NatLCircularS');
            Route::post('/NatLCircularP','National\PostCircularToDistrictController@localsPost')->name('NatLCircularP');
            Route::get('/NatLCircularPD/{id}','National\PostCircularToDistrictController@localDelete')->name('NatLCircularPD');



            Route::get('/circular/posting','National\PostRegionCircularController@index')->name('regioncircular.index');
            Route::get('/circular/posting/{id}','National\PostRegionCircularController@show')->name('regioncircularN');
            Route::post('/circular/posting','National\PostRegionCircularController@store2')->name('regioncircularP');
        });

        Route::resource('circulation/circularR','National\PostCircularForDistrictAdminsController');
        Route::prefix('/{id}/')->group(function (){
            Route::get('/NationalJan-Feb','National\NationalTitheController@janFeb')->name('janFeb');
            Route::get('/NationalMarch-April','National\NationalTitheController@marApril')->name('marApril');
        });
        Route::prefix('/{id}/')->group(function (){
            Route::get('NationalMay-June','National\NationalTitheController@mayjune')->name('NmayJune');
            Route::get('Nationaljuly-August','National\NationalTitheController@julyAugust')->name('NjulyAugust');
        });
        Route::prefix('/{id}/')->group(function (){
            Route::get('/NationalSeptember-October','National\NationalTitheController@septOctober')->name('NseptOctober');
            Route::get('/NationalNovember-December','National\NationalTitheController@novDecember')->name('NnovDecember');
        });
        Route::prefix('NationalNovember-member')->group(function (){
            Route::get('/{id}/','National\NationalTitheController@member')->name('Nmember');
            Route::post('/','National\NationalTitheController@memberpost')->name('Nmemberpost');
        });
        Route::prefix('NationalFinanceDaily')->group(function (){
            Route::get('/','National\NationalFinanceController@daily')->name('NDaily');
            Route::post('/','National\NationalFinanceController@dailypost')->name('NDailypost');

        });
        Route::prefix('NationalFinanceMonthly')->group(function (){
            Route::get('/','National\NationalFinanceController@monthly')->name('NMonthly');
            Route::post('/','National\NationalFinanceController@monthlypost')->name('NMonthlypost');
        });
        Route::prefix('NationalFinanceRange')->group(function (){
            Route::get('/','National\NationalFinanceController@range')->name('NRange');
            Route::post('/','National\NationalFinanceController@rangepost')->name('NRangepost');

        });
        Route::prefix('NationalFinanceYearly')->group(function (){
            Route::get('/','National\NationalFinanceController@Year')->name('NYear');
            Route::post('/','National\NationalFinanceController@yearlypost')->name('NYearpost');

        });
        Route::prefix('National')->group(function (){
            Route::get('/{id}/Area/FinanceMonthly','National\NationalFinanceAreaController@index')->name('NAreaindex');
            Route::post('/Area/FinanceMonthly-2','National\NationalFinanceAreaController@indexpost')->name('NAreaindexpost');
            Route::get('/{id}/Area/monthly-1/','National\NationalFinanceAreaController@montharea')->name('nationalMonthArea');
            Route::post('/Area/monthly-2/','National\NationalFinanceAreaController@monthareapost')->name('nationalMonthAreapost');
            Route::get('/{id}/Area/yearly/','National\NationalFinanceAreaController@yeararea')->name('nationalYearArea');
            Route::post('/Area/yearly/','National\NationalFinanceAreaController@yearareapost')->name('nationalYearAreaPost');

            Route::get('/{id}/Area/range/','National\NationalFinanceAreaController@range')->name('nationalRangeArea');
            Route::post('/Area/range/','National\NationalFinanceAreaController@rangepost')->name('nationalRangeAreaPost');

            Route::get('/{id}/DistrictF','National\NationalFinanceDistrictController@index')->name('districtNational');
            Route::post('/FinanceDaily/DistrictF','National\NationalFinanceDistrictController@store')->name('NDistrictSend');

            Route::get('/{id}/District/monthly/','National\NationalFinanceDistrictController@montharea')->name('nationalMonthDistricts');
            Route::post('/Area/monthly/','National\NationalFinanceDistrictController@store2')->name('nationalMonthDistrictP');

            Route::get('/{id}/District/yearly/','National\NationalFinanceDistrictController@yeararea')->name('nationalYearDistrict');
            Route::post('/District/yearly/','National\NationalFinanceDistrictController@yearareapost')->name('nationalYearDistrictPost');

            Route::get('/{id}/District/range/','National\NationalFinanceDistrictController@range')->name('nationalRangeDistrict');
            Route::post('/District/range/','National\NationalFinanceDistrictController@store3')->name('nationalRangeDPost');

            //Local Finance
            Route::get('/Locals/{id}','National\NationalFinanceLocalController@daily')->name('natFLocal');
            Route::post('/Locals','National\NationalFinanceLocalController@dailypost')->name('natFLocalPost');

            Route::get('/LocalsMonthly/{id}','National\NationalFinanceLocalController@monthly')->name('natFLocalMonthly');
            Route::post('/LocalsMonthly','National\NationalFinanceLocalController@monthlypost')->name('natFLocalMonthlyPost');

            Route::get('/{id}/LocalsMonthly/year','National\NationalFinanceLocalController@year')->name('natFLocalYearly');
            Route::post('/LocalsMonthly/year','National\NationalFinanceLocalController@yearpost')->name('natFLocalYearlyPost');

            Route::get('/{id}/LocalsRange/Range1','National\NationalFinanceLocalController@range')->name('natFLocalRange1');
            Route::post('/LocalsRange/Range1','National\NationalFinanceLocalController@rangepost')->name('natFLocalRange2');

            //national level finance
            Route::resource('/IncomeNa','National\NationalIncomeController');
            Route::post('/store','National\NationalIncomeStoreController@store')->name('natAddPost');
            Route::resource('/categoryNa','National\NationalIncomeCategoryController');
            Route::resource('/Ex','National\NationalExpenditureController');
            Route::resource('/ExCategory','National\NationalExpenditureCategoryController');
            Route::post('/store2','National\NationalIncomeStoreController@store2')->name('natAddPost2');

        });
        Route::prefix('NationalAreaSearch')->group(function (){
            Route::post('/','National\localSearchNationalController@area')->name('NationalAreaSearch');
            Route::get('/','National\localSearchNationalController@area')->name('NationalAreaSearch');
        });
        Route::prefix('NationalLocalSearch')->group(function (){
            Route::post('/','National\localSearchNationalController@local')->name('NationalLocalSearch');
            Route::get('/','National\localSearchNationalController@local')->name('NationalLocalSearch');
        });
        Route::prefix('NationalDistrictSearch')->group(function (){
            Route::post('/','National\localSearchNationalController@district')->name('NationalDistrictSearch');
            Route::get('/','National\localSearchNationalController@district')->name('NationalDistrictSearch');
        });
        Route::prefix('NationalRSearch')->group(function (){
            Route::post('/','National\localSearchNationalController@national')->name('NationalRSearch');
            Route::get('/','National\localSearchNationalController@national')->name('NationalRSearch');
        });
        Route::prefix('NaAdminsSearchLevel')->group(function (){
            Route::post('/','National\localSearchNationalController@admins')->name('NaAdminsSearchLevel');
            Route::get('/','National\localSearchNationalController@admins')->name('NaAdminsSearchLevel');
        });
        Route::prefix('missingSearch')->group(function (){
            Route::post('/','National\localSearchNationalController@missing')->name('missingSearch');
            Route::get('/','National\localSearchNationalController@missing')->name('missingSearch');
        });
        Route::resource('NationalChart','National\NationalChartRoomController');
    });

    /*
    |--------------------------------------------------------------------------
    |Area level
    |--------------------------------------------------------------------------
    */
    Route::group(['middleware'=>['IsArea']],function (){

        Route::prefix('/areas')->group(function (){
            Route::get('/dashboard','Area\AreaDashboardController@index')->name('areaDashboard.index');
            Route::prefix('create')->group(function (){
                Route::post('/','Area\AreaDashboardController@store')->name('areaUpdate.index');
                Route::post('/local','Area\AreaDashboardController@localstore')->name('arealocal.index');
            });
        });

        Route::get('nationalPdfShow/{id}','Area\AreaPdfShowController@nationalshow')->name('nationalPdfShow');
        Route::post('APCircular','Area\AreaPdfShowController@store')->name('AreaPostCircular');
        Route::get('APCircular','Area\AreaPdfShowController@create')->name('AreaPostCirculars');
        Route::get('APCircularshow/{id}','Area\AreaPdfShowController@areashow')->name('AreaPostCircularshow');
        Route::post('APCircularPost','Area\AreaPdfShowController@areaPost')->name('APCircularPost');
        Route::get('APCircularL','Area\AreaPdfShowController@local')->name('APCircularGetL');
        Route::post('APCircularLP','Area\AreaPdfShowController@localPost')->name('APCircularGetLP');

        Route::get('APCircularL/{id}','Area\AreaPdfShowController@localshow')->name('APCircularGetLI');
        Route::get('APCircularD','Area\AreaPdfShowController@district')->name('APCircularGetD');
        Route::post('APCircularDPost','Area\AreaPdfShowController@districtPost')->name('APCircularGetDP');
        Route::get('APCircularD/{id}','Area\AreaPdfShowController@districtshow')->name('APCircularGetDI');



        Route::prefix('areamembers')->group(function (){
            Route::get('/','Area\PostAreaAccountController@members')->name('areamembers.index');
            Route::get('/children','Area\PostAreaAccountController@children')->name('areaChildren.index');
            Route::get('/NoneActiveChildren','Area\PostAreaAccountController@noneChildren')->name('NoneActiveChildren.index');
        });


        Route::get('/areaNoneActives','Area\PostAreaAccountController@none')->name('areaNoneActives');
        Route::get('/area-audit','Area\PostAreaAccountController@tray')->name('ara-tray');
        Route::post('areaP','Area\AreaAreaPostController@post')->name('areaPost.index');
        Route::get('New/Convert','Area\AreaAreaPostController@convert')->name('newconvert');
        Route::resource('/Area/Admins','Area\AreaAdminsController');

        Route::prefix('Area')->group(function (){
            Route::get('/','Area\AreaAreaPostController@areaAdmins')->name('areaAdmins');
            Route::post('/AreaAdmins/{id}','Area\AreaAreaPostController@update')->name('areaAdminUpdate');

            Route::prefix('Admins')->group(function (){
                Route::get('/Deleting','Area\AreaAreaPostController@destroy1')->name('areaAdminDestroy');
                Route::get('/{id}','Area\AreaAreaPostController@areaAdminsShow')->name('areaAdminsShow');
            });
        });


        Route::prefix('PostedAreaChart')->group(function (){
            Route::get('/','Area\AreaPostedChartController@index')->name('PostedAreaChart');
            Route::post('/','Area\AreaPostedChartController@store')->name('PostedAreaChartPost');
        });

        Route::prefix('PostedLAreaChart')->group(function (){
            Route::post('/','Area\AreaPostedChartController@store2')->name('PostedLAreaChartP');
            Route::get('/{id}','Area\AreaPostedChartController@index2')->name('PostedLAreaChart');
        });

        Route::prefix('PostedMonthlyAreaChart')->group(function (){
            Route::get('/','Area\AreaPostedChartController@monthly')->name('PostedMonthlyAreaChart');
            Route::post('/','Area\AreaPostedChartController@monthlypost')->name('PostedMonthlyAreaChartP');
        });

        Route::prefix('PostedLocalsAreaChart')->group(function (){
            Route::get('/{id}','Area\AreaPostedChartController@locals')->name('PostedLocalAreaChart');
            Route::post('/','Area\AreaPostedChartController@localspost')->name('PostedLocalPAreaChart');
        });

        Route::prefix('PostedYearAreaChart')->group(function (){
            Route::get('/','Area\AreaPostedChartController@year')->name('PostedYearAreaChart');
            Route::post('/','Area\AreaPostedChartController@yearpost')->name('PostedYearAreaChartp');
        });

        Route::prefix('PostedYearLAreaChart')->group(function (){
            Route::get('/{id}','Area\AreaPostedChartController@yearL')->name('PostedYearLAreaChart');
            Route::post('/','Area\AreaPostedChartController@yearpostL')->name('PostedYearLAreaChartp');
        });

        Route::prefix('PostedYearRangeAreaChart')->group(function (){
            Route::get('/','Area\AreaPostedChartController@range')->name('PostedRangeAChart');
            Route::post('/','Area\AreaPostedChartController@yrangepost')->name('PostedyRangePost');
        });

        Route::prefix('PostedYearRangeAreaLChart')->group(function (){
            Route::get('/{id}','Area\AreaPostedChartController@rangeL')->name('PostedRangeALChart');
            Route::post('/','Area\AreaPostedChartController@rangeLpost')->name('PostedRangeALpChart');
        });

        //area attendance
        Route::prefix('AreaAttendance')->group(function (){
            Route::get('/','Area\AreaPostedChartController@attendance')->name('areaAttendance');
            Route::post('/','Area\AreaPostedChartController@attendancepost')->name('areaAttendancePost');
        });

        Route::post('areaP2','Area\AreaAreaPostController@store')->name('areaPost2.index');

        Route::prefix('area')->group(function (){
            Route::resource('/local/updates','Area\AreaLocalController');
            Route::resource('/level','Area\AreaPostController');
            Route::resource('/areaAccount','Area\AreaChurchAccountController');
            Route::resource('/AreaUpMembers','Area\AreaMemebersUpdateController');

        });

        Route::resource('/updating/waiting','Area\AreaUsersUpdatingController');

        Route::resource('/areaShow','Area\AreaShowAccountController');

        Route::post('/areaPost','Area\PostAreaAccountController@year')->name('areaPostYear.index');

        Route::post('/areaYearPrint','Area\PostAreaAccountController@printStatementY')->name('areaYearPrint.index');
        //account section
        Route::resource('/AccountInCArea','Area\AreaCategoryController');

        Route::resource('/AccountInArea','Area\AreaIncomeController');

        Route::resource('/AccountEArea','Area\AreaExpenditureController');

        Route::resource('/AccountECArea','Area\AreaExpenditureCategoryController');

        Route::get('/AreaDailyReport' ,'Area\AreaReportController@dailyReport')->name('areaDailyReport');

        Route::get('/AreaMonthlyReports' ,'Area\AreaReportController@monthlyReport')->name('mreport');

        Route::get('/AreaMidYearReport' ,'Area\AreaReportController@midYearReport')->name('miReport');

        Route::get('/AreaYearlyReport' ,'Area\AreaReportController@yearlyReport')->name('areaYearlyReport');

        Route::resource('/areaTitheChart','Area\AreaTitheChartController');

        //posting of finance
        Route::post('/DailyFinance' ,'Area\FinanceDailyController@store')->name('dailyFinance');

        Route::post('/MonthlyFinance' ,'Area\FinanceDailyController@store2')->name('monthlyFinance');

        Route::post('/YearlyFinance' ,'Area\FinanceDailyController@store3')->name('yearlyFinance');

        Route::resource('/areaTransfer','Area\AreaTransferNotificationController');

    });

    /*
     |--------------------------------------------------------------------------
     |District level
     |--------------------------------------------------------------------------
     */
    Route::group(['middleware'=>['District']],function (){
        Route::prefix('/')->group(function(){
            Route::get('districtDashboard','District\DistrictDashboardController@index')->name('dashboard-d.index');
            Route::get('individualTithe/{id}','District\DistrictDashboardController@index2')->name('districtViTithe');
            Route::get('headquarters/district','District\RegionDistrictController@index')->name('districts.index');
            Route::get('onlyAdmins','District\OnlyAdminsController@index')->name('onlyAdmins.index');
            Route::post('search' ,'District\SearchController@Index')->name('search.index');
            Route::get('LocalMembers/{id}' , 'District\SearchController@locals')->name('search.locals');
            Route::get('LocalMembersChild/{id}' , 'District\SearchController@children')->name('ChildrenMinistry.locals');
            Route::get('DistrictLevelM/{id}' , 'District\SearchController@index2')->name('nonedit');
            Route::get('show/district/individual/{id}' , 'District\ShowIndividualDistrictController@index')->name('individuals.index');
            Route::post('district1/circular','District\DistrictPdfController@index')->name('districtPdf');


            Route::get('district1CircularA','District\DistrictPdfController@area')->name('districtCirArea');
            Route::get('district1CircularA/{id}','District\DistrictPdfController@areaShow')->name('districtCirAreaS');
            Route::post('district1CircularA','District\DistrictPdfController@areaPost')->name('districtCirArea');



            Route::get('district1CircularL','District\DistrictPdfController@locals')->name('districtCirLocals');
            Route::get('district1CircularL/{id}','District\DistrictPdfController@localsShow')->name('districtCirLocalsShow');
            Route::post('district1CircularL','District\DistrictPdfController@localsPost')->name('districtCirLocalsP');




        });
        //district account section
        Route::prefix('/')->group(function(){
            Route::resource('AccountIn','District\DistrictIncomeController');
            Route::resource('AccountInC','District\DistrictIncomeCategoryController');
            Route::resource('AccountE','District\DistrictExpenditureController');
            Route::resource('AccountEC','District\DistrictExpenditureCategoryController');
            Route::resource('DistCMinistry','District\DistrictChildrenMinistryController');
            Route::resource('district1/circular1','District\DistrictCircularController');
            Route::resource('district/addnew','District\DistrictUpCreateController');
            Route::resource('district/messages','District\PostAreaCircularController');
            Route::resource('districtPost','District\RegionDistrictController');
        });
        //errors corrections
        Route::prefix('/')->group(function(){
            Route::get('DistrictErrorsIncome/{id}','District\DistrictErrorsController@incomeErrors')->name('DistrictErrorsIncome');
            Route::get('DistrictExpenseErrors/{id}','District\DistrictErrorsController@expenseErrors')->name('DisExpenseErrors');
        });
        //money report
        Route::prefix('/')->group(function(){
            Route::get('financeDailyReport' ,'District\DistrictMoneyController@daily')->name('financeDailyReport');
            Route::post('financeDailyReportPost' ,'District\DistrictMoneyController@dailypost')->name('financeDailyReports');
            Route::get('financeYearlyReport' ,'District\DistrictMoneyController@yearly')->name('financeYearlyReport');
            Route::post('financeYearlyReportPost' ,'District\DistrictMoneyController@yearlypost')->name('financeYearlyReportpost');
            Route::get('financeMonthlyReport' ,'District\DistrictMoneyController@monthly')->name('financeMonthlyReport');
            Route::post('financeMonthlyReportPost' ,'District\DistrictMoneyController@monthlyPost')->name('financeMonthlyReportPost');
            Route::get('financeMidYearReport' ,'District\DistrictMoneyController@mid')->name('financeMidYearReport');
            Route::get('districtAttendance' ,'District\DistrictMoneyController@attendance')->name('districtAttendance');
            Route::post('districtAttendancePost' ,'District\DistrictMoneyController@attendancepost')->name('districtAttendancepost');
            Route::get('range' ,'District\DistrictMoneyController@range')->name('range');
            Route::post('rangePost' ,'District\DistrictMoneyController@rangepost')->name('rangepost');
        });
        Route::prefix('/')->group(function(){
            Route::post('areaPost' ,'District\PostAreaCController@post')->name('areaPost.index');
            Route::post('areaPostE' ,'District\PostAreaCController@postexpenditure')->name('areaPostE.index');
            Route::get('dailyReport' ,'District\PostAreaCController@dailyReport')->name('dailyReport.index');
            Route::get('ReportRange' ,'District\PostAreaCController@rangeReport')->name('ReportRange');
            Route::post('ReportRangePost' ,'District\PostAreaCController@rangeReportpost')->name('ReportRangePost');
            Route::get('monthlyReport' ,'District\PostAreaCController@monthlyReport')->name('monthlyReport.index');
            Route::get('midYearReport' ,'District\PostAreaCController@midYearReport')->name('midYearReport.index');
            Route::get('yearlyReport' ,'District\PostAreaCController@yearlyReport')->name('yearlyReport.index');
            Route::post('yearlyReport' ,'District\PostAreaCController@yearReportPost')->name('yearReportPostD');
            Route::post('monthlyReport' ,'District\PostAreaCController@psotM')->name('postM.index');
            Route::post('AreaFinance' ,'District\PostAreaCController@anotherdailypsots')->name('anotherdailypsot.index');
        });
        Route::prefix('/')->group(function(){
            Route::get('DistrictChart/{id}','District\DistrictTransferController@index')->name('DistrictChart.index');
            Route::post('DistrictChart/{id}','District\DistrictTransferController@store')->name('DistrictCharts');
            Route::get('DistrictChartRange','District\DistrictTransferController@index2')->name('DistrictChartRa');
            Route::post('DistrictChartRange','District\DistrictTransferController@store2')->name('DistrictChartRs');
        });
        Route::prefix('/')->group(function(){
            Route::get('DistExportingExcel','District\DistrictExportController@members')->name('DistExportingExcel');
        });
    });

    /*
       |--------------------------------------------------------------------------
       |Local level
       |--------------------------------------------------------------------------
       */
    Route::group(['middleware'=>'IsLocal'],function (){

        Route::prefix('/')->group(function(){
            Route::get('mychart', 'Locals\ChartController@index')->name('mychart');

            Route::get('myui', 'Locals\ChartController@index2')->name('mychart');

            Route::resource('dash/local','Locals\DashboardForLocalsController');
            Route::resource('nonactive','Locals\LocalNoneActiveUsersController');
            Route::resource('tithe','Locals\PostTitheController');
            Route::resource('services','Locals\PostServicesController');
            Route::resource('sunday','Locals\PostSundayController');
            Route::resource('income/category','Locals\IncomeCategoryController');
            Route::resource('income','Locals\IncomeController');
            Route::resource('expenditureC','Locals\ExpenditureCategoryController');
            Route::resource('expenditure','Locals\ExpenditureController');
            Route::resource('errorLog','Locals\ErrorLogController');
            Route::resource('localcircular','Locals\PostLocalCircularController');
            Route::resource('attendance','Locals\AttendanceController');
            Route::resource('audit-trail','Locals\AuditTrailController');
            Route::resource('titheCharts','Locals\TitheChartController');
            Route::resource('text','Locals\TextFieldController');
            Route::resource('localSms','Locals\LocalSMSController');
        });
        Route::prefix('/')->group(function(){
            Route::resource('registration','Locals\RegisterLocalMembersController');
            Route::resource('children/ministry','Locals\ChildrenMinistryAtLocalController');
            Route::get('deceased-children','Locals\LocalDeceasedChildrenController@index')->name('deceased-children');
            Route::get('new/transfer','Locals\LocalDeceasedChildrenController@index2')->name('transferLocal');
            Route::get('Release','Locals\LocalDeceasedChildrenController@index3')->name('releases');
        });
        Route::prefix('/')->group(function(){
            Route::post('members-search','Locals\LocalMembersSearchController@store')->name('members-search');
            Route::get('members-search','Locals\LocalMembersSearchController@store')->name('members-search');
            Route::get('storeExcel','Locals\LocalMembersSearchController@storeExcel')->name('storeExcel');
            Route::get('storeExcel2','Locals\LocalMembersSearchController@childrenExcel')->name('childrenExcel');
        });
        Route::prefix('/')->group(function(){
            Route::post('currentSunday','Locals\PostCurrentController@request')->name('current.post');
            Route::post('monthly','Locals\PostMonthlyController@index')->name('monthly.index');
            Route::get('monthly/pdf/{id}','Locals\PostMonthlyController@store')->name('monthlyPdf.index');
            Route::get('year','Locals\PostYearController@index')->name('year.index');
            Route::get('{id}/dailyPdf','Locals\PostYearController@dailyPdf')->name('dailyPdfs');
            Route::post('year/create','Locals\PostYearController@store')->name('year.create');
            Route::post('addIncome','Locals\PostYearController@addIncome')->name('addIncome.index');
            Route::post('addExpenditure','Locals\PostYearController@post')->name('addexpenditure.post');
            Route::get('midyear','Locals\PostYearController@midyear')->name('midyear.index');
            Route::get('midyear/pdf','Locals\PostYearController@midyearpdf')->name('midyearPdf');
            Route::get('year/pdf/{post}','Locals\PostYearController@pdf')->name('year.pdf');
            Route::get('printStatementY/{id}','Locals\PostYearController@printStatementY')->name('printStatementY.pdf');
            Route::get('monthly/pdf','Locals\MonthlyPdfController@index')->name('monthly.pdf');
            Route::get('monthlyStatement/{id}','Locals\MonthlyPdfController@monthlyStatement')->name('monthlyStatement.pdf');

        });
        Route::prefix('/')->group(function(){
            Route::get('national/circular/show','Locals\NationShowCircularController@index')->name('nationalcircular.index');
            Route::get('national/circular/{id}/show','Locals\NationShowCircularController@download')->name('nationalcircular.get');
            Route::post('national/circular/show','Locals\NationShowCircularController@indexpost')->name('storepost');
            Route::get('birthday','Locals\LocalsBirthdayController@index')->name('birthday.index');
            Route::get('deceased','Locals\PostDeceasedController@index')->name('deceased.index');
            Route::get('district/locals/circular','Locals\PostDistrictToLocalCircularController@index')->name('localdistrict.index');
            Route::post('district/locals/circular/post','Locals\PostDistrictToLocalCircularController@indexpost')->name('localdistrictpost.index');
            Route::post('district/localMembers','Locals\PostDistrictToLocalCircularController@store')->name('localMembers');
            Route::get('localPost','Locals\PostDistrictToLocalCircularController@localPost')->name('localPost');
            Route::get('localAreaPost','Locals\PostDistrictToLocalCircularController@area')->name('localAreaPost');
            Route::get('localAreaPost/{id}','Locals\PostDistrictToLocalCircularController@areashow')->name('localAreaPostS');
            Route::post('localAreaPost','Locals\PostDistrictToLocalCircularController@areaPost')->name('localAreaPostP');

            Route::post('attendancePost','Locals\PostAttendanceController@attendance')->name('attendancePost');
            Route::get('attendExcel','Locals\PostAttendanceController@attendExcel')->name('attendExcel');
            Route::get('dailyAttendance','Locals\PostAttendanceController@dailyAttendance')->name('dailyAttendance');
            Route::post('dailyAttendancePost','Locals\PostAttendanceController@dailyAttendancePost')->name('dailyAttendancePost');
            Route::get('dailyAttendanceExcel/{id}','Locals\PostAttendanceController@dailyAttendanceExcel')->name('dailyAttendanceExcel');

        });
        Route::prefix('/')->group(function(){
            Route::get('titheStatement','Locals\TitheController@store')->name('titheStatement');
            Route::get('March-April','Locals\TitheController@month')->name('titheMonthStatement');
            Route::get('january-February','Locals\TitheController@JF')->name('titheYearStatement');
            Route::post('january-February','Locals\TitheController@JanuaryPost')->name('januaryFebruary');
            Route::get('May-June','Locals\TitheController@mayjune')->name('mayJune');
            Route::get('july-August','Locals\TitheController@julyAugust')->name('julyAugust');
            Route::post('july-August','Locals\TitheController@julyAugustPost')->name('julyAugustPost');
            Route::get('September-October','Locals\TitheController@septOctober')->name('septOctober');
            Route::post('September-October','Locals\TitheController@septOctoberPost')->name('septOctoberPost');
            Route::get('November-December','Locals\TitheController@novDecember')->name('novDecember');
            Route::post('November-December','Locals\TitheController@novDecemberPost')->name('novDecemberPost');
            Route::get('excelJanuary-Feb/{id}','Locals\TitheController@excel')->name('excel');
            Route::get('excelMarch-April/{id}','Locals\TitheController@excelMA')->name('excelMA');
            Route::post('excelMarch-April-Post','Locals\TitheController@excelMApost')->name('excelMAPost');
            Route::get('excelMay-June/{id}','Locals\TitheController@excelMJ')->name('excelMJ');
            Route::post('excelMay-June-Post','Locals\TitheController@excelMJpost')->name('excelMJPost');
            Route::get('excelJuly-August/{id}','Locals\TitheController@excelJA')->name('excelJA');
            Route::get('excelSep-October{id}','Locals\TitheController@excelSO')->name('excelSO');
            Route::get('excelNov-December{id}','Locals\TitheController@excelND')->name('excelND');
            Route::get('titheStatementPost','Locals\TitheController@midyear')->name('titheMidYearStatement');
            Route::post('titheStatementPost','Locals\TitheController@storepost')->name('titheStatementpost');
            Route::post('titheStatementsPost','Locals\TitheController@monthpost')->name('titheMonthStatementpost');
            Route::post('titheStatementYPost','Locals\TitheController@yearpost')->name('titheYearStatementpost');
            Route::post('titheSearch','Locals\SearchTitheController@search')->name('searchTithe');
        });
        //excel export data to database
        Route::prefix('/')->group(function(){
            Route::post('excelData','Locals\TitheController@data')->name('excelData');
            Route::get('titheSearch','Locals\SearchTitheController@search')->name('searchTithe');
            Route::get('localIndividualT/{id}','Locals\ShowIndividualTitheAtLocalController@index')->name('localIndividualT');
            Route::post('postdateTithes','Locals\ShowIndividualTitheAtLocalController@index2')->name('postdateTithe');
            Route::get('donation/pledge','Locals\DonationAndPledgeController@index')->name('donation/Pledge');
            Route::post('donation/pledge','Locals\DonationAndPledgeController@post')->name('donation/Pledges');
            Route::get('onlyDonation','Locals\DonationAndPledgeController@onlyD')->name('onlyDonation');
            Route::post('onlyDonationPost','Locals\DonationAndPledgeController@onlyDpost')->name('onlyDonationPost');
            Route::get('onlyPledge','Locals\DonationAndPledgeController@onlyP')->name('onlyPledge');
            Route::post('onlyPledgePost','Locals\DonationAndPledgeController@onlyPpost')->name('onlyPledgePost');
            Route::post('donation/pledgeSearch','Locals\DonationAndPledgeController@search')->name('donation/pledgeSearch');
            Route::post('titheChartsRange','Locals\TitheChartController@store2')->name('titheChart-store');
        });
    });

    Route::group(['middleware'=>'Individual'],function (){

        Route::resource('/MDTithe','Individuals\IndividualDashboardController');

        Route::get('NaAnnouncement','Individuals\individualCircularController@index')->name('membersAnnouncement');

        Route::post('NaAnnouncement','Individuals\individualCircularController@store')->name('membersAnnouncementpost');

        Route::get('NaAnnouncement/{id}','Individuals\individualCircularController@showPdf')->name('membersAGet');

        Route::get('ChAnnouncement','Individuals\individualCircularController@tolocal')->name('tolocalAnnouncement');

        Route::get('ChAnnouncement/{id}','Individuals\individualCircularController@tolocalshow')->name('tolocalAnnouncements');

        Route::post('ChAnnouncement','Individuals\individualCircularController@store2')->name('tolocalAnnouncementpost');

        Route::get('password-reset','Individuals\individualCircularController@store3')->name('password-reset');

        Route::post('password-reset','Individuals\individualCircularController@store4')->name('password-resetpost');

        Route::get('DaAnnoun','Individuals\individualCircularController@district')->name('membersAnnouncementD');

        Route::post('DaAnnounP','Individuals\individualCircularController@districtPost')->name('membersAnnouncementDP');

        Route::get('DaAnnoun/{id}','Individuals\individualCircularController@districtshow')->name('membersAnnouncementDS');

        Route::get('AaAnnoun','Individuals\individualCircularController@area')->name('membersAnnouncementA');

        Route::post('AaAnnounP','Individuals\individualCircularController@areaPost')->name('membersAnnouncementAP');

        Route::get('AaAnnoun/{id}','Individuals\individualCircularController@areashow')->name('membersAnnouncementAS');

        Route::get('birthdayDaily','Individuals\individualCircularController@birthdayDaily')->name('birthdayDaily');

        Route::get('birthdayMonth','Individuals\individualCircularController@birthdayMonth')->name('birthdayMonth');

        Route::get('IndividualProfile','Individuals\individualCircularController@profile')->name('IndividualProfile');




    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
