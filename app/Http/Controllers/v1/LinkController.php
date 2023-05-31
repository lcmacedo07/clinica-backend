<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\v1\LinkInterface;
use App\Http\Requests\LinkRequest;
use App\Http\Controllers\v1\_ControlCommon;

class LinkController extends Controller
{
	private $interface, $commons, $gate;

	public function __construct(LinkInterface $interface, _ControlCommon $commons)
	{
		$this->interface = $interface;
		$this->commons = $commons;
		// $this->gate = 'links';
	}

	public function index()
	{
		// $this->commons->userAuthorization($this->gate);
		return $this->interface->index();
	}

	public function totalClicks()
	{
		// $this->commons->userAuthorization($this->gate);
		return $this->interface->totalClicks();
	}

	public function show($uuid)
	{
		// $this->commons->userAuthorization($this->gate);
		return $this->interface->show($uuid);
	}

	public function details($uuid)
	{
		// $this->commons->userAuthorization($this->gate);
		return $this->interface->details($uuid);
	}

	public function store(LinkRequest $request)
	{
		// $this->commons->userAuthorization($this->gate);
		return $this->interface->store($request);
	}

	public function update($uuid, LinkRequest $request)
	{
		// $this->commons->userAuthorization($this->gate);
		return $this->interface->update($uuid, $request);
	}

	public function delete($uuid)
	{
		// $this->commons->userAuthorization($this->gate);
		return $this->interface->delete($uuid);
	}

	public function trash()
	{
		// $this->commons->userAuthorization($this->gate);
		return $this->interface->trash();
	}

	public function restore($uuid)
	{
		// $this->commons->userAuthorization($this->gate);
		return $this->interface->restore($uuid);
	}
}