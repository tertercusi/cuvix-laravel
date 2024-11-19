<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Reactive;
use App\Models\Post;

new class extends Component {
    public Post $post;

    #[Reactive]
    public bool $editing = false;

    public function edit()
    {
        $this->dispatch('post-edit', post: $this->post);
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->post);
        $this->post->delete();

        $this->dispatch('post-deleted', post: $this->post);
    }
};
?>

<div class="p-6 flex space-x-2">
    <img class="h-6 w-6" src="{{ Vite::asset('resources/assets/icon-chat.svg') }}" />
    <div class="flex-1">
        <div class="flex justify-between items-center">
            <div>
                <span class="text-gray-800"> {{ $post->user->name }} </span>
                <small class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>
                @unless ($post->created_at->eq($post->updated_at))
                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                @endunless
            </div>
            @if ($post->user->is(auth()->user()))
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <img class="h-5 w-5" src="{{ Vite::asset('resources/assets/icon-ellipse.svg') }}">
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link wire:click="edit">
                            {{ __('Edit') }}
                        </x-dropdown-link>
                        <x-dropdown-link class="text-red-600" wire:click="delete"
                            wire:confirm="Are you sure your want to delete this post?">
                            {{ __('Delete') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            @endif
        </div>
        @if ($editing)
            <livewire:posts.edit :post="$post" :key="$post->id" />
        @else
            <p class="mt-4 text-lg text-gray-900">{{ $post->message }}</p>
        @endif
    </div>
</div>
