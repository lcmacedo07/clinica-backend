<?php

namespace App\Observers;

use App\Models\Accountant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Http\Controllers\v1\_ControlCommon;

class AccountantObserver
{
	private $commons;

	public function __construct(_ControlCommon $commons)
	{
		$this->commons = $commons;
	}

	public function creating(Accountant $model)
	{
		$model->uuid = Str::uuid();
	}

	public function created(Accountant $model)
	{
		// Cache::forget('categories');
		// $this->commons->insertLog($model->id, 'categoria', 'C');
	}

	public function updating(Accountant $model)
	{
	}

	public function updated(Accountant $model)
	{
		// Cache::forget('categories');
		// $this->commons->insertLog($model->id, 'categoria', 'U');
	}

	public function deleted(Accountant $model)
	{
		// Cache::forget('categories');
		// $this->commons->insertLog($model->id, 'categoria', 'D');
	}

	public function restored(Accountant $model)
	{
		// Cache::forget('categories');
	}

	public function forceDeleted(Accountant $model)
	{
		// Cache::forget('categories');
	}

}