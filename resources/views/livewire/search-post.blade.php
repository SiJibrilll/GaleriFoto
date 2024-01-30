<div>

    <input type="text" wire:model.live='filter' class="mt-80">

    <livewire:display-posts :$filter key="{{'child-component-' . now()}}"/>
</div>
