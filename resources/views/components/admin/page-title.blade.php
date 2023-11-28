<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ strtolower(ucwords($title)) }}</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ isset($role)  ? strtoupper($role) : 'ADMİN' }}</a></li>
                    <li class="breadcrumb-item active">{{ strtoupper(ucwords($title)) }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->
