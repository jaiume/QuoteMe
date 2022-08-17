<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Scout\Console\ImportCommand;
use Symfony\Component\Finder\Finder;

class SearchInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init TNTSearch';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $searchableModels = $this->getSearchableModelsFromClasses();

        $this->output->text('🔎 Init TNTSearch for all searchable models');
        $this->output->newLine();
        $this->output->progressStart(count($searchableModels));

        $rows = [];
        foreach ($searchableModels as $class) {
            $this->call(ImportCommand::class, ['model' => $class]);
            $this->output->progressAdvance();
            $rows[] = [$class, 'Done'];
        }

        $this->output->progressFinish();
        $this->output->table(
            ['Class', 'Status'],
            $rows,
            $tableStyle = 'default',
            $columnStyles = []
        );

        return 0;
    }

    /**
     * @param string $trait
     * @return array|void
     */
    private function getSearchableModelsFromClasses($trait = 'Laravel\Scout\Searchable')
    {
        $projectClasses = $this->getProjectClasses();
        return array_filter(
            $projectClasses,
            $this->isSearchableModel($trait)
        );
    }

    /**
     * @return array
     */
    private function getProjectClasses(): array
    {
        $configFiles = Finder::create()->files()->name('*.php')->notName('*.blade.php')->in(app()->path());

        foreach ($configFiles->files() as $file) {
            try {
                require_once $file;
            } catch (\Exception $e) {
                //skiping if the file cannot be loaded
            } catch (\Throwable $e) {
                //skiping if the file cannot be loaded
            }
        }

        return get_declared_classes();
    }

    /**
     * @param $trait
     * @return \Closure
     */
    private function isSearchableModel($trait): callable
    {
        return static function ($className) use ($trait) {
            $traits = class_uses($className);

            return isset($traits[$trait]);
        };
    }
}
