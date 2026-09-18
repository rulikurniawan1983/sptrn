<label class="modern-radio-wrapper">
    @if ($isChecked == null)
        {{ html()->radio($name, null, $value)->class('modern-radio-input') }}
    @else
        {{ html()->radio($name, $value)->checked($isChecked)->class('modern-radio-input') }}
    @endif
    <span class="modern-radio-custom">
        <span class="modern-radio-dot"></span>
    </span>
    <span class="modern-radio-label">{{ $slot }}</span>
</label>

@push('styles')
<style>
/* ============================================
   MODERN RADIO BUTTON STYLING
   ============================================ */

.modern-radio-wrapper {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    cursor: pointer;
    position: relative;
    user-select: none;
    padding: 0.5rem 0;
    transition: all 0.2s ease;
}

.modern-radio-wrapper:hover {
    transform: translateX(2px);
}

.modern-radio-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    cursor: pointer;
}

.modern-radio-custom {
    position: relative;
    width: 22px;
    height: 22px;
    min-width: 22px;
    min-height: 22px;
    border: 2px solid rgba(var(--bs-primary-rgb), 0.3);
    border-radius: 50%;
    background: var(--bs-body-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.modern-radio-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: white;
    opacity: 0;
    transform: scale(0);
    transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.modern-radio-input:checked ~ .modern-radio-custom {
    background: var(--gradient-primary);
    border-color: var(--bs-primary);
    box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.3);
    transform: scale(1.05);
}

.modern-radio-input:checked ~ .modern-radio-custom .modern-radio-dot {
    opacity: 1;
    transform: scale(1);
}

.modern-radio-wrapper:hover .modern-radio-custom {
    border-color: var(--bs-primary);
    box-shadow: 0 2px 8px rgba(var(--bs-primary-rgb), 0.2);
    transform: scale(1.05);
}

.modern-radio-input:focus ~ .modern-radio-custom {
    box-shadow: 0 0 0 4px rgba(var(--bs-primary-rgb), 0.1),
                0 2px 8px rgba(var(--bs-primary-rgb), 0.2);
    border-color: var(--bs-primary);
}

.modern-radio-input:disabled ~ .modern-radio-custom {
    opacity: 0.5;
    cursor: not-allowed;
    background: var(--bs-secondary-bg);
    border-color: rgba(var(--bs-border-color-translucent-rgb, 219, 218, 222), 0.3);
}

.modern-radio-input:disabled ~ .modern-radio-label {
    opacity: 0.6;
    cursor: not-allowed;
}

.modern-radio-label {
    font-size: 0.9375rem;
    color: var(--bs-body-color);
    font-weight: 500;
    line-height: 1.5;
    transition: color 0.2s ease;
}

.modern-radio-wrapper:hover .modern-radio-label {
    color: var(--bs-primary);
}

/* Dark Mode Support */
[data-theme="dark"] .modern-radio-custom {
    background: var(--bs-body-bg);
    border-color: rgba(255, 255, 255, 0.2);
}

[data-theme="dark"] .modern-radio-wrapper:hover .modern-radio-custom {
    border-color: var(--bs-primary);
    box-shadow: 0 2px 8px rgba(var(--bs-primary-rgb), 0.3);
}

/* Animation for radio dot */
@keyframes radioDot {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.3);
    }
    100% {
        transform: scale(1);
    }
}

.modern-radio-input:checked ~ .modern-radio-custom .modern-radio-dot {
    animation: radioDot 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}
</style>
@endpush
