<?php

namespace App\Console\Commands;

use App\Models\BkashApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateEnvVariablesForBkashApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-env-variables-for-bkash-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This Command will be Update env variables For Bkash Api";
        
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bakashApis= BkashApi::select('bkash_username','bkash_password','bkash_app_key','bkash_app_secret')->first()->toArray();
       
    
        $envFilePath = base_path('.env');

        $envContent = File::get($envFilePath);

        
        foreach ($bakashApis as $originalKey => $value) {
            $key = strtoupper($originalKey);
            $escapedKey = preg_quote($key, '/');
           
            $envContent = preg_replace("/($escapedKey\s*=\s*)(['\"]?)\S*\\2/i", "$1\"$value\"", $envContent);

           
        }
        
       
        File::put($envFilePath, $envContent);

        $this->info('Environment variables updated successfully!');
    }
}
