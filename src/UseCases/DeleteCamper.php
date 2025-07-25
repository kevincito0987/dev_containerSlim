<?php

namespace App\UseCases;
use App\Domain\Repositories\CamperRepositoryInterface;
use App\Domain\Models\Camper;




class DeleteCamper {

    public function __construct(private CamperRepositoryInterface $repo) {}

    public function execute(int $documento): ?array {
        $camper = $this->repo->getById($documento);
    
        if (!$camper) return null;
    
        $data = [
            'ID' => $camper->id,
            'nombre' => $camper->nombre,
            'edad' => $camper->edad,
            'documento' => $camper->documento,
            'tipoDocumento' => $camper->tipo_documento,
            'nivelIngles' => $this->nivelTexto($camper->nivel_ingles),
            'nivelProgramacion' => $this->nivelTexto($camper->nivel_programacion),
        ];
    
        $camper->delete();
    
        $this->reordenarIds(); // 👈 Nuevo paso agregado
    
        return $data;
    }

    private function reordenarIds(): void {
        $campers = Camper::orderBy('id')->get();
        $contador = 1;
    
        foreach ($campers as $camper) {
            $camper->id = $contador++;     // Reasigna el ID incremental
            $camper->save();
        }
    }
    
    

    private function nivelTexto(int $nivel): string {
        return match(true) {
            $nivel <= 2 => 'BAJO',
            $nivel <= 4 => 'MEDIO',
            $nivel > 4 => 'ALTO',
            default => 'DESCONOCIDO',
        };
    }
}


?>