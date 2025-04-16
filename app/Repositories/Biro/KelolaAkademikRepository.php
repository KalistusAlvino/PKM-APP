<?php

namespace App\Repositories\Biro;

use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\SkemaPkm;
use Illuminate\Support\Collection;

class KelolaAkademikRepository implements KelolaAkademikRepositoryInterface
{
    public function getFakultas(): Collection
    {
        return Fakultas::all();
    }

    public function getProdi(): Collection
    {
        return ProgramStudi::with('fakultas')->get();
    }

    public function postSkema(array $data): SkemaPkm
    {
        return SkemaPkm::create([
            'nama_skema' => $data['nama_skema']
        ]);
    }

    public function postFakultas(array $data): Fakultas
    {
        return Fakultas::create([
            'nama_fakultas' => $data['nama_fakultas']
        ]);
    }
    public function postProdi(array $data): ProgramStudi
    {
        return ProgramStudi::create([
            'fakultas_id' => $data['fakultas_id'],
            'nama_prodi' => $data['nama_prodi'],
        ]);
    }

    public function findSkemaById($id_skema): SkemaPkm
    {
        return SkemaPkm::findOrFail($id_skema);
    }
    public function findFakultasById($id_fakultas): Fakultas
    {
        return Fakultas::findOrFail($id_fakultas);
    }
    public function findProdiById($id_prodi): ProgramStudi
    {
        return ProgramStudi::with('fakultas')->findOrFail($id_prodi);
    }

    public function updateSkema(array $data, $id_skema): SkemaPkm
    {
        $skema = $this->findSkemaById($id_skema);
        if ($skema) {
            $skema->update([
                'nama_skema' => $data['nama_skema'],
            ]);
        }
        return $skema;
    }
    public function updateFakultas(array $data, $id_fakultas): Fakultas {
        $fakultas = $this->findFakultasById($id_fakultas);
        if ($fakultas) {
            $fakultas->update([
                'nama_fakultas' => $data['nama_fakultas'],
            ]);
        }
        return $fakultas;
    }
    public function updateProdi(array $data, $id_prodi): ProgramStudi
    {
        $prodi = $this->findProdiById($id_prodi);
        if ($prodi) {
            $prodi->update([
                'fakultas_id' => $data['fakultas_id'],
                'nama_prodi' => $data['nama_prodi'],
            ]);
        }
        return $prodi;
    }

    public function deleteSkema($id_skema): bool
    {
        $skema = $this->findSkemaById($id_skema);
        if ($skema) {
            return $skema->delete();
        }
        return false;
    }
    public function deleteFakultas($id_fakultas): bool
    {
        $fakultas = $this->findFakultasById($id_fakultas);
        if ($fakultas) {
            return $fakultas->delete();
        }
        return false;
    }
    public function deleteProdi($id_prodi): bool
    {
        $prodi = $this->findProdiById($id_prodi);
        if ($prodi) {
            return $prodi->delete();
        }
        return false;
    }
}
