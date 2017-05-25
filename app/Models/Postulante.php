<?php

namespace App\Models;

use App\User;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class Postulante extends Model
{
    protected $table = 'postulante';
    protected $fillable = ['idevaluacion', 'codigo','codigo_verificacion','paterno','materno','nombres','idtipoidentificacion',
            'numero_identificacion','email','talla','peso','idsexo','telefono_celular','telefono_fijo','telefono_varios',
            'idmodalidad','idespecialidad','idmodalidad2','idespecialidad2','idpais','idubigeo','direccion','idcolegio','iduniversidad',
            'fecha_nacimiento','idpaisnacimiento','idubigeonacimiento',
            'idubigeoprovincia','direccion_provincia','telefono_provincia',
            'foto_cargada','foto_editada','foto_rechazada','foto_estado','foto_fecha',
            'idaula1','idaula2','idaula3','idaulavoca','anulado','datos_ok','fecha_registro','idusuario'];
    /**
    * Atributos Foto
    */
    public function getFotoAttribute()
    {
        if(is_null($this->foto_editada)) return $this->foto_cargada;
        else return $this->foto_editada;
    }
    /**
    * Atributos Gestion IE
    */
    public function getGestionIeAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        if ($modalidad->colegio) $ie = Colegio::find($this->idcolegio);
        else $ie = Universidad::find($this->iduniversidad);

        return $ie->gestion;
    }
    /**
    * Atributos Codigo Modalidad
    */
    public function getCodigoModalidadAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        return $modalidad->codigo;
    }
    /**
    * Atributos Ha Pagado
    */
    public function getHaPagadoAttribute()
    {
        if($this->pago)return 'SI';
        else return 'NO';
    }
    /**
    * Atributos Datos Aula para el dia 1 del examen
    */
    public function getDatosAulaUnoAttribute()
    {
        $aula = Aula::find($this->idaula1);
        if(!isset($aula)){
            $aula = new Aula(['codigo'=>'--','sector'=>'--']);
        }
        return $aula;
    }
    /**
    * Atributos Datos Aula para el dia 2 del examen
    */
    public function getDatosAulaDosAttribute()
    {
        $aula = Aula::find($this->idaula2);
        if(!isset($aula)){
            $aula = new Aula(['codigo'=>'--','sector'=>'--']);
        }
        return $aula;
    }
    /**
    * Atributos Datos Aula para el dia 3 del examen
    */
    public function getDatosAulaTresAttribute()
    {
        $aula = Aula::find($this->idaula3);
        if(!isset($aula)){
            $aula = new Aula(['codigo'=>'--','sector'=>'--']);
        }
        return $aula;
    }
    /**
    * Atributos Datos Aula para el vocacional
    */
    public function getDatosAulaVocaAttribute()
    {
        $aula = Aula::find($this->idaulavoca);
        if(!isset($aula)){
            $aula = new Aula(['codigo'=>'--','sector'=>'--']);
        }
        return $aula;
    }
    /**
    * Atributos Datos Colegio
    */
    public function getDatosColegioAttribute()
    {
        $colegio = Colegio::find($this->idcolegio);
        return $colegio;
    }
    /**
    * Atributos Nombre Especialidad
    */
    public function getNombreEspecialidadAttribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad);
        return $especialidad->nombre;
    }
    /**
    * Atributos Codigo Especialidad
    */
    public function getCodigoEspecialidadAttribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad);
        return $especialidad->codigo;
    }
    /**
    * Atributos Nombre Segunda Especialidad
    */
    public function getNombreEspecialidad2Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad2);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['nombre'=>'---']);
        }

        return $especialidad->nombre;
    }
    /**
    * Atributos Codigo Segunda Especialidad
    */
    public function getCodigoEspecialidad2Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad2);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['codigo'=>'---']);
        }
        return $especialidad->codigo;
    }
    /**
    * Atributos Ubigeo
    */
    public function getDescripcionUbigeoAttribute()
    {
        $ubigeo = Ubigeo::find($this->idubigeo);
        return $ubigeo->descripcion;
    }
    /**
    * Atributos Datos Evaluacion
    */
    public function getDatosEvaluacionAttribute()
    {
        $evaluacion = Evaluacion::find($this->idevaluacion);
        return $evaluacion;
    }
    /**
    * Atributos Sede
    */
    public function getSedeAttribute()
    {
        $sede = Catalogo::find($this->idsede);
        if(is_null($sede))$sede = New Catalogo(['nombre'=>'---']);
        return strtoupper($sede->nombre);
    }
    /**
    * Atributos Foto
    */
    public function getMostrarFotoAttribute()
    {
        $foto = asset('/storage/'.$this->foto);
        return $foto;
    }
    /**
    * Atributos Foto
    */
    public function getMostrarFotoEditadaAttribute()
    {
        $foto = asset('/storage/'.$this->foto_editada);
        return $foto;
    }
    /**
    * Atributos Grado
    */
    public function getGradoAttribute()
    {
        $grado = Catalogo::find($this->idgrado);
        return $grado->nombre;
    }
    /**
    * Atributos Sexo
    */
    public function getSexoAttribute()
    {
        $sexo = Catalogo::find($this->idsexo);
        return $sexo->nombre;
    }
    /**
    * Atributos Nombre Completo
    */
    public function getNombreCompletoAttribute()
    {
        $nombre = $this->paterno.'-'.$this->materno.','.$this->nombres;
        return $nombre;
    }
    /**
    * Atributos Nombre Completo
    */
    public function getNombreClienteAttribute()
    {
        $paterno = strtoupper(str_clean($this->paterno));
        $materno = strtoupper(str_clean($this->materno));
        $nombres = strtoupper(str_clean($this->nombres));

        $nombre = $paterno.' '.$materno.' '.$nombres;
        return $nombre;
    }
    /**
    * Atributos Edad del postulante
    */
    public function getEdadAttribute()
    {
        $edad = Carbon::createFromFormat('Y-m-d',$this->fecha_nacimiento)->age;
        return $edad;
    }
    /**
    * Atributos estado de  Alumno
    */
    public function getEstadoPagoAttribute()
    {
        if ($this->pago) {
           return '<span class="label label-sm label-info"> SI </span>';
        }else{
           return '<span class="label label-sm label-danger"> NO </span>';
        }
    }
    /**
    * Atributos estado de  Alumno
    */
    public function getEstadoAnuladoAttribute()
    {
        if ($this->anulado) {
           return '<span class="label label-sm label-info"> SI </span>';
        }else{
           return '<span class="label label-sm label-danger"> NO </span>';
        }
    }
    /**
     * Atributos Paterno
     */
    public function setPaternoAttribute($value)
    {
        $this->attributes['paterno'] = strtoupper($value);
    }
    /**
     * Atributos Paterno
     */
    public function setMaternoAttribute($value)
    {
        $this->attributes['materno'] = strtoupper($value);
    }
    /**
     * Atributos Paterno
     */
    public function setNombresAttribute($value)
    {
        $this->attributes['nombres'] = strtoupper($value);
    }

    /**
     * Atributos Foto
     */
    public function setFotoCargadaAttribute($value)
    {
        $this->attributes['foto_cargada'] = $value;
        if (Auth::user()->idrole == IdRole('alum')) {
            User::where('id',Auth::user()->id)->update(['foto'=>$value]);
        }
    }
    /**
     * Atributos Email
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $value;
        User::where('id',Auth::user()->id)->update(['email'=>$value]);
    }

    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeUsuario($cadenaSQL){
        $id = Auth::user()->id;
        return $cadenaSQL->where('idusuario',$id);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeActivos($cadenaSQL){
        $evaluacion = Evaluacion::Activo()->first();
        return $cadenaSQL->where('idevaluacion',$evaluacion->id);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeIsNull($cadenaSQL,$estado = 1){
        return $cadenaSQL->where('anulado',$estado);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopePago($cadenaSQL,$sw = 1){
        return $cadenaSQL->where('pago',$sw);
    }
    /**
    * Devuelve los postulantes Activos no anulados
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopePagantes($cadenaSQL,$pago = 0){
        return $cadenaSQL->Activos()->isNull(0)->where('pago',$pago);
    }
    /**
    * Es llamado por el controlador HomeController
    *
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeResumen($cadenaSQL){
        return $cadenaSQL->select('fecha_registro',DB::raw('count(*) as cantidad'))
                         ->Activos()
                         ->isNull(0)
                         ->groupBy('fecha_registro');
    }
    /**
    * Es llamado por el controlador HomeController
    *
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeResumenPago($cadenaSQL,$pagos){
        return $cadenaSQL->select('fecha_registro',DB::raw('count(*) as cantidad'))
                         ->Pagantes($pagos)
                         ->groupBy('fecha_registro');
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeAlfabetico($cadenaSQL){
        return $cadenaSQL->orderBy('paterno')->orderBy('materno')->orderBy('nombres');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Sexo()
    {
        return $this->hasOne(Catalogo::class,'id','idsexo');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Grado()
    {
        return $this->hasOne(Catalogo::class,'id','idgrado');
    }
    /**
     * Establecemos el la relacion con aula
     * @return [type] [description]
     */
    public function AulasD1()
    {
        return $this->hasOne(Aula::class,'id','idaula1');
    }
    /**
     * Establecemos el la relacion con aula
     * @return [type] [description]
     */
    public function AulasD2()
    {
        return $this->hasOne(Aula::class,'id','idaula2');
    }
    /**
     * Establecemos el la relacion con aula
     * @return [type] [description]
     */
    public function AulasD3()
    {
        return $this->hasOne(Aula::class,'id','idaula3');
    }
    /**
     * Establecemos el la relacion con aula
     * @return [type] [description]
     */
    public function AulasVoca()
    {
        return $this->hasOne(Aula::class,'id','idaulavoca');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Resultados()
    {
        return $this->hasOne(Resultado::class,'idpostulante','id');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Especialidades()
    {
        return $this->hasOne(Especialidad::class,'id','idespecialidad');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Ubigeos()
    {
        return $this->hasOne(Ubigeo::class,'id','idubigeo');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Colegios()
    {
        return $this->hasOne(Colegio::class,'id','idcolegio');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Evaluaciones()
    {
        return $this->hasOne(Evaluacion::class,'id','idevaluacion');
    }
    /**
     * Operaciones estaticas
     * @param [type] $data [description]
     */
    public static function AsignarCodigo($data)
    {
        $secuencia = Secuencia::all()->first();
        foreach ($data as $key => $item) {
            $numero = DB::select("SELECT nextval('$secuencia->nombre')");
            $numero = $numero[0]->nextval;
            $codigo = NumeroInscripcion(8,$numero);
            Postulante::where('id',$item['idpostulante'])->update(['codigo'=>$codigo, 'pago'=>true]);
        }
    }

    public static function AsignarAula($data)
    {
        foreach ($data as $key => $item) {
            $postulante = Postulante::where('id',$item['idpostulante'])->first();
            $sede = Catalogo::where('id',$postulante->idsede)->first();

            if ($sede->nombre == 'Lima') {
                $aula = Aula::select('id')
                                ->where('sector','<>','HYO')
                                ->where('activo',true)
                                ->where('habilitado',true)
                                ->where('disponible','>',0)
                                ->inRandomOrder()
                                ->first();
            } else {
                $aula = Aula::select('id')
                                ->where('sector','HYO')
                                ->where('activo',true)
                                ->where('habilitado',true)
                                ->where('disponible','>',0)
                                ->inRandomOrder()
                                ->first();
            }


            if (isset($aula)) {
                Aula::where('id',$aula->id)->increment('asignado');
                Aula::where('id',$aula->id)->decrement('disponible');
                Postulante::where('id',$item['idpostulante'])->update(['idaula'=>$aula->id]);
            }else{
                $aula = Aula::select('id')
                            ->where('activo',true)
                            ->where('disponible','>',0)
                            ->orderBy('orden')
                            ->take(3)
                            ->get();
                Aula::whereIn('id',$aula->toArray())->update(['habilitado'=>true]);

                $aula = Aula::select('id')
                            ->where('activo',true)
                            ->where('habilitado',true)
                            ->where('disponible','>',0)
                            ->inRandomOrder()
                            ->first();
                Aula::where('id',$aula->id)->increment('asignado');
                Aula::where('id',$aula->id)->decrement('disponible');
                Postulante::where('id',$item['idpostulante'])->update(['idaula'=>$aula->id]);

            }
        }
    }

}
