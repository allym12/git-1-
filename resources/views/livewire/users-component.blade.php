<div>
    @slot('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    @endslot
    <div class="flex w-full justify-between pb-5">
        <div>
            <x-input.text wire:model="search.name" id="search" placeholder="Search..."/>
        </div>

        <div class="space-x-2 flex items-center">


            <x-primary-button wire:click="create">
                <x-icon.plus/>
                New
            </x-primary-button>
        </div>
    </div>

    <x-table>
        <x-slot name="head">
            <x-table.heading>#</x-table.heading>
            <x-table.heading>Name</x-table.heading>
            <x-table.heading>Email</x-table.heading>
            <x-table.heading>Phone</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading>Role</x-table.heading>
            <x-table.heading>Action</x-table.heading>
        </x-slot>

        <x-slot name="body">
            @forelse($users as $user)
                <x-table.row wire:loading.class.delay="opacity-50">
                    <x-table.cell>
                        <span>{{$loop->iteration}} </span>
                    </x-table.cell>

                    <x-table.cell>
                        <span>{{$user->name}} </span>
                    </x-table.cell>

                    <x-table.cell>
                        <span>{{$user->email}} </span>
                    </x-table.cell>

                    <x-table.cell>
                        <span>{{$user->phone}} </span>
                    </x-table.cell>

                    <x-table.cell>
                        @if($user->isActive())
                            <x-heroicon-o-lock-open class="w-5 h-5 text-green-700"/>
                        @else
                            <x-heroicon-o-lock-closed class="w-5 h-5 text-red-400"/>
                        @endif
                        {{--                        <x-heroicon-o-lock-open class="w-5 h-5 text-gray-400"/>--}}
                        {{--                        <x-heroicon-o-lock-open class="w-5 h-5 text-green-400"/>--}}
                        {{--                        <span><x-badge.badge color="{{$user->isActive() ? 'green' : 'red'}}">{{$user->isActive() ? 'Active' : 'Inactive'}} </x-badge.badge></span>--}}
                    </x-table.cell>

                    <x-table.cell>

                        <span>
                            <x-badge>
                                {{$user->role}}
                            </x-badge>
                        </span>
                    </x-table.cell>


                    <x-table.cell>
                        @if($user->isActive())
                            <x-badge.badge wire:click="edit({{$user->id}})" color="green">Edit</x-badge.badge>
                        @else
                            <x-badge.badge wire:click="restore({{$user->id}})" color="slate">Restore</x-badge.badge>
                        @endif
                    </x-table.cell>

                </x-table.row>
            @empty
                <x-table.row>
                    <x-table.cell colspan="40">
                        <x-empty-state/>
                    </x-table.cell>
                </x-table.row>
            @endforelse

        </x-slot>
    </x-table>





        <!-- Save drinks report-->
        <form wire:submit.prevent="save">
            <x-modal.dialog wire:model.defer="showCreateModal">
                <x-slot name="title">{{$modalTitle}}</x-slot>

                <x-slot name="content">
                    <x-input.group for="name" label="Name" :error="$errors->first('allUsers.name')">
                        <x-input.text type="name" wire:model.defer="allUsers.name" id="name" placeholder="Name"/>
                    </x-input.group>

                    <x-input.group for="email" label="Email" :error="$errors->first('allUsers.email')">
                        <x-input.text type="email" wire:model.defer="allUsers.email" id="email" placeholder="Email"/>
                    </x-input.group>

                    <x-input.group for="status" label="Status" :error="$errors->first('allUsers.role')">
                        <x-input.select wire:model="allUsers.role" id="status">

                            @foreach (App\Models\User::USERTYPES as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group for="phone" label="Phone" :error="$errors->first('allUsers.phone')">
                        <x-input.text type="phone" wire:model.defer="allUsers.phone" id="phone" placeholder="Phone"/>
                    </x-input.group>

                    <x-input.group for="status" label="Active?" :error="$errors->first('allUsers.status')">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.defer="allUsers.status" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-200  rounded-full peer  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600  peer-checked:bg-gradient-to-r from-[#009254]  to-[#94C45B]"></div>
                        </label>
                    </x-input.group>
                </x-slot>


                <x-slot name="footer">
                    <x-button.secondary wire:click="$set('showCreateModal', false)">Cancel</x-button.secondary>
                    <x-primary-button type="submit" wire:loading.attr="disabled" wire:target="save">
                        <x-spinner wire:loading wire:target="save" size="6"/>
                        Save
                    </x-primary-button>
                </x-slot>
            </x-modal.dialog>
        </form>


</div>
