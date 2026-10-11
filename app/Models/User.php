<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    public const ROLES = [
        'administrator',
        'pharmacist-manager',
        'cashier-sales-staff',
        'customer',
        'supplier-vendor',
    ];

    public const ROLE_LABELS = [
        'administrator' => 'Administrator',
        'pharmacist-manager' => 'Pharmacist/Manager',
        'cashier-sales-staff' => 'Cashier/Sales Staff',
        'customer' => 'Customer',
        'supplier-vendor' => 'Supplier/Vendor',
    ];

    public static function normalizeRole(string $role): string
    {
        return match ($role) {
            'admin' => 'administrator',
            'pharmacist' => 'pharmacist-manager',
            'cashier' => 'cashier-sales-staff',
            'supplier' => 'supplier-vendor',
            default => $role,
        };
    }

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
