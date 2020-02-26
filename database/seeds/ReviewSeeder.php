<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Review;
use joshtronic\LoremIpsum;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ipsum = new LoremIpsum();
        $user_sitter = User::where('email', 'dev-test-sitter@kingdomcaresitters.com')->first();
        $user_parent = User::where('email', 'dev-test-parent@kingdomcaresitters.com')->first();
        $user_parent = User::where('email', 'dev-test-parent@kingdomcaresitters.com')->first();

        $review_1 = new Review(array(
            'review_by_id' => $user_parent->id,
            'review_for_id' => $user_sitter->id,
            'rating' => 3,
            'content' => $ipsum->paragraphs(2)
        ));
        $review_1->save();


    }
}
