<?php
$items = App\Models\UsersMenu::where('rel', 0)->orderBy('urutan', 'asc')->get();
foreach ($items as $item) {
    echo $item->id . ' | ' . $item->nama . ' | kode=' . $item->kode . ' | rel=' . $item->rel . ' | urutan=' . $item->urutan . "\n";
    if (isset($item->children)) {
        foreach ($item->children as $child) {
            echo "  -- " . $child->nama . ' | kode=' . $child->kode . ' | urutan=' . $child->urutan . "\n";
            if (isset($child->children)) {
                foreach ($child->children as $sub) {
                    echo "    --- " . $sub->nama . ' | kode=' . $sub->kode . ' | urutan=' . $sub->urutan . "\n";
                }
            }
        }
    }
}
