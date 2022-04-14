<?php

namespace App\Services;

use App\Models\Mechanic;
use App\Models\Photo;

class MechanicsService
{
    public function getAll()
    {
        return Mechanic::with('photos')->get();
    }

    public function getById(int $id)
    {
        return Mechanic::with('photos')->findOrFail($id);
    }

    public function store(array $data)
    {
        $mechanic = new Mechanic();
        $mechanic->fill($data);
        $mechanic->save();

        $this->assignPhotos($mechanic);

        return $mechanic;
    }

    private function assignPhotos(Mechanic $mechanic, string $filename = 'default.jpg')
    {
        $mechanic->photos()->save(new Photo([
            'imageable_id' => $mechanic->id,
            'imageable_type' => Mechanic::class,
            'filename' => $filename,
        ]));
    }
}
