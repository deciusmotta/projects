<?php

namespace Tests\Feature;

use App\Http\Requests\ProjectRequest;
use App\Project;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function can_create_a_project()
    {
        $project = factory(Project::class)->make()->toArray();
        $name = $project['name'];
        $this->post(route('project.store'), $project)
            ->assertStatus(201)
            ->assertJson($project)
            ->assertSee($name);
    }

    /**
     * @test
     */
    public function can_edit_project()
    {
        $project = factory(Project::class)->create()->toArray();
        $project['name'] = 'Project #1';
        $this->put(route('project.update', $project['id']), $project)
            ->assertStatus(200)
            ->assertSee('Project #1');
    }

    /**
     * @test
     */
    public function project_can_be_deleted()
    {
        $project = factory(Project::class)->create()->toArray();
        $this->delete(route('project.destroy', $project['id']))
            ->assertStatus(200)
            ->assertJson([]);
    }

    /**
     * @test
     */
    public function it_can_listed()
    {
        $projects = factory(Project::class, 3)->create()->toArray();
        $this->get(route('project.index'))
            ->assertStatus(200)
            ->assertSee($projects[0]['name'])
            ->assertSee($projects[1]['name'])
            ->assertSee($projects[2]['name']);
    }
}
