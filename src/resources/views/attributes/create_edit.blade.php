@extends('layouts.crud.create_edit')



@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('utility_attribute_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    @parent
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! CoralsForm::openForm($attribute) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! CoralsForm::select('type', 'utility-category::attributes.attributes.type', get_array_key_translation(config('settings.models.custom_field_setting.supported_types')), true,$attribute->type,$attribute->exists?['readonly']:[]) !!}
                        {!! CoralsForm::text('label','utility-category::attributes.attributes.label',true) !!}
                        {!! CoralsForm::number('display_order','utility-category::attributes.attributes.order',true,0,['min'=>0]) !!}
                        {!! CoralsForm::text('properties[icon]','utility-category::attributes.attributes.icon',false) !!}
                        {!! CoralsForm::checkbox('use_as_filter', 'utility-category::attributes.attributes.use_as_filter', $attribute->use_as_filter) !!}
                        {!! CoralsForm::checkbox('required', 'utility-category::attributes.attributes.required', $attribute->required) !!}
                    </div>
                    <div class="col-md-4">
                        @if($attribute->hasMedia($attribute->mediaCollectionName))
                            <img src="{{ $attribute->thumbnail }}" class="img-responsive" style="max-width: 100%;"
                                 alt="Thumbnail"/>
                            <br/>
                            {!! CoralsForm::checkbox('clear', 'utility-category::attributes.attributes.clear') !!}
                        @endif
                        {!! CoralsForm::file('thumbnail', 'utility-category::attributes.attributes.thumbnail') !!}
                    </div>
                    <div class="col-md-4">
                        <div style="display: none;" id="options-field">
                            <div class="form-group" style="">
                                <span data-name="options"></span>
                                {!! CoralsForm::label('options', 'utility-category::attributes.attributes.options') !!}
                                @include('utility-category::attributes.options',[
                                                                'name'=>'options',

                                'options'=> $attribute->options??[]
                                ])
                            </div>
                        </div>
                    </div>
                </div>
                {!! CoralsForm::formButtons() !!}
                {!! CoralsForm::closeForm($attribute) !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            var $type = $("#type");

            var options_types = ['select', 'radio', 'multi_values'];
            if (_.includes(options_types, $type.val())) {
                $("#options-field").fadeIn();
            }

            $type.change(function (event) {
                if (_.includes(options_types, $(this).val())) {
                    $("#options-field").fadeIn();
                } else {
                    $("#options-field").fadeOut();
                }
            })
        });
    </script>
@endsection
