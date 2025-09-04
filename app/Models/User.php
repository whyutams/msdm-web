<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'callname',
        'email',
        'no_hp',
        'photo_profile',
        'address',
        'gender',
        'birth_date',
        'diabetes_type',
        'role',
        'suspended',
        'usia',
        'pendidikan',
        'pekerjaan',
        'status_perkawinan',
        'lama_dm',
        'pengobatan_dm',
        'riwayat_keluarga',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
    ];

    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_SUPERADMIN = 'superadmin';

    public const GENDER = ['pria', 'wanita'];

    public const DIABETES_TYPE = ['1', '2', 'gestasional'];

    public const USIA = [
        '26-35 (dewasa_awal)',  // 26-35
        '36-45 (dewasa_akhir)', // 36-45
        '46-55 (lansia_awal)',  // 46-55
        '56-65 (lansia_akhir)', // 56-65
        '>65 (manula)',   // >65
    ];

    public const PENDIDIKAN = [
        'tidak_sekolah',
        'tidak_tamat_sd',
        'tamat_sd',
        'tamat_smp',
        'tamat_sma',
        'tamat_diploma',
        'tamat_pt',
    ];

    public const PEKERJAAN = [
        'tidak_bekerja',
        'pns',
        'pegawai_swasta',
        'wiraswasta',
        'petani',
        'nelayan',
        'buruh',
        'pembantu',
        'sopir',
        'irt',
        'aparat_desa',
        'lainnya'
    ];

    public const STATUS_PERKAWINAN = [
        'belum_kawin',
        'kawin',
        'cerai_hidup',
        'cerai_mati',
    ];

    public const LAMA_DM = [
        '<10',
        '>10',
    ];

    public const PENGOBATAN_DM = [
        'obat_anti_diabetes',
        'suntikan_insulin',
        'obat_dan_insulin',
        'obat_herbal',
        'obat_dan_herbal',
        'lainnya'
    ];

    public const RIWAYAT_KELUARGA = [
        'ada',
        'tidak_ada',
    ];
}
