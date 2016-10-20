<?php

namespace App\SalesConnect\Helpers\Interfaces;

interface NoteInterface extends MainInterface{
	// public function createRecord($request, $id);
	public function getProject($id);
	// public function deleteRecord($project, $id);
}