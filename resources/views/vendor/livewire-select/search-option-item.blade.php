<div class="{{ $styles['searchOptionItem'] }} px-2 py-1" wire:click.stop="selectValue('{{ $option['value'] }}')"
    x-bind:class="{
        '{{ $styles['searchOptionItemActive'] }}': selectedIndex ===
            {{ $index }},
        '{{ $styles['searchOptionItemInactive'] }}': selectedIndex !== {{ $index }}
    }"
    x-on:mouseover="selectedIndex = {{ $index }}">
    {{ $option['description'] }}
</div>
