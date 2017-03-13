<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'dir', 'size', 'extension', 'seguridad', 'id_usuario_ramo_docente', 'type', 'seen', 'file_name', 'client_name', 'description'];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'seen' => 'array'
    ];

    /**
     * Many to Many
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

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
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y h:i');
    }

    /**
     * Transformar peso de archivos
     *
     * @return mixed
     */
    public function getHumanSizeAttribute()
    {
        $bytes = $this->size;
        $decimals = 2;
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    /**
     * Obtener promedio de valoración
     *
     * @return mixed
     */
    public function getAnalyticAttribute()
    {
        $check = FileUser::where('file_id', '=', $this->id)->count();

        if ($check == 0) {
            return [
                'rating' => 0, 'shared' => 0, 'downloaded' => 0, 'favorite' => 0
            ];
        }

        $activities = FileUser::select(
            \DB::raw(
                'ROUND(AVG(rating), 1) as rating, 
                SUM(shared) as shared, 
                SUM(downloaded) as downloaded,
                SUM(favorite) as favorite')
        )
            ->where('file_id', $this->id)
            ->first();

        return $activities;
    }

    /**
     * Cambiar a palabras la seguridad
     * @param $value
     * @return string
     */
    public function getSeguridadAttribute($value)
    {
        return ($value == 1) ? 'Público' : 'Privado';
    }

    /**
     * Nombre del ramo al que pertenece el archivo
     *
     * @return mixed
     */
    public function getRamoAttribute()
    {
        $rd = UsuarioRamoDocente::select('rd.id_ramo')
            ->join('ramo_docentes as rd', 'rd.id', '=', 'usuario_ramo_docentes.id_ramo_docente')
            ->where('usuario_ramo_docentes.id', $this->id_usuario_ramo_docente)
            ->first();

        $ramo = Ramo::find($rd->id_ramo);

        return $ramo;
    }

    /**
     * Nombre del usuario dueño del archivo
     *
     * @return mixed
     */
    public function getOwnerAttribute()
    {
        $usr = UsuarioRamoDocente::select(\DB::raw('CONCAT(users.nombre, " ", users.apellido) as full_name'))
            ->join('users', 'users.id', '=', 'usuario_ramo_docentes.id_usuario')
            ->where('usuario_ramo_docentes.id', $this->id_usuario_ramo_docente)
            ->get();

        return $usr[0]->full_name;
    }

    /**
     * Obtener el fomato completo de fecha de subida para mostrar
     *
     * @return mixed|string
     */
    public function getUploadedTimeAttribute()
    {
        $dayEn = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Satuday', 'Sunday'];
        $dayEs = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        $monthEn = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $monthEs = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

        $dt = Carbon::createFromFormat('d-m-Y h:i', $this->created_at)
            ->format('\\A \\l\\a\\s h:i \\d\\e\\l l j \\d\\e M. Y');

        $dt = str_replace($dayEn, $dayEs, $dt);
        $dt = str_replace($monthEn, $monthEs, $dt);

        return $dt;
    }

    /**
     * Obtener el fomato completo de fecha de subida para mostrar
     *
     * @return mixed|string
     */
    public function getUploadedTimeFormat2Attribute()
    {
        $dt = Carbon::createFromFormat('d-m-Y h:i', $this->created_at)
            ->format('d.m.Y - h:i');

        return $dt;
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
        $storagePath = 'documentos/' . $careerName . '/' . $ramoName . '/' . $teacherName;

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
