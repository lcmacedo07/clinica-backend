<?php

namespace App\Repositories\v1;

use App\Models\Useraccesses;
use App\Interfaces\v1\UseraccessesInterface;
use App\Http\Controllers\v1\_ControlCommon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UseraccessesRepository implements UseraccessesInterface
{
    private $model, $commons;

    public function __construct(Useraccesses $model, _ControlCommon $commons)
    {
        $this->model = $model;
        $this->commons = $commons;
    }

    public function index()
    {
        $dateFilter = $this->commons->dateFilters();
		$registersPerPage = $this->commons->registersPerPage();
		$fieldsToSelect = $this->commons->fieldsToSelect('id,uuid,link_id,ip,useragent,created_at');
		$sortByField = $this->commons->sortByField();
		$data = $this->model->select($fieldsToSelect)->whereBetween('created_at', [$dateFilter['dts'], $dateFilter['dtf']]);
		
		if(isset($_GET['q'])){
			$fieldsToSearch = isset($_GET['q']) ? $this->commons->keywordsToSearch('ip,id') : '';
			$data->whereRaw("($fieldsToSearch)");
		}

		return $data->orderByRaw($sortByField)->paginate($registersPerPage);
    }

}