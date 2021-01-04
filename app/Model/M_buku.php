<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class M_buku extends Model
{
    protected $table= 'm_buku';

    public function kategori_r(){
        return $this->belongsTo('App\Model\M_kategori','kategori');
    }
}
