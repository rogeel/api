<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ProfileRepository
 * @package namespace App\Repositories;
 */
interface ProfileRepository extends RepositoryInterface
{
    //
    /**
     * Generates an empty profile for the user
     * @param  $user_id User id
     * @return mixed         profile
     */
    public function generateProfileForUser ($user_id);


    /**
     * Adds expertise areas to an specific profile
     * @param  [type] $profile_id            [description]
     * @param  array  $expertiseAreas_ids [description]
     * @return [type]                     [description]
     */
    public function attachExpertiseAreas($profile_id, array $expertiseAreas);


    /**
     * Adds expertise topics to an specific profile
     * @param  [type] $profile_id          [description]
     * @param  array  $expertiseTopics_ids [description]
     * @return [type]                      [description]
     */
    public function attachExpertiseTopics($profile_id, array $expertiseAreas);

}
