<?php

namespace Tests\Feature;

use Corals\Modules\Utility\Category\Models\Attribute;
use Corals\User\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UtilityAttributesTest extends TestCase
{
    use DatabaseTransactions;

    protected $attribute = [];

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $user = User::query()->whereHas('roles', function ($query) {
            $query->where('name', 'superuser');
        })->first();
        Auth::loginUsingId($user->id);
    }

    public function test_utility_attribute_store()
    {
        $attributes = get_array_key_translation(config('settings.models.custom_field_setting.supported_types'));
        $attribute = array_rand($attributes);
        $response = $this->post('utilities/attributes', [
            'type' => $attribute,
            'label' => $attribute,
            "display_order" => '0',
            "required" => false,
            "use_as_filter" => false,
        ]);
        $this->attribute = Attribute::query()->first();

        $response->assertRedirect('utilities/attributes');
    }

    public function test_utility_attribute_edit()
    {
        if ($this->attribute) {
            $response = $this->get('utilities/attributes/' . $this->attribute->hashed_id . '/edit');

            $response->assertStatus(200)->assertViewIs('utility-category::.attributes.create_edit');
        }
        $this->assertTrue(true);
    }

    public function test_utility_attribute_update()
    {
        if ($this->attribute) {
            $attributes = get_array_key_translation(config('settings.models.custom_field_setting.supported_types'));
            $attribute = array_rand($attributes);
            $response = $this->put('utilities/attributes/' . $this->attribute->hashed_id, [
                "type" => $attribute,
                "label" => $this->attribute->label,]);

            $response->assertStatus(200)->assertRedirect('utilities/attributes');
        }
        $this->assertTrue(true);
    }

    public function test_utility_attribute_delete()
    {
        if ($this->attribute) {
            $response = $this->delete('utilities/attributes/' . $this->attribute->hashed_id);

            $response->assertStatus(200)->assertSeeText('Attribute has been deleted successfully.');
        }
        $this->assertTrue(true);
    }
}
