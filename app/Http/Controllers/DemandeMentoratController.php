<?php
namespace App\Http\Controllers;

use App\Models\DemandeMentorat;
use App\Models\Notification;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeMentoratController extends Controller
{
    public function index()
    {
        $demandes = DemandeMentorat::all();
        return $this->customJsonResponse("Voici la liste de vos demandes de mentorat", $demandes);

    }

}

