<!--begin::Subheader-->
<div class="py-2 subheader py-lg-6 subheader-solid" id="kt_subheader">
    <div class="flex-wrap container-fluid d-flex align-items-center justify-content-between flex-sm-nowrap">
        <!--begin::Info-->
        <div class="flex-wrap mr-1 d-flex align-items-center">
            <!--begin::Page Heading-->
            <div class="flex-wrap mr-5 d-flex align-items-baseline">
                <!--begin::Page Title-->
                <h5 class="my-1 mr-5 text-dark font-weight-bold">{{ $currentPage ?? '' }}</h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="p-0 my-2 breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="{{ $currentMenuUrl ?? '#' }}" class="text-muted">{{ $currentMenu ?? '' }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ $currentPageUrl ?? '#' }}" class="text-muted">{{ $currentPage ?? '' }}</a>
                    </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
    </div>
</div>
<!--end::Subheader-->
