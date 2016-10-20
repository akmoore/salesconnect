<?php

namespace App\SalesConnect\Helpers\Interfaces;

interface MainInterface {
	public function showAll();
	public function showRecord($id);
	public function createRecord($request);
	public function updateRecord($request, $id);
	public function deleteRecord($id);
}