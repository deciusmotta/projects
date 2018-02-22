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
        $Project = factory(Project::class)->make()->toArray();
        $name = $Project['name'];
        $this->post(route('project.store'), $Project)
            ->assertStatus(201)
            ->assertJson($Project)
            ->assertSee($name);
    }

    /**
     * @test
     */
    public function can_edit_project()
    {
        $Project = factory(Project::class)->create()->toArray();
        $Project['name'] = 'Project #1';
        $this->put(route('project.update', $Project['id']), $Project)
            ->assertStatus(200)
            ->assertSee('Project #1');
    }

    /**
     * @test
     */
    public function project_can_be_deleted()
    {
        $Project = factory(Project::class)->create()->toArray();
        $this->delete(route('project.destroy', $Project['id']))
            ->assertStatus(200)
            ->assertJson([]);
    }

    /**
     * @test
     */
    public function it_can_listed()
    {
        $Projects = factory(Project::class, 3)->create()->toArray();
        $this->get(route('project.index'))
            ->assertStatus(200)
            ->assertSee($Projects[0]['name'])
            ->assertSee($Projects[1]['name'])
            ->assertSee($Projects[2]['name']);
    }
}
