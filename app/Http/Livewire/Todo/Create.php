<?php

namespace App\Http\Livewire\Todo;

use App\Http\Livewire\Todo as LivewireTodo;
use App\Models\Todo;
use App\Rules\Auth;
use Livewire\Component;

class Create extends Component
{
    public string $title = '';

    public function render()
    {
        return view('livewire.todo.create');
    }

    public function save()
    {
        $this->validate([
            'title' => [new Auth(), 'required', 'min:3', 'max:80'],
        ]);

        $todo = Todo::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
        ]);

        $this->emitTo(LivewireTodo::class, 'todo::created');

        $this->reset('title');
    }
}
