<?php

namespace App\Observers;

use App\Models\Link;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Http\Controllers\v1\_ControlCommon;

class LinkObserver
{
	private $commons;

	public function __construct(_ControlCommon $commons)
	{
		$this->commons = $commons;
	}

	public function creating(Link $model)
	{
		$model->uuid = Str::uuid();
	}

	public function created(Link $model)
	{
		// Cache::forget('categories');
		// $this->commons->insertLog($model->id, 'categoria', 'C');
	}

	public function updating(Link $model)
	{
	}

	public function updated(Link $model)
	{
		// Cache::forget('categories');
		// $this->commons->insertLog($model->id, 'categoria', 'U');
	}

	public function deleted(Link $model)
	{
		// Cache::forget('categories');
		// $this->commons->insertLog($model->id, 'categoria', 'D');
	}

	public function restored(Link $model)
	{
		// Cache::forget('categories');
	}

	public function forceDeleted(Link $model)
	{
		// Cache::forget('categories');
	}

}