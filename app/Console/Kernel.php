<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Redirect;

use App\Models\Categorie;
use App\Models\Publication;
use App\Models\Souscription;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {

            $data = DB::table('souscriptions')->where('dateEnd',date('Y-m-d'))
            ->get();

            foreach ($ata as $key => $value) {

                $su = new Souscription();
                $su->idUser = $value->idUser;
                $su->idPack = 0;
                $su->description = "Abonnement de type gratuit";
                $su->dateStart = date('Y-m-d');
                $su->dateEnd = Null;
                $su->idTransaction = "free_Transaction";
                $su->save();
            }

        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
