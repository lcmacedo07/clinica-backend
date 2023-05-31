<?php

namespace App\Observers;

use App\Models\Useraccesses;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Http\Controllers\v1\_ControlCommon;

class UseraccessesObserver
{
	private $commons;

	public function __construct(_ControlCommon $commons)
	{
		$this->commons = $commons;
	}

	public function creating(Useraccesses $model)
	{
		$model->uuid = Str::uuid();
	}

	public function created(Useraccesses $model)
	{
		// Cache::forget('categories');
		// $this->commons->insertLog($model->id, 'categoria', 'C');
	}

	public function updating(Useraccesses $model)
	{
	}

	public function updated(Useraccesses $model)
	{
		// Cache::forget('categories');
		// $this->commons->insertLog($model->id, 'categoria', 'U');
	}

	public function deleted(Useraccesses $model)
	{
		// Cache::forget('categories');
		// $this->commons->insertLog($model->id, 'categoria', 'D');
	}

	public function restored(Useraccesses $model)
	{
		// Cache::forget('categories');
	}

	public function forceDeleted(Useraccesses $model)
	{
		// Cache::forget('categories');
	}

}