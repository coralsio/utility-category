<?php

namespace Corals\Utility\Category\Http\Requests;

use Corals\Foundation\Http\Requests\BaseRequest;
use Corals\Utility\Category\Models\Category;

class CategoryRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Category::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Category::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'status' => 'required',
                'thumbnail' => 'nullable|image',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'name' => 'required|max:191',
                'slug' => 'required|max:191|unique:utility_categories,slug',
            ]);
        }

        if ($this->isUpdate()) {
            $category = $this->route('category');
            $rules = array_merge($rules, [
                'name' => 'required|max:191',
                'slug' => 'required|max:191|unique:utility_categories,slug,' . $category->id,
            ]);
        }

        return $rules;
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        if ($this->isUpdate() || $this->isStore()) {
            $data = $this->all();

            if (isset($data['slug'])) {
                $data['slug'] = \Str::slug($data['slug']);
                $data['is_featured'] = \Arr::get($data, 'is_featured', false);
            }

            $this->getInputSource()->replace($data);
        }

        return parent::getValidatorInstance();
    }
}
