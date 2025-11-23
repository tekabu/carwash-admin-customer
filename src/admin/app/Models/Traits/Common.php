<?php

namespace App\Models\Traits;

use DateTimeInterface;

trait Common
{
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->timezone('Asia/Manila')->format('Y-m-d H:i:s');
    }

    public function getActionEditUrlAttribute()
    {
        return route($this->route . '.edit', $this->id);
    }

    public function getActionUpdateUrlAttribute()
    {
        return route($this->route . '.update', $this->id);
    }

    public function getActionDeleteUrlAttribute()
    {
        return route($this->route . '.destroy', $this->id);
    }

    public function getActionOptionsAttribute()
    {
        $items = [];

        $items[] = el('a.dropdown-item.edit-row[href=#]', [
            el('i.ph-pencil-simple-line.me-2'),
            'Edit'
        ]);

        // Add "Add Balance" option only for Customer model
        if ($this->route === 'customers') {
            $items[] = el('a.dropdown-item.add-balance-row[href=#]', [
                el('i.ph-wallet.me-2'),
                'Add Balance'
            ]);
        }

        $items[] = el('a.dropdown-item.delete-row[href=#]', [
            el('i.ph-trash.me-2'),
            'Delete'
        ]);

        return el('.d-inline-flex > .dropdown', [
            el('a.text-body.actions[href=#][data-bs-toggle=dropdown]', [
                el('i.ph-list')
            ]),
            el('.dropdown-menu dropdown-menu-end', $items)
        ]);
    }
}
