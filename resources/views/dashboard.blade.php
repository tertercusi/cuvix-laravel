<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto flex flex-row justify-center gap-5">
        <div class="min-w-96 flex flex-col">
            <div class=" bg-white p-4 rounded-md shadow-md">
                <div class="text-lg font-semibold mb-4">About Me</div>

                <div class="flex flex-col divide-y divide-solid">
                    <x-user-info title="Username" :description="Auth::user()->name" />
                    <x-user-info title="Email" :description="Auth::user()->email" />
                </div>
            </div>

        </div>
        <div class="grow flex flex-col">
            <span>Your Timeline</span>
        </div>
    </div>
</x-app-layout>
