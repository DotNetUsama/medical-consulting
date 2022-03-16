<?php


namespace App\Repositories;

use App\Models\MedicalTopic;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TopicRepository
{
    public function all() {
        return MedicalTopic::all();
    }

    public function create(array $topicData) {
        $topicData['image'] = $this->uploadImage($topicData['image'], 'topics/images');
        $createdTopic = new MedicalTopic($topicData);
        $createdTopic->category()->associate($topicData['category'])->save();
    }

    public function update(MedicalTopic $topic, array $topicData) {
        if (isset($topicData['image']) && File::exists(public_path($topic->image))) {
            File::delete(public_path($topic->image));
            $topicData['image'] = $this->uploadImage($topicData['image'], 'topics/images');
        }
        if ($topic->category_id !== $topicData['category']) {
            $topic->category()->associate($topicData['category']);
        }
        $topic->update($topicData);
    }

    private function uploadImage(UploadedFile $file, string $destination): string{
        $name = md5(uniqid(rand(), true)) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($destination, $name, 'public');
        return Storage::url($path);
    }
}
