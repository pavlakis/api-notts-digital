<?php

namespace NottsDigital\Api\Tests;

use PHPUnit\Framework\TestCase;

class GroupConfigValidationTest extends TestCase
{
    /**
     * @var array
     */
    private $groupConfig;

    protected function setUp(): void
    {
        $groupsJson = \file_get_contents(dirname(__DIR__).'/groups.json');
        $this->groupConfig = \json_decode($groupsJson, true);
    }

    /**
     * @test
     * @dataProvider serviceDataProvider
     * @param $service
     */
    public function group_config_includes_supported_service($service): void
    {
        static::assertArrayHasKey($service, $this->groupConfig);
    }

    /**
     * @test
     */
    public function group_config_supports_two_services(): void
    {
        static::assertCount(2, $this->groupConfig);
    }

    /**
     * @test
     */
    public function meetup_groups_include_group_url_name(): void
    {
        foreach ($this->groupConfig['meetups'] as $meetup) {
            static::assertArrayHasKey('group_urlname', $meetup);
        }
    }

    public function serviceDataProvider(): array
    {
        return [
            ['meetups'],
            ['ti.to']
        ];
    }
}