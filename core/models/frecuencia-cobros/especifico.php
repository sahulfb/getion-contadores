<?Php

class FrecuenciaCobroModel
{
    public $id;
    public $nombre;
    public $frecuencia;
    public $fecha_registro;
    public $fecha_modificacion;

    public function __construct($id) {
        Conexion::db()->where('idFrecuenciaCobro', $id);
        $datos = Conexion::db()->get('frecuencia_cobro');
        if(sizeof($datos) <= 0) {
            throw new Exception("Periodo de cobro ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idFrecuenciaCobro'];
        $this->nombre = $datos[0]['nombre'];
        $this->frecuencia = $datos[0]['frecuencia'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('idFrecuenciaCobro', $this->id);
        $resp = Conexion::db()->update('frecuencia_cobro', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el periodo de cobro.');
        }
        
        foreach($data as $key => $value) {
            if(isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }
}