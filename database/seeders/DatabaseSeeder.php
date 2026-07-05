<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PageSeeder::class,
            BannerSeeder::class,
            ButtonBannerSeeder::class,
            FeatureBannerSeeder::class,
            DestinationSeeder::class,
            DestinationHighlightSeeder::class,
            DestinationIncludeSeeder::class,
            DestinationItineraryDaySeeder::class,
            DestinationItineraryActivitySeeder::class,
            ServiceSeeder::class,
            ContactSeeder::class,
            SocialLinkSeeder::class,
            PaymentMethodSeeder::class,
            FaqSeeder::class,
        ]);
    }
}

