<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use App\Models\Core\User;

use DB;

class CekPersonalKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:cek-personal-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek personal key expired.';

    /**
     * Create a new command instance.
     *
     * @return void
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
        echo "cek personal key expired\n";
        $users = User::whereNotNull("personal_token")->get();
        foreach($users as $u){
            echo $u->expired_personal_token." -> ";
            if(BCL_isExpired($u->expired_personal_token)){
                echo "expired ";
                DB::table('oauth_access_tokens')->where('user_id', '=', $u->id)->where('name','=', 'UntukAksesApi-'.$u->id)->delete();
                
                $u->personal_token=null;
                $u->expired_personal_token=null;
                $u->save();
            }else{
                echo "not expired ";
            }
            echo $u->name."\n";
        }
    }
}