<div class="{{ $styles['searchOptionsContainer'] }} rounded-sm shadow-sm bg-purple-200" x-show="isOpen">
    @if (!$emptyOptions)
        @foreach ($options as $option)
            @include($searchOptionItem, [
                'option' => $option,
                'index' => $loop->index,
                'styles' => $styles,
            ])
        @endforeach
    @elseif ($isSearching)
        @include($searchNoResultsView, [
            'styles' => $styles,
        ])
    @endif
</div>
