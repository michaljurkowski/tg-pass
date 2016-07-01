<?php

namespace App\Engine\Models;

use Illuminate\Database\Eloquent\Model;

class PassRole extends Model
{

    protected $fillable = ['name'];

    public function roleExists($name)
    {
        return $this->where('name', $name)->count() != 0;
    }

    public function getIdByName($name)
    {
        return $this->where('name', $name)->value('id');
    }
}
