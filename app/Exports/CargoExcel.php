<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Cargo;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class CargoExcel implements FromArray,ShouldAutoSize
{

	public $data;

	public function __construct($data)
	{
		$this->data = $data;
	}

	public function array(): array
	{
		return $this->data;
	}

	

}
