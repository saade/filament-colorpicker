<x-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div
        wire:ignore
        x-data="{
            color: $wire.entangle('{{ $getStatePath() }}'),
            picker: undefined,
            init() {
                $nextTick(() => {
                    this.picker = window.FilamentColorPicker.make($wire, {
                        parent: document.getElementById('filament-color-picker'),
                        ...@js($getPickerOptions()),
                    });
                });
            },
        }"
    >
        <div
            id="filament-color-picker"
            class="color-picker flex flex-wrap mt-1 shadow-sm"
        >
            @includeWhen($getPreview(), 'filament-colorpicker::preview')

            <input
                type="text"
                x-model="color"
                {{
                    $attributes->class([
                        'color-picker-input',
                        'block transition duration-75 border border-gray-300 focus:border-primary-600 focus:ring-1 focus:ring-inset focus:ring-primary-600 disabled:opacity-70',
                        '!rvx-rounded-r-lg flex-1 border-l-0' => $getPreview(),
                        'rounded-lg w-full' => !$getPreview(),
                    ])
                }}
                style="{{ $isPopupEnabled() ? '' : 'margin-bottom: 0.75rem' }}"
                readonly="{{ $isPopupEnabled() ? '' : 'readonly' }}"
                data-color-picker-field
            />
        </div>
    </div>
</x-forms::field-wrapper>
