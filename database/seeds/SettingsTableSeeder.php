<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create(['name' => 'system_title', 'value' => 'Inspired Solutions DMS']);
        \App\Models\Setting::create(['name' => 'system_logo', 'value' => 'images/avatar.png']);

        \App\Models\Setting::create(['name' => 'tags_label_singular', 'value' => 'category']);
        \App\Models\Setting::create(['name' => 'tags_label_plural', 'value' => 'categories']);

        \App\Models\Setting::create(['name' => 'document_label_singular', 'value' => 'document']);
        \App\Models\Setting::create(['name' => 'document_label_plural', 'value' => 'documents']);

        \App\Models\Setting::create(['name' => 'file_label_singular', 'value' => 'attachment']);
        \App\Models\Setting::create(['name' => 'file_label_plural', 'value' => 'attachments']);

        \App\Models\Setting::create(['name' => 'default_file_validations', 'value' => 'mimes:jpeg,bmp,png,jpg']);
        \App\Models\Setting::create(['name' => 'default_file_maxsize', 'value' => '8']);

        \App\Models\Setting::create(['name' => 'image_files_resize', 'value' => '300,500,700']);

        \App\Models\Setting::create(['name' => 'show_missing_files_errors', 'value' => 'true']);
    }
}
