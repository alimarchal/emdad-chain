<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}

            <span class="float-right text-green-600">{{(Auth::user()
            ->profile_approved == 1)
            ?' Approved':' Registration incomplete'}}</span>
            <span class=" float-right text-black-600">Account Status:&nbsp;&nbsp;</span>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
