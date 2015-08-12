<?php

namespace App\Http\Controllers\File;

use App\TeamStat;
use Log;
use Auth;
use Exception;
use Illuminate\Http\Request;
use RedirectResponse;
use App\Http\Controllers\Controller;

//to create table on the fly
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Handles viewing, creating, editing, and deleting api keys.
 * Api keys are required for users wishing to use the api.
 * Users can only have one api key.
 */
class FileController extends Controller{

	private $fieldCount = 9;

	public function __construct(){
		//middleware to authenticate users
		$this->middleware('auth');
	}

	/**
	 * Displays view for the file uploader
	 * @return view  View of the file index page
	 */
	public function index(){
		return view('file/file');
	}

	/**
	 * Handles file uploading and populating table with team data.
	 * @param  Request $request Http request
	 */
	public function upload(Request $request){
		//check file size is between 1kB and 2kB
		//soccer dat is about 1.4kB
		$this->validate($request, ['file' => 'between:1,2']);

		//checks if the request has a file named 'file'
		if($request->hasFile('file')){
			$data = array();
			//check if file uploaded successfully
			if($request->file('file')->isValid()){
				$file = $request->file('file');
				//only read file
				$fileObject = $file->openFile('r');
				try{
					$data = $this->extractData($fileObject);
					$this->populateTable($data);
				}catch (Exception $e){
					Log::error($e->getMessage());
					return back()->withErrors(['Error Saving the data']);
				}

				return back()->with('success', 'Successful upload.');
			} else {
				return back()->withErrors(['Unable to upload file.']);
			}
			return 'cool';
		} else {
			return back()->withErrors(['No File submitted.']);
		}

	}

	/**
	 * Extracts data from the file
	 * @param  SplFileObject $fileObject  File object.
	 * @throws                            Invalid data exception.
	 * @return array                      Filtered data.
	 */
	private function extractData($fileObject){
		$data = array();
		while(!$fileObject->eof()){
			$line = trim($fileObject->fgets());
			if(!empty($line)){
				//2 or more white spaces in case of team name with a space
				$parts = preg_split('/\s{2,}/', $line);
				if(count($parts) == 9){
					$data[] = $parts;
				} else {
					throw new Exception('Invalid data');
				}
			}
		}

		return $data;
	}

	/**
	 * Helper to populate the database.
	 * @param  array $data  Data to be saved.
	 * @throws              Exception is thrown when unable to save.
	 */
	private function populateTable($data){
		//skip first row
		for($i = 1; $i < count($data); $i++){
			$teamStats                = new TeamStat();
			$teamStats->name          = $data[$i][0];
			$teamStats->played        = $data[$i][1];
			$teamStats->wins          = $data[$i][2];
			$teamStats->loses         = $data[$i][3];
			$teamStats->draws         = $data[$i][4];
			$teamStats->goals_for     = $data[$i][5];
			$teamStats->goals_against = $data[$i][6];
			$teamStats->points        = $data[$i][7];
			$teamStats->last_game_day = $data[$i][8];
			$saved = $teamStats->save();
			if(!$saved){
				throw new Exception("Unable to insert data");
			}
		}
	}
}