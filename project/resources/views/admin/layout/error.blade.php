@if ( $errors->any() )
<div class="col-lg-12 mb-4">
    <div class="demo-inline-spacing mt-3">
        <div class="list-group">
            <a href="javascript:void(0);" class="list-group-item list-group-item-danger link-light">
                    <i class='bx bx-error-circle'></i> 錯誤訊息
            </a>
            @foreach ( $errors->all() as $error )
                <a href="javascript:void(0);" class="list-group-item list-group-item-action list-group-item-danger">
                    {{ $error }}
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif