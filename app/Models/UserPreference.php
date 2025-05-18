<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 /**
  * @property int $id
  * @property int $user_id
  * @property bool $dark_mode
  * @property string $sidebar_color
  * @property string $navbar_color
  * @property string $accent_color
  * @property bool $layout_boxed
  * @property bool $layout_fixed_sidebar
  * @property bool $layout_fixed_navbar
  * @property bool $layout_fixed_footer
  * @property bool $sidebar_collapsed
  */
class UserPreference extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'dark_mode',
        'sidebar_color',
        'navbar_color',
        'accent_color',
        'layout_boxed',
        'layout_fixed_sidebar',
        'layout_fixed_navbar',
        'layout_fixed_footer',
        'sidebar_collapsed',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dark_mode' => 'boolean',
        'sidebar_collapsed' => 'boolean',
        'layout_boxed' => 'boolean',
        'layout_fixed_sidebar' => 'boolean',
        'layout_fixed_navbar' => 'boolean',
        'layout_fixed_footer' => 'boolean',
    ];

    /**
     * Get the user that owns the preferences.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get system default preferences
     *
     * @return array
     */
    public static function getDefaults()
    {
        return [
            'dark_mode' => false,
            'sidebar_color' => 'sidebar-dark-primary',
            'navbar_color' => 'navbar-white navbar-light',
            'accent_color' => 'primary',
            'layout_boxed' => false,
            'layout_fixed_sidebar' => true,
            'layout_fixed_navbar' => false,
            'layout_fixed_footer' => false,
            'sidebar_collapsed' => false,
        ];
    }
}
