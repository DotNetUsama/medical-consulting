<?php

namespace App\Http\Controllers;

use App\Models\MedicalTopic;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var TopicRepository
     */
    private $topicRepository;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function home() {
        return view('pages.home', ['topics' => $this->topicRepository->all()]);
    }
}
