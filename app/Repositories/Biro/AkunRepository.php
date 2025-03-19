<?php
namespace App\Repositories\Biro;

use App\Models\Dosen;
use App\Models\Koordinator;
use App\Models\Mahasiswa;
use App\Models\RegisterDosen;
use App\Models\RegisterKoordinator;
use App\Models\User;
use App\Repositories\Biro\AkunRepositoryInterface;
use Illuminate\Support\Collection;
class AkunRepository implements AkunRepositoryInterface
{
    public function getDosen(): Collection
    {
        $dosen = Dosen::with('user')->get();

        return $dosen;
    }

    public function getKoordinator(): Collection {
        $koordinator = Koordinator::with('user')->get();

        return $koordinator;
    }
    public function getMahasiswa(): Collection{
        $mahasiswa = Mahasiswa::with('user')->get();

        return $mahasiswa;
    }

    public function postDosen(array $data): RegisterDosen
    {
        $user = User::create([
            'username' => $data['username'],
            'role' => 'dosen',
            'password' => bcrypt('12345678')
        ]);

        $dosen = Dosen::create([
            'userId' => $user->id,
            'nip' => $data['nip'],
            'name' => $data['name'],
            'no_wa' => $data['no_wa'],
        ]);

        return new RegisterDosen($user, $dosen);
    }

    public function postKoordinator(array $data): RegisterKoordinator {
        $user = User::create([
            'username' => $data['username'],
            'role' => 'koordinator',
            'password' => bcrypt('12345678')
        ]);

        $koordinator = Koordinator::create([
            'userId' => $user->id,
            'name' => $data['name'],
        ]);

        return new RegisterKoordinator($user, $koordinator);
    }
}
