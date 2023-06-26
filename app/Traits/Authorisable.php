<?php

namespace App\Traits;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

/*
 * A trait to handle authorization based on users permissions for given controller
 */

trait Authorisable
{
    /**
     * Abilities
     *
     * @var array
     */
    private $abilities = [
        'index' => 'view',
        'edit' => 'edit',
        'show' => 'view',
        'update' => 'edit',
        'create' => 'add',
        'store' => 'add',
        'destroy' => 'delete'
    ];

    /**
     * Override of callAction to perform the authorization before it calls the action
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {

   
        if( $ability = $this->getAbility($method) ) {
           
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);

        
    }


    /**
     * Get ability
     *
     * @param $method
     * @return null|string
     */
    public function getAbility($method)
    {
       
        $routeName = explode('.', \Request::route()->getName());

        // $action = array_get($this->getAbilities(), $method);
        $action = Arr::get($this->getAbilities(), $method);
    
        return $action ? $action . '_' . $routeName[1] : null; //TODO: Automate this, current model is at index 1, prefix (admin) is at index 0
    }

    /**
     * @return array
     */
    private function getAbilities()
    {
        return $this->abilities;
    }

    /**
     * @param array $abilities
     */
    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}
