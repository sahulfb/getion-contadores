<?Php

class PeriodoContableModel
{
    public $id;
    public $nombre;
    public $fecha_registro;
    public $fecha_modificacion;
    public $isDeleted;

    public function __construct($id) {
        Conexion::db()->where('idPeriodoContable', $id);
        $datos = Conexion::db()->get('periodos_contables');
        if(sizeof($datos) <= 0) {
            throw new Exception("Periodo contable ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idPeriodoContable'];
        $this->nombre = $datos[0]['nombre'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
        $this->isDeleted = boolval($datos[0]['isDeleted']);
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('idPeriodoContable', $this->id);
        $resp = Conexion::db()->update('periodos_contables', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar el periodo contable.');
        }
        
        foreach($data as $key => $value) {
            if(isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }
    
    /**
     * 
     */
    public function Eliminar() {
        // Verificamos si tiene alguna relacion en cobros
        Conexion::db()->where('idPeriodoContable', $this->id);
        $cantidad = Conexion::db()->getValue('cobros', 'count(*)');
        // Si el usuario tiene relación ocultamos
        if($cantidad > 0) {
            Conexion::db()->where('idPeriodoContable', $this->id);
            $resp = Conexion::db()->update('periodos_contables', ['isDeleted' => '1']);
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar ocultar el periodo contable.');
            }
        }
        // Si no eliminamos
        else {
            Conexion::db()->where('idPeriodoContable', $this->id);
            $resp = Conexion::db()->delete('periodos_contables');
            if(!$resp) {
                throw new Exception('Ocurrio un error al intentar eliminar el periodo contable.');
            }
        }
    }
}