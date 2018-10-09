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

Route::get('/approved', function(){
	return view('emails.approved');
});	
Route::get('/', 'DashboardController@index')->name('/');
Route::get('/.getdashboard', ['as'=>'/.getdashboard','uses'=>'DashboardController@getdashboard']);
Route::post('/registeruser', 'DashboardController@register');
Route::get('/approve_appliedconference/{id}', 'AppliedConferenceController@ApproveAppliedConference');
Route::get('/reject_appliedconference/{id}', 'AppliedConferenceController@RejectAppliedConference');
Route::post('/reject_appliedconference/{id}', 'AppliedConferenceController@RejectAppliedConferencePost');
Route::get('/manager_approve_appliedconference/{link}', 'AppliedConferenceController@managerApproveAppliedConference');
Route::get('/manager_reject_appliedconference/{link}', 'AppliedConferenceController@managerRejectAppliedConference');
Route::post('/manager_reject_appliedconference/{link}', 'AppliedConferenceController@managerRejectAppliedConferencePost');
Route::get('/conferencelist', 'ConferenceController@conferenceList');
Route::get('/approveapplied/{id}', 'AppliedConferenceController@approve');
Route::get('/rejectapplied/{id}', 'AppliedConferenceController@reject');

Route::get('/addnew', 'DashboardController@addnew');
Route::post('/addnew', ['as'=>'addnew.store','uses'=>'DashboardController@addnewPost']);

Route::get('/apply/{id}', 'DashboardController@apply');
Route::post('/apply', ['as'=>'apply.store','uses'=>'DashboardController@applyPost']);

Route::get('/leadslist', 'DashboardController@leadslist');
Route::get('/leadslist/getdata', ['as'=>'leadslist.getdata','uses'=>'DashboardController@getdata']);

Route::get('/pastconference', ['uses'=>'ConferenceController@pastconference']);
Route::get('/pastconference/getpast', ['as'=>'pastconference.getpast','uses'=>'ConferenceController@getpast']);

Route::get('/postconferencepagelist', ['uses'=>'ConferenceController@postConferencePageList']);
Route::get('/postconferencepagelist/getpost', ['as'=>'postconferencepagelist.getpost','uses'=>'ConferenceController@getpostConferencePageList']);

Auth::routes();

Route::post('/relativesearch', array('middleware' => 'cors', 'uses' => 'SearchController@relativeSearch'));
Route::get('/getrelatedconf', 'DashboardController@getRelatedConf');
Route::get('/getrelateduser', 'DashboardController@getRelatedUser');

Route::get('/home', 'ConferenceController@index');
Route::get('/home/gethome', ['as'=>'home.gethome','uses'=>'ConferenceController@gethome']);
Route::get('/listviews', ['uses'=>'ApproveFormController@listview']);
Route::get('/listviews/getlist', ['as'=>'listviews.getlist','uses'=>'ApproveFormController@getlist']);
Route::get('/home/statuschange', 'ConferenceController@changeStatus');
Route::get('/edit/{id}', 'ConferenceController@edit');
Route::post('/edit/{id}', 'ConferenceController@update');
Route::get('/delete/{id}', 'ConferenceController@delete');
Route::get('/approvereject', 'ApproveFormController@approvereject');
Route::get('/approvereject/pending_list', 'ApproveFormController@approverejectPendingList');
Route::get('/approveform/{id}', array('middleware' => 'cors', 'uses' => 'ApproveFormController@approve'));
Route::get('/rejectform/{id}', array('middleware' => 'cors', 'uses' => 'ApproveFormController@reject'));
Route::get('/access_token', 'SalesforceController@init');

Route::get('/current/conferencelist', ['as'=>'current.conferencelist','uses'=>'ConferenceController@getCurrentConferenceList']);
Route::get('/lastyear/conferencelist', ['as'=>'lastyear.conferencelist','uses'=>'ConferenceController@getLastYearConferenceList']);
Route::get('/pastlastyear/conferencelist', ['as'=>'pastyear.conferencelist','uses'=>'ConferenceController@getPastYearConferenceList']);

Route::get('/clearcookie', 'DashboardController@clearCookie');
Route::post('/saveleads', 'DashboardController@leadsStore');
Route::post('/sponsorshipsurvey', 'ConferenceController@sponsorshipSurvey');
Route::get('/conferenceExist', 'ConferenceController@conferenceExist');
Route::get('/listview', ['uses'=>'DashboardController@listview']);
Route::get('/listview/getposts', ['as'=>'listview.getposts','uses'=>'DashboardController@getPosts']);
Route::get('/leads/{id}', 'DashboardController@leads');
Route::post('/leads/{id}', 'ImportExportController@importLeads');
Route::get('/user', 'DashboardController@user')->name('user');
Route::get('/user/getuser/{id}', ['as'=>'user.getuser','uses'=>'DashboardController@getuser']);
Route::get('/history/gethistory/{id}', ['as'=>'history.gethistory','uses'=>'DashboardController@gethistory']);
Route::get('/lastyear/getlastyear/{id}', ['as'=>'lastyear.getlastyear','uses'=>'DashboardController@historyLastYear']);
Route::get('/pastlastyear/getpastlastyear/{id}', ['as'=>'pastlastyear.getpastlastyear','uses'=>'DashboardController@historyPastLastYear']);
Route::get('/conference/getconference/{id}', ['as'=>'conference.getconference','uses'=>'DashboardController@getconference']);
Route::get('/apply/getapply/{id}', ['as'=>'apply.getapply','uses'=>'DashboardController@getapply']);
Route::get('/pending', 'DashboardController@pending');
Route::get('/feedback/{id}', 'DashboardController@feedback');
Route::post('/feedback/{id}', 'DashboardController@feedbackPost');
Route::get('/survey/{id}', 'SurveyController@postSurvey')->name('survey');
Route::post('/survey/{id}', 'SurveyController@postSurveyForm')->name('survey.form');
Route::get('/attendeelistdownload/{id}', 'ImportExportController@attendeeDownload');
Route::get('/leadslistdownload/{id}', 'ImportExportController@leadsDownload');
Route::get('/array', 'ImportExportController@leads_array');
Route::get('/approved_conference/{id}', 'ConferenceController@approved_conference');
Route::post('/approved_conference/{id}', 'ImportExportController@importLeads');
Route::get('/conference_details/{id}', 'ConferenceController@ConferenceDetails');
Route::post('/addnotes', 'DashboardController@addNotes');

Route::get('/approve_newconference/{link}', 'ApproveFormController@approveNewConference');
Route::get('/reject_newconference/{link}', 'ApproveFormController@rejectNewConference');
Route::post('/reject_newconference/{link}', 'ApproveFormController@rejectNewConferencePost');

Route::get('/conferencenamefilter', 'ConferenceController@FilterByConferenceName');
Route::get('/addnotes_email/{id}', 'ConferenceController@addNotes');
Route::get('/addleads_email/{id}', 'ConferenceController@addLeads');

Route::post('reject_new_conference', 'ConferenceController@rejectNew');
Route::post('reject_applied_conference', 'ConferenceController@rejectApplied');

Route::get('/feedbackdata', 'FeedbackController@getFeedbackData');

Route::get('handle', 'SearchController@handle');

Route::get('/adminconference/getconference', ['as'=>'adminconference.getconference','uses'=>'ApproveFormController@getconference']);
Route::get('/adminapply/getapply', ['as'=>'adminapply.getapply','uses'=>'ApproveFormController@getapply']);
Route::get('/attendee_list_download/{id}', 'SearchController@attendeeListDownload');
Route::get('/leads_list_download/{id}', 'SearchController@leadsListDownload');
