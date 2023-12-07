<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'year_published',
        'edition',
        'isbn_10',
        'isbn_13',
        'height',
        'genre_id',      // Foreign key for genre
        'sub_genre_id',  // Foreign key for sub_genre
        'author_id',     // Foreign key for author
        'publisher_id',  // Foreign key for publisher
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function getIsbnAttribute()
    {
        return $this->isbn_13 ?: $this->isbn_10 ?: null;
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function subGenre()
    {
        return $this->belongsTo(Genre::class, 'sub_genre_id');
    }

    public static function extractAuthorNames($author): array
    {
        // Format may be "FamilyName, GivenName" or "GivenName FamilyName"
        $comma = mb_strpos($author, ",");
        if (($comma === 0) || ($comma > 0)) {
            // There is a comma
            // Extract "FamilyName, GivenName"
            $authorFamily = trim(mb_substr($author, 0, $comma));
            $authorGiven = trim(mb_substr($author, $comma + 1));
        } else {
            $space = mb_strpos($author, " ");
            if (($space === 0) || ($space > 0)) {
                // There is a space
                // Extract "GivenName FamilyName"
                $authorGiven = trim(mb_substr($author, 0, $space));
                $authorFamily = trim(mb_substr($author, $space + 1));
            } else {
                // There is no space or comma, so it must be one word
                $authorGiven = $author;
                $authorFamily = "";
            }
        }

        if ($authorGiven == "") {
            $authorGiven = $authorFamily;
            $authorFamily = "";
        }

        return [
            'author_given' => $authorGiven,
            'author_family' => $authorFamily,
        ];
    }
}
