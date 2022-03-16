<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\MedicalTopic;
use App\Repositories\CategoryRepository;
use App\Repositories\TopicRepository;
use Illuminate\Support\Facades\File;

class TopicController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var TopicRepository
     */
    private $topicRepository;

    public function __construct(CategoryRepository $categoryRepository, TopicRepository $topicRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->topicRepository = $topicRepository;
    }

    public function index() {
        return view('pages/topics/index', ['topics' => $this->topicRepository->all()]);
    }

    public function show(MedicalTopic $topic) {
        $topic->update(['views' => $topic->views + 1]);
        return view('pages.topics.show', ['topic' => $topic]);
    }

    public function createForm() {
        return view('pages/topics/create', ['categories' => $this->categoryRepository->all()]);
    }

    public function create(CreateTopicRequest $request) {
        $topicData = $request->validated();
        try {
            $this->topicRepository->create($topicData);
            session()->flash('success', 'topics created successfully.');
            return redirect(route('topics.index'));
        } catch (\Exception $exception) {
            session()->flash('danger', 'sorry, something went wrong, please try again later.');
            return redirect(route('topics.create.form'));
        }
    }

    public function editForm(MedicalTopic $topic) {
        return view('pages/topics/edit', [
            'topic' => $topic,
            'categories' => $this->categoryRepository->all()
        ]);
    }

    public function update(MedicalTopic $topic, UpdateTopicRequest $request) {
        $topicData = $request->validated();
        try {
            $this->topicRepository->update($topic, $topicData);
            session()->flash('success', 'topics updated successfully.');
            return redirect(route('topics.index'));
        } catch (\Exception $exception) {
            session()->flash('danger', 'sorry, something went wrong, please try again later.');
            return redirect(route('topics.edit.form', ['topic' => $topic->id]));
        }
    }

    public function delete(MedicalTopic $topic) {
        try {
            File::delete(public_path($topic->image));
            $topic->delete();
            return redirect(route('topics.index'));
        } catch (\Exception $exception) {
            session()->flash('danger', 'sorry, something went wrong, please try again later.');
            return redirect(route('topics.index'));
        }
    }
}
