<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_page_redirects_to_the_public_report_form(): void
    {
        $this->get('/')->assertRedirect(route('laporan.create'));
    }
}
