<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\v1\UseraccessesInterface;
use App\Http\Requests\UseraccessesRequest;
use App\Http\Controllers\v1\_ControlCommon;

class UseraccessesController extends Controller
{
	private $interface, $commons, $gate;

	public function __construct(UseraccessesInterface $interface, _ControlCommon $commons)
	{
		$this->interface = $interface;
		$this->commons = $commons;
	}

	public function index()
	{
		return $this->interface->index();
	}
}