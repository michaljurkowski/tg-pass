<?php

namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;

class PassResource extends Model
{

    protected $fillable = ['name'];

    public function resourceExists($name) {
        return $this->where('name', $name)->count() != 0;
    }

    public function getIdByName($name) {
        return $this->where('name', $name)->value('id');
    }
}
