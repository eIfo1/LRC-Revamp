 
@extends('layouts.default', [
    'title' => 'Catalog'
])

@section('meta')
    <meta name="item-types-with-padding" content="{{ json_encode(config('site.item_thumbnails_with_padding')) }}">
    <meta name="item-type-padding-amount" content="{{ itemTypePadding('default') }}">
@endsection

@section('js')
    <script src="{{ asset('js/catalog.js?v=9') }}"></script>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-7">
            <h3>Catalog</h3>
        </div>
        <div class="col-5 text-right">
            <a href="{{ route('creator_area.index') }}" class="btn btn-success"><i class="fas fa-plus"></i> Create</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form id="search">
                <div class="input-group mb-3">
                    <input class="form-control" type="text" placeholder="Search for items...">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i>
                            <span class="hide-sm">Search</span>
                        </button>
                    </div>
                </div>
            </form>
            <hr>
            <ul class="nav nav-pills nav-justified flex-column flex-sm-row" role="tablist">
                @foreach (config('site.catalog_item_types') as $type)
                    <li class="nav-item">
                        <span class="nav-link flex-sm-fill @if ($type == 'hat') active @endif" data-category="{{ lcfirst(itemType($type, true)) }}">{{ itemType($type, true) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row" id="items"></div>
@endsection
