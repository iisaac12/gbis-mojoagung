<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchInfo extends Model
{
    use HasFactory;

    protected $table = 'church_info';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'description',
        'vision',
        'mission',
        'map_embed'
    ];

    /**
     * Get the church's social media links
     * You can extend this model to include social media table if needed
     */
    public function getSocialMediaAttribute()
    {
        return [
            'facebook' => 'https://facebook.com/gbismojoagung',
            'instagram' => 'https://instagram.com/gbismojoagung',
            'youtube' => 'https://youtube.com/@gbismojoagung',
            'whatsapp' => 'https://wa.me/6281234567890'
        ];
    }

    /**
     * Get formatted phone number for WhatsApp
     */
    public function getWhatsappLinkAttribute()
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        return "https://wa.me/{$phone}";
    }

    /**
     * Get Google Maps link
     */
    public function getMapLinkAttribute()
    {
        $address = urlencode($this->address);
        return "https://www.google.com/maps/search/?api=1&query={$address}";
    }
}