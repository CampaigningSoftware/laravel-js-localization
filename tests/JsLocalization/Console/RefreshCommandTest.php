<?php

use Mockery as m;
use JsLocalization\Console\RefreshCommand;

class RefreshCommandTest extends TestCase
{
    public function tearDown(): void
    {
        m::close();

        parent::tearDown();
    }

    public function testNoLocalesConfigException()
    {
        $this->expectException(Exception::class);

        // Run the command directly to avoid Config mock conflicts with testbench
        $cmd = new JsLocalization\Console\RefreshCommand();
        $cmd->setLaravel(app(\Illuminate\Contracts\Foundation\Application::class));

        // Override just the locales config to null
        Config::set('js-localization.locales', null);

        $cmd->run(
            new Symfony\Component\Console\Input\ArrayInput([]),
            new Symfony\Component\Console\Output\NullOutput()
        );
    }

    protected function runCommand()
    {
        $cmd = new RefreshCommand();

        $cmd->setLaravel(app(\Illuminate\Contracts\Foundation\Application::class));

        $cmd->run(
            new Symfony\Component\Console\Input\ArrayInput([]),
            new Symfony\Component\Console\Output\NullOutput()
        );
    }

}
