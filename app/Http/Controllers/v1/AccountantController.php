<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\v1\AccountantInterface;
use App\Http\Requests\AccountantRequest;
use App\Http\Controllers\v1\_ControlCommon;

class AccountantController extends Controller
{
	private $interface, $commons, $gate;

	public function __construct(AccountantInterface $interface, _ControlCommon $commons)
	{
		$this->interface = $interface;
		$this->commons = $commons;
	}

	public function index()
	{
		return $this->interface->index();
	}
}