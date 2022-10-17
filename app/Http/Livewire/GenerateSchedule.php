<?php

namespace App\Http\Livewire;

use App\Models\Progress;
use App\Models\Team;
use Carbon\Carbon;
use Livewire\Component;

class GenerateSchedule extends Component
{
    public function render()
    {
        return view('livewire.generate-schedule');
    }

    //Genera el horario del grupo seleccionado
    public function generate()
    {
        if ($this->group_id !== '') {
            $equipos = Team::select('teams.id', 'teams.group_id AS grupo')
                ->where('group_id', $this->group_id)
                ->orderBy('grupo')->get();
            $fechaJornada = Carbon::now();

            $array = array();
            $grupo = array();

            for ($k = 0; $k < count($equipos); $k++) {

                array_push($grupo, $equipos[$k]);

                if ($k === count($equipos) - 1 || ($equipos[$k]->grupo !== $equipos[$k + 1]->grupo)) {
                    if (count($grupo) % 2 !== 0) {
                        $auxEquipo = [
                            'id' => 0,
                            'gruop_id' => $grupo[count($grupo) - 1]->grupo
                        ];
                        $auxEquipo = json_encode($auxEquipo);
                        $auxEquipo = json_decode($auxEquipo);
                        array_push($grupo, $auxEquipo);
                    }

                    for ($i = 0; $i < count($grupo) - 1; $i++) {
                        for ($j = 0; $j < count($grupo) / 2; $j++) {
                            $objeto = [
                                'team1_id' => $grupo[$j]->id,
                                'team2_id' => $grupo[count($grupo) - 1 - $j]->id,
                                'date' => $fechaJornada->toDateString(),
                                'time' => $fechaJornada->toTimeString(),
                                'team1_goal' => 0,
                                'team2_goal' => 0,
                                'played' => false
                            ];
                            array_push($array, $objeto);
                        }
                        $grupo = $this->rotate($grupo);
                        $fechaJornada->addDays(7);
                    }
                    $grupo = array();
                }
            }
            $auxArray = array();
            for ($i = 0; $i < count($array); $i++) {
                if ($array[$i]['team2_id'] !== 0) {
                    array_push($auxArray, $array[$i]);
                }
            }

            Progress::first()->games()->createMany($auxArray);
        }
    }

    private function rotate($array)
    {
        $auxArray = array();
        $aux = $array[0];

        for ($i = 0; $i < count($array) - 2; $i++) {
            // $auxArray[$i] = $array[$i + 1];
            array_push($auxArray, $array[$i + 1]);
        }
        array_push($auxArray, $aux);

        array_push($auxArray, $array[count($array) - 1]);

        return $auxArray;
    }
}
