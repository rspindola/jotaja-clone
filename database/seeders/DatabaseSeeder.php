<?php

use Database\Seeders\CategorySeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\OrderItemSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Call your individual seeders in the correct order
            $this->call([
                DepartmentSeeder::class,
                CompanySeeder::class,
                CategorySeeder::class,
                ProductSeeder::class,
                CustomerSeeder::class,
                OrderSeeder::class,
                OrderItemSeeder::class,
            ]);

            // Commit the transaction if all seeding operations are successful
            DB::commit();
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs during seeding
            DB::rollback();

            // Handle or log the exception
            // For example:
            $this->command->error("Seeding failed: {$e->getMessage()}");
        }
    }
}
