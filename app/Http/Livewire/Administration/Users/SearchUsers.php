<?php

namespace App\Http\Livewire\Administration\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SearchUsers extends Component
{

    use WithPagination;

    public $search;
    public $sortField;
    public $sortAsc = true;

    protected $queryString = ['search', 'sortAsc', 'sortField'];

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortAsc = !$this->sortAsc;
        }else{
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.administration.users.search-users', [
            'users' => User::where(function ($query){
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })  ->when($this->sortField, function($query){
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            })->paginate(8),
        ]);
    }
}
