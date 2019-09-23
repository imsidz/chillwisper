<?php

use App\Models\PassportKey;
use Illuminate\Database\Seeder;

class PassportKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $passport = new PassportKey;
        $passport->name = 'Jobportal API Personal Access Client';
        $passport->secret = 'LFqWJQbjGokZLvC8FVx2IjBWpIpwRIh7m8Cl2gMd';
        $passport->redirect = 'https://chillwisper.test.com';
        $passport->personal_access_client = 1;
        $passport->password_client = 0;
        $passport->revoked = 0;
        $passport->save();
        $passport = new PassportKey;
        $passport->name = 'Jobportal API Password Grant Client';
        $passport->secret = 'BeDpu3yd97Nqghp2E1fVbHreaNdDMSwEOfTDYhlI';
        $passport->redirect = 'https://chillwisper.test.com';
        $passport->personal_access_client = 0;
        $passport->password_client = 1;
        $passport->revoked = 0;
        $passport->save();
    }
}
