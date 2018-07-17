<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DataTable
{
  public $limit = 10;

  public $offset = 0;

  public $order = 'id';

  public $total_records = 0;

	public $total_filtered = 0;

	public $table_columns = array();

	public $sortable_columns = array();
	
	public $direction = "ASC";

	protected $model;
	
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function orderColumnData()
	{
		$data = $this->model->offset($this->offset)
									->limit($this->limit)
									->orderBy($this->order, $this->direction)
									->get();
		
		$this->total_filtered = $this->model->count();
		return $data;
	}

	public function search($keyword, $where, $or_where)
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
 
  public function flatten($data, $draw)
  {
		$json_data = array(
			"draw"			=> (int)$draw,
			"recordsTotal"	=> (int)$this->total_records,
			"recordsFiltered" => (int)$this->total_filtered,
			"data"			=> $data
		);

		return $json_data;
	}
	

}