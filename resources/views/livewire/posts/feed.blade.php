<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Post;

new class extends Component {
    public Collection $posts;
    public ?Post $editing = null;

    public function mount()
    {
        $this->getPosts();
    }

    #[On('post-created')]
    #[On('post-deleted')]
    public function getPosts()
    {
        $this->posts = Post::with('user')
            ->latest()
            ->get();
    }

    #[On('post-edit')]
    public function edit(Post $post)
    {
        $this->editing = $post;
        $this->getPosts();
    }

    #[On('post-edit-cancelled')]
    #[On('post-updated')]
    public function clearEdit()
    {
        $this->editing = null;
        $this->getPosts();
    }
}
?>

<div class="mt-6 bg-white shadow-md rounded-lg divide-y">
    @foreach ($posts as $post)
        <livewire:posts.feed-item :post="$post" :editing="$post->is($editing)" wire:key="{{ $post->id }}" />
    @endforeach
</div>
