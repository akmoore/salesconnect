<?php

namespace App\SalesConnect\Helpers\Repositories;

use App\Client;
use App\Ae;
use App\Agency;
use App\SalesConnect\Helpers\Interfaces\ClientInterface;

class ClientRepo implements ClientInterface{

	protected $ae;
	protected $agency;
	protected $client;

	public function __construct(Client $client, Ae $ae, Agency $agency){
		$this->client = $client;
		$this->ae = $ae;
		$this->agency = $agency;
	}

	public function showAll(){
		return $client = $this->client->with('aes', 'projects', 'agency')->get()->sortBy('company_name');
	}

	public function showRecord($id){
		return $this->client->with('aes', 'agency')->whereSlug($id)->firstOrFail();
	}

	public function createRecord($request){

		// return $request->all();

		$client = $this->client->create([
			'agency_id' => $request['agency_id'] ? $request['agency_id'] : null,
			'company_name' => $request['company_name'],
			'primary_contact_first_name' => $request['primary_contact_first_name'],
			'primary_contact_last_name' => $request['primary_contact_last_name'],
			'primary_contact_title' => $request['primary_contact_title'],
			'street' => $request['street'],
			'city' => $request['city'],
			'state' => $request['state'],
			'postal' => $request['postal'],
			'public_phone' => $request['public_phone'],
			'primary_contact_phone' => $request['primary_contact_phone'],
			'primary_contact_email' => $request['primary_contact_email'],
			'url' => $request['url']
		]);
		// $client = $this->client->create($request->all());

		$client->aes()->sync($request['aes_id']);

		return $client;
	}

	public function updateRecord($request, $id){
		$client = $this->showRecord($id);
		if($client){
			$client->update([
				'agency_id' => $request['agency_id'] ? $request['agency_id'] : null,
				'company_name' => $request['company_name'],
				'primary_contact_first_name' => $request['primary_contact_first_name'],
				'primary_contact_last_name' => $request['primary_contact_last_name'],
				'primary_contact_title' => $request['primary_contact_title'],
				'street' => $request['street'],
				'city' => $request['city'],
				'state' => $request['state'],
				'postal' => $request['postal'],
				'public_phone' => $request['public_phone'],
				'primary_contact_phone' => $request['primary_contact_phone'],
				'primary_contact_email' => $request['primary_contact_email'],
				'url' => $request['url']
			]);

			$client->aes()->sync($request['aes_id']);
		}

		return $client;
	}

	public function deleteRecord($id){
		$client = $this->client->find($id);
		$client->delete();
		return $client;
	}	
}

