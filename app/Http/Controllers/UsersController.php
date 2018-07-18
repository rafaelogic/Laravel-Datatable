<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
	public function index()
	{
			return view('users');
	}

	public function getUsers(Request $request)
	{
		$datatable = new \App\DataTable(new User(), $request);

		// Columns that will be sortable in the datatable view
		$datatable->setSortableColumns(['1' => 'name', '2' => 'email', '3' => 'created_at', '4' => 'updated_at']);

		// Records that will be dislayed in the datatable
		$users = $datatable->getData('name', 'email');

		// Convert records to array and format it based on the datatable js column array property
		$formatted_data = $this->tableFormatData($users);

		// Format response for datatable requirements
		$users_data = $datatable->flatten($formatted_data);

		return response()->json($users_data);
	}

	private function tableFormatData($users)
	{
		$data = array();
		if($users){
			foreach($users as $i=> $user){
				$nestedData['number'] = ++$i;
				$nestedData['name'] = $user->name;
				$nestedData['email'] = $user->email;
				$nestedData['created_at'] = $user->created_at->diffForHumans();
				$nestedData['updated_at'] = $user->updated_at->diffForHumans();
				$nestedData['action'] = (string) view('action',[
					'id' => $user->id,
					'name' => $user->name,
					'email' => $user->email
				]);
				$data[] = $nestedData;
			}
			return $data;
		}
		return false;
	}
	
	public function update(Request $request)
	{
		if($request->ajax())
		{
			$user = User::findOrFail($request->input('id'));
			$user->update([
				'name' => $request->input('name'),
				'email' => $request->input('email'),
			]);

			return response()->json(['done']);
		}
	}
}
