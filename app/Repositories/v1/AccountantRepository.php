<?php

namespace App\Repositories\v1;

use App\Models\Accountant;
use App\Interfaces\v1\AccountantInterface;
use App\Http\Controllers\v1\_ControlCommon;

class AccountantRepository implements AccountantInterface
{
    private $model, $commons;

    public function __construct(Accountant $model, _ControlCommon $commons)
    {
        $this->model = $model;
        $this->commons = $commons;
    }

    public function index()
    {
        $dateFilter = $this->commons->dateFilters();
		$registersPerPage = $this->commons->registersPerPage();
		$fieldsToSelect = $this->commons->fieldsToSelect('id,uuid,link_id,quantity,created_at');
		$sortByField = $this->commons->sortByField();
		$data = $this->model->select($fieldsToSelect)->whereBetween('created_at', [$dateFilter['dts'], $dateFilter['dtf']]);
		
		if(isset($_GET['q'])){
			$fieldsToSearch = isset($_GET['q']) ? $this->commons->keywordsToSearch('quantity,id') : '';
			$data->whereRaw("($fieldsToSearch)");
		}

		return $data->orderByRaw($sortByField)->paginate($registersPerPage);
    }
}