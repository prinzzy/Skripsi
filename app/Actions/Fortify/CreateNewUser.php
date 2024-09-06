<?php

namespace App\Actions\Fortify;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
      
            // Logging the input for debugging
            Log::info('Creating new user with input:', $input);

            Validator::make($input, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'nama' => ['required', 'string', 'max:500'],
                'sekolah' => ['required', 'string', 'max:50'],
                'tanggal_mulai' => ['required', 'date'],
                'jadwal_kelas' => ['required', 'string', 'max:50'],
                'level' => ['required', 'string', 'max:1000'],
                'pilih_les' => ['required', Rule::in(['Coding', 'Robotic', 'Animasi'])],
                'kelas' => ['required', 'string', 'max:50'],
                'nama_orangtua' => ['required', 'string', 'max:50'],
                'alamat' => ['required', 'string', 'max:200'],
                'no_hp' => ['required', 'string', 'max:50'],
            ])->validate();

            // Create the user (not yet saving it to the database)
            $user = new User([
                'name' => $input['nama_orangtua'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'role' => 'pending', // Mark as pending until payment is confirmed
            ]);

            // Create the student (not yet saving it to the database)
            $student = new Student([
                'nama' => $input['nama'],
                'sekolah' => $input['sekolah'],
                'tanggal_mulai' => $input['tanggal_mulai'],
                'jadwal_kelas' => $input['jadwal_kelas'],
                'level' => $input['level'],
                'pilih_les' => $input['pilih_les'],
                'kelas' => $input['kelas'],
                'nama_orangtua' => $input['nama_orangtua'],
                'alamat' => $input['alamat'],
                'no_hp' => $input['no_hp'],
            ]);

            // Store the user and student data in the session
            Session::put('pending_user', $user);
            Session::put('pending_student', $student);

            // Redirect to the bank transfer page
            return redirect()->route('bank-transfer.show');
        }
}
