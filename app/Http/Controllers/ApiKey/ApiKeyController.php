<?php

namespace App\Http\Controllers\ApiKey;

use App\ApiKey;
use Auth;
use Request;
use App\Http\Controllers\Controller;

/**
 * Handles viewing, creating, editing, and deleting api keys.
 * Api keys are required for users wishing to use the api.
 * Users can only have one api key.
 */
class ApiKeyController extends Controller
{

	public function __construct(){
		//middleware to authenticate users
		$this->middleware('auth');
	}

	/**
	 * Returns the view with the Api Key
	 * The view should contain an UI to allow users manipulate their api keys.
	 * 
	 * @return json 
	 */
	public function index(){
		$user = Auth::user();
		$userId = $user->id;
		//only one api key per user
		$apiKey = ApiKey::where('user_id', $userId)->get();
		return view('apiKey.apiKey', array('key' => $apiKey));
	}

	/**
	 * Used to create an api key.
	 * Users are only allowed to have one api key.
	 * 
	 * @return json  Empty response on successful or error on failure
	 */
	public function create(){
		$user = Auth::user();
		$userId = $user->id;

		//only allowed one key
		$numberOfKeys = ApiKey::where('user_id', $userId)->count();
		if($numberOfKeys !== 0){
			return response()->json(array('error' => 'Requesting too many keys'), 403);
		}
		$apiKeyModel = new ApiKey();
		$key = md5(microtime());
		$apiKeyModel->user_id = $userId;
		$apiKeyModel->api_key = $key;
		$saved = $apiKeyModel->save();
		if($saved){
			// return response()->json(array('key' => $key));
			return redirect('/apikey');
		} else {
			return response()->json(array('error' => 'Unable to generate key'), 500);
		}
	}

	/**
	 * Used to regenerate the api key.
	 * Typically when a users key has been compromised.
	 * 
	 * @return json  Empty response on successful or error on failure
	 */
	public function edit(){
		//must be ajax
		if(Request::ajax()){
			$user = Auth::user();
			$userId = $user->id;
			$key = md5(microtime());
			//users should only have one api key
			$apiKeyModel = ApiKey::where('user_id', $userId)->first();
			$apiKeyModel->api_key = $key;
			$apiKeyModel->save();
			if($updated){
				return response()->json(array('key' => $key));
			} else {
				return response()->json(array('error' => 'Unable to update key'), 500);
			}
		}
	}

	/**
	 * Used to delete the api key.
	 * 
	 * @return json  Empty response on successful or error on failure
	 */
	public function delete(){
		//must be ajax
		if(Request::ajax()){
			$user = Auth::user();
			$userId = $user->id;
			//users should only have one api key
			$apiKeyModel = ApiKey::where('user_id', $userId)->first();
			$deleted = $apiKeyModel->delete();

			if($deleted){
				return response()->json();
			} else {
				return response()->json(array('error' => 'Unable to delete key'), 500);
			}
		}

	}
    
}
