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
		$order = $request->input('order.0.column') == 0 ? 1:$request->input('order.0.column');
		
		$datatable = new \App\DataTable(new User());
		$datatable->sortable_columns = ['1' => 'name', '2' => 'email', '3' => 'created_at', '4' => 'updated_at'];
		$datatable->order = $datatable->sortable_columns[$order];
		$datatable->offset = $request->input('start');
		$datatable->limit = $request->input('length');
		$datatable->direction = $request->input('order.0.dir');

		$datatable->total_records = User::count();
		
		if(empty($request->input('search.value'))){
			$users = $datatable->orderColumnData();
		}else{
			$search = $request->input('search.value');
			$users = $datatable->search($search, 'name', 'email');
		}		
		
		$data = $this->tableFormatData($users);
		$json_data = $datatable->flatten($data, $request->input('draw'));

		return response()->json($json_data);
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
