<?php

namespace App\Interfaces\v1;

use App\Http\Requests\LinkRequest;

interface LinkInterface
{

	public function index();
	public function totalClicks();
	public function show($uuid);
	public function details($uuid);
	public function store(LinkRequest $request);
	public function update($uuid, LinkRequest $request);
	public function delete($uuid);
	public function trash();
	public function restore($uuid);
}