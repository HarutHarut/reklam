<?php

namespace App\Repositories;

use App\Models\MaliOglasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProfileRepository.
 */
class ProfileRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return MaliOglasi::class;
    }

    public function deleteListing($user = null, $id)
    {
//        $user = Auth::user();
        $data = [];
        $listing = $this->model->find($id);
//        if($user->customer && $listing->user_id == $user->customer->id){
            $data['listingFilter'] = $listing->filterMaliOglases;
            $data['listingImages'] = $listing->listingImages;
            $data['listingContacts'] = $listing->maliOglasiKontakts;
            $data['listingComments'] = $listing->zlorabas;

            foreach ($data as $key => $value){
                if(count($value)){
                    if($key == 'listingImages'){
                        $url = 'public/products/' . $id;
                        Storage::deleteDirectory($url);
                    }
                    foreach ($value as $item){
                        $item->delete();
                    }
                }
            }
            $listing->delete();
//        }

    }
}
