<div>
    {{-- Stop trying to control. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Form SPK /</span> New SPK</h4>
    <!-- Basic Layout -->
    <div class="card mb-4">
        <h5 class="card-header">Form New SPK</h5>
        <form class="card-body" wire:submit="save">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <label class="form-label" for="collapsible-fullname">Tipe Spk</label>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp1"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" value=""
                                        id="customRadioTemp1" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Layout</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp2"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" value=""
                                        id="customRadioTemp2" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Sample</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp3"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" value=""
                                        id="customRadioTemp3" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Production</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp4"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" value=""
                                        id="customRadioTemp4" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Stock</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label" for="Pemesan">Pemesan</label>
                    <div wire:ignore>
                        <select x-init="$($el).select2({
                            placeholder: 'Pilih Pemesan',
                            allowClear: true,
                        });
                        $($el).on('change', function() {
                            @this.set('customer_name', $($el).val())
                        })" name="customer_name" wire:model.defer="customer_name"
                            id="customer_name" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option label="Pilih Pemesan"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    @error('customer_name')
                    <span class="" style="margin-top: 0.35rem; font-size:0.8125rem; color: #ea5455;" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label" for="No. Purchase Order">No. Purchase Order</label>
                    <x-forms.text wire:model.defer="customer_number"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label" for="File Contoh">File Contoh</label>
                    <x-forms.filepond wire:model="file_contoh" multiple allowImagePreview imagePreviewMaxHeight="200"
                        allowFileTypeValidation allowFileSizeValidation maxFileSize="1024mb" />
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            </div>
        </form>
    </div>
</div>
