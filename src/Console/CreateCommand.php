<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Console;

use CodeSinging\PinAdmin\Foundation\Application;
use CodeSinging\PinAdmin\Support\Console\ArrayHelpers;
use CodeSinging\PinAdmin\Support\Console\Command;
use CodeSinging\PinAdmin\Support\Console\FileHelpers;
use CodeSinging\PinAdmin\Support\Console\PackageHelpers;
use Illuminate\Support\Str;

class CreateCommand extends Command
{
    use FileHelpers;
    use ArrayHelpers;
    use PackageHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Application::LABEL . ':create {name}';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Create a PinAdmin application';

    /**
     * 应用索引
     *
     * @var array
     */
    protected array $indexes = [];

    /**
     * @var array|string[]
     */
    protected array $devDependencies = [
        'vue' => '^3.2.29',
        'tailwindcss' => '^3.0.18',
        'element-plus' => '^2.0.1',
        'pinia' => '^2.0.11',
        'axios' => '^0.25.0',
        'vue-loader' => '^16.2.0',
        'postcss' => '^8.1.14',
        'autoprefixer' => '^10.4.2',
    ];

    /**
     * 应用实例
     *
     * @var Application
     */
    protected Application $app;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->verify($name = Str::snake($this->argument('name')))) {
            $this->app = new Application($name);
            $this->indexes = $this->app->indexes();

            if (array_key_exists($this->app->name(), $this->indexes)) {
                $this->error(sprintf('Application [%s] already exists', $this->app->name()));
            } else {
                $this->createApp();
            }
        } else {
            $this->error(sprintf('Application name [%s] is invalid', $name));
        }
    }

    /**
     * 验证应用名是否合法
     *
     * @param string $name
     *
     * @return bool
     */
    private function verify(string $name): bool
    {
        return !empty($name) && preg_match('/^[a-zA-Z]+\w*$/', $name) === 1;
    }

    /**
     * 模板中所有需要替换的标记
     *
     * @return array
     */
    private function stubReplaces(): array
    {
        return [
            '__DUMMY_UPPER_LABEL__' => Str::upper($this->app->label()),
            '__DUMMY_NAME__' => $this->app->name(),
            '__DUMMY_STUDLY_NAME__' => $this->app->studlyName(),
            '__DUMMY_CAMEL_NAME__' => Str::camel($this->app->name()),
            '__DUMMY_UPPER_NAME__' => Str::upper($this->app->name()),
            '__DUMMY_GUARD__' => $this->app->guard(),
            '__DUMMY_NAMESPACE__' => $this->app->getNamespace(),
            '__DUMMY_DIST_PATH__' => 'public/' . $this->app->publicDirectory(),
            '__DUMMY_SRC_PATH__' => $this->app->directory('resources'),
            '__DUMMY_DIRECTORY__' => $this->app->directory(),
            '__DUMMY_BASE_URL__' => $this->app->homeUrl(),
            '__DUMMY_HOME_URL__' => $this->app->homeUrl(),
            '__DUMMY_HOME_FULL_URL__' => $this->app->homeUrl(true),
            '__DUMMY_ASSET_URL__' => $this->app->asset(),
        ];
    }

    /**
     * 创建应用基础目录
     *
     * @return void
     */
    private function createDirectories()
    {
        $this->title('Creating application directories');

        $this->makeDirectory($this->app->path());
        $this->makeDirectory($this->app->appPath());
        $this->makeDirectory($this->app->publicPath());
    }

    /**
     * @return void
     */
    private function createApp(): void
    {
        $this->createDirectories();
        $this->createRoutes();
        $this->createConfigs();
        $this->createControllers();
        $this->createModels();
        $this->createMigrations();
        $this->createSeeders();
        $this->initDatabase();
        $this->createResources();
        $this->updatePackageJson();
        $this->updateIndexes();
    }

    /**
     * Create application routes.
     */
    private function createRoutes(): void
    {
        $this->title('Create application routes');
        $this->copyFiles(
            $this->app->packagePath('stubs', 'routes'),
            $this->app->path('routes'),
            $this->stubReplaces()
        );
    }

    /**
     * Create application config file.
     */
    private function createConfigs(): void
    {
        $this->title('Create application config file');
        $this->copyFile(
            $this->app->packagePath('stubs', 'config', 'app.php'),
            $this->app->path('config', 'app.php'),
            $this->stubReplaces()
        );
    }

    /**
     * Create default controller files.
     */
    private function createControllers(): void
    {
        $this->title('Create application controllers');
        $this->copyFiles(
            $this->app->packagePath('stubs', 'controllers'),
            $this->app->appPath('Controllers'),
            $this->stubReplaces()
        );
    }

    /**
     * Create default application models.
     */
    private function createModels(): void
    {
        $this->title('Create application models');
        $this->copyFiles(
            $this->app->packagePath('stubs', 'models'),
            $this->app->appPath('Models'),
            $this->stubReplaces(),
            $this->stubReplaces()
        );
    }

    /**
     * Create default application migrations.
     */
    private function createMigrations(): void
    {
        $this->title('Create application migrations');
        $this->copyFiles(
            $this->app->packagePath('stubs', 'migrations'),
            $this->app->path('migrations'),
            $this->stubReplaces(),
            $this->stubReplaces()
        );
    }

    /**
     * Create default application seeders.
     *
     * @return void
     */
    private function createSeeders(): void
    {
        $this->title('Create application seeders');
        $this->copyFiles(
            $this->app->packagePath('stubs', 'seeders'),
            $this->app->appPath('Seeders'),
            $this->stubReplaces(),
            $this->stubReplaces()
        );
    }

    /**
     * @return void
     */
    private function initDatabase(): void
    {
        $this->title('Run application database migrations');
        $this->call('migrate', [
            '--path' => $this->app->directory('migrations')
        ]);
        if (!$this->laravel->runningUnitTests()) {
            $this->title('Run application database seeders');
            $this->call('db:seed', [
                '--class' => $this->app->getNamespace('Seeders/DatabaseSeeder'),
            ]);
        }
    }

    /**
     * @return void
     */
    private function createResources()
    {
        $this->title('Publishing application resources');

        $this->copyFile(
            $this->app->packagePath('stubs/resources/env.js'),
            $this->app->path('resources/env.js'),
            $this->stubReplaces()
        );

        $this->copyDirectory($this->app->packagePath('public'), $this->app->publicPath());
        $this->copyDirectory($this->app->packagePath('resources'), $this->app->path('resources'));
    }

    /**
     * @return void
     */
    private function updatePackageJson()
    {
        $webpack = $this->app->directory('resources/build/webpack.mix.js');
        $script = $this->app->label($this->app->name(), ':');

        $this->addPackageScripts([
            'dev:' . $script => "mix --mix-config=$webpack",
            'watch:' . $script => "mix watch --mix-config=$webpack",
            'prod:' . $script => "mix --production --mix-config=$webpack",
        ]);

        $this->addDevDependencies($this->devDependencies);
    }

    /**
     * 更新应用索引
     *
     * @return void
     */
    private function updateIndexes()
    {
        $this->title('Update application indexes');

        $this->indexes[$this->app->name()] = [
            'status' => true,
        ];

        $this->copyFile(
            $this->app->packagePath('stubs', 'apps.php'),
            $this->app->rootPath(Application::INDEX_FILENAME),
            [
                '__DUMMY_INDEXES__' => $this->varExport($this->indexes, true),
            ]
        );
    }
}
