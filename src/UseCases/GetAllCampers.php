<?php

namespace App\UseCases;

use App\Domain\Repositories\CamperRepositoryInterface;

class GetAllCampers
{
    public function __construct(private CamperRepositoryInterface $repo) {}

    public function execute(): array {
        $campers = $this->repo->getAll();
        return array_map([$this, 'transform'], $campers);
    }

    private function transform(array $camper): array {
        unset($camper['created_at'], $camper['updated_at']);
    
        $camper['nivel_ingles'] = $this->nivelTexto($camper['nivel_ingles']);
        $camper['nivel_programacion'] = $this->nivelTexto($camper['nivel_programacion']);
    
        $camperOrdenado = [
            'ID' => $camper['id'],
            'nombre' => $camper['nombre'],
            'edad' => $camper['edad'],
            'documento' => $camper['documento'],
            'tipo_documento' => $camper['tipo_documento'],
            'nivel_ingles' => $camper['nivel_ingles'],
            'nivel_programacion' => $camper['nivel_programacion'],
        ];
    
        return $camperOrdenado;
    }
    

    private function nivelTexto(int $nivel): string {
        return match(true) {
            $nivel <= 2 => 'BAJO',
            $nivel > 2 &&  $nivel <= 4 => 'MEDIO',
            $nivel > 4 &&  $nivel => 'ALTO',
            default => 'desconocido',
        };
    }
}
