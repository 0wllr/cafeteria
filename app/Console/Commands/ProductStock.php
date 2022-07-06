<?php

namespace App\Console\Commands;

use App\Mail\LimStock;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Product:Stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comprueba el Stock de Productos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $product = Product::all();

        $useradmin =DB::table('users')->where('role', 'ROLE_ADMIN')->get();
        $uservend =DB::table('users')->where('role', 'ROLE_VENDEDOR')->get();

        foreach ($product as $products) {
            if ($products->stock <= 5) {
                foreach ($useradmin as $users) {
                    Mail::to($users)->send(new
                    LimStock($products));

                    Log::info("Successfully, cron Admin is running");
                }
            }
        }

        foreach ($product as $products) {
            if ($products->stock <= 5) {
                foreach ($uservend as $userss) {
                    Mail::to($userss)->send(new
                    LimStock($products));

                    Log::info("Successfully, cron Vendedor is running");
                }
            }
        }


    }
}
