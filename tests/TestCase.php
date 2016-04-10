<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * テスト時に出力するログを変更します
     * テストでLogファサードやサービスコンテナのlogを利用する場合は、
     * すべてこのメソッドで指定した内容に変更されます
     * @return void
     */
    protected function registerTestLogger()
    {
        $this->app->bind('log', function ($app) {
            $logger = new \Illuminate\Log\Writer(
                new \Monolog\Logger('testing'), $app['events']
            );
            (new \Illuminate\Foundation\Bootstrap\ConfigureLogging)
                ->bootstrap($app);
            return $logger;
        });
    }
}
