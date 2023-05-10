<?php

namespace App\Http\Livewire\Select;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use App\Models\DeliveryAddress;


class NewOrderDeliveryAddressSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        $userId = $this->getDependingValue('userId') ?? 0;
        return DeliveryAddress::where('name', 'like', '%' . $searchTerm . '%')
            ->orwhere('address', 'like', '%' . $searchTerm . '%')
            ->where('user_id', $userId)
            ->limit(20)
            ->get()
            ->map(function ($model) {
                return [
                    'value' => $model->id,
                    'description' => $model->name,
                ];
            });
    }


    public function selectedOption($value)
    {
        $model = DeliveryAddress::find($value);
        return [
            'value' => $model->id,
            'description' => $model->name . ' - ' . $model->address,
        ];
    }
}
