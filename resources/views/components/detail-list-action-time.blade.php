<div>
    <p class="small text-uppercase text-muted">Action Time</p>
    <ul class="list-unstyled card mb-0 shadow-none border p-3">
        <x-detail-item label="Created By" :value="$item->created_by_user->name ?? '-'" :isList="true" />
        <x-detail-item label="Created At" :value="$item->created_at" :isList="true" />
        <x-detail-item label="Updated By" :value="$item->updated_by_user->name ?? '-'" :isList="true" />
        <x-detail-item label="Updated At" :value="$item->updated_at" :isList="true" />
    </ul>
    {{ $slot }}
</div>
