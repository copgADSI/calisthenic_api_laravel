<?php

namespace Tests\Feature\Excercises;

use App\Models\Excercises\Excercises;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExcercisesTest extends TestCase
{
    /**
     * listar ejercicios
     *
     * @return void
     */
    public function test_a_view_with_list_excercises()
    {
        $response = $this->get(route('excercises.list'));

        $response->assertStatus(200);
    }

    /**
     * Crear ejecicio
     */
    public function test_create_a_excercises(): void
    {
        $user = User::where('role_id', '=', 1)->first();
        $this->actingAs($user);
        $response = $this->post(route('excercises.store', [
            'name' => 'Pull Ups con agarre Prono',
            'description' => 'Algunos de los músculos que se trabajan en las dominadas son: dorsal mayor, dorsal intraespinoso, trapecio, romboides, pectoral mayor y menor, deltoides, infraespinoso, bíceps, bíceps braquial, oblicuo externo, tríceps y pectoral, entre otros.',
            'gif' => 'test.gif',
            'user_id' => $user->id
        ]));

        $response_data = $response->json();

        if (array_key_exists('error, ejecicio ya existe', $response_data)) {
            $this->assertDatabaseHas('excercises', $response_data['error, ejecicio ya existe']);
        } else {
            $this->assertDatabaseHas('excercises', $response_data);
        }
        $this->assertTrue(true);
        $response->assertStatus(200);
    }

    public function test_a_get_excercises()
    {
        $response = $this->get(route('excercises_list'));
        $response_data = $response->json();

        $this->assertDatabaseCount('excercises', $response_data['total']);
        foreach ($response_data['excercises'] as $excercise) {
            $this->assertDatabaseHas('excercises', $excercise);
        }
        $response->assertStatus(200);
    }

    public function test_a_delete_excercise()
    {
        $user = User::where('role_id', '=', 1)->first();
        $this->actingAs($user);

        $excercise_id  = Excercises::first()->id;
        $response = $this->post(route(
            'excercises.destroy',
            [
                'id' => $excercise_id,
                'user_id' => $user->id
            ]
        ));
        $response_data = $response->json();
        if (!is_null('Ejecicio eliminado con éxito!')) {
            $response->assertStatus(200);
        }
    }

    public function test_a_update_excercise()
    {
        $user = User::where('role_id', '=', 1)->first();
        $this->actingAs($user);

        $excercise  = Excercises::inRandomOrder()->first();
        $excercise->name = "Pull Ups con agarre Prono actualiazo";
        $excercise->description = "{$excercise->description}";
        $response = $this->post(route('excercises.update', $excercise->toArray()));

        $response_data = $response->json();
        $this->assertDatabaseHas('excercises', $response_data['excercise']);
        $response->assertStatus(200);
    }

    /**
     * Método usado para actualizar ejercicios desde un formulario no API
     */
    public function test_a_update_excercise_data_form(): void
    {

        $user = User::where('role_id', '=', 1)->first();
        $this->actingAs($user);

        $excercise  = Excercises::inRandomOrder()->first();
        $excercise->name = "Pull Ups con agarre Prono actualiazo 2020";
        $excercise->description = "{$excercise->description}";
        $response = $this->post(route('excercises.update_data', $excercise->toArray()));
        $this->assertDatabaseHas('excercises', $excercise->toArray());
    }

    public function test_a_get_all_excercises()
    {
        $response = $this->get(route('getAllExcercises'));
        $response_data = $response->json();
        foreach ($response_data['results'] as $key => $value) {
            $this->assertArrayHasKey($key, $response_data['results']);
        }
        $this->assertDatabaseCount('excercises', ($response_data['results']['total']));
        $response->assertStatus(200);
    }
}
