@if ($paginator->hasMorePages())
    <div class="mbp_pagination mt10">
        <ul class="page_navigation">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                <span class="page-link">
                    <span class="fa fa-arrow-left"></span>
                </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" wire:click="previousPage" tabindex="-1">
                        <span class="fa fa-arrow-left"></span>
                    </a>
                </li>
            @endif

            @foreach ($paginator->links() as $link)
                <li class="page-item {{ $link['active'] ? 'active' : '' }}"
                    aria-current="{{ $link['active'] ? 'page' : '' }}">
                    @if ($link['url'])
                        <a class="page-link" wire:click="gotoPage({{ $link['url'] }})">{{ $link['label'] }}</a>
                    @else
                        <span class="page-link">{{ $link['label'] }}</span>
                    @endif
                </li>
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" wire:click="nextPage">
                        <span class="fa fa-arrow-right"></span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                <span class="page-link">
                    <span class="fa fa-arrow-right"></span>
                </span>
                </li>
            @endif
        </ul>
    </div>
@endif
