<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTable
{
	private $sortable_columns = array();

	public function setSortableColumns($columns)
	{
		$this->sortable_columns = $columns;
	}

	public function __construct(Model $model, $request)
	{
		$this->model = $model;

		$this->total_records = $model->count();
		$this->draw = $request->input('draw');
		$this->limit = $request->input('length');
		$this->offset = $request->input('start');
		$this->direction = $request->input('order.0.dir');
		$this->keyword = $request->input('search.value');

		$this->request_order = $request->input('order.0.column') == 0 ? 1:$request->input('order.0.column');
	}

	public function getData($whereCol, $orWhereCol)
	{
		$this->order = $this->sortable_columns[$this->request_order];
		$data = empty($this->keyword) ? $this->orderColumnData() : $this->search($this->keyword, $whereCol, $orWhereCol);
		return $data;
	}

	public function flatten($data)
  {
		$json_data = array(
			"draw"			=> intval($this->draw),
			"recordsTotal"	=> intval($this->total_records),
			"recordsFiltered" => intval($this->total_filtered),
			"data"			=> $data
		);

		return $json_data;
	}

	private function orderColumnData()
	{
		$data = $this->model->offset($this->offset)
									->limit($this->limit)
									->orderBy($this->order, $this->direction)
									->get();
		
		$this->total_filtered = $this->model->count();
		return $data;
	}

	private function search($keyword, $where, $or_where)
	{
		$data = $this->model
								 ->where($where, 'like', "%{$keyword}%")
								 ->orWhere($or_where,'like',"%{$keyword}%")
								 ->offset($this->offset)
								 ->limit($this->limit)
								 ->orderBy($this->order, $this->direction)
								 ->get();

		$this->total_filtered = $this->model->where($where, 'like', "%{$keyword}%")
																 ->orWhere($or_where,'like',"%{$keyword}%")
																 ->count();
		return $data;
	}

}