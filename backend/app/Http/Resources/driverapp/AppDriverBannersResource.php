<?php

namespace App\Http\Resources\driverapp;

use Illuminate\Http\Resources\Json\JsonResource;

class AppDriverBannersResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		// return parent::toArray($request);
		return [
			"id" => $this->id,
			"name" => $this->name,
			"img" => $this->img_mobile,
			"url" => $this->url,
			"validity_date" => $this->validity_date,
			"posted_date" => $this->posted_date,
			"description" => $this->description,
		];
	}
}
