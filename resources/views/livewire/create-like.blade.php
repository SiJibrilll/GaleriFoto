<div>
    @if ($isLiked)
    <button wire:click='like'> unlike </button>
    
    @else
    
    <button wire:click='like'> like </button>
    @endif
</div>
