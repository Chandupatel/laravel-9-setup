<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $breadcums['page_name'] }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if ($breadcums['breadcums'] && count($breadcums['breadcums']) > 0)
                        @foreach ($breadcums['breadcums'] as $breadcum_key => $breadcum)
                            @if ($breadcum_key == count($breadcums['breadcums']) - 1)
                                <li class="breadcrumb-item active">{{ $breadcum['name'] }}</li>
                            @else
                                <li class="breadcrumb-item">
                                    <a
                                        href="{{ !empty($breadcum['url']) ? route($breadcum['url']) : '' }}">{{ $breadcum['name'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>
