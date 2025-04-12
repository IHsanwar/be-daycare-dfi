<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Child;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChildControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_store_child()
    {
        $user = User::factory()->create();

        $response = $this->post('/child', [
            'user_id' => $user->id,
            'nama' => 'Anak Contoh',
            'nama_pendamping' => 'Pendamping Contoh',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('children', [
            'nama' => 'Anak Contoh',
            'nama_pendamping' => 'Pendamping Contoh',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_can_delete_child()
    {
        $child = Child::factory()->create();

        $response = $this->delete("/child/{$child->id}");

        $response->assertJson([
            'success' => true,
            'message' => 'Anak berhasil dihapus.',
        ]);
        $this->assertDatabaseMissing('children', [
            'id' => $child->id,
        ]);
    }

    public function test_update_child_status_final_requires_session_data()
    {
        $child = Child::factory()->create();

        $response = $this->get("/child/update-status-final/{$child->id}");

        $response->assertRedirect(route('editStatus', ['id' => $child->id]));
        $response->assertSessionHas('error', 'Data belum lengkap.');
    }

    public function test_child_update_validation()
    {
        $user = User::factory()->create();
        $child = Child::factory()->create();

        $response = $this->put("/child/{$child->id}", [
            'nama' => '',
            'user_id' => '',
        ]);

        $response->assertSessionHasErrors(['nama', 'user_id']);
    }
}
