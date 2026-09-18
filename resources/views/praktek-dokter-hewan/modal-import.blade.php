
<div class="modal fade" id="modal-import" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {{ 
                html()->form('POST', route($route . ".import"))
                ->class('form form-horizontal')
                ->id('form')
                ->attribute('enctype', 'multipart/form-data')
                ->open() 
            }}
                <div class="modal-header border-bottom pb-3">
                    <h5 class="modal-title">Form Import</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3" id="box-kelola">
                    <x-form-input type="file" name="file_import" label="File Import">
                        <div class="mt-2">
                            <a href="{{route($route.".format-export")}}" class="btn btn-sm btn-info">Download Format Import</a>
                            <a href="{{route($route.".referensi-export")}}" class="btn btn-sm btn-warning">Download Referensi</a>
                        </div>
                    </x-form-input>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">
                        {{ __('message.save') }}
                    </button>
                </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>