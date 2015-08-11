<?php

namespace App\Http\Controllers\Api;

use DB;
use Log;
use Auth;
use Input;
use Request;
use App\ApiKey;
use App\TeamStat;
use App\Http\Controllers\Controller;

/**
 * Handles viewing, creating, editing, and deleting api keys.
 * Api keys are required for users wishing to use the api.
 * Users can only have one api key.
 */
class ApiController extends Controller
{

	private $sortFilters = array('wins', 'loses', 'draws', 'goals_for', 'goals_against', 'points', 'last_game_day');

	private $sortOrder = array('desc', 'asc');

	/**
	 * Displayed all data.
	 * Available filters are by column name and sort order
	 * @return view | json
	 */
	public function index(){
		if(Auth::check()){ // TODO: view data through UI

		} else { //through api requires key

			if($this->isAuthorized()){
				$data = null;
				$sort = Input::get('sort');
				$order = Input::get('order');
				if(in_array($sort, $this->sortFilters)){
					if(in_array($order, $this->sortOrder)){
						$data = TeamStat::orderBy($sort, $order)->get();
					} else {
						$data = TeamStat::orderBy($sort)->get();
					}
				} else {
					$data = TeamStat::orderBy('updated_at')->get();
				}
				return response()->json($data);
			}

			return response()->json(array('error' => 'Requires a valid key.'), 401); // unauthroized
		}
	}

	/**
	 * Shows each teams goal difference
	 * goals_for - goals_against
	 * @return view | json
	 */
	public function top(){
		if(Auth::check()){

		} else {
			if($this->isAuthorized()){
				$data = DB::table('teams_stats')
				->select(DB::raw('name, goals_for - goals_against AS goal_difference'))
				->orderBy('goal_difference', 'desc')
				->get();
				return response()->json($data);
			}

			return response()->json(array('error' => 'Requires a valid key.'), 401); // unauthroized
		}
	}

	public function create(){

	}

	public function edit(){

	}

	public function delete(){

	}

	/**
	 * Helper function to validate api key
	 * @return boolean true if key given is valid, false otherwise
	 */
	private function isAuthorized(){
		$apiKey = Input::get('key');
		$isAuthorized = ApiKey::where('api_key', $apiKey)->count();

		return $isAuthorized ? true : false;
	}


}