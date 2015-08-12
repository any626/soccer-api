<?php

namespace App\Http\Controllers\Api;

use DB;
use Input;
use App\TeamStat;
use App\Http\Controllers\Controller;

/**
 * Handles viewing, creating, editing, and deleting api keys.
 * Api keys are required for users wishing to use the api.
 * Users can only have one api key.
 */
class ApiController extends Controller
{

	/**
	 * fields in the teams_stats table
	 * @var array
	 */
	private $fields = array('name', 'played', 'wins', 'loses', 'draws', 'goals_for', 'goals_against', 'points', 'last_game_day');

	/**
	 * Sort ordering options
	 * @var array
	 */
	private $sortOrder = array('desc', 'asc');


	/**
	 * Constructor used to call middleware.
	 */
	public function __construct(){
		// custom middleware. handles api key validation
		$this->middleware('api.auth');
	}

	/**
	 * Displayed all data.
	 * Available filters are by column name and sort order
	 * @return  json
	 */
	public function index(){
		$data = null;
		$sort = Input::get('sort');
		$order = Input::get('order');
		if(in_array($sort, $this->fields)){
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

	/**
	 * Shows each teams goal difference
	 * goals_for - goals_against
	 * @return json
	 */
	public function top(){
		$data = DB::table('teams_stats')
		->select(DB::raw('name, goals_for - goals_against AS goal_difference'))
		->orderBy('goal_difference', 'desc')
		->get();
		return response()->json($data);	
	}

	/**
	 * Creates a new row in the database.
	 * Required field is the name.
	 * @return json
	 */
	public function create(){
		$name = Input::get('name');
		if($name){
			$wins = (int) Input::get('wins', 0);
			$loses = (int) Input::get('loses', 0);
			$draws = (int) Input::get('draws', 0);
			$teamStatsModel = new TeamStat();
			$teamStatsModel->name = $name;
			$teamStatsModel->played = $wins + $loses + $draws;
			$teamStatsModel->wins = $wins; //default value 0
			$teamStatsModel->loses = $loses; //default value 0
			$teamStatsModel->draws = $draws; //default value 0
			$teamStatsModel->goals_for = (int) Input::get('goals_for', 0); //default value 0
			$teamStatsModel->goals_against = (int) Input::get('goals_against', 0); //default value 0
			$teamStatsModel->points = (int) Input::get('points', 0); //default value 0
			$teamStatsModel->last_game_day = (int) Input::get('last_game_day', 0); //default value 0

			$saved = $teamStatsModel->save();
			if(!$saved){
				return response()->json(array('status' => false, 'error' => 'Unable to save'));		
			}

			return response()->json(array('status' => true));
		}
		return response()->json('name is a required field');
	}

	/**
	 * Edits an existing data given an id.
	 * @param  int   $id  Id of the data to be edited.
	 * @return json
	 */
	public function edit($id){
		if((int) $id > 0){
			$teamStatsModel = TeamStat::find((int) $id);
			if(!$teamStatsModel){
				return response()->json(array('status' =>  false, 'error' => 'Unable to update using given id.'));
			}
			$postData = Input::except(array('key', 'name'));
			$shouldSave = false;
			$name = Input::get('name');
			if($name){
				$teamStatsModel->name = $name;
				$shouldSave = true;
			}
			foreach ($postData as $key => $value) {
				if(in_array($key, $this->fields)){
					$shouldSave = true;
					$prop = $key;
					$teamStatsModel->$prop = (int) $value;
				}
			}
			$isValid = $this->areValidGames($teamStatsModel->played, $teamStatsModel->wins, $teamStatsModel->loses, $teamStatsModel->draws);
			if(!$isValid){
				return response()->json(array('status' =>  false, 'error' => 'Invalid number of games'));
			}

			if($shouldSave){
				$saved = $teamStatsModel->save();
				if(!$saved){
					return response()->json(array('status' => false, 'error' => 'Unable to save'));	
				}
				return response()->json(array('status' => true));
			}
		}
		return response()->json(array('status' =>  false, 'error' => 'Invalid id.'));
	}

	/**
	 * Deletes a row of data
	 * @param  int   $id  Id of the data
	 * @return json
	 */
	public function delete($id){
		if((int) $id > 0){
			$teamStatsModel = TeamStat::find((int) $id);
			if($teamStatsModel){
				$deleted = $teamStatsModel->delete();
				if(!$deleted){
					return response()->json(array('status' =>  false, 'error' => 'Unabled to delete.'));
				}
				return response()->json(array('status' =>  true));
			}
			return response()->json(array('status' =>  false, 'error' => 'Unable to find data.'));
		}
		return response()->json(array('status' =>  false, 'error' => 'Invalid id.'));
	}

	/**
	 * Helper to validate the number of games
	 * @param  int $played     Games played.
	 * @param  int $wins       Games won.
	 * @param  int $loses      Games lost.
	 * @param  int $draws      Games tied.
	 * @return boolean
	 */
	private function areValidGames($played, $wins, $loses, $draws){
		return ($played == $wins + $loses + $draws) ? true : false;
	}

}