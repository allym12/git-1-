<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersComponent extends Component
{

    public $modalTitle = 'Users';
    private mixed $perPage = 10;
    public $showCreateModal = false;
    public User $allUsers;
    public $search = [];

    public $role;
    public $isDeleted = false;
    public $deleted;


    public function checkIfDeleted(){
        $this->deleted = $this->allUsers->status == 0 ? 1:0;
    }


    public function rules(){
        return [
            'allUsers.name' => 'required',
            'allUsers.email' => 'required|email',
            'allUsers.phone' => 'required|max:16',
            'allUsers.role' => 'required',
            'allUsers.status' => 'required',
        ];
    }



    public function restore(User $user){

        $user->status = 1;
        $user->save();
        $this->notify('User restored !');
    }

    public function mount()
    {
        $this->allUsers = new User();
    }

    public function edit(User $user)
    {
        $this->showCreateModal = true;
        $this->allUsers = $user;
    }

    public function save()
    {
        $this->validate();
        $this->allUsers->save();
        $this->showCreateModal = false;
        $this->notify('User\'s changes saved !');
    }

    public function create()
    {
        $this->allUsers = new User();
        $this->allUsers->status = 1;
        $this->showCreateModal = true;
    }
    public function render()
    {
        return view('livewire.users-component',[
            'users' => User::whereNot('id',auth()->user()->id)
                ->when($this->search['name'] ?? null, fn($query, $name) => $query->where('name', 'like', '%' . $name . '%'))
                ->paginate($this->perPage)
        ]);
    }
}
