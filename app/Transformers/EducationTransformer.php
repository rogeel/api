<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Education;
use Storage;
use File;

/**
 * Class EducationTransformer
 * @package namespace App\Transformers;
 */
class EducationTransformer extends TransformerAbstract
{

    /**
     * Transform the \Education entity
     * @param \Education $model
     *
     * @return array
     */
    public function transform(Education $model)
    {   
        if(Storage::disk('local')->exists($model->file)){
            $fileContent = Storage::disk('local')->get($model->file);
            $fileBase64= base64_encode($fileContent);
            $mime = Storage::mimeType($model->file);
            $fname = basename($model->file);
            $fileData = array('fileBase64' => $fileBase64, 'mime'=>$mime, 'name'=>$fname);
        }else{
            $fileData = '';
        }

        return [

            'id'         => (int) $model->id,
            'profile_id' => $model->profile_id,
            'institution'       => $model->institution,
            'dateFrom'       => $model->start_date,
            'dateEnd' => $model->finish_date,
            'levelFormation'       => $model->level,
            'educationField'       => $model->field_study,
            'file'       => $model->file,
            'fileData' => $fileData,


            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at

            /* place your other model properties here */


        ];
    }
}
