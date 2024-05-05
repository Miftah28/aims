<?php

use App\Models\Admin;
use App\Models\Petugas;
use App\Models\SuperAdmin;
use App\Models\User;
use Carbon\Carbon;

if (!function_exists('datapetugas')) {
    function datapetugas($idadmin)
    {
        $results = Petugas::where('admin_id', $idadmin)
            // ->where('type', 'sub lokus')
            ->orderBy('name', 'asc')
            ->get();
        return $results;
    }
}
if (!function_exists('petugas')) {
    function petugas()
    {
        $results = Petugas::all();
        return $results;
    }
}
if (!function_exists('datasuperadmin')) {
    function datasuperadmin($iduser)
    {
        $results = SuperAdmin::where('user_id', $iduser)->first();
        return $results;
    }
}
if (!function_exists('dataadmin')) {
    function dataadmin($iduser)
    {
        $results = Admin::where('user_id', $iduser)->first();
        return $results;
    }
}
if (!function_exists('angkamintaverifikasi')) {
    function angkamintaverifikasi()
    {

        $results = User::where('role', 'admin')->where('status', 'prosess')->orderBy('id', 'asc')->count();
        return $results;
    }
}
if (!function_exists('datamintaverifikasi')) {
    function datamintaverifikasi()
    {
        $results = User::where('role', 'admin')->where('status', 'prosess')->orderBy('id', 'asc')->get();
        return $results;
    }
}
