<?php
use Illuminate\Database\Seeder;
use LRC\Data\Blood\BloodDonation;
use LRC\Data\Blood\BloodDonor;
use LRC\Data\Blood\BloodRequest;
use LRC\Data\Users\User;

use Faker\Factory as Faker;

class BloodDonationRequestTableSeeder extends Seeder {

    /**
     *
     */
    public function run()
    {
        // Delete Table
        DB::table('blood_donations')->delete();

        $faker = Faker::create();

        if ( app()->environment() == 'local' )
        {
            $users         = User::lists('id');
            $bloodRequests = BloodRequest::lists('id');
            $donors        = BloodDonor::lists('id');


            for ($i = 0; $i < 200; $i ++)
            {
                $randomUserId         = array_rand($users, 1);
                $randomBloodRequestId = array_rand($bloodRequests, 1);
                $randomDonorsId       = array_rand($donors, 1);


                BloodDonation::create(array(

                    'user_id'          => $users[$randomUserId],
                    'donor_id'         => $donors[$randomDonorsId],
                    'blood_request_id' => $bloodRequests[$randomBloodRequestId],
                    'blood'            => $faker->boolean(),
                    'platelets'        => $faker->boolean(),
                    'will_donate_on'   => date('Y-m-d',strtotime('+1 day')),
                    'note'             => $faker->realText(),

                ));
            }
        }

    }

}