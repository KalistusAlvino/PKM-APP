<?php
namespace App\Repositories\Biro;

use App\Models\Dosen;
use App\Models\Koordinator;
use App\Models\Mahasiswa;
use App\Models\RegisterDosen;
use App\Models\RegisterKoordinator;
use App\Models\User;
use App\Repositories\Biro\AkunRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function getMahasiswa(): LengthAwarePaginator{
        $mahasiswa = Mahasiswa::with('user')->paginate(10);
        return $mahasiswa;
    }
    public function detailKoordinator($id_koordinator): Koordinator {
        return Koordinator::with('user')->findOrFail($id_koordinator);
    }
    public function updateKoordinator($id_koordinator, array $data) {
        $userId = Koordinator::findOrFail($id_koordinator)->userId;
        User::findOrFail($userId)->update([
            'username' => $data['username']
        ]);
        Koordinator::findOrFail($id_koordinator)->update([
            'name' => $data['name']
        ]);
    }
    public function updateDosen($id_dosen, array $data) {
        $ketertarikan = implode(', ', $data['ketertarikan']);
        $userId = Dosen::findOrFail($id_dosen)->userId;
        User::findOrFail($userId)->update([
            'username' => $data['username']
        ]);
        Dosen::findOrFail($id_dosen)->update([
            'nip' => $data['nip'],
            'name' => $data['name'],
            'fakultas' => $data['fakultas'],
            'program_studi' => $data['program_studi'],
            'no_wa' => $data['no_wa'],
            'ketertarikan' => $ketertarikan,
        ]);
    }
    public function detailDosen($id_dosen): Dosen {
        return Dosen::with('user')->findOrFail($id_dosen);
    }

    public function gantiPassword(array $data): ?User {
        $user = User::where('username',$data['username'])->firstOrFail();

        $user->update([
            'password' => Hash::make($data['new_password']),
        ]);

        return $user;
    }
    public function deleteAccount($userId): bool {
        $user = User::findOrFail($userId);

        return $user->delete();
    }

    public function postDosen(array $data): RegisterDosen
    {
        $ketertarikan = implode(', ', $data['ketertarikan']);
        $user = User::create([
            'username' => $data['username'],
            'role' => 'dosen',
            'password' => bcrypt('12345678')
        ]);

        $dosen = Dosen::create([
            'userId' => $user->id,
            'nip' => $data['nip'],
            'name' => $data['name'],
            'fakultas' => $data['fakultas'],
            'program_studi' => $data['program_studi'],
            'no_wa' => $data['no_wa'],
            'ketertarikan' => $ketertarikan
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

   public function changePassword(array $data): ?User {
        $user = Auth::user();
         // Update password
         $user->update([
            'password' => Hash::make($data['new_password']),
        ]);

        return $user;
   }
}
