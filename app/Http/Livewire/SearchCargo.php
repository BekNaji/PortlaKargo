<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cargo;

class SearchCargo extends Component
{
    public $result = [];
    public $key;

    public function search()
    {
        $key = $this->key;
        $this->result = Cargo::orWhereHas('sender',function($query) use ($key){ $query->where('name','like','%'.$key.'%');})
            ->orWhereHas('receiver',function($query) use ($key){ $query->where('name','like','%'.$key.'%'); })
            ->orWhere('number','like','%'.$this->key)->with(['sender','receiver'])->limit(5)->get();
        
    }

    public function render()
    {
        return view('livewire.search-cargo');
    }
}
