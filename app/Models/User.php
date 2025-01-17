<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    // use HasFactory, Notifiable;

    // // Константы ролей
    // public const ROLE_ADMIN = 'admin';
    // public const ROLE_MASTER = 'master';
    // public const ROLE_CLIENT = 'client';

    use HasRoles;

    /**
     * Массово заполняемые атрибуты.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Скрытые поля для сериализации.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Атрибуты для приведения типов.
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

    /**
     * Проверяет, является ли пользователь администратором.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Проверяет, является ли пользователь мастером.
     *
     * @return bool
     */
    public function isMaster(): bool
    {
        return $this->role === self::ROLE_MASTER;
    }

    /**
     * Проверяет, является ли пользователь клиентом.
     *
     * @return bool
     */
    public function isClient(): bool
    {
        return $this->role === self::ROLE_CLIENT;
    }
}
