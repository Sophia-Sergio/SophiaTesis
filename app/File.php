<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class File extends Model
{

    public $timestamps = true;

    protected $casts = [
        'seen' => 'array'
    ];

    /**
     * Relación con tabla usuario_ramo_docente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuarioRamoDocente()
    {
        return $this->belongsTo('Sophia\UsuarioRamoDocente', 'id_usuario_ramo_docente');
    }

    /**
     * Relación con table like_files
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('Sophia\LikeFiles');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y \\a h:i');
    }

    /**
     * Proceso para guardar un nuevo contenido de ramo
     *
     * @param $file
     * @param $careerName
     * @param $ramoName
     * @param $teacherName
     * @param $urd
     * @param $security
     * @param $type
     */
    public static function saveFile($file, $careerName, $ramoName, $teacherName, $urd, $security, $type)
    {
        $storagePath = 'documentos/privados/' . $careerName . '/' . $ramoName . '/' . $teacherName;

        $fileName   =   $urd.str_slug(Carbon::now()->timestamp).".".$file->getClientOriginalExtension();

        $file->storeAs($storagePath, $fileName);

        File::insertGetId([
            'created_at'                =>  Carbon::now(),
            'updated_at'                =>  Carbon::now(),
            'client_name'               =>  $file->getClientOriginalName(),
            'dir'                       =>  $storagePath,
            'size'                      =>  $file->getSize(),
            'extension'                 =>  $file->getClientOriginalExtension(),
            'seguridad'                 =>  $security,
            'id_usuario_ramo_docente'   =>  $urd,
            'type'                      =>  $type,
            'file_name'                 =>  $fileName
        ]);
    }

    public function isLikeUser ($idUser) {

        $actuales = LikeFiles::where('file_id', $this->id)
            ->where('user_id', $idUser)
            ->get()
        ;

        if(count($actuales) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
