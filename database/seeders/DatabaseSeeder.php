<?php

namespace Database\Seeders;

use App\Models\Institution;
use App\Models\NSSUnit;
use App\Models\Role;
use App\Models\User;
use App\Models\OfficerAssignment;
use App\Models\AdminInstitution;
use App\Models\VolunteerProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF');

        $roles = [
            ['name' => 'super_admin', 'description' => 'Platform super administrator'],
            ['name' => 'college_admin', 'description' => 'College/institution administrator'],
            ['name' => 'programme_officer', 'description' => 'NSS Programme Officer'],
            ['name' => 'event_coordinator', 'description' => 'Event coordinator'],
            ['name' => 'volunteer', 'description' => 'NSS Volunteer'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@nssconnect.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        DB::table('role_user')->insert(['user_id' => $superAdmin->id, 'role_id' => 1]);

        $institution = Institution::create([
            'name' => 'Demo College of Arts and Science',
            'code' => 'DCAS001',
            'address' => '123 College Road',
            'city' => 'Kochi',
            'state' => 'Kerala',
            'pincode' => '682001',
            'phone' => '+91-484-1234567',
            'email' => 'info@dcas.edu.in',
            'website' => 'https://dcas.edu.in',
        ]);

        $collegeAdmin = User::create([
            'name' => 'College Admin',
            'email' => 'college@nssconnect.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        DB::table('role_user')->insert(['user_id' => $collegeAdmin->id, 'role_id' => 2]);
        AdminInstitution::create([
            'user_id' => $collegeAdmin->id,
            'institution_id' => $institution->id,
        ]);

        $unit = NSSUnit::create([
            'institution_id' => $institution->id,
            'name' => 'NSS Unit 1',
            'code' => 'NSS-001',
            'description' => 'Primary NSS unit of Demo College',
            'capacity' => 100,
        ]);

        $officer = User::create([
            'name' => 'Programme Officer',
            'email' => 'officer@nssconnect.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        DB::table('role_user')->insert(['user_id' => $officer->id, 'role_id' => 3]);
        OfficerAssignment::create([
            'user_id' => $officer->id,
            'unit_id' => $unit->id,
        ]);

        $volunteer = User::create([
            'name' => 'Demo Volunteer',
            'email' => 'volunteer@nssconnect.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        DB::table('role_user')->insert(['user_id' => $volunteer->id, 'role_id' => 5]);
        VolunteerProfile::create([
            'user_id' => $volunteer->id,
            'institution_id' => $institution->id,
            'unit_id' => $unit->id,
            'enrollment_number' => 'NSS-2024-001',
            'full_name' => 'Demo Volunteer',
            'course' => 'BSc Computer Science',
            'department' => 'Computer Science',
            'year_of_study' => '2',
            'academic_year' => '2024-25',
            'status' => 'approved',
        ]);
    }
}
