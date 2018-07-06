<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\TeamRepository;

use App\Team;
/**
 * Class FrontendController.
 */
class AdminController extends BaseController
{

    /**
     * index/home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {   
        return view('backend.dashboard');
    }

    /**
     * admin all team page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teams()
    {
        return view('backend.teamdashboard');
    }

    /**
     * display all player.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function players()
    {
        $teamRepository = new TeamRepository(new Team());
        $teams = $teamRepository->getAll()->toArray();
        return view('backend.playerdashboard', compact('teams'));
    }
}
