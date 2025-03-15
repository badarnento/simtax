<?php

namespace App\Traits;

trait ResponseTrait
{
	public function successResponse($messages = [], $data = [], $code = 200)
	{
		// Pisahkan isi 'data' dan sisanya
		$dataContent = $data['data'] ?? [];

		if (isset($data['data'])) {
			$dataContent = $data['data'];
			unset($data['data']);
		} else {
			$dataContent = $data;
			$data = [];
		}

		$response = [
			'type'    => 'success',
			'message' => $messages,
			'data'    => $dataContent instanceof \Illuminate\Support\Collection ? $dataContent->toArray() : $dataContent,
		] + $data;

		return response()->json($response, $code);
	}


	public function errorResponse($messages = [], $data = [], $code = 500)
	{
		$response = [
			'type'    => 'error',
			'message' => $messages,
			'data'    => $data
		];

		return response()->json($response, $code);
	}

	public function paginateJsonResource($data, $resources)
	{
		$results = $this->pagination($data);
		$results['data'] = $resources;

		return $results;
	}

	public function pagination($pagianated_data)
	{
		$pagianated_data->appends(request()->except('page'))->links();
		$pagianated_data = $pagianated_data->toArray();

		return [
			"data" 	=> $pagianated_data['data'],
			"links" => [
				"first"	=> $pagianated_data['first_page_url'],
				"last"	=> $pagianated_data['last_page_url'],
				"prev"	=> $pagianated_data['prev_page_url'],
				"next"	=> $pagianated_data['next_page_url'],
			],
			"meta" 	=> [
				"path"  		=> $pagianated_data['path'],
				"current_page"	=> $pagianated_data['current_page'],
				"last_page"		=> $pagianated_data['last_page'],
				"from"			=> $pagianated_data['from'], // items_form
				"to"			=> $pagianated_data['to'], // items_to
				"total" 		=> $pagianated_data['total'], // total_items
				"per_page"		=> (int) $pagianated_data['per_page'], // items_per_page
			]
		];
	}
}
