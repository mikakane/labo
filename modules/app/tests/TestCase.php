<?php
namespace Chatbox\App\Tests;

abstract class TestCase extends \Laravel\Lumen\Testing\TestCase {

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {

        return app();
    }

    /**
     * @inheritDoc
     */
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }


}
