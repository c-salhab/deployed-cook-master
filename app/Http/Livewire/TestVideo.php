<?php


namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class TestVideo extends Component
{

    use WithFileUploads;

    public $videoFile;

    public function upload()
    {
        $this->validate([
            'videoFile' => 'required|mimes:mp4|max:102400',
        ]);
    }

    public function render(){
        return view('test');
    }
}
