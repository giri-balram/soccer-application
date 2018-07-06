<?php
namespace App\Http\Controllers;

use App\Repositories\TeamRepository;
use Illuminate\Http\Request;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @var teamRepository
     */
    public $teamRepository;


    /**
     * FrontendController constructor.
     *
     * @param TeamRepository $teamRepo
     */
    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepository = $teamRepo;

    }

    /**
     * index/home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    /**
     * display all the players by team id
     * 
     * @param int $id - team id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTeamPlayers($id)
    {
        return view('frontend.team')->withId($id);
    }
    
}
