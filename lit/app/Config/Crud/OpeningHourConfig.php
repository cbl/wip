<?php

namespace Lit\Config\Crud;

use App\Models\OpeningHour;
use Ignite\Crud\Config\CrudConfig;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Crud\OpeningHourController;

class OpeningHourConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = OpeningHour::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = OpeningHourController::class;

    /**
     * Model singular and plural name.
     *
     * @param OpeningHour|null openingHour
     * @return array
     */
    public function names(OpeningHour $openingHour = null)
    {
        return [
            'singular' => 'Opening Hour',
            'plural'   => 'Opening Hours',
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'opening-hours';
    }

    /**
     * Build index page.
     *
     * @param  \Ignite\Crud\CrudIndex $page
     * @return void
     */
    // public function index(CrudIndex $page)
    // {
    //     $page->table(function ($table) {
    //         $table->col('Title')->value('{title}')->sortBy('title');
    //     })->search('title');
    // }

    /**
     * Setup show page.
     *
     * @param  \Ignite\Crud\CrudShow $page
     * @return void
     */
    // public function show(CrudShow $page)
    // {
    //     $page->card(function ($form) {
    //         $form->input('title');
    //     });
    // }
}
