<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News Feed') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto flex flex-col gap-3">
        <x-post-card></x-post-card>
        <livewire:posts.feed />
    </div>
</x-app-layout>
