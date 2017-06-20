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
			return redirect('gelora/pol-reg/index.html#/agencyInvoice/show/' . $id);
		});
	});
	Route::group(['prefix' => 'registration-agency-submission-batch'], function(){
		Route::get('{id}', function($id){
			return redirect('gelora/pol-reg/index.html#/agencySubmissionBatch/show/' . $id);
		});
	});
	Route::group(['prefix' => 'registration-leasing-bpkb-submission-batch'], function(){
		Route::get('{id}', function($id){
			return redirect('gelora/pol-reg/index.html#/leasingBpkbSubmissionBatch/show/' . $id);
		});
	});
	Route::group(['prefix' => 'registration-md-submission-batch'], function(){
		Route::get('{id}', function($id){
			return redirect('gelora/pol-reg/index.html#/mdSubmissionBatch/show/' . $id);
		});
	});
});