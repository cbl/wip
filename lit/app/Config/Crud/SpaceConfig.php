<?php

namespace Lit\Config\Crud;

use App\Models\Space;
use Ignite\Crud\Config\CrudConfig;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Crud\SpaceController;

class SpaceConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = Space::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = SpaceController::class;

    /**
     * Model singular and plural name.
     *
     * @param Space|null space
     * @return array
     */
    public function names(Space $space = null)
    {
        return [
            'singular' => 'Space',
            'plural'   => 'Spaces',
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'spaces';
    }

    /**
     * Build index page.
     *
     * @param  \Ignite\Crud\CrudIndex $page
     * @return void
     */
    public function index(CrudIndex $page)
    {
        $page->table(function ($table) {
            $table->col('Title')->value('{title}')->sortBy('title');
        })->search('title');
    }

    /**
     * Setup show page.
     *
     * @param  \Ignite\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->card(function ($form) {
            $form->relation('opening_hours')
                // ->use(OpeningHourConfig::class)
                ->deleteUnlinked()
                ->showTableHead()
                ->names([
                    'singular' => 'Opening Hour',
                    'plural'   => 'Opening Hours',
                ])
                ->preview(function ($preview) {
                    $this->weekDay(
                        $preview->field('week_day', 'Week Day')
                    );

                    $preview->field('opening_time', 'Opening Time')
                        ->datetime('opening_time')
                        ->onlyTime()
                        ->minuteInterval(15);

                    $preview->field('closing_time', 'Closing Time')
                        ->datetime('closing_time')
                        ->onlyTime()
                        ->minuteInterval(15);

                    $preview->field('on_request', 'On Request')
                        ->boolean('on_request');
                })
                ->create(function ($form) {
                    $this->weekDay($form)->width(8);

                    $form->boolean('on_request')->width(4);

                    $form->datetime('opening_time')
                        ->onlyTime()
                        ->minuteInterval(15)
                        ->width(1 / 2)
                        ->rules('required');

                    $form->datetime('closing_time')
                        ->onlyTime()
                        ->minuteInterval(15)
                        ->width(1 / 2)
                        ->rules('required');
                });
        });
    }

    protected function weekDay($form)
    {
        return $form->select('week_day')
            ->options([
                'monday'    => 'Monday',
                'tuesday'   => 'Tuesday',
                'wednesday' => 'Wednesday',
                'thursday'  => 'Thursday',
                'friday'    => 'Friday',
                'saturday'  => 'Saturday',
                'sunday'    => 'Sunday',
            ]);
    }
}
