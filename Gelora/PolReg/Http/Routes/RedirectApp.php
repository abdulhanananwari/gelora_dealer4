<?php

Route::group(['prefix' => 'redirect-app'], function(){
	
	Route::get('registration', function(){

        $link = "/gelora/pol-reg/index.html#/registration/show/" . 
                request("id","")."/".
                request("delivery_id","");

        return response('', 302,['Location' => $link]);
    });

	Route::group(['prefix' => 'registration-agency-invoice'], function(){
		Route::get('{id}', function($id){
			return redirect('gelora/pol-reg/index.html#/registrationAgencyInvoice/show/' . $id);
		});
	});
	Route::group(['prefix' => 'registration-agency-submission-batch'], function(){
		Route::get('{id}', function($id){
			return redirect('gelora/pol-reg/index.html#/registrationAgencySubmissionBatch/show/' . $id);
		});
	});
	Route::group(['prefix' => 'registration-leasing-bpkb-submission-batch'], function(){
		Route::get('{id}', function($id){
			return redirect('gelora/pol-reg/index.html#/registrationLeasingBpkbSubmissionBatch/show/' . $id);
		});
	});
	Route::group(['prefix' => 'registration-md-submission-batch'], function(){
		Route::get('{id}', function($id){
			return redirect('gelora/pol-reg/index.html#/registrationMdSubmissionBatch/show/' . $id);
		});
	});
});