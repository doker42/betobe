<?php

namespace Tests\Unit;

use Tests\TestCase;

class SubmissionsTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }


    public function test_submission_store()
    {
        $submission = [
            'name'    => 'Billy',
            'email'   => 'billy@mail.com',
            'message' => 'test submission text',
        ];

        $end_point = '/api/v1/submit';

        $response = $this->post($end_point, $submission);

        $response
            ->assertStatus(202)
            ->assertJson([
                'message' => __('Submission was send to store. You will get email notification'),
            ]);
    }

}
