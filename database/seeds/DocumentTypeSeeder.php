<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\DocumentType;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        Model::unguard();


        DocumentType::firstOrCreate(['name' => 'Company Certificate']);
        DocumentType::firstOrCreate(['name' => 'Business proof of address']);
        DocumentType::firstOrCreate(['name' => 'Director passport copy']);
        DocumentType::firstOrCreate(['name' => 'Director proof of address']);
    }
}
