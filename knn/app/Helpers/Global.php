<?php
use App\Models\Pasien;
use App\Models\Pengantin;
use App\Models\Bumil;


function total_pasien()
{
   return Pasien::count();
}

function total_pengantin()
{
   return Pengantin::count();
}

function total_bumil()
{
   return Bumil::count();
}

?>
