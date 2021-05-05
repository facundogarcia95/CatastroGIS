
@if (count($breadcrumbs))
 
<ol class="breadcrumb bg-catastro text-light" style="position: fixed;
z-index: 999;
width: 100%;">
    @foreach ($breadcrumbs as $breadcrumb)

        @if ($breadcrumb->url && !$loop->last)
            <li class="breadcrumb-item active text-uppercase "><a class="text-light" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
        @else
            <li class="breadcrumb-item active"><label class="text-light">{{ $breadcrumb->title }}</label></li>
        @endif

    @endforeach
</ol>

@endif