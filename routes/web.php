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

Auth::routes();
Route::post("/login","Auth\LoginController@index");
Route::get("/logout","Auth\LoginController@logout");

Route::get('system/setup','SystemSetupController@create');
Route::post('system/setup','SystemSetupController@store');
Route::get('/system/administrator','HomeController@setup_administrator');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


Route::get('region/district/{district}/information','RegionController@district');
Route::get('region/{region}/information','RegionController@show');


Route::group(['middleware' => ['permission:Add Role']], function () {
    Route::get('/roles/new/','RolesAndPermissionsController@create')->name('role.create');
    Route::post('/roles/new/','RolesAndPermissionsController@store')->name('role.store');
});
Route::group(['middleware' => ['permission:Read Role']], function () {
    Route::get('/roles','RolesAndPermissionsController@index')->name('role.index');
    Route::get('/roles/list','RolesAndPermissionsController@rolelist');
});
Route::group(['middleware' => ['permission:Edit Role']], function () {
    Route::post('/role/edit','RolesAndPermissionsController@update');
});
Route::group(['middleware' => ['permission:Edit Role']], function () {
    Route::post('/role/delete','RolesAndPermissionsController@destroy');
});
Route::group(['middleware' => ['permission:Assign Permission']], function () {
    Route::get('/role/{role}/permissions','RolesAndPermissionsController@permissions')->name('role.permission');
    Route::post('/role/{role}/permissions','RolesAndPermissionsController@assign_role_permissions');
});

//event 
Route::get('/event/types/','EventController@types')->name('event.types');
Route::get('/events/','EventController@index')->name('event.index');
Route::get("/event/types/list","EventController@eventtypelist");
Route::get('/event/types/new','EventController@createeventtype');
Route::post("/event/types/new","EventController@addeventtype");
Route::post("/event/types/{eventtype}/edit","EventController@updateeventtype");
Route::post("/event/types/{eventtype}/delete","EventController@deleteeventtype");
Route::get("/event/list","EventController@eventlist");
Route::get("/event/new","EventController@create");
Route::post("/event/new","EventController@store");
Route::get("/event/{event}","EventController@show");
//staff
Route::group(['middleware' => ['permission:Add Staff']], function () {
    Route::get('/staff/new/','HomeController@create')->name('staff.create');
    Route::post('/staff/new/','HomeController@store');
});
Route::group(['middleware' => ['permission:Read Staff']], function () {
    Route::get('/staffs/','HomeController@staffs')->name('staff.index');
    Route::get('/staff/list','HomeController@staff_lists');
    Route::get('/staff/{staff}/profile','HomeController@show')->name('staff.profile');
});
Route::get("/profile","HomeController@profile");
Route::group(['middleware' => ['permission:Assign Role']], function () {
    Route::get('/staff/{staff}/roles','HomeController@roles')->name('staff.roles');
    Route::post('/staff/{staff}/roles','HomeController@assign_roles');
});
Route::group(['middleware' => ['permission:Edit Staff']], function () {
    Route::post('/staff/phone/{phone}/edit','HomeController@editphone');
    Route::post('/staff/phone/{phone}/delete','HomeController@deletephone');
    Route::post('/staff/{staff}/email/new','HomeController@addEmailAddress');
    Route::post('/staff/{staff}/phone/new','HomeController@addPhoneNumber');
    Route::post('/staff/email/{mail}/delete','HomeController@deletemail');
});
Route::get('/reset/password','HomeController@resetpassword');
Route::post('/reset/password','HomeController@update_account_password');
//client
Route::group(['middleware' => ['permission:Add Client']], function () {
    Route::get('/client/new/','ClientsController@create')->name('client.create');
    Route::post('/client/new/','ClientsController@store')->name('client.store');
});
Route::group(['middleware' => ['permission:Read Client']], function () {
    Route::get('/clients/','ClientsController@index')->name('client.index');
    Route::get('/clients/list','ClientsController@client_list');
    Route::get('/client/{client}/profile','ClientsController@show')->name('client.profile');
});

//member
Route::group(['middleware' => ['permission:Add Member']], function () {
    Route::get('/member/new/','MemberController@create')->name('member.create');
    Route::get('/member/new/{institution}','MemberController@create_instutition_member')->name('institution.member.create');
    Route::post('/member/new/','MemberController@store');
    Route::post('/member/new/import','MemberController@import');
    Route::get('{member}/remove/account','MemberController@destroy');
    
    //download
    Route::get('download/add_member_template','MemberController@download_template');
});
Route::group(['middleware' => ['permission:Read Member']], function () {
    Route::get('/members/','MemberController@index')->name('member.index');
    Route::get('/member/{member}/profile','MemberController@show')->name('member.profile');
    Route::get('/members/list','MemberController@list');
    Route::get('/question/{member}/answered','QuestionnaireController@questions_answered');
    Route::get('question/{member}/answered/report/{report}','QuestionnaireController@questions_answered_report');
    Route::get('/{member}/institutions/list','MemberController@institutions');
    Route::get('/member/{member}/institutions/add','InstitutionsController@add_member_institution');
    Route::post('/member/{member}/institutions/add','InstitutionsController@add_member_institutions');
    Route::get('/member/{member}/institutions/add/list','InstitutionsController@add_member_institution_list');
    Route::get('/member/{member}/question/set/{questionset}','QuestionnaireReport@create');
});
Route::get('/{member}/institutions/report/{report}','MemberController@institution_report');
Route::post('member/{member}/token','MemberController@generate_token');
//institution
Route::group(['middleware' => ['permission:Add Institution']], function () {
    Route::get('/institution/new/','InstitutionsController@create')->name('institution.create');
    Route::post('/institution/new/','InstitutionsController@store');
    Route::post('/institution/{institution}/generate/token','InstitutionsController@generateToken');
});
Route::get("institution/{institution}/delete","InstitutionsController@destroy");
Route::group(['middleware' => ['permission:Read Institution']], function () {
    Route::get('/institutions/','InstitutionsController@index')->name('institution.index');
    Route::get('/institutions/list','InstitutionsController@list');
    Route::get('/institution/{institution}/profile','InstitutionsController@show')->name('institution.profile');
    Route::get('/institution/{institution}/members','InstitutionsController@members');
    Route::post('institution/{institution}/member/remove','InstitutionsController@remove_member');
});

Route::get('/institution/{institution}/members/report/{report}','InstitutionsController@member_report');
Route::get('/institution/{institution}/token/download','InstitutionsController@download_token');
//guardians
Route::get('/guardians','GuardianController@index')->name('guardians.index');
Route::get('/guardian/list','GuardianController@list');
Route::get('/guardian/{guardian}/profile','GuardianController@show');
Route::get('/guardian/{guardian}/wards','GuardianController@wards');
Route::post('/guardian/{guardian}/edit','GuardianController@edit');
//personalities
Route::group(['middleware' => ['permission:Add Personalities']], function () {
    Route::get('/personality/new','PersonalityController@create')->name('personality.create');
    Route::post('/personality/new','PersonalityController@store');
});
Route::group(['middleware' => ['permission:Read Personalities']], function () {
    Route::get('/personalities','PersonalityController@index')->name('personality.index');
    Route::get('/personalities/list','PersonalityController@list');
});
Route::group(['middleware' => ['permission:Edit Personalities']], function () {
    Route::get('/personalities/{personality}/edit','PersonalityController@edit');
    Route::post('/personalities/{personality}/edit','PersonalityController@update');
});
Route::group(['middleware' => ['permission:Read Personality Course']], function () {
    Route::get('/personalities/{personality}/courses','PersonalityController@courses')->name('personality.courses');
    Route::get('/personalities/{personality}/courses/list','PersonalityController@courses_list');
});
Route::group(['middleware' => ['permission:Add Personality Course']], function () {
    Route::get('/personalities/{personality}/courses/new','PersonalityController@courses_new');
    Route::post('/personalities/{personality}/courses/new','PersonalityController@courses_add');
});

//career paths
Route::group(['middleware' => ['permission:Read Career Path']], function () {
    Route::get('/personalities/{personality}/career/path','PersonalityController@career_path');
    Route::get('/personalities/{personality}/career/path/list','PersonalityController@career_path_list');
});
Route::group(['middleware' => ['permission:Add Career Path']], function () {
    Route::get('/personalities/{personality}/career/path/new','PersonalityController@career_path_new');
    Route::post('/personalities/{personality}/career/path/new','PersonalityController@career_path_save');
});
Route::group(['middleware' => ['permission:Edit Career Path']], function () {
    Route::post('/career/path/{careerpath}/edit','PersonalityController@career_path_edit');
});
Route::group(['middleware' => ['permission:Delete Career Path']], function () {
    Route::post('/career/path/{careerpath}/delete','PersonalityController@career_path_delete');
});
Route::group(['middleware' => ['permission:Read Related Career']], function () {
    Route::get('/personalities/{personality}/career/path/{careerpath}','PersonalityController@related_career');
    Route::get('/personalities/{personality}/career/path/{careerpath}/list','PersonalityController@related_career_list');
});
Route::group(['middleware' => ['permission:Add Related Career']], function () {
    Route::get('/personalities/{personality}/career/path/{careerpath}/new','PersonalityController@career_path_careers_new');
    Route::post('/personalities/{personality}/career/path/{careerpath}/new','PersonalityController@career_path_careers_save');
});
Route::group(['middleware' => ['permission:Edit Related Career']], function () {
    Route::post('/related/career/{career}/edit','PersonalityController@edit_career');
});
Route::group(['middleware' => ['permission:Delete Related Career']], function () {
    Route::post('/related/career/{career}/delete','PersonalityController@delete_career');
});

//questions
Route::group(['middleware' => ['permission:Add Setup Question']], function () {
    Route::get('/questions/setup/new','QuestionSetupController@setup')->name('question.setup');
    Route::post('/questions/setup/new','QuestionSetupController@save_setup');
});
Route::group(['middleware' => ['permission:Read Setup Question']], function () {
    Route::get('/questions/setup','QuestionSetupController@index')->name('question.index');
    Route::get('/questions/setup/list','QuestionSetupController@question_setup_list');
});
Route::group(['middleware' => ['permission:Edit Setup Question']], function () {
    Route::post('/question/setup/{questionsetup}/edit','QuestionSetupController@setup_update');
});
Route::group(['middleware' => ['permission:Delete Setup Question']], function () {
    Route::post('/question/setup/{questionsetup}/delete','QuestionSetupController@setup_delete');
});
Route::group(['middleware' => ['permission:Read Question']], function () {
    Route::get('/questions/setup/{questionsetup}/questions','QuestionSetupController@questions');
    Route::get('/questions/setup/{questionsetup}/questions/list','QuestionSetupController@question_lists');
});
Route::group(['middleware' => ['permission:Add Question']], function () {
    Route::get('/questions/setup/{questionsetup}/questions/new','QuestionSetupController@create');
    Route::post('/questions/setup/{questionsetup}/questions/new','QuestionSetupController@store');
});
Route::group(['middleware' => ['permission:Edit Question']], function () {
    Route::post('/questions/{question}/edit','QuestionSetupController@update');
});
Route::group(['middleware' => ['permission:Delete Question']], function () {
    Route::post('question/{question}/delete','QuestionSetupController@destroy');
});
Route::get('institution/{institution}/marking/scheme','InstitutionsController@marking_scheme');
Route::get('institution/{institution}/marking/scheme/add','InstitutionsController@setup_marking_scheme');
Route::post('institution/{institution}/marking/scheme/add','InstitutionsController@add_marking_scheme');
//terminal report
Route::get('/member/{member}/question/{question}/terminal/report','TerminalReportController@index');
Route::post('/terminal/report/{question}','TerminalReportController@save_setup');
Route::get('/terminal/{terminal}/report/generate','TerminalReportController@create');
Route::post('/terminal/{terminal}/report/save','TerminalReportController@store');
//survey
Route::get('/{institution}','QuestionnaireController@index');
Route::post('/{institution}','QuestionnaireController@store');
Route::get('/{institution}/instructions','QuestionnaireController@instructions');
Route::post('/{institution}/instructions','QuestionnaireController@to_questions');
Route::get('/{institution}/questions','QuestionnaireController@create');
Route::post('/{institution}/questions','QuestionnaireController@answers');
Route::get('/{institution}/success','QuestionnaireController@success');


//report
Route::get('/report/setup','ReportController@create')->name('report.setup');
Route::post('/report/setup','ReportController@store');
Route::get('/report/{report}/generated','ReportController@show');
Route::get('/report/{report}/generated/search/{search}','ReportController@search');
Route::get('/report/{report}/members/list','ReportController@members_list');
Route::get('/report/{report}/institutions/list','ReportController@institution_list');
Route::get('/report/{report}/guardians/list','ReportController@guardian_list');
Route::get('/report/{report}/question/setup/list','ReportController@question_setup_list');
Route::get('/report/{report}/statistics','ReportController@report_statistics');
Route::get('/report/{report}/statistics/list','ReportController@report_statistics_list');
