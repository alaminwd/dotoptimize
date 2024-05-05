<?php

namespace App\Console\Commands;

use App\Models\StripeApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateEnvVariablesForStripeApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-env-variables-for-stripe-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will be Update env variables For Stripe Api';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stripe_api= StripeApi::select('stripe_key','stripe_secret')->first()->toArray();

        $envFilePath = base_path('.env');

        $envContent = File::get($envFilePath);
       

        foreach ($stripe_api as $originalKey => $value) {
            $key = strtoupper($originalKey);
            $escapedKey = preg_quote($key, '/');
           
            $envContent =  preg_replace("/($escapedKey\s*=\s*)(['\"]?)\S*\\2/i", "$1\"$value\"", $envContent);
           
        }

        File::put($envFilePath, $envContent);

        $this->info('Environment variables updated successfully!');
    }
}
